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
        $regioes = Regiao::get()->pluck('nome', 'id');
        $regioes_selecionadas = Regiao::where('status', 1)->get()->pluck('id');
        $sequencias_logs = DB::table('log_importacoes')->select('sequencia')->distinct()->get()->pluck('sequencia', 'sequencia'); 
        return $dataTable->render('admin.delegados.index', [
            'regioes_selecionadas' => $regioes_selecionadas,
            'regioes' => $regioes,
            'sequencias_logs' => $sequencias_logs
        ]);
    }

}
