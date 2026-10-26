<?php

namespace App\Http\Controllers\Cbt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Display the CBT login page.
     */
    public function showLogin()
    {
        return view('cbt.auth.login');
    }

    /**
     * Authenticate a CBT user.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'The email or password is incorrect.',
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if (! in_array($user->role, [
            'administrator',
            'examiner',
            'student',
        ], true)) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('cbt.login')
                ->withErrors([
                    'email' => 'This account does not have an authorised CBT role.',
                ]);
        }

        return redirect()->route('cbt.dashboard');
    }

    /**
     * Log out the authenticated CBT user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('cbt.login')
            ->with('success', 'You have logged out successfully.');
    }
}
