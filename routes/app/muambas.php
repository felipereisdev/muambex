<?php
    Route::get('/muambas', 'MuambasController@index')->name('muambas.index');
    Route::post('/muambas', 'MuambasController@index')->name('muambas.index');
    
    Route::get('/muambas/alterar_status/{model}/{id}/{valor}/{rota}', 'MuambasController@alterar_status')->name('muambas.alterar_status');
    
    Route::get('/muambas/form_add', 'MuambasController@form_add')->name('muambas.form_add');
    Route::post('/muambas/create', 'MuambasController@create')->name('muambas.create');
    
    Route::get('/muambas/form_edit/{id}', 'MuambasController@form_edit')->name('muambas.form_edit');
    Route::post('/muambas/update', 'MuambasController@update')->name('muambas.update');
    
    Route::post('/muambas/ajax_verifica_duplicidade', 'MuambasController@ajax_verifica_duplicidade');
    Route::post('/muambas/rastrear_muambas', 'MuambasController@rastrear_muambas');