<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AudioController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('dashboard');
})->name('index');

Route::middleware('auth')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
    });

    Route::controller(ProfileController::class)->name('profile.')->prefix('profile')->group(function () {
        Route::post('/profile_password/{profile}', 'profile_password')->name('password');
    });


    // Resource Controller
    Route::resource('/profile', ProfileController::class);
});

Route::post('/quiz/shuffle', [QuizController::class, 'shuffle']);

Route::controller(AudioController::class)->group(function () {
    Route::get('/audio/index', 'audio_index')->name('audio.index');
    Route::post('/audio-upload', 'audio_upload')->name('audio.upload');
    Route::get('/audio/list', 'list')->name('audio.list');
    Route::get('/audio/search', 'search')->name('audio.search');
});





require __DIR__ . '/auth.php';
