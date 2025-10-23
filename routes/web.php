<?php

use App\Http\Controllers\NoteBookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/notes', NoteController::class)->missing(function (Request $request) {
        return Redirect::route('notes.index');
    });
    Route::resource('/notebooks', NoteBookController::class)->missing(function (Request $request) {
        return Redirect::route('notebooks.index');
    });
    
});


require __DIR__.'/auth.php';
