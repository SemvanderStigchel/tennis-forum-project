<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/exercises/admin', [ExerciseController::class, 'showAdmin'])->name('show-admin');

Route::post('exercises/admin/{id}', [ExerciseController::class, 'softDeleteOrRestore'])->name('exercises.delete');

Route::get('/exercises/search', [ExerciseController::class, 'search'])->name('exercises.search');

Route::resource('exercises', ExerciseController::class);
