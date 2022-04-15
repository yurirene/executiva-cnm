<?php

namespace App\Http\Controllers;

use App\Models\Andamento;
use App\Models\Candidato;
use App\Models\Delegado;
use App\Models\Parametro;
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
        return view('app-presenca.login');
    }

    public function logar(Request $request)
    {
        try {
            $delegado = Delegado::where('codigo', $request->codigo)->first();
            if (!$delegado) {
                throw new Exception('Delegado não Encontrado');
            }
            $chamada = Parametro::first()->presenca == 1;
            if (!$chamada) {
                throw new Exception('Chamada encerrada, procure o Secretário-Executivo');
            }

            if($delegado->presente == 1){
                throw new Exception('Você já registrou sua presença');
            }

            $delegado->update([
                'presente' => true
            ]);

            return redirect()->route('app-presenca.login')
                ->with('message',[
                    'type' => 'success',
                    'message' => $delegado->nome .', sua presença foi registrada'
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
}
