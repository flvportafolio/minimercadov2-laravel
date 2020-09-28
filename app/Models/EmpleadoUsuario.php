<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class EmpleadoUsuario extends Model
{
		use HasFactory;
		public $timestamps = false;
		
		static public function TraerLista_Empleadousuario()
		{
			//$sql="select p.nombre,p.apellidoPaterno,p.apellidoMaterno,c.nombre AS cargo,eu.ci,eu.fecha_registro,eu.hora_registro,eu.estado,eu.hash from empleadousuario AS eu INNER JOIN persona AS p ON p.idPersona=eu.idEmpleado INNER JOIN cargo AS c ON c.idCargo=eu.idCargoFK";		
			return self::from('empleado_usuarios AS eu')
			->select('p.nombre', 'p.apellidoPaterno','p.apellidoMaterno','c.nombre AS cargo','eu.ci','eu.fecha_registro','eu.hora_registro','eu.estado','eu.hash')
			->join('personas AS p', 'p.idPersona', '=', 'eu.idEmpleado')
			->join('cargos AS c', 'c.idCargo', '=', 'eu.idCargoFK')
			->get();			
		}

		static public function Traer_Empleadousuario($hash)
		{
			$key="minimarket2020";
			//$sql="select c.hash AS cargo,eu.ci,p.nombre,p.apellidoPaterno,p.apellidoMaterno,p.profesion,p.direccion,p.foto,p.fecha_nac,p.telefono,p.estado_civil,p.nivel_educ,p.pais_nac,p.genero,p.correo,AES_DECRYPT(eu.user,'$key') as user,AES_DECRYPT(eu.password,'$key') as password,eu.estado from empleadousuario AS eu  inner join persona as p on p.idPersona=eu.idEmpleado inner join cargo AS c ON c.idCargo=eu.idCargoFK where eu.hash='".$this->hash."'";			
			$datos=self::from('empleado_usuarios AS eu')
			->select('c.hash AS cargo','eu.ci','p.nombre', 'p.apellidoPaterno','p.apellidoMaterno','p.profesion','p.direccion','p.foto','p.fecha_nac','p.telefono','p.estado_civil','p.nivel_educ','p.pais_nac','p.genero','p.correo',DB::raw("AES_DECRYPT(eu.user,'$key') as user"),DB::raw("AES_DECRYPT(eu.password,'$key') as password"),'eu.estado')
			->join('personas AS p', 'p.idPersona', '=', 'eu.idEmpleado')
			->join('cargos AS c', 'c.idCargo', '=', 'eu.idCargoFK')
			->where('eu.hash', $hash)->first();

			$res=false;
			if(!$datos==null)
			{			
				$res=true;
			}
			return [$datos->toArray(),$res];
		}


		static public function Insertar_Empleadousuario($h_cargo,$ci, $user, $password,$estado,$idPersona)
		{					
			$key="minimarket2020";
			$id_cargo=DB::table('cargos')->where('hash', $h_cargo)->value('idCargo');
			
			//$sql="insert into empleadousuario values(".$this->idEmpleado->idPersona.",".$this->idCargoFK->idCargo.",".$this->ci.", AES_ENCRYPT('".$this->user."','$key'), AES_ENCRYPT('".$this->password."','$key'), CURRENT_DATE(),CURRENT_TIME(), '".$this->estado."', SHA1(".$this->idEmpleado->idPersona."))";	
			$res=DB::insert("insert into empleado_usuarios values(".$idPersona.",".$id_cargo.",".$ci.", AES_ENCRYPT('".$user."','$key'), AES_ENCRYPT('".$password."','$key'), CURRENT_DATE(),CURRENT_TIME(), '".$estado."', SHA1(".$idPersona."))");
			return $res;    	
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
		

		static public function Modificar_Empleadousuario($ci, $user, $password, $h_cargo, $estado, $hash)
		{			
			$id_cargo=DB::table('cargos')->where('hash', $h_cargo)->value('idCargo');
			$key="minimarket2020";
			//$sql="update empleadousuario set idCargoFK=".$this->idCargoFK->idCargo.",ci='".$this->ci."',user=AES_ENCRYPT('".$this->user."','$key'),password=AES_ENCRYPT('$this->password','$key'),estado='".$this->estado."' where hash='".$this->hash."'";
			return self::where('hash', $hash)->update(['idCargoFK' => $id_cargo, 'ci'=> $ci, 'user' =>  DB::raw("AES_ENCRYPT('".$user."','$key')"),'password' => DB::raw("AES_ENCRYPT('$password','$key')"),'estado' => $estado]);
		}



}
