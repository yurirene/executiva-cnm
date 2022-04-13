<?php

namespace App\Exports;

use App\Http\Controllers\EleicaoController;
use App\Models\Delegado;
use App\Models\Urna;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FaltamVotarExport implements FromCollection, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $escrutinio = EleicaoController::ultimoEscrutinio();
        if(is_null($escrutinio) || !$escrutinio->status ){
            return collect();
        }
        $jaVotaram = Urna::select('eleitor')->where('andamento', $escrutinio->id)->get()->toArray();
        $faltam = Delegado::select('nome','federacao', 'sinodal')
            ->whereNotIn('id', $jaVotaram)
            ->whereHas('regiao', function($sql) {
                return $sql->where('status', 1);
            })
            ->get();
        return $faltam;
    }
}
