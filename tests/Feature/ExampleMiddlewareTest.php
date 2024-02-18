<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExampleMiddlewareTest extends TestCase
{
    public function testInvalid()
    {
        $this->get('/middleware/api')
            ->assertStatus(401)
            ->assertSeeText('AccessDenied');
    }

    public function testValid()
    {
        $this->withHeader('X-API-KEY', 'JWA')
            ->get('/middleware/api')
            ->assertStatus(200)
            ->assertSeeText('OK');
    }
}
