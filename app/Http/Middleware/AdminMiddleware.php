<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response
    {
        if (
            session('user_role')
            != 'admin'
        ) {

            return redirect('/products')
                ->withErrors(
                    'Access Denied'
                );
        }

        return $next($request);
    }
}