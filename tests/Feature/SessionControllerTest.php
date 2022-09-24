<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testCreateSession() {
        $this->get('session/create')
            ->assertSeeText('OK')
            ->assertSessionHas('userId', 'riskykrnawan')
            ->assertSessionHas('isMember', 'true');
    }

    public function testGetSession() {
        $this->withSession([
            'userId' => 'riskykrnawan',
            'isMember' => 'true',
        ])->get('/session/get')
            ->assertSeeText('riskykrnawan')
            ->assertSeeText('true');
    }
    
    public function testGetSessionFailed() {
        $this->withSession([
        ])->get('/session/get')
            ->assertSeeText('guest')
            ->assertSeeText('false');
    }
}
