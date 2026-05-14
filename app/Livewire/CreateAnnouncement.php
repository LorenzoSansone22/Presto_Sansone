<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class CreateAnnouncement extends Component
{
    public $title;
    public $description;
    public $price;
    public $category_id;

    protected $rules = [
        'title' => 'required|min:4',
        'description' => 'required|min:10',
        'price' => 'required|numeric',
        'category_id' => 'required',
    ];

    public function store()
    {
        $this->validate();

        Auth::user()->announcements()->create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
        ]);

        session()->flash('message', 'Annuncio inserito con successo!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.create-announcement', [
            'categories' => \App\Models\Category::all()
        ]);
    }
}