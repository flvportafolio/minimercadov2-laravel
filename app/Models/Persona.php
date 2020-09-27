<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    public $timestamps = false;


    static public function Modificar_Persona($nombre, $app, $apm,$prof, $dir, $nomb_img, $fecha, $telf, $e_civil, $n_edu, $pais, $gen, $email, $estado, $hash)
    {
        //$sql="update persona set nombre='".$this->nombre."',apellidoPaterno='".$this->apellidoPaterno."',apellidoMaterno='".$this->apellidoMaterno."',genero='".$this->genero."',fecha_nac='".$this->fecha_nac."',pais_nac='".$this->pais_nac."',direccion='".$this->direccion."',correo='".$this->correo."',telefono='".$this->telefono."',estado_civil='".$this->estado_civil."',nivel_educ='".$this->nivel_educ."',profesion='".$this->profesion."',foto='".$this->foto."',estado='".$this->estado."' where hash='".$this->hash."'";
		return self::where('hash', $hash)->update(['nombre' => $nombre,'apellidoPaterno' => $app,'apellidoMaterno' => $apm,'genero' => $gen,'fecha_nac' => $fecha, 'pais_nac' => $pais, 'direccion' => $dir, 'correo' => $email, 'telefono' => $telf, 'estado_civil' => $e_civil, 'nivel_educ' => $n_edu, 'profesion' => $prof, 'foto'=>$nomb_img, 'estado'=>$estado]);		 
    }
}
