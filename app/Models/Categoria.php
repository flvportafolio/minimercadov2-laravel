<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    static public function TraerLista_Categoria()
    {
        //$sql="select * from categoria where estado='A'";
        return self::where('estado', '=', 'A')->get();
    }
}
