<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Responses\JsonResponser;

class PinRequired
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
        $pin = auth()->user()->wallet()->first()->pin;

        if ($pin == null) {
            return (new JsonResponser())->failuer('PIN Dibutuhkan', (object) ['message' => 'pin required']);
        }

        return $next($request);
    }
}
