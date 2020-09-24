<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Subcategoria;
use App\Models\Marca;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //logica para subcategoria
        $lista_subcat=Subcategoria::TraerLista_Subcategoria();
        $select_subcat="";
         foreach ($lista_subcat as $indice => $obj)
        {
            $select_subcat.="<option value=".$obj->hash.">".$obj->nombre."</option>";
        } 
        //

        //logica para marca
        $lista_marca=Marca::TraerLista_Marca();
        $select_marca="";
        foreach ($lista_marca as $indice => $obj)
        {
            $select_marca.="<option value=".$obj->hash.">".$obj->nombre."</option>";
        }
        //

        $lista_prod=Producto::TraerLista_Producto();
        $table_prod='
        <div class="table-responsive-md">
            <table class="table">
            <thead class="thead-light">
            <tr>               
                <th width="5%" scope="col">#</th>
                <th width="10%" scope="col">Foto</th>
                <th width="20%" scope="col">Nombre</th>
                <th width="25%" scope="col">Descripción</th>
                <th width="10%" scope="col">Subcategoria</th>
                <th width="10%" scope="col">Marca</th>
                <th width="20%" scope="col">Fecha y Hora de Creación</th>
            </tr>
            </thead>
            <tbody>
        ';
        $select_prod='';
        $btn_status=($lista_prod->isEmpty())?"disabled":"";
        foreach ($lista_prod as $indice => $obj)
        {
            $indice+=1;
            $table_prod.="<tr><td>$indice</td><td><img src=' ".asset('img/producto/'.$obj->foto)." ' width='64px' height='64px' alt='producto'></td><td>".$obj->nombre."</td><td>".$obj->descripcion."</td><td>".$obj->subcategoria."</td><td>".$obj->marca."</td><td>".$obj->fecha_registro." ".$obj->hora_registro."</td></tr>";
            $select_prod.="<option value=".$obj->hash.">".$obj->nombre."</option>";
        }
        $table_prod.="</tbody></table></div>";


        return view('admin.producto',compact('table_prod','select_subcat','select_marca','select_prod','btn_status'));
    }


    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {        
        [$obj_Producto,$res]=Producto::Traer_Producto($request->hash);
        if($res)
        {
            echo json_encode($obj_Producto);
        }
        else
        {
            echo "error";
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    { //investiar request imagenes en laravel

         $nomb_img=$request->foto_default; //foto
        /*$ruta_img_perfil="public/img/producto/";//$ruta_img_perfil="vista/img/producto/";
        //si no se selecciona una imagen en el formulario, el valor de: pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION) es ""  
        if(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION)=="jpg")
        { 
            unlink($ruta_img_perfil.$nomb_img);
            $nomb_img="img-".date("Y-m-d-H-i-s").".jpg";
            copy($_FILES["img"]["tmp_name"],$ruta_img_perfil.$nomb_img);
        }
        elseif(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION)=="png")
        { 
            unlink($ruta_img_perfil.$nomb_img);
            $nomb_img="img-".date("Y-m-d-H-i-s").".png";
            copy($_FILES["img"]["tmp_name"],$ruta_img_perfil.$nomb_img);
        }*/

        $res=Producto::Modificar_Producto($request->nombre, $request->descripcion, $nomb_img, $request->subcategoria, $request->marca, $request->hash_hidden);
        if($res)//se verifica que se modifique correctamente el producto.
        {
            return redirect()->route('producto.index');
        }
        else
        {
            return redirect('admin/producto?error');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $res=Producto::Borrar_Producto($request->hash);
        if($res)
        {
          echo "ok";
        }
        else
        {
          echo "error al borrar";
        }
    }
}
