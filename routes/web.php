<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\AnnouncementController;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/annunci', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/annuncio/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');
Route::get('/categoria/{category}', [AnnouncementController::class, 'categoryShow'])->name('categoryShow');

Route::middleware(['auth'])->group(function () {
    Route::get('/nuovo/annuncio', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::get('/lavora-con-noi', [PublicController::class, 'revisorForm'])->name('revisor.form');
    Route::post('/diventa/revisore', [PublicController::class, 'becomeRevisor'])->name('become.revisor');
    Route::get('/rendi/revisore/{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor');

    Route::middleware(['isRevisor'])->group(function () {
        Route::get('/revisore/home', [RevisorController::class, 'index'])->name('revisor.index');
        Route::patch('/revisore/accetta/{announcement}', [RevisorController::class, 'acceptAnnouncement'])->name('revisor.accept_announcement');
        Route::patch('/revisore/rifiuta/{announcement}', [RevisorController::class, 'rejectAnnouncement'])->name('revisor.reject_announcement');
        Route::patch('/revisore/annulla', [RevisorController::class, 'undoLastDecision'])->name('revisor.undo');
    });
});

Route::get('/search/announcements', [PublicController::class, 'searchAnnouncements'])->name('announcements.search');
Route::post('/locale/{lang}', [PublicController::class, 'setLocale'])->name('setLocale');