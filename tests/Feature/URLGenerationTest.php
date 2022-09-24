<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    public function testCurrentUrl() {
        $this->get('/url/current?name=risky')
            ->assertSeeText('/url/current?name=risky');
    }

    public function testNamedUrl() {
        $this->get('/url/named')
            ->assertSeeText('/redirect/name/risky');
    }

    public function testActionUrl() {
        $this->get('/url/action')->assertSeeText('/form');
    }
}
