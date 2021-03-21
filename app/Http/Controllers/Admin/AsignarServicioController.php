<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AsignarServicio;
use Illuminate\Support\Facades\DB;
use App\EmpleadoServicio;
use App\Cliente;
use App\Servicio;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use function GuzzleHttp\json_encode;

class AsignarServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitud = AsignarServicio::all();
        return view('admin.solicitud.index',compact('solicitud'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cliente = Cliente::where('fkidzona','=',1)->get();
        $servicio = Servicio::all();
        return view('admin.solicitud.create',compact('cliente','servicio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $solicitud = new AsignarServicio();
        $solicitud->descripcion = $request->descripcion;
        $solicitud->estado = 'E';
        $solicitud->fecha = date('d/m/Y H:i:s');
        $solicitud->fkidcliente = $request->cliente;
        $solicitud->fkidservicio = $request->servicio;
        $solicitud->save();
        DB::table('cliente')
            ->where('idcliente','=',$request->cliente)
            ->update(['fkidzona'=>2 ]);
        
        return redirect()->route('admin.solicitud.index');
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
        $solicitud = AsignarServicio::find($id);
       // $solicitud = response()->json($solicitud);
        $empleado = DB::table('empleado')->select('*')->where('fkidestado','=', 1)->get();
        return view('admin.mapas.map', compact('empleado', 'solicitud'));
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
        $solicitud = AsignarServicio::find($id);
        /* $posClient = json(
            'lat' => $solicitud->cliente->latitud,
            'lng' => $solicitud->cliente->longitud 
        ); */
        $idempleado = $request->empleado; // id Empleado
        $idsolicitud = $id; //idAsignarServicio
        $empleadoServicio = new EmpleadoServicio();
        $empleadoServicio->entrada = null;
        $empleadoServicio->salida = null;
        $empleadoServicio->estado = 1;
        $empleadoServicio->fkidasignarservicio = $idsolicitud;
        $empleadoServicio->fkidempleado = $idempleado;
        $empleadoServicio->save();
        DB::table('asignarservicio')
            ->where('idasignarservicio','=',$idsolicitud)
            ->update(['estado'=>'A']);
        DB::table('empleado')
            ->where('idempleado','=',$idempleado)
            ->update(['fkidestado'=>2]);
        $token = DB::table('empleado')
            ->select('token')
            ->where('idempleado','=',$idempleado)->get();
        $id = $empleadoServicio->idempleadoservicio;
        $this->sendNotification($token[0]->token,$solicitud->cliente->latitud,$solicitud->cliente->longitud, $id);
        return redirect()->route('admin.solicitud.index');
    }

    public function sendNotification($token,$latitud,$longitud,$idempleadoservicio)
    {
        try {
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60 * 20);
            $notificationBuilder = new PayloadNotificationBuilder("Solicitud: Tienes un nuevo trabajo! ");
            $notificationBuilder->setBody("Por favor, no olvides marcar al llegar a tu destino")
                ->setSound('default');
            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['latitud' => $latitud,
                                    'longitud' => $longitud,
                                    'id' => $idempleadoservicio]);
            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();
            $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
            $downstreamResponse->numberSuccess();
            $downstreamResponse->numberFailure();
            $downstreamResponse->numberModification();

//return Array - you must remove all this tokens in your database
            $downstreamResponse->tokensToDelete();

//return Array (key : oldToken, value : new token - you must change the token in your database )
            $downstreamResponse->tokensToModify();

//return Array - you should try to resend the message to the tokens in the array
            $downstreamResponse->tokensToRetry();
            $array = array(
                "sw" => true,
            );
            return response()->json($array);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
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
