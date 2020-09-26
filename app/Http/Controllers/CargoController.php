<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_cargo=Cargo::TraerLista_Cargo();
        $tabla='
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
        $select_items='';// <option selected>Selecciona un Valor</option>
        $btn_status=($lista_cargo->isEmpty())?"disabled":"";
        foreach ($lista_cargo as $indice => $obj)
        {
        $indice+=1;
        $tabla.="<tr><td>$indice</td><td>".$obj->nombre."</td><td>".$obj->descripcion."</td><td>".$obj->fecha_registro." ".$obj->hora_registro."</td></tr>";
        $select_items.="<option value=".$obj->hash.">".$obj->nombre."</option>";
        }
        $tabla.="</tbody></table></div>";
        return view('admin.cargo',compact('tabla','select_items','btn_status'));
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
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function show(Cargo $cargo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function edit(Cargo $cargo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cargo $cargo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cargo $cargo)
    {
        //
    }
}
