@extends('tools.layout')

@section('title', 'Compress PDF for Email — Reduce PDF Size for Gmail & Outlook Free')
@section('description', 'Compress PDF for email attachments instantly. Reduce PDF size for Gmail, Outlook and Yahoo Mail. Free, no signup. Get any PDF under the email size limit in seconds.')
@section('keywords', 'compress pdf for email, reduce pdf size for email, pdf attachment too large, compress pdf gmail, compress pdf outlook, make pdf smaller for email, pdf email attachment size reducer')
@section('slug', 'compress-pdf-for-email')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Compress PDF for Email Attachment",
  "description": "Reduce your PDF file size for email in 3 steps — free, no signup, works for Gmail, Outlook and Yahoo.",
  "step": [
    {"@type":"HowToStep","position":1,"name":"Upload your PDF","text":"Drag and drop or click to upload your PDF. Works with any PDF file."},
    {"@type":"HowToStep","position":2,"name":"Compress automatically","text":"PDFTash compresses images, removes metadata and subsets fonts — reducing size by up to 90%."},
    {"@type":"HowToStep","position":3,"name":"Download and attach","text":"Download the compressed PDF and attach it to your email. Sends every time."}
  ]
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"What is the maximum PDF size for email attachments?","acceptedAnswer":{"@type":"Answer","text":"Gmail allows up to 25MB total per email. Outlook supports up to 20MB. Yahoo Mail allows 25MB. However, corporate email systems often limit attachments to 5MB or 10MB. PDFTash can compress your PDF to well under any of these limits."}},
    {"@type":"Question","name":"My PDF attachment is too large to send — what do I do?","acceptedAnswer":{"@type":"Answer","text":"Upload your PDF to PDFTash. The compressor will reduce it by 70–90% in most cases. A 10MB PDF typically compresses to under 2MB — easily attachable to any email."}},
    {"@type":"Question","name":"Will the compressed PDF look different to the recipient?","acceptedAnswer":{"@type":"Answer","text":"No. Text always looks identical. Images may have marginally lower pixel density but appear identical on screen and when printed at normal sizes."}},
    {"@type":"Question","name":"Can I compress multiple PDFs for email at once?","acceptedAnswer":{"@type":"Answer","text":"Currently PDFTash compresses one PDF at a time. You can upload and compress multiple files back-to-back with no daily limit."}},
    {"@type":"Question","name":"Is there an alternative to attaching a large PDF?","acceptedAnswer":{"@type":"Answer","text":"Yes — upload to Google Drive and share a link instead. But if you need an actual attachment, compressing with PDFTash is the fastest solution."}}
  ]
}
]
</script>
@endsection

@section('content')
<div class="hero">
  <div class="badge">📧 Compress PDF for Email</div>
  <h1>Compress PDF for Email Attachments — Free</h1>
  <p>PDF too large to send? Reduce your PDF size for Gmail, Outlook, and Yahoo Mail in one click. No signup, no watermark. Works on any device.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">📄</div>
    <div class="upload-title">Drop your PDF here — compress it for email</div>
    <div class="upload-sub">Click to browse · Any PDF size · Free &amp; instant</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Files deleted after 2 hours · Encrypted upload · No data stored</p>
  </div>
</div>

{{-- EMAIL LIMITS INFO BOX --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:20px;">Email Attachment Size Limits</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
    @foreach([
      ['📬','Gmail','25MB total per email. Recommends under 10MB for reliability.'],
      ['📨','Outlook','20MB attachment limit. Corporate Outlook often lower (5–10MB).'],
      ['📩','Yahoo Mail','25MB per attachment. Shared mailboxes often limited to 10MB.'],
    ] as $e)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:18px;text-align:center;">
      <div style="font-size:28px;margin-bottom:8px;">{{ $e[0] }}</div>
      <div style="font-weight:700;font-size:14px;color:#eeeef8;margin-bottom:6px;">{{ $e[1] }}</div>
      <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $e[2] }}</div>
    </div>
    @endforeach
  </div>
  <div style="background:rgba(91,92,255,.08);border:1px solid rgba(91,92,255,.2);border-radius:10px;padding:14px;margin-top:14px;font-size:13px;color:#8888a8;text-align:center;line-height:1.6;">
    💡 <strong style="color:#eeeef8;">Tip:</strong> Even within the limit, smaller PDFs load faster for recipients and are less likely to be flagged by spam filters. Aim for <strong style="color:#9898ff;">under 5MB</strong> for best deliverability.
  </div>
