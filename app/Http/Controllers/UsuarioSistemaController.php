<?php

namespace App\Http\Controllers;

use App\Models\UsuarioSistema;
use App\Models\Persona;
use App\Models\Empleadousuario;
use App\Models\Cargo;
use Illuminate\Http\Request;

class UsuarioSistemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_UsuarioSistema=UsuarioSistema::TraerLista_Usuariosistema();
        $lista_empl=Empleadousuario::TraerLista_Empleadousuario();
        $lista_cargos=Cargo::TraerLista_Cargo();

        $select_items="";
        $select_emp="";

        $btn_status=($lista_UsuarioSistema->isEmpty())? "disabled":"";
        $btn_status_emp=($lista_empl->isEmpty())? "disabled":"";

        foreach ($lista_UsuarioSistema as $indice => $obj)
        {
            $select_items.="<option value=".$obj->hash.">".$obj->alias."</option>";
        }

        foreach ($lista_empl as $indice => $obj)
        {
            $select_emp.="<option value=".$obj->hash.">".$obj->nombre." ".$obj->apellidoPaterno." ".$obj->apellidoMaterno."</option>";
        }

        $select_cargos="";
        foreach ($lista_cargos as $indice => $obj)
        {
            $select_cargos.="<option value=".$obj->hash.">".$obj->nombre."</option>";
        }

        $lista_US_EU=Persona::TraerPersonas_US_EU();//usamos idUsuario para hacer uso de los metodos de la clase Persona de manera generica
        $table_US_EU='
        <div class="table-responsive-md">
            <table class="table">
            <thead class="thead-light">
            <tr>               
                <th scope="col">#</th>
                <th scope="col">Foto</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col">Genero</th>
                <th scope="col">Fecha de Nacimiento</th>
                <th scope="col">Pais de Origen</th>
                <th scope="col">Direccion</th>
                <th scope="col">Correo</th>
                <th scope="col">Fecha y Hora de Creación</th>
            </tr>
            </thead>
            <tbody>
        ';
        foreach ($lista_US_EU as $indice => $obj)
        {
            $indice+=1;
            $table_US_EU.="<tr><td>$indice</td><td><img src='".asset('img/perfil/'.$obj->foto)."' width='64px' height='64px' alt='imagen de perfil'></td><td>".$obj->nombre."</td><td>".$obj->apellidoPaterno."</td><td>".$obj->apellidoMaterno."</td><td>".$obj->genero."</td><td>".$obj->fecha_nac."</td><td>".$obj->pais_nac."</td><td>".$obj->direccion."</td><td>".$obj->correo."</td><td>".$obj->fecha_registro." ".$obj->hora_registro."</td></tr>";
        }
        $table_US_EU.="</tbody></table></div>";
        $date_now=date("Y-m-d");

        return view('admin.usuario',compact('table_US_EU','date_now','select_cargos','select_items','btn_status','select_emp','btn_status_emp'));
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

        $res2=Usuariosistema::Insertar_Usuariosistema($request->alias, $user, $password, $request->estado, $idPersona);
        if(!($res1==false && $res2==false))//se verifica que se inserte correctamente el usuariosistema.
        {
            return redirect()->route('admin.usuario');  
        }
        else
        {
            return redirect('admin/usuario?error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsuarioSistema  $usuarioSistema
     * @return \Illuminate\Http\Response
     */
    public function show(UsuarioSistema $usuarioSistema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsuarioSistema  $usuarioSistema
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {        
        [$obj_UsuarioS,$res]=Usuariosistema::Traer_UsuarioSistema($request->hash);
        if($res)
        {
            echo json_encode($obj_UsuarioS);
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
     * @param  \App\Models\UsuarioSistema  $usuarioSistema
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

        $res2=Usuariosistema::Modificar_Usuariosistema($request->alias, $user, $password, $request->estado, $request->hash_hidden);
        if(!($res1==false && $res2==false))//se verifica que se modifique correctamente el UsuarioSistema
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
     * @param  \App\Models\UsuarioSistema  $usuarioSistema
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsuarioSistema $usuarioSistema)
    {
        //
    }
}
