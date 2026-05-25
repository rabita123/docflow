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
  <p>© 2026 PDFTash — <a href="/">All PDF Tools</a> · <a href="/#pricing">Pricing</a> · <a href="/blog">Blog</a></p>
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

    @auth
    <a href="/#pricing" style="display:block;padding:15px;background:linear-gradient(135deg,#5b5cff,#7475ff);color:#fff;border-radius:12px;text-decoration:none;font-size:16px;font-weight:800;margin-bottom:12px;box-shadow:0 4px 20px rgba(91,92,255,.4);">
      Upgrade to Pro — $9/month →
    </a>
    @else
    <button onclick="closeProModal();showAuthModal()" style="display:block;width:100%;padding:15px;background:linear-gradient(135deg,#5b5cff,#7475ff);color:#fff;border:none;border-radius:12px;font-size:16px;font-weight:800;margin-bottom:12px;box-shadow:0 4px 20px rgba(91,92,255,.4);cursor:pointer;">
      Sign in to Upgrade — $9/month →
    </button>
    @endauth
    <button onclick="closeProModal()" style="background:transparent;color:#44445a;border:none;font-size:13px;cursor:pointer;padding:4px;">
      Continue with free tools
    </button>
  </div>
</div>

{{-- Auth Modal (sign in / register on tool pages) --}}
<div id="auth-modal" style="display:none;position:fixed;inset:0;z-index:10000;background:rgba(0,0,0,.88);backdrop-filter:blur(12px);align-items:center;justify-content:center;padding:20px;">
  <div style="background:#1a1a2e;border:1px solid rgba(255,255,255,.1);border-radius:16px;max-width:400px;width:100%;padding:36px 32px;position:relative;">
    <button onclick="closeAuthModal()" style="position:absolute;top:14px;right:16px;background:transparent;border:none;color:#666;font-size:22px;cursor:pointer;line-height:1;">×</button>

    <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px;">
      <div style="width:32px;height:32px;background:#5b5cff;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:16px;">📄</div>
      <span style="font-size:16px;font-weight:700;color:#fff;">PDFTash</span>
    </div>
    <div style="font-size:22px;font-weight:700;color:#fff;margin-bottom:4px;" id="auth-title">Sign in</div>
    <div style="font-size:13px;color:#888;margin-bottom:24px;" id="auth-sub">Sign in to upgrade to Pro</div>

    {{-- Google --}}
    <a href="/auth/google?next=pricing" style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;padding:11px;background:#2a2a3e;color:#eee;border:1px solid rgba(255,255,255,.12);border-radius:10px;text-decoration:none;font-weight:500;font-size:14px;margin-bottom:20px;box-sizing:border-box;" onmouseover="this.style.background='#33334a'" onmouseout="this.style.background='#2a2a3e'">
      <svg width="18" height="18" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.08 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.18 1.48-4.97 2.31-8.16 2.31-6.26 0-11.57-3.59-13.46-8.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/></svg>
      Continue with Google
    </a>

    <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
      <div style="flex:1;height:1px;background:rgba(255,255,255,.08);"></div>
      <span style="font-size:12px;color:#555;">OR</span>
      <div style="flex:1;height:1px;background:rgba(255,255,255,.08);"></div>
    </div>

    <div style="margin-bottom:14px;">
      <input type="email" id="auth-email" placeholder="Email address" style="width:100%;padding:11px 14px;background:#0f0f1a;border:1px solid rgba(255,255,255,.12);border-radius:10px;color:#eee;font-size:14px;box-sizing:border-box;outline:none;" onfocus="this.style.borderColor='#5b5cff'" onblur="this.style.borderColor='rgba(255,255,255,.12)'">
    </div>
    <div style="margin-bottom:14px;" id="auth-name-wrap" style="display:none;">
      <input type="text" id="auth-name" placeholder="Full name" style="width:100%;padding:11px 14px;background:#0f0f1a;border:1px solid rgba(255,255,255,.12);border-radius:10px;color:#eee;font-size:14px;box-sizing:border-box;outline:none;" onfocus="this.style.borderColor='#5b5cff'" onblur="this.style.borderColor='rgba(255,255,255,.12)'">
    </div>
    <div style="margin-bottom:14px;">
      <input type="password" id="auth-password" placeholder="Password" style="width:100%;padding:11px 14px;background:#0f0f1a;border:1px solid rgba(255,255,255,.12);border-radius:10px;color:#eee;font-size:14px;box-sizing:border-box;outline:none;" onfocus="this.style.borderColor='#5b5cff'" onblur="this.style.borderColor='rgba(255,255,255,.12)'">
    </div>
    <div style="margin-bottom:14px;display:none;" id="auth-confirm-wrap">
      <input type="password" id="auth-confirm" placeholder="Confirm password" style="width:100%;padding:11px 14px;background:#0f0f1a;border:1px solid rgba(255,255,255,.12);border-radius:10px;color:#eee;font-size:14px;box-sizing:border-box;outline:none;" onfocus="this.style.borderColor='#5b5cff'" onblur="this.style.borderColor='rgba(255,255,255,.12)'">
    </div>

    <div id="auth-error" style="color:#ff6b6b;font-size:13px;margin-bottom:10px;text-align:center;display:none;"></div>

    <button id="auth-submit" onclick="submitAuth()" style="width:100%;padding:13px;background:#5b5cff;color:#fff;border:none;border-radius:10px;font-size:15px;font-weight:600;cursor:pointer;margin-bottom:16px;">Sign In</button>

    <div style="text-align:center;font-size:13px;color:#666;" id="auth-toggle">
      Don't have an account? <a href="#" onclick="switchAuthMode(event)" style="color:#5b5cff;text-decoration:none;font-weight:600;">Create account</a>
    </div>
  </div>
