<?php

use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/delegados', [HomeController::class, 'index'])->name('delegados');
    Route::get('/presenca', [HomeController::class, 'presenca'])->name('presenca');
    Route::get('/importar', [HomeController::class, 'importar'])->name('importar');
    Route::get('/delegados-datatable', [HomeController::class, 'datatable'])->name('delegados.datatable');
});


require __DIR__.'/auth.php';
