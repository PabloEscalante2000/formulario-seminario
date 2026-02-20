<?php

namespace App\Http\Controllers;

use App\Models\InvitationToken;
use Illuminate\Contracts\View\View;

class VerificacionController extends Controller
{
    public function show(string $token): View
    {
        $invitationToken = InvitationToken::query()
            ->with('registration')
            ->where('token', $token)
            ->first();

        if (! $invitationToken || ! $invitationToken->registration) {
            return view('verificacion.invalid');
        }

        return view('verificacion.show', [
            'registration' => $invitationToken->registration,
        ]);
    }
}
