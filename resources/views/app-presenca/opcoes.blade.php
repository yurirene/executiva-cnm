@extends('app-presenca.template')

@section('content')
<div class="row mt-5">
    <div class="col">
        <h4>Delegado(a): <b>{{$eleitor->nome}}</b></h4>
    </div>
</div>
<div class="row">
    <div class="col p-3 text-center">
        <h3 class="text-left mt-2 mb-4">{{$cabecalho}}</h3>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action">
                <h4>Voto em Branco</h4>
                <button class="btn-sm btn-primary" data-toggle="modal" data-target="#confirmarVoto" data-id="0" data-nome="Branco">Votar</button>
            </li>
            @foreach($opcoes as $key => $opcao)
                <li class="list-group-item list-group-item-action">
                    <h4>{{$opcao}}</h4>
                    <button class="btn-sm btn-primary" data-toggle="modal" data-target="#confirmarVoto" data-id="{{$key}}" data-nome="{{$opcao}}">Votar</button>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="confirmarVoto">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Voto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('app-pautas.votar')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <h4>Confirmar Voto para: <b id="nome"></b></h4>
                    <input type="text" name="voto" id="id" hidden />
                    <input type="text" value="{{$pauta->id}}" name="pauta" id="pauta" hidden />
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@section('script')
<script>
    $('#confirmarVoto').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id = button.data('id')
      var nome = button.data('nome')
      
      var modal = $(this)
      modal.find('#nome').text(nome)
      modal.find('#id').val(id)
    })
</script>
@endsection