<?php

namespace App\Http\Controllers\Cbt;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
     *
     * Students use admission numbers.
     * Administrators and examiners use email addresses.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'identifier' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $identifier = trim($credentials['identifier']);
        $password = $credentials['password'];

        /*
         * FIRST: Check whether the identifier belongs to a student.
         */
        $student = Student::with('user')
            ->where('admission_number', $identifier)
            ->first();

        if ($student) {

            if (! $student->is_active) {
                throw ValidationException::withMessages([
                    'identifier' => 'Your student account is inactive. Please contact the school administrator.',
                ]);
            }

            $user = $student->user;

            if (
                ! $user ||
                $user->role !== 'student' ||
                ! Hash::check($password, $user->password)
            ) {
                throw ValidationException::withMessages([
                    'identifier' => 'The admission number or password is incorrect.',
                ]);
            }

            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->route('cbt.dashboard');
        }

        /*
         * SECOND: Check administrator and examiner email login.
         */
        $user = User::where('email', $identifier)
            ->whereIn('role', ['administrator', 'examiner'])
            ->first();


        if (!$user || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'identifier' => 'The email address/admission number or password is incorrect.',
            ]);
        }

        // Prevent deactivated administrators and examiners from logging in.
        if (!$user->is_active) {
            throw ValidationException::withMessages([
                'identifier' => 'Your account is inactive. Please contact the school administrator.',
            ]);
        }

        Auth::login($user);


        $request->session()->regenerate();

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