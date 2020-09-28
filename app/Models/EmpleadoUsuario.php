<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class EmpleadoUsuario extends Model
{
		use HasFactory;
		
		static public function TraerLista_Empleadousuario()
		{
			//$sql="select p.nombre,p.apellidoPaterno,p.apellidoMaterno,c.nombre AS cargo,eu.ci,eu.fecha_registro,eu.hora_registro,eu.estado,eu.hash from empleadousuario AS eu INNER JOIN persona AS p ON p.idPersona=eu.idEmpleado INNER JOIN cargo AS c ON c.idCargo=eu.idCargoFK";		
			return self::from('empleado_usuarios AS eu')
			->select('p.nombre', 'p.apellidoPaterno','p.apellidoMaterno','c.nombre AS cargo','eu.ci','eu.fecha_registro','eu.hora_registro','eu.estado','eu.hash')
			->join('personas AS p', 'p.idPersona', '=', 'eu.idEmpleado')
			->join('cargos AS c', 'c.idCargo', '=', 'eu.idCargoFK')
			->get();			
		}

    static public function verificar($user,$password)
    {
        //verifica el logeo de un empleadousuario

      $key="minimarket2020";
      $row=DB::select("select e.idEmpleado,c.nombre AS 'cargo',e.hash from empleado_usuarios AS e INNER JOIN cargos AS c ON c.idCargo=e.idCargoFK where e.user=AES_ENCRYPT('$user','$key') and e.password=AES_ENCRYPT('$password','$key') and e.estado='A'");		
			$id=0;
			$dat=false;
			if(count($row)>0)
			{   
				$id=$row[0]->idEmpleado;
				$dataUser=array("hash"=>$row[0]->hash,"alias"=>$row[0]->cargo);
				$_SESSION["UsuarioRegistrado"]=$dataUser;
				$dat=true;			
			}
			return [$dat,$id];
    }
}
