<?php

namespace App\Exports;

use App\Http\Controllers\EleicaoController;
use App\Models\Delegado;
use App\Models\Pauta;
use App\Models\Urna;
use App\Models\VotacaoPauta;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FaltamVotarPautaExport implements FromCollection, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pauta = Pauta::where('status', true)->first();
        if(is_null($pauta) || !$pauta->status ){
            return collect();
        }
        $jaVotaram = VotacaoPauta::select('delegado_id')->where('pauta_id', $pauta->id)->get()->toArray();
        $faltam = Delegado::select('nome', 'federacao', 'sinodal')
            ->whereNotIn('id', $jaVotaram)
            ->whereHas('regiao', function($sql) {
                return $sql->where('status', 1);
            })
            ->orderBy('federacao', 'asc')
            ->orderBy('nome', 'asc')
            ->get();
        return $faltam;
    }
}
