<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InvitationToken extends Model
{
    /** @use HasFactory<\Database\Factories\InvitationTokenFactory> */
    use HasFactory;

    protected $fillable = [
        'token',
        'is_used',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_used' => 'boolean',
        ];
    }

    public function registration(): HasOne
    {
        return $this->hasOne(Registration::class);
    }

    public function isAvailable(): bool
    {
        return ! $this->is_used;
    }
}
