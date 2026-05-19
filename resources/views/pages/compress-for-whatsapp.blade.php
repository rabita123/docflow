@extends('tools.layout')

@section('title', 'Reduce PDF Size for WhatsApp — Compress PDF Free')
@section('description', 'Reduce PDF size for WhatsApp sharing. Compress any PDF to send via WhatsApp instantly. Free, no signup. Works on iPhone, Android and WhatsApp Web.')
@section('keywords', 'reduce pdf size for whatsapp, compress pdf for whatsapp, whatsapp pdf size limit, pdf too large for whatsapp, compress pdf whatsapp free, send large pdf whatsapp')
@section('slug', 'reduce-pdf-size-for-whatsapp')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Reduce PDF Size for WhatsApp",
  "description": "Compress your PDF so it can be sent on WhatsApp — free, instant, no signup.",
  "step": [
    {"@type":"HowToStep","position":1,"name":"Upload your PDF","text":"Upload your PDF to PDFTash. Works with any size PDF."},
    {"@type":"HowToStep","position":2,"name":"Compress it","text":"PDFTash automatically reduces the file size by up to 90%."},
    {"@type":"HowToStep","position":3,"name":"Send on WhatsApp","text":"Download the compressed PDF and share it on WhatsApp — phone or Web."}
  ]
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"What is WhatsApp's PDF file size limit?","acceptedAnswer":{"@type":"Answer","text":"WhatsApp allows document files up to 100MB. However, for fast sending and reliable delivery, especially on mobile data, keeping PDFs under 10MB is recommended."}},
    {"@type":"Question","name":"Why can't I send a PDF on WhatsApp?","acceptedAnswer":{"@type":"Answer","text":"If your PDF is over 100MB, WhatsApp will reject it. If it's under 100MB but still failing, it may be a network issue. Compressing with PDFTash reduces file size dramatically — making it fast and reliable to send."}},
    {"@type":"Question","name":"How do I send a large PDF on WhatsApp?","acceptedAnswer":{"@type":"Answer","text":"Compress the PDF with PDFTash first — most PDFs reduce by 70–90%. Then share the document file on WhatsApp (tap the paperclip icon → Document → select your compressed PDF)."}},
    {"@type":"Question","name":"Does compressing a PDF affect how it looks on WhatsApp?","acceptedAnswer":{"@type":"Answer","text":"No. The PDF opens exactly as normal in WhatsApp's built-in viewer. Text is always sharp, and images look identical at normal viewing sizes."}}
  ]
}
]
</script>
@endsection

@section('content')
<div class="hero">
  <div class="badge">💬 Compress PDF for WhatsApp</div>
  <h1>Reduce PDF Size for WhatsApp — Free</h1>
  <p>Compress any PDF so it sends instantly on WhatsApp. Works on iPhone, Android and WhatsApp Web. No signup, no watermark, completely free.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">📄</div>
    <div class="upload-title">Drop your PDF here to compress for WhatsApp</div>
    <div class="upload-sub">Click to browse · Supports any PDF · Free &amp; instant</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Files deleted after 2 hours · 100% secure</p>
  </div>
</div>

