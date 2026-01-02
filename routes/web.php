<?php


use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return redirect('/tasks');
});

Route::resource('tasks', TaskController::class);

Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])
    ->name('tasks.complete');
