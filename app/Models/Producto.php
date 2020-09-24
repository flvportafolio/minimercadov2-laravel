<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Producto extends Model
{
		use HasFactory;
		public $timestamps = false;
		static public function TraerLista_Producto()//se usa en el modulo admin
    {								
				$sql="select prod.nombre,prod.descripcion,prod.foto,sc.nombre AS 'subcategoria',m.nombre AS 'marca',prod.fecha_registro,prod.hora_registro,prod.estado,prod.hash from producto as prod inner JOIN subcategoria AS sc ON sc.idSubCategoria=prod.idSubCategoriaFK INNER JOIN marca AS m ON m.idMarca=prod.idMarcaFK where prod.estado='A'";

				return self::select('productos.nombre', 'productos.descripcion','productos.foto','sub_categorias.nombre AS subcategoria','marcas.nombre AS marca','productos.fecha_registro','productos.hora_registro','productos.estado','productos.hash')
					->join('sub_categorias', 'productos.idSubCategoriaFK', '=', 'sub_categorias.idSubCategoria')
					->join('marcas', 'productos.idMarcaFK', '=', 'marcas.idMarca')
					->where('productos.estado', 'A')
					->get();											
		}

		

    static public function TraerLista_Producto_asc()// se usa en el modulo web
    {
        return self::where('estado', '=', 'A')->orderBy('nombre', 'asc')->get();
		}


		static public function Traer_Producto($hash)
		{
			//$sql="select prod.nombre,prod.descripcion,prod.foto,sc.hash AS 'subcategoria',m.hash AS 'marca',prod.fecha_registro,prod.hora_registro,prod.estado,prod.hash from producto as prod inner JOIN subcategoria AS sc ON sc.idSubCategoria=prod.idSubCategoriaFK INNER JOIN marca AS m ON m.idMarca=prod.idMarcaFK where prod.estado='A' and prod.hash='".$this->hash."'";
			$datos=self::from( 'productos as prod' )->select('prod.nombre','prod.descripcion','prod.foto','sc.hash AS subcategoria','m.hash AS marca','prod.fecha_registro','prod.hora_registro','prod.estado','prod.hash')
					->join('sub_categorias AS sc', 'prod.idSubCategoriaFK', '=', 'sc.idSubCategoria')		
					->join('marcas as m', 'prod.idMarcaFK', '=', 'm.idMarca')
					->where('prod.hash', $hash)->where('prod.estado', 'A')->first();

			$res=false;
			if(!$datos==null)
			{			
				$res=true;
			}
			return [$datos->toArray(),$res];
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


		static public function Modificar_Producto($nombre, $descripcion, $nomb_img, $subcategoria, $marca, $hash_hidden)
		{
			/* $res=false;
			if($this->idSubCategoriaFK->EstablecerId() && $this->idMarcaFK->EstablecerId()) //si se logra establecer el idSubCategoria y idMarca, se procede a modificar el registro
			{
				$sql="update producto set nombre='".$this->nombre."',descripcion='".$this->descripcion."',foto='".$this->foto."',idSubCategoriaFK=".$this->idSubCategoriaFK->idSubCategoria.",idMarcaFK=".$this->idMarcaFK->idMarca." where hash='".$this->hash."'";
				$res=$this->Execute($sql);//retorna 1 que equivale a true.
				if(mysqli_affected_rows($this->getCon())>0)//se verifica si hay un registro actualizado
				{
					$res=true;
				}
			}
			return $res; */
		}



		static public function Borrar_Producto($hash)
		{
			//$sql="update producto set estado='I' where hash='".$this->hash."'";
			return self::where('hash', $hash)->update(['estado' => 'I']);// se debe poner el timestamp false para que no incluya en la actualizacion updated_at
		}


		
    /*
        Úse $this para referirse al objeto actual. 
        Úse self para referirse a la clase actual.
        
        En otras palabras, utilícelo $this->member para miembros no estáticos
        y utilíce self::$member para miembros estáticos.
    */
    //return DB::select("select COUNT(*) AS 'cantidad_productos',c.nombre AS 'nombre_categoria',s.nombre AS 'nombre_subcategoria' FROM productos AS p INNER JOIN sub_categorias AS s ON s.idSubCategoria=p.idSubCategoriaFK INNER JOIN categorias AS c ON c.idCategoria=s.idCategoriaFK WHERE p.estado='A' GROUP BY nombre_categoria,nombre_subcategoria ORDER BY nombre_categoria ASC");
}
