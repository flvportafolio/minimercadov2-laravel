<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $lista=Marca::TraerLista_ModuloMarca();
        $table='
        <div class="table-responsive-md">
        <table class="table">
        <thead class="thead-light">
            <tr>               
            <th width="10%"scope="col">#</th>
            <th width="30%" scope="col">Representante de la Marca</th>
            <th width="40%" scope="col">Nombre de la Marca</th>
            <th width="20%" scope="col">Fecha y Hora de Creación</th>
            </tr>
        </thead>
        <tbody>
        ';
        $select_marcas='';
        $btn_status=($lista->isEmpty())?"disabled":"";
        foreach ($lista as $indice => $obj)
        {
            $indice+=1;
            $table.="<tr><td>$indice</td><td>".$obj->nombre." ".$obj->apellidoPaterno." ".$obj->apellidoMaterno."</td><td>".$obj->marca."</td><td>".$obj->fecha_registro." ".$obj->hora_registro."</td></tr>";
            $select_marcas.="<option value=".$obj->hash.">".$obj->marca."</option>";
        }
        $table.="</tbody></table></div>";
        $date_now=date("Y-m-d");

        return view('admin.marca',compact('table','btn_status','select_marcas','date_now'));
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
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        [$obj_Marca,$res]=Marca::Traer_Marca($request->hash);
        if($res)
        {
            echo json_encode($obj_Marca);
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
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $res=Marca::Borrar_Marca($request->hash);
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
