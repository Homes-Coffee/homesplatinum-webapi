<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Responses\JsonResponser;

class PinNotNull
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
        $pin = auth()->user()->wallet()->first() == null ? null : (auth()->user()->wallet()->first()->pin == null ? null : auth()->user()->wallet()->first()->pin);

        if ($pin == null) {
            return (new JsonResponser())->failure('PIN Belum Disetting', (object) ['message' => 'pin required']);
        }

        return $next($request);
    }
}
