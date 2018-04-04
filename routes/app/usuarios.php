<?php
Route::get('/usuarios/form_edit', 'UsuariosController@form_edit')->name('usuarios.form_edit');
Route::post('/usuarios/update', 'UsuariosController@update')->name('usuarios.update');

Route::post('/usuarios/ajax_verifica_duplicidade', 'UsuariosController@ajax_verifica_duplicidade');