<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_cat=Categoria::TraerLista_Categoria();

        $table_cats='
        <div class="table-responsive-md">
            <table class="table">
            <thead class="thead-light">
            <tr>               
                <th width="10%"scope="col">#</th>
                <th width="30%" scope="col">Nombre</th>
                <th width="40%" scope="col">Descripción</th>
                <th width="20%" scope="col">Fecha y Hora de Creación</th>
            </tr>
            </thead>
            <tbody>
        ';

        $select_items='';// se usa para generar: <option selected>Selecciona un Valor</option>
        $btn_status=($lista_cat->isEmpty())?"disabled":"";
        foreach ($lista_cat as $indice => $obj_c)
        {
            $indice+=1;
            $table_cats.="<tr><td>$indice</td><td>".$obj_c->nombre."</td><td>".$obj_c->descripcion."</td><td>".$obj_c->fecha_registro." ".$obj_c->hora_registro."</td></tr>";
            $select_items.="<option value=".$obj_c->hash.">".$obj_c->nombre."</option>";
        }
        $table_cats.="</tbody></table></div>";

        return view('admin.categoria',compact('table_cats','select_items','btn_status'));
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
        $res=Categoria::Insertar_Categoria($request->nombre,$request->descripcion);
        if($res)//se verifica que se inserte correctamente el usuariosistema.
        {
            return redirect()->route('categoria.index');
        }
        else
        {
            return redirect('admin/categoria?error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
        
        [$obj_Categoria,$res]=Categoria::Traer_Categoria($request->hash);
        if($res)
        {
            echo json_encode($obj_Categoria);
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
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $res=Categoria::Modificar_Categoria($request->nombre,$request->descripcion,$request->hash_hidden);
        if($res)//devuelve true si se modifico algun registro
        {
            return redirect()->route('categoria.index');
        }
        else
        {
            return redirect('admin/categoria?error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($hash)
    {
        $res=Categoria::Borrar_Categoria($hash);
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
