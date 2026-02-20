<?php

namespace Database\Factories;

use App\Models\InvitationToken;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registration>
 */
class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invitation_token_id' => InvitationToken::factory(),
            'nombre' => fake()->firstName(),
            'apellido' => fake()->lastName(),
            'correo' => fake()->safeEmail(),
            'celular' => fake()->phoneNumber(),
            'pregunta' => fake()->sentence(),
            'numero_acompanantes' => fake()->numberBetween(0, 5),
        ];
    }
}
