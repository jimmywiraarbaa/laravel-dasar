<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

use function PHPUnit\Framework\assertNotSame;

class DependencyInjectionTest extends TestCase
{
    public function testDependency()
    {
        $foo = new Foo();
        $bar = new Bar($foo);

        self::assertEquals("Foo and bar", $bar->bar());
    }

    public function testBind()
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person("Jimmy", "Jimmy");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Jimmy", $person1->firstname);
        self::assertEquals("Jimmy", $person2->lastname);
        self::assertNotSame($person1, $person2);
    }

    public function testSingelton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Jimmy", "Jimmy");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Jimmy", $person1->firstname);
        self::assertEquals("Jimmy", $person2->lastname);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person  = new Person("Jimmy", "Wira");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);
        $person3 = $this->app->make(Person::class);
        $person4 = $this->app->make(Person::class);

        self::assertEquals("Jimmy", $person1->firstname);
        self::assertEquals("Jimmy", $person2->firstname);
        self::assertSame($person1, $person2);
    }

    public function testDepedencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });


        $this->app->singleton(Bar::class, function ($app) {
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);

        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Halo Jimmy', $helloService->hello('Jimmy'));
    }
}
