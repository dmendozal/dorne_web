<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => false]);

Route::get('test', 'TestController@index');
Route::get('show', 'TestController@index');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {


    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('products', 'ProductsController');

    Route::resource('empleados', 'EmpleadosController');

    Route::resource('horarios', 'HorariosController');

    Route::resource('clientes', 'ClientesController');

    Route::resource('solicitud', 'AsignarServicioController');

    Route::resource('servicios', 'EmpleadoServicioController');

    Route::resource('reportes', 'ReporteController');

    Route::get('mapas', 'MapsController@getMapView');



    /* Route::delete('horarios/destroy', 'HorariosController@massDestroy')->name('horarios.massDestroy');

    Route::resource('horarios', 'HorariosController');

    Route::delete('programas/destroy', 'ProgramaController@massDestroy')->name('programas.massDestroy');

    Route::resource('programas', 'ProgramaController');

    Route::delete('tipoprograma/destroy', 'TipoProgramaController@massDestroy')->name('tipoprograma.massDestroy');

    Route::resource('tipoprograma', 'TipoProgramaController'); */


    ///PROGRAMACION ACADEMICA///
    /* Route::delete('proacademica/destroy', 'ProgramacionAcademicaController@massDestroy')->name('proacademica.massDestroy');
    Route::resource('proacademica', 'ProgramacionAcademicaController');

    Route::delete('usuarios/destroy', 'UsersController@massDestroy')->name('usuarios.massDestroy');
    Route::get('getusuarios','UsuarioController@index1');

    Route::resource('usuarios', 'UsuarioController');
  */


});
