<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        $lista_cat=Categoria::orderBy('nombre', 'asc')->get();
        $lista_special_prod=Producto::TraerLista_Prod_Subcat();
        
        $cats_items="";
        foreach ($lista_cat as $indice => $obj_c)//crear el nav de categorias
        {  $item="";
            foreach ($lista_special_prod as $con => $obj_prod)//crea los items de cada subcategoria
            { 
                if($obj_c->nombre==$obj_prod->nombre_categoria)//se verifica que coincida el nombre de la categoria con el nombre de categoria que tiene la subcategoria.
                {
                    $item.='<a class="dropdown-item" href="#">'.$obj_prod->nombre_subcategoria.' <span class="badge badge-info"> '.$obj_prod->cantidad_productos.' </span></a>';
                }
            }
            if($indice==0)//si es el primer item del nav
            { 
                if($item=="")//si el primer item no tiene subcategoria sera un boton sencillo
                {
                $cats_items.='<a class="nav-link active h6" href="#">'.$obj_c->nombre.'</a>';
                }
                else//si el primer item tiene subcategorias sera el boton de tipo dropdown
                {
                $cats_items.='
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active h6" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">'.$obj_c->nombre.'</a>
                    <div class="dropdown-menu">
                    '.$item.'
                    </div>
                </li>';
                }
            }
            else // si no es el primer item del nav
            {
                if($item=="")//si el item no tiene subcategoria sera un boton sencillo
                {
                $cats_items.='<a class="nav-link text-dark h6" href="#">'.$obj_c->nombre.'</a>';
                }
                else//si el item tiene subcategorias sera el boton de tipo dropdown
                {
                $cats_items.='
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark h6" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">'.$obj_c->nombre.'</a>
                    <div class="dropdown-menu">
                    '.$item.'
                    </div>
                </li>';
                }
                
            }  
            $indice+=1;
        }

        //generacion de la seccion Productos recientemente agregados
        $item_ultimosprod='<div class="row pb-2">';
        $lista_ultimos_prod=Producto::TraerLista_UltimosProductos();
        foreach ($lista_ultimos_prod as $indice => $obj) 
        {
            $indice+=1;
            if ($indice%4==0)
            {
                $item_ultimosprod.='
                <div class="pb-2 col-md-3">
                <div class="card pt-3">
                    <img class="mx-auto" src="'.asset('img/producto/'.$obj->foto).'"  height="100px" alt="producto"> 
                    <div class="card-body">
                    <h6 class="card-title">'.$obj->nombre.'</h6>
                    <p class="card-text">'.$obj->descripcion.'</p>
                    </div>
                </div>
                </div>';
                $item_ultimosprod.='</div>';
                $item_ultimosprod.='<div class="row pb-2">';  
            }
            else 
            {
                $item_ultimosprod.='
                <div class="pb-2 col-md-3">
                <div class="card pt-3">
                    <img class="mx-auto" src="'.asset('img/producto/'.$obj->foto).'"  height="100px" alt="producto"> 
                    <div class="card-body">
                    <h6 class="card-title">'.$obj->nombre.'</h6>
                    <p class="card-text">'.$obj->descripcion.'</p>
                    </div>
                </div>
                </div>';
            }    
        }
        $item_ultimosprod.='</div>';
        
      return view('web.index',compact('cats_items','item_ultimosprod'));
    }
}