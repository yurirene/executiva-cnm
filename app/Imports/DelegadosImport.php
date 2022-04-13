<?php

namespace App\Imports;

use App\Models\Delegado;
use App\Models\LogImportacao;
use App\Services\RegiaoService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DelegadosImport implements ToCollection, WithHeadingRow, WithChunkReading, SkipsEmptyRows
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            if(!$this->validar($row)) {
                continue;
            }
            $regiao = RegiaoService::retornarRegiao($row['estado']);
            if (!$regiao) {
                $erro = 'Estado [' . $row['estado'] . '] não encontrado';
                $this->lancarErro($erro, $row);
                continue;
            }
            $data = [
                'nome' => $row['nome'] . " " . $row['sobrenome'],
                'codigo' => str_pad($row['id'], 11, '0', STR_PAD_LEFT),
                'federacao' => $row['federacao'],
                'sinodal' => $row['sinodal'],
                'estado' => $row['estado'],
                'regiao_id' => $regiao
            ];
            try{
                Delegado::updateOrCreate(
                    ['codigo' => $row['id'], 'nome' => $row['nome']],
                    $data
                );
            } catch(\Exception $e) {
                Log::error($e->getMessage());
                $this->lancarErro(date('d-m-y') . 'Erro lançado no log do sistema: ', $row);
            }
        }
    }
    
    public function validar($row)
    {
        $obrigatorios = ['nome', 'federacao', 'sinodal', 'estado'];
        $campos_faltantes = array();
        foreach ($obrigatorios as $campo) {
            if (empty($row[$campo])) {
                $campos_faltantes[] = $campo;
            }
        }

        if (!empty($campos_faltantes)) {
            $erro = 'Estão faltando os campos: [ ' . implode(',', $campos_faltantes) . " ]";
            $this->lancarErro($erro, $row);
            return false;
        }
        return true;
    }

    public function lancarErro($erro, $row)
    {
        LogImportacao::create([
            'sequencia' => date('ymd'),
            'codigo' => $row['id'],
            'nome' => $row['nome'],
            'erro' => $erro

        ]);
    }

    public function chunkSize():int
    {
        return 300;
    }


}
