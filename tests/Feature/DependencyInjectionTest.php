<?php

namespace Tests\Feature;

use App\Data\Bar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Data\Foo;

class DependencyInjectionTest extends TestCase
{
    public function testDependencyInjection() {
        $foo = new Foo();
        $bar = new Bar($foo); //bisa menggunakan setter atau assign langsung ke attributnya

        self::assertEquals("Foo and Bar", $bar->bar());
    }
}
