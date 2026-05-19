<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title') — PDFTash</title>
<meta name="description" content="@yield('description')">
@hasSection('keywords')<meta name="keywords" content="@yield('keywords')">@endif
<meta name="robots" content="index, follow">
<meta name="author" content="PDFTash">
<link rel="canonical" href="https://pdftash.com/@yield('slug')">

<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="PDFTash">
<meta property="og:title" content="@yield('title') — PDFTash">
<meta property="og:description" content="@yield('description')">
<meta property="og:url" content="https://pdftash.com/@yield('slug')">
<meta property="og:image" content="https://pdftash.com/og-image.png">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="@yield('title') — PDFTash">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="@yield('title') — PDFTash">
<meta name="twitter:description" content="@yield('description')">
<meta name="twitter:image" content="https://pdftash.com/og-image.png">

@hasSection('schema')@yield('schema')@endif

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:#07070d;color:#fff;min-height:100vh;}
.nav{padding:20px 40px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid rgba(255,255,255,.08);}
.nav-logo{font-size:20px;font-weight:700;color:#5b5cff;text-decoration:none;}
.nav-back{color:#8888a8;text-decoration:none;font-size:14px;}
.nav-back:hover{color:#fff;}
.hero{text-align:center;padding:80px 20px 40px;}
.hero h1{font-size:48px;font-weight:800;margin-bottom:16px;line-height:1.2;}
.hero p{color:#8888a8;font-size:18px;max-width:600px;margin:0 auto 40px;line-height:1.6;}
.badge{display:inline-flex;align-items:center;gap:6px;background:rgba(91,92,255,.1);border:1px solid rgba(91,92,255,.3);color:#5b5cff;padding:6px 14px;border-radius:99px;font-size:13px;font-weight:500;margin-bottom:24px;}
.tool-box{max-width:700px;margin:0 auto 80px;background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:24px;padding:40px;}
.upload-area{border:2px dashed rgba(255,255,255,.15);border-radius:16px;padding:60px 20px;text-align:center;cursor:pointer;transition:all .2s;}
.upload-area:hover{border-color:#5b5cff;background:rgba(91,92,255,.05);}
.upload-icon{font-size:48px;margin-bottom:16px;}
.upload-title{font-size:18px;font-weight:600;margin-bottom:8px;}
.upload-sub{color:#8888a8;font-size:14px;}
.btn{display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border:none;border-radius:99px;font-size:16px;font-weight:600;cursor:pointer;text-decoration:none;margin-top:20px;transition:all .2s;}
.btn:hover{background:#7475ff;transform:translateY(-2px);}
.features{max-width:700px;margin:0 auto 80px;display:grid;grid-template-columns:repeat(3,1fr);gap:16px;padding:0 20px;}
.feature{background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:24px;text-align:center;}
.feature-icon{font-size:32px;margin-bottom:12px;}
.feature-title{font-size:14px;font-weight:600;margin-bottom:6px;}
.feature-desc{font-size:13px;color:#8888a8;line-height:1.5;}
.faq{max-width:700px;margin:0 auto 80px;padding:0 20px;}
.faq h2{font-size:28px;font-weight:700;margin-bottom:32px;text-align:center;}
.faq-item{background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:24px;margin-bottom:12px;}
.faq-item h3{font-size:15px;font-weight:600;margin-bottom:8px;}
.faq-item p{color:#8888a8;font-size:14px;line-height:1.6;}
.footer{text-align:center;padding:40px;border-top:1px solid rgba(255,255,255,.08);color:#8888a8;font-size:14px;}
.footer a{color:#5b5cff;text-decoration:none;}
@media(max-width:768px){
.hero h1{font-size:32px;}
.features{grid-template-columns:1fr;}
.nav{padding:16px 20px;}
}
</style>
</head>
<body>
<nav class="nav">
  <a href="/" class="nav-logo">PDFTash</a>
  <a href="/" class="nav-back">← All Tools</a>
</nav>
@yield('content')
<div class="footer">
  <p>© 2026 PDFTash — <a href="/">All PDF Tools</a> · <a href="/#pricing">Pricing</a></p>
</div>

{{-- Pro Upgrade Modal (shown when AI feature is accessed without Pro plan) --}}
<div id="pro-modal" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.75);backdrop-filter:blur(6px);align-items:center;justify-content:center;">
  <div style="background:#0f0f1a;border:1px solid rgba(91,92,255,.4);border-radius:24px;padding:40px;max-width:460px;width:90%;text-align:center;position:relative;box-shadow:0 0 60px rgba(91,92,255,.2);">
    <button onclick="closeProModal()" style="position:absolute;top:16px;right:20px;background:none;border:none;color:#44445a;font-size:22px;cursor:pointer;line-height:1;">×</button>
    <div style="font-size:52px;margin-bottom:16px;">🔒</div>
    <h2 style="font-size:22px;font-weight:800;margin-bottom:8px;">Pro Feature</h2>
    <p style="color:#8888a8;font-size:15px;line-height:1.7;margin-bottom:28px;">
      AI tools — Chat with PDF, Translate, AI Generator, Form Fill — require a <strong style="color:#eeeef8;">Pro plan</strong>.<br>
      All other PDF tools (compress, merge, split, sign) are <strong style="color:#00e5a0;">always free</strong>.
    </p>

    {{-- What you get with Pro --}}
    <div style="background:#07070d;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:18px;margin-bottom:24px;text-align:left;">
      @foreach([
        ['🤖','Unlimited AI PDF Chat','Ask questions about any PDF'],
        ['🌍','Unlimited PDF Translation','50+ languages supported'],
        ['✨','Unlimited AI PDF Generator','Documents &amp; table statements'],
        ['📋','Unlimited AI Form Fill','Auto-fill any PDF form'],
        ['⚡','Priority processing','Faster AI responses'],
        ['🗜️','Larger file uploads','Up to 200MB vs 10MB free'],
      ] as $f)
      <div style="display:flex;gap:10px;align-items:flex-start;margin-bottom:10px;">
        <span style="font-size:16px;flex-shrink:0;">{{ $f[0] }}</span>
        <div>
          <span style="font-size:13px;font-weight:600;color:#eeeef8;">{{ $f[1] }}</span>
          <span style="font-size:12px;color:#44445a;margin-left:6px;">{{ $f[2] }}</span>
        </div>
      </div>
      @endforeach
    </div>

    <a href="/#pricing" style="display:block;padding:15px;background:linear-gradient(135deg,#5b5cff,#7475ff);color:#fff;border-radius:12px;text-decoration:none;font-size:16px;font-weight:800;margin-bottom:12px;box-shadow:0 4px 20px rgba(91,92,255,.4);">
      Upgrade to Pro — $9/month →
    </a>
    <button onclick="closeProModal()" style="background:transparent;color:#44445a;border:none;font-size:13px;cursor:pointer;padding:4px;">
      Continue with free tools
    </button>
  </div>
</div>

<script>
function showProModal() {
    const m = document.getElementById('pro-modal');
    m.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeProModal() {
    document.getElementById('pro-modal').style.display = 'none';
    document.body.style.overflow = '';
}
// Close on backdrop click
document.getElementById('pro-modal').addEventListener('click', function(e) {
    if (e.target === this) closeProModal();
});
// Close on Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeProModal();
});
</script>
</body>
</html>