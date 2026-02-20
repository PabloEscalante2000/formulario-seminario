<?php

namespace Tests\Feature;

use App\Models\InvitationToken;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_is_accessible(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.login');
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@seminario.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post(route('admin.login'), [
            'email' => 'admin@seminario.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_fails_with_invalid_credentials(): void
    {
        User::factory()->create([
            'email' => 'admin@seminario.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post(route('admin.login'), [
            'email' => 'admin@seminario.com',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    public function test_dashboard_requires_authentication(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_authenticated_user_can_see_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    public function test_admin_can_create_token(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.tokens.create'), [
            'cantidad' => 1,
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertDatabaseCount('invitation_tokens', 1);
    }

    public function test_admin_can_create_multiple_tokens(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.tokens.create'), [
            'cantidad' => 5,
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertDatabaseCount('invitation_tokens', 5);
    }

    public function test_token_creation_requires_authentication(): void
    {
        $response = $this->post(route('admin.tokens.create'), [
            'cantidad' => 1,
        ]);

        $response->assertRedirect(route('admin.login'));
        $this->assertDatabaseCount('invitation_tokens', 0);
    }

    public function test_admin_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }

    public function test_dashboard_shows_tokens_and_registrations(): void
    {
        $user = User::factory()->create();
        $token = InvitationToken::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee($token->token);
    }
}
