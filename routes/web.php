<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(TaskController::class)->prefix('tasks')->group(function () {
    Route::get("/tasks/{slug}", 'index')->name('task.index');
    Route::post("/task", 'store')->name('task.store');
    Route::post("/task/{id}", 'update')->name('task.update');
    Route::get("/task/{id}/edit", 'edit')->name('task.edit');
    Route::delete("/task/{id}", 'delete')->name('task.delete');
    Route::post("/task-reorder", 'reorder')->name('task.reorder');
});
