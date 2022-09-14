<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Config;

class FacadesTest extends TestCase
{
    public function testConfig() {
        $firstName1 = config('contoh.name.first');
        $firstName2 = config('contoh.name.first');

        self::assertEquals($firstName1, $firstName2);
        // var_dump(Config::all());        
    }   // testConfig()

    public function testConfigDependency() {
        $config = $this->app->make('config');
        $firstName1 = $config->get('contoh.name.first');
        $firstName2 = Config::get('contoh.name.first');

        self::assertEquals($firstName1, $firstName2);
        // var_dump(Config::all());
    }

    public function testConfigMock() {
        Config::shouldReceive('get')->with('contoh.name.first')->andReturn('Risky Kurniawan');

        $firstName1 = Config::get('contoh.name.first');
        self::assertEquals ('Risky Kurniawan', $firstName1);
    }
}
