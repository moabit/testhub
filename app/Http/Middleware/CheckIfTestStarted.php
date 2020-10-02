<?php

namespace App\Http\Middleware;

use Closure;


class CheckIfTestStarted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next  )
    {
        if (!$request->session()->exists('startedTests.'. $request->id)) {
            dd($request);
            return redirect('/home');
        }
        return $next($request);
    }
}
