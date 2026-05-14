<?php
// এই file টা routes/web.php এ add করুন — শুধু test এর জন্য

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\SocialiteController;

Route::get('/', function () {
    return view('welcome');
});

// ── System Status ────────────────────────────────────────────────────────────
Route::get('/system-status', function () {
    $checks = [];

    // PHP
    $checks['PHP'] = ['status' => 'ok', 'value' => PHP_VERSION, 'label' => 'PHP ' . PHP_VERSION];

    // Laravel
    $checks['Laravel'] = ['status' => 'ok', 'value' => app()->version(), 'label' => 'Laravel ' . app()->version()];

    // Database
    try {
        \DB::connection()->getPdo();
        $checks['Database'] = ['status' => 'ok', 'label' => 'SQLite — connected'];
    } catch (\Exception $e) {
        $checks['Database'] = ['status' => 'error', 'label' => 'Database — ' . $e->getMessage()];
    }

    // Ghostscript
    $gsGlob = glob('C:\\Program Files\\gs\\gs*\\bin\\gswin64c.exe');
    if (!empty($gsGlob)) {
        exec('"' . $gsGlob[0] . '" --version 2>&1', $gsOut);
        $checks['Ghostscript'] = ['status' => 'ok', 'label' => 'Ghostscript ' . trim(implode('', $gsOut))];
    } else {
        $checks['Ghostscript'] = ['status' => 'error', 'label' => 'Ghostscript — not found'];
    }

    // PDFtk
    $pdftkPaths = ['C:\\Program Files (x86)\\PDFtk Server\\bin\\pdftk.exe', 'C:\\Program Files\\PDFtk Server\\bin\\pdftk.exe'];
    $pdftkFound = false;
    foreach ($pdftkPaths as $p) {
        if (file_exists($p)) {
            exec('"' . $p . '" --version 2>&1', $pOut);
            $checks['PDFtk'] = ['status' => 'ok', 'label' => 'PDFtk — ' . trim($pOut[0] ?? 'installed')];
            $pdftkFound = true; break;
        }
    }
    if (!$pdftkFound) $checks['PDFtk'] = ['status' => 'error', 'label' => 'PDFtk — not found'];

    // ImageMagick
    $magick = 'C:\\Program Files\\ImageMagick-7.1.2-Q16-HDRI\\magick.exe';
    if (file_exists($magick)) {
        exec('"' . $magick . '" --version 2>&1', $mOut);
        $checks['ImageMagick'] = ['status' => 'ok', 'label' => 'ImageMagick — ' . trim($mOut[0] ?? 'installed')];
    } else {
        $checks['ImageMagick'] = ['status' => 'warning', 'label' => 'ImageMagick — not found (optional)'];
    }

    // Poppler (pdftotext)
    $popplerPaths = ['C:\\poppler\\Library\\bin\\pdftotext.exe', 'C:\\poppler\\bin\\pdftotext.exe'];
    $popplerFound = false;
    foreach ($popplerPaths as $p) {
        if (file_exists($p)) {
            $checks['Poppler'] = ['status' => 'ok', 'label' => 'Poppler (pdftotext) — installed'];
            $popplerFound = true; break;
        }
    }
    if (!$popplerFound) $checks['Poppler'] = ['status' => 'warning', 'label' => 'Poppler — not found (AI features limited)'];

    // Anthropic API
    $apiKey = env('ANTHROPIC_API_KEY');
    $checks['Anthropic AI'] = $apiKey
        ? ['status' => 'ok',    'label' => 'Anthropic API — key configured']
        : ['status' => 'error', 'label' => 'Anthropic API — key missing'];

    // Stripe
    $stripeKey = env('STRIPE_KEY');
    $checks['Stripe'] = $stripeKey
        ? ['status' => 'ok',    'label' => 'Stripe — key configured']
        : ['status' => 'warning', 'label' => 'Stripe — key missing'];

    // Storage writable
    $storageOk = is_writable(storage_path('app'));
    $checks['Storage'] = $storageOk
        ? ['status' => 'ok',    'label' => 'Storage — writable']
        : ['status' => 'error', 'label' => 'Storage — not writable'];

    // Google OAuth
    $checks['Google OAuth'] = env('GOOGLE_CLIENT_ID')
        ? ['status' => 'ok',    'label' => 'Google OAuth — configured']
        : ['status' => 'warning', 'label' => 'Google OAuth — not configured'];

    $allOk = collect($checks)->every(fn($c) => $c['status'] !== 'error');

    return response()->view('system-status', compact('checks', 'allOk'));
});

