<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    public $timestamps = false;


    static public function TraerLista_Cargo()
    {
        //$sql="select * from cargo where estado='A'";
        return self::where('estado', '=', 'A')->get();
    }


    static public function Borrar_Cargo($hash)
    {
        //$sql="update cargo set estado='I' where hash='".$this->hash."'";
		return self::where('hash', $hash)->update(['estado' => 'I']);// se debe poner el timestamp false para que no incluya en la actualizacion updated_at
    }
}
