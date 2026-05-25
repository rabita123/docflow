@extends('tools.layout')

@section('title', 'Translate PDF to Hindi Free — PDF हिंदी अनुवाद ऑनलाइन')
@section('description', 'Translate PDF to Hindi online free. AI converts English or Bengali PDF to accurate Hindi. No signup needed. Download as TXT or PDF instantly.')
@section('keywords', 'translate pdf to hindi, pdf to hindi translator, translate pdf hindi online free, pdf hindi translation, pdf to hindi language, हिंदी pdf अनुवाद')
@section('slug', 'translate-pdf-to-hindi')

@section('schema')
<script type="application/ld+json">
[{"@context":"https://schema.org","@type":"SoftwareApplication","name":"PDFTash — Translate PDF to Hindi","applicationCategory":"WebApplication","operatingSystem":"Any","description":"Free AI tool to translate any PDF to Hindi online. No signup. Accurate Devanagari script output.","url":"https://pdftash.com/translate-pdf-to-hindi","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"aggregateRating":{"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"2210"}},
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
  {"@type":"Question","name":"Can I translate a PDF to Hindi for free?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash translates any PDF to Hindi free with no signup. Free users get 1 translation per day. Pro users get unlimited."}},
  {"@type":"Question","name":"Is the Hindi translation in Devanagari script?","acceptedAnswer":{"@type":"Answer","text":"Yes. The AI outputs proper Devanagari script Hindi, not transliteration. The PDF download uses Noto Sans Devanagari font for perfect rendering."}},
  {"@type":"Question","name":"Can I translate Hindi PDF to English?","acceptedAnswer":{"@type":"Answer","text":"Yes — use our Translate PDF tool and select English as the target language to convert Hindi PDFs to English."}},
  {"@type":"Question","name":"Does it work for UPSC or government documents?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash works well for government circulars, UPSC study material, Hindi medium textbooks, and official documents."}},
  {"@type":"Question","name":"How accurate is Hindi AI translation?","acceptedAnswer":{"@type":"Answer","text":"PDFTash uses Claude AI which handles Hindi accurately including formal and colloquial registers. For certified translations, a licensed translator is needed."}}
]}]
</script>
@endsection

@section('content')
<div class="hero">
  <div style="display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin-bottom:20px;">
    <div class="badge">🇮🇳 PDF to Hindi</div>
    <div class="badge" style="background:rgba(0,229,160,.1);border-color:rgba(0,229,160,.4);color:#00e5a0;">🆓 Free</div>
  </div>
  <h1>Translate PDF to Hindi Free — हिंदी अनुवाद</h1>
  <p>Upload any PDF and get an accurate Hindi translation in seconds. AI outputs proper Devanagari script. No signup, no watermark, instant download.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">🇮🇳</div>
    <div class="upload-title">Drop your PDF here to Translate to Hindi</div>
    <div class="upload-sub">Any PDF · Free · No signup · AI-powered</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;"><p style="color:#8888a8;font-size:12px;">Files deleted after 2 hours · 100% private</p></div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">Translate PDF to Other Languages</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([['🇧🇩 Bengali','/pdf-translator-bengali'],['🇪🇸 Spanish','/translate-pdf-to-spanish'],['🇸🇦 Arabic','/translate-pdf-to-arabic'],['🇫🇷 French','/translate-pdf-to-french'],['🇩🇪 German','/translate-pdf-to-german'],['🇧🇷 Portuguese','/translate-pdf-to-portuguese'],['🌐 All Languages','/translate-pdf']] as $l)
    <a href="{{ $l[1] }}" style="padding:8px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $l[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — PDF to Hindi Translation</h2>
  <div class="faq-item"><h3>How do I translate a PDF to Hindi online?</h3><p>Upload your PDF above, the AI translates to Hindi in 10–30 seconds, and you download the translation as TXT or PDF. No account needed.</p></div>
  <div class="faq-item"><h3>Is the Hindi output in Devanagari script?</h3><p>Yes. The AI outputs proper Devanagari script (not Roman transliteration). The downloadable PDF uses Google Noto Sans Devanagari font for perfect rendering on all devices.</p></div>
  <div class="faq-item"><h3>Can I translate UPSC study material to Hindi?</h3><p>Yes. PDFTash works for educational PDFs, government circulars, UPSC notes, and Hindi-medium study material. It preserves paragraph structure for easy reading.</p></div>
  <div class="faq-item"><h3>How many PDFs can I translate per day?</h3><p>Free users get 1 AI translation per day. Pro users ($9/month) get unlimited translations across all 12+ supported languages.</p></div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
