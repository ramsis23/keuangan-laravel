<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function(){
	
	Route::get('/home', 'HomeController@index');
	Route::get('/profile', 'HomeController@profile');
	Route::post('/profile/update', 'HomeController@profile_update');
	
	Route::group(['middleware' => 'penerimaan', 'prefix' => 'penerimaan'], function(){
		Route::get('/home', 'HomeController@index');
		Route::get('/input', 'BendaharaPenerimaan@input_data');
		Route::post('/input', 'BendaharaPenerimaan@upload_data');
		Route::get('/riwayat', 'BendaharaPenerimaan@riwayat');
		Route::get('/laporan/harian', 'BendaharaPenerimaan@laporan_harian');
		Route::post('/laporan/harian', 'BendaharaPenerimaan@get_laporan_harian');
		Route::post('/laporan/harian/load', 'BendaharaPenerimaan@laporan_harian_load');
		Route::get('/laporan/bulanan', 'BendaharaPenerimaan@laporan_bulanan');
		Route::post('/laporan/bulanan', 'BendaharaPenerimaan@item_laporan_bulanan');
		Route::post('/laporan/bulanan/load', 'BendaharaPenerimaan@laporan_bulanan_load');
		Route::get('/laporan/mahasiswa', 'BendaharaPenerimaan@laporan_mahasiswa');
		Route::post('/laporan/mahasiswa', 'BendaharaPenerimaan@item_laporan_mahasiswa');
		Route::post('/laporan/mahasiswa/load', 'BendaharaPenerimaan@laporan_mahasiswa_load');
	});
	
	Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function(){
		Route::get('/home', 'HomeController@index');
		Route::get('/kode-rekening', 'AdminCtr@kode_rekening');
		Route::get('/setting', 'AdminCtr@setting');
		Route::post('/setting', 'AdminCtr@update_setting');
		Route::post('/rekening/add', 'AdminCtr@rekening_add');
		Route::post('/rekening/edit', 'AdminCtr@rekening_edit');
		Route::get('/rekening/remove/{id}', 'AdminCtr@rekening_remove');
	});
	
});

Route::auth();
