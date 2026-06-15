<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\PDF\CompressController;
use App\Http\Controllers\PDF\MergeController;
use App\Http\Controllers\PDF\SplitController;
use App\Http\Controllers\PDF\RotateController;
use App\Http\Controllers\PDF\WatermarkController;
use App\Http\Controllers\PDF\PageNumberController;
use App\Http\Controllers\PDF\CropController;
use App\Http\Controllers\PDF\DeletePagesController;
use App\Http\Controllers\PDF\ReorderController;
use App\Http\Controllers\PDF\ConvertController;
use App\Http\Controllers\PDF\SecurityController;
use App\Http\Controllers\PDF\InfoController;
use App\Http\Controllers\AI\SummarizeController;
use App\Http\Controllers\AI\ChatController;
use App\Http\Controllers\AI\TranslateController;
use App\Http\Controllers\AI\ExtractDataController;
use App\Http\Controllers\AI\PdfGeneratorController;
use App\Http\Controllers\AI\FormFillController;
use App\Http\Controllers\PDF\PdfTextEditorController;
use App\Http\Controllers\PDF\SignController;
use App\Http\Controllers\PDF\OcrController;
use App\Http\Controllers\PDF\RedactController;
use App\Http\Controllers\PDF\PdfTableController;
use App\Http\Middleware\CheckFreeTierLimit;
use App\Http\Middleware\GuardApiOrigin;

Route::get('/health', fn() => response()->json(['status' => 'ok']));

// Usage counter endpoint
Route::get('/usage', function () {
    $isPro = Auth::check() && Auth::user()->plan === 'pro';
    if ($isPro) {
        return response()->json([
            'plan'      => 'pro',
            'unlimited' => true,
            'pdf'       => ['used' => 0, 'limit' => 0, 'remaining' => 999],
            'ai'        => ['used' => 0, 'limit' => 0, 'remaining' => 999],
        ]);
    }
    $identifier = Auth::check() ? 'user_' . Auth::id() : 'ip_' . request()->ip();
    $today      = date('Y-m-d');
    $limits     = \App\Http\Middleware\CheckFreeTierLimit::LIMITS;
    $data       = ['plan' => Auth::check() ? Auth::user()->plan : 'guest', 'unlimited' => false];
    foreach ($limits as $group => $limit) {
        $used = Cache::get("limit_{$group}_{$identifier}_{$today}", 0);
        $data[$group] = ['used' => $used, 'limit' => $limit, 'remaining' => max(0, $limit - $used)];
    }
    return response()->json($data);
});

// All tool routes — protected by free tier limit + burst throttle
// throttle:30,1  = max 30 requests per 1 minute per IP (burst protection)
Route::middleware([GuardApiOrigin::class, 'throttle:30,1', CheckFreeTierLimit::class])->group(function () {

    Route::prefix('pdf')->group(function () {
        Route::post('/compress',      [CompressController::class,    'handle']);
        Route::post('/merge',         [MergeController::class,       'handle']);
        Route::post('/split',         [SplitController::class,       'handle']);
        Route::post('/rotate',        [RotateController::class,      'handle']);
        Route::post('/watermark',     [WatermarkController::class,   'handle']);
        Route::post('/page-numbers',  [PageNumberController::class,  'handle']);
        Route::post('/crop',          [CropController::class,        'handle']);
        Route::post('/delete-pages',  [DeletePagesController::class, 'handle']);
        Route::post('/reorder',       [ReorderController::class,     'handle']);
        Route::post('/info',          [InfoController::class,        'handle']);
        Route::post('/to-images',     [ConvertController::class,     'pdfToImages']);
        Route::post('/to-text',       [ConvertController::class,     'pdfToText']);
        Route::post('/grayscale',     [ConvertController::class,     'grayscale']);
        Route::post('/extract-imgs',  [ConvertController::class,     'extractImages']);
        Route::post('/images-to-pdf', [ConvertController::class,     'imagesToPdf']);
        Route::post('/ocr',           [OcrController::class,         'handle']);
        Route::post('/protect',       [SecurityController::class,    'protect']);
        Route::post('/unlock',        [SecurityController::class,    'unlock']);
        Route::post('/sign',          [SignController::class,        'handle']);
        Route::post('/text-editor/extract', [PdfTextEditorController::class, 'extract']);
        Route::post('/text-editor/export',  [PdfTextEditorController::class, 'export']);
        Route::post('/redact',              [RedactController::class,        'handle']);
        Route::post('/table-extract',       [PdfTableController::class,      'handle']);
    });

    // AI routes get extra-tight throttle: 10 req/min — protects API spend
    Route::middleware('throttle:10,1')->prefix('ai')->group(function () {
        Route::post('/summarize',       [SummarizeController::class,   'handle']);
        Route::post('/upload-for-chat', [ChatController::class,        'upload']);
        Route::post('/chat',            [ChatController::class,        'chat']);
        Route::post('/translate',       [TranslateController::class,   'handle']);
        Route::post('/extract-data',    [ExtractDataController::class,  'handle']);
        Route::post('/generate-pdf',    [PdfGeneratorController::class, 'handle']);
        Route::post('/form-fill',       [FormFillController::class,     'handle']);
    });

});
