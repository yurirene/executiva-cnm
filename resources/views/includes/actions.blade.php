<div class="dropdown">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
        Ações
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        
        @if(!isset($edit) || (isset($edit) && $edit == true))
        <a class="dropdown-item" href="{{ route($route.'.edit', $id) }}">Editar</a>
        @endif

        @if((isset($status) && $status == true))
        <a class="dropdown-item" href="{{ route($route.'.status', $id) }}">Status</a>
        @endif

        @if(!isset($delete) || (isset($delete) && $delete == true))
        <button class="dropdown-item" href="#" onclick="deleteRegistro('{{ route($route.'.delete', $id) }}')">Apagar</button>
        @endif
    </div>
</div>