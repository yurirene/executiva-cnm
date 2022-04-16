@extends('template')

@section('title', 'Painel de Presença')

@section('content_header')
<h1>Painel de Presença</h1>
@stop


@section('content')

<div class="row mb-3">
    <div class="col-md-4">
        <div class="info-box shadow">
            <span class="info-box-icon bg-secondary"><i class="fas fa-flag"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Quórum Federações: <span id="total_federacoes">0</span> / {{$totalFederacao}}</span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box shadow">
            <span class="info-box-icon bg-secondary"><i class="fas fa-flag"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Quórum Sinodais: <span id="total_sinodais">0</span> / {{$totalSinodal}}</span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box shadow">
            <span class="info-box-icon bg-secondary"><i class="fas fa-flag"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Quantidade de Delegados: <span id="total_delegados">0</span></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="info-box shadow">
            <span class="info-box-icon bg-success"><i class="fas fa-clipboard-check"></i></span>
            <div class="info-box-content">
                <div class="info-box-content">
                    <span class="info-box-text">Permitir Registro</span>
                    <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-on="Ativado" data-off="Desativado" id="leitura" {{ $presenca == true ? 'checked' : ''  }}>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box shadow">
            <span class="info-box-icon bg-danger"><i class="fas fa-exclamation-triangle"></i></span>
            <div class="info-box-content">
                <div class="info-box-content">
                    <span class="info-box-text">Nova Contagem</span>
                    {!! Form::open(['method' => 'POST', 'route' => 'admin.presenca.nova-contagem', 'class' => 'form-horizontal']) !!}
                    <div class="btn-group pull-right">
                    {!! Form::submit('Resetar', ['class' => 'btn btn-danger']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="painel-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="painel-presentes-tab" data-toggle="pill" href="#painel-presentes" 
                            role="tab" aria-controls="painel-presentes" aria-selected="false">Presentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="painel-ausentes-tab" data-toggle="pill" href="#painel-ausentes" 
                            role="tab" aria-controls="painel-ausentes" aria-selected="false">Ausentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="painel-cnm-tab" data-toggle="pill" href="#painel-cnm" 
                            role="tab" aria-controls="painel-cnm" aria-selected="false">CNM</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="painel-tabContent">
                    <div class="tab-pane fade active show" id="painel-presentes" role="tabpanel" aria-labelledby="painel-presentes-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card shadow h-100">
                                    <div class="card-header">
                                        Sinodais Presentes
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            {!! $presenteDataTable->table(['class'=>'table data-table']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card shadow h-100">
                                    <div class="card-header">
                                        Federações Presentes
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            {!! $presenteFederacaoDataTable->table(['class'=>'table data-table']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                   
                    <div class="tab-pane fade" id="painel-ausentes" role="tabpanel" aria-labelledby="painel-ausentes-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card shadow h-100">
                                    <div class="card-header">
                                        Sinodais Ausentes
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            {!! $ausenteDataTable->table(['class'=>'table data-table w-100']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card shadow h-100">
                                    <div class="card-header">
                                        Federações Ausentes
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            {!! $ausenteFederacaoDataTable->table(['class'=>'table data-table w-100']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="tab-pane fade" id="painel-cnm" role="tabpanel" aria-labelledby="painel-cnm-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow h-100">
                                    <div class="card-header">
                                        CNM
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            {!! $CNMDataTable->table(['class'=>'table data-table w-100']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>



@csrf
@endsection

@push('js')
{!! $presenteDataTable->scripts() !!}
{!! $presenteFederacaoDataTable->scripts() !!}
{!! $ausenteDataTable->scripts() !!}
{!! $ausenteFederacaoDataTable->scripts() !!}
{!! $CNMDataTable->scripts() !!}
<script>
    $(document).ready(function(){
        $(function(){ $('#leitura').bootstrapToggle() });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });
            $('#leitura').on('change', function(){
                $.ajax({
                    url: "{{route('admin.parametros.presenca')}}",
                    method: 'post',
                    success: function(result){
                        if (result.status == true) {
                            toastr.success(result.mensagem);
                            if ($('#leitura').is(':checked')) {
                                inicializar();
                            }
                            return;
                        }
                        toastr.error(result.mensagem);
                    }
                });
            })

            inicializar();

            function inicializar()
            {
                atualizar();
                setTimeout(function run() {
                    atualizar();
                    if ($('#leitura').is(':checked')) {
                        console.log('oi');
                        setTimeout(run, 5000);
                    }
                }, 5000);
            }

            function atualizar()
            {
                $('.data-table').DataTable().ajax.reload();
                $.ajax({
                    url: "{{route('admin.presenca.totalizadores')}}",
                    method: 'get',
                    success: function(result){
                        $('#total_sinodais').text(result.sinodal);
                        $('#total_federacoes').text(result.federacao);
                        $('#total_delegados').text(result.delegado);
                    }
                });
            }
    });
                                                                            
</script>
@endpush