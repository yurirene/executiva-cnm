<?php

namespace App\Http\Controllers;

use App\DataTables\AusenteDataTable;
use App\DataTables\AusenteFederacaoDataTable;
use App\DataTables\CNMDataTable;
use App\DataTables\PresenteDataTable;
use App\DataTables\PresenteFederacaoDataTable;
use App\Models\Delegado;
use App\Models\Parametro;
use App\Models\Presenca;
use Illuminate\Support\Facades\DB;

class PresencaController extends Controller
{
    public function index(
        PresenteDataTable $presenteDataTable, 
        PresenteFederacaoDataTable $presenteFederacaoDataTable,
        AusenteDataTable $ausenteDataTable, 
        AusenteFederacaoDataTable $ausenteFederacaoDataTable,
        CNMDataTable $CNMDataTable
    )
    {
        $parametro = Parametro::first();
        return view('admin.presenca.index', [
            'presenteDataTable' => $presenteDataTable->html(),
            'presenteFederacaoDataTable' => $presenteFederacaoDataTable->html(),
            'ausenteDataTable' => $ausenteDataTable->html(),
            'ausenteFederacaoDataTable' => $ausenteFederacaoDataTable->html(),
            'CNMDataTable' => $CNMDataTable->html(),
            'totalFederacao' => $parametro->federacao,
            'totalSinodal' => $parametro->sinodal,
            'presenca' => $parametro->presenca
        ]);
    }

    public function novaContagem()
    {
        try {
            DB::table('delegados')->update(['presente' => 0]);
            return redirect()->route('admin.presenca.index')
            ->with(['message' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('admin.presenca.index')
                ->withErrors('Erro ao realizar operação!');
        }
    }

    public function presenteSinodal(PresenteDataTable $dataTable)
    {
        return $dataTable->render('admin.presenca.index');
    }

    public function presenteFederacao(PresenteFederacaoDataTable $dataTable)
    {
        return $dataTable->render('admin.presenca.index');
    }

    public function ausenteSinodal(AusenteDataTable $dataTable)
    {
        return $dataTable->render('admin.presenca.index');
    }

    public function ausenteFederacao(AusenteFederacaoDataTable $dataTable)
    {
        return $dataTable->render('admin.presenca.index');
    }
    
    public function presenteCNM(CNMDataTable $dataTable)
    {
        return $dataTable->render('admin.presenca.index');
    }

    public function totalizadores()
    {
        try {
            $sinodal = Delegado::where('tipo', 1)
                ->where('presente', true)
                ->get()
                ->count();

            $federacao = Delegado::where('tipo', 2)
                ->where('presente', true)
                ->select(DB::raw('DISTINCT(federacao),regiao_id'))
                ->get()
                ->count();
            
            $delegado = Delegado::where('presente', true)
                ->get()
                ->count();

            return response()->json([
                'sinodal' => $sinodal,
                'federacao' => $federacao,
                'delegado' => $delegado
            ]);
        } catch (\Throwable $th) {
            return response()->json([]);
        }
    }

    
}
