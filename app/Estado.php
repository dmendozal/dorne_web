<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = "estado";
    public $timestamps=false;
    protected $fillable = ['idestado','nombre'];
    protected $primaryKey = 'idestado';

}
