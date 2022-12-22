<?php

namespace Elaboratecode\ValidDataFaker;

use Elaboratecode\ValidDataFaker\Commands\ValidDataFakerCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ValidDataFakerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-valid-data-faker')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-valid-data-faker_table')
            ->hasCommand(ValidDataFakerCommand::class);
    }
}
