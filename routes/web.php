<?php  //Laravel 8.1
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\LoginController;


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


//rutas del administrador
Route::get('/admin',[LoginController::class,'index'])->name("admin.home");

Route::get('/admin/login',[LoginController::class,'login'])->name("login");
Route::post('/admin/login',[LoginController::class,'checkdata'])->name("check");

Route::get('/admin/logout',[LoginController::class,'logout'])->name("logout");