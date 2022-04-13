@extends('template')

@section('title', 'Delegados')

@section('content_header')
    <h1>Delegados</h1>
@stop


@section('content')
<div class="row mt-3">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                Formulário do Delegado
            </div>
            <div class="card-body">
                @if(isset($delegado))
                    {!! Form::model($delegado, ['route' => ['admin.delegados.update', $delegado->id], 'class' => 'form', 'method' => 'PUT', 'files' => true]) !!}
                @else
                    {!! Form::open(['route' => 'admin.delegados.store', 'files' => true]) !!}
                @endif
                <div class="form-group">
                    {!! Form::label('codigo', 'Código:') !!}
                    {!! Form::text('codigo', isset($codigo) ? $codigo : null, ['class'=>'form-control', 'readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('nome', 'Nome do Delegado:') !!}<span class="text-danger">*</span>
                    {!! Form::text('nome', null, ['class'=>'form-control', 'required'=>'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('federacao', 'Federação:') !!}<span class="text-danger">*</span>
                    {!! Form::text('federacao', null, ['class' => 'form-control', 'required'=>'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('sinodal', 'Sinodal:') !!}<span class="text-danger">*</span>
                    {!! Form::text('sinodal', null, ['class' => 'form-control', 'required'=>'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('estado', 'Estado') !!}<span class="text-danger">*</span>
                    {!! Form::text('estado', null, ['class' => 'form-control', 'required'=>'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('regiao_id', 'Região') !!}<span class="text-danger">*</span>
                    {!! Form::select('regiao_id', $regioes ,null, ['class' => 'form-control', 'required'=>'required']) !!}
                </div>
                <div class="form-group">
                {!! Form::label('foto', 'Foto') !!} <small>(Opcional)</small><br>
                {!! Form::file('foto', []) !!}
                @if(isset($delegado) && !empty($delegado->foto))
                <br>
                <a href="{{$delegado->foto}}" target="_blank" class="btn btn-link"><i class="fas fa-image"></i> Visualizar Foto</a>
                @endif
                </div>
                <button class="btn btn-success" type="submit">Salvar</button>
                <a href="{{route('admin.delegados.index')}}" class="btn btn-secondary">Voltar</a>
                {!! Form::close() !!}
            </div>
        
        </div>
        
    </div>
</div>

@endsection