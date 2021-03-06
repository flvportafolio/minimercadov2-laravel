<?php  //Laravel 8.1
session_start();

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubCategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\UsuarioSistemaController;
use App\Http\Controllers\EmpleadoUsuarioController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\LogeoController;

Route::post('/dada',function ()
{
  return 'ok ejemplo';
});
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
Route::get('/admin',[LoginController::class,'index'])->name("admin.home")->middleware('admin');

  Route::get('/admin/login',[LoginController::class,'login'])->name("login");
  Route::post('/admin/login',[LoginController::class,'checkdata'])->name("check");

  Route::get('/admin/logout',[LoginController::class,'logout'])->name("logout");

                          /*      rutas de los modulos del administrador    */

//CRUD PRODUCTO
Route::get('admin/producto',[ProductoController::class,'index'])->name("admin.producto")->middleware('admin');
Route::post('admin/producto', [ProductoController::class,'store'])->name("producto.store")->middleware('admin');
Route::post('admin/producto/edit',[ProductoController::class,'edit'])->name("producto.edit")->middleware('admin');
Route::delete('admin/producto',[ProductoController::class,'destroy'])->name("producto.destroy")->middleware('admin');
Route::match(['put', 'patch'],'admin/producto', [ProductoController::class,'update'])->name("producto.update")->middleware('admin');


  Route::resource('admin/categoria',CategoriaController::class)->only(['index','destroy'])->middleware('admin');  
  Route::post('admin/categoria/edit', [CategoriaController::class,'edit'])->name("categoria.edit")->middleware('admin');
  Route::post('admin/categoria/store', [CategoriaController::class,'store'])->name("categoria.store")->middleware('admin');
  Route::match(['put', 'patch'],'admin/categoria', [CategoriaController::class,'update'])->name("categoria.update")->middleware('admin');


Route::get('admin/subcategoria',[SubCategoriaController::class,'index'])->name("admin.subcategoria")->middleware('admin');
Route::post('admin/subcategoria', [SubCategoriaController::class,'store'])->name("subcategoria.store")->middleware('admin');
Route::post('admin/subcategoria/edit',[SubCategoriaController::class,'edit'])->name("subcategoria.edit")->middleware('admin');
Route::match(['put', 'patch'],'admin/subcategoria', [SubCategoriaController::class,'update'])->name("subcategoria.update")->middleware('admin');
Route::delete('admin/subcategoria',[SubCategoriaController::class,'destroy'])->name("subcategoria.destroy")->middleware('admin');


  Route::get('admin/marca',[MarcaController::class,'index'])->name("admin.marca")->middleware('admin');
  Route::post('admin/marca', [MarcaController::class,'store'])->name("marca.store")->middleware('admin');
  Route::post('admin/marca/edit',[MarcaController::class,'edit'])->name("marca.edit")->middleware('admin');
  Route::match(['put', 'patch'],'admin/marca', [MarcaController::class,'update'])->name("marca.update")->middleware('admin');
  Route::delete('admin/marca',[MarcaController::class,'destroy'])->name("marca.destroy")->middleware('admin');



Route::get('admin/usuario',[UsuarioSistemaController::class,'index'])->name("admin.usuario")->middleware('admin');
Route::post('admin/usuario',[UsuarioSistemaController::class,'store'])->name("admin.store")->middleware('admin');
Route::post('admin/usuario/edit',[UsuarioSistemaController::class,'edit'])->name("admin.edit")->middleware('admin');
Route::match(['put', 'patch'],'admin/usuario', [UsuarioSistemaController::class,'update'])->name("admin.update")->middleware('admin');

Route::post('admin/empleado',[EmpleadoUsuarioController::class,'store'])->name("empleado.store")->middleware('admin');
Route::post('admin/empleado/edit',[EmpleadoUsuarioController::class,'edit'])->name("empleado.edit")->middleware('admin');
Route::match(['put', 'patch'],'admin/empleado', [EmpleadoUsuarioController::class,'update'])->name("empleado.update")->middleware('admin');

  Route::get('admin/cargo',[CargoController::class,'index'])->name("admin.cargo")->middleware('admin');
  Route::post('admin/cargo', [CargoController::class,'store'])->name("cargo.store")->middleware('admin');
  Route::delete('admin/cargo',[CargoController::class,'destroy'])->name("cargo.destroy")->middleware('admin');
  Route::match(['put', 'patch'],'admin/cargo', [CargoController::class,'update'])->name("cargo.update")->middleware('admin');
  Route::post('admin/cargo/edit',[CargoController::class,'edit'])->name("cargo.edit")->middleware('admin');


Route::get('admin/logeo',[LogeoController::class,'index'])->name("admin.logeo")->middleware('admin');