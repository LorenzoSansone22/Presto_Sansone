<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Spatie\Image\Image as SpatieImage;
use Spatie\Image\Enums\Fit;

class RemoveFaces implements ShouldQueue
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

        $srcPath = storage_path('app/public/' . $i->path);

        // SIMULAZIONE WEEKEND
        if (!file_exists(base_path('google_credential.json'))) {
            return;
        }

        // --- CODICE UFFICIALE GOOGLE VISION & SPATIE IMAGE (Attivo da lunedì) ---
        $image_to_check = file_get_contents($srcPath);
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->faceDetection($image_to_check);
        $faces = $response->getFaceAnnotations();

        if ($faces) {
            foreach ($faces as $face) {
                $vertices = $face->getBoundingPoly()->getVertices();
                $bounds = [];

                foreach ($vertices as $vertex) {
                    $bounds[] = [$vertex->getX(), $vertex->getY()];
                }

        
                $w = $bounds[2][0] - $bounds[0][0];
                $h = $bounds[2][1] - $bounds[0][1];

        
                $topLeftX = $bounds[0][0];
                $topLeftY = $bounds[0][1];

        
                $image = SpatieImage::load($srcPath);
                
            
                $watermarkPath = public_path('images/censura.png');

                if (file_exists($watermarkPath)) {
                    $image->watermark(
                        $watermarkPath,
                        width: $w,
                        height: $h,
                        paddingX: $topLeftX,
                        paddingY: $topLeftY,
                        fit: Fit::Stretch
                    );
                    
                    $image->save($srcPath);
                }
            }
        }

        $imageAnnotator->close();
    }
}