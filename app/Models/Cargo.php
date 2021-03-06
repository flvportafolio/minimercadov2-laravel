<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Cargo extends Model
{
    use HasFactory;
    public $timestamps = false;


    static public function TraerLista_Cargo()
    {
        //$sql="select * from cargo where estado='A'";
        return self::where('estado', '=', 'A')->get();
    }

    static public function Insertar_Cargo($nombre,$descripcion)
    {
        //$sql="insert into cargo values(0,'".$this->nombre."','".$this->descripcion."',CURRENT_DATE(),CURRENT_TIME(),'A','')";
		$res=DB::insert("insert into cargos values(0,'".$nombre."','".$descripcion."',CURRENT_DATE(),CURRENT_TIME(),'A','')");
		if ($res)
        {
                $_lastid = DB::getPdo()->lastInsertId();
                $hash = sha1($_lastid);
                //$sql = "update cargo set hash = '".$this->hash."' where idCargo = ".$this->idCargo;
                $res = DB::update("update cargos set hash = '".$hash."' where idCargo = ".$_lastid);
        }
		return $res;
    }



    static public function Traer_Cargo($hash)
	{
        //$sql="select * from cargo where hash='".$this->hash."' and estado='A'";
        $datos=self::where('hash', $hash)->where('estado', 'A')->first();
		$res=false;
		if(!$datos==null)
		{			
			$res=true;
		}
        return [$datos->toArray(),$res];
	}


    static public function Modificar_Cargo($nombre,$descripcion,$hash)
	{
		//$sql="update cargo set nombre='".$this->nombre."',descripcion='".$this->descripcion."' where hash='".$this->hash."'";
		return self::where('hash', $hash)->update(['nombre' => $nombre,'descripcion' => $descripcion]);
    }
    


    static public function Borrar_Cargo($hash)
    {
        //$sql="update cargo set estado='I' where hash='".$this->hash."'";
		return self::where('hash', $hash)->update(['estado' => 'I']);// se debe poner el timestamp false para que no incluya en la actualizacion updated_at
    }
}
