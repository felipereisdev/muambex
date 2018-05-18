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

use Illuminate\Contracts\Filesystem\FileNotFoundException;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', 'MuambasController@index')->name('muambas.index');
    Route::get('/home', 'MuambasController@index')->name('muambas.index');
    
    // ROTA USUARIOS

    Route::group(['prefix' => 'usuarios'], function() {
        Route::get('edit', 'UsuariosController@edit')->name('usuarios.edit');
        Route::post('update', 'UsuariosController@update')->name('usuarios.update');
        Route::post('ajax_verifica_duplicidade', 'UsuariosController@ajax_verifica_duplicidade');
    });
    
    // ROTA MUAMBAS
    
    Route::group(['prefix' => 'muambas'], function() {
        Route::post('ajax_verifica_duplicidade', 'MuambasController@ajax_verifica_duplicidade');
        Route::post('rastrear_muambas', 'MuambasController@rastrear_muambas');
        Route::post('historico_muambas', 'MuambasController@historico_muambas')->name('muambas.historico_muambas');
        Route::post('confirmar_recebimento', 'MuambasController@confirmar_recebimento')->name('muambas.confirmar_recebimento');
    });

    Route::resource('muambas', 'MuambasController')->except([
        'show'
    ]);
});