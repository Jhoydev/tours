<?php

namespace App\Http\Middleware;

use Closure;

class Insignia
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->get('base_de_datos')){
            \Config::set('database.connections.mysql.database',session()->get('base_de_datos'));
            \DB::reconnect('mysql');
        }
        return $next($request);
    }
}
