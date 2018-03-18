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
Route::resource('rombel','RombelController');
Route::resource('siswa','SiswaController');

Route::get('rombel-x/{tahun_ajar}/{kelas_id}', 'RombelController@show2');
Route::post('rombel-x', 'RombelController@store2');
Route::put('rombel-x/{tahun_ajar}/{kelas_id}', 'RombelController@update2');
Route::delete('rombel-x/{tahun_ajar}/{kelas_id}', 'RombelController@destroy2');
