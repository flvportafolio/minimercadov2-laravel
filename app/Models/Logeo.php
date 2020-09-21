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
    
}
