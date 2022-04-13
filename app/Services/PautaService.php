<?php

namespace App\Services;

use App\Models\Andamento;
use App\Models\Candidato;
use App\Models\Delegado;
use App\Models\Pauta;
use App\Models\Regiao;
use App\Models\Urna;
use App\Models\VotacaoPauta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PautaService
{
    public static function getHistorico()
    {
        $retorno = Pauta::where('status', false)
            ->orderBy('id','DESC')
            ->get()
            ->toArray();
        foreach ($retorno as $chave => $pauta) {
            $resultado = VotacaoPauta::select(DB::raw('voto, COUNT(voto) as qtd'))
                ->where('pauta_id', $pauta['id'])
                ->groupBy('voto')
                ->orderBy('qtd', 'desc')
                ->get()
                ->toArray();
            foreach ($resultado as $key => $r) {
                if ($r['voto'] === '0') {
                    $resultado[$key]['voto'] = 'Em Branco';
                    continue;
                }
                $resultado[$key]['voto'] = $r['voto'];
            }
            $retorno[$chave]['resultado'] = $resultado;
        }

        return self::verificaVencedorHistorico($retorno);
    }

    public static function getResultado($pauta) 
    {
        $resultado = VotacaoPauta::select(DB::raw('voto, COUNT(voto) as qtd'))
            ->where('pauta_id', $pauta)
            ->groupBy('voto')
            ->orderBy('qtd', 'desc')
            ->get()
            ->toArray();
        foreach ($resultado as $key => $r) {
            if ($r['voto'] === '0') {
                $resultado[$key]['voto'] = 'Em Branco';
                continue;
            }
            $resultado[$key]['voto'] = $r['voto'];
        }
        return self::verificaVencedorResultado($resultado);
    }

    public static function verificaVencedorHistorico($array)
    {
        $maioria = self::minimoVotos();
        foreach ($array as $key=>$value) {
            foreach ($value['resultado'] as $k => $resultado) {
                if (intval($resultado['qtd']) >= $maioria) {
                    $array[$key]['resultado'][$k]['vencedor'] = 1;
                }
            }
        }
        return $array;
    }


    public static function verificaVencedorResultado($array)
    {
        $maioria = self::minimoVotos();
        foreach ($array as $k => $resultado) {
            if (intval($resultado['qtd']) >= $maioria) {
                $array[$k]['vencedor'] = 1;
            }
        }
        return $array;
    }

    public static function minimoVotos()
    {
        $total_delegados = Delegado::whereHas('regiao', function($sql) {
            return $sql->where('status', 1);
        })->count();
        return floor(intval($total_delegados)/2) + 1;
    }

    public static function getCandidatos($andamento)
    {
        $candidatos = Candidato::where('cargo_id', $andamento->cargo->id)->get();
        foreach ($candidatos as $candidato) {
            if (empty($candidato->foto)) {
                $candidato->foto = '/img/perfil_branco.png';
            }
        }
        return $candidatos;
    }
}