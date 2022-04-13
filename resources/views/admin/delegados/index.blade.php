@extends('template')

@section('title', 'Delegados')

@section('content_header')
    <h1>Delegados</h1>
@stop


@section('content')

<div class="row">
    <div class="col-md-3">
        <a href="#importar-delegados" data-toggle="modal" data-target="#importar-delegados">
            <div class="info-box shadow">
                <span class="info-box-icon bg-primary"><i class="fas fa-upload"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Importar Delegados</span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="#definir-regioes" data-toggle="modal" data-target="#definir-regioes">
            <div class="info-box shadow">
                <span class="info-box-icon bg-primary"><i class="fas fa-map-marker-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Definir Regiões</span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="#apagar-delegados" data-toggle="modal" data-target="#apagar-delegados">
            <div class="info-box shadow">
                <span class="info-box-icon bg-danger"><i class="fas fa-trash"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Apagar Todos os Registros</span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="#log-importacao" data-toggle="modal" data-target="#log-importacao">
            <div class="info-box shadow">
                <span class="info-box-icon bg-secondary"><i class="fas fa-history"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Log Importação</span>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
           
            <div class="card-header">
                Lista de Delegados
            </div>
            <div class="card-body">
                {!! $dataTable->table() !!}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="importar-delegados" tabindex="-1" aria-labelledby="ImportarDelegadoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ImportarDelegadoLabel">Importar Delegados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        {!! Form::open(['method' => 'POST', 'route' => 'admin.configuracoes.importar-delegados', 'files' => true]) !!}
                        <div class="form-group{{ $errors->has('arquivo') ? ' has-error' : '' }}">
                        {!! Form::label('arquivo', 'Planilha') !!}
                        {!! Form::file('arquivo', ['required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('arquivo') }}</small>
                        </div>
                        <div class="btn-group pull-right">
                        {!! Form::submit('Importar', ['class' => 'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="definir-regioes" tabindex="-1" aria-labelledby="resultadoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultadoLabel">Resultado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        {!! Form::open(['method' => 'POST', 'route' => 'admin.configuracoes.definir-regiao']) !!}
                            
                        <div class="form-group">
                            {!! Form::label('regioes[]', 'Regiões') !!}
                            {!! Form::select('regioes[]', $regioes, $regioes_selecionadas, ['id' => 'regioes', 'class' => 'form-control isSelect2', 'required' => 'required', 'multiple' => true, 'style' => 'width:100%;']) !!}
                        </div>
                        <div class="btn-group pull-right">
                        {!! Form::submit('Atualizar', ['class' => 'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="apagar-delegados" tabindex="-1" aria-labelledby="resultadoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultadoLabel">Resultado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Essa operação apagará todos os registros de Delegados e Candidatos. Confirma Operação?</h3>
            </div>
            <div class="modal-footer">
                {!! Form::open(['method' => 'POST', 'route' => 'admin.delegados.apagar-todos']) !!}
                    <button class="btn btn-danger">Confirmar</button>
                {!! Form::close() !!}
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="log-importacao" tabindex="-1" aria-labelledby="resultadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultadoLabel">Log Importação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Referência</label>
                            {!! Form::select('sequencia', $sequencias_logs, null, ["class" => 'form-control', 'id' => 'sequencia']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table id="tabela-log" class="table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th>Erro</th>
                                    </tr>
                                </thead>
                                <tbody>
            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
{!! $dataTable->scripts() !!}
@endpush

@section('end_script')

<script>
    
    const Table = $('#tabela-log').DataTable( {
        "processing": true,
        "searching": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
        },
        "ajax": {
            "url": "{{route('admin.delegados.log-importacao')}}",
            "type": "POST",
            "data": {
                "_token" : "{{ csrf_token() }}",
                "sequencia": $('#sequencia option:selected').val()
            }
        },
        "columns": [
            { "data": "codigo" },
            { "data": "nome" },
            { "data": "erro" },
        ]
    } );

    Table.on('preXhr.dt', function(e, settings, data){
        data.sequencia = $('#sequencia').val();
    });

    $('#sequencia').on('change', function() {
        Table.ajax.reload();
        return false;
    })
</script>
@endsection