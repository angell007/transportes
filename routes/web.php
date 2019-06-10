<?php

// Route::resource('/inventarios', 'Admin\InventarioController');
// Route::get('/inventaris', 'Admin\InventarioController@datatables')->name('inventarios.datatables');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// admin propietarios
Route::resource('/proveedors', 'Admin\ProveedorController');
Route::get('/proveedores', 'Admin\ProveedorController@datatables')->name('proveedors.datatables');
Route::get('/proveedores/misVehiculos/{proveedor?}', 'Admin\ProveedorController@misVehiculos')->name('vehiculos.misVehiculos');
Route::get('/proveedores/datatables', 'Admin\ProveedorController@datatablesMisVehiculos')->name('misVehiculos.datatables');


// admin vehiculos
Route::resource('/vehiculos', 'Admin\VehiculoController');
Route::get('/vehiculs/{proveedor?}', 'Admin\VehiculoController@datatables')->name('vehiculos.datatables');


// admin relojs
Route::resource('/relojs', 'Admin\RelojController');
Route::get('/relojes', 'Admin\RelojController@datatables')->name('relojes.datatables');

// admin accesorios
Route::resource('/accesorios', 'Admin\AccesorioController')->except(['index']);
Route::get('/accesorios/misAccesorios/{accesorios}', 'Admin\AccesorioController@index')->name('accesorios.index');
Route::get('/accesoris', 'Admin\AccesorioController@datatables')->name('accesoris.datatables');
Route::post('/importaccesorios', 'Admin\AccesorioController@import')->name('accesorios.import');
