<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title') — PDFTash</title>
<meta name="description" content="@yield('description')">
<link rel="canonical" href="https://pdftash.com/@yield('slug')">
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
</body>
</html>