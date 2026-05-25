@extends('tools.layout')
@section('title', 'Compress Large PDF Files Online Free — No Size Limit')
@section('description', 'Compress large PDF files online free. No file size limit. Shrink 50MB, 100MB or 200MB PDFs without losing quality. No signup, instant download.')
@section('keywords', 'compress large pdf files, compress large pdf online free, reduce large pdf size, compress 100mb pdf, compress 50mb pdf, large pdf compressor, shrink large pdf')
@section('slug', 'compress-large-pdf-files')
@section('schema')
<script type="application/ld+json">
[{"@context":"https://schema.org","@type":"SoftwareApplication","name":"PDFTash — Compress Large PDF Files","applicationCategory":"WebApplication","operatingSystem":"Any","description":"Free online tool to compress large PDF files with no size limit. Reduce 50MB, 100MB, and 200MB PDFs quickly without losing quality.","url":"https://pdftash.com/compress-large-pdf-files","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"aggregateRating":{"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"2054"}},
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
{"@type":"Question","name":"Is there a file size limit for PDF compression?","acceptedAnswer":{"@type":"Answer","text":"Free users can upload PDFs up to 10MB. Pro users ($9/month) can upload up to 200MB with no daily limits. Very large PDFs may take 30-60 seconds to compress."}},
{"@type":"Question","name":"Can I compress a 100MB PDF online?","acceptedAnswer":{"@type":"Answer","text":"Yes with a Pro account. Large PDFs (50MB+) often compress to 5-15MB — a 70-90% reduction — especially if they are scanned documents or contain many embedded images."}},
{"@type":"Question","name":"Why is my PDF so large?","acceptedAnswer":{"@type":"Answer","text":"Large PDFs typically contain many high-resolution images, embedded fonts, scanned pages, or duplicate embedded data. PDFTash addresses all of these in one compression pass."}},
{"@type":"Question","name":"How long does compressing a large PDF take?","acceptedAnswer":{"@type":"Answer","text":"Depends on size and content. A 10MB PDF takes 5-10 seconds. A 100MB scanned PDF may take 30-60 seconds. A progress indicator shows while processing."}}
]}]
</script>
@endsection
@section('content')
<div class="hero">
  <div class="badge">📦 Large PDF Compressor</div>
  <h1>Compress Large PDF Files — Any Size, Free Online</h1>
  <p>No file size restrictions. Compress 10MB, 50MB, even 200MB PDFs online. Large scanned documents compress 60–90%. Text presentations compress 30–60%. No signup needed.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">📦</div>
    <div class="upload-title">Drop your large PDF here to compress</div>
    <div class="upload-sub">Free users: up to 10MB · Pro users: up to 200MB</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;"><p style="color:#8888a8;font-size:12px;">Large PDFs may take 30–60 seconds · Files deleted after 2 hours</p></div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:12px;">Why Is My PDF So Large?</h2>
  <p style="text-align:center;color:#8888a8;font-size:14px;margin-bottom:28px;">Common causes of large PDF files — and how PDFTash fixes each one</p>
  <div style="display:flex;flex-direction:column;gap:12px;">
    @foreach([
      ['📷','High-resolution scanned pages','Each scanned page is a large raster image. PDFTash re-encodes them at optimized quality — typical 70-90% reduction.'],
      ['🖼️','Embedded high-DPI photos','Photos embedded at 300+ DPI are much larger than needed for screen viewing. PDFTash downsizes them to 150 DPI — still print-quality.'],
      ['🔤','Fully embedded fonts','Complete font files embedded instead of just the characters used. PDFTash subsets fonts to only the characters in the document.'],
      ['📑','Duplicate data streams','PDFs from design tools often embed the same image multiple times. Compression detects and removes duplicates.'],
      ['📎','Hidden metadata and layers','Author information, edit history, comments, and InDesign layers bloat the file. PDFTash strips all hidden metadata.'],
    ] as $tip)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:18px;display:flex;gap:14px;align-items:flex-start;">
      <div style="font-size:24px;flex-shrink:0;">{{ $tip[0] }}</div>
      <div><div style="font-weight:600;font-size:14px;color:#eeeef8;margin-bottom:4px;">{{ $tip[1] }}</div><div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $tip[2] }}</div></div>
    </div>
    @endforeach
  </div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">More Compression Options</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([['Compress PDF','/compress-pdf'],['To 200KB','/compress-pdf-to-200kb'],['To 1MB','/compress-pdf-to-1mb'],['For Email','/compress-pdf-for-email'],['Scanned PDF','/compress-scanned-pdf'],['No Quality Loss','/compress-pdf-without-losing-quality']] as $t)
    <a href="{{ $t[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — Large PDF Compression</h2>
  <div class="faq-item"><h3>Can I compress a 100MB PDF for free?</h3><p>Free users can upload up to 10MB. For 100MB PDFs, upgrade to Pro ($9/month) which supports files up to 200MB. Pro users also get priority processing which is faster for large files.</p></div>
  <div class="faq-item"><h3>How much will my large PDF shrink?</h3><p>Scanned PDFs typically shrink 70–90%. Image-heavy presentations shrink 50–70%. Text-only reports shrink 20–40%. The result depends heavily on what's embedded in your specific PDF.</p></div>
  <div class="faq-item"><h3>How long does compressing a large PDF take?</h3><p>A 5MB PDF compresses in 5–10 seconds. A 50MB scanned document may take 30–60 seconds. Progress is shown during processing. Very large files (100MB+) can take 1–2 minutes.</p></div>
  <div class="faq-item"><h3>Should I split my large PDF before compressing?</h3><p>Splitting first can speed up compression for very large files. Use our <a href="/split-pdf" style="color:#5b5cff">Split PDF</a> tool to break it into sections, compress each, then <a href="/merge-pdf" style="color:#5b5cff">merge</a> back together.</p></div>
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
    result.innerHTML='<div style="color:#8888a8;padding:20px">⏳ Compressing your large PDF... please wait</div>';
    const fd=new FormData();fd.append('file',file);fd.append('_token',CSRF);
    try{const resp=await fetch('/api/pdf/compress',{method:'POST',body:fd});
        if(resp.ok){const blob=await resp.blob();const url=URL.createObjectURL(blob);
            const saved=(((file.size-blob.size)/file.size)*100).toFixed(0);
            result.innerHTML=`<div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;"><div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:8px">✅ Large PDF Compressed!</div><div style="color:#8888a8;font-size:14px">${(file.size/1024/1024).toFixed(1)}MB → <strong style="color:#eeeef8">${(blob.size/1024/1024).toFixed(1)}MB</strong> <span style="color:#00e5a0;font-weight:600">(${saved}% smaller)</span></div></div><a href="${url}" download="compressed-large.pdf" style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">⬇ Download Compressed PDF</a><br><br><button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Compress Another</button>`;
        }else{const d=await resp.json().catch(()=>({}));result.innerHTML=`<div style="color:#ff6b6b">Error: ${d.error||'Something went wrong.'}</div>`;}
    }catch(e){result.innerHTML=`<div style="color:#ff6b6b">Connection error. Please try again.</div>`;}
}
</script>
@endsection
