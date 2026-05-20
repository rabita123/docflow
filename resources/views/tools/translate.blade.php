@extends('tools.layout')

@section('title', 'Translate PDF Online Free — PDF to Bengali, Hindi, Arabic')
@section('description', 'Translate PDF documents to Bengali, Hindi, Arabic, Spanish and 12+ languages online free. No signup needed. AI-powered translation.')
@section('keywords', 'translate pdf, pdf translator, translate pdf to bengali, pdf to hindi, translate pdf online free')
@section('slug', 'translate-pdf')

@section('content')
<div class="hero">
  <div style="display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin-bottom:24px;">
    <div class="badge">🌐 AI PDF Translator</div>
    <div class="badge" style="background:rgba(255,165,0,.1);border-color:rgba(255,165,0,.4);color:#ffa500;">🔒 Pro Feature</div>
  </div>
  <h1>Translate PDF to Any Language</h1>
  <p>AI-powered PDF translation to Bengali, Hindi, Arabic, Spanish and 12+ languages. Requires a <strong style="color:#ffa500;">Pro plan</strong> — upgrade once, translate unlimited PDFs.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">🌍</div>
    <div class="upload-title">Drop your PDF here to Translate</div>
    <div class="upload-sub">Supports 12+ languages including Bengali · Pro Plan Required</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>

  <div id="options" style="display:none;margin-top:16px;">
    <div style="margin-bottom:12px;">
      <label style="color:#eeeef8;font-size:14px;font-weight:600;display:block;margin-bottom:6px;">Target language</label>
      <select id="lang" style="width:100%;padding:10px 14px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:10px;color:#eeeef8;font-size:14px;">
        <option value="Bengali">Bengali (বাংলা)</option>
        <option value="Hindi">Hindi (हिंदी)</option>
        <option value="Arabic">Arabic (العربية)</option>
        <option value="Spanish">Spanish (Español)</option>
        <option value="French">French (Français)</option>
        <option value="German">German (Deutsch)</option>
        <option value="Chinese">Chinese (中文)</option>
        <option value="Japanese">Japanese (日本語)</option>
        <option value="Portuguese">Portuguese (Português)</option>
        <option value="Russian">Russian (Русский)</option>
        <option value="Italian">Italian (Italiano)</option>
        <option value="English">English</option>
      </select>
    </div>
    <div style="text-align:center;">
      <button type="button" onclick="processTranslate()" style="padding:14px 32px;background:#5b5cff;color:#fff;border:none;border-radius:99px;font-size:15px;font-weight:600;cursor:pointer;">Translate PDF →</button>
    </div>
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Your files are automatically deleted after 2 hours</p>
  </div>
</div>

<div class="features">
  <div class="feature">
    <div class="feature-icon">🇧🇩</div>
    <div class="feature-title">Bengali Support</div>
    <div class="feature-desc">Translate PDF to Bengali accurately with AI</div>
  </div>
  <div class="feature">
    <div class="feature-icon">🌐</div>
    <div class="feature-title">12+ Languages</div>
    <div class="feature-desc">English, Bengali, Hindi, Arabic, Spanish and more</div>
  </div>
  <div class="feature">
    <div class="feature-icon">🤖</div>
    <div class="feature-title">AI Powered</div>
    <div class="feature-desc">Natural, accurate translation that preserves meaning</div>
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>How to translate a PDF to Bengali online for free?</h3>
    <p>Upload your PDF to PDFTash, select Bengali as the target language, and click "Translate". Our AI will translate your entire PDF accurately in seconds.</p>
  </div>
  <div class="faq-item">
    <h3>What languages are supported for PDF translation?</h3>
    <p>PDFTash supports 12+ languages including Bengali, Hindi, Arabic, Spanish, French, German, Chinese, Japanese, Portuguese, Russian, Italian, and English.</p>
  </div>
  <div class="faq-item">
    <h3>Is the PDF translation accurate?</h3>
    <p>Yes! PDFTash uses advanced AI to provide natural, accurate translations that preserve the meaning and context of your original document.</p>
  </div>
  <div class="faq-item">
    <h3>Can I translate a PDF from Bengali to English?</h3>
    <p>Yes! PDFTash can translate PDFs in both directions — Bengali to English and English to Bengali. Perfect for students and professionals in Bangladesh.</p>
  </div>
  <div class="faq-item">
    <h3>How much does PDF translation cost?</h3>
    <p>Free users get 1 PDF translation per day. Pro users ($9/mo) get unlimited translations to all 12+ languages.</p>
  </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
let selectedFile = null;

const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = '#5b5cff'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    const f = e.dataTransfer.files[0];
    if (f && f.type === 'application/pdf') showOptions(f);
});

function handleFile(input) {
    if (input.files[0]) showOptions(input.files[0]);
}

function showOptions(file) {
    selectedFile = file;
    dropZone.querySelector('.upload-title').textContent = '✅ ' + file.name;
    document.getElementById('options').style.display = 'block';
}

