<?php

namespace Orlyapps\Printable\Http\Controllers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PrintController
{
    public function __invoke(Request $request, $model, $id, $layout = 'default')
    {
        if (isset(Relation::morphMap()[Str::singular($model)])) {
            $class = Relation::morphMap()[Str::singular($model)];
        } else {
            $className = Str::studly(Str::singular($model));
            $class = "App\\Models\\{$className}";
            if (!class_exists($class)) {
                $class = "App\\{$className}";
            }
        }



        try {
            $instance = $class::find($id);
            $pdfPreview = $instance
                ->print()
                ->layout($layout)
                ->user(\Auth::user())
                ->withStationery($request->stationery ?? true)
                ->enablePDFaCompliance($request->pdfa ?? false)
                ->withWatermark($request->watermark ?? false);
            if (isset($request->html)) {
                return $pdfPreview->asHTML();
            }

            return response()->file($pdfPreview->save());
        } catch (\Exception $exception) {
            dd($exception);
            abort(404, 'Page not found');
        }
    }
}
