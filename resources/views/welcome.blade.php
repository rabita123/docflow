<!DOCTYPE html>
<html lang="en">
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-BX49JDS3BB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-BX49JDS3BB');
</script>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="google-site-verification" content="npJr20F8kzU83RI-uS84JNdqH6ndTNVaUlrK5m7dNq8" />
<!-- SEO Meta Tags -->
<title>PDFTash — Free PDF Tools Online | Compress, Merge, AI Chat</title>
<meta name="description" content="Free online PDF tools — compress, merge, split, translate and chat with PDF using AI. No signup needed. 20+ tools. Fast and secure.">
<meta name="keywords" content="compress pdf, merge pdf, split pdf, pdf translator, chat with pdf, pdf to image, sejda alternative, free pdf tools online">
<meta name="author" content="PDFTash">
<meta name="robots" content="index, follow">

<!-- Open Graph (Facebook, LinkedIn) -->
<meta property="og:type" content="website">
<meta property="og:title" content="PDFTash — Free PDF Tools with AI">
<meta property="og:description" content="20+ free PDF tools — compress, merge, translate to Bengali, sign and chat with AI. No signup needed.">
<meta property="og:url" content="https://pdftash.com">
<meta property="og:site_name" content="PDFTash">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="PDFTash — Free PDF Tools with AI">
<meta name="twitter:description" content="20+ free PDF tools with AI. Compress, merge, translate and chat with your PDFs.">

<!-- Canonical -->
<link rel="canonical" href="https://pdftash.com">


<title>PDFTash — Advanced PDF Platform</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#07070d;--bg2:#0f0f1a;--bg3:#16162a;--bg4:#1e1e33;--bg5:#26263d;
  --border:rgba(255,255,255,0.06);--border2:rgba(255,255,255,0.11);
  --accent:#5b5cff;--accent-h:#7475ff;--accent2:#00e5a0;--accent3:#ff6b6b;--accent4:#ffcc44;
  --text:#eeeef8;--text2:#8888a8;--text3:#44445a;
  --r:14px;--r-sm:9px;--r-lg:20px;--r-xl:28px;
}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;overflow-x:hidden;}
::-webkit-scrollbar{width:5px;height:5px;}
::-webkit-scrollbar-track{background:var(--bg2);}
::-webkit-scrollbar-thumb{background:var(--bg5);border-radius:99px;}

/* NAV */
nav{position:fixed;top:0;left:0;right:0;z-index:100;display:flex;align-items:center;
  justify-content:space-between;padding:14px 40px;
  background:rgba(7,7,13,0.85);backdrop-filter:blur(24px);border-bottom:1px solid var(--border);}
.nav-logo{font-family:'Plus Jakarta Sans',sans-serif;font-size:20px;font-weight:800;
  background:linear-gradient(135deg,#5b5cff,#00e5a0);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.nav-links{display:flex;gap:28px;}
.nav-links a{color:var(--text2);font-size:14px;font-weight:500;text-decoration:none;transition:color .2s;}
.nav-links a:hover{color:var(--text);}
.nav-right{display:flex;gap:10px;}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:6px;
  padding:9px 20px;border-radius:99px;font-size:13.5px;font-weight:600;
  cursor:pointer;border:none;transition:all .2s;font-family:'Inter',sans-serif;}
.btn-ghost{background:transparent;color:var(--text2);border:1px solid var(--border2);}
.btn-ghost:hover{border-color:var(--accent);color:var(--accent);}
.btn-primary{background:var(--accent);color:#fff;}
.btn-primary:hover{background:var(--accent-h);transform:translateY(-1px);}
.btn-lg{padding:13px 32px;font-size:15px;}
.btn-block{width:100%;}
.btn:disabled{opacity:.5;cursor:not-allowed;transform:none!important;}

/* HERO */
#hero{min-height:100vh;display:flex;flex-direction:column;align-items:center;
  justify-content:center;text-align:center;padding:100px 24px 60px;position:relative;overflow:hidden;}
.hero-bg{position:absolute;inset:0;z-index:0;
  background:radial-gradient(ellipse 900px 700px at 50% -10%,rgba(91,92,255,.13) 0%,transparent 70%),
    radial-gradient(ellipse 500px 500px at 85% 90%,rgba(0,229,160,.08) 0%,transparent 60%);}
.hero-grid{position:absolute;inset:0;
  background-image:linear-gradient(rgba(255,255,255,.02) 1px,transparent 1px),
    linear-gradient(90deg,rgba(255,255,255,.02) 1px,transparent 1px);
  background-size:50px 50px;mask-image:radial-gradient(ellipse at center,black 30%,transparent 80%);}
.hero-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(91,92,255,.1);
  border:1px solid rgba(91,92,255,.25);border-radius:99px;padding:6px 16px;font-size:13px;
  color:#9898ff;margin-bottom:28px;position:relative;z-index:1;animation:fadeUp .6s ease both;}
.badge-dot{width:7px;height:7px;border-radius:50%;background:var(--accent2);animation:pulse 2s infinite;}
@keyframes pulse{0%,100%{transform:scale(1);opacity:1}50%{transform:scale(1.4);opacity:.6}}
h1{font-family:'Plus Jakarta Sans',sans-serif;font-size:clamp(38px,7vw,80px);font-weight:800;
  line-height:1.04;letter-spacing:-2.5px;position:relative;z-index:1;animation:fadeUp .6s .08s ease both;}
.h1-grad{background:linear-gradient(135deg,#5b5cff 0%,#00e5a0 45%,#ffcc44 100%);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.hero-sub{margin-top:22px;font-size:18px;color:var(--text2);max-width:540px;line-height:1.65;
  position:relative;z-index:1;animation:fadeUp .6s .16s ease both;}
.hero-cta{display:flex;gap:12px;margin-top:36px;position:relative;z-index:1;
  animation:fadeUp .6s .24s ease both;flex-wrap:wrap;justify-content:center;}
.hero-stats{display:flex;gap:48px;margin-top:56px;position:relative;z-index:1;
  animation:fadeUp .6s .32s ease both;flex-wrap:wrap;justify-content:center;}
.stat-n{font-family:'Plus Jakarta Sans',sans-serif;font-size:30px;font-weight:800;}
.stat-l{font-size:12px;color:var(--text3);margin-top:2px;text-transform:uppercase;letter-spacing:.04em;}
@keyframes fadeUp{from{opacity:0;transform:translateY(22px)}to{opacity:1;transform:translateY(0)}}

/* DROP ZONE */
#drop-section{padding:0 24px 72px;display:flex;justify-content:center;}
#dropzone{max-width:700px;width:100%;background:var(--bg2);border:2px dashed var(--border2);
  border-radius:var(--r-xl);padding:52px 36px;text-align:center;cursor:pointer;transition:all .3s;
  position:relative;overflow:hidden;}
#dropzone:hover,#dropzone.drag{border-color:var(--accent);background:rgba(91,92,255,.04);}
.dz-icon{width:68px;height:68px;margin:0 auto 18px;
  background:linear-gradient(135deg,rgba(91,92,255,.2),rgba(0,229,160,.12));
  border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:30px;}
.dz-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:20px;font-weight:700;margin-bottom:8px;}
.dz-sub{color:var(--text2);font-size:14px;line-height:1.6;}
.dz-btn{display:inline-block;margin-top:20px;padding:11px 28px;background:var(--accent);
  color:#fff;border-radius:99px;font-size:14px;font-weight:600;cursor:pointer;border:none;
  transition:all .2s;font-family:'Inter',sans-serif;}
.dz-btn:hover{background:var(--accent-h);transform:translateY(-1px);}
.dz-formats{margin-top:14px;font-size:12px;color:var(--text3);}
.dz-info{margin-top:14px;padding:10px 16px;background:rgba(0,229,160,.08);
  border:1px solid rgba(0,229,160,.2);border-radius:var(--r);font-size:13px;
  color:var(--accent2);display:none;}
#file-input{display:none;}

/* TOOLS */
.section{padding:72px 24px;max-width:1160px;margin:0 auto;}
.sec-tag{font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--accent);margin-bottom:10px;}
.sec-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:clamp(26px,4vw,42px);font-weight:800;
  letter-spacing:-1px;line-height:1.1;margin-bottom:12px;}
.sec-sub{color:var(--text2);font-size:16px;max-width:480px;line-height:1.65;}
.sec-header{text-align:center;margin-bottom:52px;}
.sec-header .sec-sub{margin:0 auto;}

.tool-tabs{display:flex;gap:8px;margin-bottom:32px;flex-wrap:wrap;}
.ttab{padding:8px 18px;border-radius:99px;font-size:13px;font-weight:600;cursor:pointer;
  border:1px solid var(--border2);background:transparent;color:var(--text2);transition:all .2s;
  font-family:'Inter',sans-serif;}
