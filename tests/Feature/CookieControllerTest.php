<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testCookieTest()
    {
        $this->get('/cookie/set')
            ->assertSeeText('Hello Cookie!')
            ->assertCookie('User-Id', 'Jimmy')
            ->assertCookie('Is-member', 'true');
    }
}
