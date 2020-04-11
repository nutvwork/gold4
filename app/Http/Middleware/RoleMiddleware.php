<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles) {
        if ($request->user() && $request->user()->authorizeRoles($roles)) {
            return $next($request);
        }
        return redirect('/');
    }
}