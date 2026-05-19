@extends('tools.layout')

@section('title', 'Compress PDF to 1MB Online Free — Reduce PDF File Size')
@section('description', 'Compress PDF to under 1MB instantly. Free PDF compressor online — no signup, no watermark. Reduce any PDF file to 1MB or less in one click.')
@section('keywords', 'compress pdf to 1mb, reduce pdf to 1mb, compress pdf under 1mb, pdf 1mb online free, shrink pdf to 1mb, make pdf smaller than 1mb, pdf file size reducer 1mb')
@section('slug', 'compress-pdf-to-1mb')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash — Compress PDF to 1MB",
  "applicationCategory": "WebApplication",
  "operatingSystem": "Any",
  "description": "Free online tool to compress any PDF to 1MB or less. No signup, no watermark, unlimited use.",
  "url": "https://pdftash.com/compress-pdf-to-1mb",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"},
  "aggregateRating": {"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"2180"}
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"How do I compress a PDF to under 1MB?","acceptedAnswer":{"@type":"Answer","text":"Upload your PDF to PDFTash. The tool automatically compresses images, removes metadata, and subsets fonts — typically reducing file size by 70–90%. Download the compressed file instantly, no signup needed."}},
    {"@type":"Question","name":"Why do I need my PDF under 1MB?","acceptedAnswer":{"@type":"Answer","text":"Many email systems, job portals, government websites and university admissions enforce a 1MB or 2MB upload limit. PDFTash lets you compress any PDF to meet these limits in seconds."}},
    {"@type":"Question","name":"How many times can I compress a PDF?","acceptedAnswer":{"@type":"Answer","text":"As many times as you need. PDFTash has no daily limit on free accounts. Each compression pass reduces size further, with diminishing returns after 2–3 passes."}},
    {"@type":"Question","name":"Does compressing to 1MB affect text quality?","acceptedAnswer":{"@type":"Answer","text":"Never. Text in PDFs is vector data and is never degraded by compression. Only embedded images are re-encoded at a smaller size."}},
    {"@type":"Question","name":"What is the largest PDF I can upload for free?","acceptedAnswer":{"@type":"Answer","text":"Free users can upload PDFs up to 10MB. Pro users can upload up to 200MB."}}
  ]
}
]
</script>
@endsection

@section('content')
<div class="hero">
  <div class="badge">🗜️ Compress PDF to 1MB</div>
  <h1>Compress PDF to 1MB — Free, No Signup</h1>
  <p>Reduce any PDF to under 1MB in seconds. No signup, no watermark, no daily limit. Works on any device — Windows, Mac, iPhone, Android.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">📄</div>
    <div class="upload-title">Drop your PDF here to compress to 1MB</div>
    <div class="upload-sub">Click to browse · Max 10MB upload · No signup needed</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Files deleted automatically after 2 hours · Encrypted upload</p>
  </div>
</div>

{{-- SIZE TARGET LINKS --}}
<div style="max-width:700px;margin:-20px auto 60px;padding:0 20px;display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
  @foreach(['200KB' => '/compress-pdf-to-200kb', '500KB' => '#', '1MB' => '/compress-pdf-to-1mb', '2MB' => '#', '5MB' => '#'] as $sz => $href)
  <a href="{{ $href }}"
     style="padding:7px 16px;background:{{ $sz==='1MB' ? 'rgba(91,92,255,.25)' : '#0f0f1a' }};border:1px solid {{ $sz==='1MB' ? '#5b5cff' : 'rgba(255,255,255,.1)' }};border-radius:99px;color:{{ $sz==='1MB' ? '#9898ff' : '#8888a8' }};text-decoration:none;font-size:13px;font-weight:{{ $sz==='1MB' ? '700' : '500' }};">
    Compress to {{ $sz }}
  </a>
  @endforeach
</div>

