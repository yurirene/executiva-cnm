<?php

namespace App\Services;


class RegiaoService
{
    public const NORTE = 1;
    public const NORDESTE = 2;
    public const CENTRO_OESTE = 3;
    public const SUDESTE = 4;
    public const SUL = 5;
    public const CNM = 6;

    public const REGIOES = [
        self::NORTE => 'Norte',
        self::NORDESTE => 'Nordeste',
        self::CENTRO_OESTE => 'Centro Oeste',
        self::SUDESTE => 'Sudoeste',
        self::SUL => 'Sul',
        self::CNM => 'CNM'
    ];

    public const ESTADOS = [
        self::NORTE => [
            'Acre', 
            'Amazonas', 
            'Amapá', 
            'Pará', 
            'Rondônia', 
            'Roraima', 
            'Tocantins'
        ],
        self::NORDESTE => [
            'Alagoas',
            'Bahia',
            'Ceará',
            'Maranhão',
            'Piauí',
            'Pernambuco',
            'Paraíba',
            'Rio Grande do Norte',
            'Sergipe',
        ],
        self::CENTRO_OESTE => [
            'Goiás',
            'Mato Grosso',
            'Mato Grosso do Sul',
            'Distrito Federal'
        ],
        self::SUDESTE => [
            'Espírito Santo',
            'Minas Gerais',
            'Rio de Janeiro',
            'São Paulo'
        ],
        self::SUL => [
            'Paraná',
            'Rio Grande do Sul',
            'Santa Catarina'
        ],
        self::CNM => [
            'CNM',
        ]
    ];

    public static function retornarRegiao($estado) 
    {
        $lista = collect(self::ESTADOS);
        foreach ($lista as $k => $v) {
            if (in_array($estado, $v)) {
                return $k;
            }
        }

        return;
        
    }

}