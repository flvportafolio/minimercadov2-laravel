<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
/*
|--------------------------------------------------------------------------
| Web Routes de Laravale 8.1
|--------------------------------------------------------------------------
*/

Route::get('/',[InicioController::class,'index']);
