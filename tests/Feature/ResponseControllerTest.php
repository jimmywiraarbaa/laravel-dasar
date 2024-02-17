<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText("Hello Response");
    }

    public function testHeaderResponse()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText("Jimmy")
            ->assertSeeText("Wira Arbaa")
            ->assertHeader("Content-Type", "application/json")
            ->assertHeader("Author", "Mamamia Tech")
            ->assertHeader("App", "Laravel 10");
    }
}
