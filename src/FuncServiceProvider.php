<?php

namespace NotchAfrica\Func;

use NotchAfrica\Func\Commands\FuncCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FuncServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('func')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_func_table')
            ->hasCommand(FuncCommand::class);
    }
}
