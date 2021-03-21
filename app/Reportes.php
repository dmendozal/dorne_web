<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportes extends Model
{
    protected $table = "reporte";
    public $timestamps=false;
    protected $fillable = ['idcliente','ci','direccion','nombre','username','password','latitud','longitud','token','fkidzona'];
    protected $primaryKey = 'idcliente';
}
