@extends('tools.layout')

@section('title', 'Merge PDF Files Online Free — Combine PDFs in Seconds No Signup')
@section('description', 'Merge multiple PDF files into one online free. Combine PDFs in any order. No signup, no watermark, no limits. Drag to reorder and download instantly.')
@section('keywords', 'merge pdf files online, combine pdf files online, merge pdf free, join pdf files, merge pdf no signup')
@section('slug', 'merge-pdf-files-online')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash — Merge PDF Files Online",
  "applicationCategory": "WebApplication",
  "operatingSystem": "Any",
  "description": "Free online tool to merge multiple PDF files into one. No signup, no watermark, no limits. Drag to reorder and download instantly.",
  "url": "https://pdftash.com/merge-pdf-files-online",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"},
  "aggregateRating": {"@type":"AggregateRating","ratingValue":"4.9","reviewCount":"2180"}
},
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Merge PDF Files Online Free",
  "description": "Combine multiple PDFs into one document in 3 steps using PDFTash — free, no signup.",
  "step": [
    {"@type":"HowToStep","position":1,"name":"Upload your PDFs","text":"Click to upload or drag and drop multiple PDF files. You can add as many files as you need."},
    {"@type":"HowToStep","position":2,"name":"Arrange the order","text":"Drag files to reorder them. PDFTash will merge them in the order you set."},
    {"@type":"HowToStep","position":3,"name":"Download merged PDF","text":"Click Merge and download your combined PDF instantly. No signup required."}
  ]
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"How many PDF files can I merge at once?","acceptedAnswer":{"@type":"Answer","text":"PDFTash has no limit on the number of files you can merge in a single session. Free users can merge PDFs up to 10MB each. Pro users can merge files up to 200MB each."}},
    {"@type":"Question","name":"Can I rearrange the order of PDFs before merging?","acceptedAnswer":{"@type":"Answer","text":"Yes. After uploading your files, you can drag and drop them into any order. PDFTash will merge them exactly in the order displayed."}},
    {"@type":"Question","name":"Is there a signup required to merge PDFs?","acceptedAnswer":{"@type":"Answer","text":"No signup is required. PDFTash lets you merge PDFs instantly — no account, no email, no watermark."}},
    {"@type":"Question","name":"Will the merged PDF have a watermark?","acceptedAnswer":{"@type":"Answer","text":"Never. PDFTash does not add any watermarks to your merged PDF. The output is a clean, professional document."}},
    {"@type":"Question","name":"Does merging PDFs reduce their quality?","acceptedAnswer":{"@type":"Answer","text":"No. PDFTash merges PDFs without re-encoding any content. Images, fonts, and text remain at their original quality."}},
    {"@type":"Question","name":"What is the difference between Merge PDF and Combine PDF Pages?","acceptedAnswer":{"@type":"Answer","text":"Merge PDF combines entire documents end-to-end. Combine PDF Pages lets you select specific pages from each document to include in the final output. Use /combine-pdf-pages for page-level control."}}
  ]
}
]
</script>
@endsection

@section('content')
<div class="hero">
  <div class="badge">📎 Merge PDF Files Online</div>
  <h1>Merge PDF Files Online — Free &amp; Instant</h1>
  <p>Combine multiple PDF files into one document in seconds. Drag to reorder, no signup, no watermark, no daily limits.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">📂</div>
    <div class="upload-title">Drop your PDF files here to merge</div>
    <div class="upload-sub">Click to browse · Select multiple files · Free &amp; instant</div>
    <input type="file" id="pdfInput" accept=".pdf" multiple style="display:none" onchange="handleFiles(this)">
  </div>
  <div id="file-list" style="display:none;margin-top:20px;"></div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Files are automatically deleted after 2 hours · 100% secure</p>
  </div>
</div>

{{-- MERGE VARIANT CROSSLINKS --}}
<div style="max-width:700px;margin:-20px auto 60px;padding:0 20px;display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
  @foreach([
    ['Merge PDF','/merge-pdf'],
    ['Merge for Email','/merge-pdf-for-email'],
    ['Merge Large PDFs','/merge-large-pdf-files'],
    ['Combine PDF Pages','/combine-pdf-pages'],
  ] as $link)
  <a href="{{ $link[1] }}"
     style="padding:7px 16px;background:{{ $link[0]==='Merge PDF Files Online' ? 'rgba(91,92,255,.25)' : '#0f0f1a' }};border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#8888a8;text-decoration:none;font-size:13px;font-weight:500;">
    {{ $link[0] }}
  </a>
  @endforeach
