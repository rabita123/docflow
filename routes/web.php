<?php
// এই file টা routes/web.php এ add করুন — শুধু test এর জন্য

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ── Tool Test Route (development only) ───────────────────────────────────────
Route::get('/test-tools', function () {
    $results = [];

    // Find Ghostscript
    $gsGlob = glob('C:\\Program Files\\gs\\gs*\\bin\\gswin64c.exe');
    $gsPath = !empty($gsGlob) ? $gsGlob[0] : null;

    // Test Ghostscript
    if ($gsPath) {
        exec('"' . $gsPath . '" --version 2>&1', $out, $code);
        $results['ghostscript'] = [
            'path'    => $gsPath,
            'status'  => $code === 0 ? '✅ Working' : '❌ Error',
            'version' => implode('', $out),
        ];
    } else {
        $results['ghostscript'] = ['status' => '❌ Not found in Program Files\\gs\\'];
    }

    // Test PDFtk
    $pdftkPaths = [
        'C:\\Program Files (x86)\\PDFtk Server\\bin\\pdftk.exe',
        'C:\\Program Files\\PDFtk Server\\bin\\pdftk.exe',
    ];
    $pdftkPath = null;
    foreach ($pdftkPaths as $p) {
        if (file_exists($p)) { $pdftkPath = $p; break; }
    }

    if ($pdftkPath) {
        exec('"' . $pdftkPath . '" --version 2>&1', $out2, $code2);
        $results['pdftk'] = [
            'path'    => $pdftkPath,
            'status'  => $code2 === 0 ? '✅ Working' : '❌ Error',
            'version' => implode('', array_slice($out2, 0, 1)),
        ];
    } else {
        $results['pdftk'] = ['status' => '❌ Not found — Download from pdflabs.com'];
    }

    // Test pdftotext (Poppler)
    $popplerPaths = [
        'C:\\poppler\\Library\\bin\\pdftotext.exe',
        'C:\\poppler\\bin\\pdftotext.exe',
    ];
    $popplerPath = null;
    foreach ($popplerPaths as $p) {
        if (file_exists($p)) { $popplerPath = $p; break; }
    }

    if ($popplerPath) {
        exec('"' . $popplerPath . '" -v 2>&1', $out3, $code3);
        $results['poppler'] = [
            'path'    => $popplerPath,
            'status'  => '✅ Working',
            'version' => implode('', array_slice($out3, 0, 1)),
        ];
    } else {
        $results['poppler'] = [
            'status' => '❌ Not found — Extract poppler zip to C:\\poppler\\',
        ];
    }

    // PHP info
    $results['php']     = ['status' => '✅ Working', 'version' => PHP_VERSION];
    $results['os']      = PHP_OS_FAMILY . ' — ' . PHP_OS;
    $results['laravel'] = '✅ Laravel ' . app()->version();

    return response()->json($results, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
});
