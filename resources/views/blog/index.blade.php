@extends('blog.layout')

@section('title', 'PDF Tips & Guides')
@section('description', 'Free PDF guides, tips, and comparisons. Learn how to compress, translate, merge, edit, and sign PDFs for free.')
@section('slug', '')
@section('keywords', 'pdf tips, how to compress pdf, pdf guides, pdf translation, free pdf tools')

@section('content')

<style>
    /* ── Blog index specific styles ── */
    .blog-index {
        padding-bottom: 80px;
    }

    /* Hero */
    .blog-hero {
        text-align: center;
        padding: 72px 20px 56px;
    }

    .blog-hero h1 {
        font-size: 48px;
        font-weight: 800;
        color: #eeeef8;
        letter-spacing: -.5px;
        line-height: 1.15;
        margin-bottom: 16px;
    }

    .blog-hero p {
        font-size: 17px;
        color: #8888a8;
        max-width: 480px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Articles grid */
    .articles-grid {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* Article card */
    .article-card {
        background: #0f0f1a;
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: 16px;
        padding: 24px;
        text-decoration: none;
        color: inherit;
        display: block;
        transition: border-color .2s, transform .2s, box-shadow .2s;
    }

    .article-card:hover {
        border-color: #5b5cff;
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(91, 92, 255, .12);
    }

    .article-card__emoji {
        font-size: 32px;
        margin-bottom: 12px;
        display: block;
        line-height: 1;
    }

    .article-card__title {
        font-size: 17px;
        font-weight: 700;
        color: #eeeef8;
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .article-card__desc {
        font-size: 13px;
        color: #8888a8;
        line-height: 1.6;
        margin-bottom: 16px;
    }

    .article-card__meta {
        font-size: 12px;
        color: #5b5cff;
        font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 640px) {
        .blog-hero h1 {
            font-size: 32px;
        }

        .articles-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="blog-index">

    {{-- Hero --}}
    <div class="blog-hero">
        <h1>PDF Tips, Guides &amp; Comparisons</h1>
        <p>Step-by-step PDF tutorials and tool comparisons. No fluff &mdash; just what works.</p>
    </div>

    {{-- Articles grid --}}
    <div class="articles-grid">

        {{-- Article 1: Compress --}}
        <a href="/blog/how-to-compress-pdf" class="article-card">
            <span class="article-card__emoji">🗜️</span>
            <h2 class="article-card__title">How to Compress a PDF Without Losing Quality</h2>
            <p class="article-card__desc">Free methods to shrink PDF size while keeping text sharp and images clear. Works for any PDF type.</p>
            <span class="article-card__meta">5 min read · Compress</span>
        </a>

        {{-- Article 2: Translate --}}
        <a href="/blog/how-to-translate-pdf-to-bengali" class="article-card">
            <span class="article-card__emoji">🌐</span>
            <h2 class="article-card__title">How to Translate a PDF to Bengali Online Free</h2>
            <p class="article-card__desc">Step-by-step guide to converting English PDF documents to Bengali using free AI tools.</p>
            <span class="article-card__meta">4 min read · Translate</span>
        </a>

        {{-- Article 3: Best tools --}}
        <a href="/blog/best-free-pdf-tools" class="article-card">
            <span class="article-card__emoji">🛠️</span>
            <h2 class="article-card__title">7 Best Free PDF Tools in 2026 (No Signup)</h2>
            <p class="article-card__desc">The definitive list of free PDF tools that actually work &mdash; no watermarks, no email required.</p>
            <span class="article-card__meta">6 min read · Tools</span>
        </a>

        {{-- Article 4: Merge --}}
        <a href="/blog/how-to-merge-pdf" class="article-card">
            <span class="article-card__emoji">📎</span>
            <h2 class="article-card__title">How to Merge PDF Files Online &mdash; Complete Guide</h2>
            <p class="article-card__desc">Combine multiple PDFs into one file in seconds. Free methods for every device and browser.</p>
            <span class="article-card__meta">4 min read · Merge</span>
        </a>

        {{-- Article 5: Comparison --}}
        <a href="/blog/ilovepdf-vs-smallpdf-vs-pdftash" class="article-card">
            <span class="article-card__emoji">⚔️</span>
            <h2 class="article-card__title">iLovePDF vs SmallPDF vs PDFTash: Which Is Best?</h2>
            <p class="article-card__desc">Honest comparison of the top free PDF tools &mdash; features, limits, pricing, and privacy.</p>
            <span class="article-card__meta">7 min read · Comparison</span>
        </a>

        {{-- Article 6: Watermark --}}
        <a href="/blog/how-to-remove-watermark-from-pdf" class="article-card">
            <span class="article-card__emoji">🚫</span>
            <h2 class="article-card__title">How to Remove a Watermark from a PDF (Free)</h2>
            <p class="article-card__desc">Auto-remove DRAFT, CONFIDENTIAL and custom watermarks from any PDF online, no software needed.</p>
            <span class="article-card__meta">4 min read · Watermark</span>
        </a>

    </div>

</div>

@endsection
