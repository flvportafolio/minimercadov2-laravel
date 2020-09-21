<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class UsuarioSistema extends Model
{
    use HasFactory;
    static public function verificar($user,$password)
    {        
        //verifica el logeo de un usuariosistema

        $key="minimarket2020";
        $row=DB::select("select * from usuario_sistemas where user=AES_ENCRYPT('$user','$key') and password=AES_ENCRYPT('$password','$key') and estado='A'");	
        $id=0;
        $dat=false;        
		if(count($row)>0)
		{   			
			$id=$row[0]->idUsuario;//hago pasar idUsuario como un integer
			$dataUser=array("hash"=>$row[0]->hash,"alias"=>$row[0]->alias);
			$_SESSION["UsuarioRegistrado"]=$dataUser;
			$dat=true;			
		}
		return [$dat,$id];
    }
    static public function Traer_Datos_MenuPrincipal()
	{
        //$sql="select ( SELECT COUNT(*) FROM producto WHERE producto.estado='A') AS total_prod, ( SELECT COUNT(*) FROM categoria WHERE categoria.estado='A') AS total_cat, ( SELECT COUNT(*) FROM subcategoria WHERE subcategoria.estado='A') AS total_subcat , ( SELECT COUNT(*) FROM marca WHERE marca.estado='A') AS total_marca ";
        $row=DB::select("select ( SELECT COUNT(*) FROM productos WHERE productos.estado='A') AS total_prod, ( SELECT COUNT(*) FROM categorias WHERE categorias.estado='A') AS total_cat, ( SELECT COUNT(*) FROM sub_categorias WHERE sub_categorias.estado='A') AS total_subcat , ( SELECT COUNT(*) FROM marcas WHERE marcas.estado='A') AS total_marca");
		$lista=array();
		if(count($row)>0)
		{
			$lista=array("total_productos"=>$row[0]->total_prod,"total_categorias"=>$row[0]->total_cat,"total_subcategorias"=>$row[0]->total_subcat,"total_marcas"=>$row[0]->total_marca);
		}
		return $lista;
	}    
}
