<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Successful — PDFTash Pro</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:#07070d;color:#fff;
  display:flex;align-items:center;justify-content:center;min-height:100vh;padding:20px;}

.box{max-width:520px;width:100%;text-align:center;}

.icon-wrap{position:relative;display:inline-block;margin-bottom:24px;}
.icon{font-size:72px;display:block;animation:popIn .6s cubic-bezier(.36,.07,.19,.97);}
.icon-ring{position:absolute;inset:-12px;border-radius:50%;border:3px solid #00e5a0;
  animation:ringPulse 1.2s ease-out forwards;}
@keyframes popIn{0%{transform:scale(0) rotate(-10deg)}70%{transform:scale(1.15) rotate(3deg)}100%{transform:scale(1) rotate(0)}}
@keyframes ringPulse{0%{opacity:1;transform:scale(.8)}100%{opacity:0;transform:scale(1.6)}}

h1{font-size:34px;font-weight:800;margin-bottom:10px;background:linear-gradient(135deg,#00e5a0,#5b5cff);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.subtitle{color:#8888a8;font-size:16px;line-height:1.6;margin-bottom:28px;}

/* Order card */
.order-card{background:#0f0f1a;border:1px solid rgba(0,229,160,.25);border-radius:18px;
  padding:24px;margin-bottom:24px;text-align:left;}
.order-title{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;
  color:#00e5a0;margin-bottom:16px;}
.order-row{display:flex;justify-content:space-between;align-items:center;
  padding:10px 0;border-bottom:1px solid rgba(255,255,255,.06);font-size:14px;}
.order-row:last-child{border-bottom:none;}
.order-label{color:#8888a8;}
.order-value{font-weight:600;color:#eeeef8;}
.order-value.green{color:#00e5a0;}
.order-value.purple{color:#5b5cff;}

/* Features */
.features{background:#0f0f1a;border:1px solid rgba(255,255,255,.07);border-radius:16px;
  padding:20px;margin-bottom:24px;text-align:left;}
.features-title{font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;
  color:#8888a8;margin-bottom:14px;}
.feature{display:flex;align-items:center;gap:10px;padding:7px 0;font-size:14px;color:#eeeef8;}
.feature-check{width:20px;height:20px;background:rgba(0,229,160,.15);border-radius:50%;
  display:flex;align-items:center;justify-content:center;font-size:11px;flex-shrink:0;}

/* Countdown */
.redirect-bar{background:#0f0f1a;border:1px solid rgba(91,92,255,.2);border-radius:12px;
  padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;}
.redirect-text{font-size:13px;color:#8888a8;}
.redirect-count{font-size:22px;font-weight:800;color:#5b5cff;min-width:32px;text-align:center;}
.progress-track{height:3px;background:rgba(255,255,255,.08);border-radius:99px;margin-top:8px;overflow:hidden;}
.progress-fill{height:100%;background:#5b5cff;border-radius:99px;transition:width 1s linear;}

.btn{display:inline-block;padding:14px 36px;background:linear-gradient(135deg,#5b5cff,#7475ff);
  color:#fff;border-radius:99px;text-decoration:none;font-weight:700;font-size:15px;
  box-shadow:0 4px 20px rgba(91,92,255,.4);transition:all .2s;}
.btn:hover{transform:translateY(-2px);box-shadow:0 6px 28px rgba(91,92,255,.5);}

/* Confetti canvas */
canvas{position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:99;}
</style>
</head>
<body>
<canvas id="confetti"></canvas>

<div class="box">
  <div class="icon-wrap">
    <span class="icon">🎉</span>
    <div class="icon-ring"></div>
  </div>

  <h1>You're now Pro!</h1>
  <p class="subtitle">
    Payment confirmed. Your account has been upgraded to <strong style="color:#fff">PDFTash Pro</strong>.<br>
    All AI tools are now unlocked.
  </p>

  {{-- Order summary --}}
  <div class="order-card">
    <div class="order-title">📋 Order Confirmation</div>
    <div class="order-row">
      <span class="order-label">Plan</span>
      <span class="order-value purple">PDFTash Pro</span>
    </div>
    <div class="order-row">
      <span class="order-label">Account</span>
      <span class="order-value">{{ Auth::check() ? Auth::user()->email : 'Your account' }}</span>
    </div>
    <div class="order-row">
      <span class="order-label">Amount</span>
      <span class="order-value">$9.00 / month</span>
    </div>
    <div class="order-row">
      <span class="order-label">Status</span>
      <span class="order-value green">✓ Active</span>
    </div>
    <div class="order-row">
      <span class="order-label">Next billing</span>
      <span class="order-value">{{ now()->addMonth()->format('M d, Y') }}</span>
    </div>
  </div>

  {{-- What's unlocked --}}
  <div class="features">
    <div class="features-title">What's unlocked</div>
    @foreach([
      ['🤖','Unlimited AI PDF Chat'],
      ['🌍','Unlimited PDF Translation (50+ languages)'],
      ['✨','AI PDF Generator — documents & statements'],
      ['📋','AI Form Fill — auto-fill any PDF form'],
      ['📝','AI PDF Summarizer'],
      ['🚫','Watermark Remover'],
      ['🗜️','Large file uploads up to 200MB'],
      ['⚡','Priority AI processing'],
    ] as $f)
    <div class="feature">
      <div class="feature-check">✓</div>
      {{ $f[0] }} {{ $f[1] }}
    </div>
    @endforeach
  </div>

  {{-- Countdown --}}
  <div class="redirect-bar">
    <div>
      <div class="redirect-text">Redirecting you to your dashboard…</div>
      <div class="progress-track">
        <div class="progress-fill" id="progress" style="width:100%"></div>
      </div>
    </div>
    <div class="redirect-count" id="count">5</div>
  </div>

  <a href="/dashboard" class="btn">Go to Dashboard →</a>
</div>

<script>
// ── Countdown redirect ────────────────────────────────────────────────────
let secs = 5;
const countEl    = document.getElementById('count');
const progressEl = document.getElementById('progress');

const timer = setInterval(() => {
    secs--;
    countEl.textContent = secs;
    progressEl.style.width = (secs / 5 * 100) + '%';
    if (secs <= 0) {
        clearInterval(timer);
        window.location.href = '/dashboard';
    }
}, 1000);

// ── Confetti ──────────────────────────────────────────────────────────────
const canvas = document.getElementById('confetti');
const ctx    = canvas.getContext('2d');
canvas.width  = window.innerWidth;
canvas.height = window.innerHeight;

const colors  = ['#5b5cff','#00e5a0','#ffcc44','#ff6b6b','#fff','#9898ff'];
const pieces  = Array.from({length: 120}, () => ({
    x: Math.random() * canvas.width,
    y: Math.random() * canvas.height - canvas.height,
    w: Math.random() * 10 + 5,
    h: Math.random() * 6 + 3,
    color: colors[Math.floor(Math.random() * colors.length)],
    rot: Math.random() * 360,
    vx: (Math.random() - .5) * 3,
    vy: Math.random() * 4 + 2,
    vr: (Math.random() - .5) * 6,
}));

let frame = 0;
function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    pieces.forEach(p => {
        ctx.save();
        ctx.translate(p.x, p.y);
        ctx.rotate(p.rot * Math.PI / 180);
        ctx.fillStyle = p.color;
        ctx.globalAlpha = .85;
        ctx.fillRect(-p.w/2, -p.h/2, p.w, p.h);
        ctx.restore();
        p.x  += p.vx;
        p.y  += p.vy;
        p.rot += p.vr;
        if (p.y > canvas.height) { p.y = -20; p.x = Math.random() * canvas.width; }
    });
    frame++;
    if (frame < 300) requestAnimationFrame(draw); // stop after ~5s
    else ctx.clearRect(0, 0, canvas.width, canvas.height);
}
draw();
</script>
</body>
</html>
