<?php

namespace App\Services;

use App\Models\Andamento;
use App\Models\Candidato;
use App\Models\Delegado;
use App\Models\Regiao;
use App\Models\Urna;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EleicaoService
{
    public static function getHistorico()
    {
        $retorno = Andamento::select('cargos.cargo', 'escrutinios.escrutinio', 'andamentos.id')
            ->join('cargos', 'cargos.id', 'andamentos.cargo_id')
            ->join('escrutinios', 'escrutinios.id', 'andamentos.escrutinio_id')
            ->where('status', false)
            ->orderBy('cargo_id','DESC')
            ->orderBy('escrutinio_id', 'DESC')
            ->get()
            ->toArray();
        foreach ($retorno as $chave => $escrutinio) {
            $resultado = Urna::select(DB::raw('candidato, COUNT(candidato) as votos'))
                ->where('andamento', $escrutinio['id'])
                ->groupBy('candidato')
                ->orderBy('votos', 'desc')
                ->get()
                ->toArray();
            foreach ($resultado as $key => $r) {
                $id = $r['candidato'];
                if ($id === '0') {
                    $resultado[$key]['candidato'] = 'Em Branco';
                    continue;
                }
                $delegado = Candidato::find($id);
                $resultado[$key]['candidato'] = $delegado->nome;
                $resultado[$key]['status'] = $delegado->status;
            }
            $retorno[$chave]['resultado'] = $resultado;
        }

        return self::verificaVencedorHistorico($retorno);
    }

    public static function getResultado($andamento) 
    {
        $resultado = Urna::select(DB::raw('candidato, COUNT(candidato) as votos'))
            ->where('andamento', $andamento)
            ->groupBy('candidato')
            ->orderBy('votos', 'desc')
            ->get()
            ->toArray();
        foreach ($resultado as $key => $r) {
            $resultado[$key]['id'] = $r['candidato'];
            $id = $r['candidato'];
                if ($id === '0') {
                    $resultado[$key]['candidato'] = 'Em Branco';
                    $resultado[$key]['foto'] = '/img/perfil_branco.png';
                    continue;
                }
                $candidato = Candidato::find($id);
                $resultado[$key]['candidato'] = $candidato->nome;
                $resultado[$key]['status'] = $candidato->status;
                $resultado[$key]['foto'] = $candidato->foto;
                if (empty($candidato->foto)) {
                    $resultado[$key]['foto'] = '/img/perfil_branco.png';
                }
        }
        return self::verificaVencedorResultado($resultado);
    }

    public static function verificaVencedorHistorico($array)
    {
        $maioria = self::minimoVotos();
        foreach ($array as $key=>$value) {
            foreach ($value['resultado'] as $k => $resultado) {
                if (intval($resultado['votos']) >= $maioria) {
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
            if (intval($resultado['votos']) >= $maioria) {
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
        $candidatos = Candidato::where('cargo_id', $andamento->cargo->id)->where('status', true)->get();
        foreach ($candidatos as $candidato) {
            if (empty($candidato->foto)) {
                $candidato->foto = '/img/perfil_branco.png';
            }
        }
        return $candidatos;
    }
}