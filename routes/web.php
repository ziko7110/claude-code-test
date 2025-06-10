<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::resource('todos', TodoController::class);
Route::patch('todos/{todo}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');