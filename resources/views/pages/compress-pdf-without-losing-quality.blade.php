@extends('tools.layout')
@section('title', 'Compress PDF Without Losing Quality — Free Online Tool')
@section('description', 'Compress PDF without losing quality online free. Smart compression reduces file size while keeping text sharp and images visually identical. No signup, instant download.')
@section('keywords', 'compress pdf without losing quality, lossless pdf compression, compress pdf keep quality, pdf compression no quality loss, reduce pdf size without losing quality free')
@section('slug', 'compress-pdf-without-losing-quality')
@section('schema')
<script type="application/ld+json">
[{"@context":"https://schema.org","@type":"SoftwareApplication","name":"PDFTash — Compress PDF Without Quality Loss","applicationCategory":"WebApplication","operatingSystem":"Any","description":"Free online tool to compress PDF files while maintaining visual quality. Smart compression keeps text sharp and images clear.","url":"https://pdftash.com/compress-pdf-without-losing-quality","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"aggregateRating":{"@type":"AggregateRating","ratingValue":"4.9","reviewCount":"2341"}},
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
{"@type":"Question","name":"Does PDF compression always reduce quality?","acceptedAnswer":{"@type":"Answer","text":"No. Text in PDFs is vector data and never loses quality during compression. Only embedded images are re-encoded, and PDFTash uses a high-quality setting that is visually indistinguishable from the original."}},
{"@type":"Question","name":"How much can I compress a PDF without losing quality?","acceptedAnswer":{"@type":"Answer","text":"Typically 30–70% smaller with no visible quality loss. A 10MB PDF often compresses to 2–4MB while looking identical. Scanned PDFs can compress even more."}},
{"@type":"Question","name":"What's the difference between lossless and lossy PDF compression?","acceptedAnswer":{"@type":"Answer","text":"Lossless compression removes metadata and redundant data without touching images. Lossy compression re-encodes images at lower quality. PDFTash uses high-quality lossy compression that is visually lossless for most documents."}},
{"@type":"Question","name":"Will the text in my PDF still be searchable after compression?","acceptedAnswer":{"@type":"Answer","text":"Yes. Text remains searchable, copyable, and perfectly sharp. Compression only affects embedded image data and metadata."}}
]}]
</script>
@endsection
@section('content')
<div class="hero">
  <div class="badge">🗜️ Quality Compression</div>
  <h1>Compress PDF Without Losing Quality</h1>
  <p>Smart compression that keeps your text crystal-clear and images visually identical — while reducing file size by 30–80%. Free, no signup, instant download.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">📄</div>
    <div class="upload-title">Drop your PDF here to compress — quality preserved</div>
    <div class="upload-sub">Click to browse · Any size · Free &amp; instant</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;"><p style="color:#8888a8;font-size:12px;">Files deleted after 2 hours · 100% secure</p></div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:28px;">Why PDF Quality is Preserved</h2>
  <div style="display:flex;flex-direction:column;gap:14px;">
    @foreach([
      ['🔤','Text is Always Perfect','PDF text is stored as vector data (not images). It never degrades during compression — it stays perfectly sharp at any zoom level.'],
      ['🖼️','Images Are Re-encoded at High Quality','PDFTash re-encodes images at 85–90% quality — visually indistinguishable from the original but 40–60% smaller.'],
      ['📑','Fonts Are Subsetted','Only the font characters actually used in the document are kept, removing unused glyph data — invisible to readers.'],
      ['🗑️','Metadata Is Stripped','Hidden data like author history, comments, and XMP metadata add file size with zero visual value. PDFTash removes them.'],
      ['🔄','Duplicate Objects Removed','PDFs often contain duplicate embedded images and streams. Compression de-duplicates them automatically.'],
    ] as $i => $tip)
    <div style="display:flex;gap:16px;align-items:flex-start;background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:18px;">
      <div style="font-size:24px;flex-shrink:0;">{{ $tip[0] }}</div>
      <div><div style="font-weight:600;font-size:14px;color:#eeeef8;margin-bottom:4px;">{{ $tip[1] }}</div><div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $tip[2] }}</div></div>
    </div>
    @endforeach
  </div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">Related Compression Tools</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([['Compress PDF','/compress-pdf'],['To 200KB','/compress-pdf-to-200kb'],['To 1MB','/compress-pdf-to-1mb'],['For Email','/compress-pdf-for-email'],['For WhatsApp','/reduce-pdf-size-for-whatsapp'],['Compress Scanned PDF','/compress-scanned-pdf']] as $t)
    <a href="{{ $t[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item"><h3>How much smaller will my PDF be after compression?</h3><p>It depends on content. Image-heavy PDFs (presentations, scanned documents) typically shrink 60–80%. Text-only PDFs (CVs, reports) compress 20–40% since they're already small. Run a second pass to compress further.</p></div>
  <div class="faq-item"><h3>Will the compressed PDF look different?</h3><p>No. Text remains perfectly sharp (it's vector data). Images are re-encoded at high quality — the difference is imperceptible to the human eye at normal viewing sizes.</p></div>
  <div class="faq-item"><h3>Can I compress a PDF twice for more reduction?</h3><p>Yes. Download the compressed file and upload it again. Each pass removes additional redundancy. After 2–3 passes you typically reach the minimum achievable size.</p></div>
  <div class="faq-item"><h3>Is PDFTash compression better than Adobe Acrobat's?</h3><p>Comparable quality at zero cost. Adobe Acrobat Pro costs $30/month for the same compression result. PDFTash uses Ghostscript — the same engine that powers many professional compression tools.</p></div>
</div>

<script>
const CSRF=document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')||'';
const dropZone=document.getElementById('drop-zone');
dropZone.addEventListener('dragover',(e)=>{e.preventDefault();dropZone.style.borderColor='#5b5cff';});
dropZone.addEventListener('dragleave',()=>{dropZone.style.borderColor='rgba(255,255,255,.15)';});
dropZone.addEventListener('drop',(e)=>{e.preventDefault();const f=e.dataTransfer.files[0];if(f?.type==='application/pdf')processFile(f);});
function handleFile(input){if(input.files[0])processFile(input.files[0]);}
async function processFile(file){
    const result=document.getElementById('result');result.style.display='block';
    result.innerHTML='<div style="color:#8888a8;padding:20px">⏳ Compressing while preserving quality...</div>';
    const fd=new FormData();fd.append('file',file);fd.append('_token',CSRF);
    try{const resp=await fetch('/api/pdf/compress',{method:'POST',body:fd});
        if(resp.ok){const blob=await resp.blob();const url=URL.createObjectURL(blob);
            const saved=(((file.size-blob.size)/file.size)*100).toFixed(0);const sizeKB=(blob.size/1024).toFixed(0);
            result.innerHTML=`<div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;"><div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:8px">✅ Compressed — Quality Preserved!</div><div style="color:#8888a8;font-size:14px">${(file.size/1024).toFixed(0)}KB → <strong style="color:#eeeef8">${sizeKB}KB</strong> <span style="color:#00e5a0;font-weight:600">(${saved}% smaller)</span></div></div><a href="${url}" download="compressed-hq.pdf" style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">⬇ Download Compressed PDF</a><br><br><button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Compress Another</button>`;
        }else{const d=await resp.json().catch(()=>({}));result.innerHTML=`<div style="color:#ff6b6b">Error: ${d.error||'Something went wrong.'}</div>`;}
    }catch(e){result.innerHTML=`<div style="color:#ff6b6b">Connection error. Please try again.</div>`;}
}
</script>
@endsection
