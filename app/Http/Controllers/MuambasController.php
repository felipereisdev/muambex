<?php

namespace App\Http\Controllers;

use App\Muamba;
use Illuminate\Http\Request;

class MuambasController extends Controller
{
    public function index()
    {
        $conditions = array();
        $muambas = Muamba::where($conditions)->paginate(10);
        $controller = "muambas";
        return view('muambas.index', compact('muambas','controller', 'request'));
    }

    // public function form_edit($id)
    // {
    //     $content_header = "Alterar Muamba";
    //     $usuario = User::where('id', $id)->first();
    //     $controller = "muambas";
    //     return view('muambas.form', compact('muambas', 'content_header', 'controller'));
    // }

    // public function update(Request $request)
    // {
    //     $usuario = User::where('id', $request->id)->first();
    //     $usuario->name = trim($request->name);
    //     $usuario->email = trim($request->email);

    //     if (isset($request->password) && !empty($request->password)) {
    //         $usuario->password = Hash::make($request->password);
    //     }

    //     if ($usuario->save()) {
    //         Alert::success('Usuário alterado com sucesso', 'Uhuuuul!');
    //     } else {
    //         Alert::error('Erro ao alterar usuário', 'Ooooops!');
    //     }

    //     return redirect()->route('usuarios.index');
    // }
}
