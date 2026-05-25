<?php

use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ContactoController::class, 'index'])->name('inicio');
Route::post('/contactos', [ContactoController::class, 'store'])->name('contactos.criar');
Route::put('/contactos/{contacto}', [ContactoController::class, 'update'])->name('contactos.editar');
Route::delete('/contactos/{contacto}', [ContactoController::class, 'destroy'])->name('contactos.eliminar');
