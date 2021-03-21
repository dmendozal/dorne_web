<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $table = "zona";
    public $timestamps=false;
    protected $fillable = ['idzona','nombre'];
    protected $primaryKey = 'idzona';
    
}
