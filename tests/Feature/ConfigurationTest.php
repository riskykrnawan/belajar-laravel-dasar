<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class ConfigurationTest extends TestCase
{
    public function testConfig() {
        $firstName = config('contoh.name.first');
        $lastName = config('contoh.name.last');
        $email = config('contoh.email');

        self::assertEquals('Risky', $firstName);
        self::assertEquals('Kurniawan', $lastName);
        self::assertEquals('riskykrnawan@gmail.com', $email);
    }
}
