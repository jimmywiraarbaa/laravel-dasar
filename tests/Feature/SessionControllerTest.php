<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testSession()
    {
        $this->get('/session/create')
            ->assertSeeText("OK")
            ->assertSessionHas("userId", "Jimmy")
            ->assertSessionHas("isMember", "true");
    }

    public function testGetSession()
    {
        $this->withSession([])->get('/session/get')
            ->assertSeeText('User Id : guest isMember : false');

        $this->withSession([
            'userId' => 'Jimmy',
            'isMember' => 'true'
        ])->get('/session/get')
            ->assertSeeText('User Id : Jimmy isMember : true');
    }
}
