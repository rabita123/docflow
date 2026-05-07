<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class BasePdfController extends Controller
{
    protected string $uploadDir;
    protected string $outputDir;

    public function __construct()
    {
        $this->uploadDir = storage_path('app/pdf_uploads');
        $this->outputDir = storage_path('app/pdf_outputs');

        foreach ([$this->uploadDir, $this->outputDir] as $dir) {
            if (!is_dir($dir)) mkdir($dir, 0755, true);
        }
    }

    // ── Tool paths (Windows + Linux auto-detect) ──────────────────────────────

    protected function gs(): string
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $glob = glob('C:\\Program Files\\gs\\gs*\\bin\\gswin64c.exe');
            if (!empty($glob)) return '"' . $glob[0] . '"';
            return '"C:\\Program Files\\gs\\gs10.07.0\\bin\\gswin64c.exe"';
        }
        return 'gs';
    }

    protected function pdftk(): string
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $paths = [
                'C:\\Program Files (x86)\\PDFtk Server\\bin\\pdftk.exe',
                'C:\\Program Files\\PDFtk Server\\bin\\pdftk.exe',
            ];
            foreach ($paths as $p) {
                if (file_exists($p)) return '"' . $p . '"';
            }
        }
        return 'pdftk';
    }

   protected function magick(): string
{
    if (PHP_OS_FAMILY === 'Windows') {
        $path = 'C:\\Program Files\\ImageMagick-7.1.2-Q16-HDRI\\magick.exe';
        if (file_exists($path)) return '"' . $path . '"';
    }
    return 'magick';
}

    protected function getPdftotextCmd(): string
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $paths = [
                'C:\\poppler\\Library\\bin\\pdftotext.exe',
                'C:\\poppler\\bin\\pdftotext.exe',
            ];
            foreach ($paths as $p) {
                if (file_exists($p)) return '"' . $p . '"';
            }
        }
        return 'pdftotext';
    }

    protected function pdfimages(): string
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $paths = [
                'C:\\poppler\\Library\\bin\\pdfimages.exe',
                'C:\\poppler\\bin\\pdfimages.exe',
            ];
            foreach ($paths as $p) {
                if (file_exists($p)) return '"' . $p . '"';
            }
        }
        return 'pdfimages';
    }

    // ── Run shell command ─────────────────────────────────────────────────────

    protected function run(string $command, int $timeout = 120): array
    {
        $output     = [];
        $returnCode = 0;
        exec($command . ' 2>&1', $output, $returnCode);

        return [
            'ok'     => $returnCode === 0,
            'stdout' => implode("\n", $output),
        ];
    }

    // ── File helpers ──────────────────────────────────────────────────────────

    protected function saveUpload(\Illuminate\Http\UploadedFile $file): string
    {
        $ext      = strtolower($file->getClientOriginalExtension()) ?: 'pdf';
        $filename = Str::random(12) . '.' . $ext;
        $file->move($this->uploadDir, $filename);
        return $this->uploadDir . DIRECTORY_SEPARATOR . $filename;
    }

    protected function outputPath(string $ext = 'pdf'): string
    {
        return $this->outputDir . DIRECTORY_SEPARATOR . Str::random(12) . '.' . $ext;
    }

    protected function download(string $path, string $name, string $mime = 'application/pdf')
    {
        return response()->download($path, $name, [
            'Content-Type'        => $mime,
            'Content-Disposition' => 'attachment; filename="' . $name . '"',
        ])->deleteFileAfterSend(true);
    }

    protected function err(string $msg, int $code = 400)
    {
        return response()->json(['error' => $msg], $code);
    }

    protected function needsFile(Request $request, string $field = 'file')
    {
        if (!$request->hasFile($field) || !$request->file($field)->isValid()) {
            abort(400, 'No valid file uploaded');
        }
    }

    protected function getPageCount(string $pdfPath): int
    {
        $cmd    = $this->pdftk() . ' ' . escapeshellarg($pdfPath) . ' dump_data';
        $result = $this->run($cmd);
        if (preg_match('/NumberOfPages: (\d+)/', $result['stdout'], $m)) {
            return (int) $m[1];
        }
        return 1;
    }

    protected function extractText(string $pdfPath, int $maxPages = 15): string
    {
        $txt = $this->outputPath('txt');
        $cmd = $this->pdftotext() . ' -l ' . $maxPages . ' '
             . escapeshellarg($pdfPath) . ' ' . escapeshellarg($txt);
        $this->run($cmd);

        $text = file_exists($txt) ? file_get_contents($txt) : '';
        @unlink($txt);
        return substr(trim($text), 0, 20000);
    }

    public static function cleanup(): void
    {
        foreach ([storage_path('app/pdf_uploads'), storage_path('app/pdf_outputs')] as $dir) {
            if (!is_dir($dir)) continue;
            foreach (glob($dir . DIRECTORY_SEPARATOR . '*') as $file) {
                if (is_file($file) && filemtime($file) < time() - 7200) {
                    @unlink($file);
                }
            }
        }
    }
}
