<?php

use Orlyapps\Printable\Http\Controllers\PrintController;

Route::get('/print/{model}/{id}/{layout?}', PrintController::class)
    ->middleware(config('printable.middleware'));
