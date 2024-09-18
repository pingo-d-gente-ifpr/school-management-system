<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users', UserController::class);
    Route::get('register', [UserController::class, 'create'])->name('register');
    Route::post('register', [UserController::class, 'store']);
    Route::resource('subjects', SubjectController::class);
    Route::resource('classes', ClasseController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', PostController::class)->except('index');
    Route::put('register-frequency', [ClasseController::class, 'registerFrequency']);
    Route::put('register-grades', [ClasseController::class, 'registerGrades'])->name('register.grades');
    Route::get('children', [ChildrenController::class, 'index'])->name('children.index');
    Route::get('children/{id}/frequencies', [ChildrenController::class, 'showFrequencies'])->name('children.frequencies');
    Route::get('children/{id}/grades', [ChildrenController::class, 'showGrades'])->name('children.grades');
});



require __DIR__.'/auth.php';
