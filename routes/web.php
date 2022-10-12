<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\DesarrolladorController;
use App\Http\Controllers\UsuariosController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('proyectos', ProyectoController::class)->middleware('auth');
Route::resource('desarrolladores', DesarrolladorController::class)->middleware('auth');
Route::resource('usuarios', UsuariosController::class)->middleware('auth');