async function processTranslate() {
    if (!selectedFile) return;
    const result = document.getElementById('result');
    result.style.display = 'block';

    // Show live timer so user knows it's working
    let secs = 0;
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Translating with AI... <span id="timer">0s</span></div>';
    const timerEl = document.getElementById('timer');
    const timerInterval = setInterval(() => { secs++; if(timerEl) timerEl.textContent = secs + 's'; }, 1000);

    const formData = new FormData();
    formData.append('file', selectedFile);
    formData.append('language', document.getElementById('lang').value);
    formData.append('_token', CSRF);

    const controller = new AbortController();
    const timeout = setTimeout(() => controller.abort(), 150000); // 150s timeout

    try {
        const resp = await fetch('/api/ai/translate', { method: 'POST', body: formData, signal: controller.signal });
        clearTimeout(timeout);
        clearInterval(timerInterval);
        const data = await resp.json();

        if (resp.ok) {
            const translatedText = data.translation || data.text || '';
            const lang = document.getElementById('lang').value;
            const origName = selectedFile.name.replace(/\.pdf$/i, '');
            result.innerHTML = `
                <div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;text-align:left;">
                    <div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:12px">✅ Translated in ${secs}s!</div>
                    <div id="translated-output" style="color:#eeeef8;font-size:14px;line-height:1.7;white-space:pre-wrap;max-height:300px;overflow-y:auto;border:1px solid rgba(255,255,255,.08);border-radius:8px;padding:14px;margin-bottom:16px;">${escapeHtml(translatedText)}</div>
                    <div style="display:flex;gap:10px;flex-wrap:wrap;">
                        <button onclick="downloadTxt()" style="flex:1;min-width:160px;padding:12px 20px;background:#5b5cff;color:#fff;border:none;border-radius:99px;font-size:14px;font-weight:600;cursor:pointer;">⬇ Download as TXT</button>
                        <button onclick="downloadPdf()" style="flex:1;min-width:160px;padding:12px 20px;background:#00e5a0;color:#000;border:none;border-radius:99px;font-size:14px;font-weight:600;cursor:pointer;">⬇ Download as PDF</button>
                    </div>
                </div>
                <button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Translate Another</button>`;
            window._translatedText     = translatedText;
            window._translatedLang     = lang;
            window._translatedOrigName = origName;
        } else if (data.error === 'pro_required' || data.error === 'free_limit_reached') {
            result.style.display = 'none';
            showProModal();
        } else {
            result.innerHTML = `<div style="color:#ff6b6b">Error: ${data.error || 'Something went wrong'}</div>`;
        }
    } catch(e) {
        clearTimeout(timeout);
        clearInterval(timerInterval);
        const msg = e.name === 'AbortError'
            ? 'Request timed out. Try a smaller PDF.'
            : 'Connection error. Please try again.';
        result.innerHTML = `<div style="color:#ff6b6b">${msg}</div>`;
    }
}

function escapeHtml(t) {
    return t.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

function downloadTxt() {
    const text = window._translatedText || '';
    const lang = window._translatedLang || 'translated';
    const name = window._translatedOrigName || 'document';
    const blob = new Blob([text], { type: 'text/plain;charset=utf-8' });
    const url  = URL.createObjectURL(blob);
    const a    = document.createElement('a');
    a.href = url; a.download = name + '-' + lang.toLowerCase() + '.txt'; a.click();
    URL.revokeObjectURL(url);
}

function downloadPdf() { // must stay sync — window.open needs direct user gesture
    const text = window._translatedText || '';
    const lang = window._translatedLang || 'Translated';
    const name = window._translatedOrigName || 'document';
    if (!text) return;

    const escaped = text.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    const paragraphs = escaped.split('\n')
        .map(p => p.trim())
        .filter(p => p)
        .map(p => `<p>${p}</p>`)
        .join('');

    const html = `<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>${name} — ${lang}</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Noto+Sans+Bengali:wght@400;700&family=Noto+Sans+Arabic:wght@400;700&family=Noto+Sans+Devanagari:wght@400;700&display=swap" rel="stylesheet">
<style>
  * { margin:0; padding:0; box-sizing:border-box; }
  body {
    font-family: 'Noto Sans Bengali','Noto Sans Arabic','Noto Sans Devanagari','Noto Sans',Arial,sans-serif;
    font-size: 12pt;
    line-height: 1.9;
    color: #1e293b;
    background: #fff;
  }
  .cover {
    background: #1e40af;
    color: white;
    padding: 40px 50px 30px;
  }
  .cover-label { font-size:9pt; opacity:.6; margin-bottom:8px; text-transform:uppercase; letter-spacing:.1em; }
  .cover h1 { font-size:22pt; font-weight:700; margin-bottom:6px; }
  .cover-sub { font-size:12pt; opacity:.8; }
  .cover-date { font-size:9pt; opacity:.45; margin-top:10px; }
  .body { padding: 40px 50px; }
  p { margin-bottom: 14px; text-align: justify; }
  .footer {
    margin-top: 40px;
    padding-top: 12px;
    border-top: 1px solid #e2e8f0;
    font-size: 9pt;
    color: #94a3b8;
    text-align: center;
  }
  @media print {
    @page { margin: 0; size: A4; }
    body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
  }
</style>
</head>
<body>
<div class="cover">
  <div class="cover-label">PDFTash · AI Translation</div>
  <h1>${name}</h1>
  <div class="cover-sub">Translated to ${lang}</div>
  <div class="cover-date">Generated ${new Date().toLocaleDateString('en-GB',{day:'2-digit',month:'short',year:'numeric'})}</div>
</div>
<div class="body">
${paragraphs}
<div class="footer">Translated by PDFTash AI · pdftash.com</div>
</div>
<script>
  if(document.fonts&&document.fonts.ready){document.fonts.ready.then(()=>setTimeout(()=>window.print(),500));}
  else{window.onload=()=>setTimeout(()=>window.print(),800);}
<\/script>
</body>
</html>`;

    const win = window.open('', '_blank');
    if (!win) { alert('Allow popups for pdftash.com, then click Download as PDF again.'); return; }
    win.document.open();
    win.document.write(html);
    win.document.close();
}
</script>
@endsection
