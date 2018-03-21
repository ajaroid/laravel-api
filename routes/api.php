<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('kelas','KelasController');
Route::resource('siswa','SiswaController');

Route::get('rombel', 'RombelController@index');
Route::get('rombel/{tahun_ajar}/{kelas_id}', 'RombelController@show');
Route::post('rombel', 'RombelController@store');
Route::put('rombel/{tahun_ajar}/{kelas_id}', 'RombelController@update');
Route::delete('rombel/{tahun_ajar}/{kelas_id}', 'RombelController@destroy');
