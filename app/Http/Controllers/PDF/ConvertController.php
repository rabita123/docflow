<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ZipArchive;

class ConvertController extends BasePdfController
{
    public function pdfToImages(Request $request)
    {
        $this->needsFile($request);
        $input   = $this->saveUpload($request->file('file'));
        $fmt     = $request->input('format', 'jpg');
        $dpi     = (int) $request->input('dpi', 150);
        $device  = ($fmt === 'png') ? 'pngalpha' : 'jpeg';
        $ext     = ($fmt === 'png') ? 'png' : 'jpg';
        $prefix  = $this->outputDir . DIRECTORY_SEPARATOR . Str::random(10) . '_page';
        $pattern = $prefix . '%03d.' . $ext;

        $result = $this->run(
            $this->gs() . ' -sDEVICE=' . $device
            . ' -dNOPAUSE -dBATCH -dQUIET'
            . ' -r' . $dpi
            . ' -sOutputFile=' . escapeshellarg($pattern)
            . ' ' . escapeshellarg($input)
        );
        @unlink($input);

        if (!$result['ok']) {
            return $this->err('Conversion failed: ' . $result['stdout']);
        }

        $files   = glob($prefix . '*.' . $ext) ?: [];
        $zipPath = $this->outputPath('zip');
        $zip     = new ZipArchive();
        $zip->open($zipPath, ZipArchive::CREATE);
        foreach ($files as $f) {
            $zip->addFile($f, basename($f));
        }
        $zip->close();
        foreach ($files as $f) @unlink($f);

        return $this->download($zipPath, 'pages.zip', 'application/zip');
    }
public function imagesToPdf(Request $request)
{
    $files = $request->file('files');
    if (!$files) return $this->err('No images uploaded.');

    $inputs = [];
    $output = $this->outputPath('pdf');

    foreach ($files as $file) {
        if ($file && $file->isValid()) {
            $inputs[] = $this->saveUpload($file);
        }
    }

    if (empty($inputs)) {
        return $this->err('No valid images found.');
    }

    $inputPaths = implode(' ', array_map('escapeshellarg', $inputs));
    $cmd        = $this->magick() . ' ' . $inputPaths . ' ' . escapeshellarg($output);
    $result     = $this->run($cmd);

    foreach ($inputs as $p) @unlink($p);

    if (!$result['ok'] || !file_exists($output)) {
        return $this->err('Failed: ' . $result['stdout']);
    }

    return $this->download($output, 'converted.pdf');
}

    public function pdfToText(Request $request)
    {
        $this->needsFile($request);
        $input  = $this->saveUpload($request->file('file'));
        $output = $this->outputPath('txt');

        $this->run($this->getPdftotextCmd() . ' ' . escapeshellarg($input) . ' ' . escapeshellarg($output));
        @unlink($input);

        if (!file_exists($output)) {
            return $this->err('Text extraction failed.');
        }
        return $this->download($output, 'extracted_text.txt', 'text/plain');
    }

    public function grayscale(Request $request)
    {
        $this->needsFile($request);
        $input  = $this->saveUpload($request->file('file'));
        $output = $this->outputPath('pdf');

        $result = $this->run(
            $this->gs() . ' -sDEVICE=pdfwrite'
            . ' -dProcessColorModel=/DeviceGray'
            . ' -dColorConversionStrategy=/Gray'
            . ' -dNOPAUSE -dBATCH -dQUIET'
            . ' -sOutputFile=' . escapeshellarg($output)
            . ' ' . escapeshellarg($input)
        );
        @unlink($input);

        if (!$result['ok'] || !file_exists($output)) {
            return $this->err('Grayscale failed: ' . $result['stdout']);
        }
        return $this->download($output, 'grayscale.pdf');
    }

    public function extractImages(Request $request)
    {
        $this->needsFile($request);
        $input  = $this->saveUpload($request->file('file'));
        $prefix = $this->outputDir . DIRECTORY_SEPARATOR . Str::random(10) . '_img';

        $this->run($this->pdfimages() . ' -all ' . escapeshellarg($input) . ' ' . escapeshellarg($prefix));
        @unlink($input);

        $images = array_merge(
            glob($prefix . '*.jpg') ?: [],
            glob($prefix . '*.png') ?: [],
            glob($prefix . '*.ppm') ?: []
        );

        if (empty($images)) {
            return response()->json(['message' => 'No images found.', 'count' => 0]);
        }

        $zipPath = $this->outputPath('zip');
        $zip     = new ZipArchive();
        $zip->open($zipPath, ZipArchive::CREATE);
        foreach ($images as $img) {
            $zip->addFile($img, basename($img));
        }
        $zip->close();
        foreach ($images as $img) @unlink($img);

        return $this->download($zipPath, 'extracted_images.zip', 'application/zip');
    }
}
