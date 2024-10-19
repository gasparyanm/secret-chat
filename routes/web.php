<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

    Route::get('message/write', [MessageController::class, 'writeForm'])->name('message.write.view');
    Route::get('message/read/{decryptKey?}', [MessageController::class, 'readForm'])->name('message.read.view');
    Route::post('message/write', [MessageController::class, 'send'])->name('message.send');
    Route::post('message/read', [MessageController::class, 'read'])->name('message.read');
});

require __DIR__.'/auth.php';
