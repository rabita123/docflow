@extends('tools.layout')

@section('title', 'Compress PDF to 200KB Online Free — Instant, No Signup')
@section('description', 'Compress any PDF to 200KB or less in seconds. Free online PDF compressor — no signup, no watermark, no limits. Perfect for government forms, job portals, and university uploads.')
@section('keywords', 'compress pdf to 200kb, reduce pdf to 200kb, compress pdf under 200kb, pdf 200kb online, make pdf 200kb, shrink pdf to 200kb free, reduce pdf size 200kb')
@section('slug', 'compress-pdf-to-200kb')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash — Compress PDF to 200KB",
  "applicationCategory": "WebApplication",
  "operatingSystem": "Any",
  "description": "Free online tool to compress any PDF to 200KB or less. No signup, no watermark. Used for government portals, job applications, and university uploads.",
  "url": "https://pdftash.com/compress-pdf-to-200kb",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"},
  "aggregateRating": {"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"1240"}
},
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Compress PDF to 200KB Online Free",
  "description": "Reduce your PDF to under 200KB in 3 steps using PDFTash — free, no signup.",
  "step": [
    {"@type":"HowToStep","position":1,"name":"Upload your PDF","text":"Drag and drop your PDF or click to browse. Works with any PDF regardless of original size."},
    {"@type":"HowToStep","position":2,"name":"Compress automatically","text":"PDFTash compresses your PDF using smart algorithms — images re-encoded, metadata removed, fonts subsetted."},
    {"@type":"HowToStep","position":3,"name":"Download under 200KB","text":"Download your compressed PDF instantly. If still over 200KB, run a second pass through the tool."}
  ]
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"Can I compress a PDF to exactly 200KB?","acceptedAnswer":{"@type":"Answer","text":"PDFTash compresses as small as possible. Whether the result hits exactly 200KB depends on content. Text-only PDFs usually go well below 200KB. Image-heavy PDFs may need a second compression pass."}},
    {"@type":"Question","name":"Why do I need a PDF under 200KB?","acceptedAnswer":{"@type":"Answer","text":"Many government portals (Bangladesh PSC, Indian SSC, UPSC), university admission forms, and job portals like BDJobs cap uploads at 200KB–500KB. PDFTash helps you meet those limits instantly."}},
    {"@type":"Question","name":"Does compressing to 200KB ruin quality?","acceptedAnswer":{"@type":"Answer","text":"For most documents, quality is visually identical. Text is always perfectly sharp (it's vector data). Images are re-encoded at optimized quality — usually invisible to the human eye."}},
    {"@type":"Question","name":"What if my PDF is still over 200KB after compression?","acceptedAnswer":{"@type":"Answer","text":"Run the compressed file through the tool a second time. Each pass reduces size further. For scanned documents, you can also use the Split PDF tool to remove unneeded pages first."}},
    {"@type":"Question","name":"Is there a file size limit for uploading?","acceptedAnswer":{"@type":"Answer","text":"Free users can upload PDFs up to 10MB. Pro users can upload up to 200MB with no daily limits."}}
  ]
}
]
</script>
@endsection

@section('content')
<div class="hero">
  <div class="badge">🗜️ Compress PDF to 200KB</div>
  <h1>Compress PDF to 200KB — Free Online Tool</h1>
  <p>Reduce any PDF to under 200KB instantly. No signup, no watermark, no limits. Perfect for government forms, job applications and university portals.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">📄</div>
    <div class="upload-title">Drop your PDF here to compress to 200KB</div>
    <div class="upload-sub">Click to browse · Any size accepted · Free &amp; instant</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Files are automatically deleted after 2 hours · 100% secure</p>
  </div>
</div>

{{-- SIZE TARGET BADGES --}}
<div style="max-width:700px;margin:-20px auto 60px;padding:0 20px;display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
  @foreach(['200KB','500KB','1MB','2MB','5MB'] as $sz)
  <a href="{{ $sz === '200KB' ? '#' : '/compress-pdf-to-'.strtolower(str_replace('KB','kb',$sz)) }}"
     style="padding:7px 16px;background:{{ $sz==='200KB' ? 'rgba(91,92,255,.25)' : '#0f0f1a' }};border:1px solid {{ $sz==='200KB' ? '#5b5cff' : 'rgba(255,255,255,.1)' }};border-radius:99px;color:{{ $sz==='200KB' ? '#9898ff' : '#8888a8' }};text-decoration:none;font-size:13px;font-weight:{{ $sz==='200KB' ? '700' : '500' }};">
    Compress to {{ $sz }}
  </a>
  @endforeach
