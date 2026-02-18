<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    /** @use HasFactory<\Database\Factories\RegistrationFactory> */
    use HasFactory;

    protected $fillable = [
        'invitation_token_id',
        'nombre',
        'apellido',
        'correo',
        'pregunta',
        'numero_acompanantes',
    ];

    public function invitationToken(): BelongsTo
    {
        return $this->belongsTo(InvitationToken::class);
    }
}
