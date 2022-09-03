<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testGetEnv (){
        $firstName = env('FIRST_NAME');
        self::assertEquals('Risky', $firstName);
    }
    public function testDefaultEnv() {
        
        $LastName = env('LAST_NAME', 'Kurniawan');
        self::assertEquals('Kurniawan', $LastName);
    }
}
