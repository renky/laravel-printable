<?php
namespace Orlyapps\Printable\Support\StationeryResolver;

class StationeryResolverFactory
{
    public static function createForModel($model): StationeryResolver
    {
        $stationeryResolverClass = config('printable.stationery_resolver');
        $stationeryResolver = app($stationeryResolverClass);
        return $stationeryResolver;
    }
}
