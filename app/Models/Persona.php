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
		if ($res)
        {
            $_lastid = DB::getPdo()->lastInsertId();
            $hash = sha1($_lastid);				
            //$sql2 = "update persona set hash = '$hash' where idPersona = ".$this->idPersona;
            $res = DB::update("update personas set hash = '".$hash."' where idPersona = ".$_lastid);
        }
        return $res; 
    }
    


    static public function Modificar_Persona($nombre, $app, $apm,$prof, $dir, $nomb_img, $fecha, $telf, $e_civil, $n_edu, $pais, $gen, $email, $estado, $hash)
    {
        //$sql="update persona set nombre='".$this->nombre."',apellidoPaterno='".$this->apellidoPaterno."',apellidoMaterno='".$this->apellidoMaterno."',genero='".$this->genero."',fecha_nac='".$this->fecha_nac."',pais_nac='".$this->pais_nac."',direccion='".$this->direccion."',correo='".$this->correo."',telefono='".$this->telefono."',estado_civil='".$this->estado_civil."',nivel_educ='".$this->nivel_educ."',profesion='".$this->profesion."',foto='".$this->foto."',estado='".$this->estado."' where hash='".$this->hash."'";
		return self::where('hash', $hash)->update(['nombre' => $nombre,'apellidoPaterno' => $app,'apellidoMaterno' => $apm,'genero' => $gen,'fecha_nac' => $fecha, 'pais_nac' => $pais, 'direccion' => $dir, 'correo' => $email, 'telefono' => $telf, 'estado_civil' => $e_civil, 'nivel_educ' => $n_edu, 'profesion' => $prof, 'foto'=>$nomb_img, 'estado'=>$estado]);		 
    }
}
