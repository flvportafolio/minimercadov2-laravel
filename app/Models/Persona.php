<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Persona extends Model
{
    use HasFactory;
    public $timestamps = false;

    static public function Insertar_Persona($nombre, $app, $apm, $prof, $dir, $nomb_img, $fecha, $telf, $e_civil, $n_edu, $pais, $gen,$email,$estado)
	{
        //$sql="insert into persona values(0,'".$this->nombre."','".$this->apellidoPaterno."','".$this->apellidoMaterno."','".$this->genero."','".$this->fecha_nac."','".$this->pais_nac."','".$this->direccion."','".$this->correo."','".$this->telefono."','".$this->estado_civil."','".$this->nivel_educ."','".$this->profesion."','".$this->foto."',CURRENT_DATE(),CURRENT_TIME(),'".$this->estado."','".$this->hash."')";
        $res=DB::insert("insert into personas values(0,'$nombre','$app','$apm','$gen','$fecha','$pais','$dir','$email','$telf','$e_civil','$n_edu','$prof','$nomb_img',CURRENT_DATE(),CURRENT_TIME(),'$estado','')");
        $_lastid=null;        
		if ($res)
        {
            $_lastid = DB::getPdo()->lastInsertId();
            $hash = sha1($_lastid);				
            //$sql2 = "update persona set hash = '$hash' where idPersona = ".$this->idPersona;
            $res = DB::update("update personas set hash = '".$hash."' where idPersona = ".$_lastid);
        }
        return [$res,$_lastid]; 
    }
    
    static public function TraerPersonas_US_EU()
    {
        /* $sql="select p.nombre,p.apellidoPaterno,p.apellidoMaterno,p.genero,p.fecha_nac,p.pais_nac,p.direccion,p.correo,p.telefono,p.estado_civil,p.nivel_educ,p.profesion,p.foto,p.fecha_registro,p.hora_registro from persona AS p 
        WHERE p.idPersona IN(SELECT eu.idEmpleado FROM empleadousuario AS eu UNION ALL SELECT us.idUsuario FROM usuariosistema AS us) and p.estado='A'";		 */
        return DB::select("select p.nombre,p.apellidoPaterno,p.apellidoMaterno,p.genero,p.fecha_nac,p.pais_nac,p.direccion,p.correo,p.telefono,p.estado_civil,p.nivel_educ,p.profesion,p.foto,p.fecha_registro,p.hora_registro from personas AS p 
        WHERE p.idPersona IN(SELECT eu.idEmpleado FROM empleado_usuarios AS eu UNION ALL SELECT us.idUsuario FROM usuario_sistemas AS us) and p.estado='A'");


       /* return self::from('personas AS p')
			->select('p.nombre', 'p.apellidoPaterno','p.apellidoMaterno','p.genero','p.fecha_nac','p.pais_nac','p.direccion','p.correo','p.telefono','p.estado_civil','p.nivel_educ','p.profesion','p.foto','p.fecha_registro','p.hora_registro')
            ->whereIn('p.idPersona',function($query)
            {
                $query->select('eu.idEmpleado')->from('empleado_usuarios AS eu')->unionAll(function($builder)
                {
                    $builder->select('us.idUsuario')->from('usuario_sistemas AS us');
                });
             })
            ->where('p.estado', 'A')
            ->get(); 
            
            //toSql() en ves de get para convertirlo a sql
            //
        */            
    }


    static public function Modificar_Persona($nombre, $app, $apm,$prof, $dir, $nomb_img, $fecha, $telf, $e_civil, $n_edu, $pais, $gen, $email, $estado, $hash)
    {
        //$sql="update persona set nombre='".$this->nombre."',apellidoPaterno='".$this->apellidoPaterno."',apellidoMaterno='".$this->apellidoMaterno."',genero='".$this->genero."',fecha_nac='".$this->fecha_nac."',pais_nac='".$this->pais_nac."',direccion='".$this->direccion."',correo='".$this->correo."',telefono='".$this->telefono."',estado_civil='".$this->estado_civil."',nivel_educ='".$this->nivel_educ."',profesion='".$this->profesion."',foto='".$this->foto."',estado='".$this->estado."' where hash='".$this->hash."'";
		return self::where('hash', $hash)->update(['nombre' => $nombre,'apellidoPaterno' => $app,'apellidoMaterno' => $apm,'genero' => $gen,'fecha_nac' => $fecha, 'pais_nac' => $pais, 'direccion' => $dir, 'correo' => $email, 'telefono' => $telf, 'estado_civil' => $e_civil, 'nivel_educ' => $n_edu, 'profesion' => $prof, 'foto'=>$nomb_img, 'estado'=>$estado]);		 
    }
}
