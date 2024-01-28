<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/note', [NoteController::class, 'index'])->name('anote.index');
Route::get('/note/create', [NoteController::class, 'create'])->name('anote.create');
Route::post('/note/store', [NoteController::class, 'store'])->name('anote.store');
// servira para recepcionar información y hará que la información viaje de
// forma encriptada en un formato de formulario
Route::get('/note/edit/{note}', [NoteController::class, 'edit'])->name('anote.edit');
Route::put('/note/update/{note}', [NoteController::class, 'update'])->name('anote.update');
Route::get('/note/show/{note}', [NoteController::class, 'show'])->name('anote.show');
Route::delete('/note/destroy/{note}', [NoteController::class, 'destroy'])->name('anote.destroy');



