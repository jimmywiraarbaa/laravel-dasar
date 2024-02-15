<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    public function testController()
    {
        $this->get('/greeting/hello/Jimmy')
            ->assertSeeText('Halo Jimmy');
    }

    public function testRequest()
    {
        $this->get('/greeting/hello/request', ['accept' => 'plain/text'])
            ->assertSeeText('greeting/hello/request')
            ->assertSeeText('http://localhost/greeting/hello/request')
            ->assertSeeText('GET')
            ->assertSeeText('plain/text');
    }
}
