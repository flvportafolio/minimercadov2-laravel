<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Marca extends Model
{
    use HasFactory;
    public $timestamps = false;

    static public function TraerLista_Marca()
    {
        return self::where('estado', '=', 'A')->orderBy('nombre', 'asc')->get();
    }


    
    static function TraerLista_ModuloMarca()
	{
        //$sql="select p.nombre,p.apellidoPaterno,p.apellidoMaterno,m.nombre AS 'marca',m.fecha_registro,m.hora_registro,m.estado,m.hash from marca AS m INNER JOIN persona AS p ON p.idPersona =m.idMarca WHERE m.estado='A' ";		
        return self::from( 'marcas AS m' )->select('p.nombre','p.apellidoPaterno','p.apellidoMaterno','m.nombre AS marca','m.fecha_registro','m.hora_registro','m.estado','m.hash')
        ->join('personas AS p', 'm.idMarca', '=', 'p.idPersona')
        ->where('m.estado', 'A')->get();
    }    
    

    static public function Borrar_Marca($hash)
    {
        //$sql="update marca set estado='I' where hash='".$this->hash."'";
		return self::where('hash', $hash)->update(['estado' => 'I']);// se debe poner el timestamp false para que no incluya en la actualizacion updated_at
    }
}
