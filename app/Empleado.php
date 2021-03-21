<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
  protected $table = "empleado";
  public $timestamps=false;
  protected $fillable = ['idempleado','fkidestado','ci','direccion','estado','nombre','telefono','sueldo','token','username','password'];
  protected $primaryKey = 'idempleado';


  public function estados()
  {
      return $this->belongsTo(Estado::class,'fkidestado');
  }
}
