@extends('tools.layout')

@section('title', 'OCR PDF — Extract Text from Scanned PDF Free')
@section('description', 'Extract text from scanned PDFs online free using OCR. Converts image-based PDFs to searchable, copyable text. Supports Bengali, Hindi, Arabic, English and more.')
@section('keywords', 'ocr pdf, extract text from scanned pdf, pdf ocr online free, scanned pdf to text, ocr pdf online')
@section('slug', 'ocr-pdf')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash — OCR PDF Online Free",
  "applicationCategory": "WebApplication",
  "operatingSystem": "Any",
  "description": "Extract text from scanned PDFs using OCR. Converts image-based PDFs to searchable text. Supports 10+ languages including Bengali, Hindi, Arabic.",
  "url": "https://pdftash.com/ocr-pdf",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"},
  "aggregateRating": {"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"1543"}
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"What is OCR and why do I need it?","acceptedAnswer":{"@type":"Answer","text":"OCR (Optical Character Recognition) converts scanned images into real text. Scanned PDFs are just images — you can't search or copy their text. OCR fixes that, making the text selectable and searchable."}},
    {"@type":"Question","name":"Which languages does OCR support?","acceptedAnswer":{"@type":"Answer","text":"PDFTash OCR supports English, Bengali, Hindi, Arabic, French, German, Spanish, Chinese, Japanese, Urdu, and Portuguese."}},
    {"@type":"Question","name":"How accurate is the OCR?","acceptedAnswer":{"@type":"Answer","text":"Accuracy depends on scan quality. Clear 300 DPI scans achieve 95%+ accuracy. Blurry or low-resolution scans (under 150 DPI) may have more errors. High-contrast black text on white background gives the best results."}},
    {"@type":"Question","name":"Can I OCR a multi-page PDF?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash processes up to 20 pages per PDF. Each page is OCR'd and the full text is returned as a single downloadable TXT file."}},
    {"@type":"Question","name":"What happens after OCR — can I use the text with other tools?","acceptedAnswer":{"@type":"Answer","text":"Yes. After OCR you get a TXT file with all extracted text. You can then use it to translate, summarize, or edit the content."}}
  ]
}
]
</script>
@endsection

@section('content')
<div class="hero">
  <div style="display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin-bottom:24px;">
    <div class="badge">🔍 OCR PDF</div>
    <div class="badge" style="background:rgba(0,229,160,.1);border-color:rgba(0,229,160,.4);color:#00e5a0;">✅ Free</div>
  </div>
  <h1>OCR PDF — Extract Text from Scanned Documents</h1>
  <p>Upload a scanned PDF and get all the text out. Works on image-based PDFs that can't be searched or copied. Supports Bengali, Hindi, Arabic and 10+ languages.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">🔍</div>
    <div class="upload-title">Drop your scanned PDF here</div>
    <div class="upload-sub">Supports image-based / scanned PDFs · Free · No signup</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>

  <div id="options" style="display:none;margin-top:16px;">
    <div style="margin-bottom:12px;">
      <label style="color:#eeeef8;font-size:14px;font-weight:600;display:block;margin-bottom:6px;">Document language</label>
      <select id="lang" style="width:100%;padding:10px 14px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:10px;color:#eeeef8;font-size:14px;">
        <option value="eng">English</option>
        <option value="ben">Bengali (বাংলা)</option>
        <option value="hin">Hindi (हिंदी)</option>
        <option value="ara">Arabic (العربية)</option>
        <option value="fra">French (Français)</option>
        <option value="deu">German (Deutsch)</option>
        <option value="spa">Spanish (Español)</option>
        <option value="chi_sim">Chinese Simplified (中文)</option>
        <option value="jpn">Japanese (日本語)</option>
        <option value="urd">Urdu (اردو)</option>
        <option value="por">Portuguese (Português)</option>
      </select>
    </div>
    <div style="text-align:center;">
      <button type="button" onclick="processOcr()" style="padding:14px 32px;background:#5b5cff;color:#fff;border:none;border-radius:99px;font-size:15px;font-weight:600;cursor:pointer;">Extract Text with OCR →</button>
    </div>
  </div>

  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Your files are automatically deleted after 2 hours</p>
  </div>
</div>

