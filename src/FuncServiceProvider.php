<?php

namespace NotchAfrica\Func;
use NotchAfrica\Func\Commands\CurrencyCleanup;
use NotchAfrica\Func\Commands\CurrencyHydrate;
use NotchAfrica\Func\Commands\CurrencySeed;
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
            ->hasMigration('create_currency_table')
            ->hasMigration('create_balance_table')
            ->hasCommand(CurrencyCleanup::class)
            ->hasCommand(CurrencyHydrate::class)
            ->hasCommand(CurrencySeed::class);
    }
}
