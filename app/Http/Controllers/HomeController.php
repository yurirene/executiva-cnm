<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Delegado');
    }

    public function presenca()
    {
        return Inertia::render('Presenca');
    }

    public function importar()
    {
        return Inertia::render('Importar');
    }

    public function dataTable()
    {
        return response()->json([
            'data' => [
            [
                    'nome' => 'Yuri Rene',
                    'federacao' => 'Federação 1',
                    'estado' => 'Estado',
                    'regiao' => 'Norte'
                ],
                [
                    'nome' => 'Paula Kathelen',
                    'federacao' => 'Federação 2',
                    'estado' => 'Estado 2',
                    'regiao' => 'Nordeste'
                ]
            ]
        ]);
    }
}
