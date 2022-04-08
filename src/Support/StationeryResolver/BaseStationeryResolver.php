<?php
namespace Orlyapps\Printable\Support\StationeryResolver;

class BaseStationeryResolver implements StationeryResolver
{
    protected $model = null;

    public function setModel($model): StationeryResolver
    {
        $this->model = $model;

        return $this;
    }
    public function resolve() : string
    {
        return "";
    }
}
