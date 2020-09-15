<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
/*
|--------------------------------------------------------------------------
| Web Routes de Laravale 8.1
|--------------------------------------------------------------------------
*/

Route::get('/',[WebController::class,'index'])->name("home");
Route::get('/producto',[WebController::class,'producto'])->name("producto");
Route::get('/marca',[WebController::class,'marca'])->name("marca");
Route::get('/contacto',[WebController::class,'contacto'])->name("contacto");
