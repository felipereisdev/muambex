<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Alert;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ajax_verifica_duplicidade(Request $request)
    {
        $conditions = [];
        if (!empty($request->id)) {
            $conditions[] = ['id', '<>', $request->id];
        }

        $conditions[] = [$request->campo, '=', trim($request->valor)];

        $model = $request->model;
        $v = $model::where($conditions)->count();

        if ($v > 0) {
            return "true";
        } else {
            return "false";
        }
    }

    public function delete(Request $request)
    {
        $model = $request->model;
        $v = $model::where('id', $request->id)->delete();

        if ($v) {
            return "true";
        } else {
            return "false";
        }
    }
}
