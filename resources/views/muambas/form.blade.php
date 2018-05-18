@extends('adminlte::page')

@section('title', $content_header)

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $content_header }}</h3>
        </div>
        {{ Form::open(['route' => (isset($muamba->id) && !empty($muamba->id) ? array('muambas.update', $muamba->id) : 'muambas.store'), 'id' => 'form_muambas']) }}
            {{ method_field('PUT') }}
            <div class="box-body">
                <div class="form-group col-md-3">
                    {{ Form::label('Nome:', null, ['class' => 'control-label']) }}
                    {{ Form::text('nome', (isset($muamba->nome) && !empty($muamba->nome) ? $muamba->nome : ''), ['class' => 'form-control', 'id' => 'nome']) }}
                </div>

                <div class="form-group col-md-3">
                    {{ Form::label('Código Rastreio:', null, ['class' => 'control-label']) }}
                    {{ Form::text('codigo_rastreio', (isset($muamba->codigo_rastreio) && !empty($muamba->codigo_rastreio) ? $muamba->codigo_rastreio : ''), ['class' => 'form-control', 'id' => 'codigo_rastreio']) }}
                </div>
            </div>

            <div class="box-footer">
                <input type="hidden" name="id" value="{{ (isset($muamba->id) && !empty($muamba->id) ? $muamba->id : '') }}" />
                <input type="hidden" name="user_id" value="{{ Auth::id() }}" />
                {!! Form::button('Salvar', ['class' => 'btn btn-primary', 'id' => 'btn-salvar', 'type' => 'button']) !!}
                {{ link_to_route('muambas.index', 'Cancelar', null, ['class' => 'btn btn-warning']) }}
            </div>
        {{ Form::close() }}
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/muambas/form.js') }}"></script>
@stop