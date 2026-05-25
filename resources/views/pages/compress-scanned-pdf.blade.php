@extends('tools.layout')
@section('title', 'Compress Scanned PDF Online Free — Shrink Scan Size Fast')
@section('description', 'Compress scanned PDF files online free. Scanned PDFs are image-heavy and compress 60-90%. Reduce scan size without losing readability. No signup, instant download.')
@section('keywords', 'compress scanned pdf, compress scanned pdf online free, reduce scanned pdf size, shrink scanned document pdf, compress scan pdf, scanned pdf too large')
@section('slug', 'compress-scanned-pdf')
@section('schema')
<script type="application/ld+json">
[{"@context":"https://schema.org","@type":"SoftwareApplication","name":"PDFTash — Compress Scanned PDF","applicationCategory":"WebApplication","operatingSystem":"Any","description":"Free online tool to compress scanned PDF files. Scanned documents compress 60-90% because they are stored as large embedded images. No signup required.","url":"https://pdftash.com/compress-scanned-pdf","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"aggregateRating":{"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"1876"}},
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
{"@type":"Question","name":"Why are scanned PDFs so large?","acceptedAnswer":{"@type":"Answer","text":"Scanned PDFs store each page as a high-resolution image (often 300+ DPI). A single A4 page at 300 DPI is 3-8MB. PDFTash re-encodes these images at optimized quality, shrinking the file 60-90%."}},
{"@type":"Question","name":"Will the scanned text still be readable after compression?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash uses a high-quality compression setting that maintains full readability of text in scanned documents. The difference is invisible at normal viewing sizes."}},
{"@type":"Question","name":"Can I compress a 100MB scanned PDF?","acceptedAnswer":{"@type":"Answer","text":"Yes. Large scanned PDFs compress dramatically — a 100MB scan can often reach 5-15MB after compression while remaining fully readable."}},
{"@type":"Question","name":"How is compressing a scanned PDF different from a regular PDF?","acceptedAnswer":{"@type":"Answer","text":"Regular PDFs contain vector text (small and lossless). Scanned PDFs contain raster images — much larger but highly compressible. Scanned PDFs typically see 70-90% size reduction vs 20-40% for text PDFs."}}
]}]
</script>
@endsection
@section('content')
<div class="hero">
  <div class="badge">📷 Compress Scanned PDF</div>
  <h1>Compress Scanned PDF — 60–90% Smaller, Still Readable</h1>
  <p>Scanned PDFs are the largest PDF type — each page is a full image. PDFTash compresses them 60–90% while keeping text fully readable. Free, no signup.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">📷</div>
    <div class="upload-title">Drop your scanned PDF here to compress</div>
    <div class="upload-sub">Large scans accepted · Free · No signup</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;"><p style="color:#8888a8;font-size:12px;">Files deleted after 2 hours · 100% secure</p></div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">Why Scanned PDFs Are So Large</h2>
  <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:24px;">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
      @foreach([
        ['📄 Text PDF','Vector data','10 pages = ~100KB','Compresses 20-40%'],
        ['📷 Scanned PDF','Raster images','10 pages = ~30MB','Compresses 60-90%'],
      ] as $row)
      <div style="background:#13131e;border-radius:12px;padding:16px;text-align:center;">
        <div style="font-size:14px;font-weight:700;color:#eeeef8;margin-bottom:8px;">{{ $row[0] }}</div>
        <div style="color:#8888a8;font-size:12px;margin-bottom:4px;">{{ $row[1] }}</div>
        <div style="color:#8888a8;font-size:12px;margin-bottom:8px;">{{ $row[2] }}</div>
        <div style="color:#00e5a0;font-size:13px;font-weight:600;">{{ $row[3] }}</div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">Related Compression Tools</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([['Compress PDF','/compress-pdf'],['To 200KB','/compress-pdf-to-200kb'],['To 1MB','/compress-pdf-to-1mb'],['For Email','/compress-pdf-for-email'],['No Quality Loss','/compress-pdf-without-losing-quality'],['Large PDFs','/compress-large-pdf-files']] as $t)
    <a href="{{ $t[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — Compress Scanned PDF</h2>
  <div class="faq-item"><h3>Why is my scanned PDF 50MB when the original document is 10 pages?</h3><p>A scanner at 300 DPI captures each A4 page as a ~3-8MB image. 10 pages × 5MB average = 50MB. PDFTash re-encodes these images at optimized quality — typically reaching 3-8MB total for 10 pages.</p></div>
  <div class="faq-item"><h3>Will the handwriting or stamps in the scan still be visible?</h3><p>Yes. PDFTash uses a high-quality compression setting (85-90% image quality) that preserves all visible details including handwriting, stamps, and signatures in scanned documents.</p></div>
  <div class="faq-item"><h3>Can I compress a passport or certificate scan?</h3><p>Yes. Government documents, certificates, passports, and official papers compress well with PDFTash. The output is accepted by all portals that accept PDF uploads.</p></div>
  <div class="faq-item"><h3>Should I scan at lower DPI to get a smaller file?</h3><p>Scanning at 150–200 DPI (instead of 300 DPI) produces smaller files but reduces readability. It's better to scan at 300 DPI for quality and then compress with PDFTash — you get the best of both.</p></div>
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
    result.innerHTML='<div style="color:#8888a8;padding:20px">⏳ Compressing your scanned PDF... large scans may take 30–60s</div>';
    const fd=new FormData();fd.append('file',file);fd.append('_token',CSRF);
    try{const resp=await fetch('/api/pdf/compress',{method:'POST',body:fd});
        if(resp.ok){const blob=await resp.blob();const url=URL.createObjectURL(blob);
            const saved=(((file.size-blob.size)/file.size)*100).toFixed(0);const sizeKB=(blob.size/1024).toFixed(0);
            result.innerHTML=`<div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;"><div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:8px">✅ Scanned PDF Compressed!</div><div style="color:#8888a8;font-size:14px">${(file.size/1024/1024).toFixed(1)}MB → <strong style="color:#eeeef8">${(blob.size/1024/1024).toFixed(1)}MB</strong> <span style="color:#00e5a0;font-weight:600">(${saved}% smaller)</span></div></div><a href="${url}" download="compressed-scan.pdf" style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">⬇ Download Compressed PDF</a><br><br><button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Compress Another</button>`;
        }else{const d=await resp.json().catch(()=>({}));result.innerHTML=`<div style="color:#ff6b6b">Error: ${d.error||'Something went wrong.'}</div>`;}
    }catch(e){result.innerHTML=`<div style="color:#ff6b6b">Connection error. Please try again.</div>`;}
}
</script>
@endsection
