<?php

namespace Orlyapps\Printable\Support\StationeryResolver;

interface StationeryResolver
{
    public function setModel($model): StationeryResolver;
    public function resolve() : string;
}
