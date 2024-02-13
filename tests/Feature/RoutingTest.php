<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testBasicRouting()
    {
        $this->get('/jwa')
            ->assertStatus(200)
            ->assertSeeText('Jimmy Wira Arbaa');
    }

    public function testRedirect()
    {
        $this->get('/jimmy')
            ->assertRedirect('/jwa');
    }

    public function testFallBack()
    {
        $this->get('/404')
            ->assertSeeText('404 by Jimmy Wira Arbaa');
    }
}
