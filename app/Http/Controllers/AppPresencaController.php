<?php

namespace App\Http\Controllers;

use App\Models\Andamento;
use App\Models\Candidato;
use App\Models\Delegado;
use App\Models\Pauta;
use App\Models\Urna;
use App\Models\VotacaoPauta;
use App\Services\EleicaoService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AppPresencaController extends Controller
{

    public function login()
    {
        Session::pull('delegado-presente');
        return view('app-presenca.login');
    }

    public function logar(Request $request)
    {
        try {
            $delegado = Delegado::where('codigo', $request->codigo)->first();
            if (!$delegado) {
                throw new Exception('Delegado não Encontrado');
            }
            $pauta = Pauta::orderBy('id', 'desc')->first();
            if (!$pauta) {
                throw new Exception('Espere a Mesa Diretora Iniciar');
            }
            if (!$pauta->status) {
                throw new Exception('Pauta Encerrada');
            }
            $votou = VotacaoPauta::where('pauta_id', $pauta->id)
                ->where('delegado_id', $delegado->id)
                ->count();
            if($votou > 0){
                throw new Exception('Você já votou nessa pauta');
            }

            Session::put('delegado', $delegado);

            return redirect()->route('app-presenca.opcoes')
                ->with('message',[
                    'type' => 'success',
                    'message' => 'Tudo certo, '.$delegado->nome
                ]
            );
        } catch (Exception $e) {
            return redirect()->route('app-presenca.login')
                ->with('message',[
                    'type' => 'danger',
                    'message' => $e->getMessage()
                ]
            );
        }
    }

    public function opcoes()
    {
        $delegado = session()->get('delegado');
        $pauta = Pauta::where('status', true)->first();
        $opcoes = [
            'SIM' => 'SIM',
            'NÃO' => 'NÃO'
        ];
        $cabecalho = $pauta->texto;
        return view('app-presenca.opcoes', [
            'cabecalho' => $cabecalho,
            'opcoes' => $opcoes,
            'eleitor' => $delegado,
            'pauta' => $pauta
        ]);
    }

    public function votar(Request $request)
    {
        try {    
            $eleitor = Session::get('delegado');
            $pauta_id = $request->pauta;
            VotacaoPauta::create([
                'delegado_id' => $eleitor->id,
                'pauta_id' => $pauta_id,
                'voto' => $request->voto
            ]);
            Session::pull('eleitor');
            return redirect()->route('app-presenca.login')
                ->with('message',[
                    'type' => 'success',
                    'message' => 'Voto Computado!'
                ]
            );
            
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('app-presenca.login')
                ->with('message',[
                    'type' => 'danger',
                    'message' => 'Algo deu errado. Tente Novamente!'
                ]
            );
        }

    }
}
