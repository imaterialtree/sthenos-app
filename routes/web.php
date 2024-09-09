<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExercicioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\TreinoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard',DashboardController::class
)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::patch('aluno/{aluno}', [AlunoController::class, 'update'])->middleware('auth')->name('aluno.update');
Route::get('aluno/{idTreino}/joinTreino', [AlunoController::class, 'joinTreino'])->middleware('auth')->name('aluno.joinTreino');
Route::resource('exercicio', ExercicioController::class)->middleware(['auth', 'instrutor']);
Route::get('treino/{treino}', [TreinoController::class, 'show'])->name('treino.show')->middleware('auth');
Route::resource('treino', TreinoController::class)->except('show')->middleware(['auth', 'instrutor']);

// Relatórios
Route::prefix('relatorio')->name('relatorio.')->middleware('auth')->group(function () {
    Route::get('/', [RelatorioController::class, 'index'])->name('index');
    Route::post('aluno-treinos', [RelatorioController::class, 'alunoTreinos'])->name('aluno-treinos');
    Route::get('sistema', [RelatorioController::class, 'sistema'])->name('sistema');
});


require __DIR__.'/auth.php';