{{-- WHATSAPP SIZE INFO --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <div style="background:linear-gradient(135deg,rgba(37,211,102,.08),rgba(0,0,0,0));border:1px solid rgba(37,211,102,.25);border-radius:18px;padding:28px;">
    <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">💬 WhatsApp PDF Size — What You Need to Know</h2>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
      @foreach([
        ['WhatsApp File Limit','100MB maximum per document','Any PDF under 100MB can be sent. But large files load slowly on mobile data.'],
        ['Recommended Size','Under 10MB','PDFs under 10MB open instantly in WhatsApp. Under 5MB is ideal for mobile data users.'],
        ['For Fast Delivery','Under 2MB','For group chats with many members, keep PDFs under 2MB so everyone can load it quickly.'],
        ['WhatsApp Web','Same 100MB limit','Works the same on WhatsApp Web (browser). Compressed PDFs attach and send faster.'],
      ] as $w)
      <div style="background:rgba(0,0,0,.3);border-radius:10px;padding:16px;">
        <div style="font-weight:700;font-size:13px;color:#25d366;margin-bottom:4px;">{{ $w[0] }}</div>
        <div style="font-weight:600;font-size:14px;color:#eeeef8;margin-bottom:4px;">{{ $w[1] }}</div>
        <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $w[2] }}</div>
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- HOW TO SEND --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">How to Send a Compressed PDF on WhatsApp</h2>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['📱','On iPhone (iOS)','Compress PDF above → Download → Open WhatsApp → Chat → Tap paperclip → Document → Select PDF from Files app'],
      ['🤖','On Android','Compress PDF above → Download → Open WhatsApp → Chat → Tap paperclip → Document → Select from Downloads folder'],
      ['💻','WhatsApp Web','Compress PDF above → Download → Open web.whatsapp.com → Chat → Click paperclip → Select document → Pick compressed PDF'],
      ['🖇️','WhatsApp Business','Same as WhatsApp — paperclip → Document. Business accounts can also send via WhatsApp API with up to 100MB.'],
    ] as $h)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:20px;">
      <div style="font-size:26px;margin-bottom:8px;">{{ $h[0] }}</div>
      <div style="font-weight:600;font-size:13px;color:#eeeef8;margin-bottom:6px;">{{ $h[1] }}</div>
      <div style="color:#8888a8;font-size:12px;line-height:1.6;">{{ $h[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- RELATED TOOLS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">More Free PDF Tools</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([['Compress PDF','/compress-pdf'],['Compress to 200KB','/compress-pdf-to-200kb'],['Compress to 1MB','/compress-pdf-to-1mb'],['Compress for Email','/compress-pdf-for-email'],['Merge PDF','/merge-pdf'],['Split PDF','/split-pdf']] as $t)
    <a href="{{ $t[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — PDF for WhatsApp</h2>
  <div class="faq-item">
    <h3>What is the WhatsApp PDF size limit?</h3>
    <p>WhatsApp allows document files up to 100MB. However, large PDFs load slowly on mobile data and can fail to send on poor connections. Compressing to under 10MB ensures fast, reliable delivery on all network speeds.</p>
  </div>
  <div class="faq-item">
    <h3>Why is WhatsApp saying my PDF is too large?</h3>
    <p>If your PDF exceeds 100MB, WhatsApp will reject it. Compress it with PDFTash first — most PDFs shrink by 70–90%, bringing even large files well within WhatsApp's limit.</p>
  </div>
  <div class="faq-item">
    <h3>How do I compress a PDF on my phone for WhatsApp?</h3>
    <p>Open pdftash.com/reduce-pdf-size-for-whatsapp in your mobile browser (Safari or Chrome). Upload your PDF, download the compressed version, and share it in WhatsApp. No app download needed.</p>
  </div>
  <div class="faq-item">
    <h3>Can I send a PDF on WhatsApp without compressing?</h3>
    <p>Yes, if it's under 100MB. But for fast delivery and to avoid failures on slow connections, compressing to under 10MB is strongly recommended for group chats and business use.</p>
  </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = '#25d366'; });
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
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Compressing PDF for WhatsApp...</div>';
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
                <div style="background:#0a1a0a;border:1px solid #25d366;border-radius:12px;padding:20px;margin-bottom:16px;">
                    <div style="color:#25d366;font-size:18px;font-weight:700;margin-bottom:8px">✅ Ready to Send on WhatsApp!</div>
                    <div style="color:#8888a8;font-size:14px">${(file.size/1024).toFixed(0)}KB → <strong style="color:#eeeef8">${(blob.size/1024).toFixed(0)}KB</strong> <span style="color:#25d366;font-weight:600">(${saved}% smaller)</span></div>
                </div>
                <a href="${url}" download="whatsapp-pdf.pdf" style="display:inline-block;padding:14px 32px;background:#25d366;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">⬇ Download &amp; Send on WhatsApp</a>
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