.ttab.active{background:var(--accent);color:#fff;border-color:var(--accent);}
.ttab:hover:not(.active){border-color:var(--accent);color:var(--accent);}

.tools-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(185px,1fr));gap:12px;}
.tc{background:var(--bg2);border:1px solid var(--border);border-radius:var(--r);
  padding:22px 18px;cursor:pointer;transition:all .25s;position:relative;overflow:hidden;}
.tc::before{content:'';position:absolute;inset:0;opacity:0;transition:opacity .25s;}
.tc[data-c="ai"]::before{background:radial-gradient(circle at 0 0,rgba(91,92,255,.1),transparent 60%);}
.tc[data-c="edit"]::before{background:radial-gradient(circle at 0 0,rgba(0,229,160,.09),transparent 60%);}
.tc[data-c="convert"]::before{background:radial-gradient(circle at 0 0,rgba(255,204,68,.09),transparent 60%);}
.tc[data-c="organize"]::before{background:radial-gradient(circle at 0 0,rgba(132,204,255,.09),transparent 60%);}
.tc[data-c="security"]::before{background:radial-gradient(circle at 0 0,rgba(255,107,107,.09),transparent 60%);}
.tc:hover{border-color:var(--border2);transform:translateY(-3px);box-shadow:0 12px 32px rgba(0,0,0,.3);}
.tc:hover::before{opacity:1;}
.tc-icon{font-size:26px;margin-bottom:12px;}
.tc-name{font-family:'Plus Jakarta Sans',sans-serif;font-size:13.5px;font-weight:700;margin-bottom:4px;}
.tc-desc{font-size:12px;color:var(--text2);line-height:1.5;}
.tc-badge{display:inline-block;font-size:10px;font-weight:700;padding:2px 7px;border-radius:99px;margin-top:8px;}
.bai{background:rgba(91,92,255,.15);color:#9898ff;}
.bnew{background:rgba(0,229,160,.15);color:#00e5a0;}
.bhot{background:rgba(255,107,107,.15);color:#ff8f8f;}
.bfree{background:rgba(255,204,68,.15);color:#ffcc44;}

/* PANEL */
#panel-overlay{position:fixed;inset:0;z-index:200;background:rgba(0,0,0,.82);
  backdrop-filter:blur(10px);display:none;align-items:center;justify-content:center;padding:20px;}
#panel-overlay.open{display:flex;}
#panel-box{background:var(--bg2);border:1px solid var(--border2);border-radius:var(--r-xl);
  width:100%;max-width:640px;max-height:90vh;overflow-y:auto;padding:36px;
  position:relative;animation:slideUp .28s ease;}
@keyframes slideUp{from{opacity:0;transform:translateY(18px)}to{opacity:1;transform:translateY(0)}}
#panel-close{position:absolute;top:18px;right:18px;width:34px;height:34px;border-radius:50%;
  background:var(--bg4);border:1px solid var(--border);color:var(--text2);
  font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;}
#panel-close:hover{background:var(--bg5);color:var(--text);}
.panel-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:21px;font-weight:700;margin-bottom:5px;}
.panel-sub{color:var(--text2);font-size:14px;margin-bottom:22px;line-height:1.55;}

.fgroup{margin-bottom:16px;}
.flabel{font-size:12px;font-weight:600;color:var(--text2);margin-bottom:6px;display:block;letter-spacing:.03em;}
.fselect,.finput,.ftextarea{width:100%;padding:11px 14px;background:var(--bg3);
  border:1px solid var(--border2);border-radius:var(--r-sm);color:var(--text);
  font-family:'Inter',sans-serif;font-size:14px;transition:border-color .2s;}
.fselect:focus,.finput:focus,.ftextarea:focus{outline:none;border-color:var(--accent);}
.ftextarea{resize:vertical;min-height:80px;}

.panel-upload{border:2px dashed var(--border2);border-radius:var(--r);padding:30px;
  text-align:center;cursor:pointer;transition:all .2s;margin-bottom:16px;}
.panel-upload:hover{border-color:var(--accent);background:rgba(91,92,255,.04);}
.pu-icon{font-size:28px;margin-bottom:8px;}
.pu-text{font-size:13px;color:var(--text2);}
.pu-name{font-size:13px;color:var(--accent2);margin-top:6px;font-weight:500;}

.prog-wrap{margin-top:14px;display:none;}
.prog-label{font-size:12px;color:var(--text2);margin-bottom:6px;display:flex;justify-content:space-between;}
.prog-bar{background:var(--bg4);border-radius:99px;height:6px;overflow:hidden;}
.prog-fill{height:6px;border-radius:99px;width:0%;
  background:linear-gradient(90deg,var(--accent),var(--accent2));transition:width .25s;}
.result-box{margin-top:14px;padding:16px;background:rgba(0,229,160,.07);
  border:1px solid rgba(0,229,160,.2);border-radius:var(--r);font-size:13px;
  color:var(--accent2);line-height:1.65;display:none;}
.result-box.error{background:rgba(255,107,107,.07);border-color:rgba(255,107,107,.2);color:var(--accent3);}
.result-dload{display:inline-flex;align-items:center;gap:6px;margin-top:10px;
  background:var(--accent2);color:#000;padding:9px 18px;border-radius:99px;
  font-size:13px;font-weight:700;cursor:pointer;border:none;font-family:'Inter',sans-serif;}

/* CHAT */
.chat-msgs{background:var(--bg4);border-radius:var(--r);padding:14px;
  min-height:160px;max-height:240px;overflow-y:auto;margin-bottom:10px;
  display:flex;flex-direction:column;gap:8px;}
.cmsg{display:flex;gap:7px;align-items:flex-start;}
.cav{width:27px;height:27px;border-radius:8px;flex-shrink:0;
  display:flex;align-items:center;justify-content:center;font-size:13px;}
.cav-u{background:rgba(91,92,255,.2);}
.cav-a{background:rgba(0,229,160,.2);}
.cbubble{font-size:13px;color:var(--text);line-height:1.5;padding-top:4px;}
.typing span{display:inline-block;width:6px;height:6px;background:var(--text3);
  border-radius:50%;animation:bounce .8s infinite;margin-right:2px;}
.typing span:nth-child(2){animation-delay:.15s;}
.typing span:nth-child(3){animation-delay:.3s;}
@keyframes bounce{0%,80%,100%{transform:translateY(0)}40%{transform:translateY(-6px)}}
.chat-irow{display:flex;gap:8px;}
.chat-inp{flex:1;padding:10px 14px;background:var(--bg3);border:1px solid var(--border2);
  border-radius:var(--r-sm);color:var(--text);font-family:'Inter',sans-serif;font-size:14px;}
.chat-inp:focus{outline:none;border-color:var(--accent);}
.chat-send{padding:10px 18px;background:var(--accent);color:#fff;border:none;
  border-radius:var(--r-sm);font-size:13px;font-weight:600;cursor:pointer;
  font-family:'Inter',sans-serif;transition:background .2s;}
.chat-send:hover{background:var(--accent-h);}

/* PRICING */
.pricing-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:14px;margin-top:44px;}
.price-card{background:var(--bg2);border:1px solid var(--border);border-radius:var(--r-lg);padding:28px 24px;position:relative;}
.price-card.feat{border-color:var(--accent);background:var(--bg3);box-shadow:0 0 40px rgba(91,92,255,.15);}
.price-card.feat::before{content:'Most Popular';position:absolute;top:-11px;left:50%;
  transform:translateX(-50%);background:var(--accent);color:#fff;font-size:11px;font-weight:700;
  padding:3px 14px;border-radius:99px;}
.pname{font-family:'Plus Jakarta Sans',sans-serif;font-size:15px;font-weight:700;margin-bottom:6px;}
.pamount{font-family:'Plus Jakarta Sans',sans-serif;font-size:40px;font-weight:800;line-height:1;}
.pamount sub{font-size:14px;font-weight:400;color:var(--text2);}
.pdesc{color:var(--text2);font-size:13px;margin:10px 0 16px;}
.phr{border:none;border-top:1px solid var(--border);margin-bottom:16px;}
.pfeats{list-style:none;display:flex;flex-direction:column;gap:9px;}
.pfeats li{font-size:13px;color:var(--text2);display:flex;gap:7px;align-items:flex-start;line-height:1.4;}
.pfeats li::before{content:'✓';color:var(--accent2);font-weight:700;flex-shrink:0;}
.pfeats li.pno{color:var(--text3);}
.pfeats li.pno::before{content:'✕';color:var(--text3);}
.pbtn{width:100%;margin-top:24px;padding:12px;border-radius:99px;font-size:13.5px;
  font-weight:600;cursor:pointer;border:none;font-family:'Inter',sans-serif;transition:all .2s;}
