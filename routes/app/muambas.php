<?php
    Route::get('/muambas', 'MuambasController@index')->name('muambas.index');

    Route::get('/muambas/form_add', 'MuambasController@form_add')->name('muambas.form_add');    