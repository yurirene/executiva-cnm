<?php

use App\Http\Controllers\{
    DelegadoController,
    EleicaoController,
    AdminController,
    AppPresencaController,
    PresencaController,
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin'], function() {
    Auth::routes();
});


Route::group(['middleware' => ['auth'],'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/', [AdminController::class, 'index'])->name('index');
    
    // DELEGADO

    Route::resource('delegados', DelegadoController::class);
    Route::get('/delegados/{delegado}/status', [DelegadoController::class, 'status'])->name('delegados.status');

    // PRESENCA

    Route::get('/presenca', [PresencaController::class, 'index'])->name('presenca.index');
    Route::get('/get-presentes-sinodal', [PresencaController::class, 'getPresentesSinodal'])->name('presenca.get-presenca-sinodal');
    Route::get('/get-presentes-federacao', [PresencaController::class, 'getPresentesFederacao'])->name('presenca.get-presenca-federacao');
    Route::get('/totalizadores', [PresencaController::class, 'totalizadores'])->name('presenca.totalizadores');
    Route::post('/nova-contagem', [PresencaController::class, 'novaContagem'])->name('presenca.nova-contagem');

    // DATATABLE
    Route::get('presenteSinodal', [PresencaController::class, 'presenteSinodal'])->name('datatable.presente-sinodal');
    Route::get('presenteFederacao', [PresencaController::class, 'presenteFederacao'])->name('datatable.presente-federacao');
    Route::get('ausenteSinodal', [PresencaController::class, 'ausenteSinodal'])->name('datatable.ausente-sinodal');
    Route::get('ausenteFederacao', [PresencaController::class, 'ausenteFederacao'])->name('datatable.ausente-federacao');

    // PARAMETROS
    Route::get('parametros', [AdminController::class, 'parametros'])->name('parametros.index');
    Route::post('parametros/sinodal', [AdminController::class, 'sinodal'])->name('parametros.sinodal');
    Route::post('parametros/federacao', [AdminController::class, 'federacao'])->name('parametros.federacao');
    Route::post('parametros/presenca', [AdminController::class, 'presenca'])->name('parametros.presenca');

});


Route::group(['prefix' => 'presenca'], function() {

    Route::get('/', [AppPresencaController::class, 'login'])->name('app-presenca.login');
    Route::post('/logar', [AppPresencaController::class, 'logar'])->name('app-presenca.logar');    
});
