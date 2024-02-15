<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Jimmy')->assertSeeText("Halo Jimmy");

        $this->post('/input/hello', ['name' => 'Wira'])->assertSeeText("Halo Wira");
    }

    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            'name' => [
                'first' => 'Jimmy',
                'last' => 'Wira',
            ]
        ])->assertSeeText("Halo Jimmy");
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            'name' => [
                'first' => 'Jimmy',
                'last' => 'Wira',
            ]
        ])->assertSeeText("name")->assertSeeText("last")
            ->assertSeeText("Jimmy")->assertSeeText("Wira");
    }

    public function testArrayInput()
    {
        $this->post('/input/hello/array', [
            'products' =>
            [
                'name' => 'Iphone',
                'price' => 10000
            ],
            [
                'name' => 'Android',
                'price' => 15000
            ]
        ])->assertSeeText("Iphone")->assertSeeText("Android");
    }
}
