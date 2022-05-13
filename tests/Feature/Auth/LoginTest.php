<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Models\UserSessionHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginTest extends TestCase
{
    private array $headers = [];

    public function setUp(): void
    {
        parent::setUp();

        $this->headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('DEFAULT_BEARER_TOKEN'),
        ];
    }

    public function test_unauthorized_access_without_bearer_token()
    {
        $response = $this->postJson('/auth/login');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $response->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }

    public function test_invalid_user()
    {
        $payload = [
            'email' => 'invalid_email@demo.com',
            'password' => 'invalid_password',
        ];
        $response = $this->withHeaders($this->headers)->postJson('/auth/login', $payload);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson([
            'message' => 'Invalid email',
            'data' => null,
        ]);
    }

    public function test_success_login()
    {
        UserSessionHistory::truncate();
        $payload = [
            'email' => User::first()->email,
            'password' => env('DEFAULT_USER_PASSWORD_TESTING'),
        ];
        $response = $this->withHeaders($this->headers)->postJson('/auth/login', $payload);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_unable_to_login_after_3_logins()
    {
        UserSessionHistory::truncate();
        $payload = [
            'email' => User::first()->email,
            'password' => env('DEFAULT_USER_PASSWORD_TESTING'),
        ];
        // Login 1
        $this->withHeaders($this->headers)->postJson('/auth/login', $payload)
            ->assertStatus(Response::HTTP_OK);

        // Login 2
        $this->withHeaders($this->headers)->postJson('/auth/login', $payload)
            ->assertStatus(Response::HTTP_OK);

        // Login 3
        $this->withHeaders($this->headers)->postJson('/auth/login', $payload)
            ->assertStatus(Response::HTTP_OK);

        // Login 4
        $response = $this->withHeaders($this->headers)->postJson('/auth/login', $payload)
            ->assertStatus(Response::HTTP_NOT_ACCEPTABLE)
            ->assertJson([
                'message' => 'Only 3 device is allowed',
            ]);
    }
}
