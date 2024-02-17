<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testSetCookie()
    {
        $this->get('/cookie/set')
            ->assertSeeText('Hello Cookie!')
            ->assertCookie('User-Id', 'Jimmy')
            ->assertCookie('Is-member', 'true');
    }

    public function testGetCookie()
    {
        $this->withCookie("User-Id", "Jimmy")
            ->withCookie("Is-Member", "true")
            ->get('/cookie/get')
            ->assertJson([
                'userId' => 'Jimmy',
                'isMember' => 'true'
            ]);
    }
}
