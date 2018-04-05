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
                                        <div class="form-group col-md-3">
                                            {{ Form::label('Nome:', null, ['class' => 'control-label']) }}
                                            {{ Form::text('nome', (isset($request->nome) && !empty($request->nome) ? $request->nome : ''), ['class' => 'form-control', 'id' => 'nome']) }}
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            {{ Form::label('Código Rastreio:', null, ['class' => 'control-label']) }}
                                            {{ Form::text('codigo_rastreio', (isset($request->codigo_rastreio) && !empty($request->codigo_rastreio) ? $request->codigo_rastreio : ''), ['class' => 'form-control', 'id' => 'codigo_rastreio']) }}
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
                                <th>Cód Rastreio</th>
                                <th style="width: 10%">Opções</th>
                            </thead>
                            @if (isset($muambas) && count($muambas) > 0)
                                <tbody>
                                    @foreach ($muambas as $muamba)
                                        <tr>
                                            <td>{{ $muamba->nome }}</td>
                                            <td>{{ $muamba->codigo_rastreio }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-info rastrear-muamba" style="margin-top: 3px;" data-toggle="tooltip" title="Rastrear Muamba" data-id="{{ $muamba->id }}" data-codigo-rastreio="{{ $muamba->codigo_rastreio }}" data-token="{{ csrf_token() }}"><i class="glyphicon glyphicon-refresh"></i></button>

                                                {{ link_to_route('muambas.form_edit', '', [$muamba->id], ['class' => 'btn btn-sm btn-warning glyphicon glyphicon-edit', 'title' => 'Alterar', 'data-toggle' => 'tooltip', 'data-placement' => 'top']) }}

                                                @if (!$muamba->fl_recebido)
                                                    {{ link_to_route('muambas.alterar_status', '', ['App\Muamba', $muamba->id, 1, 'muambas.index'], ['class' => 'btn btn-sm btn-success glyphicon glyphicon-thumbs-up', 'title' => 'Confirmar Recebimento', 'data-toggle' => 'tooltip', 'data-placement' => 'top']) }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <div class="alert alert-warning" role="alert">
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