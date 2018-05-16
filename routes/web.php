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
    Route::get('admin/absen','AdminController@index');
    Route::post('admin/saveA', 'AdminController@saveA');
    Route::get('admin/cekhari', 'AdminController@cek');
});
