<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskGroupController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::middleware(['auth'])->group(function () {
    //tasks
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    //task groups
    Route::get('/task-groups', [TaskGroupController::class, 'index'])->name('task-groups.index');
    Route::get('/task-groups/create', [TaskGroupController::class, 'create'])->name('task-groups.create');
    Route::post('/task-groups', [TaskGroupController::class, 'store'])->name('task-groups.store');
    Route::get('/task-groups/{taskGroup}', [TaskGroupController::class, 'show'])->name('task-groups.show');
    Route::get('/task-groups/{taskGroup}/edit', [TaskGroupController::class, 'edit'])->name('task-groups.edit');
    Route::put('/task-groups/{taskGroup}', [TaskGroupController::class, 'update'])->name('task-groups.update');
    Route::delete('/task-groups/{taskGroup}', [TaskGroupController::class, 'destroy'])->name('task-groups.destroy');
});


require __DIR__ . '/auth.php';