</div>

<script>
// ── Pro Modal ──────────────────────────────────────────────────────────────
function showProModal() {
    const m = document.getElementById('pro-modal');
    m.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeProModal() {
    document.getElementById('pro-modal').style.display = 'none';
    document.body.style.overflow = '';
}
document.getElementById('pro-modal').addEventListener('click', function(e) {
    if (e.target === this) closeProModal();
});

// ── Auth Modal ─────────────────────────────────────────────────────────────
let authMode = 'login';

function showAuthModal() {
    authMode = 'login';
    setAuthMode('login');
    const m = document.getElementById('auth-modal');
    m.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeAuthModal() {
    document.getElementById('auth-modal').style.display = 'none';
    document.body.style.overflow = '';
}
function switchAuthMode(e) {
    e.preventDefault();
    authMode = authMode === 'login' ? 'register' : 'login';
    setAuthMode(authMode);
}
function setAuthMode(mode) {
    const isLogin = mode === 'login';
    document.getElementById('auth-title').textContent   = isLogin ? 'Sign in' : 'Create account';
    document.getElementById('auth-sub').textContent     = isLogin ? 'Sign in to upgrade to Pro' : 'Create account to upgrade to Pro';
    document.getElementById('auth-submit').textContent  = isLogin ? 'Sign In' : 'Create Account';
    document.getElementById('auth-name-wrap').style.display    = isLogin ? 'none' : 'block';
    document.getElementById('auth-confirm-wrap').style.display = isLogin ? 'none' : 'block';
    document.getElementById('auth-toggle').innerHTML = isLogin
        ? 'Don\'t have an account? <a href="#" onclick="switchAuthMode(event)" style="color:#5b5cff;text-decoration:none;font-weight:600;">Create account</a>'
        : 'Already have an account? <a href="#" onclick="switchAuthMode(event)" style="color:#5b5cff;text-decoration:none;font-weight:600;">Sign in</a>';
    document.getElementById('auth-error').style.display = 'none';
}
document.getElementById('auth-modal').addEventListener('click', function(e) {
    if (e.target === this) closeAuthModal();
});

async function submitAuth() {
    const email    = document.getElementById('auth-email').value.trim();
    const password = document.getElementById('auth-password').value;
    const csrf     = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const errEl    = document.getElementById('auth-error');
    const btn      = document.getElementById('auth-submit');

    errEl.style.display = 'none';
    if (!email || !password) { showAuthError('Please enter your email and password.'); return; }

    const body = { email, password };

    if (authMode === 'register') {
        const name    = document.getElementById('auth-name').value.trim();
        const confirm = document.getElementById('auth-confirm').value;
        if (!name)              { showAuthError('Please enter your full name.'); return; }
        if (password !== confirm) { showAuthError('Passwords do not match.'); return; }
        body.name = name;
        body.password_confirmation = confirm;
    }

    btn.disabled = true;
    btn.textContent = authMode === 'register' ? 'Creating account…' : 'Signing in…';

    try {
        // Store intended URL so after login user goes to pricing
        const endpoint = authMode === 'register' ? '/auth/register' : '/auth/login';
        const resp = await fetch(endpoint, {
            method: 'POST',
            credentials: 'same-origin',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
            body: JSON.stringify({ ...body, intended: '/#pricing' }),
        });
        const data = await resp.json();
        if (data.success) {
            window.location.href = data.redirect || '/#pricing';
        } else {
            const msg = data.errors ? Object.values(data.errors).flat().join(' ') : (data.message || 'Something went wrong.');
            showAuthError(msg);
            btn.disabled = false;
            btn.textContent = authMode === 'register' ? 'Create Account' : 'Sign In';
        }
    } catch(e) {
        showAuthError('Connection error. Please try again.');
        btn.disabled = false;
        btn.textContent = authMode === 'register' ? 'Create Account' : 'Sign In';
    }
}
function showAuthError(msg) {
    const el = document.getElementById('auth-error');
    el.textContent = msg;
    el.style.display = 'block';
}

// Close on Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') { closeProModal(); closeAuthModal(); }
});
</script>
</body>
</html>