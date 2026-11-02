<?php

namespace App\Http\Controllers\Cbt\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ExaminerController extends Controller
{
    /**
     * Display all examiner accounts.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'examiner');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $activeExaminers = (clone $query)->where('is_active', true)->count();

        $inactiveExaminers = (clone $query)->where('is_active', false)->count();

        $examiners = $query->latest()->paginate(10)->withQueryString();

        return view('cbt.admin.examiners.index', compact(
            'examiners',
            'activeExaminers',
            'inactiveExaminers'
        ));
    }

    /**
     * Show the examiner registration form.
     */
    public function create()
    {
        return view('cbt.admin.examiners.create');
    }

    /**
     * Register a new examiner.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        ]);

        $temporaryPassword = Str::random(12);

        $examiner = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $temporaryPassword,
            'role' => 'examiner',
            'is_active' => true,
        ]);

        return redirect()
            ->route('cbt.admin.examiners.index')
            ->with('success', 'Examiner registered successfully.')
            ->with('examiner_credentials', [
                'name' => $examiner->name,
                'email' => $examiner->email,
                'password' => $temporaryPassword,
            ]);
    }

    /**
     * Display examiner details.
     */
    public function show(User $examiner)
    {
        abort_unless($examiner->role === 'examiner', 404);

        return view('cbt.admin.examiners.show', compact('examiner'));
    }

    /**
     * Show the examiner edit form.
     */
    public function edit(User $examiner)
    {
        abort_unless($examiner->role === 'examiner', 404);

        return view('cbt.admin.examiners.edit', compact('examiner'));
    }

    /**
     * Update examiner information.
     */
    public function update(Request $request, User $examiner)
    {
        abort_unless($examiner->role === 'examiner', 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($examiner->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $examiner->name = $validated['name'];
        $examiner->email = $validated['email'];

        if (!empty($validated['password'])) {
            $examiner->password = $validated['password'];
        }

        $examiner->save();

        return redirect()
            ->route('cbt.admin.examiners.index')
            ->with('success', 'Examiner information updated successfully.');
    }

    /**
     * Activate or deactivate an examiner.
     */
    public function toggleStatus(User $examiner)
    {
        abort_unless($examiner->role === 'examiner', 404);

        $examiner->is_active = !$examiner->is_active;
        $examiner->save();

        $status = $examiner->is_active ? 'activated' : 'deactivated';

        return redirect()
            ->back()
            ->with('success', "Examiner account {$status} successfully.");
    }

    /**
     * Delete an examiner account.
     */
    public function destroy(User $examiner)
    {
        abort_unless($examiner->role === 'examiner', 404);

        $examiner->delete();

        return redirect()
            ->route('cbt.admin.examiners.index')
            ->with('success', 'Examiner account deleted successfully.');
    }
}
