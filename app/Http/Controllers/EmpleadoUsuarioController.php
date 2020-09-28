<?php

namespace App\Http\Controllers;

use App\Models\EmpleadoUsuario;
use App\Models\Persona;
use Illuminate\Http\Request;

class EmpleadoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    
        $user=str_replace("'","",(trim($request->user)));
        $password=str_replace("'","",(trim($request->pass)));
    
        [$res1,$idPersona]=Persona::Insertar_Persona($request->nombre, $request->app, $request->apm, $request->prof, $request->dir, $nomb_img, $request->fecha, $request->telf, $request->e_civil, $request->n_edu, $request->pais, $request->gen,$request->email,$request->estado);

        $res2=Empleadousuario::Insertar_Empleadousuario($request->cargo,$request->ci, $user, $password,$request->estado,$idPersona);
        if(!($res1==false && $res2==false))//se verifica que se inserte correctamente el usuarioempleado.
        {
            return redirect()->route('admin.usuario');   
        }
        else
        {
            return redirect('admin/usuario#error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmpleadoUsuario  $empleadoUsuario
     * @return \Illuminate\Http\Response
     */
    public function show(EmpleadoUsuario $empleadoUsuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmpleadoUsuario  $empleadoUsuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        [$obj_Emp,$res]=Empleadousuario::Traer_Empleadousuario($request->hash);
        if($res)
        {
            echo json_encode($obj_Emp);
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
     * @param  \App\Models\EmpleadoUsuario  $empleadoUsuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $nomb_img=$request->foto_default;
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

        $user=str_replace("'","",(trim($request->user)));
        $password=str_replace("'","",(trim($request->pass)));

        $res1=Persona::Modificar_Persona($request->nombre, $request->app, $request->apm,$request->prof, $request->dir, $nomb_img, $request->fecha, $request->telf,$request->e_civil,$request->n_edu, $request->pais, $request->gen, $request->email, $request->estado, $request->hash_hidden);

        $res2=Empleadousuario::Modificar_Empleadousuario($request->ci, $user, $password, $request->cargo, $request->estado, $request->hash_hidden);
        if(!($res1==false && $res2==false))//se verifica que se modifique correctamente el EmpleadoUsuario
        {
            return redirect()->route('admin.usuario');  
        }
        else
        {
            return redirect('admin/usuario?error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmpleadoUsuario  $empleadoUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpleadoUsuario $empleadoUsuario)
    {
        //
    }
}
