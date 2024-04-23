<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

Route::resource('/users', UserController::class,);

Route::resource('/tasks', TaskController::class);
Route::resource('/userTask', TaskController::class);



