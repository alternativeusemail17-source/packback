<?php

use App\Http\Controllers\DressController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QueueController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [DressController::class, 'landing'])->name('welcome');
Route::get('/reviews', [DressController::class, 'reviews'])->name('reviews.index');

Auth::routes();

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('/password/otp', [ForgotPasswordController::class, 'showVerifyOTPPage'])->name('password.otp.form');
Route::post('/password/otp/verify', [ForgotPasswordController::class, 'verifyOtp'])->name('password.otp.verify');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [DressController::class, 'index'])->name('dashboard');
    Route::post('/reviews/{review}/replies', [DressController::class, 'storeReviewReply'])->name('reviews.replies.store');
    Route::get('/dresses', [DressController::class, 'index'])->name('dresses.index');
    Route::get('/queues', [QueueController::class, 'index'])->name('queues.index');
    Route::post('/queues', [QueueController::class, 'store'])->name('queues.store');
    Route::get('/queues/{queue}', [QueueController::class, 'show'])->name('queues.show');
    Route::delete('/queues/{queue}', [QueueController::class, 'destroy'])->name('queues.destroy');
    Route::post('/queues/{queue}/dresses', [QueueController::class, 'addDress'])->name('queues.dresses.store');
    Route::delete('/queues/{queue}/dresses/{dress}', [QueueController::class, 'removeDress'])->name('queues.dresses.destroy');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/dresses/create', [DressController::class, 'create'])->name('dresses.create');
    Route::get('/dresses/deleted', [DressController::class, 'deleted'])->name('dresses.deleted');
    Route::post('/dresses', [DressController::class, 'store'])->name('dresses.store');
    Route::get('/dresses/{dress}', [DressController::class, 'show'])->name('dresses.show');
    Route::get('/dresses/{dress}/edit', [DressController::class, 'edit'])->name('dresses.edit');
    Route::put('/dresses/{dress}', [DressController::class, 'update'])->name('dresses.update');
    Route::delete('/dresses/{dress}', [DressController::class, 'destroy'])->name('dresses.destroy');
    Route::patch('/dresses/{dress}/restore', [DressController::class, 'restore'])->name('dresses.restore');
});