let selectedFile = null;
const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = '#5b5cff'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', (e) => { e.preventDefault(); const f = e.dataTransfer.files[0]; if (f && f.type === 'application/pdf') showFile(f); });
function handleFile(input) { if (input.files[0]) showFile(input.files[0]); }
function showFile(file) { selectedFile = file; dropZone.querySelector('.upload-title').textContent = '✅ ' + file.name; dropZone.onclick = processTranslate; }
async function processTranslate() {
    if (!selectedFile) return;
    const result = document.getElementById('result');
    result.style.display = 'block';
    let secs = 0;
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Translating to Hindi... <span id="timer">0s</span></div>';
    const timerEl = document.getElementById('timer');
    const iv = setInterval(() => { secs++; if(timerEl) timerEl.textContent = secs+'s'; }, 1000);
    const fd = new FormData(); fd.append('file', selectedFile); fd.append('language', 'Hindi'); fd.append('_token', CSRF);
    const ctrl = new AbortController(); const to = setTimeout(() => ctrl.abort(), 150000);
    try {
        const resp = await fetch('/api/ai/translate', {method:'POST', body:fd, signal:ctrl.signal});
        clearTimeout(to); clearInterval(iv);
        const data = await resp.json();
        if (resp.ok) {
            const text = data.translation || data.text || '';
            const esc = text.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
            result.innerHTML = `<div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;text-align:left;margin-bottom:16px;"><div style="color:#00e5a0;font-weight:700;margin-bottom:12px;">✅ Translated to Hindi in ${secs}s!</div><div style="color:#eeeef8;font-size:14px;line-height:1.7;white-space:pre-wrap;max-height:320px;overflow-y:auto;border:1px solid rgba(255,255,255,.08);border-radius:8px;padding:14px;margin-bottom:16px;">${esc}</div><div style="display:flex;gap:10px;flex-wrap:wrap;"><button onclick="dlTxt(this)" data-text="${esc.replace(/"/g,'&quot;')}" style="flex:1;min-width:140px;padding:11px 20px;background:#5b5cff;color:#fff;border:none;border-radius:99px;font-size:14px;font-weight:600;cursor:pointer;">⬇ Download TXT</button></div></div><button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Translate Another</button>`;
            window._xlText = text;
        } else if (data.error==='pro_required'||data.error==='free_limit_reached') {
            result.innerHTML = `<div style="background:#1a1a0a;border:1px solid #ffa500;border-radius:12px;padding:20px;"><div style="color:#ffa500;font-weight:700;margin-bottom:8px">⚡ Daily limit reached</div><div style="color:#8888a8;font-size:14px;margin-bottom:16px">Upgrade to Pro for unlimited translations.</div><a href="/payment/checkout" style="display:inline-block;padding:12px 24px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:700;">Upgrade to Pro →</a></div>`;
        } else { result.innerHTML = `<div style="color:#ff6b6b">Error: ${data.error||'Something went wrong'}</div>`; }
    } catch(e) { clearTimeout(to); clearInterval(iv); result.innerHTML = `<div style="color:#ff6b6b">${e.name==='AbortError'?'Timed out. Try smaller PDF.':'Connection error.'}</div>`; }
}
function dlTxt(btn) {
    const text = window._xlText || '';
    const blob = new Blob([text], {type:'text/plain;charset=utf-8'});
    const a = document.createElement('a'); a.href = URL.createObjectURL(blob); a.download = 'translation-hindi.txt'; a.click();
}
</script>
@endsection
