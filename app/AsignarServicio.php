<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignarServicio extends Model
{
    protected $table = "asignarservicio";
    public $timestamps=false;
    protected $fillable = ['idasignarservicio','fkidcliente','fkidservicio','nombre', 'descripcion', 'estado'];
    protected $primaryKey = 'idasignarservicio';

    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'fkidcliente');
    }
    public function servicio()
    {
        return $this->belongsTo(Servicio::class,'fkidservicio');
    }
}
