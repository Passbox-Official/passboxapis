<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class SignupTest extends TestCase
{
    public function test_without_bearer_token(): void
    {
        $this->postJson('/auth/signup')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
