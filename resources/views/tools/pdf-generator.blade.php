@extends('tools.layout')

@section('title', 'AI PDF Generator — Create Beautiful PDF from Text')
@section('description', 'Generate beautiful, professional PDF documents from text using AI. Choose themes, layouts and download instantly. Free online AI PDF creator.')
@section('keywords', 'ai pdf generator, text to pdf, ai document generator, create pdf from text, pdf maker online free, gamma alternative, ai pdf creator')
@section('slug', 'ai-pdf-generator')

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash AI PDF Generator",
  "applicationCategory": "WebApplication",
  "description": "Generate beautiful PDF documents from text using AI. Free online tool.",
  "url": "https://pdftash.com/ai-pdf-generator",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"}
}
</script>
@endsection

@section('content')
<div class="hero">
  <div class="badge">✨ AI PDF Generator</div>
  <h1>Create Beautiful PDF from Text</h1>
  <p>Type your topic or paste your content — AI structures, designs and generates a professional PDF in seconds.</p>
</div>

<div class="tool-box" style="max-width:760px;">

  {{-- Mode toggle --}}
  <div style="display:flex;gap:0;margin-bottom:24px;border:1px solid rgba(255,255,255,.12);border-radius:10px;overflow:hidden;">
    <button id="tab-doc" onclick="setMode('document')"
      style="flex:1;padding:11px;background:rgba(91,92,255,.2);color:#9898ff;border:none;font-size:13px;font-weight:700;cursor:pointer;border-right:1px solid rgba(255,255,255,.1);">
      📝 Document / Article
    </button>
    <button id="tab-tbl" onclick="setMode('table')"
      style="flex:1;padding:11px;background:transparent;color:#8888a8;border:none;font-size:13px;font-weight:600;cursor:pointer;">
      📊 Table / Statement
    </button>
  </div>

  {{-- Document mode --}}
  <div id="mode-document">
    <div style="margin-bottom:20px;">
      <label style="color:#eeeef8;font-size:14px;font-weight:600;display:block;margin-bottom:8px;">
        📝 Your topic or content
      </label>
      <textarea id="topic" rows="6" placeholder="Examples:
• The benefits of renewable energy
• How to start a small business in Bangladesh
• Artificial Intelligence in healthcare
• Paste your own notes or draft text here..."
        style="width:100%;padding:14px 16px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:12px;color:#eeeef8;font-size:14px;font-family:'Inter',sans-serif;resize:vertical;line-height:1.6;"></textarea>
      <div style="display:flex;justify-content:space-between;margin-top:6px;">
        <span style="color:#44445a;font-size:12px;">Minimum 10 characters</span>
        <span id="char-count" style="color:#44445a;font-size:12px;">0 characters</span>
      </div>
    </div>
  </div>

  {{-- Table mode --}}
  <div id="mode-table" style="display:none;">

    {{-- Title --}}
    <div style="margin-bottom:16px;">
      <label style="color:#eeeef8;font-size:13px;font-weight:600;display:block;margin-bottom:6px;">Document Title <span style="color:#ff6b6b">*</span></label>
      <input id="tbl-title" type="text" placeholder="e.g. Bank Statement May 2026"
        style="width:100%;padding:11px 14px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:10px;color:#eeeef8;font-size:13px;font-family:'Inter',sans-serif;">
    </div>

    {{-- Subtitle --}}
    <div style="margin-bottom:16px;">
      <label style="color:#eeeef8;font-size:13px;font-weight:600;display:block;margin-bottom:6px;">Subtitle / Description <span style="color:#44445a;font-size:11px">(optional)</span></label>
      <input id="tbl-subtitle" type="text" placeholder="e.g. Account: 1234-5678 · Period: 01 May – 31 May 2026"
        style="width:100%;padding:11px 14px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:10px;color:#eeeef8;font-size:13px;font-family:'Inter',sans-serif;">
    </div>

    {{-- Columns --}}
    <div style="margin-bottom:16px;">
      <label style="color:#eeeef8;font-size:13px;font-weight:600;display:block;margin-bottom:6px;">Column Names <span style="color:#ff6b6b">*</span> <span style="color:#44445a;font-size:11px">(comma-separated)</span></label>
      <input id="tbl-columns" type="text" placeholder="e.g. Date, Description, Debit, Credit, Balance"
        style="width:100%;padding:11px 14px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:10px;color:#eeeef8;font-size:13px;font-family:'Inter',sans-serif;">
      <div style="margin-top:6px;display:flex;gap:6px;flex-wrap:wrap;" id="col-presets">
        @foreach([
          'Date, Amount' => 'Date, Amount',
          'Date, Description, Amount' => 'Date, Description, Amount',
          'Date, Debit, Credit, Balance' => 'Date, Debit, Credit, Balance',
          'Item, Qty, Unit Price, Total' => 'Item, Qty, Unit Price, Total',
          'Name, Department, Salary' => 'Name, Department, Salary',
        ] as $label => $val)
        <button onclick="document.getElementById('tbl-columns').value='{{ $val }}'"
          style="padding:3px 10px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:6px;color:#8888a8;font-size:11px;cursor:pointer;">
          {{ $label }}
        </button>
        @endforeach
      </div>
    </div>

    {{-- Data rows --}}
    <div style="margin-bottom:16px;">
      <label style="color:#eeeef8;font-size:13px;font-weight:600;display:block;margin-bottom:6px;">
        Data Rows <span style="color:#ff6b6b">*</span>
        <span style="color:#44445a;font-size:11px">(one row per line, values separated by commas)</span>
      </label>
      <textarea id="tbl-rows" rows="8"
        placeholder="12/05/2026, Transfer In, , 300000, 1500000
