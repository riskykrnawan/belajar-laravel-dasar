<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContohMiddlewareTest extends TestCase
{
    public function testInvalid() {
        $this->get('/middleware/api')
            ->assertStatus(401)
            ->assertSeeText('Access denied');
    }

    public function testValid() {
        $this->withHeader('X-API-KEY', 'RK')
            ->get('/middleware/api')
            ->assertStatus(200)
            ->assertSeeText('OK');
    }

    public function testInvalidGroup() {
        $this->get('/middleware/group')
            ->assertStatus(401)
            ->assertSeeText('Access denied');
    }

    public function testValidGroup() {
        $this->withHeader('X-API-KEY', 'RK')
            ->get('/middleware/group')
            ->assertStatus(200)
            ->assertSeeText('GROUP');
    }
    
    public function testInvalidParam() {
        $this->get('/middleware/api-with-param')
            ->assertStatus(401)
            ->assertSeeText('Access denied');
    }

    public function testValidParam() {
        $this->withHeader('X-API-KEY', 'RK')
            ->get('/middleware/api-with-param')
            ->assertStatus(200)
            ->assertSeeText('PARAM');
    }
}
