<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'announcement_id'];

    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }
}