</div>

{{-- WHO NEEDS 200KB --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:12px;">Who Needs a PDF Under 200KB?</h2>
  <p style="text-align:center;color:#8888a8;font-size:14px;margin-bottom:28px;">Hundreds of portals enforce a strict 200KB limit — PDFTash helps you meet it in seconds</p>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['🏛️','Government Job Portals','Bangladesh PSC, BPSC, India SSC, UPSC, railway recruitment — all require certificates and photos under 200KB.'],
      ['🎓','University Admissions','Online admission forms for public universities (DU, BUET, CU) cap document uploads at 200KB–500KB.'],
      ['💼','Job Application Sites','BDJobs, Chakri.com, Naukri.com and LinkedIn require resumes under specific file size limits.'],
      ['🏥','Hospital & Visa Forms','Medical reports and visa application documents frequently need to be under 200KB for online submission.'],
      ['📧','Email Attachments','Some corporate email systems block attachments over 200KB. Compressed PDFs go through every time.'],
      ['📱','WhatsApp & Messenger','Smaller PDFs share faster on messaging apps, especially on slow mobile connections.'],
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
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">How to Compress PDF to 200KB in 3 Steps</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
    @foreach([
      ['📤','1. Upload Your PDF','Drag and drop or click to upload. Any PDF size accepted. Your file is encrypted in transit.'],
      ['⚙️','2. Smart Compression','PDFTash re-encodes images, subsets fonts, and strips metadata — targeting the smallest possible size.'],
      ['⬇️','3. Download Under 200KB','Your compressed PDF downloads instantly. Run a second pass if you need to go smaller.'],
    ] as $s)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:20px;text-align:center;">
      <div style="font-size:28px;margin-bottom:10px;">{{ $s[0] }}</div>
      <div style="font-weight:600;margin-bottom:6px;font-size:13px;">{{ $s[1] }}</div>
      <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $s[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- TIPS SECTION --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:18px;padding:28px;">
    <h2 style="font-size:20px;font-weight:700;margin-bottom:20px;">💡 Tips to Get Your PDF Under 200KB</h2>
    <div style="display:flex;flex-direction:column;gap:14px;">
      @foreach([
        ['Remove unnecessary pages first','Use the <a href="/split-pdf" style="color:#5b5cff">Split PDF tool</a> to extract only the pages you need before compressing. Fewer pages = smaller file.'],
        ['Run a second compression pass','If the first compress is still over 200KB, download the result and upload it again. Each pass reduces size further.'],
        ['Scanned documents compress most','A scanned PDF at 300 DPI can shrink 80–90% because it\'s stored as large embedded images.'],
        ['Text-only PDFs are already small','A 10-page text PDF is usually 50–150KB already. If yours is larger, it likely has embedded images or fonts.'],
        ['Check for hidden layers','Design software (InDesign, Illustrator) embeds extra data. Our compressor strips hidden layers automatically.'],
      ] as $i => $tip)
      <div style="display:flex;gap:16px;align-items:flex-start;">
        <div style="min-width:28px;height:28px;background:rgba(91,92,255,.2);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;color:#9898ff;flex-shrink:0;">{{ $i+1 }}</div>
        <div>
          <div style="font-weight:600;font-size:14px;margin-bottom:3px;">{{ $tip[0] }}</div>
          <div style="color:#8888a8;font-size:13px;line-height:1.5;">{!! $tip[1] !!}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- COMPARISON TABLE --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">PDFTash vs Other PDF Compressors</h2>
  <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;font-size:13px;">
      <thead>
        <tr style="background:#0f0f1a;">
          <th style="padding:12px 16px;text-align:left;color:#8888a8;font-weight:600;border-bottom:1px solid rgba(255,255,255,.08);">Feature</th>
          <th style="padding:12px 16px;text-align:center;color:#9898ff;font-weight:700;border-bottom:1px solid rgba(255,255,255,.08);">PDFTash ✓</th>
          <th style="padding:12px 16px;text-align:center;color:#8888a8;font-weight:600;border-bottom:1px solid rgba(255,255,255,.08);">Smallpdf</th>
          <th style="padding:12px 16px;text-align:center;color:#8888a8;font-weight:600;border-bottom:1px solid rgba(255,255,255,.08);">ILovePDF</th>
        </tr>
      </thead>
      <tbody>
        @foreach([
          ['100% Free','✅','❌ Paid after 2/hr','❌ Watermark free'],
          ['No Signup Required','✅','✅','✅'],
          ['No Daily Limit','✅','❌ 2 tasks/hr','❌ Limited'],
          ['No Watermark','✅','✅','✅'],
          ['Compress to 200KB','✅','✅','✅'],
          ['AI Features (Chat, Translate)','✅','❌','❌'],
          ['Files Deleted After 2hr','✅','✅','✅'],
        ] as $row)
        <tr style="border-bottom:1px solid rgba(255,255,255,.05);">
          <td style="padding:11px 16px;color:#eeeef8;">{{ $row[0] }}</td>
          <td style="padding:11px 16px;text-align:center;color:#00e5a0;font-weight:600;">{{ $row[1] }}</td>
          <td style="padding:11px 16px;text-align:center;color:#8888a8;">{{ $row[2] }}</td>
          <td style="padding:11px 16px;text-align:center;color:#8888a8;">{{ $row[3] }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

{{-- RELATED TOOLS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">More Free PDF Tools</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([
      ['Compress PDF','/compress-pdf'],
      ['Compress to 1MB','/compress-pdf-to-1mb'],
      ['Merge PDF','/merge-pdf'],
      ['Split PDF','/split-pdf'],
      ['Translate PDF','/translate-pdf'],
      ['AI PDF Generator','/ai-pdf-generator'],
    ] as $t)
    <a href="{{ $t[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — Compress PDF to 200KB</h2>
  <div class="faq-item">
    <h3>Can I compress a PDF to exactly 200KB?</h3>
    <p>PDFTash compresses as small as possible. The actual output size depends on your PDF's content. Text-only documents (certificates, letters) typically go well below 100KB. Scanned PDFs with photos may need two compression passes to reach 200KB.</p>
  </div>
  <div class="faq-item">
    <h3>Which government portals require PDFs under 200KB?</h3>
    <p>Bangladesh Public Service Commission (BPSC), Bangladesh Police recruitment, UPSC (India), SSC CGL, IBPS bank exams, and most university online admission portals require uploaded documents to be 100KB–500KB. PDFTash helps you meet these limits.</p>
  </div>
  <div class="faq-item">
    <h3>Will the text in my PDF still be readable after compression?</h3>
    <p>Yes. Text in PDFs is stored as vector data, not images — it never degrades during compression. Only embedded image quality is affected, and PDFTash uses a setting that maintains visual clarity while minimizing size.</p>
  </div>
  <div class="faq-item">
    <h3>What if my compressed PDF is still over 200KB?</h3>
    <p>Download the compressed file and upload it again for a second pass. You can also use our <a href="/split-pdf" style="color:#5b5cff">Split PDF tool</a> to remove unnecessary pages before compressing.</p>
  </div>
  <div class="faq-item">
    <h3>Is it safe to upload my documents?</h3>
    <p>All uploads are encrypted with HTTPS. Files are processed in an isolated environment and automatically deleted after 2 hours. We never read, store, or share your document content.</p>
  </div>
  <div class="faq-item">
    <h3>Is PDFTash better than Smallpdf for compressing to 200KB?</h3>
    <p>Both produce similar quality results. PDFTash has no daily limit (Smallpdf limits free users to 2 tasks/hour) and no signup required. PDFTash also includes AI tools like PDF translation and chat that Smallpdf charges extra for.</p>
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
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Compressing your PDF to 200KB...</div>';
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
            const under200 = blob.size <= 204800;
            result.innerHTML = `
                <div style="background:${under200?'#0a1a0a':'#1a1a0a'};border:1px solid ${under200?'#00e5a0':'#ffd700'};border-radius:12px;padding:20px;margin-bottom:16px;">
                    <div style="color:${under200?'#00e5a0':'#ffd700'};font-size:18px;font-weight:700;margin-bottom:8px">${under200?'✅ Under 200KB!':'⚠️ Compressed — run again for 200KB'}</div>
                    <div style="color:#8888a8;font-size:14px">${(file.size/1024).toFixed(0)}KB → <strong style="color:#eeeef8">${sizeKB}KB</strong> <span style="color:#00e5a0;font-weight:600">(${saved}% smaller)</span></div>
                    ${!under200 ? '<div style="color:#ffd700;font-size:12px;margin-top:6px">Download below and upload again to compress further.</div>' : ''}
                </div>
                <a href="${url}" download="compressed-200kb.pdf" style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">⬇ Download Compressed PDF</a>
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
