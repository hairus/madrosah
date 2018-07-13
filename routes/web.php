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
    Route::post('/admin/SimSis', 'HomeController@save');
    Route::get('admin/absen','AdminController@index')->name('absen');
    Route::post('admin/saveA', 'AdminController@saveA');
    Route::get('admin/cekhari', 'AdminController@cek');
    Route::get('admin/laporan', 'AdminController@listSiswa');
    Route::get('admin/cetak/{id}', 'AdminController@cetak');

    /* penilaian */
    Route::get('/admin/kelas', 'AdminController@kelas');
    Route::post('admin/InputNilai', 'AdminController@inputNilai')->name('IN');
    Route::post('admin/simNilai', 'AdminController@simNilai')->name('simNilai');
    Route::get('admin/nilai/indexKM', 'AdminController@indexKM');
    Route::post('admin/edit', 'AdminController@editNi')->name('edit');
    Route::get('admin/nilai/e/{id}','AdminController@edata');
});
