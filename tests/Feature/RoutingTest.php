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

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Product ID : 1');

        $this->get('/products/3')
            ->assertSeeText('Product ID : 3');

        $this->get('/products/1/items/1')
            ->assertSeeText('Product ID : 1, Item : 1');
    }

    public function testRouteParameterRegex()
    {
        $this->get('/category/jim')
            ->assertSeeText('Error 404 by Jimmy Wira Arbaa');
    }

    public function testRouteParameterOptional()
    {
        $this->get('/Users/jim')
            ->assertSeeText('User ID : jim');

        $this->get('/Users/')
            ->assertSeeText('User ID : 404');
    }

    public function testRouteConflict()
    {
        $this->get('/players/jimmy')
            ->assertSeeText('Player jimmy wira arbaa');
    }

    public function testRouteName()
    {
        $this->get('/produk/123')
            ->assertSeeText('/products/123');

        $this->get('/products-redirect/123')
            ->assertRedirect('products/123');
    }
}
