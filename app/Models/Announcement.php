<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;

    
    protected $fillable = ['title', 'description', 'price', 'category_id', 'user_id']; 

    /**
     * Relazione: L'annuncio appartiene a una Categoria
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relazione: L'annuncio appartiene a un Utente (l'autore)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}