<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DependencyInjectionTest extends TestCase
{
    public function testDependencyInjection()
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
}
