<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SignupTest extends TestCase
{
    use WithFaker;

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

    public function test_missing_bearer_token(): void
    {
        $this->postJson('/auth/signup')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_invalid_or_missing_master_password(): void
    {
        $this->withHeaders($this->headers)->postJson('/auth/signup')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_invalid_email_format(): void
    {
        $payload = [
            'email' => 'demogmail.com',
            'master_password' => env('DEFAULT_SUDO_PASSWORD'),
        ];
        $this->withHeaders($this->headers)->postJson('/auth/signup', $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'The email must be a valid email address. (and 2 more errors)',
            ]);
    }

    public function test_missing_confirm_password(): void
    {
        $payload = [
            'email' => 'demo@gmail.com',
            'master_password' => env('DEFAULT_SUDO_PASSWORD'),
            'password' => 'admin@123',
        ];
        $this->withHeaders($this->headers)->postJson('/auth/signup', $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'The confirm password field is required.',
            ]);
    }

    public function test_mismatch_confirm_password(): void
    {
        $payload = [
            'email' => 'demo@gmail.com',
            'master_password' => env('DEFAULT_SUDO_PASSWORD'),
            'password' => 'admin@123',
            'confirm_password' => 'admin@12',
        ];
        $this->withHeaders($this->headers)->postJson('/auth/signup', $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'The confirm password and password must match.',
            ]);
    }

    public function test_success_signup(): string
    {
        $signup_email = $this->faker->safeEmail();
        $payload = [
            'email' => $signup_email,
            'password' => env('DEFAULT_USER_PASSWORD_TESTING'),
            'confirm_password' => env('DEFAULT_USER_PASSWORD_TESTING'),
            'master_password' => env('DEFAULT_SUDO_PASSWORD'),
        ];
        $this->withHeaders($this->headers)->postJson('/auth/signup', $payload)
            ->assertStatus(Response::HTTP_CREATED);
        return $signup_email;
    }

    public function test_signup_stopped_duplicate_email_check(): void
    {
        $payload = [
            'email' => User::first()->email,
            'password' => env('DEFAULT_USER_PASSWORD_TESTING'),
            'confirm_password' => env('DEFAULT_USER_PASSWORD_TESTING'),
            'master_password' => env('DEFAULT_SUDO_PASSWORD'),
        ];
        $this->withHeaders($this->headers)->postJson('/auth/signup', $payload)
            ->assertJson([
                'message' => 'The email has already been taken.',
            ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
