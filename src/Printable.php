<?php

namespace Orlyapps\Printable;

use Orlyapps\Printable\Support\StationeryResolver\StationeryResolverFactory;

trait Printable
{
    public function stationeryPdf()
    {
        return resource_path('pdf/stationery.pdf');
    }

    public function printView()
    {
        return null;
    }

    public function print()
    {
        $resolver = StationeryResolverFactory::createForModel($this);
        $resolver->setModel($this);
        return new PrintModel($this, $resolver->resolve());
    }
}
