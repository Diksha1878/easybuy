<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (!empty(session('user'))) {
            if (in_array($request->segment(1), ['login', 'signup'])) {
                return redirect('/');
            }
            return $next($request);
        } else {
            if (in_array($request->segment(1), ['login', 'signup'])) {
                return $next($request);
            } else {
                session(['last_url' => request()->getRequestUri()]);
                return redirect('login');
            }
        }
    }
}
