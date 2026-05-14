<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class PublicController extends Controller
{
    public function homepage() {
    
        $announcements = Announcement::orderBy('created_at', 'desc')->take(6)->get();
        
    
        return view('welcome', compact('announcements'));
    }
}