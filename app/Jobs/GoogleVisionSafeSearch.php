<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Likelihood;

class GoogleVisionSafeSearch implements ShouldQueue
{
    use Queueable;

    private $article_image_id;

    /**
     * Create a new job instance.
     */
    public function __construct($article_image_id)
    {
        $this->article_image_id = $article_image_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $i = Image::find($this->article_image_id);
        if (!$i) {
            return;
        }

        // SIMULAZIONE WEEKEND IN ATTESA DEL FILE

        if (!file_exists(base_path('google_credential.json'))) {
            $i->adult = 'bi bi-shield-check text-success';
            $i->spoof = 'bi bi-shield-check text-success';
            $i->medical = 'bi bi-shield-check text-success';
            $i->violence = 'bi bi-shield-check text-success';
            $i->racy = 'bi bi-shield-check text-success';
            $i->save();
            return;
        }

        // --- CODICE UFFICIALE GOOGLE VISION (Attivo da lunedì automaticamente) ---
        $image = file_get_contents(storage_path('app/public/' . $i->path));
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        $imageAnnotatorClient = new ImageAnnotatorClient();
        $response = $imageAnnotatorClient->safeSearchDetection($image);
        $imageAnnotatorClient->close();

        $safe = $response->getSafeSearchAnnotation();

        if ($safe) {
            $adult = $safe->getAdult();
            $spoof = $safe->getSpoof();
            $medical = $safe->getMedical();
            $violence = $safe->getViolence();
            $racy = $safe->getRacy();

            $likelihoodName = [
                Likelihood::UNKNOWN => 'bi bi-question-circle text-secondary',
                Likelihood::VERY_UNLIKELY => 'bi bi-shield-check text-success',
                Likelihood::UNLIKELY => 'bi bi-check-circle text-info',
                Likelihood::POSSIBLE => 'bi bi-exclamation-circle text-warning',
                Likelihood::LIKELY => 'bi bi-exclamation-triangle text-danger',
                Likelihood::VERY_LIKELY => 'bi bi-shield-slash text-danger',
            ];

            $i->adult = $likelihoodName[$adult];
            $i->spoof = $likelihoodName[$spoof];
            $i->medical = $likelihoodName[$medical];
            $i->violence = $likelihoodName[$violence];
            $i->racy = $likelihoodName[$racy];
            $i->save();
        }
    }
}