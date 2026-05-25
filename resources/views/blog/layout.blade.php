<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description')">
    @hasSection('keywords')
    <meta name="keywords" content="@yield('keywords')">
    @endif
    <link rel="canonical" href="https://pdftash.com/blog/@yield('slug')">

    {{-- Open Graph --}}
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="PDFTash">
    <meta property="og:title" content="@yield('title') — PDFTash Blog">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:url" content="https://pdftash.com/blog/@yield('slug')">
    @hasSection('og_image')
    <meta property="og:image" content="@yield('og_image')">
    @endif

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title') — PDFTash Blog">
    <meta name="twitter:description" content="@yield('description')">
    @hasSection('og_image')
    <meta name="twitter:image" content="@yield('og_image')">
    @endif

    {{-- Schema --}}
    @hasSection('schema')
    @yield('schema')
    @endif

    <title>@yield('title') — PDFTash Blog</title>

    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: #07070d;
            color: #eeeef8;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* ── Nav ── */
        .blog-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 40px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            position: sticky;
            top: 0;
            background: #07070d;
            z-index: 100;
        }

        .blog-nav__logo {
            font-size: 20px;
            font-weight: 800;
            color: #5b5cff;
            text-decoration: none;
            letter-spacing: -.3px;
        }

        .blog-nav__back {
            font-size: 14px;
            color: #8888a8;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color .2s;
        }

        .blog-nav__back:hover {
            color: #eeeef8;
        }

        /* ── Main content wrapper ── */
        .blog-container {
            max-width: 740px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ── Article typography ── */
        article h1,
        .blog-h1 {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.15;
            color: #eeeef8;
            letter-spacing: -.5px;
            margin-bottom: 20px;
        }

        article h2 {
            font-size: 28px;
            font-weight: 700;
            color: #eeeef8;
            border-left: 3px solid #5b5cff;
            padding-left: 12px;
            margin: 40px 0 16px;
        }

        article h2.section-h2 {
            border-left: none;
            padding-left: 0;
        }

        article h3 {
            font-size: 18px;
            font-weight: 600;
            color: #eeeef8;
            margin: 28px 0 12px;
        }

        article p {
            font-size: 16px;
            line-height: 1.8;
            color: #c8c8d8;
            margin-bottom: 20px;
        }

        article ul,
        article ol {
            color: #c8c8d8;
            line-height: 1.8;
            padding-left: 20px;
            margin-bottom: 20px;
        }

        article li {
            margin-bottom: 8px;
        }

        article strong {
            color: #eeeef8;
            font-weight: 600;
        }

        article a {
            color: #5b5cff;
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        article a:hover {
            color: #7879ff;
        }

        article code {
            background: #0f0f1a;
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 4px;
            padding: 2px 6px;
            font-size: 14px;
            font-family: 'Courier New', monospace;
            color: #00e5a0;
        }

        article pre {
            background: #0f0f1a;
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 12px;
            padding: 20px;
            overflow-x: auto;
            margin-bottom: 24px;
        }

        article pre code {
            background: none;
            border: none;
            padding: 0;
            font-size: 13px;
        }

        /* ── Post meta ── */
        .post-meta {
            display: flex;
            gap: 20px;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 32px;
            font-size: 13px;
            color: #8888a8;
        }

        .post-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* ── Table of contents ── */
        .toc {
            background: #0f0f1a;
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 12px;
            padding: 20px 24px;
            margin: 32px 0;
        }

        .toc h4 {
            font-size: 13px;
            font-weight: 700;
            color: #8888a8;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 12px;
        }

        .toc ol {
            padding-left: 16px;
            margin-bottom: 0;
        }

        .toc li {
            font-size: 14px;
            color: #eeeef8;
            margin-bottom: 6px;
        }

        .toc a {
            color: #5b5cff;
            text-decoration: none;
        }

        .toc a:hover {
            text-decoration: underline;
        }

        /* ── Callout ── */
        .callout {
            background: #0f0f1a;
            border-left: 4px solid #5b5cff;
            border-radius: 8px;
            padding: 16px 20px;
            margin: 24px 0;
        }

        .callout.green {
            border-left-color: #00e5a0;
        }

        .callout p {
            margin-bottom: 0;
        }

        /* ── CTA box ── */
        .cta-box {
            background: linear-gradient(135deg, rgba(91, 92, 255, .15), rgba(91, 92, 255, .05));
            border: 1px solid rgba(91, 92, 255, .3);
            border-radius: 16px;
            padding: 32px;
            text-align: center;
            margin: 40px 0;
        }

        .cta-box h3 {
            font-size: 20px;
            font-weight: 700;
            color: #eeeef8;
            margin-bottom: 8px;
        }

        .cta-box p {
            color: #8888a8;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* ── Button ── */
        .btn {
            display: inline-block;
            padding: 12px 28px;
            background: #5b5cff;
            color: #fff;
            border-radius: 99px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: background .2s, transform .15s;
        }

        .btn:hover {
            background: #4a4be0;
            transform: translateY(-1px);
        }

        .btn.green {
            background: #00e5a0;
            color: #07070d;
        }

        .btn.green:hover {
            background: #00cc8e;
        }

        /* ── Comparison table ── */
        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            margin: 24px 0;
        }

        .comparison-table th {
            background: #0f0f1a;
            padding: 12px 16px;
            text-align: left;
            font-size: 13px;
            color: #8888a8;
            border-bottom: 2px solid rgba(255, 255, 255, .1);
        }

        .comparison-table td {
            padding: 12px 16px;
            font-size: 14px;
            color: #eeeef8;
            border-bottom: 1px solid rgba(255, 255, 255, .06);
        }

        .comparison-table tr:hover td {
            background: rgba(255, 255, 255, .02);
        }

        /* ── Badge pills ── */
        .badge-pill {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-pill.green {
            background: rgba(0, 229, 160, .1);
            color: #00e5a0;
        }

        .badge-pill.red {
            background: rgba(255, 107, 107, .1);
            color: #ff6b6b;
        }

        .badge-pill.yellow {
            background: rgba(255, 165, 0, .1);
            color: #ffa500;
        }

        /* ── Divider ── */
        .blog-divider {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, .08);
            margin: 40px 0;
        }

        /* ── Footer ── */
        .blog-footer {
            border-top: 1px solid rgba(255, 255, 255, .08);
            padding: 40px;
            text-align: center;
            color: #8888a8;
            font-size: 14px;
            margin-top: 80px;
        }

        .blog-footer a {
            color: #8888a8;
            text-decoration: none;
            margin: 0 12px;
            transition: color .2s;
        }

        .blog-footer a:hover {
            color: #eeeef8;
        }

        .blog-footer .footer-links {
            margin-top: 12px;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .blog-nav {
                padding: 16px 20px;
            }

            article h1,
            .blog-h1 {
                font-size: 32px;
            }

            article h2 {
                font-size: 22px;
            }

            .cta-box {
                padding: 24px 20px;
            }

            .comparison-table {
                font-size: 13px;
            }

            .comparison-table th,
            .comparison-table td {
                padding: 10px 12px;
            }
        }
    </style>

    @hasSection('extra_head')
    @yield('extra_head')
    @endif
</head>
<body>

    {{-- Navigation --}}
    <nav class="blog-nav">
        <a href="/" class="blog-nav__logo">PDFTash</a>
        <a href="/blog" class="blog-nav__back">&#8592; Blog</a>
    </nav>

    {{-- Page content --}}
    @yield('content')

    {{-- Footer --}}
    <footer class="blog-footer">
        <p>&copy; {{ date('Y') }} PDFTash. Free PDF tools, no signup required.</p>
        <div class="footer-links">
            <a href="/">Home</a>
            <a href="/blog">Blog</a>
        </div>
    </footer>

</body>
</html>
