<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureCbtRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('cbt.login');
        }

        if (! $user->is_active) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('cbt.login')
                ->withErrors([
                    'identifier' => 'Your account is inactive. Please contact the school administrator.',
                ]);
        }

        if (! in_array($user->role, $roles, true)) {
            abort(403, 'You are not authorised to access this page.');
        }

        return $next($request);
    }
}
