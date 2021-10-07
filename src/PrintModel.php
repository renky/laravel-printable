<?php

namespace Orlyapps\Printable;

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;
use Spatie\Browsershot\Browsershot;
use Symfony\Component\Process\Process;

class PrintModel
{
    public $user = null;
    public $model = null;
    public $modelShortName = null;
    public $layout = 'default';
    public $watermark = false;
    public $stationery = true;
    public $meta = [];

    public $stationeryPdf = null;

    /**
     * Enable PDF/A1-b compliance
     */
    public $PDFA = false;

    public function __construct($model, $stationeryPdf)
    {
        $this->stationeryPdf = $stationeryPdf;
        $this->model = $model;
        $reflection = new \ReflectionClass($model);
        $this->modelShortName = \Str::camel($reflection->getShortName());
        $this->user = \Auth::user();

        return $this;
    }

    public function enablePDFaCompliance($PDFA)
    {
        $this->PDFA = $PDFA;

        return $this;
    }

    public function user($user)
    {
        $this->user = $user;

        return $this;
    }

    public function layout($layout)
    {
        $this->layout = $layout;

        return $this;
    }

    public function withWatermark($watermark)
    {
        $this->watermark = $watermark;

        return $this;
    }

    public function withMeta($meta)
    {
        $this->meta = $meta;

        return $this;
    }

    public function withStationery($stationery)
    {
        $this->stationery = $stationery;

        return $this;
    }

    public function asHTML()
    {
        $view = $this->model->printView() ?? "print.{$this->modelShortName}.layout";
        $templateName = "{$view}-{$this->layout}";

        return  (string)view($templateName, array_merge([
            $this->modelShortName => $this->model,
            'user' => $this->user,
        ], $this->meta));
    }

    public function save()
    {
        if (! is_dir(storage_path('printable'))) {
            mkdir(storage_path('printable'));
        }

        $filename = storage_path('printable/' . uniqid(rand(), true) . '.pdf');
        $templateString = $this->asHTML();

        Browsershot::html($templateString)
            ->showBrowserHeaderAndFooter()
            ->hideHeader()
            ->footerHtml((string)view('printable::header'))
            ->showBackground()
            ->emulateMedia('print')
            ->paperSize(210, 297, 'mm')
            ->margins(0, 0, 0, 0, 'mm')
            ->setOption('args', '--lang=de-DE')
            ->noSandbox()
            ->savePdf($filename);

        $pdf = new Fpdi();
        $pdf->setSourceFile(StreamReader::createByString(file_get_contents($this->stationeryPdf)));

        $coverBackground = $pdf->importPage(1);


        $pdf->setSourceFile(resource_path('pdf/watermark-preview.pdf'));
        $watermarkPage = $pdf->importPage(1);

        $pageCount = $pdf->setSourceFile($filename);
        for ($i = 1; $i <= $pageCount; $i++) {
            $pdf->AddPage();

            $pageId = $pdf->importPage($i);
            $pdf->useTemplate($pageId);

            if ($this->stationery) {
                $pdf->useTemplate($coverBackground);
            }

            // Preview Watermark
            if ($this->watermark) {
                $pdf->useTemplate($watermarkPage);
            }

            if ($i !== 1 && optional($this->model)->printTitle) {
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetTextColor(74, 85, 104);
                $pdf->SetXY(20.8, 37);

                $pdf->Write(0, iconv('UTF-8', 'ISO-8859-1//IGNORE', $this->model->printTitle));
            }
        }

        // Reines PDF von Browsershot lösen und das neue zusammengeführte PDF verwenden
        unlink($filename);
        $filename = storage_path('printable/' . uniqid(rand(), true) . '.pdf');

        $pdf->Output('F', $filename);

        if ($this->PDFA) {
            return $this->convertToPDFa($filename);
        }

        return $filename;
    }

    protected function convertToPDFa($filename)
    {
        $outputFile = storage_path('temp/' . uniqid(rand(), true) . '.pdf');
        $process = new Process([
            'gt',
            '-dNOSAFER',
            '-dPDFA',
            '-dBATCH',
            '-dNOPAUSE',
            '-sProcessColorModel=DeviceRGB',
            '-sDEVICE=pdfwrite',
            '-dPDFACompatibilityPolicy=1',
            '-sOutputFile=' . $outputFile,
            '-sOutputICCProfile=' . resource_path('pdf/AdobeRGB1998.icc'),
            '-dPDFACompatibilityPolicy=1',
            $filename,
        ]);

        $process->mustRun();

        return $outputFile;
    }
}
