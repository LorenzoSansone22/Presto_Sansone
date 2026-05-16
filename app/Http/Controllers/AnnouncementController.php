<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('is_accepted', true)->with(['images'])->latest()->get();
        return view('announcements.index', compact('announcements'));
    }

    public function categoryShow(Category $category)
    {
        $announcements = Announcement::where('category_id', $category->id)
                                    ->where('is_accepted', true)
                                    ->with(['images'])
                                    ->latest()
                                    ->get();
                                    
        return view('announcements.categoryShow', compact('category', 'announcements'));
    }

    public function show(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }

    public function create()
    {
        return view('announcements.create');
    }
}