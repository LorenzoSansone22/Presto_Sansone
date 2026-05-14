<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AnnouncementController;


Route::get('/', [PublicController::class, 'homepage'])->name('homepage');


Route::middleware(['auth'])->group(function () {
    Route::get('/nuovo/annuncio', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/annuncio/salva', [AnnouncementController::class, 'store'])->name('announcements.store');
});


