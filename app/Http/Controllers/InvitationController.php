<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Mail\ConfirmacionRegistro;
use App\Models\InvitationToken;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function show(string $token): View
    {
        $invitationToken = InvitationToken::query()
            ->where('token', $token)
            ->first();

        if (! $invitationToken || ! $invitationToken->isAvailable()) {
            return view('invitation.invalid');
        }

        return view('invitation.form', ['token' => $invitationToken->token]);
    }

    public function store(string $token, StoreRegistrationRequest $request): View|RedirectResponse
    {
        $invitationToken = InvitationToken::query()
            ->where('token', $token)
            ->first();

        if (! $invitationToken || ! $invitationToken->isAvailable()) {
            return view('invitation.invalid');
        }

        $registration = $invitationToken->registration()->create($request->validated());
        $invitationToken->update(['is_used' => true]);

        $registration->load('invitationToken');
        Mail::to($registration->correo)->send(new ConfirmacionRegistro($registration));

        return view('invitation.success');
    }
}
