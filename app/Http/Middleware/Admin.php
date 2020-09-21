<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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
        if(!isset($_SESSION["UsuarioRegistrado"]))//si no esta logeado lo llevo a la ruta de logeo
        {
            return redirect('admin/login');
        }
        return $next($request);
    }
}
