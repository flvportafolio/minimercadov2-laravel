<?php

namespace App\Http\Controllers;

use App\Models\Logeo;
use Illuminate\Http\Request;

class LogeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $lista_logs=Logeo::TraerLista_Logeo();
        $tabla='
        <div class="table-responsive-md">
            <table class="table">
            <thead class="thead-light">
            <tr>               
                <th width="10%"scope="col">#</th>
                <th width="30%" scope="col">Nombre Completo</th>
                <th width="20%" scope="col">Intentos de Logeo</th>
                <th width="20%" scope="col">Fecha de Logeo</th>
                <th width="20%" scope="col">Hora de Logeo</th>
            </tr>
            </thead>
            <tbody>
        ';
        foreach ($lista_logs as $indice => $obj)
        {
            $indice+=1;
            $tabla.="<tr><td>$indice</td><td>".$obj->nombre." ".$obj->apellidoPaterno." ".$obj->apellidoMaterno."</td><td>".$obj->intentos."</td><td>".$obj->fechaLogeo."</td><td>".$obj->horaLogeo."</td></tr>";  
        } 
        $tabla.="</tbody></table></div>";

        return view('admin.logeo',compact('tabla','lista_logs'));
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
     * @param  \App\Models\Logeo  $logeo
     * @return \Illuminate\Http\Response
     */
    public function show(Logeo $logeo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logeo  $logeo
     * @return \Illuminate\Http\Response
     */
    public function edit(Logeo $logeo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logeo  $logeo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logeo $logeo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logeo  $logeo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logeo $logeo)
    {
        //
    }
}
