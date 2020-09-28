<?php

namespace App\Http\Controllers;
use App\Models\Persona;
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
        $nomb_img="default.svg";
        $ruta_img_perfil="img/perfil/";
        
        if ($request->hasFile('img'))//se verifica si se selecciona una imagen en el formulario
        {
            if(pathinfo($request->img->getClientOriginalName(), PATHINFO_EXTENSION)=="jpg")
            {
                $nomb_img="img-".date("Y-m-d-H-i-s").".jpg";
                copy($request->img->getPathName(),$ruta_img_perfil.$nomb_img);
            }
            else
            {
                if(pathinfo($request->img->getClientOriginalName(), PATHINFO_EXTENSION)=="png")
                {
                    $nomb_img="img-".date("Y-m-d-H-i-s").".png";
                    copy($request->img->getPathName(),$ruta_img_perfil.$nomb_img);
                }
            }
        }
        else 
        {//si no hay imagen seleccionada hago una copia de la imagen por default
            $nuevo_fichero = "img-".date("Y-m-d-H-i-s").".svg";
            if (!copy($ruta_img_perfil.$nomb_img, $ruta_img_perfil.$nuevo_fichero)) 
            {  
            }
            $nomb_img=$nuevo_fichero;
        }        

        [$res1,$idPersona]=Persona::Insertar_Persona($request->nombre, $request->app, $request->apm, $request->prof, $request->dir, $nomb_img, $request->fecha, $request->telf, $request->e_civil, $request->n_edu, $request->pais, $request->gen,$request->email,$request->estado);

        $res2=Marca::Insertar_Marca($request->marca,$request->estado,$idPersona);
        if(!($res1==false && $res2==false))//se verifica que se inserte correctamente la marca.
        {
            return redirect()->route('admin.marca');
        }
        else
        {
            return redirect('admin/marca?error');
        }
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
    public function update(Request $request)
    {
        $nomb_img=$request->foto_default; //foto
        $ruta_img_perfil="img/perfil/";

        if ($request->hasFile('img'))//se verifica si se selecciona una imagen en el formulario
        { 
            if(pathinfo($request->img->getClientOriginalName(),PATHINFO_EXTENSION)=="jpg")
            {
                unlink($ruta_img_perfil.$nomb_img);
                $nomb_img="img-".date("Y-m-d-H-i-s").".jpg";
                copy($request->img->getPathName(),$ruta_img_perfil.$nomb_img);
            }
            elseif(pathinfo($request->img->getClientOriginalName(),PATHINFO_EXTENSION)=="png")
            {
                unlink($ruta_img_perfil.$nomb_img);
                $nomb_img="img-".date("Y-m-d-H-i-s").".png";
                copy($request->img->getPathName(),$ruta_img_perfil.$nomb_img);
            }
        }
        
        $res1=Persona::Modificar_Persona($request->nombre, $request->app, $request->apm,$request->prof, $request->dir, $nomb_img, $request->fecha, $request->telf,$request->e_civil,$request->n_edu, $request->pais, $request->gen, $request->email, $request->estado, $request->hash_hidden);

        $res2=Marca::Modificar_Marca( $request->marca , $request->estado, $request->hash_hidden);
        
        if(!($res1==false && $res2==false))//se verifica que se modifique correctamente la marca
        {
            return redirect()->route('admin.marca');  
        }
        else
        {//si no se actualizo nada
            return redirect('admin/marca?warning');
        }
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
