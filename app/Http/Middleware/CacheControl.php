<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CacheControl
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
        $response = $next($request);
        
        // if($request->is('admin/*') || $request->is('vendor/*')){
        //     $response->header('Cache-Control', '');
        // }
        // else{
        //     $response->header('Cache-Control', 'max-age=2592000');
        // }

        // Or whatever you want it to be:
        // $response->header('Cache-Control', 'max-age=100');

        return $response;
    }
}
