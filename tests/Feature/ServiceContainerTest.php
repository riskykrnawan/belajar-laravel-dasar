<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Bar;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotSame;

class ServiceContainerTest extends TestCase
{
    public function testDependency() {
        $foo1 = $this->app->make(Foo::class); //new Foo()
        $foo2 = $this->app->make(Foo::class); //new Foo()

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertSame($foo1, $foo2);
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

    public function testDependencyInjection() {
        // $foo = $this->app->make(Foo::class);
        // $bar = $this->app->make(Bar::class);

        // self::assertNotSame($foo, $bar);

        // $this->app->singleton(Foo::class, function($app) {
        //     return new Foo();
        // });

        // $foo = $this->app->make(Foo::class);
        // $bar = $this->app->make(Bar::class);

        // self::assertSame($foo, $bar->foo);
        
        $this->app->singleton(Foo::class, function($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function($app) {
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass() {
        // menggunakan class
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);
        
        // jika kompleks lebih baik menggunakan closure
        // menggunakan closure
        $this->app->singleton(HelloService::class, function($app) {
            return new HelloServiceIndonesia();
        });


        $helloService = $this->app->make(HelloService::class);
        self::assertEquals("Halo Risky", $helloService->hello('Risky'));
    }
}
