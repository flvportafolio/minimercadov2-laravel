<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Producto extends Model
{
    use HasFactory;
    static public function TraerLista_Producto()
    {
        return self::where('estado', '=', 'A')->orderBy('nombre', 'asc')->get();
    }
    static function TraerLista_UltimosProductos()//devuelve los ultimos 8 registros insertados.
    {
        return self::orderBy('idProducto', 'desc')->take(8)->get();
    }
    static function TraerLista_Prod_Subcat()
    {
        return DB::select("select COUNT(*) AS 'cantidad_productos',c.nombre AS 'nombre_categoria',s.nombre AS 'nombre_subcategoria' FROM productos AS p INNER JOIN sub_categorias AS s ON s.idSubCategoria=p.idSubCategoriaFK INNER JOIN categorias AS c ON c.idCategoria=s.idCategoriaFK WHERE p.estado='A' GROUP BY nombre_categoria,nombre_subcategoria ORDER BY nombre_categoria ASC");
    }
    /*
        Úse $this para referirse al objeto actual. 
        Úse self para referirse a la clase actual.
        
        En otras palabras, utilícelo $this->member para miembros no estáticos
        y utilíce self::$member para miembros estáticos.
    */
    //return DB::select("select COUNT(*) AS 'cantidad_productos',c.nombre AS 'nombre_categoria',s.nombre AS 'nombre_subcategoria' FROM productos AS p INNER JOIN sub_categorias AS s ON s.idSubCategoria=p.idSubCategoriaFK INNER JOIN categorias AS c ON c.idCategoria=s.idCategoriaFK WHERE p.estado='A' GROUP BY nombre_categoria,nombre_subcategoria ORDER BY nombre_categoria ASC");
}
