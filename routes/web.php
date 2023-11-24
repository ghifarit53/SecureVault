<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VaultController;
use App\Http\Controllers\UploadController;
use App\Models\User;
use App\Models\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;

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


Route::get('/request', function() {
    $userRequests = UserRequest::where('target_id', Auth::user()->id)->where('status', 0)->get();

    return view('requests', [
        "title" => "Request",
        'userRequests' => $userRequests,
    ]);
})->name('request')->middleware('auth');


Route::get('/request/{id}', function($id) {
    $targetUser = User::find($id);
    $userRequest = Auth::user();

    $userRequest = new UserRequest();
    $userRequest->sender_id = Auth::user()->id;
    $userRequest->target_id = $targetUser->id;
//    $userRequest->key = "";
    $userRequest->status = 0; // Pendin
    $userRequest->save();

    return back()->with('success', 'User request sent successfully.');
})->name('send_request')->middleware('auth');

Route::get('/accept/{id}', function($id) {
    $userRequest = UserRequest::find($id);

//    $user = User::find($userRequest->sender_id);
//
//    $publicKeyPem = $user->public_key;
//    $textToEncrypt = User::find($userRequest->target_id)->key;
//    $encryptedText = Crypt::encryptString($textToEncrypt);

    // $privateKeyPem = $user->private_key;
    // $decryptedText = Crypt::decryptString($encryptedText, false, $privateKeyPem);

    // dd([
    //     'enc' => $encryptedText,
    //     'dec' => $decryptedText,
    // ]);
//    $userRequest->key = $encryptedText;
    $userRequest->status = 1;
    $userRequest->save();

    return back()->with('success', 'User request sent successfully.');
})->name('send_request')->middleware('auth');

Route::get('/reject/{id}', function($id) {
    $userRequest = UserRequest::find($id);
    $userRequest->delete();
    return back()->with('success', 'User request sent successfully.');
})->name('send_request')->middleware('auth');


Route::get('/view/{id}', function($id) {
    $userRequests = UserRequest::find($id);
    $files = User::find($userRequests->target_id)->files;
    $user = User::find($userRequests->target_id);

    return view('vault', [
        "title" => $user->username." Vault",
        'files' => $files,
        'userRequests' => $userRequests,
    ]);
})->name('request')->middleware('auth');
