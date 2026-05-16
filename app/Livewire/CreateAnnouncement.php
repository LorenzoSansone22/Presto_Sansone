<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Announcement;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class CreateAnnouncement extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $price;
    public $category_id;
    public $temporary_images = [];
    public $images = [];

    protected $rules = [
        'title' => 'required|min:4',
        'description' => 'required|min:10',
        'price' => 'required|numeric',
        'category_id' => 'required',
        'temporary_images.*' => 'image|max:1024',
        'temporary_images' => 'max:6',
    ];

    protected $messages = [
        'required' => 'Il campo :attribute è richiesto',
        'min' => 'Il campo :attribute è troppo corto',
        'numeric' => 'Il campo :attribute deve essere un numero',
        'temporary_images.*.image' => 'I file devono essere immagini',
        'temporary_images.*.max' => 'L\'immagine deve pesare massimo 1MB',
        'temporary_images.max' => 'Puoi caricare al massimo 6 immagini',
    ];

    public function updatedTemporaryImages()
    {
        if ($this->validate(['temporary_images.*' => 'image|max:1024'])) {
            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }
            $this->temporary_images = [];
        }
    }

    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }

    public function store()
    {
        $this->validate();

        $announcement = Auth::user()->announcements()->create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
        ]);

        if (count($this->images) > 0) {
            foreach ($this->images as $image) {
                $newFileName = "announcements/{$announcement->id}";
                $announcement->images()->create([
                    'path' => $image->store($newFileName, 'public')
                ]);
            }
        }

        session()->flash('message', 'Annuncio inserito con successo!');
        $this->cleanForm();
    }

    public function cleanForm()
    {
        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->category_id = '';
        $this->temporary_images = [];
        $this->images = [];
    }

    public function render()
    {
        return view('livewire.create-announcement', [
            'categories' => Category::all()
        ]);
    }
}