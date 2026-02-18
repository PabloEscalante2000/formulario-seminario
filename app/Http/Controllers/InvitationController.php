<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\InvitationToken;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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

        $invitationToken->registration()->create($request->validated());
        $invitationToken->update(['is_used' => true]);

        return view('invitation.success');
    }
}
