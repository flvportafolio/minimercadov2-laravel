<?php

namespace App\Http\Controllers;
use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class WebController extends Controller
{   //pagina de inicio del modo web
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
    //pagina de producto del modo web
    public function producto()
    {
        $lista_prod=Producto::TraerLista_Producto_asc();
        //generacion de bloques de producto en fila y por columnas de 4
        $seccion_prod='<div class="row pb-2">';
        foreach ($lista_prod as $indice => $obj) 
        {
            $indice+=1;
            if ($indice%4==0)
            {
                $seccion_prod.='
                <div class="pb-2 col-md-3">
                <div class="card pt-3">
                    <img class="mx-auto" src="'.asset('img/producto/'.$obj->foto).'"  height="70px" alt="producto"> 
                    <div class="card-body">
                    <h6 class="card-title">'.$obj->nombre.'</h6>
                    <p class="card-text">'.$obj->descripcion.'</p>
                    </div>
                </div>
                </div>';
                $seccion_prod.='</div>';
                $seccion_prod.='<div class="row pb-2">';  
            }
            else 
            {
                $seccion_prod.='
                <div class="pb-2 col-md-3">
                <div class="card pt-3">
                    <img class="mx-auto" src="'.asset('img/producto/'.$obj->foto).'"  height="70px" alt="producto"> 
                    <div class="card-body">
                    <h6 class="card-title">'.$obj->nombre.'</h6>
                    <p class="card-text">'.$obj->descripcion.'</p>
                    </div>
                </div>
                </div>';
            }    
        }
        $seccion_prod.='</div>';
        return view('web.producto',compact('seccion_prod'));
    }
    //pagina de marca del modo web
    public function marca()
    {
        $lista_marcas=Marca::TraerLista_Marca();

        //logica de las marcas
        $alfabeto = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z');        
        $seccion_marcas="";
        foreach ($alfabeto as $char)
        {  
            $ul1="";
            $ul2="";
            $ul3="";
            $flag=1;
            $letraok=false;
            foreach ($lista_marcas as $indice => $item)
            {
                $n=ucfirst($item->nombre);
                if (substr($n, 0, 1)==$char)
                { 
                    switch ($flag)
                    {
                        case 1:
                        $letraok=true; 
                        $ul1.='<li>'.$n.'</li>';
                        $flag=2;
                        break;
                        case 2:
                        $ul2.='<li>'.$n.'</li>';      
                        $flag=3;
                        break;
                        case 3:
                        $ul3.='<li>'.$n.'</li>'; 
                        $flag=1;
                        break;
                    }        
                    unset($lista_marcas[$indice]);
                }   
            }
            if ($letraok)
            {
                $seccion_marcas.='<h5>'.$char.'</h5>';
                $seccion_marcas.='<div class="row">';
                $seccion_marcas.='<div class="col-md-4">  <ul>'. $ul1.'</ul> </div>';
                $seccion_marcas.='<div class="col-md-4"> <ul>'. $ul2.'</ul> </div>';
                $seccion_marcas.='<div class="col-md-4"> <ul>'. $ul3.'</ul> </div>';
                $seccion_marcas.='</div>';
            }        

        }
        //
        return view('web.marca',compact('seccion_marcas'));
    }

    //pagina de contacto del modo web
    public function contacto()
    {
        return view('web.contacto');
    }

    //pagina acerca de del modo web
    public function acerca()
    {
        return view('web.acerca');
    }

    //pagina terminos de servicio del modo web
    public function terminos()
    {
        return view('web.terminos');
    }

    //pagina cookies del modo web
    public function cookies()
    {
        return view('web.cookies');
    }

    //pagina politicas de privacidad del modo web
    public function privacidad()
    {
        return view('web.privacidad');
    }

}