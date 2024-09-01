<?php

use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/exercicio', [ExercicioController::class, 'index'])->name('exercicio.index')->middleware('auth');
Route::get('/exercicio/create', [ExercicioController::class, 'create'])->name('exercicio.create')->middleware('auth');
Route::post('/exercicio', [ExercicioController::class, 'store'])->name('exercicio.store')->middleware('auth');
Route::get('/exercicio/edit/{id}', [ExercicioCOntroller::class, 'edit'])->name('exercicio.edit')->middleware('auth');
Route::put('/exercicio/update/{id}', [ExercicioController::class, 'update'])->name('exercicio.update')->middleware('auth');
Route::get('/exercicio/show/{id}', [ExercicioCOntroller::class, 'show'])->name('exercicio.show')->middleware('auth');
Route::delete('/exercicio/destroy/{id}', [ExercicioController::class, 'destroy'])->name('exercicio.destroy')->middleware('auth');

require __DIR__.'/auth.php';
