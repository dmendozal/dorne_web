@extends('layouts.admin')
@push('estilos')
<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
      height: 100%;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
  </style>
@endpush
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.asignar') }} 
    </div>
    <div class="card-body">
        <form action="{{ route("admin.solicitud.update", [$solicitud->idasignarservicio]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('empleado') ? 'has-error' : '' }}">
                <label for="nombre">{{ trans('global.servicio.fields.empleado') }}*
                <select name="empleado" id="nombre" class="form-control ">
                <option hidden selected ></option>
                        @foreach($empleado as $id => $empleados)
                        <option value="{{  $empleado[$id]->idempleado }}">{{ $empleado[$id]->nombre }}</option>
                        @endforeach
                </select>
                @if($errors->has('nombre'))
                    <em class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.empleado.fields.nombre_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
<div class="container">
  <div class="card">
      <div class="card-content">
        <div id="map" style="height: 450px"></div>
      </div>
  </div>
</div>
@endsection

@push('scripts')
<script>

    var map;
    var cliente = '{!! $solicitud->cliente !!}'
    cliente = JSON.parse(cliente);
    var empleados =  '{!!  $empleado  !!}';
    empleados = JSON.parse(empleados);
    function initMap() {
    var position = {
      lat: parseFloat(cliente.latitud),
      lng: parseFloat(cliente.longitud)
    }
      map = new google.maps.Map(document.getElementById('map'), {
        center: position,
        zoom: 12.5
      });
    for (let i = 0; i < empleados.length; i++) {
      var pos = { lat: parseFloat(empleados[i].latitud), lng: parseFloat(empleados[i].longitud)}
        var marker = new google.maps.Marker({
        position: pos,
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        title: empleados[i].nombre
        });
      }
      var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
      var marker = new google.maps.Marker({
        position: position,
        map: map,
        icon: iconBase + 'library_maps.png',
        title: "Cliente"
        });
    }
  </script>
  <script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdG9dbToS4EEPT5rvxhdbLKZxiG6l8YPI&callback=initMap">
</script>
{{--  <script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2UerqDnvs5Tvz4u8TWMs-ouvVRuZZlJ0&callback=initMap">
</script>  --}}

@endpush