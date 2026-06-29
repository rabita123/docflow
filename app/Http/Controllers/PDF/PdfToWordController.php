<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PdfToWordController extends BasePdfController
{
    public function handle(Request $request)
    {
        $this->needsFile($request);

        $input  = $this->saveUpload($request->file('file'));
        $format = in_array($request->input('format'), ['docx', 'odt']) ? $request->input('format') : 'docx';

        // LibreOffice converts PDF → DOCX/ODT
        $outDir  = $this->outputDir;
        $baseName = pathinfo($input, PATHINFO_FILENAME);

        // LibreOffice needs a writable HOME directory for www-data
        $loHome = '/var/www/.libreoffice';
        if (!is_dir($loHome)) @mkdir($loHome, 0755, true);

        $filter = $format === 'docx' ? 'MS Word 2007 XML' : 'writer8';

        $cmd = 'HOME=' . escapeshellarg($loHome)
             . ' libreoffice --headless'
             . ' --infilter="writer_pdf_import"'
             . ' --convert-to ' . escapeshellarg($format . ':' . $filter)
             . ' --outdir ' . escapeshellarg($outDir)
             . ' ' . escapeshellarg($input)
             . ' 2>&1';

        $result = $this->run($cmd, 180);
        @unlink($input);

        $outputFile = $outDir . DIRECTORY_SEPARATOR . $baseName . '.' . $format;

        if (!file_exists($outputFile) || filesize($outputFile) < 100) {
            \Illuminate\Support\Facades\Log::error('PDF to Word failed', [
                'cmd'    => $cmd,
                'output' => $result['stdout'],
                'exists' => file_exists($outputFile),
                'size'   => file_exists($outputFile) ? filesize($outputFile) : 0,
            ]);
            return $this->err('Conversion failed. Please try again with a different PDF.');
        }

        $mime = $format === 'docx'
            ? 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            : 'application/vnd.oasis.opendocument.text';

        $downloadName = 'converted.' . $format;

        return $this->download($outputFile, $downloadName, $mime);
    }
}
