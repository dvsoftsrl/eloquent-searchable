<?php

namespace DvSoft\EloquentSearchable\Tests;

use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function setup(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->setUpDatabase($this->app);
    }

    protected function setUpDatabase($app): void
    {

        $app['db']->connection()->getSchemaBuilder()->dropIfExists('users');

        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->timestamps();
        });

    }

    public function tearDown(): void
    {
        $app = $this->app;

        $app['db']->connection()->getSchemaBuilder()->drop('users');
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}
