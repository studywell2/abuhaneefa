<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCbtRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('cbt.login');
        }

        if (! in_array($user->role, $roles, true)) {
            abort(403, 'You are not authorised to access this page.');
        }

        return $next($request);
    }
}