// ── Dashboard ────────────────────────────────────────────────────────────────
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// ── Google OAuth Routes ──────────────────────────────────────────────────────
Route::get('/auth/google',          [SocialiteController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);
Route::post('/logout',              [SocialiteController::class, 'logout'])->name('logout');

// ── Payment Routes ───────────────────────────────────────────────────────────
Route::post('/payment/checkout', [PaymentController::class, 'checkout']);
Route::get('/payment/success',   [PaymentController::class, 'success']);
Route::get('/payment/cancel',    [PaymentController::class, 'cancel']);


Route::get('/compress-pdf', fn() => view('tools.compress'))->name('tool.compress');
Route::get('/merge-pdf', fn() => view('tools.merge'))->name('tool.merge');
Route::get('/split-pdf', fn() => view('tools.split'))->name('tool.split');
Route::get('/chat-with-pdf', fn() => view('tools.chat'))->name('tool.chat');
Route::get('/translate-pdf', fn() => view('tools.translate'))->name('tool.translate');
Route::get('/sign-pdf', fn() => view('tools.sign'))->name('tool.sign');


Route::get('/sejda-alternative', fn() => view('tools.sejda-alternative'))->name('tool.sejda');
Route::get('/free-sejda-alternative', fn() => view('tools.sejda-alternative'));
Route::get('/sejda-alternative-free', fn() => view('tools.sejda-alternative'));
Route::get('/pdf-translator-bengali', function () {
    return view('pages.pdf-translator-bengali');
});

Route::get('/sitemap.xml', function () {
    $content = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<url><loc>https://pdftash.com</loc><changefreq>weekly</changefreq><priority>1.0</priority></url>
    <url><loc>https://pdftash.com/compress-pdf</loc><changefreq>weekly</changefreq><priority>0.9</priority></url>
    <url><loc>https://pdftash.com/merge-pdf</loc><changefreq>weekly</changefreq><priority>0.9</priority></url>
    <url><loc>https://pdftash.com/split-pdf</loc><changefreq>weekly</changefreq><priority>0.9</priority></url>
    <url><loc>https://pdftash.com/chat-with-pdf</loc><changefreq>weekly</changefreq><priority>0.9</priority></url>
    <url><loc>https://pdftash.com/translate-pdf</loc><changefreq>weekly</changefreq><priority>0.9</priority></url>
    <url><loc>https://pdftash.com/sign-pdf</loc><changefreq>weekly</changefreq><priority>0.9</priority></url>
    <url><loc>https://pdftash.com/pdf-to-bengali</loc><changefreq>weekly</changefreq><priority>0.9</priority></url>
    <url><loc>https://pdftash.com/sejda-alternative</loc><changefreq>weekly</changefreq><priority>0.9</priority></url>
</urlset>';
    return response($content, 200, ['Content-Type' => 'application/xml']);
});



// ── Tool Test Route (development only) ───────────────────────────────────────
// Route::get('/test-tools', function () {
//     $results = [];

//     // Find Ghostscript
//     $gsGlob = glob('C:\\Program Files\\gs\\gs*\\bin\\gswin64c.exe');
//     $gsPath = !empty($gsGlob) ? $gsGlob[0] : null;

//     // Test Ghostscript
//     if ($gsPath) {
//         exec('"' . $gsPath . '" --version 2>&1', $out, $code);
//         $results['ghostscript'] = [
//             'path'    => $gsPath,
//             'status'  => $code === 0 ? '✅ Working' : '❌ Error',
//             'version' => implode('', $out),
//         ];
//     } else {
//         $results['ghostscript'] = ['status' => '❌ Not found in Program Files\\gs\\'];
//     }

//     // Test PDFtk
//     $pdftkPaths = [
//         'C:\\Program Files (x86)\\PDFtk Server\\bin\\pdftk.exe',
//         'C:\\Program Files\\PDFtk Server\\bin\\pdftk.exe',
//     ];
//     $pdftkPath = null;
//     foreach ($pdftkPaths as $p) {
//         if (file_exists($p)) { $pdftkPath = $p; break; }
//     }

//     if ($pdftkPath) {
//         exec('"' . $pdftkPath . '" --version 2>&1', $out2, $code2);
//         $results['pdftk'] = [
//             'path'    => $pdftkPath,
//             'status'  => $code2 === 0 ? '✅ Working' : '❌ Error',
//             'version' => implode('', array_slice($out2, 0, 1)),
//         ];
//     } else {
//         $results['pdftk'] = ['status' => '❌ Not found — Download from pdflabs.com'];
//     }

//     // Test pdftotext (Poppler)
//     $popplerPaths = [
//         'C:\\poppler\\Library\\bin\\pdftotext.exe',
//         'C:\\poppler\\bin\\pdftotext.exe',
//     ];
//     $popplerPath = null;
//     foreach ($popplerPaths as $p) {
//         if (file_exists($p)) { $popplerPath = $p; break; }
//     }

//     if ($popplerPath) {
//         exec('"' . $popplerPath . '" -v 2>&1', $out3, $code3);
//         $results['poppler'] = [
//             'path'    => $popplerPath,
//             'status'  => '✅ Working',
//             'version' => implode('', array_slice($out3, 0, 1)),
//         ];
//     } else {
//         $results['poppler'] = [
//             'status' => '❌ Not found — Extract poppler zip to C:\\poppler\\',
//         ];
//     }

//     // PHP info
//     $results['php']     = ['status' => '✅ Working', 'version' => PHP_VERSION];
//     $results['os']      = PHP_OS_FAMILY . ' — ' . PHP_OS;
//     $results['laravel'] = '✅ Laravel ' . app()->version();

//     return response()->json($results, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
// });
