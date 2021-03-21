<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpleadoServicio extends Model
{
    protected $table = "empleadoservicio";
    public $timestamps=false;
    protected $fillable = ['idempleadoservicio','entrada','salida','estado','fkidasignarservicio','fkidempleado'];
    protected $primaryKey = 'idempleadoservicio';

    public function solicitud()
    {
        return $this->belongsTo(AsignarServicio::class,'fkidasignarservicio');
    }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class,'fkidempleado');
    }
}
