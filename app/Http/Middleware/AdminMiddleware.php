<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário está autenticado e se o tipo é "admin"
        if (auth()->check() && auth()->user()->type === 'admin') {
            return $next($request);
        }

        // Caso contrário, redirecione ou retorne um erro 403 (acesso negado)
        // Caso contrário, redirecione para a página inicial (home)
        return redirect('/')->with('error', 'Acesso negado. Você não é um administrador.');
    }
}
