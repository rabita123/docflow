<?php
// এই file টা routes/web.php এ add করুন — শুধু test এর জন্য

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// ── Trust & Legal Pages ───────────────────────────────────────────────────────
Route::get('/privacy',  fn() => view('privacy'))->name('privacy');
Route::get('/about',    fn() => view('about'))->name('about');
Route::get('/terms',    fn() => view('terms'))->name('terms');
Route::get('/refund',   fn() => view('refund'))->name('refund');
Route::get('/contact',  fn() => view('about'));  // redirect contact to about for now

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

    // Lemon Squeezy
    $lsKey = env('LEMONSQUEEZY_API_KEY');
    $checks['Lemon Squeezy'] = $lsKey
        ? ['status' => 'ok',      'label' => 'Lemon Squeezy — API key configured']
        : ['status' => 'warning', 'label' => 'Lemon Squeezy — API key missing'];

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

// ── Auth Routes ───────────────────────────────────────────────────────────────
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login',    [AuthController::class, 'login']);
// Named 'login' so Laravel's auth middleware can redirect guests here
Route::get('/auth/google',          [SocialiteController::class, 'redirectToGoogle'])->name('login');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);
Route::post('/logout',              [SocialiteController::class, 'logout'])->name('logout');

// ── Payment Routes (Paddle Billing) ──────────────────────────────────────────
Route::get('/payment/checkout-data',     [PaymentController::class, 'checkoutData'])->middleware('auth');
Route::get('/payment/success',           [PaymentController::class, 'success']);
Route::get('/payment/cancel',            [PaymentController::class, 'cancel']);
Route::post('/payment/webhook',          [PaymentController::class, 'webhook'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);


Route::get('/compress-pdf', fn() => view('tools.compress'))->name('tool.compress');
Route::get('/merge-pdf', fn() => view('tools.merge'))->name('tool.merge');
Route::get('/split-pdf', fn() => view('tools.split'))->name('tool.split');
Route::get('/chat-with-pdf', fn() => view('tools.chat'))->name('tool.chat');
Route::get('/translate-pdf', fn() => view('tools.translate'))->name('tool.translate');
Route::get('/sign-pdf', fn() => view('tools.sign'))->name('tool.sign');


Route::get('/ai-pdf-generator', fn() => view('tools.pdf-generator'))->name('tool.pdf-generator');
Route::get('/pdf-text-editor', fn() => view('tools.pdf-text-editor'))->name('tool.pdf-text-editor');
Route::get('/ai-form-fill',       fn() => view('tools.ai-form-fill'))->name('tool.ai-form-fill');
Route::get('/watermark-remover',  fn() => view('tools.watermark-remover'))->name('tool.watermark-remover');
Route::get('/ocr-pdf',            fn() => view('tools.ocr'))->name('tool.ocr');
Route::get('/redact-pdf',         fn() => view('tools.redact'))->name('tool.redact');
Route::get('/pdf-to-csv',         fn() => view('tools.pdf-table'))->name('tool.pdf-table');

Route::get('/sejda-alternative', fn() => view('tools.sejda-alternative'))->name('tool.sejda');

// ── Programmatic SEO Landing Pages ──────────────────────────────────────────
// Compress variants
Route::get('/compress-pdf-to-200kb',                    fn() => view('pages.compress-to-200kb'))->name('seo.compress-200kb');
Route::get('/compress-pdf-to-1mb',                      fn() => view('pages.compress-to-1mb'))->name('seo.compress-1mb');
Route::get('/compress-pdf-for-email',                   fn() => view('pages.compress-for-email'))->name('seo.compress-email');
Route::get('/reduce-pdf-size-for-whatsapp',             fn() => view('pages.compress-for-whatsapp'))->name('seo.compress-whatsapp');
Route::get('/compress-pdf-for-whatsapp',                fn() => view('pages.compress-for-whatsapp'));

// Competitor alternative pages
Route::get('/smallpdf-alternative',                     fn() => view('pages.smallpdf-alt'))->name('seo.smallpdf-alt');
Route::get('/free-smallpdf-alternative',                fn() => view('pages.smallpdf-alt'));
Route::get('/ilovepdf-alternative',                     fn() => view('pages.ilovepdf-alt'))->name('seo.ilovepdf-alt');
Route::get('/free-ilovepdf-alternative',                fn() => view('pages.ilovepdf-alt'));

// Conversion tools (coming soon)
Route::get('/pdf-to-word',                              fn() => view('pages.pdf-to-word'))->name('seo.pdf-to-word');
Route::get('/pdf-to-docx',                              fn() => view('pages.pdf-to-word'));
Route::get('/convert-pdf-to-word',                      fn() => view('pages.pdf-to-word'));
Route::get('/free-pdf-to-word-converter',               fn() => view('pages.free-pdf-to-word-converter'));
Route::get('/pdf-word-converter',                       fn() => view('pages.free-pdf-to-word-converter'));
Route::get('/pdf-to-word-no-signup',                    fn() => view('pages.free-pdf-to-word-converter'));
Route::get('/pdf-to-jpg',                               fn() => view('pages.pdf-to-jpg'))->name('seo.pdf-to-jpg');
Route::get('/pdf-to-jpeg',                              fn() => view('pages.pdf-to-jpg'));
Route::get('/pdf-to-image',                             fn() => view('pages.pdf-to-jpg'));
Route::get('/convert-pdf-to-jpg',                       fn() => view('pages.pdf-to-jpg'));
Route::get('/free-sejda-alternative', fn() => view('tools.sejda-alternative'));
Route::get('/sejda-alternative-free', fn() => view('tools.sejda-alternative'));
Route::get('/pdf-translator-bengali', function () {
    return view('pages.pdf-translator-bengali');
});

// ── SEO Pages: AI Tools ──────────────────────────────────────────────────────
Route::get('/chatpdf-alternative',          fn() => view('pages.chatpdf-alternative'));
Route::get('/summarize-pdf',                fn() => view('pages.summarize-pdf'));
Route::get('/free-pdf-tools-no-signup',     fn() => view('pages.free-pdf-tools-no-signup'));
Route::get('/text-to-pdf',                  fn() => view('pages.text-to-pdf'));
Route::get('/invoice-pdf-generator',        fn() => view('pages.invoice-pdf-generator'));
Route::get('/report-pdf-generator',         fn() => view('pages.report-pdf-generator'));
Route::get('/ai-document-generator',        fn() => view('pages.ai-document-generator'));
Route::get('/create-pdf-from-text',         fn() => view('pages.create-pdf-from-text'));

// ── SEO Pages: Merge variants ────────────────────────────────────────────────
Route::get('/merge-pdf-files-online',       fn() => view('pages.merge-pdf-files-online'));
Route::get('/merge-pdf-for-email',          fn() => view('pages.merge-pdf-for-email'));
Route::get('/merge-large-pdf-files',        fn() => view('pages.merge-large-pdf-files'));
Route::get('/combine-pdf-pages',            fn() => view('pages.combine-pdf-pages'));

// ── SEO Pages: Split / extract / remove ─────────────────────────────────────
Route::get('/extract-pages-from-pdf',       fn() => view('pages.extract-pages-from-pdf'));
Route::get('/remove-pages-from-pdf',        fn() => view('pages.remove-pages-from-pdf'));
Route::get('/split-pdf-into-multiple-files',fn() => view('pages.split-pdf-into-multiple-files'));

// ── SEO Pages: Sign variants ─────────────────────────────────────────────────
Route::get('/electronic-signature-pdf',     fn() => view('pages.electronic-signature-pdf'));
Route::get('/sign-pdf-online-free',         fn() => view('pages.sign-pdf-online-free'));

// ── SEO Pages: PDF Table / CSV / Excel cluster ───────────────────────────────
Route::get('/pdf-to-excel-free',         fn() => view('pages.pdf-to-excel-free'));
Route::get('/extract-table-from-pdf',    fn() => view('pages.extract-table-from-pdf'));
Route::get('/pdf-to-spreadsheet',        fn() => view('pages.pdf-to-spreadsheet'));
Route::get('/convert-pdf-to-csv',        fn() => view('pages.convert-pdf-to-csv'));
Route::get('/pdf-invoice-to-excel',      fn() => view('pages.pdf-invoice-to-excel'));
Route::get('/pdf-table-extractor',       fn() => view('pages.pdf-table-extractor'));

// ── SEO Pages: OCR cluster ───────────────────────────────────────────────────
Route::get('/ocr-pdf-online-free',       fn() => view('pages.ocr-pdf-online-free'));
Route::get('/ocr-scanned-pdf-to-text',   fn() => view('pages.ocr-scanned-pdf-to-text'));
Route::get('/extract-text-from-pdf',     fn() => view('pages.extract-text-from-pdf'));
Route::get('/pdf-to-text-converter',     fn() => view('pages.pdf-to-text-converter'));
Route::get('/ocr-pdf-to-word',           fn() => view('pages.ocr-pdf-to-word'));
Route::get('/ocr-pdf-bengali',           fn() => view('pages.ocr-pdf-bengali'));

// ── SEO Pages: Compress variants ─────────────────────────────────────────────
Route::get('/compress-pdf-without-losing-quality', fn() => view('pages.compress-pdf-without-losing-quality'));
Route::get('/compress-scanned-pdf',         fn() => view('pages.compress-scanned-pdf'));
Route::get('/compress-large-pdf-files',     fn() => view('pages.compress-large-pdf-files'));

// ── SEO Pages: Competitor alternatives ──────────────────────────────────────
Route::get('/adobe-acrobat-alternative',    fn() => view('pages.adobe-acrobat-alternative'));
Route::get('/pdf24-alternative',            fn() => view('pages.pdf24-alternative'));
Route::get('/foxit-alternative',            fn() => view('pages.foxit-alternative'));

// ── SEO Pages: Industry / professional ──────────────────────────────────────
Route::get('/pdf-tools-for-students',       fn() => view('pages.pdf-tools-for-students'));
Route::get('/pdf-tools-for-lawyers',        fn() => view('pages.pdf-tools-for-lawyers'));
Route::get('/pdf-tools-for-teachers',       fn() => view('pages.pdf-tools-for-teachers'));
Route::get('/pdf-tools-for-accountants',    fn() => view('pages.pdf-tools-for-accountants'));

// ── Blog ─────────────────────────────────────────────────────────────────────
Route::get('/blog',                                         fn() => view('blog.index'));
Route::get('/blog/how-to-compress-pdf',                    fn() => view('blog.how-to-compress-pdf'));
Route::get('/blog/how-to-translate-pdf-to-bengali',        fn() => view('blog.how-to-translate-pdf-to-bengali'));
Route::get('/blog/best-free-pdf-tools',                    fn() => view('blog.best-free-pdf-tools'));
Route::get('/blog/how-to-merge-pdf',                       fn() => view('blog.how-to-merge-pdf'));
Route::get('/blog/ilovepdf-vs-smallpdf-vs-pdftash',        fn() => view('blog.ilovepdf-vs-smallpdf-vs-pdftash'));
Route::get('/blog/how-to-remove-watermark-from-pdf',       fn() => view('blog.how-to-remove-watermark-from-pdf'));
// New blog posts
Route::get('/blog/how-to-sign-pdf-online-free',            fn() => view('blog.how-to-sign-pdf-online-free'));
Route::get('/blog/how-to-remove-password-from-pdf',        fn() => view('blog.how-to-remove-password-from-pdf'));
Route::get('/blog/how-to-redact-pdf',                      fn() => view('blog.how-to-redact-pdf'));
Route::get('/blog/how-to-extract-tables-from-pdf',         fn() => view('blog.how-to-extract-tables-from-pdf'));
Route::get('/blog/best-free-pdf-editor-online',            fn() => view('blog.best-free-pdf-editor-online'));
Route::get('/blog/how-to-ocr-pdf',                         fn() => view('blog.how-to-ocr-pdf'));
Route::get('/blog/how-to-add-page-numbers-to-pdf',         fn() => view('blog.how-to-add-page-numbers-to-pdf'));
Route::get('/blog/how-to-translate-pdf',                   fn() => view('blog.how-to-translate-pdf'));
Route::get('/blog/how-to-convert-pdf-to-word',             fn() => view('blog.how-to-convert-pdf-to-word'));
Route::get('/blog/how-to-rotate-pdf',                      fn() => view('blog.how-to-rotate-pdf'));
Route::get('/blog/how-to-compress-pdf-for-whatsapp',       fn() => view('blog.how-to-compress-pdf-for-whatsapp'));
Route::get('/blog/how-to-password-protect-pdf',            fn() => view('blog.how-to-password-protect-pdf'));

// ── SEO Pages: New high-volume tool keywords ──────────────────────────────────
Route::get('/pdf-editor-online-free',   fn() => view('pages.pdf-editor-online-free'));
Route::get('/free-pdf-editor',          fn() => view('pages.pdf-editor-online-free'));
Route::get('/remove-pdf-password',      fn() => view('pages.remove-pdf-password'));
Route::get('/unlock-pdf-online',        fn() => view('pages.remove-pdf-password'));
Route::get('/highlight-pdf',            fn() => view('pages.highlight-pdf'));
Route::get('/annotate-pdf',             fn() => view('pages.highlight-pdf'));
Route::get('/rotate-pdf-online',        fn() => view('pages.rotate-pdf-online'));
Route::get('/rotate-pdf-free',          fn() => view('pages.rotate-pdf-online'));
Route::get('/add-watermark-to-pdf',     fn() => view('pages.add-watermark-to-pdf'));
Route::get('/watermark-pdf-online',     fn() => view('pages.add-watermark-to-pdf'));
Route::get('/pdf-to-text-online',       fn() => view('pages.pdf-to-text'));
Route::get('/compress-pdf-free',        fn() => view('pages.compress-pdf-free'));

// ── SEO Pages: Translate language variants ───────────────────────────────────
Route::get('/translate-pdf-to-spanish',     fn() => view('pages.translate-pdf-to-spanish'));
Route::get('/translate-pdf-to-hindi',       fn() => view('pages.translate-pdf-to-hindi'));
Route::get('/translate-pdf-to-arabic',      fn() => view('pages.translate-pdf-to-arabic'));
Route::get('/translate-pdf-to-french',      fn() => view('pages.translate-pdf-to-french'));
Route::get('/translate-pdf-to-portuguese',  fn() => view('pages.translate-pdf-to-portuguese'));
Route::get('/translate-pdf-to-chinese',     fn() => view('pages.translate-pdf-to-chinese'));
Route::get('/translate-pdf-to-german',      fn() => view('pages.translate-pdf-to-german'));
Route::get('/translate-pdf-to-japanese',    fn() => view('pages.translate-pdf-to-japanese'));
Route::get('/translate-pdf-to-urdu',        fn() => view('pages.translate-pdf-to-urdu'));
Route::get('/translate-english-pdf-to-bengali', fn() => view('pages.translate-english-pdf-to-bengali'));

// ── PDF Editor Hub ───────────────────────────────────────────────────────────
use App\Http\Controllers\EditorController;
Route::get('/editor', [EditorController::class, 'show'])->name('editor');
Route::post('/editor/upload', [EditorController::class, 'upload'])->name('editor.upload');
Route::get('/editor/file/{token}', [EditorController::class, 'serveFile'])->name('editor.file');

Route::get('/sitemap.xml', function () {
    $today = date('Y-m-d');
    $urls = [
        ['loc' => 'https://pdftash.com',                          'priority' => '1.0', 'changefreq' => 'daily'],
        ['loc' => 'https://pdftash.com/about',                    'priority' => '0.7', 'changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/privacy',                  'priority' => '0.5', 'changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/terms',                    'priority' => '0.5', 'changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/refund',                   'priority' => '0.5', 'changefreq' => 'monthly'],
        // Core tools
        ['loc' => 'https://pdftash.com/compress-pdf',             'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/merge-pdf',                'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/split-pdf',                'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/chat-with-pdf',            'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/translate-pdf',            'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/sign-pdf',                 'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/ai-pdf-generator',         'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/pdf-text-editor',          'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/ai-form-fill',             'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/watermark-remover',        'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/ocr-pdf',                   'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/redact-pdf',                'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/pdf-to-csv',                'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/pdf-to-excel-free',        'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/extract-table-from-pdf',   'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/pdf-to-spreadsheet',       'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/convert-pdf-to-csv',       'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/pdf-invoice-to-excel',     'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/pdf-table-extractor',      'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/ocr-pdf-online-free',      'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/ocr-scanned-pdf-to-text',  'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/extract-text-from-pdf',    'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/pdf-to-text-converter',    'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/ocr-pdf-to-word',          'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/ocr-pdf-bengali',          'priority' => '0.9', 'changefreq' => 'weekly'],
        // Competitor alternatives
        ['loc' => 'https://pdftash.com/sejda-alternative',        'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/smallpdf-alternative',     'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/ilovepdf-alternative',     'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/chatpdf-alternative',      'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/adobe-acrobat-alternative','priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/pdf24-alternative',        'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/foxit-alternative',        'priority' => '0.85','changefreq' => 'weekly'],
        // Compress variants
        ['loc' => 'https://pdftash.com/compress-pdf-to-200kb',              'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/compress-pdf-to-1mb',                'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/compress-pdf-for-email',             'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/reduce-pdf-size-for-whatsapp',       'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/compress-pdf-without-losing-quality','priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/compress-scanned-pdf',               'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/compress-large-pdf-files',           'priority' => '0.85','changefreq' => 'weekly'],
        // Merge / split / sign variants
        ['loc' => 'https://pdftash.com/merge-pdf-files-online',    'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/merge-pdf-for-email',        'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/merge-large-pdf-files',      'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/combine-pdf-pages',          'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/extract-pages-from-pdf',     'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/remove-pages-from-pdf',      'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/split-pdf-into-multiple-files','priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/electronic-signature-pdf',   'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/sign-pdf-online-free',       'priority' => '0.85','changefreq' => 'weekly'],
        // Conversion tools
        ['loc' => 'https://pdftash.com/pdf-to-word',               'priority' => '0.95','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/pdf-to-jpg',                'priority' => '0.95','changefreq' => 'weekly'],
        // AI / text creation cluster
        ['loc' => 'https://pdftash.com/summarize-pdf',             'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/text-to-pdf',               'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/invoice-pdf-generator',     'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/report-pdf-generator',      'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/ai-document-generator',     'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/create-pdf-from-text',      'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/free-pdf-tools-no-signup',  'priority' => '0.85','changefreq' => 'weekly'],
        // Industry pages
        ['loc' => 'https://pdftash.com/pdf-tools-for-students',    'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/pdf-tools-for-lawyers',     'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/pdf-tools-for-teachers',    'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/pdf-tools-for-accountants', 'priority' => '0.8', 'changefreq' => 'weekly'],
        // Translate language variants
        ['loc' => 'https://pdftash.com/pdf-translator-bengali',         'priority' => '0.95','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/translate-english-pdf-to-bengali','priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/translate-pdf-to-spanish',        'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/translate-pdf-to-hindi',          'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/translate-pdf-to-arabic',         'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/translate-pdf-to-french',         'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/translate-pdf-to-portuguese',     'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/translate-pdf-to-chinese',        'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/translate-pdf-to-german',         'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/translate-pdf-to-japanese',       'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/translate-pdf-to-urdu',           'priority' => '0.85','changefreq' => 'weekly'],
        // Blog
        ['loc' => 'https://pdftash.com/blog',                                        'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/blog/how-to-compress-pdf',                    'priority' => '0.75','changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/blog/how-to-translate-pdf-to-bengali',        'priority' => '0.75','changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/blog/best-free-pdf-tools',                    'priority' => '0.75','changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/blog/how-to-merge-pdf',                       'priority' => '0.75','changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/blog/ilovepdf-vs-smallpdf-vs-pdftash',        'priority' => '0.75','changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/blog/how-to-remove-watermark-from-pdf',       'priority' => '0.75','changefreq' => 'monthly'],
        // New blog posts
        ['loc' => 'https://pdftash.com/blog/how-to-sign-pdf-online-free',           'priority' => '0.85','changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/blog/how-to-remove-password-from-pdf',       'priority' => '0.85','changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/blog/how-to-redact-pdf',                     'priority' => '0.85','changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/blog/how-to-extract-tables-from-pdf',        'priority' => '0.85','changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/blog/best-free-pdf-editor-online',           'priority' => '0.9', 'changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/blog/how-to-ocr-pdf',                        'priority' => '0.85','changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/blog/how-to-add-page-numbers-to-pdf',        'priority' => '0.8', 'changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/blog/how-to-translate-pdf',                  'priority' => '0.85','changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/blog/how-to-convert-pdf-to-word',           'priority' => '0.9', 'changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/blog/how-to-rotate-pdf',                   'priority' => '0.85','changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/blog/how-to-compress-pdf-for-whatsapp',    'priority' => '0.85','changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/blog/how-to-password-protect-pdf',         'priority' => '0.85','changefreq' => 'monthly'],
        ['loc' => 'https://pdftash.com/free-pdf-to-word-converter',                'priority' => '0.95','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/pdf-word-converter',                        'priority' => '0.9', 'changefreq' => 'weekly'],
        // New landing pages
        ['loc' => 'https://pdftash.com/pdf-editor-online-free',  'priority' => '0.95','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/remove-pdf-password',     'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/highlight-pdf',            'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/annotate-pdf',            'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/rotate-pdf-online',       'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/add-watermark-to-pdf',    'priority' => '0.85','changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/pdf-to-text-online',      'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => 'https://pdftash.com/compress-pdf-free',       'priority' => '0.9', 'changefreq' => 'weekly'],
        // Editor
        ['loc' => 'https://pdftash.com/editor',                  'priority' => '0.95','changefreq' => 'weekly'],
    ];

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($urls as $u) {
        $xml .= "  <url>\n";
        $xml .= "    <loc>{$u['loc']}</loc>\n";
        $xml .= "    <lastmod>{$today}</lastmod>\n";
        $xml .= "    <changefreq>{$u['changefreq']}</changefreq>\n";
        $xml .= "    <priority>{$u['priority']}</priority>\n";
        $xml .= "  </url>\n";
    }
    $xml .= '</urlset>';

    return response($xml, 200, ['Content-Type' => 'application/xml']);
});



// ── Admin: Users List ────────────────────────────────────────────────────────
Route::get('/admin/users', function (\Illuminate\Http\Request $request) {
    // Simple secret-key protection — set ADMIN_SECRET in .env
    $secret = env('ADMIN_SECRET', 'pdftash-admin-2026');
    if ($request->query('key') !== $secret) {
        abort(403, 'Forbidden — add ?key=YOUR_SECRET to the URL');
    }

    $users    = \App\Models\User::orderBy('created_at', 'desc')->get();
    $total    = $users->count();
    $proCount = $users->where('plan', 'pro')->count();
    $freeCount = $total - $proCount;
    $todayCount = $users->filter(fn($u) => \Carbon\Carbon::parse($u->created_at)->isToday())->count();

    return view('admin-users', compact('users', 'total', 'proCount', 'freeCount', 'todayCount'));
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
