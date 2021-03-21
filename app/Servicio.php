<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = "servicio";
    public $timestamps=false;
    protected $fillable = ['idservicio','nombre'];
    protected $primaryKey = 'idservicio';
}
