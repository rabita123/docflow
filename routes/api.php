<?php

use Illuminate\Support\Facades\Route;
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
use App\Http\Controllers\PDF\SignController;
use App\Http\Middleware\CheckFreeTierLimit;

Route::get('/health', fn() => response()->json(['status' => 'ok']));

Route::prefix('pdf')->group(function () {
    Route::post('/compress',     [CompressController::class,    'handle']);
    Route::post('/merge',        [MergeController::class,       'handle']);
    Route::post('/split',        [SplitController::class,       'handle']);
    Route::post('/rotate',       [RotateController::class,      'handle']);
    Route::post('/watermark',    [WatermarkController::class,   'handle']);
    Route::post('/page-numbers', [PageNumberController::class,  'handle']);
    Route::post('/crop',         [CropController::class,        'handle']);
    Route::post('/delete-pages', [DeletePagesController::class, 'handle']);
    Route::post('/reorder',      [ReorderController::class,     'handle']);
    Route::post('/info',         [InfoController::class,        'handle']);
    Route::post('/to-images',    [ConvertController::class,     'pdfToImages']);
    Route::post('/to-text',      [ConvertController::class,     'pdfToText']);
    Route::post('/grayscale',    [ConvertController::class,     'grayscale']);
    Route::post('/extract-imgs', [ConvertController::class,     'extractImages']);
    Route::post('/images-to-pdf',[ConvertController::class,     'imagesToPdf']);
    Route::post('/protect',      [SecurityController::class,    'protect']);
    Route::post('/unlock',       [SecurityController::class,    'unlock']);
    Route::post('/sign', [SignController::class, 'handle']);
});

Route::prefix('ai')->group(function () {
    Route::post('/summarize',       [SummarizeController::class,   'handle']);
    Route::post('/upload-for-chat', [ChatController::class,        'upload']);
    Route::post('/chat',            [ChatController::class,        'chat']);
    Route::post('/translate',       [TranslateController::class,   'handle']);
    Route::post('/extract-data',    [ExtractDataController::class, 'handle']);
});