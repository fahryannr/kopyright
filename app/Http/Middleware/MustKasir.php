<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MustKasir
{

    public function handle(Request $request, Closure $next): Response
    {
        //bisa melewati middleware jika role = kasir
        dd(Auth::user());


        return $next($request);
    }
}
