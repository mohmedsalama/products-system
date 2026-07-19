<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskWebController;
use App\Http\Controllers\UserWebController;

Route::get('/', fn() => redirect()->route('tasks.index'));
Route::resource('tasks', TaskWebController::class);
Route::resource('users', UserWebController::class)->only(['index', 'create', 'store', 'destroy']);

