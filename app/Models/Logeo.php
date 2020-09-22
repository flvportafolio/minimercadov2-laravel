<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Logeo extends Model
{
    use HasFactory;
    static public function registrar_logeo($intentos,$idPersona)
    {
      $res=DB::insert("insert into logeos values(0,".$idPersona.",$intentos,CURRENT_DATE(),CURRENT_TIME(),'A','')");	  
      if ($res)
      {
          $_lastid = DB::getPdo()->lastInsertId();
          $hash = sha1($_lastid);
          $res = DB::update("Update logeos set hash = '$hash' where idLogeo = ".$_lastid);
      }
		  return $res;
    }


    static public function TraerLista_Logeo()
    {
      //return DB::select("select p.nombre,p.apellidoPaterno,p.apellidoMaterno,l.intentos,l.fechaLogeo,l.horaLogeo from logeos AS l INNER JOIN personas AS p ON p.idPersona=l.idUsuarioFK WHERE l.estado ='A'");      

      return DB::table('logeos')
        ->join('personas', 'logeos.idUsuarioFK', '=', 'personas.idPersona')
        ->select('personas.nombre', 'personas.apellidoPaterno', 'personas.apellidoMaterno', 'logeos.intentos', 'logeos.fechaLogeo', 'logeos.horaLogeo')
        ->paginate(10);
    }


    static public function TraerLista_UltimosLogeados()
    {     
      return DB::select("select p.nombre,p.apellidoPaterno,p.apellidoMaterno,l.intentos,l.fechaLogeo,l.horaLogeo from logeos AS l INNER JOIN personas AS p ON p.idPersona=l.idUsuarioFK WHERE l.estado ='A' Order BY l.idLogeo DESC LIMIT 10");
    }
    
}
