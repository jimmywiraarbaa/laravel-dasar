<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Halo Jimmy');
    }

    public function testViewNested()
    {
        $this->get('/author')
            ->assertSeeText('Author Jimmy Wira Arbaa');
    }
}
