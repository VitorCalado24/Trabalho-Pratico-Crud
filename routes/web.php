<?php

use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ContactoController::class, 'index'])->name('inicio');
Route::get('/contactos/criar', [ContactoController::class, 'create'])->name('contactos.formulario');
Route::post('/contactos', [ContactoController::class, 'store'])->name('contactos.criar');
Route::get('/contactos/{contacto}/editar', [ContactoController::class, 'edit'])->name('contactos.formulario-editar');
Route::put('/contactos/{contacto}', [ContactoController::class, 'update'])->name('contactos.editar');
Route::delete('/contactos/{contacto}', [ContactoController::class, 'destroy'])->name('contactos.eliminar');