13/05/2026, Utility Bill, 50000, , 1450000
14/05/2026, Salary, , 500000, 1950000
19/05/2026, Withdrawal, 300000, , 1650000
19/05/2026, Interest, , 200000, 1850000"
        style="width:100%;padding:14px 16px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:12px;color:#eeeef8;font-size:13px;font-family:'Inter',monospace;resize:vertical;line-height:1.7;"></textarea>
      <div style="color:#44445a;font-size:11px;margin-top:5px;">Tip: Leave a cell empty with a comma (e.g. <code style="color:#9898ff">,300000,</code>) · Numbers are auto-totalled</div>
    </div>

    {{-- Footer note --}}
    <div style="margin-bottom:4px;">
      <label style="color:#eeeef8;font-size:13px;font-weight:600;display:block;margin-bottom:6px;">Footer Note <span style="color:#44445a;font-size:11px">(optional)</span></label>
      <input id="tbl-footer" type="text" placeholder="e.g. All amounts in BDT. Statement generated by system."
        style="width:100%;padding:11px 14px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:10px;color:#eeeef8;font-size:13px;font-family:'Inter',sans-serif;">
    </div>
  </div>

  {{-- Theme Selector --}}
  <div style="margin-bottom:20px;">
    <label style="color:#eeeef8;font-size:14px;font-weight:600;display:block;margin-bottom:10px;">🎨 Theme</label>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
      @foreach([
        ['professional', '#1e40af', '#3b82f6', 'Professional Blue'],
        ['dark',         '#0f172a', '#6366f1', 'Dark'],
        ['green',        '#065f46', '#10b981', 'Emerald Green'],
        ['purple',       '#4c1d95', '#8b5cf6', 'Royal Purple'],
        ['red',          '#991b1b', '#ef4444', 'Bold Red'],
      ] as $th)
      <label style="cursor:pointer;">
        <input type="radio" name="theme" value="{{ $th[0] }}" {{ $th[0]==='professional' ? 'checked' : '' }} style="display:none;">
        <div class="theme-btn" data-theme="{{ $th[0] }}" style="display:flex;align-items:center;gap:8px;padding:8px 14px;background:#0f0f1a;border:2px solid {{ $th[0]==='professional' ? $th[2] : 'rgba(255,255,255,.1)' }};border-radius:99px;font-size:13px;font-weight:500;color:#eeeef8;transition:all .2s;">
          <span style="display:inline-block;width:14px;height:14px;border-radius:50%;background:linear-gradient(135deg,{{ $th[1] }},{{ $th[2] }});flex-shrink:0;"></span>
          {{ $th[3] }}
        </div>
      </label>
      @endforeach
    </div>
  </div>

  {{-- Generate Button --}}
  <div style="text-align:center;margin-bottom:16px;">
    <button type="button" onclick="generatePdf()" id="gen-btn"
      style="padding:16px 40px;background:linear-gradient(135deg,#5b5cff,#7475ff);color:#fff;border:none;border-radius:99px;font-size:16px;font-weight:700;cursor:pointer;transition:all .2s;box-shadow:0 4px 20px rgba(91,92,255,.35);">
      ✨ Generate PDF with AI
    </button>
  </div>

  <div id="result" style="display:none;text-align:center;margin-top:16px;"></div>

  <div style="text-align:center;margin-top:12px;">
    <p style="color:#44445a;font-size:12px;">AI structures your content → Beautiful themed PDF → Instant download</p>
  </div>
