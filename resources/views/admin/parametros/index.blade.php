@extends('template')

@section('title', 'Painel de Presença')

@section('content_header')
<h1>Painel de Presença</h1>
@stop


@section('content')

<div class="row mb-3">
    <div class="col-md-4">
        <div class="info-box shadow">
            <span class="info-box-icon bg-info"><i class="fas fa-clipboard-check"></i></span>
            <div class="info-box-content">
                <div class="info-box-content">
                    <span class="info-box-text">Número de Federações</span>
                    {!! Form::open(['method' => 'POST', 'route' => 'admin.parametros.federacao']) !!}
                    <div class="input-group">
                        {!! Form::text('qtd', $parametro->federacao, ['class' => 'form-control', 'required' => 'required']) !!}
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit" id="converter"><i class='fas fa-save'></i></button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box shadow">
            <span class="info-box-icon bg-primary"><i class="fas fa-clipboard-check"></i></span>
            <div class="info-box-content">
                <div class="info-box-content">
                    <span class="info-box-text">Número de Sinodais</span>
                    {!! Form::open(['method' => 'POST', 'route' => 'admin.parametros.sinodal']) !!}
                    <div class="input-group">
                        {!! Form::text('qtd', $parametro->sinodal, ['class' => 'form-control', 'required' => 'required']) !!}
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit" id="converter"><i class='fas fa-save'></i></button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function(){
        
    });
                                                                            
</script>
@endpush