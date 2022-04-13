@extends('app-presenca.template')

@section('content')
<div class="row mt-5"></div>
<div class="row">
    <div class="col  text-center">
        <img src="/img/bg-logo.png" class="img-responsive"  style="max-height: 190px;"/>
    </div>
</div>
{{-- @if(Configuracoes::qrCode())
<div class="row">
    <div class="col-md-6 offset-md-3" style="max-width: 500px;"  id="reader">
    </div>
</div>
@endif --}}
<div class="row mt-5">
    <div class="col p-3 text-center">
        <form action="{{route('app-presenca.logar')}}" method="POST" id="form-login">
            @csrf
            <div class="form-group">
                <label for="codigo" class="text-white font-weight-bold">CODIGO DE ACESSO</label>
                <input type="text" class="form-control numeric" id="codigo" name="codigo" maxlength="11">
            </div>
            <button type="submit" id="botao-entrar" class="btn btn-primary">Entrar</button>
        </form>
    </div>
</div>
<div id="loading"></div>
@endsection

@section('script')
{{-- @if(Configuracoes::qrCode())

<script>


function onScanSuccess(decodedText, decodedResult) {
    $('body').loading({
        stoppable: true,
        message: 'Aguarde...',
    });
    html5QrcodeScanner.clear();

    $('#codigo').val(decodedText);
    $('#form-login').submit();

}

var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);


</script>
@endif --}}
<script>

    $(document).on("input", ".numeric", function() {
        this.value = this.value.replace(/\D/g,'');
    });

</script>
@endsection

