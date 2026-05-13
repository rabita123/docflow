<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Dashboard — PDFTash</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
:root{
  --bg:#0d0d14;--bg2:#13131e;--bg3:#1a1a28;--bg4:#222233;
  --border:rgba(255,255,255,.07);--border2:rgba(255,255,255,.12);
  --accent:#5b5cff;--accent-h:#7475ff;--accent2:#00e5a0;
  --text:#eeeef8;--text2:#8888a8;--text3:#44445a;
  --sidebar-w:220px;
}
body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;display:flex;}

/* ── Sidebar ── */
.sidebar{width:var(--sidebar-w);min-height:100vh;background:var(--bg2);border-right:1px solid var(--border);display:flex;flex-direction:column;position:fixed;top:0;left:0;bottom:0;z-index:50;}
.sidebar-logo{display:flex;align-items:center;gap:10px;padding:20px 18px 16px;border-bottom:1px solid var(--border);}
.sidebar-logo-icon{width:30px;height:30px;background:var(--accent);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:15px;}
.sidebar-logo-text{font-family:'Plus Jakarta Sans',sans-serif;font-size:15px;font-weight:700;}

.sidebar-nav{flex:1;padding:12px 10px;overflow-y:auto;}
.nav-section{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--text3);padding:14px 10px 6px;}
.nav-item{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:10px;cursor:pointer;color:var(--text2);font-size:13.5px;font-weight:500;text-decoration:none;transition:all .15s;margin-bottom:2px;}
.nav-item:hover{background:var(--bg3);color:var(--text);}
.nav-item.active{background:rgba(91,92,255,.15);color:var(--accent);}
.nav-item .icon{font-size:16px;width:20px;text-align:center;}

