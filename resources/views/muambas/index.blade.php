@extends('adminlte::page')

@section('title', 'Listagem de Muambas')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="panel-body">
                    <div class="box-header">
                        <h3 class="box-title">Listagem de Muambas</h3>
    
                        <div class="box-tools">
                            {{ link_to_route('muambas.form_add', 'Cadastrar', null, ['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                    <hr>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="filtros">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" href="#filtrosCollapse" aria-expanded="true" aria-controls="filtrosCollapse" style="display: block;">
                                    <i class="fa fa-filter" aria-hidden="true"></i> FILTROS
                                </a>
                            </h4>
                        </div>
                        <div id="filtrosCollapse" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filtros">
                            <div class="panel-body">
                                <form id="form-busca" action="{{ route('muambas.index') }}" method="POST">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            {{-- {{ Form::label('Nome:', null, ['class' => 'control-label']) }}
                                            {{ Form::text('name', (isset($request->name) && !empty($request->name) ? $request->name : ''), ['class' => 'form-control', 'id' => 'name']) }} --}}
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            {{-- {{ Form::label('Email:', null, ['class' => 'control-label']) }}
                                            {{ Form::text('email', (isset($request->email) && !empty($request->email) ? $request->email : ''), ['class' => 'form-control', 'id' => 'email']) }} --}}
                                        </div>
                                        <div class="form-group col-md-2">
                                            {{-- {{ Form::label('Status:', null, ['class' => 'control-label']) }}
                                            {{ Form::select('fl_ativo', [1 => 'Ativo', 0 => 'Inativo'], null, ['placeholder' => 'Selecione', 'class' => 'form-control', 'value' => (isset($request->fl_ativo) && !empty($request->fl_ativo) ? $request->fl_ativo : '')]) }} --}}
                                        </div>
                                    </div>
                                    <div class="btn-group">
                                        {{ Form::token() }}
                                        {{ Form::submit('Buscar', ['class' => 'btn btn-default', 'id' => 'btnBuscar']) }}
                                    </div>
                                </form>
                                <br />
                                <br />
                            </div>
                        </div>
                    </div>
                
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-striped">
                            <thead>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th style="width: 10%">Opções</th>
                            </thead>
                            @if (isset($muambas) && count($muambas) > 0)
                                <tbody>
                                    @foreach ($muambas as $muamba)
                                        {{-- <tr>
                                            <td>{{ $usuario->name }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>
                                                <span class="badge {{ ($usuario->fl_ativo) ? 'bg-green' : 'bg-red' }}">{{ ($usuario->fl_ativo) ? 'ATIVO' : 'INATIVO' }}</span>
                                            </td>
                                            <td>
                                                {{ link_to_route('usuarios.form_edit', '', [$usuario->id], ['class' => 'btn btn-sm btn-warning glyphicon glyphicon-edit', 'title' => 'Alterar', 'data-toggle' => 'tooltip', 'data-placement' => 'top']) }}

                                                @if ($usuario->fl_ativo)
                                                    {{ link_to_route('usuarios.alterar_status', '', ['App\User', $usuario->id, 0, 'usuarios.index'], ['class' => 'btn btn-sm btn-danger glyphicon glyphicon-thumbs-down', 'title' => 'Inativar', 'data-toggle' => 'tooltip', 'data-placement' => 'top']) }}
                                                @else
                                                    {{ link_to_route('usuarios.alterar_status', '', ['App\User', $usuario->id, 1, 'usuarios.index'], ['class' => 'btn btn-sm btn-success glyphicon glyphicon-thumbs-up', 'title' => 'Ativar', 'data-toggle' => 'tooltip', 'data-placement' => 'top']) }}
                                                @endif
                                            </td>
                                        </tr> --}}
                                    @endforeach
                                </tbody>
                            @else
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <div class="alert alert-warning" role="alert" style="background-color: #FFD400 !important; border-color: #FFD400;">
                                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                Nenhuma muamba encontrada
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                        <div class="pull-right">
                            {{ $muambas->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/muambas/index.js') }}"></script>
@stop