<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
      if ($request->user() && $request->user()->role != 'SA' && $request->user()->role != 'GA') {
        echo 'came in';
        abort(403, 'Unauthorized action.');
      }
      return $next($request);
    }
}