.sidebar-bottom{padding:14px 10px;border-top:1px solid var(--border);}
.user-card{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;cursor:pointer;transition:background .15s;}
.user-card:hover{background:var(--bg3);}
.user-avatar{width:32px;height:32px;border-radius:50%;object-fit:cover;border:2px solid var(--accent);}
.user-avatar-placeholder{width:32px;height:32px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:#fff;}
.user-info{flex:1;min-width:0;}
.user-name{font-size:13px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.user-plan{font-size:11px;color:var(--text2);}
.plan-badge{display:inline-block;background:var(--accent);color:#fff;font-size:10px;padding:1px 6px;border-radius:99px;font-weight:700;margin-left:4px;}

.words-bar{padding:10px 12px;margin-bottom:4px;}
.words-label{display:flex;justify-content:space-between;font-size:11px;color:var(--text2);margin-bottom:6px;}
.words-track{height:4px;background:var(--bg4);border-radius:99px;overflow:hidden;}
.words-fill{height:100%;background:var(--accent2);border-radius:99px;transition:width .3s;}

.upgrade-btn{display:flex;align-items:center;justify-content:center;gap:6px;width:100%;padding:9px;background:var(--accent);color:#fff;border:none;border-radius:10px;font-size:13px;font-weight:600;cursor:pointer;margin-bottom:10px;transition:background .2s;}
.upgrade-btn:hover{background:var(--accent-h);}

/* ── Main area ── */
.main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh;}
.topbar{height:52px;background:var(--bg2);border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;padding:0 28px;position:sticky;top:0;z-index:40;}
.topbar-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:16px;font-weight:700;}
.content{padding:32px 28px;flex:1;}

/* ── Tool area ── */
.tool-header{margin-bottom:24px;}
.tool-title{font-family:'Plus Jakarta Sans',sans-serif;font-size:26px;font-weight:700;margin-bottom:4px;}
.tool-sub{color:var(--accent2);font-size:13px;font-weight:500;}

.tool-panel{background:var(--bg2);border:1px solid var(--border2);border-radius:14px;overflow:hidden;margin-bottom:20px;}
.panel-header{display:flex;align-items:center;justify-content:space-between;padding:12px 18px;border-bottom:1px solid var(--border);background:var(--bg3);}
.panel-label{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--text2);display:flex;align-items:center;gap:6px;}
.panel-actions{display:flex;gap:8px;}
.panel-btn{padding:5px 12px;border-radius:8px;font-size:12px;font-weight:600;cursor:pointer;border:none;background:var(--bg4);color:var(--text2);transition:all .15s;}
.panel-btn:hover{background:var(--border2);color:var(--text);}
textarea.tool-input{width:100%;min-height:200px;background:transparent;border:none;color:var(--text);font-size:14px;font-family:'Inter',sans-serif;line-height:1.7;padding:18px;resize:none;outline:none;}
textarea.tool-input::placeholder{color:var(--text3);}
.panel-footer{display:flex;align-items:center;justify-content:space-between;padding:10px 18px;border-top:1px solid var(--border);font-size:12px;color:var(--text3);}

.tool-actions{display:flex;align-items:center;gap:10px;margin-bottom:20px;}
.action-btn{display:flex;align-items:center;gap:7px;padding:10px 20px;border-radius:10px;font-size:13.5px;font-weight:600;cursor:pointer;border:none;transition:all .2s;}
.action-btn-primary{background:var(--accent);color:#fff;}
.action-btn-primary:hover{background:var(--accent-h);transform:translateY(-1px);}
.action-btn-secondary{background:var(--bg3);color:var(--text2);border:1px solid var(--border2);}
.action-btn-secondary:hover{background:var(--bg4);color:var(--text);}

/* Tool grid (for overview) */
.tools-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:14px;margin-top:20px;}
.tool-card{background:var(--bg2);border:1px solid var(--border);border-radius:14px;padding:20px;cursor:pointer;transition:all .2s;text-decoration:none;color:var(--text);}
.tool-card:hover{border-color:var(--accent);background:var(--bg3);transform:translateY(-2px);}
.tool-card-icon{font-size:26px;margin-bottom:10px;}
.tool-card-name{font-size:14px;font-weight:600;margin-bottom:4px;}
.tool-card-desc{font-size:12px;color:var(--text2);line-height:1.5;}
.tool-card-badge{display:inline-block;font-size:10px;font-weight:700;padding:2px 7px;border-radius:99px;margin-top:8px;}
.badge-free{background:rgba(0,229,160,.15);color:var(--accent2);}
.badge-ai{background:rgba(91,92,255,.15);color:var(--accent);}
.badge-hot{background:rgba(255,107,107,.15);color:#ff6b6b;}

@media(max-width:768px){
  .sidebar{transform:translateX(-100%);transition:transform .3s;}
  .sidebar.open{transform:translateX(0);}
  .main{margin-left:0;}
}
</style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="sidebar-logo-icon">📄</div>
    <span class="sidebar-logo-text">PDFTash</span>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section">Main</div>
    <a class="nav-item active" href="/dashboard" onclick="showSection('overview',this)">
      <span class="icon">🏠</span> Overview
    </a>

    <div class="nav-section">PDF Tools</div>
    <a class="nav-item" href="#" onclick="showSection('compress',this)">
      <span class="icon">🗜️</span> Compress
    </a>
    <a class="nav-item" href="#" onclick="showSection('merge',this)">
      <span class="icon">🔗</span> Merge
    </a>
    <a class="nav-item" href="#" onclick="showSection('split',this)">
      <span class="icon">✂️</span> Split
    </a>
    <a class="nav-item" href="#" onclick="showSection('sign',this)">
      <span class="icon">✍️</span> Sign PDF
    </a>

    <div class="nav-section">AI Tools</div>
    <a class="nav-item" href="#" onclick="showSection('chat',this)">
      <span class="icon">💬</span> Chat with PDF
    </a>
    <a class="nav-item" href="#" onclick="showSection('translate',this)">
      <span class="icon">🌐</span> Translate
    </a>
    <a class="nav-item" href="#" onclick="showSection('summarize',this)">
      <span class="icon">📝</span> Summarize
    </a>

    <div class="nav-section">Account</div>
    <a class="nav-item" href="/" >
      <span class="icon">🏠</span> Home
    </a>
  </nav>

  <div class="sidebar-bottom">
    @if(auth()->user()->plan === 'pro')
    <div class="words-bar">
      <div class="words-label">
        <span style="color:var(--accent2);">⚡ Pro Plan</span>
        <span style="color:var(--accent2);">Unlimited</span>
      </div>
      <div class="words-track">
        <div class="words-fill" style="width:100%;background:var(--accent2);"></div>
      </div>
    </div>
    @else
    <div class="words-bar">
      <div class="words-label">
        <span>📄 PDF tools today</span>
        <span id="pdf-remaining-label">… / 3</span>
      </div>
      <div class="words-track">
        <div class="words-fill" id="pdf-fill" style="width:0%"></div>
      </div>
    </div>
    <div class="words-bar" style="padding-top:0">
      <div class="words-label">
        <span>🤖 AI tools today</span>
        <span id="ai-remaining-label">… / 1</span>
      </div>
      <div class="words-track">
        <div class="words-fill" id="ai-fill" style="width:0%"></div>
      </div>
    </div>
    <button class="upgrade-btn" onclick="window.location.href='/#pricing'">
      ⚡ Upgrade to Pro
    </button>
    @endif

    <div class="user-card">
      @if(auth()->user()->avatar)
        <img src="{{ auth()->user()->avatar }}" class="user-avatar" alt="{{ auth()->user()->name }}">
      @else
        <div class="user-avatar-placeholder">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
      @endif
      <div class="user-info">
        <div class="user-name">{{ auth()->user()->name }}</div>
        <div class="user-plan">
          {{ ucfirst(auth()->user()->plan) }} plan
          @if(auth()->user()->plan === 'pro')
            <span class="plan-badge">PRO</span>
          @endif
        </div>
      </div>
    </div>

    <form method="POST" action="/logout" style="margin-top:6px;">
      @csrf
      <button type="submit" style="width:100%;padding:8px;background:transparent;color:var(--text3);border:1px solid var(--border);border-radius:10px;cursor:pointer;font-size:12px;transition:all .2s;" onmouseover="this.style.color='var(--text)'" onmouseout="this.style.color='var(--text3)'">
        Sign out
      </button>
    </form>
  </div>
</aside>

<!-- Main Content -->
<div class="main">
  <div class="topbar">
    <div class="topbar-title" id="topbar-title">Overview</div>
    <div style="display:flex;align-items:center;gap:12px;">
      @if(auth()->user()->plan !== 'pro')
      <button onclick="window.location.href='/#pricing'" style="display:flex;align-items:center;gap:6px;padding:7px 16px;background:var(--accent);color:#fff;border:none;border-radius:99px;font-size:13px;font-weight:600;cursor:pointer;">
        ⚡ Upgrade plan
      </button>
      @endif
    </div>
  </div>

  <div class="content">

    <!-- Overview Section -->
    <div id="section-overview">
      <div class="tool-header">
        <div class="tool-title">Welcome back, {{ explode(' ', auth()->user()->name)[0] }} 👋</div>
        <div class="tool-sub">Choose a tool to get started</div>
      </div>
      <div class="tools-grid">
        <div class="tool-card" onclick="showSection('compress',null)">
          <div class="tool-card-icon">🗜️</div>
          <div class="tool-card-name">Compress PDF</div>
          <div class="tool-card-desc">Reduce file size without quality loss</div>
          <span class="tool-card-badge badge-free">FREE</span>
        </div>
        <div class="tool-card" onclick="showSection('merge',null)">
          <div class="tool-card-icon">🔗</div>
          <div class="tool-card-name">Merge PDF</div>
          <div class="tool-card-desc">Combine multiple PDFs into one</div>
          <span class="tool-card-badge badge-free">FREE</span>
        </div>
        <div class="tool-card" onclick="showSection('split',null)">
          <div class="tool-card-icon">✂️</div>
          <div class="tool-card-name">Split PDF</div>
          <div class="tool-card-desc">Extract pages from your PDF</div>
          <span class="tool-card-badge badge-free">FREE</span>
        </div>
        <div class="tool-card" onclick="showSection('sign',null)">
          <div class="tool-card-icon">✍️</div>
          <div class="tool-card-name">Sign PDF</div>
          <div class="tool-card-desc">Add digital signature to PDF</div>
          <span class="tool-card-badge badge-free">FREE</span>
        </div>
        <div class="tool-card" onclick="showSection('chat',null)">
          <div class="tool-card-icon">💬</div>
          <div class="tool-card-name">Chat with PDF</div>
          <div class="tool-card-desc">Ask questions using AI</div>
          <span class="tool-card-badge badge-ai">AI</span>
        </div>
        <div class="tool-card" onclick="showSection('translate',null)">
          <div class="tool-card-icon">🌐</div>
          <div class="tool-card-name">Translate PDF</div>
          <div class="tool-card-desc">Translate to 12+ languages</div>
          <span class="tool-card-badge badge-ai">AI</span>
        </div>
        <div class="tool-card" onclick="showSection('summarize',null)">
          <div class="tool-card-icon">📝</div>
          <div class="tool-card-name">Summarize PDF</div>
          <div class="tool-card-desc">Get key points with AI</div>
          <span class="tool-card-badge badge-ai">AI</span>
        </div>
      </div>
    </div>

    <!-- Compress Section -->
    <div id="section-compress" style="display:none;">
      <div class="tool-header">
        <div class="tool-title">Compress PDF</div>
        <div class="tool-sub">Reduce file size without losing quality</div>
      </div>
      <div class="tool-panel">
        <div class="panel-header">
          <span class="panel-label">📄 INPUT</span>
          <div class="panel-actions">
            <button class="panel-btn" onclick="document.getElementById('compress-input').click()">Choose File</button>
            <input type="file" id="compress-input" accept=".pdf" style="display:none" onchange="handleCompress(this)">
          </div>
        </div>
        <div style="padding:40px;text-align:center;color:var(--text3);cursor:pointer;" id="compress-drop" onclick="document.getElementById('compress-input').click()">
          <div style="font-size:36px;margin-bottom:10px">📄</div>
          <div style="font-size:14px;">Drop PDF here or click to browse</div>
          <div style="font-size:12px;margin-top:4px;">Max 10MB free</div>
        </div>
        <div id="compress-file-info" style="display:none;padding:16px 18px;border-top:1px solid var(--border);font-size:13px;color:var(--text2);"></div>
      </div>
      <div class="tool-actions">
        <button class="action-btn action-btn-primary" onclick="runCompress()">🗜️ Compress PDF</button>
      </div>
      <div id="compress-result"></div>
    </div>

    <!-- Merge Section -->
    <div id="section-merge" style="display:none;">
      <div class="tool-header">
        <div class="tool-title">Merge PDF</div>
        <div class="tool-sub">Combine multiple PDFs into one file</div>
      </div>
      <div class="tool-panel">
        <div class="panel-header">
          <span class="panel-label">📄 INPUT FILES</span>
          <div class="panel-actions">
            <button class="panel-btn" onclick="document.getElementById('merge-input').click()">Add Files</button>
            <input type="file" id="merge-input" accept=".pdf" multiple style="display:none" onchange="addMergeFiles(this)">
          </div>
        </div>
        <div id="merge-list" style="padding:16px 18px;min-height:80px;color:var(--text3);font-size:13px;">No files selected yet.</div>
      </div>
      <div class="tool-actions">
        <button class="action-btn action-btn-primary" onclick="runMerge()">🔗 Merge PDFs</button>
      </div>
      <div id="merge-result"></div>
    </div>

    <!-- Split Section -->
    <div id="section-split" style="display:none;">
      <div class="tool-header">
        <div class="tool-title">Split PDF</div>
        <div class="tool-sub">Extract specific pages from your PDF</div>
      </div>
      <div class="tool-panel">
        <div class="panel-header">
          <span class="panel-label">📄 INPUT</span>
          <div class="panel-actions">
            <button class="panel-btn" onclick="document.getElementById('split-input').click()">Choose File</button>
            <input type="file" id="split-input" accept=".pdf" style="display:none" onchange="handleSplit(this)">
          </div>
        </div>
        <div id="split-drop" style="padding:40px;text-align:center;color:var(--text3);cursor:pointer;" onclick="document.getElementById('split-input').click()">
          <div style="font-size:36px;margin-bottom:10px">✂️</div>
          <div style="font-size:14px;">Drop PDF here or click to browse</div>
        </div>
        <div id="split-options" style="display:none;padding:16px 18px;border-top:1px solid var(--border);">
          <label style="font-size:12px;font-weight:600;color:var(--text2);text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:8px;">Page range (e.g. 1-3, 5, 7-9)</label>
          <input type="text" id="split-pages" placeholder="e.g. 1-3, 5, 7-9" style="width:100%;max-width:300px;padding:9px 14px;background:var(--bg3);border:1px solid var(--border2);border-radius:8px;color:var(--text);font-size:14px;outline:none;">
        </div>
      </div>
      <div class="tool-actions">
        <button class="action-btn action-btn-primary" onclick="runSplit()">✂️ Split PDF</button>
      </div>
      <div id="split-result"></div>
    </div>

    <!-- Sign Section -->
    <div id="section-sign" style="display:none;">
      <div class="tool-header">
        <div class="tool-title">Sign PDF</div>
        <div class="tool-sub">Add digital signature to your PDF</div>
      </div>
      <div class="tool-panel">
        <div class="panel-header">
          <span class="panel-label">📄 INPUT</span>
          <div class="panel-actions">
            <button class="panel-btn" onclick="document.getElementById('sign-input').click()">Choose File</button>
            <input type="file" id="sign-input" accept=".pdf" style="display:none" onchange="handleSign(this)">
          </div>
        </div>
        <div id="sign-drop" style="padding:40px;text-align:center;color:var(--text3);cursor:pointer;" onclick="document.getElementById('sign-input').click()">
          <div style="font-size:36px;margin-bottom:10px">✍️</div>
          <div style="font-size:14px;">Drop PDF here or click to browse</div>
        </div>
        <div id="sign-options" style="display:none;padding:16px 18px;border-top:1px solid var(--border);display:none;">
          <div style="display:flex;gap:16px;flex-wrap:wrap;">
            <div style="flex:1;min-width:200px;">
              <label style="font-size:12px;font-weight:600;color:var(--text2);text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:8px;">Signature type</label>
              <select id="sign-type-select" style="width:100%;padding:9px 14px;background:var(--bg3);border:1px solid var(--border2);border-radius:8px;color:var(--text);font-size:14px;outline:none;">
                <option value="text">Type signature</option>
                <option value="image">Upload image</option>
              </select>
            </div>
            <div style="flex:1;min-width:200px;" id="sign-text-wrap">
              <label style="font-size:12px;font-weight:600;color:var(--text2);text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:8px;">Your name</label>
              <input type="text" id="sign-name" placeholder="e.g. John Smith" style="width:100%;padding:9px 14px;background:var(--bg3);border:1px solid var(--border2);border-radius:8px;color:var(--text);font-size:14px;outline:none;">
            </div>
          </div>
        </div>
      </div>
      <div class="tool-actions">
        <button class="action-btn action-btn-primary" onclick="runSign()">✍️ Sign PDF</button>
      </div>
      <div id="sign-result"></div>
    </div>

    <!-- Chat Section -->
    <div id="section-chat" style="display:none;">
      <div class="tool-header">
        <div class="tool-title">Chat with PDF</div>
        <div class="tool-sub">Ask questions about your document using AI</div>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
        <div class="tool-panel">
          <div class="panel-header"><span class="panel-label">📄 UPLOAD PDF</span></div>
          <div style="padding:30px;text-align:center;color:var(--text3);cursor:pointer;" onclick="document.getElementById('chat-input').click()">
            <div style="font-size:30px;margin-bottom:8px" id="chat-file-icon">📄</div>
            <div style="font-size:13px;" id="chat-file-name">Click to upload PDF</div>
            <input type="file" id="chat-input" accept=".pdf" style="display:none" onchange="uploadChatFile(this)">
          </div>
        </div>
        <div class="tool-panel" style="display:flex;flex-direction:column;">
          <div class="panel-header"><span class="panel-label">💬 CONVERSATION</span></div>
          <div id="chat-messages" style="flex:1;padding:16px;min-height:150px;max-height:300px;overflow-y:auto;font-size:13px;"></div>
          <div style="padding:12px;border-top:1px solid var(--border);display:flex;gap:8px;">
            <input type="text" id="chat-q" placeholder="Ask anything about your PDF..." onkeydown="if(event.key==='Enter')sendChatMsg()" style="flex:1;padding:9px 14px;background:var(--bg3);border:1px solid var(--border2);border-radius:8px;color:var(--text);font-size:13px;outline:none;">
            <button onclick="sendChatMsg()" style="padding:9px 16px;background:var(--accent);color:#fff;border:none;border-radius:8px;font-weight:600;cursor:pointer;font-size:13px;">Send</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Translate Section -->
    <div id="section-translate" style="display:none;">
      <div class="tool-header">
        <div class="tool-title">Translate PDF</div>
        <div class="tool-sub">Translate your PDF to 12+ languages using AI</div>
      </div>
      <div class="tool-panel">
        <div class="panel-header">
          <span class="panel-label">📄 INPUT</span>
          <div class="panel-actions">
            <select id="translate-lang" style="padding:5px 10px;background:var(--bg4);border:1px solid var(--border2);border-radius:8px;color:var(--text);font-size:12px;outline:none;">
              <option value="Bengali">Bengali</option>
              <option value="Hindi">Hindi</option>
              <option value="Arabic">Arabic</option>
              <option value="Spanish">Spanish</option>
              <option value="French">French</option>
              <option value="German">German</option>
              <option value="Chinese">Chinese</option>
              <option value="Japanese">Japanese</option>
              <option value="English">English</option>
            </select>
            <button class="panel-btn" onclick="document.getElementById('translate-input').click()">Choose File</button>
            <input type="file" id="translate-input" accept=".pdf" style="display:none" onchange="handleTranslate(this)">
          </div>
        </div>
        <div id="translate-drop" style="padding:40px;text-align:center;color:var(--text3);cursor:pointer;" onclick="document.getElementById('translate-input').click()">
          <div style="font-size:36px;margin-bottom:10px">🌐</div>
          <div style="font-size:14px;">Drop PDF here or click to browse</div>
        </div>
        <div id="translate-output" style="display:none;padding:18px;border-top:1px solid var(--border);font-size:14px;color:var(--text);line-height:1.7;max-height:400px;overflow-y:auto;white-space:pre-wrap;"></div>
      </div>
      <div class="tool-actions">
        <button class="action-btn action-btn-primary" onclick="runTranslate()">🌐 Translate PDF</button>
      </div>
      <div id="translate-result"></div>
    </div>

    <!-- Summarize Section -->
    <div id="section-summarize" style="display:none;">
      <div class="tool-header">
        <div class="tool-title">Summarize PDF</div>
        <div class="tool-sub">Get key points from your PDF using AI</div>
      </div>
      <div class="tool-panel">
        <div class="panel-header">
          <span class="panel-label">📄 INPUT</span>
          <div class="panel-actions">
            <button class="panel-btn" onclick="document.getElementById('summarize-input').click()">Choose File</button>
            <input type="file" id="summarize-input" accept=".pdf" style="display:none" onchange="handleSummarize(this)">
          </div>
        </div>
        <div id="summarize-drop" style="padding:40px;text-align:center;color:var(--text3);cursor:pointer;" onclick="document.getElementById('summarize-input').click()">
          <div style="font-size:36px;margin-bottom:10px">📝</div>
          <div style="font-size:14px;">Drop PDF here or click to browse</div>
        </div>
        <div id="summarize-output" style="display:none;padding:18px;border-top:1px solid var(--border);font-size:14px;color:var(--text);line-height:1.7;max-height:400px;overflow-y:auto;white-space:pre-wrap;"></div>
      </div>
      <div class="tool-actions">
        <button class="action-btn action-btn-primary" onclick="runSummarize()">📝 Summarize PDF</button>
      </div>
      <div id="summarize-result"></div>
    </div>

  </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

// ── Usage counter ──────────────────────────────────────────────────────────
async function loadUsage(){
    try {
        const r = await fetch('/api/usage');
        const d = await r.json();
        if(d.unlimited) return;
        updateBar('pdf', d.pdf?.used||0, d.pdf?.limit||3);
        updateBar('ai',  d.ai?.used||0,  d.ai?.limit||1);
    } catch(e){}
}

function updateBar(group, used, limit){
    const label = document.getElementById(group+'-remaining-label');
    const fill  = document.getElementById(group+'-fill');
    if(!label) return;
    const remaining = Math.max(0, limit - used);
    label.textContent = remaining + ' / ' + limit;
    const pct = Math.min(100, (used / limit) * 100);
    if(fill){
        fill.style.width = pct + '%';
        fill.style.background = pct >= 100 ? '#ff6b6b' : pct >= 60 ? '#ffcc44' : 'var(--accent2)';
    }
}
loadUsage();

// Update usage after each tool call
function updateUsageAfterCall(resp){
    const used      = parseInt(resp.headers.get('X-Tasks-Used') || 0);
    const limit     = parseInt(resp.headers.get('X-Tasks-Limit') || 0);
    const group     = resp.headers.get('X-Tasks-Group');
    if(!group || !limit) return;
    updateBar(group, used, limit);
}

// ── Navigation ─────────────────────────────────────────────────────────────
const sections = ['overview','compress','merge','split','sign','chat','translate','summarize'];
const titles = {overview:'Overview',compress:'Compress PDF',merge:'Merge PDF',split:'Split PDF',sign:'Sign PDF',chat:'Chat with PDF',translate:'Translate PDF',summarize:'Summarize PDF'};

function showSection(name, el){
    sections.forEach(s => {
        const sec = document.getElementById('section-'+s);
        if(sec) sec.style.display = s === name ? 'block' : 'none';
    });
    document.getElementById('topbar-title').textContent = titles[name] || name;
    document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
    if(el) el.classList.add('active');
    if(name !== 'overview') event?.preventDefault();
}

// ── Result helper ──────────────────────────────────────────────────────────
function showResult(containerId, html){ document.getElementById(containerId).innerHTML = html; }
function resultSuccess(msg, downloadUrl, filename){
    return `<div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-top:16px;">
        <div style="color:#00e5a0;font-size:16px;font-weight:700;margin-bottom:10px">${msg}</div>
        <a href="${downloadUrl}" download="${filename}" style="display:inline-block;padding:11px 26px;background:var(--accent);color:#fff;border-radius:99px;text-decoration:none;font-weight:600;font-size:13px;">⬇️ Download</a>
    </div>`;
}
function resultError(msg){
    return `<div style="background:#1a0a0a;border:1px solid #ff6b6b;border-radius:12px;padding:16px;margin-top:16px;color:#ff6b6b;font-size:14px;">${msg}</div>`;
}
function resultLoading(msg){
    return `<div style="padding:20px;color:var(--text2);font-size:14px;">⏳ ${msg}</div>`;
}

// ── Compress ───────────────────────────────────────────────────────────────
let compressFile = null;
function handleCompress(input){
    compressFile = input.files[0];
    document.getElementById('compress-drop').innerHTML = `<div style="font-size:14px;color:var(--accent2)">✅ ${compressFile.name}</div>`;
    document.getElementById('compress-file-info').style.display='block';
    document.getElementById('compress-file-info').textContent = `Size: ${(compressFile.size/1024).toFixed(0)} KB`;
}
async function runCompress(){
    if(!compressFile) return alert('Please select a PDF first.');
    showResult('compress-result', resultLoading('Compressing your PDF...'));
    const fd = new FormData();
    fd.append('file', compressFile);
    try {
        const r = await fetch('/api/pdf/compress', {method:'POST', body:fd});
        updateUsageAfterCall(r);
        if(r.ok){ const b=await r.blob(); showResult('compress-result', resultSuccess(`Compressed! ${(compressFile.size/1024).toFixed(0)}KB → ${(b.size/1024).toFixed(0)}KB`, URL.createObjectURL(b), 'compressed.pdf')); }
        else { const d=await r.json(); showResult('compress-result', resultError(d.error||'Compression failed')); }
    } catch(e){ showResult('compress-result', resultError('Connection error.')); }
}

// ── Merge ──────────────────────────────────────────────────────────────────
let mergeFiles = [];
function addMergeFiles(input){
    mergeFiles = mergeFiles.concat(Array.from(input.files));
    const list = document.getElementById('merge-list');
    list.innerHTML = mergeFiles.length
        ? mergeFiles.map((f,i)=>`<div style="display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--border);font-size:13px;color:var(--text2);">
            <span>📄 ${f.name}</span>
            <button onclick="mergeFiles.splice(${i},1);addMergeFiles({files:[]})" style="background:transparent;border:none;color:var(--text3);cursor:pointer;">×</button></div>`).join('')
        : 'No files selected yet.';
}
async function runMerge(){
    if(mergeFiles.length < 2) return alert('Please select at least 2 PDF files.');
    showResult('merge-result', resultLoading('Merging your PDFs...'));
    const fd = new FormData();
    mergeFiles.forEach(f => fd.append('files[]', f));
    try {
        const r = await fetch('/api/pdf/merge', {method:'POST', body:fd});
        updateUsageAfterCall(r);
        if(r.ok){ const b=await r.blob(); showResult('merge-result', resultSuccess(`Merged ${mergeFiles.length} files!`, URL.createObjectURL(b), 'merged.pdf')); }
        else { const d=await r.json(); showResult('merge-result', resultError(d.error||'Merge failed')); }
    } catch(e){ showResult('merge-result', resultError('Connection error.')); }
}

// ── Split ──────────────────────────────────────────────────────────────────
let splitFile = null;
function handleSplit(input){
    splitFile = input.files[0];
    document.getElementById('split-drop').innerHTML = `<div style="font-size:14px;color:var(--accent2)">✅ ${splitFile.name}</div>`;
    document.getElementById('split-options').style.display='block';
}
async function runSplit(){
    if(!splitFile) return alert('Please select a PDF first.');
    showResult('split-result', resultLoading('Splitting your PDF...'));
    const fd = new FormData();
    fd.append('file', splitFile);
    fd.append('pages', document.getElementById('split-pages').value || 'all');
    try {
        const r = await fetch('/api/pdf/split', {method:'POST', body:fd});
        updateUsageAfterCall(r);
        if(r.ok){ const b=await r.blob(); showResult('split-result', resultSuccess('Split successfully!', URL.createObjectURL(b), 'split.pdf')); }
        else { const d=await r.json(); showResult('split-result', resultError(d.error||'Split failed')); }
    } catch(e){ showResult('split-result', resultError('Connection error.')); }
}

// ── Sign ───────────────────────────────────────────────────────────────────
let signFile = null;
function handleSign(input){
    signFile = input.files[0];
    document.getElementById('sign-drop').innerHTML = `<div style="font-size:14px;color:var(--accent2)">✅ ${signFile.name}</div>`;
    document.getElementById('sign-options').style.display='block';
}
async function runSign(){
    if(!signFile) return alert('Please select a PDF first.');
    showResult('sign-result', resultLoading('Applying signature...'));
    const fd = new FormData();
    fd.append('file', signFile);
    fd.append('sign_type', document.getElementById('sign-type-select').value);
    fd.append('sign_text', document.getElementById('sign-name').value || 'Signature');
    fd.append('placement','last'); fd.append('x',10); fd.append('y',85); fd.append('width',150); fd.append('height',50);
    try {
        const r = await fetch('/api/pdf/sign', {method:'POST', body:fd});
        updateUsageAfterCall(r);
        if(r.ok){ const b=await r.blob(); showResult('sign-result', resultSuccess('Signed successfully!', URL.createObjectURL(b), 'signed.pdf')); }
        else { const d=await r.json(); showResult('sign-result', resultError(d.error||'Sign failed')); }
    } catch(e){ showResult('sign-result', resultError('Connection error.')); }
}

// ── Chat ───────────────────────────────────────────────────────────────────
let chatFileId = null;
async function uploadChatFile(input){
    const f = input.files[0]; if(!f) return;
    document.getElementById('chat-file-icon').textContent='⏳';
    document.getElementById('chat-file-name').textContent='Uploading...';
    const fd = new FormData(); fd.append('file', f);
    try {
        const r = await fetch('/api/ai/upload-for-chat', {method:'POST', body:fd});
        const d = await r.json();
        chatFileId = d.file_id || d.id;
        document.getElementById('chat-file-icon').textContent='✅';
        document.getElementById('chat-file-name').textContent=f.name;
        addChatMsg('ai','PDF uploaded! Ask me anything about this document.');
    } catch(e){ document.getElementById('chat-file-name').textContent='Upload failed.'; }
}
function addChatMsg(role,text){
    const msgs = document.getElementById('chat-messages');
    const color = role==='user'?'var(--accent)':'var(--accent2)';
    const label = role==='user'?'You':'AI';
    msgs.innerHTML += `<div style="margin-bottom:10px;"><span style="color:${color};font-weight:700;font-size:11px;">${label}</span><div style="margin-top:3px;color:var(--text);line-height:1.6;">${text}</div></div>`;
    msgs.scrollTop = msgs.scrollHeight;
}
async function sendChatMsg(){
    const q = document.getElementById('chat-q').value.trim();
    if(!q||!chatFileId) return;
    document.getElementById('chat-q').value='';
    addChatMsg('user',q); addChatMsg('ai','⏳ Thinking...');
    const fd = new FormData(); fd.append('file_id',chatFileId); fd.append('message',q);
    try {
        const r = await fetch('/api/ai/chat',{method:'POST',body:fd});
        const d = await r.json();
        const msgs = document.getElementById('chat-messages');
        msgs.lastElementChild.querySelector('div').textContent = d.reply||d.response||d.error||'No response';
    } catch(e){ document.getElementById('chat-messages').lastElementChild.querySelector('div').textContent='Error.'; }
}

// ── Translate ──────────────────────────────────────────────────────────────
let translateFile = null;
function handleTranslate(input){
    translateFile = input.files[0];
    document.getElementById('translate-drop').innerHTML = `<div style="font-size:14px;color:var(--accent2)">✅ ${translateFile.name}</div>`;
}
async function runTranslate(){
    if(!translateFile) return alert('Please select a PDF first.');
    showResult('translate-result', resultLoading('Translating with AI...'));
    const fd = new FormData(); fd.append('file', translateFile); fd.append('language', document.getElementById('translate-lang').value);
    try {
        const r = await fetch('/api/ai/translate',{method:'POST',body:fd});
        updateUsageAfterCall(r);
        if(r.ok){ const d=await r.json(); document.getElementById('translate-output').style.display='block'; document.getElementById('translate-output').textContent=d.translation||d.text||''; showResult('translate-result',''); }
        else { const d=await r.json(); showResult('translate-result', resultError(d.error||'Translation failed')); }
    } catch(e){ showResult('translate-result', resultError('Connection error.')); }
}

// ── Summarize ──────────────────────────────────────────────────────────────
let summarizeFile = null;
function handleSummarize(input){
    summarizeFile = input.files[0];
    document.getElementById('summarize-drop').innerHTML = `<div style="font-size:14px;color:var(--accent2)">✅ ${summarizeFile.name}</div>`;
}
async function runSummarize(){
    if(!summarizeFile) return alert('Please select a PDF first.');
    showResult('summarize-result', resultLoading('Summarizing with AI...'));
    const fd = new FormData(); fd.append('file', summarizeFile);
    try {
        const r = await fetch('/api/ai/summarize',{method:'POST',body:fd});
        updateUsageAfterCall(r);
        if(r.ok){ const d=await r.json(); document.getElementById('summarize-output').style.display='block'; document.getElementById('summarize-output').textContent=d.summary||d.text||''; showResult('summarize-result',''); }
        else { const d=await r.json(); showResult('summarize-result', resultError(d.error||'Summarize failed')); }
    } catch(e){ showResult('summarize-result', resultError('Connection error.')); }
}
</script>
</body>
</html>
