<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Mail\BecomeRevisor;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function homepage()
    {
        $announcements = Announcement::where('is_accepted', true)->latest()->take(6)->get();
        return view('welcome', compact('announcements'));
    }

    public function searchAnnouncements(Request $request)
    {
        $query = $request->input('query');
        $announcements = Announcement::search($query)->where('is_accepted', true)->paginate(10);

        return view('announcements.index', compact('announcements', 'query'));
    }

    public function revisorForm()
    {
        return view('revisor.form');
    }

    public function becomeRevisor(Request $request)
    {
        if (Auth::user()->is_revisor) {
            return redirect()->route('homepage')->with('message', 'Sei già un revisore.');
        }

        Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user()));
        
        return redirect()->route('homepage')->with('message', 'Complimenti! Hai richiesto di diventare revisore correttamente.');
    }

    public function setLocale($lang)
    {
        session()->put('locale', $lang);
        return redirect()->back();
    }
}