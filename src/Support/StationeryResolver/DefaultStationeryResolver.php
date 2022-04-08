<?php
namespace Orlyapps\Printable\Support\StationeryResolver;

class DefaultStationeryResolver extends BaseStationeryResolver implements StationeryResolver
{
    public function resolve() : string
    {
        return $this->model->stationeryPdf();
    }
}
