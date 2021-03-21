<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = "horario";
    public $timestamps=false;
    protected $fillable = ['idhorario','entrada','salida','tipo'];
    protected $primaryKey = 'idhorario';

}
