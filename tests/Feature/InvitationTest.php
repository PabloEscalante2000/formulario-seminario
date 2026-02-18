<?php

namespace Tests\Feature;

use App\Models\InvitationToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvitationTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_token_shows_form(): void
    {
        $token = InvitationToken::factory()->create();

        $response = $this->get(route('invitation.show', $token->token));

        $response->assertStatus(200);
        $response->assertViewIs('invitation.form');
    }

    public function test_invalid_token_shows_error_page(): void
    {
        $response = $this->get(route('invitation.show', 'nonexistent-token'));

        $response->assertStatus(200);
        $response->assertViewIs('invitation.invalid');
    }

    public function test_used_token_shows_error_page(): void
    {
        $token = InvitationToken::factory()->used()->create();

        $response = $this->get(route('invitation.show', $token->token));

        $response->assertStatus(200);
        $response->assertViewIs('invitation.invalid');
    }

    public function test_valid_submission_creates_registration(): void
    {
        $token = InvitationToken::factory()->create();

        $response = $this->post(route('invitation.store', $token->token), [
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'correo' => 'juan@example.com',
            'pregunta' => 'Aprender sobre el amor',
            'numero_acompanantes' => 2,
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('invitation.success');

        $this->assertDatabaseHas('registrations', [
            'invitation_token_id' => $token->id,
            'nombre' => 'Juan',
            'correo' => 'juan@example.com',
        ]);

        $token->refresh();
        $this->assertTrue($token->is_used);
    }

    public function test_submission_with_used_token_fails(): void
    {
        $token = InvitationToken::factory()->used()->create();

        $response = $this->post(route('invitation.store', $token->token), [
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'correo' => 'juan@example.com',
            'pregunta' => 'Aprender',
            'numero_acompanantes' => 0,
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('invitation.invalid');
        $this->assertDatabaseCount('registrations', 0);
    }

    public function test_submission_validates_required_fields(): void
    {
        $token = InvitationToken::factory()->create();

        $response = $this->post(route('invitation.store', $token->token), []);

        $response->assertSessionHasErrors(['nombre', 'apellido', 'correo', 'pregunta', 'numero_acompanantes']);
    }

    public function test_submission_validates_email_format(): void
    {
        $token = InvitationToken::factory()->create();

        $response = $this->post(route('invitation.store', $token->token), [
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'correo' => 'not-an-email',
            'pregunta' => 'Aprender',
            'numero_acompanantes' => 0,
        ]);

        $response->assertSessionHasErrors(['correo']);
    }

    public function test_submission_validates_acompanantes_range(): void
    {
        $token = InvitationToken::factory()->create();

        $response = $this->post(route('invitation.store', $token->token), [
            'nombre' => 'Juan',
            'apellido' => 'Perez',
            'correo' => 'juan@example.com',
            'pregunta' => 'Aprender',
            'numero_acompanantes' => 15,
        ]);

        $response->assertSessionHasErrors(['numero_acompanantes']);
    }
}
