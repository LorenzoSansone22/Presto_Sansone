<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AnnouncementController;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/annunci', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/annuncio/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');


Route::get('/categoria/{category}', [AnnouncementController::class, 'categoryShow'])->name('categoryShow');

Route::middleware(['auth'])->group(function () {
    Route::get('/nuovo/annuncio', [AnnouncementController::class, 'create'])->name('announcements.create');
});