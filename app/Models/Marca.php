<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    static public function TraerLista_Marca()
    {
        return self::where('estado', '=', 'A')->orderBy('nombre', 'asc')->get();
    }
}