<div class="features">
  <div class="feature">
    <div class="feature-icon">🌐</div>
    <div class="feature-title">10+ Languages</div>
    <div class="feature-desc">Bengali, Hindi, Arabic, English, Chinese and more</div>
  </div>
  <div class="feature">
    <div class="feature-icon">📄</div>
    <div class="feature-title">Up to 20 Pages</div>
    <div class="feature-desc">Process multi-page scanned documents at once</div>
  </div>
  <div class="feature">
    <div class="feature-icon">⚡</div>
    <div class="feature-title">Instant Download</div>
    <div class="feature-desc">Get your extracted text as a TXT file in seconds</div>
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>What is OCR and why do I need it?</h3>
    <p>OCR (Optical Character Recognition) converts scanned page images into real, selectable text. If you can't highlight or copy text from your PDF, it's a scanned document — OCR fixes that.</p>
  </div>
  <div class="faq-item">
    <h3>How accurate is the OCR?</h3>
    <p>Clear 300 DPI scans achieve 95%+ accuracy. Best results come from high-contrast black text on white background. Blurry or handwritten documents will have lower accuracy.</p>
  </div>
  <div class="faq-item">
    <h3>Can I translate the OCR output?</h3>
    <p>Yes. After downloading the TXT file, you can copy the text into the <a href="/translate-pdf" style="color:#5b5cff">Translate PDF</a> tool — or upload the original PDF there and it will automatically run OCR before translating.</p>
  </div>
  <div class="faq-item">
    <h3>Which languages are supported?</h3>
    <p>English, Bengali, Hindi, Arabic, French, German, Spanish, Chinese (Simplified), Japanese, Urdu, and Portuguese. Select your document's language from the dropdown for best accuracy.</p>
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

async function processOcr() {
    if (!selectedFile) return;
    const result = document.getElementById('result');
    result.style.display = 'block';

    let secs = 0;
    result.innerHTML = '<div style="color:#8888a8;padding:20px">🔍 Running OCR... <span id="timer">0s</span><br><small style="font-size:12px;margin-top:8px;display:block;">Scanned PDFs take 10–30 seconds per page</small></div>';
    const timerEl = document.getElementById('timer');
    const timerInterval = setInterval(() => { secs++; if(timerEl) timerEl.textContent = secs + 's'; }, 1000);

    const formData = new FormData();
    formData.append('file', selectedFile);
    formData.append('lang', document.getElementById('lang').value);
    formData.append('_token', CSRF);

    const controller = new AbortController();
    const timeout = setTimeout(() => controller.abort(), 300000); // 5 min for large scans

    try {
        const resp = await fetch('/api/pdf/ocr', { method: 'POST', body: formData, signal: controller.signal });
        clearTimeout(timeout);
        clearInterval(timerInterval);

        if (resp.ok) {
            const text = await resp.text();
            const blob = new Blob([text], { type: 'text/plain;charset=utf-8' });
            const url  = URL.createObjectURL(blob);
            const origName = selectedFile.name.replace(/\.pdf$/i, '');

            result.innerHTML = `
                <div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;text-align:left;">
                    <div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:12px">✅ OCR Complete in ${secs}s!</div>
                    <div style="color:#eeeef8;font-size:14px;line-height:1.7;white-space:pre-wrap;max-height:300px;overflow-y:auto;border:1px solid rgba(255,255,255,.08);border-radius:8px;padding:14px;margin-bottom:16px;">${escapeHtml(text.slice(0, 2000))}${text.length > 2000 ? '\n\n[... download for full text ...]' : ''}</div>
                    <a href="${url}" download="${origName}-ocr.txt" style="display:inline-block;padding:12px 24px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600;font-size:14px;">⬇ Download Full Text (TXT)</a>
                </div>
                <div style="margin-top:12px;display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
                    <a href="/translate-pdf" style="padding:10px 18px;background:#0f0f1a;border:1px solid rgba(255,255,255,.15);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">🌐 Translate this PDF</a>
                    <a href="/chat-with-pdf" style="padding:10px 18px;background:#0f0f1a;border:1px solid rgba(255,255,255,.15);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">💬 Chat with PDF</a>
                    <button onclick="location.reload()" style="padding:10px 18px;background:transparent;border:1px solid rgba(255,255,255,.15);border-radius:99px;color:#8888a8;font-size:13px;cursor:pointer;">OCR Another</button>
                </div>`;
        } else {
            const data = await resp.json().catch(() => ({}));
            result.innerHTML = `<div style="color:#ff6b6b">Error: ${data.error || 'Something went wrong'}</div>`;
        }
    } catch(e) {
        clearTimeout(timeout);
        clearInterval(timerInterval);
        const msg = e.name === 'AbortError' ? 'Request timed out. Try fewer pages.' : 'Connection error. Please try again.';
        result.innerHTML = `<div style="color:#ff6b6b">${msg}</div>`;
    }
}

function escapeHtml(t) {
    return t.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}
</script>
@endsection
