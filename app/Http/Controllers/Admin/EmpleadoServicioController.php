<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EmpleadoServicio;
use Illuminate\Support\Facades\DB;

class EmpleadoServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = EmpleadoServicio::all();
        return view('admin.servicios.index',compact('servicios'));
    }

    public function setArrive(Request $request){
        try {
            $idempleadoservicio = $request->id;
            $fecha = date('Y-m-d H:i:s');
            DB::table('empleadoservicio')
                ->where('idempleadoservicio','=',$idempleadoservicio)
                ->update(['entrada'=>$fecha]);
            $result = array(
                "sw" => true,
            );
        } catch (Throwable $th) {
            $result = array(
                "sw" => false,
                "error" => $th
            );
        }
        return response()->json($result);
    }
    public function setExit(Request $request){
        try {
            $fecha = date('Y-m-d H:i:s');
            $idempleadoservicio = EmpleadoServicio::find($request->id);
            $idempleadoservicio->solicitud->cliente->fkidzona = 1;
            $idempleadoservicio->empleado->fkidestado = 1;
            $idempleadoservicio->solicitud->cliente->save();
            $idempleadoservicio->empleado->save();
            $idempleadoservicio->salida = $fecha; 
            $idempleadoservicio->estado = 2;
            $idempleadoservicio->save();
            /* DB::table('empleadoservicio')
                ->where('idempleadoservicio','=',$idempleadoservicio)
                ->update(['salida'=>$fecha]); 
            DB::table('empleadoservicio')
                ->where('idempleadoservicio','=',$idempleadoservicio)
                ->update(['estado'=>2]);*/
            $result = array(
                "sw" => true,
            );
        } catch (Throwable $th) {
            $result = array(
                "sw" => false,
                "error" => $th
            );
        }
        return response()->json($result);
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
