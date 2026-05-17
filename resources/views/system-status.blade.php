<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>System Status — PDFTash</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:#07070d;color:#eeeef8;min-height:100vh;padding:40px 20px;}
.container{max-width:680px;margin:0 auto;}
.back{display:inline-flex;align-items:center;gap:6px;color:#8888a8;text-decoration:none;font-size:13px;margin-bottom:32px;transition:color .2s;}
.back:hover{color:#eeeef8;}
.header{margin-bottom:36px;}
.logo{display:flex;align-items:center;gap:10px;margin-bottom:20px;}
.logo-icon{width:36px;height:36px;background:#5b5cff;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;}
.logo-text{font-family:'Plus Jakarta Sans',sans-serif;font-size:18px;font-weight:700;}
h1{font-family:'Plus Jakarta Sans',sans-serif;font-size:28px;font-weight:800;margin-bottom:8px;}
.overall{display:inline-flex;align-items:center;gap:8px;padding:8px 18px;border-radius:99px;font-size:14px;font-weight:600;margin-bottom:8px;}
.overall.ok{background:rgba(0,229,160,.15);color:#00e5a0;border:1px solid rgba(0,229,160,.3);}
.overall.error{background:rgba(255,107,107,.15);color:#ff6b6b;border:1px solid rgba(255,107,107,.3);}
.updated{font-size:12px;color:#44445a;}

.checks{display:flex;flex-direction:column;gap:10px;}
.check{display:flex;align-items:center;justify-content:space-between;background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:14px 18px;}
.check-left{display:flex;align-items:center;gap:12px;}
.check-icon{font-size:20px;width:28px;text-align:center;}
.check-name{font-size:14px;font-weight:600;color:#eeeef8;}
.check-label{font-size:12px;color:#8888a8;margin-top:2px;}
.badge{display:inline-flex;align-items:center;gap:5px;padding:4px 12px;border-radius:99px;font-size:12px;font-weight:600;}
.badge.ok{background:rgba(0,229,160,.15);color:#00e5a0;}
.badge.error{background:rgba(255,107,107,.15);color:#ff6b6b;}
.badge.warning{background:rgba(255,204,68,.15);color:#ffcc44;}
.dot{width:7px;height:7px;border-radius:50%;background:currentColor;}
</style>
</head>
<body>
<div class="container">

  <a href="/" class="back">← Back to PDFTash</a>

  <div class="header">
    <div class="logo">
      <div class="logo-icon">📄</div>
      <span class="logo-text">PDFTash</span>
    </div>
    <h1>System Status</h1>
    <div class="overall {{ $allOk ? 'ok' : 'error' }}">
      <span class="dot"></span>
      {{ $allOk ? 'All systems operational' : 'Some systems need attention' }}
    </div>
    <div class="updated">Last checked: {{ now()->format('D, d M Y H:i:s') }} UTC</div>
  </div>

  <div class="checks">
    @php
    $icons = [
      'PHP'          => '🐘',
      'Laravel'      => '🔴',
      'Database'     => '🗄️',
      'Ghostscript'  => '👻',
      'PDFtk'        => '🔧',
      'ImageMagick'  => '🪄',
      'Poppler'      => '📑',
      'Anthropic AI' => '🤖',
      'Lemon Squeezy'=> '🍋',
      'Storage'      => '💾',
      'Google OAuth' => '🔑',
    ];
    @endphp
    @foreach($checks as $name => $check)
    <div class="check">
      <div class="check-left">
        <span class="check-icon">{{ $icons[$name] ?? '⚙️' }}</span>
        <div>
          <div class="check-name">{{ $name }}</div>
          <div class="check-label">{{ $check['label'] }}</div>
        </div>
      </div>
      <span class="badge {{ $check['status'] }}">
        <span class="dot"></span>
        {{ ucfirst($check['status']) }}
      </span>
    </div>
    @endforeach
  </div>

</div>
</body>
</html>
