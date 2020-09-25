<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class SubCategoria extends Model
{
    use HasFactory;
    public $timestamps = false;

    static public function TraerLista_Subcategoria()
    {
        //$sql="select sc.nombre,sc.descripcion,c.nombre AS 'categoria',sc.fecha_registro,sc.hora_registro,sc.estado,sc.hash from subcategoria AS sc INNER JOIN categoria AS c ON c.idCategoria=sc.idCategoriaFK WHERE sc.estado='A'";
        return self::join('categorias', 'categorias.idCategoria', '=', 'sub_categorias.idCategoriaFK')
        ->select('sub_categorias.nombre', 'sub_categorias.descripcion', "categorias.nombre AS categoria", 'sub_categorias.fecha_registro', 'sub_categorias.hora_registro', 'sub_categorias.estado', 'sub_categorias.hash')
        ->where('sub_categorias.estado', '=', 'A')
        ->get();        		
		
    }



    static public function Traer_Subcategoria($hash)
    {
        //$sql="select sc.nombre,sc.descripcion,c.hash AS 'categoria',sc.fecha_registro,sc.hora_registro,sc.estado,sc.hash from subcategoria AS sc INNER JOIN categoria AS c ON c.idCategoria=sc.idCategoriaFK WHERE sc.hash='".$this->hash."' and sc.estado='A'";        
        $datos=self::join('categorias', 'categorias.idCategoria', '=', 'sub_categorias.idCategoriaFK')
        ->select('sub_categorias.nombre', 'sub_categorias.descripcion', "categorias.hash AS categoria", 'sub_categorias.fecha_registro', 'sub_categorias.hora_registro', 'sub_categorias.estado', 'sub_categorias.hash')
        ->where('sub_categorias.estado', '=', 'A')->where('sub_categorias.hash', $hash)
        ->first();
        //Si no hay registro, al usar first() me devolvera null
		$res=false;
		if(!$datos==null)
		{			
			$res=true;
		}
        return [$datos->toArray(),$res];
    }



    static public function Modificar_Subcategoria($nombre,$descripcion,$categoria,$hash)
    {
        $id_cat=DB::table('categorias')->where('hash', $categoria)->value('idCategoria');

        //$sql="update subcategoria set nombre='".$this->nombre."',descripcion='".$this->descripcion."',idCategoriaFK=".$this->idCategoriaFK->idCategoria." where hash='".$this->hash."'";			
        return self::where('hash', $hash)->update(['nombre' => $nombre,'descripcion' => $descripcion,'idCategoriaFK' => $id_cat]);		
    }



    static public function Borrar_Subcategoria($hash)
    {
        //$sql="update subcategoria set estado='I' where hash='".$this->hash."'";
        return self::where('hash', $hash)->update(['estado' => 'I']);// se debe poner el timestamp false para que no incluya en la actualizacion updated_at
    }
}
