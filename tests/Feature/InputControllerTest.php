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
            'products' => [
                [
                    'name' => 'Iphone',
                    'price' => '10000',
                ],
                [
                    'name' => 'Android',
                    'price' => '15000',
                ]
            ]
        ])->assertSeeText("Iphone")->assertSeeText("Android");
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Jimmy',
            'married' => 'true',
            'birth_date' => '17-06-2003',
        ])->assertSeeText('Jimmy')
            ->assertSeeText('true')
            ->assertSeeText('17-06-2003');
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            'name' => [
                'first' => 'Jimmy',
                'middle' => 'Wira',
                'last' => 'Arbaa'
            ]
        ])->assertSeeText('Jimmy')
            ->assertDontSeeText('Wira')
            ->assertSeeText('Arbaa');
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            'name' => 'Jimmy',
            'admin' => 'true',
            'password' => 'admin123'
        ])->assertSeeText('Jimmy')
            ->assertDontSeeText('true')
            ->assertSeeText('admin123');
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "name" => "Jimmy",
            "password" => "admin123",
            "admin" => "true"
        ])->assertSeeText("Jimmy")
            ->assertSeeText("admin123")
            ->assertSeeText("admin")
            ->assertSeeText("false");
    }
}
