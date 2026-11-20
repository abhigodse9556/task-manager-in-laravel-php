<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
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
    Route::resource('tasks', TaskController::class);

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});

//Task controller routes

// Route::get('/tasks', [TaskController::class, 'index'])
//     ->name('tasks.index');

// Route::get('/tasks/create', [TaskController::class, 'create'])
//     ->name('tasks.create');

// Route::post('/tasks', [TaskController::class, 'store'])
//     ->name('tasks.store');

// Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])
//     ->name('tasks.edit');

// Route::put('/tasks/{task}', [TaskController::class, 'update'])
//     ->name('tasks.update');

// Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
//     ->name('tasks.destroy');
