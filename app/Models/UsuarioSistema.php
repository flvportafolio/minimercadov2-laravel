<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class UsuarioSistema extends Model
{
		use HasFactory;
		public $timestamps = false;

		
		static public function Insertar_Usuariosistema($alias,$user, $password, $estado,$idPersona)
		{
			$key="minimarket2020";	
				//$sql = "insert into usuariosistema values(".$this->idUsuario->idPersona.",'$this->alias', AES_ENCRYPT('$this->user','$key'), AES_ENCRYPT('$this->password','$key'),CURRENT_DATE(),CURRENT_TIME(),'$this->estado',SHA1(".$this->idUsuario->idPersona."))";
				$res=DB::insert("insert into usuario_sistemas values(".$idPersona.",'".$alias."',AES_ENCRYPT('$user','$key'),AES_ENCRYPT('$password','$key'),CURRENT_DATE(),CURRENT_TIME(),'$estado',SHA1(".$idPersona."))");
				return $res;      
		}


		static public function TraerLista_Usuariosistema()
		{
			//$sql="select alias,fecha_registro,hora_registro,estado,hash from usuariosistema";
			return self::select('alias','fecha_registro','hora_registro','estado','hash')->get();	
		}



		static public function Traer_UsuarioSistema($hash)
		{
			$key="minimarket2020";
			//$sql="select p.nombre,p.apellidoPaterno,p.apellidoMaterno,p.profesion,p.direccion,p.foto,p.fecha_nac,p.telefono,p.estado_civil,p.nivel_educ,p.pais_nac,p.genero,p.correo,us.alias,us.estado,AES_DECRYPT(us.user,'$key') as user,AES_DECRYPT(us.password,'$key') as password from usuariosistema as us inner join persona as p on p.idPersona=us.idUsuario where us.hash='".$this->hash."'";
			
			$datos=self::from('usuario_sistemas as us')->select('p.nombre','p.apellidoPaterno','p.apellidoMaterno','p.profesion','p.direccion','p.foto','p.fecha_nac','p.telefono','p.estado_civil','p.nivel_educ','p.pais_nac','p.genero','p.correo','us.alias','us.estado',DB::raw("AES_DECRYPT(us.user,'$key') as user"),DB::raw("AES_DECRYPT(us.password,'$key') as password"))
			->join('personas as p', 'p.idPersona', '=', 'us.idUsuario')		
			->where('us.hash', $hash)->first();

			$res=false;
			if(!$datos==null)
			{			
				$res=true;
			}
			return [$datos->toArray(),$res];
		}


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


		static public function Modificar_Usuariosistema($alias, $user, $password, $estado, $hash)
		{
			$key="minimarket2020";			
			//$sql="update usuariosistema set alias='".$this->alias."',user=AES_ENCRYPT('".$this->user."','$key'),password=AES_ENCRYPT('$this->password','$key'),estado='".$this->estado."' where hash='".$this->hash."'";
			return self::where('hash', $hash)->update(['alias' => $alias,'user' =>  DB::raw("AES_ENCRYPT('".$user."','$key')"),'password' => DB::raw("AES_ENCRYPT('$password','$key')"),'estado' => $estado]);				
		}


}
