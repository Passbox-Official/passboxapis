<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginTest extends TestCase
{
    private array $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer admin@123',
    ];

    public function test_invalid_credentials()
    {
        $user_email = User::first()->email;
        $response = $this->withHeaders($this->headers)->postJson('/auth/login', [
            'email' => $user_email,
            'password' => 'wrong password',
        ]);
        $response->assertStatus(Response::HTTP_NOT_ACCEPTABLE);
        $response->assertJson([
            'message' => 'Only 3 device is allowed',
        ]);
    }

    public function test_invalid_email()
    {
        $response = $this->withHeaders($this->headers)->postJson('/auth/login', [
            'email' => 'invalid email',
            'password' => 'wrong password',
        ]);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
