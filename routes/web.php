<?php

use App\Http\Controllers\Admin\English\CourseController;
use App\Http\Controllers\Admin\English\CrazyController;
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

Route::get('enhance', function () {
    return Inertia::render('Dev/enhance');
})->name('enhance');

Route::resource('items', \App\Http\Controllers\ItemController::class);

Route::get('table', function () {
    return Inertia::render('bet');
});

/**
 * =============================== English
 */
Route::get('english', [\App\Http\Controllers\EnglishController::class, 'index']);
Route::get('course/{id}', [\App\Http\Controllers\EnglishController::class, 'show'])->name('crazy-course.show');
Route::get('read/{id}', [\App\Http\Controllers\EnglishController::class, 'read'])->name('crazy-course.read');
Route::get('story/{id}', [\App\Http\Controllers\EnglishController::class, 'story'])->name('crazy-course.story');


Route::prefix('admin')->group(function () {
    Route::resource('course', CourseController::class);
    Route::resource('crazies', CrazyController::class);
});
