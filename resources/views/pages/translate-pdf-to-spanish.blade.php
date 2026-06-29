@extends('tools.layout')

@section('title', 'Translate PDF to Spanish Free — AI PDF Translator Online')
@section('description', 'Translate any PDF to Spanish online free. AI-powered translation preserves paragraph structure. No signup, no watermark. Upload and download in seconds.')
@section('keywords', 'translate pdf to spanish, pdf to spanish translator, translate pdf spanish online free, convert pdf to spanish, pdf spanish translation free, traducir pdf al español')
@section('slug', 'translate-pdf-to-spanish')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash — Translate PDF to Spanish",
  "applicationCategory": "WebApplication",
  "operatingSystem": "Any",
  "description": "Free AI-powered tool to translate any PDF to Spanish online. No signup required. Preserves paragraph structure and formatting.",
  "url": "https://pdftash.com/translate-pdf-to-spanish",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"},
  "aggregateRating": {"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"1843"}
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"Can I translate a PDF to Spanish for free?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash translates any PDF to Spanish for free with no signup required. Free users get 1 translation per day. Pro users get unlimited translations."}},
    {"@type":"Question","name":"How accurate is AI PDF translation to Spanish?","acceptedAnswer":{"@type":"Answer","text":"PDFTash uses advanced AI which produces natural, contextually accurate Spanish translations. It handles technical, legal, and academic documents well."}},
    {"@type":"Question","name":"Does the translation preserve the original formatting?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash preserves paragraph breaks and document structure in the translated output. You can download as formatted PDF or plain text."}},
    {"@type":"Question","name":"Can I translate Spanish PDF to English?","acceptedAnswer":{"@type":"Answer","text":"Yes — use the main Translate PDF tool and select English as the target language to convert Spanish PDFs to English."}},
    {"@type":"Question","name":"What is the maximum PDF size I can translate?","acceptedAnswer":{"@type":"Answer","text":"Free users can translate PDFs up to 10MB (approx. 6,000 words). Pro users can translate larger documents with no size restrictions."}}
  ]
}
]
</script>
@endsection

@section('content')
<div class="hero">
  <div style="display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin-bottom:20px;">
    <div class="badge">🇪🇸 PDF to Spanish</div>
    <div class="badge" style="background:rgba(0,229,160,.1);border-color:rgba(0,229,160,.4);color:#00e5a0;">🆓 Free</div>
  </div>
  <h1>Translate PDF to Spanish — Free AI Translator</h1>
  <p>Upload any PDF and get an accurate Spanish translation in seconds. AI preserves paragraph structure. No signup, no watermark, instant download.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">🇪🇸</div>
    <div class="upload-title">Drop your PDF here to Translate to Spanish</div>
    <div class="upload-sub">Any PDF · Free · No signup · AI-powered</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Files deleted after 2 hours · 100% private</p>
  </div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:12px;">Who Uses PDF to Spanish Translation?</h2>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:24px;">
    @foreach([
      ['🎓','Students & Researchers','Translate English academic papers and research to Spanish for study or citation.'],
      ['💼','Business Professionals','Convert English contracts, proposals, and reports to Spanish for Latin American clients.'],
      ['⚖️','Legal Professionals','Translate English legal documents, agreements, and court orders to Spanish.'],
      ['🏥','Healthcare Workers','Convert medical records, prescriptions, and patient documents to Spanish.'],
      ['✈️','Travelers & Expats','Translate official documents, visa applications, and government forms to Spanish.'],
      ['📰','Content Creators','Translate English content to Spanish to reach 500M+ Spanish-speaking audience.'],
    ] as $f)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:20px;">
      <div style="font-size:24px;margin-bottom:8px;">{{ $f[0] }}</div>
      <div style="font-weight:600;font-size:13px;color:#eeeef8;margin-bottom:5px;">{{ $f[1] }}</div>
      <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $f[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">Translate PDF to Other Languages</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([
      ['🇧🇩 Bengali','/pdf-translator-bengali'],
      ['🇮🇳 Hindi','/translate-pdf-to-hindi'],
      ['🇸🇦 Arabic','/translate-pdf-to-arabic'],
      ['🇫🇷 French','/translate-pdf-to-french'],
      ['🇩🇪 German','/translate-pdf-to-german'],
      ['🇧🇷 Portuguese','/translate-pdf-to-portuguese'],
      ['🇨🇳 Chinese','/translate-pdf-to-chinese'],
      ['🇯🇵 Japanese','/translate-pdf-to-japanese'],
      ['🌐 All Languages','/translate-pdf'],
    ] as $l)
    <a href="{{ $l[1] }}" style="padding:8px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $l[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — Translate PDF to Spanish</h2>
  <div class="faq-item">
    <h3>How do I translate a PDF to Spanish online for free?</h3>
    <p>Upload your PDF above, wait 10–30 seconds for AI processing, and download the Spanish translation as a TXT file or print-formatted PDF. No account or payment required.</p>
  </div>
  <div class="faq-item">
    <h3>Is AI Spanish translation as good as a human translator?</h3>
    <p>For everyday documents, reports, and general content — yes, it's excellent. For certified legal translations or sworn documents, a licensed human translator is still required. PDFTash's AI is ideal for understanding documents, study, and business use.</p>
  </div>
  <div class="faq-item">
    <h3>Can I translate a PDF from Spanish to English?</h3>
    <p>Yes — use our <a href="/translate-pdf" style="color:#5b5cff">Translate PDF</a> tool and select English as the target language. The AI detects the source language automatically.</p>
  </div>
  <div class="faq-item">
    <h3>Does translating preserve tables and lists?</h3>
    <p>Yes. Paragraph structure, bullet points, and numbered lists are preserved in the translation output. Complex tables may be flattened into text but content is fully translated.</p>
  </div>
  <div class="faq-item">
    <h3>How many PDFs can I translate per day?</h3>
    <p>Free users get 1 AI translation per day. Pro users ($2/month) get unlimited translations across all 12+ supported languages.</p>
  </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
