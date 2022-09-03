<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotSame;

class ServiceContainerTest extends TestCase
{
    public function testDependencyInjection() {
        $foo1 = $this->app->make(Foo::class); //new Foo()
        $foo2 = $this->app->make(Foo::class); //new Foo()

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind() {
        $this->app->bind(Person::class, function($app) {
            return new Person('Risky', 'Kurniawan');
        });

        $person1 = $this->app->make(Person::class); // closure() // new Person('Risky', 'Kurniawan');
        $person2 = $this->app->make(Person::class); // closure() // new Person('Risky', 'Kurniawan');

        self::assertEquals('Risky', $person1->firstName);
        self::assertEquals('Risky', $person2->firstName);
        self::assertNotSame($person1, $person2);
    }
    
    public function testSingleton() {
        $this->app->singleton(Person::class, function($app) {
            return new Person('Risky', 'Kurniawan');
        });

        $person1 = $this->app->make(Person::class); // closure() // new Person('Risky', 'Kurniawan'); if not exist
        $person2 = $this->app->make(Person::class); // return existing

        self::assertEquals('Risky', $person1->firstName);
        self::assertEquals('Risky', $person2->firstName);
        self::assertSame($person1, $person2);
    }
    
    public function testInstance() {
        $person = new Person('Risky', 'Kurniawan');
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class); // $person

        self::assertEquals('Risky', $person1->firstName);
        self::assertEquals('Risky', $person2->firstName);
        self::assertSame($person, $person2);
        self::assertSame($person1, $person2);
    }
}
