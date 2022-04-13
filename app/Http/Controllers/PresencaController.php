<?php

namespace App\Http\Controllers;

use App\Exports\FaltamVotarPautaExport;
use App\Models\Delegado;
use App\Models\Presenca;
use App\Models\VotacaoPauta;
use App\Services\PautaService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class PresencaController extends Controller
{
    public function index()
    {
        return view('admin.presenca.index');
    }

    public function abrir()
    {
        try {
            Presenca::update([
                'status' => true
            ]);
            return redirect()->route('admin.presenca.index')
                ->with(['message' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('admin.presenca.index')
                ->withErrors('Erro ao realizar operação!');
        }
    }
    public function fechar()
    {
        try {
            Presenca::update([
                'status' => false
            ]);
            return redirect()->route('admin.presenca.index')
                ->with(['message' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('admin.presenca.index')
                ->withErrors('Erro ao realizar operação!');
        }
    }

    
}
