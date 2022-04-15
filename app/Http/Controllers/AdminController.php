<?php

namespace App\Http\Controllers;

use App\Models\Parametro;
use App\Models\UMP;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function parametros()
    {
        $parametro = Parametro::first();
        return view('admin.parametros.index', [
            'parametro' => $parametro
        ]);
    }

    public function federacao(Request $request)
    {
        try {
            $parametro = Parametro::first();
            $parametro->update([
                'federacao' => $request->qtd
            ]);
            return redirect()->route('admin.parametros.index')
                ->with(['message' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('admin.parametros.index')
                ->withErrors('Erro ao realizar operação!');
        }
    }

    public function sinodal(Request $request)
    {
        try {
            $parametro = Parametro::first();
            $parametro->update([
                'sinodal' => $request->qtd
            ]);
            return redirect()->route('admin.parametros.index')
                ->with(['message' => 'Operação Realizada com Sucesso!']);
        } catch (\Throwable $th) {
            return redirect()->route('admin.parametros.index')
                ->withErrors('Erro ao realizar operação!');
        }
    }
    
    public function presenca()
    {
        try {
            $parametro = Parametro::first();
            $parametro->update([
                'presenca' => $parametro->presenca == 1 ? 0 : 1
            ]);
            
            return [
                'mensagem' => 'Operação Realizada com sucesso!',
                'status' => true
            ];
        } catch (\Throwable $th) {
            return [
                'mensagem' => 'Erro ao Processar!',
                'status' => false
            ];
        }
    }
}
