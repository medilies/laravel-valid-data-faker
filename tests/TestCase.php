<?php

namespace Elaboratecode\ValidDataFaker\Tests;

use Elaboratecode\ValidDataFaker\ValidDataFakerServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            ValidDataFakerServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
    }
}
