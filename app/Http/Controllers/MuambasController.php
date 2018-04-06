<?php

namespace App\Http\Controllers;

use App\Muamba;
use App\MuambaInfo;
use Alert;
use Correios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MuambasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $conditions = array();

        $conditions['user_id'] = Auth::id();

        $muambas = Muamba::where($conditions)->paginate(10);
        $controller = "muambas";
        return view('muambas.index', compact('muambas','controller', 'request'));
    }

    public function form_add()
    {
        $content_header = "Cadastrar Muamba";
        $controller = "muambas";
        return view('muambas.form', compact('content_header', 'controller'));
    }

    public function create(Request $request)
    {
        $muamba = new Muamba();
        $muamba->nome = trim($request->nome);
        $muamba->codigo_rastreio = trim($request->codigo_rastreio);
        $muamba->user_id = $request->user_id;

        if ($muamba->save()) {
            Alert::success('Muamba cadastrada com sucesso', 'Uhuuuul!');
        } else {
            Alert::error('Erro ao cadastrar muamba', 'Ooooops!');
        }

        return redirect()->route('muambas.index');
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

    public function rastrear_muambas(Request $request)
    {
        $eventos = Correios::rastrear($request->codigoRastreio);
        return json_encode($eventos);
    }
    
    public function confirmar_recebimento(int $id)
    {
        $muamba = Muamba::where('id', $id)->first();
        $muamba->fl_recebido = 1;
        
        $eventos = Correios::rastrear($muamba->codigo_rastreio);

        $arrayMuambaInfo = array();
        foreach($eventos as $key => $value) {
            $muambaInfo = new MuambaInfo();
            $muambaInfo->dh_evento = $value['data'];
            $muambaInfo->ds_local = $value['local'];
            $muambaInfo->ds_status = $value['status'];
            
            if (!empty($value['encaminhado'])) {
                $muambaInfo->ds_encaminhado = $value['encaminhado'];   
            }
            
            $arrayMuambaInfo[] = $muambaInfo;
        }

        if ($muamba->muamba_info()->save($arrayMuambaInfo)) {
            Alert::success('Recebimento da muamba confirmado com sucesso', 'Uhuuuul!');
        } else {
            Alert::error('Erro ao confirmar recebimento da muamba', 'Ooooops!');
        }

        return redirect()->route('muambas.index');
    }
}
