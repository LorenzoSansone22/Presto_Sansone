<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class AnnouncementController extends Controller
{
    
    public function create()
    {
    
        $categories = Category::all();
        return view('announcements.create', compact('categories'));
    }

    
    public function store(Request $request)
    {
        
        Auth::user()->announcements()->create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id, 
        ]);

        return redirect()->route('homepage')->with('message', 'Annuncio inserito con successo!');
    }
}