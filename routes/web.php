<?php  //Laravel 8.1
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;


//rutas principales del modo web 
Route::get('/',[WebController::class,'index'])->name("home");
Route::get('/producto',[WebController::class,'producto'])->name("producto");
Route::get('/marca',[WebController::class,'marca'])->name("marca");
Route::get('/contacto',[WebController::class,'contacto'])->name("contacto");

//rutas complementarias del modo web
Route::get('/acerca',[WebController::class,'acerca'])->name("acerca");
Route::get('/terminos',[WebController::class,'terminos'])->name("terminos");
Route::get('/cookies',[WebController::class,'cookies'])->name("cookies");
Route::get('/privacidad',[WebController::class,'privacidad'])->name("privacidad");
