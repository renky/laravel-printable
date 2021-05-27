<?php

namespace Orlyapps\Printable;

use Orlyapps\Printable\View\Components\PrintPage;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
