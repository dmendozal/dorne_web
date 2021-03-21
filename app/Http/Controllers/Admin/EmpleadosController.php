<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empleado;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function setToken(Request $request){
        $idEmpleado = $request->get('id');
        $Token = $request->get('tokenFirebase');
        DB::table('empleado')
            ->where('idempleado','=',$idEmpleado)
            ->update(['token'=>$Token]);
        $array = array(
            "sw" => true,
        );
        return response()->json($array);
    }

    public function validateLoginu(Request $request)
    {
        if ($request) {
            $username = $request->get('Username');
            $password = $request->get('Password');

            $employer = DB::table('empleado')
                ->select('password', 'idempleado')
                ->where('username', '=', $username)->get();
            
            if (empty($employer[0])) {
                $array = array(
                    "idempleado" => 0,
                );
                return response()->json($array);
            } else {
                $id = $employer[0]->idempleado;
                $pass = ($employer[0]->password);
                if (Hash::check($password,$pass)) {
                    $array = array(
                        "idempleado" => $id,
                    );
                    return response()->json($array);
                } else {
                    $array = array(
                        "idempleado" => 0,
                    );
                    return response()->json($array);
                }
            }
        }
    }
    public function index()
    {
        $empleados = Empleado::all();
        return view('admin.empleado.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleado = new Empleado();
        $empleado->nombre = $request->nombre;
        $empleado->ci = $request->ci;
        $empleado->email = $request->email;
        $empleado->direccion = $request->direccion;
        $empleado->estado = 'A';
        $empleado->telefono = $request->telefono;
        $empleado->sueldo = $request->sueldo;
        $empleado->username = $request->username;
        $empleado->password = Hash::make($request->password);
        $empleado->fkidestado = 1;
        $empleado->save();
        return redirect()->route('admin.empleados.index');
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
