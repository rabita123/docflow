@extends('tools.layout')

@section('title', 'Merge PDF Files Online Free — Combine PDF')
@section('description', 'Merge multiple PDF files into one online for free. Combine PDF documents easily. No signup needed. Fast and secure.')
@section('keywords', 'merge pdf, combine pdf, merge pdf files online free, join pdf files')
@section('slug', 'merge-pdf')

@section('content')
<div class="hero">
  <div class="badge">📎 Free PDF Merger</div>
  <h1>Merge PDF Files Online Free</h1>
  <p>Combine multiple PDF documents into one file. Fast, free, and secure. No signup needed.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">📑</div>
    <div class="upload-title">Drop your PDFs here to Merge</div>
    <div class="upload-sub">Select multiple PDF files · Max 10MB free · No signup needed</div>
    <input type="file" id="pdfInput" accept=".pdf" multiple style="display:none" onchange="handleFiles(this)">
  </div>
  <div id="file-list" style="display:none;margin-top:12px;"></div>
  <div id="merge-btn-wrap" style="display:none;text-align:center;margin-top:16px;">
    <button type="button" onclick="processMerge()" style="padding:14px 32px;background:#5b5cff;color:#fff;border:none;border-radius:99px;font-size:15px;font-weight:600;cursor:pointer;">Merge PDFs →</button>
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Your files are automatically deleted after 2 hours</p>
  </div>
</div>

<div class="features">
  <div class="feature">
    <div class="feature-icon">📚</div>
    <div class="feature-title">Multiple Files</div>
    <div class="feature-desc">Merge unlimited PDF files into one</div>
  </div>
  <div class="feature">
    <div class="feature-icon">🔄</div>
    <div class="feature-title">Custom Order</div>
    <div class="feature-desc">Arrange pages in any order</div>
  </div>
  <div class="feature">
    <div class="feature-icon">🔒</div>
    <div class="feature-title">100% Secure</div>
    <div class="feature-desc">Files deleted after 2 hours</div>
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>How to merge PDF files online for free?</h3>
    <p>Upload your PDF files to PDFTash, arrange them in your desired order, and click "Merge PDF". Download instantly. No signup required.</p>
  </div>
  <div class="faq-item">
    <h3>How many PDF files can I merge at once?</h3>
    <p>Free users can merge up to 5 PDF files per day. Pro users ($9/mo) can merge unlimited files.</p>
  </div>
  <div class="faq-item">
    <h3>Is PDFTash better than ILovePDF for merging?</h3>
    <p>PDFTash offers the same PDF merging as ILovePDF and Smallpdf — completely free. Plus unique AI features.</p>
  </div>
  <div class="faq-item">
    <h3>Will quality be affected when merging PDFs?</h3>
    <p>No! PDFTash merges PDF files without any quality loss. Your documents will look exactly the same.</p>
  </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
let selectedFiles = [];

const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = '#5b5cff'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    const files = Array.from(e.dataTransfer.files).filter(f => f.type === 'application/pdf');
    if (files.length) addFiles(files);
});

function handleFiles(input) {
    addFiles(Array.from(input.files));
}

function addFiles(files) {
    selectedFiles = selectedFiles.concat(files);
    renderFileList();
}

function renderFileList() {
    const list = document.getElementById('file-list');
    const btnWrap = document.getElementById('merge-btn-wrap');
    if (!selectedFiles.length) { list.style.display = 'none'; btnWrap.style.display = 'none'; return; }
    list.style.display = 'block';
    btnWrap.style.display = 'block';
    list.innerHTML = selectedFiles.map((f, i) => `
        <div style="display:flex;align-items:center;justify-content:space-between;background:#16162a;border:1px solid rgba(255,255,255,.11);border-radius:10px;padding:10px 14px;margin-bottom:8px;">
            <span style="color:#eeeef8;font-size:14px">📄 ${f.name}</span>
            <button onclick="removeFile(${i})" style="background:transparent;border:none;color:#8888a8;cursor:pointer;font-size:18px;">×</button>
        </div>`).join('');
}

function removeFile(i) {
    selectedFiles.splice(i, 1);
    renderFileList();
}

async function processMerge() {
    if (selectedFiles.length < 2) {
        alert('Please select at least 2 PDF files to merge.');
        return;
    }
    const result = document.getElementById('result');
    result.style.display = 'block';
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Merging your PDFs...</div>';

    const formData = new FormData();
    selectedFiles.forEach(f => formData.append('files[]', f));
    formData.append('_token', CSRF);

    try {
        const resp = await fetch('/api/pdf/merge', { method: 'POST', body: formData });
        if (resp.ok) {
            const blob = await resp.blob();
            const url = URL.createObjectURL(blob);
            result.innerHTML = `
                <div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;">
                    <div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:8px">Merged Successfully!</div>
                    <div style="color:#8888a8;font-size:14px">${selectedFiles.length} files combined into one PDF</div>
                </div>
                <a href="${url}" download="merged.pdf" style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">Download Merged PDF</a>
                <br><br>
                <button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Merge More</button>`;
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
