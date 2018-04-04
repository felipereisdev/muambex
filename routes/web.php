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

Route::get('/', 'MuambasController@index')->name('muambas.index');


Auth::routes();

$rotas_pastas = [
    'usuarios',
    'muambas'
];

foreach ($rotas_pastas as $rota) {
    $file = __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $rota . '.php';

    if (!file_exists($file)) {
        $msg = "Rota parcial {$rota} não encontrada";
        throw new FileNotFoundException($msg);
    }

    require_once $file;
}