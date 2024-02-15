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
}
