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
        //return self::orderBy('idProducto', 'desc')->take(8)->get();        
        return DB::select("select prod.nombre,prod.descripcion,prod.foto,sc.nombre AS 'subcategoria',m.nombre AS 'marca',prod.fecha_registro,prod.hora_registro,prod.estado,prod.hash from productos as prod inner JOIN sub_categorias AS sc ON sc.idSubCategoria=prod.idSubCategoriaFK INNER JOIN marcas AS m ON m.idMarca=prod.idMarcaFK where prod.estado='A' Order BY prod.idProducto DESC LIMIT 8");
    }
    static function TraerLista_Prod_Subcat()
    {
        return DB::select("select COUNT(*) AS 'cantidad_productos',c.nombre AS 'nombre_categoria',s.nombre AS 'nombre_subcategoria' FROM productos AS p INNER JOIN sub_categorias AS s ON s.idSubCategoria=p.idSubCategoriaFK INNER JOIN categorias AS c ON c.idCategoria=s.idCategoriaFK WHERE p.estado='A' GROUP BY nombre_categoria,nombre_subcategoria ORDER BY nombre_categoria ASC");
    }

    /* function TraerLista_UltimosProductos()//modulo web antiguo
	{
		$sql="select p.nombre AS 'nombre_prod',p.descripcion,p.foto,sc.nombre AS 'nombre_subcat',m.nombre AS 'nombre_marca' FROM producto AS p inner join subcategoria AS sc ON sc.idSubCategoria=p.idSubCategoriaFK inner join marca AS m ON m.idMarca=p.idMarcaFK WHERE p.estado='A' Order BY p.idProducto DESC LIMIT 8";
		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			do{
				$obj=new $this;
				$obj->nombre=$row["nombre_prod"];
				$obj->descripcion=$row["descripcion"];
				$obj->foto=$row["foto"];

				$obj->idSubCategoriaFK->nombre=$row["nombre_subcat"];
				$obj->idMarcaFK->nombre=$row["nombre_marca"];
				
        $lista[]=$obj;
			}while($row=mysqli_fetch_array($res));
		}
    return $lista;
	} */
    /* function TraerLista_UltimosProductos()//modulo admin
	{
		$sql="select prod.nombre,prod.descripcion,prod.foto,sc.nombre AS 'subcategoria',m.nombre AS 'marca',prod.fecha_registro,prod.hora_registro,prod.estado,prod.hash from producto as prod inner JOIN subcategoria AS sc ON sc.idSubCategoria=prod.idSubCategoriaFK INNER JOIN marca AS m ON m.idMarca=prod.idMarcaFK where prod.estado='A' Order BY prod.idProducto DESC LIMIT 10";
		$res=$this->Execute($sql);
		$lista=array();
		if(mysqli_num_rows($res)>0)
		{
			$row=mysqli_fetch_array($res);
			do{
				$obj=new $this;
				$obj->nombre=$row["nombre"];
				$obj->descripcion=$row["descripcion"];
				$obj->foto=$row["foto"];

				$obj->idSubCategoriaFK->nombre=$row["subcategoria"];
				$obj->idMarcaFK->nombre=$row["marca"];

				$obj->fecha_registro=$row["fecha_registro"];
				$obj->hora_registro=$row["hora_registro"];
				$obj->estado=$row["estado"];
				$obj->hash=$row["hash"];
        $lista[]=$obj;
			}while($row=mysqli_fetch_array($res));
		}
    return $lista;
	} */



    /*
        Úse $this para referirse al objeto actual. 
        Úse self para referirse a la clase actual.
        
        En otras palabras, utilícelo $this->member para miembros no estáticos
        y utilíce self::$member para miembros estáticos.
    */
    //return DB::select("select COUNT(*) AS 'cantidad_productos',c.nombre AS 'nombre_categoria',s.nombre AS 'nombre_subcategoria' FROM productos AS p INNER JOIN sub_categorias AS s ON s.idSubCategoria=p.idSubCategoriaFK INNER JOIN categorias AS c ON c.idCategoria=s.idCategoriaFK WHERE p.estado='A' GROUP BY nombre_categoria,nombre_subcategoria ORDER BY nombre_categoria ASC");
}
