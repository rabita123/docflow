@extends('tools.layout')

@section('title', 'Compress PDF Online Free — Reduce PDF File Size')
@section('description', 'Compress PDF files online for free. Reduce PDF size by up to 90% without losing quality. No signup needed. Works on any device. Fast and secure.')
@section('keywords', 'compress pdf, reduce pdf size, pdf compressor online free, shrink pdf, make pdf smaller, compress pdf without losing quality, smallpdf alternative, pdf size reducer')
@section('slug', 'compress-pdf')

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Compress a PDF Online Free",
  "description": "Reduce your PDF file size online in 3 easy steps using PDFTash — free, no signup needed.",
  "step": [
    {"@type":"HowToStep","position":1,"name":"Upload your PDF","text":"Click the upload area or drag and drop your PDF file. Supports files up to 10MB on free plan."},
    {"@type":"HowToStep","position":2,"name":"Click Compress","text":"PDFTash automatically compresses your PDF using smart compression algorithms."},
    {"@type":"HowToStep","position":3,"name":"Download compressed PDF","text":"Download your compressed PDF instantly. File size reduced by up to 90%."}
  ],
  "tool": {"@type":"HowToTool","name":"PDFTash PDF Compressor"}
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"How to compress a PDF file online for free?","acceptedAnswer":{"@type":"Answer","text":"Upload your PDF to PDFTash, the tool automatically compresses it and you download the smaller file instantly. No signup required."}},
    {"@type":"Question","name":"Will compressing a PDF reduce quality?","acceptedAnswer":{"@type":"Answer","text":"PDFTash uses smart compression that reduces file size while maintaining the best possible visual quality. Most PDFs look identical after compression."}},
    {"@type":"Question","name":"How much can PDFTash compress a PDF?","acceptedAnswer":{"@type":"Answer","text":"Depending on the PDF content, PDFTash can reduce file size by 20% to 90%. PDFs with many images compress the most."}},
    {"@type":"Question","name":"What is the maximum PDF size for free compression?","acceptedAnswer":{"@type":"Answer","text":"Free users can compress PDFs up to 10MB. Pro users ($9/month) can compress files up to 200MB."}},
    {"@type":"Question","name":"Is PDFTash a good free alternative to Smallpdf?","acceptedAnswer":{"@type":"Answer","text":"Yes! PDFTash offers the same compression quality as Smallpdf and Sejda — completely free with no signup needed. Plus AI features."}}
  ]
}
</script>
@endsection

@section('content')
<div class="hero">
  <div class="badge">🗜️ Free PDF Compressor</div>
  <h1>Compress PDF Online Free</h1>
  <p>Reduce your PDF file size by up to 90% without losing quality. Fast, free, and secure. No signup needed.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">📄</div>
    <div class="upload-title">Drop your PDF here to Compress</div>
    <div class="upload-sub">Click to browse · Max 10MB free · No signup needed</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Your files are automatically deleted after 2 hours</p>
  </div>
</div>

<div class="features">
  <div class="feature">
    <div class="feature-icon">⚡</div>
    <div class="feature-title">Up to 90% Smaller</div>
    <div class="feature-desc">Smart compression reduces size dramatically</div>
  </div>
  <div class="feature">
    <div class="feature-icon">🔒</div>
    <div class="feature-title">100% Secure</div>
    <div class="feature-desc">Files deleted automatically after 2 hours</div>
  </div>
  <div class="feature">
    <div class="feature-icon">✨</div>
    <div class="feature-title">No Quality Loss</div>
    <div class="feature-desc">Visually identical after compression</div>
  </div>
</div>

{{-- HOW IT WORKS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">How to Compress a PDF in 3 Steps</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
    @foreach([
      ['📤','Upload PDF','Click or drag your PDF into the upload box. Supports any PDF up to 10MB.'],
      ['⚙️','Auto Compress','PDFTash instantly compresses your file using smart algorithms.'],
      ['⬇️','Download','Get your compressed PDF immediately — no wait, no email required.'],
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
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">Who Uses PDF Compression?</h2>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['📧','Email Attachments','Gmail and Outlook have 25MB attachment limits. Compress large PDFs to send them easily.'],
      ['🎓','Students','Submit assignments and research papers within your university portal's file size limit.'],
      ['💼','Business','Share contracts, reports and presentations faster with smaller PDF files.'],
      ['📱','Mobile Users','Save storage space on your phone by compressing PDF documents.'],
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
    @foreach([['Merge PDF','/merge-pdf'],['Split PDF','/split-pdf'],['Translate PDF','/translate-pdf'],['Chat with PDF','/chat-with-pdf'],['Sign PDF','/sign-pdf']] as $t)
    <a href="{{ $t[1] }}" style="padding:10px 18px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;transition:all .2s;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>How to compress a PDF file online for free?</h3>
    <p>Upload your PDF to PDFTash. The tool automatically compresses it and you can download the smaller file instantly. No signup or credit card required.</p>
  </div>
  <div class="faq-item">
    <h3>Will compressing reduce the quality of my PDF?</h3>
    <p>PDFTash uses smart compression to reduce file size while maintaining the best possible visual quality. Most compressed PDFs look identical to the original.</p>
  </div>
  <div class="faq-item">
    <h3>How much can PDFTash compress a PDF?</h3>
    <p>Depending on the content, PDFTash can reduce PDF size by 20% to 90%. PDFs with many images and graphics compress the most.</p>
  </div>
  <div class="faq-item">
    <h3>What is the maximum file size I can compress for free?</h3>
    <p>Free users can compress PDFs up to 10MB. Pro users ($9/month) can compress files up to 200MB with unlimited daily compressions.</p>
  </div>
  <div class="faq-item">
    <h3>Is PDFTash safe? Where do my files go?</h3>
    <p>All files are encrypted during upload, processed securely, and automatically deleted after 2 hours. We never store or access your documents.</p>
  </div>
  <div class="faq-item">
    <h3>Is PDFTash a good free alternative to Smallpdf or Sejda?</h3>
    <p>Yes! PDFTash offers the same compression quality as Smallpdf and Sejda — completely free with no signup. Plus unique AI features like PDF translation and chat.</p>
  </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = '#5b5cff'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    const file = e.dataTransfer.files[0];
    if (file && file.type === 'application/pdf') processFile(file);
});

function handleFile(input) { if (input.files[0]) processFile(input.files[0]); }

async function processFile(file) {
    const result = document.getElementById('result');
    result.style.display = 'block';
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Compressing your PDF...</div>';

    const formData = new FormData();
    formData.append('file', file);
    formData.append('_token', CSRF);

    try {
        const resp = await fetch('/api/pdf/compress', {method:'POST', body:formData});
        if (resp.ok) {
            const blob = await resp.blob();
            const url = URL.createObjectURL(blob);
            const saved = (((file.size - blob.size) / file.size) * 100).toFixed(0);
            result.innerHTML = `
                <div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;">
                    <div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:8px">✅ Compressed Successfully!</div>
                    <div style="color:#8888a8;font-size:14px">${(file.size/1024).toFixed(0)}KB → ${(blob.size/1024).toFixed(0)}KB <span style="color:#00e5a0;font-weight:600">(${saved}% smaller)</span></div>
                </div>
                <a href="${url}" download="compressed.pdf" style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">⬇ Download Compressed PDF</a>
                <br><br>
                <button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Compress Another</button>`;
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
