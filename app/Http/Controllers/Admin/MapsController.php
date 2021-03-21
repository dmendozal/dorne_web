<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapsController extends Controller
{
    public function getMapView(){
        return view('admin.mapas.map');
    }
}
