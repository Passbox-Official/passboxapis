<?php

namespace Tests\Feature;

use App\Models\Password;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use App\Models\UserSessionHistory;

class PasswordTest extends TestCase
{
    use withFaker;

    private array $headers = [];

    public function setUp(): void
    {
        parent::setUp();

        $result = UserSessionHistory::whereNull('logout_at')->first();
        if (! $result) {
            /**
             * TODO: Throw some kind of exception
             */
        }

        $this->headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $result->token,
        ];
    }

    public function test_unauthorized()
    {
        $this->withHeaders([])
            ->postJson('/password', [])
            ->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson([
                'message' => 'Unauthenticated.',
            ]);
    }

    public function test_missing_fields()
    {
        $payload = [
            'url' => 'invalidurl',
        ];
        $this->withHeaders($this->headers)
            ->postJson('/password')
            ->assertJson(fn ($json) =>
                $json->has('message')->has('errors')
            );
    }

    public function test_invalid_url_format()
    {
        $payload = [
            'url' => 'invalidurl',
            'name' => $this->faker->city(),
            'username' => $this->faker->firstName(),
            'password' => Str::random(6),
        ];
        $this->withHeaders($this->headers)
            ->postJson('/password', $payload)
            ->assertJson(fn ($json) =>
                $json->has('message')
                    ->has('errors')
            );
    }

    public function test_password_created()
    {
        $payload = [
            'url' => $this->faker->url(),
            'name' => $this->faker->city(),
            'username' => $this->faker->firstName(),
            'password' => Str::random(6),
        ];
        $this->withHeaders($this->headers)
            ->postJson('/password', $payload)
            ->assertStatus(Response::HTTP_CREATED);
    }

    public function test_failed_duplicate_url()
    {
        $payload = [
            'url' => Password::first()->url,
            'name' => $this->faker->city(),
            'username' => $this->faker->firstName(),
            'password' => Str::random(6),
        ];
        $this->withHeaders($this->headers)
            ->postJson('/password', $payload)
            ->assertStatus(Response::HTTP_NOT_ACCEPTABLE)
            ->assertJson([
                'message' => 'URL already exists'
            ]);
    }
}
