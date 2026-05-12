@extends('tools.layout')

@section('title', 'Split PDF Online Free — Extract PDF Pages')
@section('description', 'Split PDF files online for free. Extract specific pages or split PDF into multiple files. No signup needed. Fast and secure.')
@section('keywords', 'split pdf, extract pdf pages, split pdf online free, divide pdf, separate pdf pages')
@section('slug', 'split-pdf')

@section('content')
<div class="hero">
  <div class="badge">✂️ Free PDF Splitter</div>
  <h1>Split PDF Online Free</h1>
  <p>Extract specific pages or split your PDF into multiple files. Fast, free, and secure. No signup needed.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">✂️</div>
    <div class="upload-title">Drop your PDF here to Split</div>
    <div class="upload-sub">Select pages to extract · Max 10MB free · No signup needed</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="options" style="display:none;margin-top:16px;">
    <div style="margin-bottom:12px;">
      <label style="color:#eeeef8;font-size:14px;font-weight:600;display:block;margin-bottom:6px;">Page range (e.g. 1-3, 5, 7-9)</label>
      <input type="text" id="pages" placeholder="e.g. 1-3, 5, 7-9" style="width:100%;padding:10px 14px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:10px;color:#eeeef8;font-size:14px;box-sizing:border-box;">
    </div>
    <div style="text-align:center;">
      <button type="button" onclick="processSplit()" style="padding:14px 32px;background:#5b5cff;color:#fff;border:none;border-radius:99px;font-size:15px;font-weight:600;cursor:pointer;">Split PDF →</button>
    </div>
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Your files are automatically deleted after 2 hours</p>
  </div>
</div>

<div class="features">
  <div class="feature">
    <div class="feature-icon">📄</div>
    <div class="feature-title">Extract Pages</div>
    <div class="feature-desc">Select specific pages to extract from your PDF</div>
  </div>
  <div class="feature">
    <div class="feature-icon">📂</div>
    <div class="feature-title">Split by Range</div>
    <div class="feature-desc">Split PDF into multiple files by page range</div>
  </div>
  <div class="feature">
    <div class="feature-icon">🔒</div>
    <div class="feature-title">100% Secure</div>
    <div class="feature-desc">Files deleted automatically after 2 hours</div>
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>How to split a PDF file online for free?</h3>
    <p>Upload your PDF to PDFTash, select the pages you want to extract, and click "Split PDF". Download instantly. No signup required.</p>
  </div>
  <div class="faq-item">
    <h3>Can I extract specific pages from a PDF?</h3>
    <p>Yes! PDFTash lets you select any combination of pages to extract. For example, extract pages 1, 3, 5-10 from a large PDF.</p>
  </div>
  <div class="faq-item">
    <h3>Is PDFTash better than Smallpdf for splitting PDFs?</h3>
    <p>PDFTash offers the same PDF splitting as Smallpdf and Sejda — completely free with no daily limits. Plus AI features.</p>
  </div>
  <div class="faq-item">
    <h3>How many pages can I extract from a PDF?</h3>
    <p>Free users can extract any number of pages from PDFs up to 10MB. Pro users ($9/mo) can split PDFs up to 200MB.</p>
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

async function processSplit() {
    if (!selectedFile) return;
    const pages = document.getElementById('pages').value.trim();
    const result = document.getElementById('result');
    result.style.display = 'block';
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Splitting your PDF...</div>';

    const formData = new FormData();
    formData.append('file', selectedFile);
    formData.append('pages', pages || 'all');
    formData.append('_token', CSRF);

    try {
        const resp = await fetch('/api/pdf/split', { method: 'POST', body: formData });
        if (resp.ok) {
            const blob = await resp.blob();
            const url = URL.createObjectURL(blob);
            result.innerHTML = `
                <div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;">
                    <div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:8px">Split Successfully!</div>
                </div>
                <a href="${url}" download="split.pdf" style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">Download Split PDF</a>
                <br><br>
                <button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Split Another</button>`;
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
