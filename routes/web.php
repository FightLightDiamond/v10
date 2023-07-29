<?php

use App\Http\Controllers\BetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TheMatchController;
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

Route::get('bets', [BetController::class, 'index'])->name('bets.index');
Route::post('bets', [BetController::class, 'execute'])->name('bets.bet');
Route::get('the_matches/current', [TheMatchController::class, 'current'])
    ->name('the_matches.current');



Route::get('g', function () {
    return Inertia::render('G');
});

Route::get('/shooter', function () {
    return Inertia::render('shooter');
});


Route::get('a', function () {
    $fiber = new Fiber(function (): void {
        Fiber::suspend(); // Tạm dừng fiber
        echo 'bfsjf';
    });
    $fiber->start();
    echo "Taken control back...\n";
    echo "Resuming Fiber...\n";
    $fiber->resume(); // tiếp tục thực hiện fiber
    echo "Program exits...\n";
});

require __DIR__.'/auth.php';

//
//// Hàm custom để xử lý các thông báo lỗi
//function customErrorHandler($errno, $errstr, $errfile, $errline) {
//    // Tạo thông báo lỗi
//    $message = date("Y-m-d H:i:s") . " - Error: [$errno] $errstr in $errfile on line $errline" . PHP_EOL;
//
//    // Ghi thông báo lỗi vào tệp tin log
//    error_log($message, 3, "error_log.txt");
//}
//
//// Đặt "default error handler" thành hàm customErrorHandler
//set_error_handler("customErrorHandler");
