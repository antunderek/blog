<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Illuminate\Support\Facades\Auth;

class Writer
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
        if (!Auth::user())
        {
            return abort(404);
        }
        $value = Auth::user()->role_id;
        $writer = Role::where('id', $value)->first();
        if ($writer->writer)
        {
            return $next($request);
        }
        return abort(404);
    }
}