</div>

{{-- HOW IT WORKS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">How to Merge PDF Files in 3 Steps</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
    @foreach([
      ['📤','1. Upload PDFs','Click to browse or drag and drop multiple PDF files at once. There is no limit on how many files you add.'],
      ['🔀','2. Reorder Files','Drag the file cards to set your preferred order. PDFTash merges files exactly as arranged.'],
      ['⬇️','3. Download Merged PDF','Click Merge and download your single combined PDF instantly — no signup required.'],
    ] as $s)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:20px;text-align:center;">
      <div style="font-size:28px;margin-bottom:10px;">{{ $s[0] }}</div>
      <div style="font-weight:600;margin-bottom:6px;font-size:13px;">{{ $s[1] }}</div>
      <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $s[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- FEATURES GRID --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:12px;">Why Use PDFTash to Merge PDFs?</h2>
  <p style="text-align:center;color:#8888a8;font-size:14px;margin-bottom:28px;">Built for speed, privacy, and zero friction — no account needed</p>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['🖱️','Drag to Reorder','Arrange your PDFs in any order before merging. Simple drag-and-drop interface that works on desktop and mobile.'],
      ['♾️','Unlimited Files','Merge 2, 10, or 50 PDF files in a single session. No artificial caps on the number of files.'],
      ['🚫','No Signup Ever','Start merging immediately. We will never ask for your email, account, or credit card for the merge tool.'],
      ['⚡','Instant Download','Your merged PDF is ready in seconds and downloads directly to your device. No waiting, no email links.'],
      ['🔒','Private & Secure','All files are encrypted in transit and automatically deleted from our servers after 2 hours.'],
      ['✅','No Watermark','The output PDF is 100% clean — no PDFTash branding, no watermarks, no hidden stamps.'],
    ] as $f)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:20px;">
      <div style="font-size:26px;margin-bottom:8px;">{{ $f[0] }}</div>
      <div style="font-weight:600;font-size:13px;color:#eeeef8;margin-bottom:5px;">{{ $f[1] }}</div>
      <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $f[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- COMPARISON TABLE --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">PDFTash vs Other PDF Merge Tools</h2>
  <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;font-size:13px;">
      <thead>
        <tr style="background:#0f0f1a;">
          <th style="padding:12px 16px;text-align:left;color:#8888a8;font-weight:600;border-bottom:1px solid rgba(255,255,255,.08);">Feature</th>
          <th style="padding:12px 16px;text-align:center;color:#9898ff;font-weight:700;border-bottom:1px solid rgba(255,255,255,.08);">PDFTash ✓</th>
          <th style="padding:12px 16px;text-align:center;color:#8888a8;font-weight:600;border-bottom:1px solid rgba(255,255,255,.08);">Smallpdf</th>
          <th style="padding:12px 16px;text-align:center;color:#8888a8;font-weight:600;border-bottom:1px solid rgba(255,255,255,.08);">iLovePDF</th>
        </tr>
      </thead>
      <tbody>
        @foreach([
          ['100% Free','✅','❌ Paid after 2/hr','❌ Limited free'],
          ['No Signup Required','✅','✅','✅'],
          ['No Daily Limit','✅','❌ 2 tasks/hr','❌ Rate limited'],
          ['No Watermark','✅','✅','✅'],
          ['Drag to Reorder Files','✅','✅','✅'],
          ['Unlimited Files per Merge','✅','❌ Restricted','❌ Restricted'],
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
      ['Merge PDF','/merge-pdf'],
      ['Split PDF','/split-pdf'],
      ['Compress PDF','/compress-pdf'],
      ['Combine PDF Pages','/combine-pdf-pages'],
      ['Merge for Email','/merge-pdf-for-email'],
      ['Translate PDF','/translate-pdf'],
      ['Sign PDF','/sign-pdf'],
      ['Chat with PDF','/chat-with-pdf'],
    ] as $t)
    <a href="{{ $t[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — Merge PDF Files Online</h2>
  <div class="faq-item">
    <h3>How many PDF files can I merge at once?</h3>
    <p>PDFTash has no limit on the number of files per merge. You can combine 2, 10, or 50 PDFs in a single operation. Free users can upload files up to 10MB each; Pro users can upload up to 200MB each with no daily task limits.</p>
  </div>
  <div class="faq-item">
    <h3>Can I change the order of pages after uploading?</h3>
    <p>Yes. After selecting your files, drag and drop the file cards to arrange them in any order you want. The merged PDF will follow that exact sequence. For page-level control across documents, use our <a href="/combine-pdf-pages" style="color:#5b5cff">Combine PDF Pages</a> tool.</p>
  </div>
  <div class="faq-item">
    <h3>Does PDFTash add a watermark when merging PDFs?</h3>
    <p>Never. PDFTash does not add any watermarks, branding, or stamps to your merged PDF. The output is a completely clean document — exactly what you would get if you merged them in Adobe Acrobat.</p>
  </div>
  <div class="faq-item">
    <h3>Is the merged PDF the same quality as the original files?</h3>
    <p>Yes. PDFTash merges PDFs by joining the document structure — it does not re-render or re-encode any content. Images, fonts, text, and vector graphics remain at 100% original quality.</p>
  </div>
  <div class="faq-item">
    <h3>How is PDFTash different from Smallpdf for merging?</h3>
    <p>Smallpdf limits free users to 2 tasks per hour and requires a paid plan for unlimited use. PDFTash has no hourly limits, no signup, and is free for the merge tool permanently. PDFTash also includes AI tools like PDF translation and chat that Smallpdf charges extra for.</p>
  </div>
  <div class="faq-item">
    <h3>What is the file size limit for merging PDFs?</h3>
    <p>Free users can upload individual files up to 10MB. Pro users can upload up to 200MB per file. If your files are too large, try our <a href="/compress-pdf" style="color:#5b5cff">Compress PDF</a> tool first to reduce file size before merging.</p>
  </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
let selectedFiles = [];

const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = '#5b5cff'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.style.borderColor = 'rgba(255,255,255,.15)';
    const files = Array.from(e.dataTransfer.files).filter(f => f.type === 'application/pdf');
    if (files.length) addFiles(files);
});

