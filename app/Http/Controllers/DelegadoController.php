<?php

namespace App\Http\Controllers;

use App\DataTables\DelegadoDataTable;
use App\Imports\DelegadosImport;
use App\Models\Candidato;
use App\Models\Delegado;
use App\Models\LogImportacao;
use App\Models\Regiao;
use App\Models\UMP;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class DelegadoController extends Controller
{
    public function index(DelegadoDataTable $dataTable)
    {
        return $dataTable->render('admin.delegados.index');
    }

    public function status(Delegado $delegado)
    {
        try {
            $delegado->update([
                'presente' => $delegado->presente == 1 ? 0 : 1
            ]);
            return redirect()->route('admin.delegados.index')
            ->with(['message' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('admin.delegados.index')
                ->withErrors('Erro ao realizar operação!');
        }
    }

}
