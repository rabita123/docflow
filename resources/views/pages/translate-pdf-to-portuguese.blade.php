@extends('tools.layout')
@section('title', 'Translate PDF to Portuguese Free — Traduzir PDF em Português')
@section('description', 'Translate PDF to Portuguese online free. AI-powered translation for Brazilian and European Portuguese. No signup, instant download, no watermark.')
@section('keywords', 'translate pdf to portuguese, pdf to portuguese translator, traduzir pdf portugues, pdf portuguese translation free, translate pdf pt, pdf para português')
@section('slug', 'translate-pdf-to-portuguese')
@section('schema')
<script type="application/ld+json">
[{"@context":"https://schema.org","@type":"SoftwareApplication","name":"PDFTash — Translate PDF to Portuguese","applicationCategory":"WebApplication","operatingSystem":"Any","description":"Free AI tool to translate any PDF to Portuguese online. Supports Brazilian and European Portuguese. No signup required.","url":"https://pdftash.com/translate-pdf-to-portuguese","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"aggregateRating":{"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"1380"}},
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
{"@type":"Question","name":"Can I translate PDF to Brazilian Portuguese?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash AI produces Brazilian Portuguese (PT-BR) by default, with natural vocabulary and phrasing used in Brazil. European Portuguese is also supported."}},
{"@type":"Question","name":"Is PDF to Portuguese translation free?","acceptedAnswer":{"@type":"Answer","text":"Yes. Free users get 1 translation per day with no signup. Pro users get unlimited translations."}},
{"@type":"Question","name":"Can I translate a Portuguese PDF to English?","acceptedAnswer":{"@type":"Answer","text":"Yes — use our Translate PDF tool and select English as the target language."}}
]}]
</script>
@endsection
@section('content')
<div class="hero">
  <div style="display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin-bottom:20px;">
    <div class="badge">🇧🇷 PDF to Portuguese</div>
    <div class="badge" style="background:rgba(0,229,160,.1);border-color:rgba(0,229,160,.4);color:#00e5a0;">🆓 Free</div>
  </div>
  <h1>Translate PDF to Portuguese — Traduzir PDF em Português</h1>
  <p>AI-powered Portuguese translation for any PDF. Brazilian and European Portuguese supported. No signup, instant download.</p>
</div>
<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">🇧🇷</div>
    <div class="upload-title">Drop your PDF here to Translate to Portuguese</div>
    <div class="upload-sub">Any PDF · Free · No signup · AI-powered</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;"><p style="color:#8888a8;font-size:12px;">Files deleted after 2 hours · 100% private</p></div>
</div>
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">Translate PDF to Other Languages</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([['🇧🇩 Bengali','/pdf-translator-bengali'],['🇮🇳 Hindi','/translate-pdf-to-hindi'],['🇪🇸 Spanish','/translate-pdf-to-spanish'],['🇫🇷 French','/translate-pdf-to-french'],['🇸🇦 Arabic','/translate-pdf-to-arabic'],['🌐 All Languages','/translate-pdf']] as $l)
    <a href="{{ $l[1] }}" style="padding:8px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $l[0] }}</a>
    @endforeach
  </div>
</div>
<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item"><h3>Does PDFTash support Brazilian Portuguese?</h3><p>Yes. The AI produces natural Brazilian Portuguese (PT-BR) by default, including common Brazilian vocabulary and phrasing.</p></div>
  <div class="faq-item"><h3>How do I download the Portuguese translation?</h3><p>After translation completes, click "Download TXT" to save the translated text file, or "Download PDF" to get a formatted printable PDF.</p></div>
  <div class="faq-item"><h3>How many PDFs can I translate per day for free?</h3><p>1 per day on the free plan. Pro ($2/month) gives unlimited translations.</p></div>
</div>
<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
let selectedFile = null;
const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor='#5b5cff'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor='rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', (e) => { e.preventDefault(); const f=e.dataTransfer.files[0]; if(f?.type==='application/pdf') showFile(f); });
function handleFile(input) { if(input.files[0]) showFile(input.files[0]); }
function showFile(file) { selectedFile=file; dropZone.querySelector('.upload-title').textContent='✅ '+file.name; dropZone.onclick=processTranslate; }
async function processTranslate() {
    if(!selectedFile) return;
    const result=document.getElementById('result'); result.style.display='block';
    let secs=0; result.innerHTML='<div style="color:#8888a8;padding:20px">⏳ Translating to Portuguese... <span id="timer">0s</span></div>';
    const iv=setInterval(()=>{secs++;const t=document.getElementById('timer');if(t)t.textContent=secs+'s';},1000);
    const fd=new FormData(); fd.append('file',selectedFile); fd.append('language','Portuguese'); fd.append('_token',CSRF);
    const ctrl=new AbortController(); const to=setTimeout(()=>ctrl.abort(),150000);
    try {
        const resp=await fetch('/api/ai/translate',{method:'POST',body:fd,signal:ctrl.signal});
        clearTimeout(to); clearInterval(iv); const data=await resp.json();
        if(resp.ok){
            window._xlText=data.translation||data.text||'';
            const esc=window._xlText.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
            result.innerHTML=`<div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;text-align:left;margin-bottom:16px;"><div style="color:#00e5a0;font-weight:700;margin-bottom:12px;">✅ Translated to Portuguese in ${secs}s!</div><div style="color:#eeeef8;font-size:14px;line-height:1.7;white-space:pre-wrap;max-height:320px;overflow-y:auto;border:1px solid rgba(255,255,255,.08);border-radius:8px;padding:14px;margin-bottom:16px;">${esc}</div><button onclick="const b=new Blob([window._xlText],{type:'text/plain;charset=utf-8'});const a=document.createElement('a');a.href=URL.createObjectURL(b);a.download='translation-portuguese.txt';a.click();" style="padding:11px 24px;background:#5b5cff;color:#fff;border:none;border-radius:99px;font-size:14px;font-weight:600;cursor:pointer;">⬇ Download TXT</button></div><button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Translate Another</button>`;
        } else if(data.error==='pro_required'||data.error==='free_limit_reached'){
            result.innerHTML=`<div style="background:#1a1a0a;border:1px solid #ffa500;border-radius:12px;padding:20px;"><div style="color:#ffa500;font-weight:700;margin-bottom:8px">⚡ Daily limit reached</div><a href="/payment/checkout" style="display:inline-block;padding:12px 24px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:700;margin-top:12px;">Upgrade to Pro →</a></div>`;
        } else { result.innerHTML=`<div style="color:#ff6b6b">Error: ${data.error||'Something went wrong'}</div>`; }
    } catch(e){clearTimeout(to);clearInterval(iv);result.innerHTML=`<div style="color:#ff6b6b">${e.name==='AbortError'?'Timed out.':'Connection error.'}</div>`;}
}
</script>
@endsection
