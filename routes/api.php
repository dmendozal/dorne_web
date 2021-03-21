<?php

Route::group(['prefix' => 'v1', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin'], function () {
    Route::apiResource('permissions', 'PermissionsApiController');

    Route::apiResource('roles', 'RolesApiController');

    Route::apiResource('users', 'UsersApiController');

    Route::apiResource('products', 'ProductsApiController');
});

Route::post('/loginu', 'Admin\EmpleadosController@validateLoginu');
Route::get('/services', 'Admin\ServicioController@getServices');
Route::post('/settoken', 'Admin\EmpleadosController@setToken');
Route::get('/location', 'Admin\EmpleadosController@setToken');
Route::post('/arrive', 'Admin\EmpleadoServicioController@setArrive');
Route::post('/exit', 'Admin\EmpleadoServicioController@setExit');