.pbtn-out{background:transparent;color:var(--text);border:1px solid var(--border2);}
.pbtn-out:hover{border-color:var(--accent);color:var(--accent);}
.pbtn-fill{background:var(--accent);color:#fff;}
.pbtn-fill:hover{background:var(--accent-h);transform:translateY(-1px);}

/* TOAST */
#toast{position:fixed;bottom:28px;right:28px;z-index:999;background:var(--bg3);
  border:1px solid var(--border2);border-radius:var(--r);padding:13px 18px;font-size:14px;
  color:var(--text);display:flex;align-items:center;gap:9px;
  transform:translateY(70px);opacity:0;transition:all .3s;pointer-events:none;max-width:340px;}
#toast.show{transform:translateY(0);opacity:1;}

/* FOOTER */
footer{border-top:1px solid var(--border);padding:56px 24px 36px;text-align:center;}
.foot-logo{font-family:'Plus Jakarta Sans',sans-serif;font-size:22px;font-weight:800;margin-bottom:14px;
  background:linear-gradient(135deg,#5b5cff,#00e5a0);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.foot-links{display:flex;gap:28px;justify-content:center;flex-wrap:wrap;margin-bottom:28px;}
.foot-links a{color:var(--text2);font-size:14px;text-decoration:none;transition:color .2s;}
.foot-links a:hover{color:var(--text);}
.foot-copy{color:var(--text3);font-size:13px;}

@media(max-width:768px){
  nav{padding:12px 20px;}
  .nav-links{display:none;}
  h1{letter-spacing:-1.5px;}
  .hero-stats{gap:28px;}
}
</style>
</head>
<body>

<nav>
  <div class="nav-logo">PDFTash</div>
  <div class="nav-links">
    <a href="#tools">Tools</a>
    <a href="#pricing">Pricing</a>
  </div>
  <div class="nav-right">
    @auth
    <div style="display:flex;align-items:center;gap:10px;">
        <a href="/dashboard" style="display:flex;align-items:center;gap:8px;text-decoration:none;padding:6px 14px;border-radius:99px;border:1px solid rgba(255,255,255,.15);transition:background .2s;" onmouseover="this.style.background='rgba(255,255,255,.07)'" onmouseout="this.style.background='transparent'">
            @if(auth()->user()->avatar)
            <img src="{{ auth()->user()->avatar }}" style="width:24px;height:24px;border-radius:50%;" alt="">
            @endif
            <span style="font-size:13px;color:#fff;font-weight:500;">{{ explode(' ', auth()->user()->name)[0] }}</span>
            @if(auth()->user()->plan === 'pro')
                <span style="background:#5b5cff;color:#fff;font-size:10px;padding:1px 6px;border-radius:99px;font-weight:700;">PRO</span>
            @endif
        </a>
        <form method="POST" action="/logout" style="margin:0;">
            @csrf
            <button type="submit" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:7px 14px;border-radius:99px;cursor:pointer;font-size:13px;">
                Logout
            </button>
        </form>
    </div>
    @else
    <button type="button" class="btn btn-ghost" onclick="openLoginModal()">Sign in</button>
    @endauth
    <button class="btn btn-primary" onclick="document.getElementById('drop-section').scrollIntoView({behavior:'smooth'})">Start Free →</button>
  </div>
</nav>

<section id="hero">
  <div class="hero-bg"></div>
  <div class="hero-grid"></div>
  <div class="hero-badge"><div class="badge-dot"></div>Advanced PDF Platform — AI Powered</div>
  <h1>Your PDFs.<br><span class="h1-grad">Supercharged.</span></h1>
  <p class="hero-sub">Compress, merge, split, translate and sign PDFs in seconds. 20+ free tools with built-in AI — no signup needed.</p>
  <div class="hero-cta">
    <button class="btn btn-primary btn-lg" onclick="document.getElementById('drop-section').scrollIntoView({behavior:'smooth'})">Upload PDF Free →</button>
    <button class="btn btn-ghost btn-lg" onclick="openTool('chat')">Try AI Chat</button>
  </div>
  <div class="hero-stats">
    <div class="stat"><div class="stat-n">20+</div><div class="stat-l">PDF Tools</div></div>
    <div class="stat"><div class="stat-n">AI</div><div class="stat-l">Powered</div></div>
    <div class="stat"><div class="stat-n">Free</div><div class="stat-l">To Start</div></div>
    <div class="stat"><div class="stat-n">Fast</div><div class="stat-l">Laravel Backend</div></div>
  </div>
</section>

<div id="drop-section" style="padding:0 24px 72px;display:flex;justify-content:center;">
  <div id="dropzone" onclick="document.getElementById('file-input').click()">
    <div class="dz-icon">📄</div>
    <div class="dz-title">Drop your PDF here</div>
    <div class="dz-sub">Drag & drop or click to browse.<br>Files deleted after 2 hours.</div>
    <button class="dz-btn" onclick="event.stopPropagation();document.getElementById('file-input').click()">Choose File</button>
    <div class="dz-formats">PDF · Word · JPG · PNG · Max 50MB</div>
    <div class="dz-info" id="dz-info"></div>
    <input type="file" id="file-input" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" onchange="handleGlobalFile(this)">
  </div>
</div>

<section class="section" id="tools">
  <div class="sec-header">
    <div class="sec-tag">All Tools</div>
    <div class="sec-title">Everything for PDF work</div>
    <div class="sec-sub">20+ tools — free to start, powerful on Pro.</div>
  </div>
  <div class="tool-tabs">
    <button class="ttab active" onclick="filterTools('all',this)">All</button>
    <button class="ttab" onclick="filterTools('ai',this)">🤖 AI</button>
    <button class="ttab" onclick="filterTools('edit',this)">✏️ Edit</button>
    <button class="ttab" onclick="filterTools('convert',this)">🔄 Convert</button>
    <button class="ttab" onclick="filterTools('organize',this)">📂 Organize</button>
    <button class="ttab" onclick="filterTools('security',this)">🔒 Security</button>
  </div>
  <div class="tools-grid" id="tools-grid">
    <div class="tc" data-c="ai" onclick="openTool('chat')"><div class="tc-icon">💬</div><div class="tc-name">Chat with PDF</div><div class="tc-desc">Ask questions, get instant answers</div><span class="tc-badge bai">AI</span></div>
    <div class="tc" data-c="ai" onclick="openTool('summarize')"><div class="tc-icon">📝</div><div class="tc-name">AI Summarizer</div><div class="tc-desc">Concise summary of any PDF</div><span class="tc-badge bai">AI</span></div>
    <div class="tc" data-c="ai" onclick="openTool('translate')"><div class="tc-icon">🌐</div><div class="tc-name">PDF Translator</div><div class="tc-desc">Translate to 12+ languages</div><span class="tc-badge bnew">NEW</span></div>
    <div class="tc" data-c="ai" onclick="openTool('extract-data')"><div class="tc-icon">📊</div><div class="tc-name">Data Extractor</div><div class="tc-desc">Extract invoices & tables to JSON</div><span class="tc-badge bai">AI</span></div>
    <div class="tc" data-c="organize" onclick="openTool('compress')"><div class="tc-icon">🗜️</div><div class="tc-name">Compress PDF</div><div class="tc-desc">Reduce size, keep quality</div><span class="tc-badge bhot">HOT</span></div>
    <div class="tc" data-c="organize" onclick="openTool('merge')"><div class="tc-icon">🔗</div><div class="tc-name">Merge PDFs</div><div class="tc-desc">Combine multiple PDFs into one</div><span class="tc-badge bfree">FREE</span></div>
    <div class="tc" data-c="organize" onclick="openTool('split')"><div class="tc-icon">✂️</div><div class="tc-name">Split PDF</div><div class="tc-desc">Split by pages, range, or half</div><span class="tc-badge bfree">FREE</span></div>
    <div class="tc" data-c="organize" onclick="openTool('delete-pages')"><div class="tc-icon">🗑️</div><div class="tc-name">Delete Pages</div><div class="tc-desc">Remove specific pages</div><span class="tc-badge bfree">FREE</span></div>
    <div class="tc" data-c="organize" onclick="openTool('reorder')"><div class="tc-icon">📋</div><div class="tc-name">Reorder Pages</div><div class="tc-desc">Change page order</div><span class="tc-badge bfree">FREE</span></div>
    <div class="tc" data-c="edit" onclick="openTool('watermark')"><div class="tc-icon">💧</div><div class="tc-name">Watermark</div><div class="tc-desc">Add text watermark to all pages</div><span class="tc-badge bfree">FREE</span></div>
    <div class="tc" data-c="edit" onclick="openTool('page-numbers')"><div class="tc-icon">🔢</div><div class="tc-name">Page Numbers</div><div class="tc-desc">Add numbered pages to PDF</div><span class="tc-badge bfree">FREE</span></div>
    <div class="tc" data-c="edit" onclick="openTool('rotate')"><div class="tc-icon">🔄</div><div class="tc-name">Rotate Pages</div><div class="tc-desc">Rotate PDF pages permanently</div><span class="tc-badge bfree">FREE</span></div>
    <div class="tc" data-c="convert" onclick="openTool('pdf-to-images')"><div class="tc-icon">🖼️</div><div class="tc-name">PDF to Images</div><div class="tc-desc">Convert pages to JPG / PNG</div><span class="tc-badge bfree">FREE</span></div>
    <div class="tc" data-c="convert" onclick="openTool('images-to-pdf')"><div class="tc-icon">📄</div><div class="tc-name">Images to PDF</div><div class="tc-desc">Combine images into one PDF</div><span class="tc-badge bfree">FREE</span></div>
    <div class="tc" data-c="convert" onclick="openTool('extract-text')"><div class="tc-icon">📃</div><div class="tc-name">Extract Text</div><div class="tc-desc">Pull all text out as .txt file</div><span class="tc-badge bfree">FREE</span></div>
    <div class="tc" data-c="convert" onclick="openTool('grayscale')"><div class="tc-icon">⚫</div><div class="tc-name">Grayscale</div><div class="tc-desc">Convert colors to black & white</div><span class="tc-badge bfree">FREE</span></div>
    <div class="tc" data-c="security" onclick="openTool('protect')"><div class="tc-icon">🔐</div><div class="tc-name">Protect PDF</div><div class="tc-desc">Add AES password encryption</div><span class="tc-badge bfree">FREE</span></div>
    <div class="tc" data-c="security" onclick="openTool('unlock')"><div class="tc-icon">🔓</div><div class="tc-name">Unlock PDF</div><div class="tc-desc">Remove password from PDF</div><span class="tc-badge bfree">FREE</span></div>
    <div class="tc" data-c="security" onclick="openTool('info')"><div class="tc-icon">ℹ️</div><div class="tc-name">PDF Info</div><div class="tc-desc">View metadata and properties</div><span class="tc-badge bfree">FREE</span></div>
    <div class="tc" data-c="edit" onclick="openTool('sign')">
      <div class="tc-icon">✍️</div>
      <div class="tc-name">eSign PDF</div>
      <div class="tc-desc">Draw, type or upload signature</div>
      <span class="tc-badge bnew">NEW</span>
    </div>
  </div>
</section>

<section class="section" id="pricing">
  <div class="sec-header">
    <div class="sec-tag">Pricing</div>
    <div class="sec-title">Simple, transparent pricing</div>
    <div class="sec-sub">Start free. No credit card needed.</div>
  </div>

  <div class="pricing-grid" style="max-width:700px;margin:44px auto 0;grid-template-columns:1fr 1fr;">
    <div class="price-card">
      <div class="pname">Free</div>
      <div class="pamount">$0<sub>/mo</sub></div>
      <div class="pdesc">For occasional use</div>
      <hr class="phr">
      <ul class="pfeats">
        <li>Compress / Merge / Split — <strong style="color:var(--text)">3/day</strong></li>
        <li>AI Chat — <strong style="color:var(--text)">1/day, 500 words</strong></li>
        <li>AI Translate — <strong style="color:var(--text)">1/day, 500 words</strong></li>
        <li>AI Summarize — <strong style="color:var(--text)">1/day</strong></li>
        <li>File size — <strong style="color:var(--text)">10MB</strong></li>
        <li class="pno">History</li>
      </ul>
      <button class="pbtn pbtn-out" onclick="document.getElementById('drop-section').scrollIntoView({behavior:'smooth'})">Start Free</button>
    </div>
    <div class="price-card feat">
      <div class="pname">Pro</div>
      <div class="pamount">$9<sub>/mo</sub></div>
      <div class="pdesc">For power users</div>
      <hr class="phr">
      <ul class="pfeats">
        <li>Compress / Merge / Split — <strong style="color:var(--text)">Unlimited</strong></li>
        <li>AI Chat — <strong style="color:var(--text)">Unlimited</strong></li>
        <li>AI Translate — <strong style="color:var(--text)">Unlimited</strong></li>
        <li>AI Summarize — <strong style="color:var(--text)">Unlimited</strong></li>
        <li>File size — <strong style="color:var(--text)">200MB</strong></li>
        <li>History ✅</li>
      </ul>
      <button type="button" class="pbtn pbtn-fill" onclick="upgradeToPro()">Get Pro →</button>
    </div>
  </div>

  <!-- Comparison table -->
  <div style="max-width:700px;margin:40px auto 0;overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;font-size:14px;">
      <thead>
        <tr style="border-bottom:1px solid var(--border2);">
          <th style="text-align:left;padding:12px 16px;color:var(--text2);font-weight:600;">Feature</th>
          <th style="text-align:center;padding:12px 16px;color:var(--text2);font-weight:600;">Free</th>
          <th style="text-align:center;padding:12px 16px;color:var(--accent);font-weight:700;">Pro $9/mo</th>
        </tr>
      </thead>
      <tbody>
        <tr style="border-bottom:1px solid var(--border);">
          <td style="padding:12px 16px;color:var(--text);">Compress / Merge / Split</td>
          <td style="padding:12px 16px;text-align:center;color:var(--text2);">3/day</td>
          <td style="padding:12px 16px;text-align:center;color:var(--accent2);font-weight:600;">Unlimited</td>
        </tr>
        <tr style="border-bottom:1px solid var(--border);">
          <td style="padding:12px 16px;color:var(--text);">AI Chat with PDF</td>
          <td style="padding:12px 16px;text-align:center;color:var(--text2);">1/day, 500 words</td>
          <td style="padding:12px 16px;text-align:center;color:var(--accent2);font-weight:600;">Unlimited</td>
        </tr>
        <tr style="border-bottom:1px solid var(--border);">
          <td style="padding:12px 16px;color:var(--text);">AI Translate</td>
          <td style="padding:12px 16px;text-align:center;color:var(--text2);">1/day, 500 words</td>
          <td style="padding:12px 16px;text-align:center;color:var(--accent2);font-weight:600;">Unlimited</td>
        </tr>
        <tr style="border-bottom:1px solid var(--border);">
          <td style="padding:12px 16px;color:var(--text);">AI Summarize</td>
          <td style="padding:12px 16px;text-align:center;color:var(--text2);">1/day</td>
          <td style="padding:12px 16px;text-align:center;color:var(--accent2);font-weight:600;">Unlimited</td>
        </tr>
        <tr style="border-bottom:1px solid var(--border);">
          <td style="padding:12px 16px;color:var(--text);">File size</td>
          <td style="padding:12px 16px;text-align:center;color:var(--text2);">10MB</td>
          <td style="padding:12px 16px;text-align:center;color:var(--accent2);font-weight:600;">200MB</td>
        </tr>
        <tr>
          <td style="padding:12px 16px;color:var(--text);">History</td>
          <td style="padding:12px 16px;text-align:center;color:var(--text3);">❌</td>
          <td style="padding:12px 16px;text-align:center;">✅</td>
        </tr>
      </tbody>
    </table>
  </div>
</section>

<footer>
  <div class="foot-logo">PDFTash</div>
  <div class="foot-links"><a href="#">About</a><a href="#">Privacy</a><a href="#">Terms</a><a href="/system-status" target="_blank">System Status</a></div>
  <div class="foot-copy">© 2026 PDFTash</div>
</footer>

<!-- PANEL -->
<div id="panel-overlay" onclick="if(event.target===this)closePanel()">
  <div id="panel-box">
    <button id="panel-close" onclick="closePanel()">✕</button>
    <div id="panel-content"></div>
  </div>
</div>

<div id="toast"><span id="t-icon">✅</span><span id="t-msg"></span></div>

<script>
// ── Config ──────────────────────────────────────────────────────────────────
const API      = '/api';  // Laravel API — same domain, no CORS needed
const CSRF     = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
let globalFile = null;
let chatSession = null;

// ── Tool definitions ──────────────────────────────────────────────────────
const TOOLS = {
  compress:{title:'🗜️ Compress PDF',sub:'Reduce file size without losing quality.',
    fields:[{type:'select',name:'level',label:'Compression Level',
      opts:['recommended','high','low'],labels:['Recommended (best balance)','High compression','Low compression (best quality)']}],
    action:'Compress PDF',endpoint:'/pdf/compress'},

  merge:{title:'🔗 Merge PDFs',sub:'Combine multiple PDF files into one document.',
    multi:true,action:'Merge PDFs',endpoint:'/pdf/merge'},

  split:{title:'✂️ Split PDF',sub:'Split PDF into separate files.',
    fields:[
      {type:'select',name:'method',label:'Split Method',opts:['every','half','range'],
        labels:['Every N pages','Split in half','By page range (e.g. 1-3,4-6)']},
      {type:'text',name:'n',label:'Pages per part (for "Every N")',placeholder:'1'},
      {type:'text',name:'ranges',label:'Page ranges (for "By range")',placeholder:'1-3,4-6,7-10'},
    ],action:'Split PDF',endpoint:'/pdf/split'},

  'pdf-to-images':{title:'🖼️ PDF to Images',sub:'Convert each page to a high-quality image.',
    fields:[
      {type:'select',name:'format',label:'Format',opts:['jpg','png'],labels:['JPG (smaller)','PNG (transparent)']},
      {type:'select',name:'dpi',label:'Quality',opts:['96','150','200','300'],
        labels:['96 DPI (screen)','150 DPI (standard)','200 DPI (high)','300 DPI (print)']},
    ],action:'Convert to Images',endpoint:'/pdf/to-images'},

  'images-to-pdf':{title:'📄 Images to PDF',sub:'Combine multiple images into one PDF.',
    multi:true,accept:'.jpg,.jpeg,.png,.webp',action:'Convert to PDF',endpoint:'/pdf/images-to-pdf'},

  'extract-text':{title:'📃 Extract Text',sub:'Extract all text from PDF as a .txt file.',
    action:'Extract Text',endpoint:'/pdf/to-text'},

  grayscale:{title:'⚫ Grayscale PDF',sub:'Convert all colors to black and white.',
    action:'Convert to Grayscale',endpoint:'/pdf/grayscale'},

  sign:{title:'✍️ eSign PDF',sub:'Draw, type or upload your signature.',method:'sign'},

  watermark:{title:'💧 Add Watermark',sub:'Add a diagonal text watermark to all pages.',
    fields:[
      {type:'text',name:'text',label:'Watermark Text',placeholder:'e.g. CONFIDENTIAL'},
      {type:'select',name:'angle',label:'Angle',opts:['45','0','90'],
        labels:['Diagonal (45°)','Horizontal (0°)','Vertical (90°)']},
      {type:'select',name:'opacity',label:'Opacity',opts:['0.15','0.25','0.4'],
        labels:['Light (15%)','Medium (25%)','Dark (40%)']},
    ],action:'Add Watermark',endpoint:'/pdf/watermark'},

  'page-numbers':{title:'🔢 Add Page Numbers',sub:'Add page numbers to each PDF page.',
    fields:[
      {type:'select',name:'position',label:'Position',
        opts:['bottom-center','bottom-right','bottom-left','top-center'],
        labels:['Bottom Center','Bottom Right','Bottom Left','Top Center']},
      {type:'text',name:'prefix',label:'Prefix (optional)',placeholder:'e.g. Page '},
      {type:'text',name:'start',label:'Start Number',placeholder:'1'},
    ],action:'Add Page Numbers',endpoint:'/pdf/page-numbers'},

  rotate:{title:'🔄 Rotate Pages',sub:'Rotate PDF pages 90°, 180° or 270°.',
    fields:[
      {type:'select',name:'angle',label:'Rotation Angle',
        opts:['90','180','270'],labels:['90° Clockwise','180° (Flip)','270° Counter-clockwise']},
      {type:'text',name:'pages',label:'Pages (comma-separated or "all")',placeholder:'all'},
    ],action:'Rotate',endpoint:'/pdf/rotate'},

  'delete-pages':{title:'🗑️ Delete Pages',sub:'Permanently remove pages from PDF.',
    fields:[{type:'text',name:'pages',label:'Pages to delete',placeholder:'e.g. 1,3,5-8'}],
    action:'Delete Pages',endpoint:'/pdf/delete-pages'},

  reorder:{title:'📋 Reorder Pages',sub:'Specify new page order as comma-separated numbers.',
    fields:[{type:'text',name:'order',label:'New page order',placeholder:'e.g. 3,1,2,4,5'}],
    action:'Reorder',endpoint:'/pdf/reorder'},

  protect:{title:'🔐 Protect PDF',sub:'Add AES-128 password encryption.',
    fields:[{type:'password',name:'password',label:'Password',placeholder:'Enter password'}],
    action:'Add Password',endpoint:'/pdf/protect'},

  unlock:{title:'🔓 Unlock PDF',sub:'Remove password from PDF.',
    fields:[{type:'password',name:'password',label:'Current Password (if any)',placeholder:'Enter password'}],
    action:'Unlock PDF',endpoint:'/pdf/unlock'},

  info:{title:'ℹ️ PDF Info',sub:'View metadata, page count, and encryption status.',
    action:'Get Info',endpoint:'/pdf/info',infoOnly:true},

  summarize:{title:'📝 AI Summarizer',sub:'Get a structured AI summary of your PDF.',
    fields:[{type:'select',name:'length',label:'Summary Length',
      opts:['short','medium','detailed'],labels:['Short (~150 words)','Medium (~350 words)','Detailed (~700 words)']}],
    action:'Summarize with AI',endpoint:'/ai/summarize',aiText:true},

  translate:{title:'🌐 PDF Translator',sub:'Translate PDF to another language using AI.',
    fields:[{type:'select',name:'language',label:'Translate to',
      opts:['Bengali','Arabic','Spanish','French','German','Hindi','Chinese','Portuguese','Turkish','Russian','Italian'],
      labels:['Bengali (বাংলা)','Arabic (العربية)','Spanish','French','German','Hindi (हिन्दी)','Chinese (中文)','Portuguese','Turkish','Russian','Italian']}],
    action:'Translate',endpoint:'/ai/translate'},

  'extract-data':{title:'📊 AI Data Extractor',sub:'Extract structured data from PDF using AI.',
    fields:[{type:'select',name:'type',label:'Data Type',
      opts:['invoice','table','contact'],labels:['Invoice Data','Table/Grid Data','Contact Information']}],
    action:'Extract Data',endpoint:'/ai/extract-data'},

  chat:{title:'💬 Chat with PDF',sub:'Upload a PDF then ask any question about it.',method:'chat'},
};

// ── Panel ─────────────────────────────────────────────────────────────────
function openTool(key){
  const tool = TOOLS[key];
  if(!tool) return;
  document.getElementById('panel-content').innerHTML = buildPanel(tool, key);
  document.getElementById('panel-overlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closePanel(){
  document.getElementById('panel-overlay').classList.remove('open');
  document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if(e.key==='Escape') closePanel(); });

function buildPanel(tool, key){
  let html = `<div class="panel-title">${tool.title}</div><div class="panel-sub">${tool.sub}</div>`;

  if(tool.method === 'sign'){ return html + buildSignUI(); }
  if(tool.method === 'chat'){ return html + buildChatUI(); }

  const accept = tool.accept || '.pdf';
  const multi  = tool.multi ? 'multiple' : '';
  html += `<div class="panel-upload" onclick="document.getElementById('p-file').click()">
    <div class="pu-icon">📁</div>
    <div class="pu-text">${tool.multi ? 'Click to upload multiple files' : 'Click to upload your file'}</div>
    <div class="pu-name" id="pu-name">No file selected</div>
    <input type="file" id="p-file" style="display:none" accept="${accept}" ${multi} onchange="setPanelFile(this)">
  </div>`;

  if(tool.fields){
    tool.fields.forEach(f => {
      html += `<div class="fgroup"><label class="flabel">${f.label}</label>`;
      if(f.type === 'select'){
        html += `<select class="fselect" id="f-${f.name}">`;
        f.opts.forEach((o,i) => html += `<option value="${o}">${(f.labels||f.opts)[i]}</option>`);
        html += `</select>`;
      } else {
        html += `<input type="${f.type}" class="finput" id="f-${f.name}" placeholder="${f.placeholder||''}">`;
      }
      html += `</div>`;
    });
  }

  html += `<button class="btn btn-primary btn-block btn-lg" style="margin-top:8px" onclick="runTool('${key}')">${tool.action||'Process'}</button>
    <div class="prog-wrap" id="prog-wrap">
      <div class="prog-label"><span id="prog-txt">Processing…</span><span id="prog-pct">0%</span></div>
      <div class="prog-bar"><div class="prog-fill" id="prog-fill"></div></div>
    </div>
    <div class="result-box" id="result-box"></div>`;
  return html;
}

function buildChatUI(){
  return `<div class="panel-upload" id="chat-upload" onclick="document.getElementById('chat-file').click()" style="margin-bottom:12px">
    <div class="pu-icon">📄</div>
    <div class="pu-text">Upload PDF to start chatting</div>
    <div class="pu-name" id="chat-fname">No file uploaded</div>
    <input type="file" id="chat-file" style="display:none" accept=".pdf" onchange="uploadForChat(this)">
  </div>
  <div class="chat-msgs" id="chat-msgs">
    <div class="cmsg"><div class="cav cav-a">🤖</div><div class="cbubble">Hi! Upload a PDF above and I'll answer any question about it.</div></div>
  </div>
  <div class="chat-irow">
    <input class="chat-inp" id="chat-q" placeholder="Ask anything about your PDF…" onkeydown="if(event.key==='Enter')sendChat()" disabled>
    <button class="chat-send" id="chat-send-btn" onclick="sendChat()" disabled>Send</button>
  </div>`;
}

function buildSignUI(){
  return `<div class="panel-upload" onclick="document.getElementById('sign-file').click()">
    <div class="pu-icon">📄</div>
    <div class="pu-text">Upload PDF to sign</div>
    <div class="pu-name" id="sign-fname">No file selected</div>
    <input type="file" id="sign-file" style="display:none" accept=".pdf" onchange="setSignFile(this)">
  </div>
  <div class="fgroup">
    <label class="flabel">Signature Method</label>
    <select class="fselect" id="sign-method" onchange="toggleSignMethod()">
      <option value="upload">Upload Signature Image</option>
      <option value="draw">Draw Signature</option>
      <option value="type">Type Signature</option>
    </select>
  </div>
  <div id="sign-upload" class="fgroup">
    <label class="flabel">Upload Signature Image</label>
    <input type="file" id="sig-file" accept=".png,.jpg,.jpeg" onchange="setSigFile(this)">
  </div>
  <div id="sign-draw" class="fgroup" style="display:none">
    <label class="flabel">Draw Signature</label>
    <canvas id="sig-canvas" width="300" height="100" style="border:1px solid var(--border);"></canvas>
    <button class="btn btn-ghost" onclick="clearCanvas()">Clear</button>
  </div>
  <div id="sign-type" class="fgroup" style="display:none">
    <label class="flabel">Type Signature</label>
    <input type="text" class="finput" id="sig-text" placeholder="Enter your name">
  </div>
  <div class="fgroup" style="margin-top:16px">
    <label class="flabel">3. Signature placement</label>
    <div class="fgroup">
      <label class="flabel">Page placement</label>
      <select class="fselect" id="sign-placement" onchange="toggleCustomPage(this.value)">
        <option value="last">Last page (most common)</option>
        <option value="first">First page</option>
        <option value="all">All pages</option>
        <option value="custom">Custom page number</option>
      </select>
    </div>
    <div class="fgroup" id="custom-page-group" style="display:none">
      <label class="flabel">Page number</label>
      <input type="number" class="finput" id="sign-page" value="1" min="1" placeholder="e.g. 3">
    </div>
    <div class="fgroup">
      <label class="flabel">Signature width (points, 72pt = 1 inch)</label>
      <input type="number" class="finput" id="sign-width" value="150" min="50" max="400">
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
      <div class="fgroup">
        <label class="flabel">Left position (0=left, 100=right)</label>
        <input type="number" class="finput" id="sign-x" value="10" min="0" max="90">
      </div>
      <div class="fgroup">
        <label class="flabel">Top position (0=top, 100=bottom)</label>
        <input type="number" class="finput" id="sign-y" value="85" min="0" max="95">
      </div>
    </div>
    <div style="font-size:12px;color:var(--text3);margin-top:4px">
      💡 Top position 85-90 = near bottom of page. 5-10 = near top.
    </div>
  </div>
  <button class="btn btn-primary btn-block btn-lg" style="margin-top:8px" onclick="applySignature()">✍️ Apply Signature & Download</button>
  <div class="prog-wrap" id="prog-wrap">
    <div class="prog-label"><span id="prog-txt">Applying signature…</span><span id="prog-pct">0%</span></div>
    <div class="prog-bar"><div class="prog-fill" id="prog-fill"></div></div>
  </div>
  <div class="result-box" id="result-box"></div>`;
}

// ── File helpers ──────────────────────────────────────────────────────────
function setPanelFile(input){
  const names = Array.from(input.files).map(f => f.name).join(', ');
  const el = document.getElementById('pu-name');
  if(el) el.textContent = '✅ ' + (names.length > 60 ? names.slice(0,60)+'…' : names);
}
function handleGlobalFile(input){
  if(!input.files[0]) return;
  globalFile = input.files[0];
  const info = document.getElementById('dz-info');
  info.style.display = 'block';
  info.textContent = '✅ ' + globalFile.name + ' — choose a tool below';
  showToast('File ready: ' + globalFile.name, '📄');
}

function filterTools(cat, btn){
  document.querySelectorAll('.ttab').forEach(t => t.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('.tc').forEach(c => {
    c.style.display = (cat==='all' || c.dataset.c===cat) ? '' : 'none';
  });
}

// ── Sign functions ────────────────────────────────────────────────────────
let signFile = null;
let sigFile = null;

function setSignFile(input){
  if(input.files[0]){
    signFile = input.files[0];
    document.getElementById('sign-fname').textContent = '✅ ' + signFile.name;
  }
}

function toggleCustomPage(val){
  const group = document.getElementById('custom-page-group');
  if(group) group.style.display = (val === 'custom') ? 'block' : 'none';
}

function toggleSignMethod(){
  const method = document.getElementById('sign-method').value;
  document.getElementById('sign-upload').style.display = method === 'upload' ? 'block' : 'none';
  document.getElementById('sign-draw').style.display = method === 'draw' ? 'block' : 'none';
  document.getElementById('sign-type').style.display = method === 'type' ? 'block' : 'none';
  if(method === 'draw'){
    initCanvas();
  }
}

function initCanvas(){
  const canvas = document.getElementById('sig-canvas');
  const ctx = canvas.getContext('2d');
  ctx.strokeStyle = '#000';
  ctx.lineWidth = 2;
  ctx.lineCap = 'round';
  let drawing = false;
  canvas.addEventListener('mousedown', () => drawing = true);
  canvas.addEventListener('mouseup', () => drawing = false);
  canvas.addEventListener('mouseout', () => drawing = false);
  canvas.addEventListener('mousemove', (e) => {
    if(!drawing) return;
    const rect = canvas.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    ctx.lineTo(x, y);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(x, y);
  });
}

function setSigFile(input){
  if(input.files[0]){
    sigFile = input.files[0];
  }
}

function clearCanvas(){
  const canvas = document.getElementById('sig-canvas');
  const ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);
}

async function applySignature(){
  if(!signFile){
    showToast('Please upload a PDF first','⚠️');
    return;
  }

  const method = document.getElementById('sign-method').value;
  const fd = new FormData();
  fd.append('file', signFile);
  fd.append('_token', CSRF);
  fd.append('placement', document.getElementById('sign-placement')?.value || 'last');
  fd.append('page',      document.getElementById('sign-page')?.value      || 1);
  fd.append('x',         document.getElementById('sign-x')?.value         || 10);
  fd.append('y',         document.getElementById('sign-y')?.value         || 85);
  fd.append('width',     document.getElementById('sign-width')?.value     || 150);
  fd.append('height',    50);

  if(method === 'type'){
    const text = document.getElementById('sig-text').value.trim();
    if(!text){ showToast('Please enter your signature text','⚠️'); return; }
    fd.append('sign_type', 'text');
    fd.append('sign_text', text);

  } else if(method === 'draw'){
    const canvas = document.getElementById('sig-canvas');
    const dataUrl = canvas.toDataURL('image/png');
    fd.append('sign_type', 'image');
    fd.append('sign_image', dataUrl);

  } else {
    // upload
    if(!sigFile){ showToast('Please upload a signature image','⚠️'); return; }
    fd.append('sign_type', 'image');
    fd.append('sign_file', sigFile);
  }

  startProgress('Applying signature…');

  try {
    const resp = await fetch(API + '/pdf/sign', { method: 'POST', body: fd });
    finishProgress();

    if(!resp.ok){
      const e = await resp.json().catch(() => ({}));
      showToast('❌ ' + (e.error || 'Server error'), 'error');
      return;
    }

    const blob = await resp.blob();
    const cd   = resp.headers.get('Content-Disposition') || '';
    const fname = cd.split('filename=')[1]?.replace(/"/g,'') || 'signed.pdf';
    triggerDownload(blob, fname);
    showToast('Signature applied! Downloading…','✅');

  } catch(e){
    finishProgress();
    showToast('Connection error. Is Laravel running?','❌');
  }
}

// ── Progress ──────────────────────────────────────────────────────────────
let progIv = null;
function startProgress(label='Processing…'){
  const wrap = document.getElementById('prog-wrap');
  if(wrap) wrap.style.display = 'block';
  const fill = document.getElementById('prog-fill');
  const pct  = document.getElementById('prog-pct');
  const txt  = document.getElementById('prog-txt');
  if(txt) txt.textContent = label;
  if(fill) fill.style.width = '0%';
  let v = 0;
  progIv = setInterval(() => {
    v += Math.random() * 10;
    if(v > 88) v = 88;
    if(fill) fill.style.width = v + '%';
    if(pct) pct.textContent = Math.round(v) + '%';
  }, 200);
}
function finishProgress(){
  clearInterval(progIv);
  const fill = document.getElementById('prog-fill');
  const pct  = document.getElementById('prog-pct');
  if(fill) fill.style.width = '100%';
  if(pct) pct.textContent = '100%';
}
function showResult(html, isError=false){
  const box = document.getElementById('result-box');
  if(!box) return;
  box.className = 'result-box' + (isError ? ' error' : '');
  box.innerHTML = html;
  box.style.display = 'block';
}

// ── Build FormData ────────────────────────────────────────────────────────
function buildFD(tool){
  const fd   = new FormData();
  const pFile = document.getElementById('p-file');

  if(tool.multi){
    if(!pFile || !pFile.files.length){ showToast('Please upload files first','⚠️'); return null; }
    Array.from(pFile.files).forEach(f => fd.append('files[]', f));
  } else {
    const f = (pFile && pFile.files[0]) || globalFile;
    if(!f){ showToast('Please upload a file first','⚠️'); return null; }
    fd.append('file', f);
  }

  if(tool.fields){
    tool.fields.forEach(field => {
      const el = document.getElementById('f-' + field.name);
      if(el) fd.append(field.name, el.value);
    });
  }
  fd.append('_token', CSRF);
  return fd;
}

// ── Run Tool ──────────────────────────────────────────────────────────────
async function runTool(key){
  const tool = TOOLS[key];
  if(!tool) return;

  const fd = buildFD(tool);
  if(!fd) return;

  startProgress(tool.aiText ? 'AI is thinking…' : 'Processing your PDF…');

  try {
    const resp = await fetch(API + tool.endpoint, { method: 'POST', body: fd });
    finishProgress();

    if(!resp.ok){
      const e = await resp.json().catch(() => ({}));
      if(e.error === 'free_limit_reached'){
        showUpgradeModal();
        return;
      }
      showResult('❌ ' + (e.error || 'Server error'), true);
      return;
    }

    // AI text result (summarize returns JSON)
    if(tool.aiText){
      const data = await resp.json();
      showResult('<strong>AI Summary:</strong><br><br>' + (data.summary || '').replace(/\n/g,'<br>').replace(/\*\*(.*?)\*\*/g,'<strong>$1</strong>'));
      showToast('Summary ready!','✅');
      return;
    }

    // Info tool returns JSON
    if(tool.infoOnly){
      const data = await resp.json();
      showResult(`✅ <strong>PDF Info</strong><br><br>
        📄 Pages: <strong>${data.pages}</strong><br>
        📦 Size: <strong>${data.file_size_kb} KB</strong><br>
        🔒 Encrypted: <strong>${data.encrypted ? 'Yes' : 'No'}</strong><br>
        ✏️ Title: <strong>${data.title || '—'}</strong><br>
        👤 Author: <strong>${data.author || '—'}</strong><br>
        📅 Created: <strong>${data.created || '—'}</strong>`);
      return;
    }

    // File download
    const blob = await resp.blob();
    const cd   = resp.headers.get('Content-Disposition') || '';
    const fname = cd.split('filename=')[1]?.replace(/"/g,'') || 'result.pdf';
    triggerDownload(blob, fname);
    showResult(`✅ Done! <strong>${fname}</strong> downloaded successfully.`);
    showToast('File downloaded!','✅');

  } catch(e){
    finishProgress();
    showResult('❌ Connection error. Is Laravel running?<br><small>Run: <code>php artisan serve</code></small>', true);
  }
}

function triggerDownload(blob, fname){
  const url = URL.createObjectURL(blob);
  const a   = document.createElement('a');
  a.href = url; a.download = fname; a.click();
  setTimeout(() => URL.revokeObjectURL(url), 2000);
}

// ── Chat with PDF ─────────────────────────────────────────────────────────
async function uploadForChat(input){
  if(!input.files[0]) return;
  const fname = document.getElementById('chat-fname');
  fname.textContent = '⏳ Uploading…';

  const fd = new FormData();
  fd.append('file', input.files[0]);
  fd.append('_token', CSRF);

  try{
    const resp = await fetch(API + '/ai/upload-for-chat', { method:'POST', body:fd });
    const data = await resp.json();
    if(data.error){ fname.textContent = '❌ ' + data.error; return; }

    chatSession = data.session_id;
    fname.textContent = '✅ ' + input.files[0].name + ' — ready!';
    document.getElementById('chat-q').disabled = false;
    document.getElementById('chat-send-btn').disabled = false;
    addChatMsg('a','📄 PDF loaded! Ask me anything about it.');
    showToast('PDF ready for chat!','💬');
  } catch(e){
    fname.textContent = '❌ Upload failed';
  }
}

function addChatMsg(who, text){
  const msgs = document.getElementById('chat-msgs');
  if(!msgs) return;
  msgs.innerHTML += `<div class="cmsg">
    <div class="cav cav-${who}">${who==='u'?'👤':'🤖'}</div>
    <div class="cbubble">${text}</div>
  </div>`;
  msgs.scrollTop = msgs.scrollHeight;
}

async function sendChat(){
  const inp = document.getElementById('chat-q');
  if(!inp || !inp.value.trim()) return;
  if(!chatSession){ showToast('Upload a PDF first!','⚠️'); return; }

  const q = inp.value.trim(); inp.value = '';
  addChatMsg('u', q);

  // Typing indicator
  const msgs = document.getElementById('chat-msgs');
  msgs.innerHTML += `<div class="cmsg" id="typing">
    <div class="cav cav-a">🤖</div>
    <div class="cbubble"><span class="typing"><span></span><span></span><span></span></span></div>
  </div>`;
  msgs.scrollTop = msgs.scrollHeight;
  document.getElementById('chat-send-btn').disabled = true;

  try{
    const resp = await fetch(API + '/ai/chat', {
      method: 'POST',
      headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': CSRF },
      body: JSON.stringify({ session_id: chatSession, question: q }),
    });
    const data = await resp.json();
    const typing = document.getElementById('typing');
    if(typing) typing.remove();
    addChatMsg('a', data.error ? '❌ ' + data.error : data.answer);
  } catch(e){
    document.getElementById('typing')?.remove();
    addChatMsg('a','❌ Server error. Is Laravel running?');
  }
  document.getElementById('chat-send-btn').disabled = false;
}

// ── Drag & Drop ───────────────────────────────────────────────────────────
const dz = document.getElementById('dropzone');
dz.addEventListener('dragover', e => { e.preventDefault(); dz.classList.add('drag'); });
dz.addEventListener('dragleave', () => dz.classList.remove('drag'));
dz.addEventListener('drop', e => {
  e.preventDefault(); dz.classList.remove('drag');
  const f = e.dataTransfer.files[0];
  if(f){ globalFile = f; document.getElementById('dz-info').style.display='block';
    document.getElementById('dz-info').textContent = '✅ ' + f.name;
    showToast('File ready!','📄'); }
});

// ── Login Modal ───────────────────────────────────────────────────────────
let modalMode = 'login';

function openLoginModal(){
    modalMode = 'login';
    setModalMode('login');
    const m = document.getElementById('login-modal');
    m.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeLoginModal(){
    const m = document.getElementById('login-modal');
    m.style.display = 'none';
    document.body.style.overflow = '';
}
function switchToRegister(e){
    e.preventDefault();
    modalMode = 'register';
    setModalMode('register');
}
function switchToLogin(e){
    e.preventDefault();
    modalMode = 'login';
    setModalMode('login');
}
function setModalMode(mode){
    const isLogin = mode === 'login';
    document.getElementById('modal-title').textContent      = isLogin ? 'Sign in' : 'Create an account';
    document.getElementById('modal-sub').textContent        = isLogin ? 'Continue to your account' : 'Start for free — no credit card needed';
    document.getElementById('modal-submit-btn').textContent = isLogin ? 'Sign In' : 'Create Account';
    document.getElementById('password-group').style.display        = 'block';
    document.getElementById('forgot-group').style.display          = isLogin ? 'block' : 'none';
    document.getElementById('fullname-group').style.display        = isLogin ? 'none' : 'block';
    document.getElementById('confirm-password-group').style.display= isLogin ? 'none' : 'block';
    document.getElementById('terms-group').style.display           = isLogin ? 'none' : 'flex';
    document.getElementById('modal-toggle').innerHTML = isLogin
        ? 'Don\'t have an account? <a href="#" onclick="switchToRegister(event)" style="color:var(--accent);text-decoration:none;font-weight:600;">Create an account</a>'
        : 'Already have an account? <a href="#" onclick="switchToLogin(event)" style="color:var(--accent);text-decoration:none;font-weight:600;">Sign in</a>';
}
function submitLoginForm(){
    // For now redirect to Google — email/password can be added later
    window.location.href = '/auth/google';
}
document.getElementById('login-modal')?.addEventListener('click', function(e){
    if(e.target === this) closeLoginModal();
});

// ── Payment ───────────────────────────────────────────────────────────────



async function upgradeToPro() {
    const csrf = document.querySelector('meta[name="csrf-token"]');
    if (!csrf) {
        showToast('CSRF token missing!', '❌');
        return;
    }

    try {
        const resp = await fetch('/payment/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf.getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({})
        });

        const text = await resp.text();
        console.log('Response:', text);

        let data;
        try {
            data = JSON.parse(text);
        } catch(e) {
            console.error('Not JSON:', text);
            showToast('Server error — check console', '❌');
            return;
        }

        if (data.url) {
            window.location.href = data.url;
        } else {
            showToast('Error: ' + (data.error || 'Unknown'), '❌');
        }
    } catch(e) {
        showToast('Error: ' + e.message, '❌');
    }
}

// ── Upgrade Modal ─────────────────────────────────────────────────────────
function showUpgradeModal(){
    const m = document.getElementById('upgrade-modal');
    m.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeUpgradeModal(){
    const m = document.getElementById('upgrade-modal');
    m.style.display = 'none';
    document.body.style.overflow = '';
}

// ── Toast ─────────────────────────────────────────────────────────────────
function showToast(msg, icon='✅'){
  document.getElementById('t-msg').textContent = msg;
  document.getElementById('t-icon').textContent = icon;
  const t = document.getElementById('toast');
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 3500);
}
</script>

<!-- Login Modal -->
<div id="login-modal" style="display:none;position:fixed;inset:0;z-index:400;background:rgba(0,0,0,.88);backdrop-filter:blur(12px);align-items:center;justify-content:center;padding:20px;">
  <div style="background:#1a1a2e;border:1px solid rgba(255,255,255,.1);border-radius:16px;max-width:400px;width:100%;padding:36px 32px;position:relative;">
    <button onclick="closeLoginModal()" style="position:absolute;top:14px;right:16px;background:transparent;border:none;color:#666;font-size:22px;cursor:pointer;line-height:1;">×</button>

    <!-- Logo + Title -->
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px;">
      <div style="width:32px;height:32px;background:var(--accent);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:16px;">📄</div>
      <span style="font-family:'Plus Jakarta Sans',sans-serif;font-size:16px;font-weight:700;color:#fff;">PDFTash</span>
    </div>
    <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:22px;font-weight:700;color:#fff;margin-bottom:4px;" id="modal-title">Sign in</div>
    <div style="font-size:13px;color:#888;margin-bottom:24px;" id="modal-sub">Continue to your account</div>

    <!-- Google Button -->
    <a href="/auth/google" style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;padding:11px;background:#2a2a3e;color:#eee;border:1px solid rgba(255,255,255,.12);border-radius:10px;text-decoration:none;font-weight:500;font-size:14px;margin-bottom:20px;box-sizing:border-box;transition:background .2s;" onmouseover="this.style.background='#33334a'" onmouseout="this.style.background='#2a2a3e'">
      <svg width="18" height="18" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.08 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.18 1.48-4.97 2.31-8.16 2.31-6.26 0-11.57-3.59-13.46-8.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/></svg>
      Continue with Google
    </a>

    <!-- Divider -->
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
      <div style="flex:1;height:1px;background:rgba(255,255,255,.08);"></div>
      <span style="font-size:12px;color:#555;">OR</span>
      <div style="flex:1;height:1px;background:rgba(255,255,255,.08);"></div>
    </div>

    <!-- Email -->
    <div style="margin-bottom:14px;">
      <label style="display:block;font-size:12px;font-weight:600;color:#aaa;margin-bottom:6px;text-transform:uppercase;letter-spacing:.05em;">Email</label>
      <input type="email" id="login-email" placeholder="you@example.com" style="width:100%;padding:11px 14px;background:#0f0f1a;border:1px solid rgba(255,255,255,.12);border-radius:10px;color:#eee;font-size:14px;box-sizing:border-box;outline:none;" onfocus="this.style.borderColor='#5b5cff'" onblur="this.style.borderColor='rgba(255,255,255,.12)'">
    </div>

    <!-- Full Name (register only) -->
    <div style="margin-bottom:14px;display:none;" id="fullname-group">
      <label style="display:block;font-size:12px;font-weight:600;color:#aaa;margin-bottom:6px;text-transform:uppercase;letter-spacing:.05em;">Full Name</label>
      <input type="text" id="register-name" placeholder="Jane Smith" style="width:100%;padding:11px 14px;background:#0f0f1a;border:1px solid rgba(255,255,255,.12);border-radius:10px;color:#eee;font-size:14px;box-sizing:border-box;outline:none;" onfocus="this.style.borderColor='#5b5cff'" onblur="this.style.borderColor='rgba(255,255,255,.12)'">
    </div>

    <!-- Password -->
    <div style="margin-bottom:14px;" id="password-group">
      <label style="display:block;font-size:12px;font-weight:600;color:#aaa;margin-bottom:6px;text-transform:uppercase;letter-spacing:.05em;">Password</label>
      <input type="password" id="login-password" placeholder="Min. 8 characters" style="width:100%;padding:11px 14px;background:#0f0f1a;border:1px solid rgba(255,255,255,.12);border-radius:10px;color:#eee;font-size:14px;box-sizing:border-box;outline:none;" onfocus="this.style.borderColor='#5b5cff'" onblur="this.style.borderColor='rgba(255,255,255,.12)'">
    </div>

    <!-- Confirm Password (register only) -->
    <div style="margin-bottom:14px;display:none;" id="confirm-password-group">
      <label style="display:block;font-size:12px;font-weight:600;color:#aaa;margin-bottom:6px;text-transform:uppercase;letter-spacing:.05em;">Confirm Password</label>
      <input type="password" id="register-confirm" placeholder="Repeat your password" style="width:100%;padding:11px 14px;background:#0f0f1a;border:1px solid rgba(255,255,255,.12);border-radius:10px;color:#eee;font-size:14px;box-sizing:border-box;outline:none;" onfocus="this.style.borderColor='#5b5cff'" onblur="this.style.borderColor='rgba(255,255,255,.12)'">
    </div>

    <!-- Forgot (login only) -->
    <div style="text-align:right;margin-bottom:20px;" id="forgot-group">
      <a href="#" style="font-size:13px;color:#5b5cff;text-decoration:none;">Forgot password?</a>
    </div>

    <!-- Terms (register only) -->
    <div style="display:none;margin-bottom:18px;align-items:flex-start;gap:8px;" id="terms-group">
      <input type="checkbox" id="terms-check" style="margin-top:2px;accent-color:#5b5cff;cursor:pointer;">
      <label for="terms-check" style="font-size:13px;color:#888;cursor:pointer;">I agree to the <a href="#" style="color:#5b5cff;text-decoration:none;">Terms of Service</a> and <a href="#" style="color:#5b5cff;text-decoration:none;">Privacy Policy</a></label>
    </div>

    <!-- Submit -->
    <button type="button" onclick="submitLoginForm()" id="modal-submit-btn" style="width:100%;padding:13px;background:var(--accent);color:#fff;border:none;border-radius:10px;font-size:15px;font-weight:600;cursor:pointer;margin-bottom:20px;transition:background .2s;" onmouseover="this.style.background='var(--accent-h)'" onmouseout="this.style.background='var(--accent)'">Sign In</button>

    <!-- Toggle -->
    <div style="text-align:center;font-size:13px;color:#666;" id="modal-toggle">
      Don't have an account? <a href="#" onclick="switchToRegister(event)" style="color:var(--accent);text-decoration:none;font-weight:600;">Create an account</a>
    </div>
  </div>
</div>

<!-- Upgrade Modal -->
<div id="upgrade-modal" style="display:none;position:fixed;inset:0;z-index:300;background:rgba(0,0,0,.85);backdrop-filter:blur(10px);align-items:center;justify-content:center;padding:20px;">
  <div style="background:var(--bg2);border:1px solid var(--border2);border-radius:24px;max-width:480px;width:100%;padding:40px;text-align:center;">
    <div style="font-size:48px;margin-bottom:16px">⚡</div>
    <h2 style="font-family:'Plus Jakarta Sans',sans-serif;font-size:22px;font-weight:700;margin-bottom:10px">Daily limit reached!</h2>
    <p style="color:var(--text2);font-size:14px;line-height:1.65;margin-bottom:24px">You have used your <strong style="color:var(--text)">5 free tasks</strong> for today.<br>Upgrade to Pro for unlimited access.</p>
    <div style="background:var(--bg3);border-radius:16px;padding:20px;margin-bottom:24px;text-align:left;">
      <div style="font-size:13px;color:var(--text2);display:flex;flex-direction:column;gap:8px;">
        <div>✅ Unlimited tasks every day</div>
        <div>✅ All 20+ PDF tools</div>
        <div>✅ Unlimited AI features</div>
        <div>✅ PDF Translation (12 languages)</div>
        <div>✅ 2GB document storage</div>
      </div>
      <div style="margin-top:16px;font-size:32px;font-weight:700;color:var(--text)">$9<span style="font-size:14px;font-weight:400;color:var(--text2)">/month</span></div>
    </div>
    <button onclick="window.location.href='#pricing'" style="width:100%;padding:14px;background:var(--accent);color:#fff;border:none;border-radius:99px;font-size:15px;font-weight:600;cursor:pointer;margin-bottom:10px;">Upgrade to Pro →</button>
    <button onclick="closeUpgradeModal()" style="width:100%;padding:10px;background:transparent;color:var(--text2);border:1px solid var(--border2);border-radius:99px;font-size:13px;cursor:pointer;">Maybe later</button>
  </div>
</div>
</body>
</html>
