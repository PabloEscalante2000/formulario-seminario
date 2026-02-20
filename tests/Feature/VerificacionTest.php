<?php

namespace Tests\Feature;

use App\Models\InvitationToken;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VerificacionTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_token_with_registration_shows_guest_data(): void
    {
        $token = InvitationToken::factory()->used()->create();
        $registration = Registration::factory()->create([
            'invitation_token_id' => $token->id,
            'nombre' => 'Maria',
            'apellido' => 'Lopez',
        ]);

        $response = $this->get(route('verificacion.show', $token->token));

        $response->assertStatus(200);
        $response->assertViewIs('verificacion.show');
        $response->assertSeeText('Maria');
        $response->assertSeeText('Lopez');
    }

    public function test_nonexistent_token_shows_invalid_page(): void
    {
        $response = $this->get(route('verificacion.show', 'nonexistent-token'));

        $response->assertStatus(200);
        $response->assertViewIs('verificacion.invalid');
    }

    public function test_token_without_registration_shows_invalid_page(): void
    {
        $token = InvitationToken::factory()->create();

        $response = $this->get(route('verificacion.show', $token->token));

        $response->assertStatus(200);
        $response->assertViewIs('verificacion.invalid');
    }
}
