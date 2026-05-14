@extends('tools.layout')

@section('title', 'Split PDF Online Free — Extract Pages from PDF')
@section('description', 'Split PDF files online for free. Extract specific pages, remove pages, or divide PDF into multiple files. No signup needed. Instant download.')
@section('keywords', 'split pdf, extract pdf pages, split pdf online free, divide pdf, separate pdf pages, remove pages from pdf, pdf page extractor, cut pdf pages')
@section('slug', 'split-pdf')

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Split a PDF Online Free",
  "description": "Extract specific pages or split a PDF into multiple files in 3 easy steps.",
  "step": [
    {"@type":"HowToStep","position":1,"name":"Upload your PDF","text":"Click the upload area or drag and drop your PDF file."},
    {"@type":"HowToStep","position":2,"name":"Enter page range","text":"Type the pages you want to extract, e.g. 1-3, 5, 7-9."},
    {"@type":"HowToStep","position":3,"name":"Split & Download","text":"Click Split PDF and download the extracted pages instantly."}
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"How to split a PDF file online for free?","acceptedAnswer":{"@type":"Answer","text":"Upload your PDF to PDFTash, enter the page range you want to extract (e.g. 1-3, 5), and click Split PDF. Download instantly with no signup required."}},
    {"@type":"Question","name":"Can I extract specific pages from a PDF?","acceptedAnswer":{"@type":"Answer","text":"Yes! Enter any combination of pages such as 1, 3, 5-10 and PDFTash will extract exactly those pages into a new PDF."}},
    {"@type":"Question","name":"What page range format does PDFTash support?","acceptedAnswer":{"@type":"Answer","text":"Use comma-separated values and ranges. For example: 1-3, 5, 7-9 will extract pages 1, 2, 3, 5, 7, 8, and 9."}},
    {"@type":"Question","name":"Is PDFTash better than Smallpdf for splitting PDFs?","acceptedAnswer":{"@type":"Answer","text":"PDFTash offers the same PDF splitting as Smallpdf and Sejda — completely free with no signup. Plus AI features like PDF translation and chat."}},
    {"@type":"Question","name":"How many pages can I extract from a PDF?","acceptedAnswer":{"@type":"Answer","text":"Free users can extract any number of pages from PDFs up to 10MB. Pro users ($9/month) can split PDFs up to 200MB."}}
  ]
}
</script>
@endsection

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
    <div class="feature-title">Extract Any Pages</div>
    <div class="feature-desc">Pick exact pages using ranges like 1-3, 5, 7-9</div>
  </div>
  <div class="feature">
    <div class="feature-icon">📂</div>
    <div class="feature-title">Split by Range</div>
    <div class="feature-desc">Divide a large PDF into smaller files</div>
  </div>
  <div class="feature">
    <div class="feature-icon">🔒</div>
    <div class="feature-title">100% Secure</div>
    <div class="feature-desc">Files deleted automatically after 2 hours</div>
  </div>
</div>

{{-- HOW IT WORKS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">How to Split a PDF in 3 Steps</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
    @foreach([
      ['📤','Upload PDF','Click or drag your PDF into the upload box.'],
      ['✍️','Enter Pages','Type the pages to extract, e.g. 1-3, 5, 7-9.'],
      ['⬇️','Download','Get your extracted pages as a new PDF instantly.'],
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

{{-- USE CASES --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">When to Split a PDF?</h2>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['📧','Email Size Limit','Extract only the relevant pages to stay under email attachment limits.'],
      ['🎓','Submit Assignments','Extract specific chapters or pages required for your submission.'],
      ['📑','Remove Blank Pages','Split out unwanted pages from scanned documents.'],
      ['🏢','Share Sections','Send only the relevant section of a large report to clients.'],
    ] as $u)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:20px;">
      <div style="font-size:28px;margin-bottom:8px;">{{ $u[0] }}</div>
      <div style="font-weight:600;font-size:14px;margin-bottom:6px;">{{ $u[1] }}</div>
      <div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $u[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- RELATED TOOLS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:22px;font-weight:700;margin-bottom:20px;">More Free PDF Tools</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([['Compress PDF','/compress-pdf'],['Merge PDF','/merge-pdf'],['Translate PDF','/translate-pdf'],['Chat with PDF','/chat-with-pdf'],['Sign PDF','/sign-pdf']] as $t)
    <a href="{{ $t[1] }}" style="padding:10px 18px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>How to split a PDF file online for free?</h3>
    <p>Upload your PDF to PDFTash, enter the page range (e.g. 1-3, 5), and click "Split PDF". Download instantly. No signup required.</p>
  </div>
  <div class="faq-item">
    <h3>Can I extract specific pages from a PDF?</h3>
    <p>Yes! Enter any combination like 1, 3, 5-10 and PDFTash will extract exactly those pages into a new PDF.</p>
  </div>
  <div class="faq-item">
    <h3>What page range format should I use?</h3>
    <p>Use comma-separated values and ranges. Example: 1-3, 5, 7-9 extracts pages 1, 2, 3, 5, 7, 8, and 9.</p>
  </div>
  <div class="faq-item">
    <h3>Is PDFTash better than Smallpdf for splitting PDFs?</h3>
    <p>PDFTash offers the same PDF splitting as Smallpdf and Sejda — completely free with no signup. Plus AI features like translation to Bengali.</p>
  </div>
  <div class="faq-item">
    <h3>How many pages can I extract?</h3>
    <p>Free users can extract any pages from PDFs up to 10MB. Pro users ($9/month) can split PDFs up to 200MB.</p>
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
