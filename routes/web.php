<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VaultController;
use App\Http\Controllers\UploadController;
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

Route::get('/', [HomeController::class, 'index'])->middleware('guest');

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/vault', [VaultController::class, 'index'])->name('vault')->middleware('auth');
Route::get('/download/{id}', [VaultController::class, 'downloadPage'])->name('download_page')->middleware('auth');
Route::post('/download/{id}', [VaultController::class, 'download'])->name('download')->middleware('auth');

Route::get('/upload', [UploadController::class, 'index'])->name('upload')->middleware('auth');
Route::post('/upload', [UploadController::class, 'store'])->name('upload')->middleware('auth');
Route::post('/speed-test', [UploadController::class, 'speedTest'])->name('upload')->middleware('auth');

Route::get('/users', function() {
    return view('users', [
        "title" => "Users",
    ]);
})->name('users')->middleware('auth');
