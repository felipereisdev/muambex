<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{

    public function form_edit()
    {
        $content_header = "Alterar Usuário";
        $usuario = User::where('id', Auth::id())->first();
        $controller = "usuarios";
        return view('usuarios.form', compact('usuario', 'content_header', 'controller'));
    }

    public function update(Request $request)
    {
        $usuario = User::where('id', $request->id)->first();
        $usuario->name = trim($request->name);
        $usuario->email = trim($request->email);

        if (isset($request->password) && !empty($request->password)) {
            $usuario->password = Hash::make($request->password);
        }

        if ($usuario->save()) {
            Alert::success('Usuário alterado com sucesso', 'Uhuuuul!');
        } else {
            Alert::error('Erro ao alterar usuário', 'Ooooops!');
        }

        return redirect()->route('usuarios.form');
    }
}
