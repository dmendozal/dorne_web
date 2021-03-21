<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioEmpleado extends Model
{
    protected $table = "horarioempleado";
    public $timestamps=false;
    protected $fillable = ['idhorarioempleado','fkidempleado','fkidhorario',];
    protected $primaryKey = 'idhorarioempleado';

    public function empleado()
    {
        return $this->belongsTo(Empleado::class,'fkidempleado');
    }
    public function horario()
    {
        return $this->belongsTo(Horario::class,'fkidhorario');
    }
}
