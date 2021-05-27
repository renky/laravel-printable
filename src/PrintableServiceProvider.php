<?php

namespace Orlyapps\Printable;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Orlyapps\Printable\Commands\PrintableCommand;
use Orlyapps\Printable\View\Components\PrintPage;

class PrintableServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-printable')
            ->hasConfigFile()
            ->hasViewComponent('orlyapps', PrintPage::class)
            ->hasRoute('web')
            ->hasViews();
    }
}
