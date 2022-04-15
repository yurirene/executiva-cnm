@extends('template')

@section('title', 'Delegados')

@section('content_header')
    <h1>Delegados</h1>
@stop


@section('content')

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


@endsection
@push('js')
{!! $dataTable->scripts() !!}
@endpush