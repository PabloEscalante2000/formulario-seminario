<?php

namespace App\Http\Controllers;

use App\Models\InvitationToken;
use App\Models\Registration;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function loginForm(): View
    {
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ])->onlyInput('email');
    }

    public function dashboard(Request $request): View
    {
        $tokensQuery = InvitationToken::query()
            ->with('registration')
            ->latest();

        if ($request->query('filtro') === 'disponibles') {
            $tokensQuery->where('is_used', false);
        } elseif ($request->query('filtro') === 'usados') {
            $tokensQuery->where('is_used', true);
        }

        $tokens = $tokensQuery->get();

        $registrations = Registration::query()
            ->with('invitationToken')
            ->latest()
            ->get();

        return view('admin.dashboard', compact('tokens', 'registrations'));
    }

    public function createToken(): RedirectResponse
    {
        InvitationToken::query()->create([
            'token' => Str::random(32),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Token creado exitosamente.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
