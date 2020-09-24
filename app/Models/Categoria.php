<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Categoria extends Model
{
    use HasFactory;
    public $timestamps = false;

    static public function Insertar_Categoria($nombre,$descripcion)
    {
        //$sql="insert into categoria values(0,'".$this->nombre."','".$this->descripcion."',CURRENT_DATE(),CURRENT_TIME(),'A','')";
        $res=DB::insert("insert into categorias values(0,'".$nombre."','".$descripcion."',CURRENT_DATE(),CURRENT_TIME(),'A','')");
		if ($res)
        {
            $_lastid = DB::getPdo()->lastInsertId();
            $hash = sha1($_lastid);
            //$sql = "update categoria set hash = '".$this->hash."' where idCategoria = ".$this->idCategoria;
            $res = DB::update("update categorias set hash = '".$hash."' where idCategoria = ".$_lastid);
        }
		return $res;
    }

    
    static public function TraerLista_Categoria()
    {
        //$sql="select * from categoria where estado='A'";
        return self::where('estado', '=', 'A')->get();
    }


    static public function Traer_Categoria($hash)
    {
        //$sql="select * from categoria where hash='".$this->hash."' and estado='A'";
        $datos=self::where('hash', $hash)->where('estado', 'A')->first();		//Si no hay registro, al usar first() me devolvera null
		$res=false;
		if(!$datos==null)
		{			
			$res=true;
		}
        return [$datos->toArray(),$res];
    }


    static public function Modificar_Categoria($nombre,$descripcion,$hash)
    {
        //$sql="update categoria set nombre='".$this->nombre."',descripcion='".$this->descripcion."' where hash='".$this->hash."'";
		return self::where('hash', $hash)->update(['nombre' => $nombre,'descripcion' => $descripcion]);
    }

    static public function Borrar_Categoria($hash)
    {
        //$sql="update categoria set estado='I' where hash='".$hash."'";
        return self::where('hash', $hash)->update(['estado' => 'I']);// se debe poner el timestamp false para que no incluya en la actualizacion updated_at
    }    
}
