@extends('adminlte::page')

@section('title', 'Gestão Financeira')

@section('content_header')
    <h1>Bem Vindo {{ Auth::user()->name }}</h1>
@stop

@section('content')
    <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
@endsection