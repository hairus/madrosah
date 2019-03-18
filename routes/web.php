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

Auth::routes();


Route::get('/', function () {
    return redirect(route('dashboard'));
});


Route::group(['middleware' => ['admin']], function () {
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('dashboard','HomeController@index')->name('dashboard');
    Route::get('admin/inputSiswa','HomeController@inputSiswa');
    Route::post('admin/SimSis', 'HomeController@save');
    Route::get('admin/absen','AdminController@index')->name('absen');
    Route::post('admin/saveA', 'AdminController@saveA');
    Route::get('admin/cekhari', 'AdminController@cek');
    Route::get('admin/laporan', 'AdminController@listSiswa');
    Route::get('admin/cetak/{id}', 'AdminController@cetak');
    Route::get('admin/FormEdit/{id}','AdminController@showForm');
    Route::post('admin/editNow','AdminController@updateNow');
    Route::get('admin/editTgl/{id}','AdminController@formTgl');
    Route::post('admin/editTgl','AdminController@updateTgl');
    Route::put('admin/updateTgl','AdminController@updateTgl1');
    Route::get('admin/add', 'AdminController@addIndex');
    Route::post('admin/add', 'AdminController@simAdd');
    Route::get('admin/showUser','AdminController@showUser');

    /* penilaian */
    Route::get('/admin/kelas', 'AdminController@kelas');
    Route::post('admin/InputNilai', 'AdminController@inputNilai')->name('IN');
    Route::post('admin/simNilai', 'AdminController@simNilai')->name('simNilai');
    Route::get('admin/nilai/indexKM', 'AdminController@indexKM');
    Route::post('admin/edit', 'AdminController@editNi')->name('edit');
    Route::get('admin/nilai/e/{id}','AdminController@edata');
    Route::get('test', 'AdminController@tester');
    Route::get('/luki','AdminController@luki');
    Route::put('/admin/update', 'adminController@update');
    Route::put('/admin/updateNilai', 'adminController@updateNilai')->name('updateNilai');
    Route::get('/admin/smt', 'adminController@formSmt');
    Route::put('/admin/smt', 'adminController@updatesmt')->name('aktifsmt');
    Route::get('/admin/formImport', 'adminController@formImport');

    /*export excel*/
    Route::get('/admin/export', 'adminController@export');

    /*import excel*/
    Route::post('/admin/import', 'adminController@import')->name('import');

    Route::get('/rapor/cetak', 'raporController@index');
    Route::get('/rapor/kep', 'raporController@kep');
    Route::post('rapor/formKep','raporController@formKep');
    Route::post('/rapor/showSiswa', 'raporController@showSiswa');
    Route::get('rapor/cover/{nis}', 'raporController@cover');
    Route::get('rapor/petunjuk', 'raporController@petunjuk');
    Route::get('rapor/keterangan/{nis}', 'raporController@keterangan');
    Route::get('rapor/nilai/{nis}', 'raporController@nilai');
    Route::post('rapor/kep', 'raporController@simKep')->name('simKep');
    Route::put('rapor/kep','raporController@update')->name('updateKep');
    Route::get('rapor/sia', 'raporController@formSia');
    Route::post('rapor/saveSIA', 'raporController@saveSIA');
    Route::post('rapor/simSia', 'raporController@simSIA')->name('simpanSIA');
});
