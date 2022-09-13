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

    public function testViewWithoutRoute() {
        $this->view('hello', ['name' => 'risky'])->assertSeeText('hello risky');
    }
}
