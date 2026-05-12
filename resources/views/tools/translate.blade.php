@extends('tools.layout')

@section('title', 'Translate PDF Online Free — PDF to Bengali, Hindi, Arabic')
@section('description', 'Translate PDF documents to Bengali, Hindi, Arabic, Spanish and 12+ languages online free. No signup needed. AI-powered translation.')
@section('keywords', 'translate pdf, pdf translator, translate pdf to bengali, pdf to hindi, translate pdf online free')
@section('slug', 'translate-pdf')

@section('content')
<div class="hero">
  <div class="badge">🌐 AI PDF Translator</div>
  <h1>Translate PDF to Any Language Free</h1>
  <p>Translate your PDF documents to Bengali, Hindi, Arabic, Spanish and 12+ languages using AI. Fast, accurate, and free.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">🌍</div>
    <div class="upload-title">Drop your PDF here to Translate</div>
    <div class="upload-sub">Supports 12+ languages including Bengali · AI-powered</div>
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
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Translating your PDF with AI...</div>';

    const formData = new FormData();
    formData.append('file', selectedFile);
    formData.append('language', document.getElementById('lang').value);
    formData.append('_token', CSRF);

    try {
        const resp = await fetch('/api/ai/translate', { method: 'POST', body: formData });
        if (resp.ok) {
            const data = await resp.json();
            result.innerHTML = `
                <div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;text-align:left;">
                    <div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:12px">Translated Successfully!</div>
                    <div style="color:#eeeef8;font-size:14px;line-height:1.7;white-space:pre-wrap;max-height:400px;overflow-y:auto;">${data.translation || data.text || ''}</div>
                </div>
                <button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Translate Another</button>`;
        } else {
            const data = await resp.json();
            if (data.error === 'free_limit_reached') {
                result.innerHTML = `
                    <div style="background:#1a0a0a;border:1px solid #ff6b6b;border-radius:12px;padding:20px;">
                        <div style="color:#ff6b6b;font-weight:700;margin-bottom:8px">Daily limit reached!</div>
                        <div style="color:#8888a8;font-size:14px;margin-bottom:16px">Upgrade to Pro for unlimited access</div>
                        <a href="/#pricing" style="display:inline-block;padding:12px 24px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">Upgrade to Pro →</a>
                    </div>`;
            } else {
                result.innerHTML = `<div style="color:#ff6b6b">Error: ${data.error || 'Something went wrong'}</div>`;
            }
        }
    } catch(e) {
        result.innerHTML = `<div style="color:#ff6b6b">Connection error. Please try again.</div>`;
    }
}
</script>
@endsection
