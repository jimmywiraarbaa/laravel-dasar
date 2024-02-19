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
        $this->get('/redirect/named')
            ->assertSeeText('/redirect/name/Jimmy');
    }
}