let selectedFile = null;
const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = '#5b5cff'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', (e) => { e.preventDefault(); const f = e.dataTransfer.files[0]; if (f && f.type === 'application/pdf') showFile(f); });
function handleFile(input) { if (input.files[0]) showFile(input.files[0]); }
function showFile(file) {
    selectedFile = file;
    dropZone.querySelector('.upload-title').textContent = '✅ ' + file.name + ' — Click to translate';
    dropZone.onclick = processTranslate;
}
async function processTranslate() {
    if (!selectedFile) return;
    const result = document.getElementById('result');
    result.style.display = 'block';
    let secs = 0;
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Translating to Spanish... <span id="timer">0s</span></div>';
    const timerEl = document.getElementById('timer');
    const timerInterval = setInterval(() => { secs++; if(timerEl) timerEl.textContent = secs + 's'; }, 1000);
    const fd = new FormData();
    fd.append('file', selectedFile);
    fd.append('language', 'Spanish');
    fd.append('_token', CSRF);
    const controller = new AbortController();
    const timeout = setTimeout(() => controller.abort(), 150000);
    try {
        const resp = await fetch('/api/ai/translate', {method:'POST', body:fd, signal:controller.signal});
        clearTimeout(timeout); clearInterval(timerInterval);
        const data = await resp.json();
        if (resp.ok) {
            const text = data.translation || data.text || '';
            const escaped = text.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
            result.innerHTML = `<div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;text-align:left;margin-bottom:16px;">
                <div style="color:#00e5a0;font-weight:700;margin-bottom:12px;">✅ Translated to Spanish in ${secs}s!</div>
                <div style="color:#eeeef8;font-size:14px;line-height:1.7;white-space:pre-wrap;max-height:320px;overflow-y:auto;border:1px solid rgba(255,255,255,.08);border-radius:8px;padding:14px;margin-bottom:16px;">${escaped}</div>
                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    <button onclick="dlTxt(${JSON.stringify(text)})" style="flex:1;min-width:140px;padding:11px 20px;background:#5b5cff;color:#fff;border:none;border-radius:99px;font-size:14px;font-weight:600;cursor:pointer;">⬇ Download TXT</button>
                    <button onclick="dlPdf(${JSON.stringify(text)},'Spanish')" style="flex:1;min-width:140px;padding:11px 20px;background:#00e5a0;color:#000;border:none;border-radius:99px;font-size:14px;font-weight:600;cursor:pointer;">⬇ Download PDF</button>
                </div>
            </div>
            <button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Translate Another</button>`;
        } else if (data.error === 'pro_required' || data.error === 'free_limit_reached') {
            result.innerHTML = `<div style="background:#1a1a0a;border:1px solid #ffa500;border-radius:12px;padding:20px;"><div style="color:#ffa500;font-weight:700;margin-bottom:8px">⚡ Daily limit reached</div><div style="color:#8888a8;font-size:14px;margin-bottom:16px">Free users get 1 translation per day. Upgrade to Pro for unlimited.</div><a href="/payment/checkout" style="display:inline-block;padding:12px 24px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:700;">Upgrade to Pro →</a></div>`;
        } else {
            result.innerHTML = `<div style="color:#ff6b6b">Error: ${data.error || 'Something went wrong'}</div>`;
        }
    } catch(e) {
        clearTimeout(timeout); clearInterval(timerInterval);
        result.innerHTML = `<div style="color:#ff6b6b">${e.name==='AbortError'?'Request timed out. Try a smaller PDF.':'Connection error. Please try again.'}</div>`;
    }
}
function dlTxt(text) {
    const blob = new Blob([text], {type:'text/plain;charset=utf-8'});
    const a = document.createElement('a'); a.href = URL.createObjectURL(blob); a.download = 'translation-spanish.txt'; a.click();
}
function dlPdf(text, lang) {
    const escaped = text.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    const paras = escaped.split('\n').filter(p=>p.trim()).map(p=>`<p>${p}</p>`).join('');
    const html = `<!DOCTYPE html><html><head><meta charset="UTF-8"><link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet"><style>*{margin:0;padding:0;box-sizing:border-box;}body{font-family:'Noto Sans',Arial,sans-serif;font-size:12pt;line-height:1.9;color:#1e293b;}.cover{background:#1e40af;color:white;padding:40px 50px 30px;}.cover h1{font-size:20pt;font-weight:700;}.body{padding:40px 50px;}p{margin-bottom:14px;text-align:justify;}.footer{margin-top:30px;padding-top:10px;border-top:1px solid #e2e8f0;font-size:9pt;color:#94a3b8;text-align:center;}@media print{@page{margin:0;size:A4;}body{-webkit-print-color-adjust:exact;print-color-adjust:exact;}}</style></head><body><div class="cover"><div style="font-size:9pt;opacity:.6;margin-bottom:8px;text-transform:uppercase;">PDFTash · AI Translation</div><h1>Translated to ${lang}</h1><div style="font-size:9pt;opacity:.45;margin-top:8px;">${new Date().toLocaleDateString('en-GB',{day:'2-digit',month:'short',year:'numeric'})}</div></div><div class="body">${paras}<div class="footer">Translated by PDFTash AI · pdftash.com</div></div><script>document.fonts.ready.then(()=>setTimeout(()=>window.print(),500));<\/script></body></html>`;
    const win = window.open('','_blank');
    if(!win){alert('Allow popups then click Download PDF again.');return;}
    win.document.write(html); win.document.close();
}
</script>
@endsection
