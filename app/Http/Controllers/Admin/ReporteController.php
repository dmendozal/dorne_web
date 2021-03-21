<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Empleado;
use Illuminate\Support\Facades\DB;
use App\HorarioEmpleado;
use Illuminate\Support\Collection;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $finally = new Collection();
        $carbon = Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        $empleados = DB::table('empleado')->select('idempleado','nombre')->get()->all();
        $horarioempleado = DB::table('horarioempleado')->select('idhorarioempleado')->get()->all();
        for ($i=0; $i < sizeof($empleados) ; $i++) {
            $id = $empleados[$i]->idempleado;
            $nombre = $empleados[$i]->nombre; 
            $houremployer = DB::table('horarioempleado')->select('idhorarioempleado')->where('fkidempleado','=',$id)->get()->all();
            $idhor = HorarioEmpleado::find($houremployer[0]->idhorarioempleado);
            $entrada = $idhor->horario->entrada;
            $salida = $idhor->horario->salida;
            $horATra = $this->horasTrabajar($entrada,$salida);
            $horTra = $this->horasTrabajadas($id);
            $horExtras = 0;               
            $result = [
                "empleado" => $nombre,
                "entrada" => $entrada,
                "salida" => $salida,
                "horaTra" => $horTra,
                "horaATra" => $horATra,
                "horExtras" => $horExtras
            ];
            $finally->push($result);
        };
        return view('admin.reportes.index',compact('finally'));
    }

    public function horasTrabajar($entrada, $salida){
        $entrada = Carbon::createFromFormat('H:i:s',$entrada);
        $salida = Carbon::createFromFormat('H:i:s', $salida);
        $hora = $entrada->diffInHours($salida);
        return $hora*30;
    }
    public function horasTrabajadas($id){
        $servicios = DB::table('empleadoservicio')->select('entrada','salida')->where('estado','=',2)->where('fkidempleado','=',$id)->get()->all();
        $cont = 0; 
        for ($i=0; $i < sizeof($servicios); $i++) { 
            $entrada = Carbon::createFromFormat('Y-m-d H:i:s', $servicios[$i]->entrada);
            $salida = Carbon::createFromFormat('Y-m-d H:i:s', $servicios[$i]->salida);
            $hora = $entrada->diffInHours($salida);
            $cont = $cont + $hora;
        }
        return $cont;
    }
    public function horasExtras(){
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