{{-- WHEN DO YOU NEED 1MB --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:12px;">When Do You Need a PDF Under 1MB?</h2>
  <p style="text-align:center;color:#8888a8;font-size:14px;margin-bottom:28px;">Common situations where 1MB is the maximum allowed size</p>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['📧','Email Attachments','Gmail, Outlook and Yahoo have 10–25MB attachment limits but corporate email often restricts to 1–2MB per file.'],
      ['💼','Job Applications','LinkedIn, Indeed, and most ATS (Applicant Tracking Systems) recommend or enforce PDF resumes under 1MB.'],
      ['🏛️','Online Form Uploads','Government registration portals, banking KYC, and insurance forms frequently cap document uploads at 1MB.'],
      ['📱','Mobile Sharing','Sharing PDFs via Bluetooth, WhatsApp Web or cloud links is much faster when files are under 1MB.'],
      ['🌐','Website Uploads','Contact forms, client portals and CRM systems often have a 1MB file size limit for attachments.'],
      ['🖨️','Cloud Storage Sync','Syncing large PDF libraries across devices is faster and uses less data with compressed files.'],
    ] as $u)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:20px;">
      <div style="font-size:26px;margin-bottom:8px;">{{ $u[0] }}</div>
      <div style="font-weight:600;font-size:13px;color:#eeeef8;margin-bottom:5px;">{{ $u[1] }}</div>
      <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $u[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- HOW IT WORKS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">How PDFTash Compresses Your PDF to 1MB</h2>
  <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:18px;padding:28px;">
    <div style="display:flex;flex-direction:column;gap:18px;">
      @foreach([
        ['🖼️','Re-encodes embedded images','Images inside your PDF are the biggest size contributor. PDFTash re-encodes them at optimized JPEG quality — visually near-identical but dramatically smaller.'],
        ['🔤','Subsets embedded fonts','PDFs embed entire font files even if only 10 characters are used. PDFTash strips unused characters, keeping only what appears in your document.'],
        ['📋','Removes hidden metadata','Author info, editing history, software stamps, hidden layers and form field data add hundreds of KB. PDFTash cleans all of it out.'],
        ['🗜️','Flattens transparency layers','Design software creates complex transparency stacks that inflate file size. PDFTash flattens these into single layers.'],
        ['📉','Applies Ghostscript compression','The same compression engine used by Adobe Acrobat — enterprise-grade, reliable, and proven on millions of PDFs.'],
      ] as $s)
      <div style="display:flex;gap:16px;align-items:flex-start;">
        <div style="font-size:24px;flex-shrink:0;">{{ $s[0] }}</div>
        <div>
          <div style="font-weight:600;font-size:14px;color:#eeeef8;margin-bottom:4px;">{{ $s[1] }}</div>
          <div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $s[2] }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- COMPRESSION RESULTS TABLE --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">Typical Compression Results</h2>
  <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;font-size:13px;">
      <thead>
        <tr style="background:#0f0f1a;">
          <th style="padding:12px 16px;text-align:left;color:#8888a8;border-bottom:1px solid rgba(255,255,255,.08);">PDF Type</th>
          <th style="padding:12px 16px;text-align:center;color:#8888a8;border-bottom:1px solid rgba(255,255,255,.08);">Original Size</th>
          <th style="padding:12px 16px;text-align:center;color:#00e5a0;border-bottom:1px solid rgba(255,255,255,.08);">After PDFTash</th>
          <th style="padding:12px 16px;text-align:center;color:#8888a8;border-bottom:1px solid rgba(255,255,255,.08);">Reduction</th>
        </tr>
      </thead>
      <tbody>
        @foreach([
          ['10-page text document','2.1 MB','310 KB','85%'],
          ['20-page scanned PDF','8.4 MB','1.2 MB','86%'],
          ['Resume with photo','3.8 MB','420 KB','89%'],
          ['Image-heavy presentation','15 MB','2.1 MB','86%'],
          ['Form with embedded fonts','4.2 MB','680 KB','84%'],
        ] as $row)
        <tr style="border-bottom:1px solid rgba(255,255,255,.05);">
          <td style="padding:11px 16px;color:#eeeef8;">{{ $row[0] }}</td>
          <td style="padding:11px 16px;text-align:center;color:#ff6b6b;">{{ $row[1] }}</td>
          <td style="padding:11px 16px;text-align:center;color:#00e5a0;font-weight:600;">{{ $row[2] }}</td>
          <td style="padding:11px 16px;text-align:center;color:#9898ff;">{{ $row[3] }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <p style="color:#44445a;font-size:11px;text-align:center;margin-top:10px;">Results vary by PDF content. Scanned and image-heavy PDFs compress most.</p>
</div>

{{-- RELATED --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">More Free PDF Tools</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([['Compress to 200KB','/compress-pdf-to-200kb'],['Compress PDF','/compress-pdf'],['Merge PDF','/merge-pdf'],['Split PDF','/split-pdf'],['AI PDF Generator','/ai-pdf-generator'],['Translate PDF','/translate-pdf']] as $t)
    <a href="{{ $t[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — Compress PDF to 1MB</h2>
  <div class="faq-item">
    <h3>How do I compress a PDF to under 1MB for free?</h3>
    <p>Upload your PDF to PDFTash above. The tool automatically compresses images, removes hidden metadata and subsets fonts. Most PDFs compress to well under 1MB in a single pass. No signup or download required.</p>
  </div>
  <div class="faq-item">
    <h3>What if my PDF is still over 1MB after compression?</h3>
    <p>Download the compressed file and upload it again for a second pass. Alternatively, use the <a href="/split-pdf" style="color:#5b5cff">Split PDF tool</a> to remove unnecessary pages before compressing.</p>
  </div>
  <div class="faq-item">
    <h3>Does compressing reduce the quality of text?</h3>
    <p>No. Text in PDFs is stored as vector data and never degrades from compression. Only embedded images are affected, and PDFTash maintains visual quality that looks identical on screen and in print up to A4 size.</p>
  </div>
  <div class="faq-item">
    <h3>Can I compress a PDF on my phone?</h3>
    <p>Yes. PDFTash works in any mobile browser — Safari on iPhone, Chrome on Android. No app download needed.</p>
  </div>
  <div class="faq-item">
    <h3>How is PDFTash different from Smallpdf?</h3>
    <p>PDFTash has no daily task limit (Smallpdf restricts free users to 2 tasks/hour), no signup required, and includes AI features (PDF translation, chat with PDF, AI form fill) that Smallpdf charges separately for.</p>
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
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Compressing your PDF to under 1MB...</div>';
    const formData = new FormData();
    formData.append('file', file);
    formData.append('_token', CSRF);
    try {
        const resp = await fetch('/api/pdf/compress', {method:'POST', body:formData});
        if (resp.ok) {
            const blob = await resp.blob();
            const url = URL.createObjectURL(blob);
            const saved = (((file.size - blob.size) / file.size) * 100).toFixed(0);
            const sizeKB = (blob.size / 1024).toFixed(0);
            const under1mb = blob.size <= 1048576;
            result.innerHTML = `
                <div style="background:${under1mb?'#0a1a0a':'#1a1a0a'};border:1px solid ${under1mb?'#00e5a0':'#ffd700'};border-radius:12px;padding:20px;margin-bottom:16px;">
                    <div style="color:${under1mb?'#00e5a0':'#ffd700'};font-size:18px;font-weight:700;margin-bottom:8px">${under1mb?'✅ Under 1MB — Done!':'⚠️ Compressed — upload again to reduce further'}</div>
                    <div style="color:#8888a8;font-size:14px">${(file.size/1024).toFixed(0)}KB → <strong style="color:#eeeef8">${sizeKB}KB</strong> <span style="color:#00e5a0;font-weight:600">(${saved}% smaller)</span></div>
                </div>
                <a href="${url}" download="compressed-1mb.pdf" style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">⬇ Download Compressed PDF</a>
                <br><br>
                <button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Compress Another</button>`;
        } else {
            const data = await resp.json().catch(()=>({}));
            result.innerHTML = `<div style="color:#ff6b6b">Error: ${data.error || 'Something went wrong. Please try again.'}</div>`;
        }
    } catch(e) {
        result.innerHTML = `<div style="color:#ff6b6b">Connection error. Please try again.</div>`;
    }
}
</script>
@endsection
