<?php

namespace Elaboratecode\ValidDataFaker\Concerns;

use Faker\Factory;
use Faker\Generator;

/**
 * Copied from [Laravel 9] vendor\laravel\framework\src\Illuminate\Foundation\Testing\WithFaker.php
 */
trait WithFaker
{
    protected Generator $faker;

    protected function setUpWithFaker(): void
    {
        $this->faker = $this->makeFaker();
    }

    protected function faker(?string $locale = null): Generator
    {
        return is_null($locale) ? $this->faker : $this->makeFaker($locale);
    }

    protected function makeFaker(?string $locale = null): Generator
    {
        $locale ??= config('app.faker_locale', Factory::DEFAULT_LOCALE);

        if (isset($this->app) && $this->app->bound(Generator::class)) {
            return $this->app->make(Generator::class, ['locale' => $locale]);
        }

        return Factory::create($locale);
    }
}
