<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testCreateCookie()
    {
        $this->get('/cookie/set')
            ->assertSeeText("Hello Cookie")
            ->assertCookie("User-Id", "risky")
            ->assertCookie("Is-Member", "true");
    }

    public function testGetCookie()
    {
        $this->withCookie('User-Id', 'risky')
            ->withCookie('Is-Member', 'true')
            ->get('/cookie/get')
            ->assertJson([
                'userId' => 'risky',
                'isMember' => 'true'
            ]);
    }
    public function testClearCookie()
    {
        $this->get('/cookie/clear')
            ->assertSeeText("Clear Cookie")
            ->assertCookie("User-Id", "")
            ->assertCookie("Is-Member", "")
            ->assertCookieExpired("User-Id", "true")
            ->assertCookieExpired("Is-Member", "true");

    }
}