</div>

{{-- WHY PDF IS TOO LARGE --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:20px;">Why Is Your PDF So Large?</h2>
  <div style="display:flex;flex-direction:column;gap:12px;">
    @foreach([
      ['📸','High-resolution embedded images','Photos, scanned pages and screenshots inside PDFs are the #1 cause of large file size. A single 300 DPI scanned page can be 500KB–2MB on its own.'],
      ['🔤','Embedded font files','PDFs embed entire font files (sometimes 2–5MB each) even if only a few characters are used from that font.'],
      ['📂','Hidden metadata and layers','Office software, design tools (Illustrator, InDesign) embed editing history, author data, hidden layers and comments that add invisible bulk.'],
      ['🗂️','Uncompressed content streams','Some PDF generators don\'t apply stream compression, resulting in 3–5× larger files than necessary.'],
    ] as $r)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:18px;display:flex;gap:14px;align-items:flex-start;">
      <div style="font-size:28px;flex-shrink:0;">{{ $r[0] }}</div>
      <div>
        <div style="font-weight:600;font-size:14px;color:#eeeef8;margin-bottom:4px;">{{ $r[1] }}</div>
        <div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $r[2] }}</div>
      </div>
    </div>
    @endforeach
  </div>
</div>

{{-- HOW IT WORKS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">How to Compress PDF for Email in 3 Steps</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
    @foreach([
      ['📤','1. Upload','Drag your PDF into the box. Supports any PDF — presentations, scanned documents, reports.'],
      ['⚙️','2. Auto-Compress','PDFTash re-encodes images, strips metadata and subsets fonts automatically.'],
      ['📧','3. Send!','Download the compressed PDF and attach it to your email. Under the limit every time.'],
    ] as $s)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:20px;text-align:center;">
      <div style="font-size:28px;margin-bottom:10px;">{{ $s[0] }}</div>
      <div style="font-weight:600;margin-bottom:6px;font-size:13px;">{{ $s[1] }}</div>
      <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $s[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- RELATED --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">More Free PDF Tools</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([['Compress PDF','/compress-pdf'],['Compress to 200KB','/compress-pdf-to-200kb'],['Compress to 1MB','/compress-pdf-to-1mb'],['Merge PDF','/merge-pdf'],['Split PDF','/split-pdf'],['Sign PDF','/sign-pdf']] as $t)
    <a href="{{ $t[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — Compress PDF for Email</h2>
  <div class="faq-item">
    <h3>My email says the PDF attachment is too large — what do I do?</h3>
    <p>Upload your PDF to PDFTash above. Most PDFs compress by 70–90% in one pass. A 10MB PDF becomes 1–2MB — easily under any email provider's limit.</p>
  </div>
  <div class="faq-item">
    <h3>What is the Gmail attachment size limit?</h3>
    <p>Gmail allows attachments up to 25MB total per email. However, for reliability, Google recommends keeping attachments under 10MB. Corporate Gmail accounts (Google Workspace) may have lower limits set by the admin.</p>
  </div>
  <div class="faq-item">
    <h3>Will the recipient's PDF look different after compression?</h3>
    <p>For the vast majority of documents, no. Text is always crisp (it's vector). Images may have marginally lower resolution but look identical on screen and when printed on A4 paper.</p>
  </div>
  <div class="faq-item">
    <h3>Can I compress a PDF on my phone before emailing?</h3>
    <p>Yes. PDFTash works in any mobile browser — Safari on iPhone, Chrome on Android. Upload, compress, download, and attach to your email app in under a minute.</p>
  </div>
  <div class="faq-item">
    <h3>Should I share a Google Drive link instead of attaching a large PDF?</h3>
    <p>That works too, but attachments are often preferred in professional settings. If you need an actual attached PDF, compressing with PDFTash is the fastest solution and doesn't require the recipient to have a Google account.</p>
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
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Compressing your PDF for email...</div>';
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
                    <div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:8px">✅ Ready to Email!</div>
                    <div style="color:#8888a8;font-size:14px">${(file.size/1024).toFixed(0)}KB → <strong style="color:#eeeef8">${(blob.size/1024).toFixed(0)}KB</strong> <span style="color:#00e5a0;font-weight:600">(${saved}% smaller)</span></div>
                </div>
                <a href="${url}" download="compressed-for-email.pdf" style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">⬇ Download &amp; Attach to Email</a>
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
