<?php

namespace App\Http\Controllers;
session_start();

use App\Models\UsuarioSistema;
use App\Models\EmpleadoUsuario;
use App\Models\Logeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(isset($_SESSION["UsuarioRegistrado"]))//se verifica si esta logeado
        {
            return view('admin.index');
        }
        else
        {
            return redirect('admin/login');
        }
        
    }

    public function login()
    {   
        if(isset($_SESSION["UsuarioRegistrado"])){return redirect('admin');}
        //se muestra el formulario de logeo  

        //verificar si existe un mensaje para visualizar
        $msg=(isset($_SESSION["spam_message"]))?  $_SESSION["spam_message"]: "";
        $notif_script="";
        if($msg!="")//si existe un mensaje se lo muestra
        {
            $notif_script="<script>OpenMsg('$msg')</script>";
            $_SESSION["spam_message"]=null;

        }
        return view('admin.login',compact('notif_script'));
    }

    public function checkdata(Request $request)
    {//se verifican los credenciales de acceso
        
        if (!isset($_SESSION["intentos"])) // si no hay intentos de logeo anteriores, se crea uno.
        {
            $_SESSION["intentos"]=1;
        }
        
        $user=str_replace("'","",$request->user);
        $pass=str_replace("'","",$request->pass);
                
        [$res,$id]=Usuariosistema::verificar($user,$pass);
        if($res)//si se verifica exitosamente al usuarioSistema se registra el logeo y se muestra el panel de administracion
        {            
            $res=Logeo::registrar_logeo($_SESSION["intentos"],$id);
            $_SESSION["intentos"]=null;
            return redirect('admin');
        }
        else //se verifica al EmpleadoUsuario y si es correcto se registra el logeo y se muestra el panel de administracion
        {                           
            [$res,$id]=Empleadousuario::verificar($user,$pass);
            if($res)
            {
                $res=Logeo::registrar_logeo($_SESSION["intentos"],$id);
                $_SESSION["intentos"]=null;
                return redirect("admin"); 
                //por el momento un usuarioEmpleado tiene accesso al panel administrador

            }
            else //si los credenciales son incorrectos mostramos en la pagina de login un mensaje de error.
            {
                $_SESSION["spam_message"]="Los datos de acceso son incorrectos, Intente Nuevamente.";
                $_SESSION["intentos"]=$_SESSION["intentos"]+1;
                return redirect("admin/login"); 
            }                
        }

        // ver https://laravel.com/docs/8.x/authentication#authenticating-users
    }
    public function logout()
    {   // si hay alguien que quiere cerrar sesion, se la cierra.

        $_SESSION["UsuarioRegistrado"]=null;
        return redirect('admin');


        /* $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/login'); */
    }
}
