<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testBasicRouting()
    {
        $this->get('/risky')->assertStatus(200)->assertSeeText("risky");        
    }
    public function testRedirectRouting()
    {
        $this->get('/riskykurniawan')->assertRedirect('/risky');
    }
    public function testFallbackRouting()
    {
        $this->get('/404')->assertSeeText("404");
    }
    public function testViewRouting()
    {
        $this->get('hello1')->assertSeeText("hello risky");
        $this->get('hello2')->assertSeeText("hello risky");
        $this->get('hello-world')->assertSeeText("hello world");
    }

    public function testRouteParameters()
    {
        $this->get('/products/1')->assertSeeText("Products: 1");
        $this->get('/products/1/items/40')->assertSeeText("Products: 1, Items: 40");
    }

    public function testRoutingParameterRegex()
    {
        $this->get('/category/12345')->assertSeeText("Category: 12345");
        $this->get('/category/asdfghjkl')->assertSeeText("404");
    }

    public function testRoutingOptionalParameter()
    {
        $this->get('/users/12345')->assertSeeText("User: 12345");
        $this->get('/users')->assertSeeText("404");
    }
    public function testRoutingConflict()
    {
        $this->get('/conflict/samsudin')->assertSeeText("conflict: samsudin");
        $this->get('/conflict/risky')->assertSeeText("conflict: risky");
    }
    public function testNamedRouting()
    {
        $this->get('/produk/12345')->assertSeeText("products/12345");
        $this->get('/produk-redirect/12345')->assertSeeText("products/12345");
    }
    public function testViewWithoutRoute() {
        $this->view('hello', ['name' => 'risky'])->assertSeeText('hello risky');
    }
}
