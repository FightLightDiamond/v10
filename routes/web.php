<?php

use App\Http\Controllers\BetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpeakController;
use App\Http\Controllers\TheMatchController;
use App\Http\Controllers\WiseController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('bets', [BetController::class, 'index'])->name('bets.index');
Route::post('bets', [BetController::class, 'execute'])->name('bets.bet');
Route::get('the_matches/current', [TheMatchController::class, 'current'])
    ->name('the_matches.current');

Route::get('g', function () {
    return Inertia::render('G');
});

Route::get('/shooter', function () {

    //dd(Route::current()->uri());
    return Inertia::render('shooter');
});

Route::get('python', [SpeakController::class, 'python']);
Route::get('speak', [SpeakController::class, 'getAlphabet']);
Route::post('speak', [SpeakController::class, 'generateSpeech']);
Route::get('speaks', [SpeakController::class, 'generateSpeech']);

Route::get('wise', [WiseController::class, 'exec']);
Route::get('enhance', function () {
    return Inertia::render('Dev/enhance');
})->name('enhance');

Route::resource('items', \App\Http\Controllers\ItemController::class);

Route::get('table', function () {
    return Inertia::render('bet');
});
