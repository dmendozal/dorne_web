<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "cliente";
    public $timestamps=false;
    protected $fillable = ['idcliente','ci','direccion','nombre','username','password','latitud','longitud','token','fkidzona'];
    protected $primaryKey = 'idcliente';

}
