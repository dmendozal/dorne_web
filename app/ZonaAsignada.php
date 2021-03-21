<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZonaAsignada extends Model
{
    protected $table = "zonasignada";
    public $timestamps=false;
    protected $fillable = ['idzonaasignada','fkidempleado','fkidzona'];
    protected $primaryKey = 'idzonaasignada';
}
