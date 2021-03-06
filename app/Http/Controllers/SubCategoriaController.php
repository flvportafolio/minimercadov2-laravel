<?php

namespace App\Http\Controllers;

use App\Models\SubCategoria;
use App\Models\Categoria;
use Illuminate\Http\Request;

class SubCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $lista_subcat=Subcategoria::TraerLista_Subcategoria();
        $table_subcat='
        <div class="table-responsive-md">
            <table class="table">
            <thead class="thead-light">
                <tr>               
                <th width="10%"scope="col">#</th>
                <th width="30%" scope="col">Nombre</th>
                <th width="20%" scope="col">Descripción</th>
                <th width="20%" scope="col">Categoria</th>
                <th width="20%" scope="col">Fecha y Hora de Creación</th>
                </tr>
            </thead>
            <tbody>
        ';
        $select_subcat='';
        $btn_status=($lista_subcat->isEmpty())?"disabled":"";
        foreach ($lista_subcat as $indice => $obj_subc)
        {
            $indice+=1;
            $table_subcat.="<tr><td>$indice</td><td>".$obj_subc->nombre."</td><td>".$obj_subc->descripcion."</td><td>".$obj_subc->categoria."</td><td>".$obj_subc->fecha_registro." ".$obj_subc->hora_registro."</td></tr>";
            $select_subcat.="<option value=".$obj_subc->hash.">".$obj_subc->nombre."</option>";
        }
        $table_subcat.="</tbody></table></div>";
        
        //logica de categoria
        $lista_cat=Categoria::TraerLista_Categoria();

        $select_cat='';
        foreach ($lista_cat as $indice => $obj)
        {
            $select_cat.="<option value=".$obj->hash.">".$obj->nombre."</option>";
        }

        return view('admin.subcategoria',compact('table_subcat','select_subcat','btn_status','select_cat'));
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
        $res=Subcategoria::Insertar_Subcategoria($request->nombre,$request->descripcion,$request->categoria);
        if($res)//se verifica que se inserte correctamente la subcategoria.
        {
            return redirect()->route('admin.subcategoria');
        }
        else
        {
            return redirect('admin/subcategoria?error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategoria  $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategoria $subCategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategoria  $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {                
        [$obj_Subcategoria,$res]=Subcategoria::Traer_Subcategoria($request->hash);
        if($res)
        {
            echo json_encode($obj_Subcategoria);
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
     * @param  \App\Models\SubCategoria  $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {        
        $res=Subcategoria::Modificar_Subcategoria($request->nombre,$request->descripcion,$request->categoria,$request->hash_hidden);
        if($res)//devuelve true si se modifico algun registro
        {
            return redirect()->route('admin.subcategoria');
        }
        else
        {
            return redirect('admin/subcategoria?error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategoria  $subCategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    
        $res=Subcategoria::Borrar_Subcategoria($request->hash);
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
