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

    public function testResponseView()
    {
        $this->get('/response/type/view')
            ->assertSeeText("Halo Jimmy");
    }

    public function testResponseJson()
    {
        $this->get('/response/type/json')
            ->assertJson([
                'firstName' => 'Jimin',
                'lastName' => 'kun',
            ]);
    }

    public function testResponseFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/png');
    }

    public function testResponseDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('lagimandi.png');
    }
}
