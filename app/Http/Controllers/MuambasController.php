<?php

namespace App\Http\Controllers;

use App\Muamba;
use App\MuambaInfo;
use Alert;
use Correios;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class MuambasController extends Controller
{
    public function index(Request $request)
    {
        $conditions = array();
        
        if (!empty($request->nome)) {
            $conditions[] = ['nome', 'LIKE', "%" . trim($request->nome) . "%"];
        }
        
        if (!empty($request->codigo_rastreio)) {
            $conditions['codigo_rastreio'] = trim($request->codigo_rastreio);
        }

        $conditions['user_id'] = Auth::id();

        $muambas = Muamba::where($conditions)->paginate(10);
        $controller = "muambas";
        return view('muambas.index', compact('muambas','controller', 'request'));
    }

    public function create()
    {
        $content_header = "Cadastrar Muamba";
        $controller = "muambas";
        return view('muambas.form', compact('content_header', 'controller'));
    }

    public function store(Request $request)
    {    
        if (Correios::rastrear($request->codigo_rastreio) != false) {
            if (Muamba::create(Input::all())) {
                Alert::success('Muamba cadastrada com sucesso', 'Uhuuuul!');
            } else {
                Alert::error('Erro ao cadastrar muamba', 'Ooooops!');
            }
            
            return redirect()->route('muambas.index');
        } else {
            Alert::error('Código de rastreio inválido ou ainda não consta na base dos correios', 'Ooooops!');
            return Redirect::back()->withInput(Input::all());
        }
    }


    public function edit($id)
    {
        $content_header = "Alterar Muamba";
        $muamba = Muamba::where('id', $id)->first();
        $controller = "muambas";
        return view('muambas.form', compact('muamba', 'content_header', 'controller'));
    }

    public function update(Request $request)
    {
        $muamba = Muamba::where('id', $request->id)->first();
        $muamba->nome = trim($request->nome);
        $muamba->codigo_rastreio = trim($request->codigo_rastreio);
        
        if ($muamba->save()) {
            Alert::success('Muamba alterada com sucesso', 'Uhuuuul!');
        } else {
            Alert::error('Erro ao alterar a muamba', 'Ooooops!');
        }

        return redirect()->route('muambas.index');
    }

    public function rastrear_muambas(Request $request)
    {
        $eventos = Correios::rastrear($request->codigoRastreio);

        $muamba = Muamba::where('id', $request->id)->first();
        $muamba->ultimo_status = $eventos[0]['status'];
        
        if (!$muamba->save()) {
            return json_encode(array('success' => false));
        } else {
            return json_encode($eventos);   
        }
    }
    
    public function historico_muambas(Request $request)
    {
        $historico = MuambaInfo::where('muambas_id', $request->id)->get();
        return json_encode($historico);
    }
    
    public function confirmar_recebimento(Request $request)
    {
        DB::beginTransaction();
        
        try {
            $eventos = Correios::rastrear($muamba->codigo_rastreio);
    
            $arrayMuambaInfo = array();
            $ultimoStatus = "";
            foreach($eventos as $key => $value) {
                $muambaInfo = new MuambaInfo();
                
                $muambaInfo->data = $value['data'];
                $muambaInfo->local = $value['local'];
                $muambaInfo->status = $value['status'];
                
                if (!empty($value['encaminhado'])) {
                    $muambaInfo->encaminhado = $value['encaminhado'];   
                }
                
                $arrayMuambaInfo[] = $muambaInfo;
                
                if (!empty($ultimoStatus)) {
                    $ultimoStatus = $value['status'];
                }
            }
            
            $muamba = Muamba::where('id', $request->id)->first();
            $muamba->fl_recebido = 1;
            $muamba->ultimo_status = $ultimoStatus;
            
            if (!$muamba->save()) {
                throw new \Exception();
            }
    
            if (!$muamba->muamba_info()->saveMany($arrayMuambaInfo)) {
                throw new \Exception();
            }
            
            DB::commit();
            return json_encode(true);
        } catch(\Exception $e) {
            DB::rollBack();
            return json_encode(false);
        }
    }
    
    public function destroy(Request $request)
    {
        if (Muamba::destroy($request->id)) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }
}
