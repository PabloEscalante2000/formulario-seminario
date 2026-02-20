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

    public function createToken(Request $request): RedirectResponse
    {
        $request->validate([
            'cantidad' => ['required', 'integer', 'min:1', 'max:50'],
        ]);

        $cantidad = (int) $request->input('cantidad', 1);

        $expiresAt = now()->addMonths(2);

        for ($i = 0; $i < $cantidad; $i++) {
            InvitationToken::query()->create([
                'token' => Str::random(32),
                'expires_at' => $expiresAt,
            ]);
        }

        $mensaje = $cantidad === 1
            ? 'Token creado exitosamente.'
            : "$cantidad tokens creados exitosamente.";

        return redirect()->route('admin.dashboard')->with('success', $mensaje);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
