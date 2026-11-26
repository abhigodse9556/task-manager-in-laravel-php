<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

//Auth controller routes

Route::get('/register', [RegisterController::class, 'show'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth')->group(function () {

    Route::get('/tasks/bin', [TaskController::class, 'bin'])
        ->name('tasks.bin');

    Route::get('/tasks/bin/{task}', [TaskController::class, 'show'])
        ->withTrashed()
        ->name('tasks.bin.show');

    Route::resource('tasks', TaskController::class);

    Route::patch('/tasks/{task}/restore', [TaskController::class, 'restore'])
        ->withTrashed()
        ->name('tasks.restore');

    Route::delete('/tasks/{task}/force-delete', [TaskController::class, 'forceDelete'])
        ->withTrashed()
        ->name('tasks.forceDelete');

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    Route::put('/profile/name', [ProfileController::class, 'updateName'])
        ->name('profile.name.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');
});


Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
    ->name('password.email');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetPasswordForm'])
    ->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
    ->name('password.update');
