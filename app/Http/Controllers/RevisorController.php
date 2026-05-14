<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class RevisorController extends Controller
{
    public function index()
    {
        $announcement_to_check = Announcement::where('is_accepted', null)->first();
        return view('revisor.index', compact('announcement_to_check'));
    }

    public function acceptAnnouncement(Announcement $announcement)
    {
        $announcement->setAccepted(true);
        return redirect()->back()->with('message', 'Annuncio accettato');
    }

    public function rejectAnnouncement(Announcement $announcement)
    {
        $announcement->setAccepted(false);
        return redirect()->back()->with('message', 'Annuncio rifiutato');
    }

    public function undoLastDecision()
    {
        $last_announcement = Announcement::whereNotNull('is_accepted')
            ->orderBy('updated_at', 'desc')
            ->first();

        if (!$last_announcement) {
            return redirect()->back()->with('message', 'Nessuna operazione da annullare');
        }

        $last_announcement->setAccepted(null);
        return redirect()->back()->with('message', "L'ultima revisione è stata annullata.");
    }

    public function makeRevisor(User $user)
    {
        Artisan::call('presto:make-revisor', ['email' => $user->email]);
        return redirect('/')->with('message', "Complimenti! L'utente {$user->name} è diventato revisore.");
    }
}