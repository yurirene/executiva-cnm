<?php

namespace App\Http\Controllers;

use App\DataTables\AusenteDataTable;
use App\DataTables\AusenteFederacaoDataTable;
use App\DataTables\PresenteDataTable;
use App\DataTables\PresenteFederacaoDataTable;
use App\Models\Parametro;
use App\Models\Presenca;

class PresencaController extends Controller
{
    public function index(
        PresenteDataTable $presenteDataTable, 
        PresenteFederacaoDataTable $presenteFederacaoDataTable,
        AusenteDataTable $ausenteDataTable, 
        AusenteFederacaoDataTable $ausenteFederacaoDataTable
    )
    {
        $parametro = Parametro::first();
        return view('admin.presenca.index', [
            'presenteDataTable' => $presenteDataTable->html(),
            'presenteFederacaoDataTable' => $presenteFederacaoDataTable->html(),
            'ausenteDataTable' => $ausenteDataTable->html(),
            'ausenteFederacaoDataTable' => $ausenteFederacaoDataTable->html(),
            'totalFederacao' => $parametro->federacao,
            'totalSinodal' => $parametro->sinodal,
        ]);
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

    public function abrir()
    {
        try {
            Parametro::first()->update([
                'presenca' => true
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
            Parametro::first()->update([
                'presenca' => false
            ]);
            return redirect()->route('admin.presenca.index')
                ->with(['message' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('admin.presenca.index')
                ->withErrors('Erro ao realizar operação!');
        }
    }

    
}
