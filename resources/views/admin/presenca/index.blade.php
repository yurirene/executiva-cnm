@extends('template')

@section('title', 'Painel de Presença')

@section('content_header')
<h1>Painel de Presença</h1>
@stop


@section('content')

<div class="row mb-3">
    <div class="col-md-4">
        <div class="info-box shadow">
            <span class="info-box-icon bg-secondary"><i class="fas fa-user-friends"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Federações Presentes: XX</span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box shadow">
            <span class="info-box-icon bg-info"><i class="fas fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Sinodais Presentes: XX</span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box shadow">
            <span class="info-box-icon bg-secondary"><i class="fas fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Quantidade Delegados: XX</span>
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
                    {!! Form::open(['method' => 'POST', 'url' => '#']) !!}
                    <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-on="Ativado" data-off="Desativado" id="qrcode"  >
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
                            role="tab" aria-controls="painel-presentes" aria-selected="false">Delegados Presentes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="painel-ausentes-tab" data-toggle="pill" href="#painel-ausentes" 
                            role="tab" aria-controls="painel-ausentes" aria-selected="false">Delegados Ausentes</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="painel-tabContent">
                    <div class="tab-pane fade" id="painel-presentes" role="tabpanel" aria-labelledby="painel-presentes-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card"></div>
                            </div>

                            <div class="col-md-6">
                                <div class="card"></div>
                            </div>
                        </div>    
                    </div>
                   
                    <div class="tab-pane fade" id="painel-ausentes" role="tabpanel" aria-labelledby="painel-ausentes-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card"></div>
                            </div>

                            <div class="col-md-6">
                                <div class="card"></div>
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
<script>
    $(document).ready(function(){
        
        
        
        
        //     $('#faltam-votar-modal').on('show.bs.modal', function (event) {
            //         var modal = $(this)
            //         var lista = faltamVotar();
            //         var ids_lista = lista.map(function(item){
                //             return item.codigo;
                //         });
                //         setTimeout(function run() {
                    
                    //             let nova_lista = atualizarLista().map(function (item) {
                        //                 return item.codigo;
                        //             });
                        //             let novos_ids = ids_lista.filter(function(item) {
                            //                 if(!nova_lista.includes(item)) {
                                //                     return item;
                                //                 }
                                //             });
                                //             novos_ids.forEach(function(id) {
                                    //                 var li = $('#'+id).closest('li');
                                    //                 li.fadeOut('slow', function() { li.remove(); });
                                    //             });
                                    
                                    //             let total_falta_votar = $('.faltam-votar').length;                
                                    //             $('#total_modal_faltam_votar').text(total_falta_votar);
                                    
                                    //             if(modal.hasClass('show')){
                                        //                 setTimeout(run, 3000);
                                        //             }
                                        //         }, 3000);
                                        //     });
                                        
                                        //     $('#faltam-votar-modal-federacoes').on('show.bs.modal', function (event) {
                                            //         var modal = $(this)
                                            //         faltamVotarFederacoes();
                                            //         setTimeout(function run() {
                                                //             faltamVotarFederacoes();
                                                //             if(modal.hasClass('show')){
                                                    //                 setTimeout(run, 10000);
                                                    //             }
                                                    //         }, 3000);
                                                    //     });
                                                    
                                                });
                                                
                                                // function faltamVotar(){
                                                    //     $('#faltam-votar-list').empty();
                                                    //     var lista = null;
                                                    
                                                    //     jQuery.ajaxSetup({async:false});
                                                    //     $.get( "{{route('admin.presenca.get-presenca-sinodal')}}", function( data ) {
                                                        //         data.forEach(function(value){
                                                            //             let item_list = "<li id='"+value.codigo+"' class='list-group-item d-flex justify-content-between align-items-center faltam-votar'>"+value.nome+"</li>";
                                                            //             $('#faltam-votar-list').append(item_list);
                                                            //         })
                                                            //         if (data.length==0) {
                                                                //             $('#faltam-votar-modal').modal('hide');
                                                                //             $('#texto_em_andamento').hide();
                                                                //             $('#spinner').html("<h4>Todos Já Votaram</h4><p>Finalize para desbloquear o resultado</p>");
                                                                
                                                                //         }
                                                                //         lista = data;
                                                                //     })
                                                                //     return lista;
                                                                // }
                                                                // function atualizarLista(){
                                                                    
                                                                    //     var lista = null;
                                                                    
                                                                    //     jQuery.ajaxSetup({async:false});
                                                                    //     $.get( "{{route('admin.presenca.get-presenca-sinodal')}}", function( data ) {
                                                                        //         if (data.length==0) {
                                                                            //             $('#faltam-votar-modal').modal('hide');
                                                                            //             $('#texto_em_andamento').hide();
                                                                            //             $('#spinner').html("<h4>Todos Já Votaram</h4><p>Finalize para desbloquear o resultado</p>");
                                                                            
                                                                            //         }
                                                                            //         lista = data;
                                                                            //     });
                                                                            //     return lista;
                                                                            // }
                                                                            
                                                                        </script>
                                                                        @endpush