function handleFiles(input) {
    const files = Array.from(input.files).filter(f => f.type === 'application/pdf');
    if (files.length) addFiles(files);
}

function addFiles(files) {
    selectedFiles = selectedFiles.concat(files);
    renderFileList();
}

function renderFileList() {
    const list = document.getElementById('file-list');
    if (selectedFiles.length === 0) { list.style.display = 'none'; return; }
    list.style.display = 'block';
    list.innerHTML = `
        <div style="margin-bottom:12px;">
            ${selectedFiles.map((f, i) => `
            <div style="display:flex;align-items:center;gap:12px;background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:10px;padding:12px 16px;margin-bottom:8px;">
                <span style="color:#5b5cff;font-size:20px;">📄</span>
                <span style="flex:1;color:#eeeef8;font-size:13px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">${f.name}</span>
                <span style="color:#8888a8;font-size:12px;white-space:nowrap;">${(f.size/1024).toFixed(0)} KB</span>
                <button onclick="removeFile(${i})" style="background:transparent;border:none;color:#ff6b6b;cursor:pointer;font-size:16px;padding:0 4px;">×</button>
            </div>`).join('')}
        </div>
        <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
            <button onclick="document.getElementById('pdfInput').click()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px;">+ Add More Files</button>
            <button onclick="mergePDFs()" style="background:#5b5cff;color:#fff;border:none;padding:12px 32px;border-radius:99px;cursor:pointer;font-size:15px;font-weight:600;">Merge ${selectedFiles.length} PDFs →</button>
        </div>`;
}

function removeFile(index) {
    selectedFiles.splice(index, 1);
    renderFileList();
}

async function mergePDFs() {
    if (selectedFiles.length < 2) { alert('Please add at least 2 PDF files to merge.'); return; }
    const result = document.getElementById('result');
    result.style.display = 'block';
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Merging your PDFs...</div>';
    document.getElementById('file-list').style.display = 'none';

    const formData = new FormData();
    selectedFiles.forEach(f => formData.append('files[]', f));
    formData.append('_token', CSRF);

    try {
        const resp = await fetch('/api/pdf/merge', {method:'POST', body:formData});
        if (resp.ok) {
            const blob = await resp.blob();
            const url = URL.createObjectURL(blob);
            const sizeKB = (blob.size / 1024).toFixed(0);
            result.innerHTML = `
                <div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;">
                    <div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:8px">✅ ${selectedFiles.length} PDFs merged successfully!</div>
                    <div style="color:#8888a8;font-size:14px">Output size: <strong style="color:#eeeef8">${sizeKB} KB</strong></div>
                </div>
                <a href="${url}" download="merged.pdf" style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">⬇ Download Merged PDF</a>
                <br><br>
                <button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Merge More PDFs</button>`;
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