</div>

{{-- HOW IT WORKS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">How the AI PDF Generator Works</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
    @foreach([
      ['✍️','Enter Your Text','Type a topic or paste your content. Even rough notes work great.'],
      ['🤖','AI Structures It','Claude AI organizes your content into a title, sections, bullet points and conclusion.'],
      ['⬇️','Download PDF','A beautiful themed PDF is generated and downloaded instantly.'],
    ] as $i => $s)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:24px;text-align:center;">
      <div style="width:32px;height:32px;background:#5b5cff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:14px;margin:0 auto 12px;">{{ $i+1 }}</div>
      <div style="font-size:28px;margin-bottom:10px;">{{ $s[0] }}</div>
      <div style="font-weight:600;margin-bottom:6px;font-size:14px;">{{ $s[1] }}</div>
      <div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $s[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- THEMES PREVIEW --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">5 Beautiful Themes</h2>
  <div style="display:grid;grid-template-columns:repeat(5,1fr);gap:12px;">
    @foreach([
      ['#1e40af','#3b82f6','Professional'],
      ['#0f172a','#6366f1','Dark'],
      ['#065f46','#10b981','Green'],
      ['#4c1d95','#8b5cf6','Purple'],
      ['#991b1b','#ef4444','Red'],
    ] as $th)
    <div style="border-radius:10px;overflow:hidden;border:1px solid rgba(255,255,255,.08);">
      <div style="height:40px;background:{{ $th[0] }};"></div>
      <div style="height:6px;background:{{ $th[1] }};"></div>
      <div style="background:#0f0f1a;padding:8px;text-align:center;font-size:11px;color:#8888a8;">{{ $th[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- USE CASES --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">What Can You Create?</h2>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['📊','Business Reports','Create professional reports, proposals, and presentations from bullet points.'],
      ['🎓','Study Notes','Turn rough notes into structured study guides and summaries.'],
      ['📋','Project Plans','Generate project outlines, timelines, and documentation.'],
      ['📝','Blog to PDF','Convert blog posts or articles into downloadable PDF documents.'],
    ] as $u)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:20px;">
      <div style="font-size:28px;margin-bottom:8px;">{{ $u[0] }}</div>
      <div style="font-weight:600;font-size:14px;margin-bottom:6px;">{{ $u[1] }}</div>
      <div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $u[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>How does the AI PDF Generator work?</h3>
    <p>You enter any topic or text. Our AI (powered by Claude) structures it into a professional document with title, sections, and bullet points, then generates a beautiful themed PDF.</p>
  </div>
  <div class="faq-item">
    <h3>Is this a free Gamma alternative?</h3>
    <p>Yes! PDFTash AI PDF Generator creates beautiful documents similar to Gamma.app — completely free. No signup needed for free users.</p>
  </div>
  <div class="faq-item">
    <h3>What languages are supported?</h3>
    <p>You can enter text in any language including English, Bengali, Hindi, Arabic, and more. The AI will generate the PDF in the same language.</p>
  </div>
  <div class="faq-item">
    <h3>Can I choose a theme/design?</h3>
    <p>Yes! Choose from 5 themes: Professional Blue, Dark, Emerald Green, Royal Purple, and Bold Red. Each theme has a unique header, colors, and style.</p>
  </div>
  <div class="faq-item">
    <h3>How many PDFs can I generate for free?</h3>
    <p>Free users get 1 AI PDF generation per day. Pro users ($9/month) get unlimited generations.</p>
  </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
let currentMode = 'document';

function setMode(mode) {
    currentMode = mode;
    const isDoc = mode === 'document';
    document.getElementById('mode-document').style.display = isDoc ? 'block' : 'none';
    document.getElementById('mode-table').style.display    = isDoc ? 'none'  : 'block';
    document.getElementById('tab-doc').style.background = isDoc ? 'rgba(91,92,255,.2)' : 'transparent';
    document.getElementById('tab-doc').style.color      = isDoc ? '#9898ff' : '#8888a8';
    document.getElementById('tab-tbl').style.background = isDoc ? 'transparent' : 'rgba(91,92,255,.2)';
    document.getElementById('tab-tbl').style.color      = isDoc ? '#8888a8' : '#9898ff';
    document.getElementById('gen-btn').textContent = isDoc ? '✨ Generate PDF with AI' : '📊 Generate Table PDF';
}

// Char counter
document.getElementById('topic').addEventListener('input', function() {
    document.getElementById('char-count').textContent = this.value.length + ' characters';
});

// Theme selector
document.querySelectorAll('.theme-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.theme-btn').forEach(b => b.style.borderColor = 'rgba(255,255,255,.1)');
        const colors = {
            professional: '#3b82f6', dark: '#6366f1', green: '#10b981',
            purple: '#8b5cf6', red: '#ef4444'
        };
        this.style.borderColor = colors[this.dataset.theme] || '#5b5cff';
        this.closest('label').querySelector('input').checked = true;
    });
});

async function generatePdf() {
    const theme  = document.querySelector('input[name="theme"]:checked')?.value || 'professional';
    const btn    = document.getElementById('gen-btn');
    const result = document.getElementById('result');

    const formData = new FormData();
    formData.append('theme', theme);
    formData.append('_token', CSRF);
    formData.append('mode', currentMode);

    if (currentMode === 'table') {
        const title   = document.getElementById('tbl-title').value.trim();
        const columns = document.getElementById('tbl-columns').value.trim();
        const rows    = document.getElementById('tbl-rows').value.trim();
        if (!title)   { alert('Please enter a document title.'); return; }
        if (!columns) { alert('Please enter column names.'); return; }
        if (!rows)    { alert('Please enter at least one data row.'); return; }
        formData.append('title',       title);
        formData.append('subtitle',    document.getElementById('tbl-subtitle').value.trim());
        formData.append('columns',     columns);
        formData.append('rows',        rows);
        formData.append('footer_note', document.getElementById('tbl-footer').value.trim());
    } else {
        const topic = document.getElementById('topic').value.trim();
        if (topic.length < 10) { alert('Please enter at least 10 characters.'); return; }
        formData.append('topic', topic);
    }

    btn.disabled = true;
    btn.textContent = '⏳ Generating...';
    result.style.display = 'block';

    let secs = 0;
    const label = currentMode === 'table' ? '📊 Building your table PDF...' : '🤖 AI is designing your PDF...';
    result.innerHTML = `<div style="color:#8888a8;padding:20px">${label} <span id="timer">0s</span></div>`;
    const interval = setInterval(() => { secs++; const t = document.getElementById('timer'); if(t) t.textContent = secs+'s'; }, 1000);

    const controller = new AbortController();
    const timeout = setTimeout(() => controller.abort(), 120000);

    try {
        const resp = await fetch('/api/ai/generate-pdf', { method:'POST', body:formData, signal:controller.signal });
        clearTimeout(timeout);
        clearInterval(interval);

        if (resp.ok) {
            const blob = await resp.blob();
            const url  = URL.createObjectURL(blob);
            result.innerHTML = `
                <div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:24px;margin-bottom:16px;">
                    <div style="font-size:40px;margin-bottom:12px;">🎉</div>
                    <div style="color:#00e5a0;font-size:20px;font-weight:700;margin-bottom:8px;">PDF Generated in ${secs}s!</div>
                    <div style="color:#8888a8;font-size:14px;margin-bottom:20px;">Your AI-designed PDF is ready to download</div>
                    <a href="${url}" download="pdftash-ai-document.pdf"
                       style="display:inline-block;padding:14px 36px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:700;font-size:15px;">
                       ⬇ Download PDF
                    </a>
                </div>
                <button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px;">
                    Generate Another
                </button>`;
        } else {
            const data = await resp.json().catch(() => ({}));
            if (data.error === 'free_limit_reached') {
                result.innerHTML = `
                    <div style="background:#1a0a0a;border:1px solid #ff6b6b;border-radius:12px;padding:20px;">
                        <div style="color:#ff6b6b;font-weight:700;margin-bottom:8px">Daily limit reached!</div>
                        <div style="color:#8888a8;font-size:14px;margin-bottom:16px">Upgrade to Pro for unlimited AI PDF generation</div>
                        <a href="/#pricing" style="display:inline-block;padding:12px 24px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">Upgrade to Pro →</a>
                    </div>`;
            } else {
                result.innerHTML = `<div style="color:#ff6b6b;padding:16px;">Error: ${data.error || 'Something went wrong. Please try again.'}</div>`;
            }
        }
    } catch(e) {
        clearTimeout(timeout);
        clearInterval(interval);
        result.innerHTML = `<div style="color:#ff6b6b;padding:16px;">${e.name === 'AbortError' ? 'Request timed out. Please try again.' : 'Connection error. Please try again.'}</div>`;
    } finally {
        btn.disabled = false;
        btn.textContent = currentMode === 'table' ? '📊 Generate Table PDF' : '✨ Generate PDF with AI';
    }
}
</script>
@endsection
