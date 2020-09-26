<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    static public function TraerLista_Cargo()
    {
        //$sql="select * from cargo where estado='A'";
        return self::where('estado', '=', 'A')->get();
    }
}
