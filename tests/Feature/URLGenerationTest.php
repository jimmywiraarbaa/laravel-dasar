<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    public function testUrlGeneration()
    {
        $this->get('/url/current?Name=Jimmy')
            ->assertSeeText('/url/current?Name=Jimmy');
    }

    public function testUrlNamed()
    {
        $this->get('/url/named')
            ->assertSeeText('/redirect/name/Jimmy');
    }

    public function testUrlAction()
    {
        $this->get('/url/action')
            ->assertSeeText('/form');
    }
}
