<?php
// এই file টা routes/web.php এ add করুন — শুধু test এর জন্য

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\SocialiteController;

Route::get('/', function () {
    return view('welcome');
});

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


Route::get('/sitemap.xml', function () {
    $content = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://pdftash.com</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://pdftash.com/#tools</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://pdftash.com/#pricing</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
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
