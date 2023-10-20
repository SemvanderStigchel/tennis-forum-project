<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('profile', UserController::class);

Route::get('/exercises/admin', [ExerciseController::class, 'showAdmin'])->name('show-admin');

Route::delete('exercises/admin/{id}', [ExerciseController::class, 'softDeleteOrRestore'])->name('exercises.delete');

Route::resource('exercises', ExerciseController::class);
