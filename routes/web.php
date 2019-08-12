<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Authentication
Auth::routes();

Route::get('logout', 'Auth\LoginController@logout');

//Users Management
Route::resource('users', 'UsersController')->middleware('auth');

Route::get('changePassword', 'ChangePasswordController@showChangePasswordForm');
Route::post('/changePassword', 'ChangePasswordController@changePassword')->name('changePassword');


//Dashboard
Route::get('/', 'DashboardController@index')->name('dashboard');
/*
Route::get('/', function() {
    return view('dashboard.index');
})->name('dashboard');*/
//Server
Route::resource('servers', 'Monitor\ServerController');

//Custom
//Route::resource('customs', 'Monitor\ServerController');
Route::get('customs/{server}/create', 'CustomsController@create')->name('customs.create');
Route::post('customs/store/', 'CustomsController@store');
Route::get('customs/edit/{custom_id}', 'CustomsController@edit')->name('customs.edit');
Route::post('customs/update/{id}', 'CustomsController@update');
Route::post('customs/destroy/{id}', 'CustomsController@destroy');
Route::get('customs/{server}/show', 'CustomsController@show')->name('customs.show');

//Service
Route::get('services/index/{id}/{name}', 'Monitor\ServiceController@index');
Route::post('services/store/{id}/{name}', 'Monitor\ServiceController@store');
Route::get('services/edit/{id}/{server_id}/{name}', 'Monitor\ServiceController@edit');
Route::get('ajaxRequest/{id}', 'Monitor\ServiceController@store');
Route::get('ajaxRequestUpdate/{id}', 'Monitor\ServiceController@update');

//delete Service
Route::get('ajaxServiceDelete/{id}', 'Monitor\ServiceController@destroy')->name('service.destroy');
//Route for Adding Monitor
Route::get('ajaxRequestMonitor/{server_id}', 'Monitor\DiskController@store');

Route::get('services/generate/{id}/{server_id}', 'Monitor\GenerateFileController@generateFile');

//Add SeverType
Route::resource('servicetypes', 'Monitor\ServiceTypeController');
//Disk
Route::resource('disks', 'Monitor\DiskController');
//Entities
Route::resource('entities', 'DashboardController');
Route::get('values/store', 'ValuesController@store')->name('values.store');
Route::get('values/show/{server}/{period?}', 'ValuesController@view')->name('values.show');

Route::resource('customers', 'CustomersController');

Route::get('server-attribute/{server}/create', 'ServerAttributeController@create')->name('server-attribute.create');
Route::post('server-attribute/{server}/store', 'ServerAttributeController@store')->name('server-attribute.store');
Route::post('server-attribute/{server}/edit', 'ServerAttributeController@edit')->name('server-attribute.edit');

Route::get('ajaxRequest_CpuMonitor/{server_id}', 'ServerAttributeController@store');
Route::get('ajaxRequestUpdateDiskMonitor/{server_id}', 'ServerAttributeController@update');

//
Route::get('ajaxServiceAttributeCpuDelete/{id}', 'ServerAttributeController@destroy')->name('server-attribute.destroy');

//Route::get('changepassword', 'UsersController@changepassword');







