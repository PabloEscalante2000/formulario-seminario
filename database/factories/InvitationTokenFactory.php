<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvitationToken>
 */
class InvitationTokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'token' => Str::random(32),
            'is_used' => false,
        ];
    }

    public function used(): static
    {
        return $this->state(fn (array $attributes): array => [
            'is_used' => true,
        ]);
    }
}
