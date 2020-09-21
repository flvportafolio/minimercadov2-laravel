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
}
