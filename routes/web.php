<?php

use App\Models\Question;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/upgrade-to-mentor', function () {
        return view('upgrade');
    })->name('upgrade');

    Route::get('/ask', function () {
        return view('post-question');
    })->name('ask');

    Route::get('/community', function () {
        return view('community');
    })->name('community');

    Route::get('/questions/{question:slug}', function (Question $question) {
        return view('questions.show', compact('question'));
    })->name('question.show');

});
