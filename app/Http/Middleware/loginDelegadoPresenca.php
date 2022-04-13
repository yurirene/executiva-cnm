<?php

namespace App\Http\Middleware;

use App\Models\Regiao;
use Closure;
use Illuminate\Http\Request;

class loginDelegadoPresenca
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->exists('delegado-presente')) {
            return redirect()->route('app-presenca.login');
        }
        $delegado = session('delegado-presente');
        
        return $next($request);
    }
}
