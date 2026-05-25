@extends('tools.layout')

@section('title', 'Remove Pages from PDF Online Free — Delete PDF Pages')
@section('description', 'Remove or delete specific pages from any PDF online free. Enter page numbers to delete, download the cleaned PDF instantly. No signup, no watermark.')
@section('keywords', 'remove pages from pdf, delete pages from pdf, remove pdf pages online free, delete specific pages pdf, pdf page remover')
@section('slug', 'remove-pages-from-pdf')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash — Remove Pages from PDF",
  "applicationCategory": "WebApplication",
  "operatingSystem": "Any",
  "description": "Free online tool to remove or delete specific pages from any PDF. Enter page numbers to delete, download the cleaned PDF instantly. No signup or watermark.",
  "url": "https://pdftash.com/remove-pages-from-pdf",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"},
  "aggregateRating": {"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"1120"}
},
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Remove Pages from a PDF Online Free",
  "description": "Delete specific pages from any PDF in 3 steps using PDFTash — free, no signup.",
  "step": [
    {"@type":"HowToStep","position":1,"name":"Upload your PDF","text":"Drag and drop your PDF or click to browse. Up to 10MB free."},
    {"@type":"HowToStep","position":2,"name":"Enter pages to KEEP","text":"Enter the pages you want to KEEP in the output (the inverse of what you want to delete). For example, if you have a 10-page PDF and want to delete page 3, enter 1-2, 4-10."},
    {"@type":"HowToStep","position":3,"name":"Download cleaned PDF","text":"Click Extract and download your PDF with the unwanted pages removed."}
  ]
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"How do I remove a specific page from a PDF?","acceptedAnswer":{"@type":"Answer","text":"Upload your PDF, then enter the pages you want to KEEP (not delete). For example, to remove page 3 from a 10-page PDF, enter 1-2, 4-10. Download the result — page 3 will be gone."}},
    {"@type":"Question","name":"Can I delete multiple pages from a PDF at once?","acceptedAnswer":{"@type":"Answer","text":"Yes. Enter the pages you want to KEEP using ranges. If you want to delete pages 3, 7, and 10-12 from a 15-page PDF, enter 1-2, 4-6, 8-9, 13-15."}},
    {"@type":"Question","name":"Will removing pages affect the quality of the remaining pages?","acceptedAnswer":{"@type":"Answer","text":"No. The remaining pages are not re-encoded or re-rendered. Images, text, fonts, and vector graphics stay at 100% original quality."}},
    {"@type":"Question","name":"What happens to the original PDF after I remove pages?","acceptedAnswer":{"@type":"Answer","text":"The original is never modified. PDFTash creates a new PDF with only the pages you specified. Both files are deleted from our servers after 2 hours."}},
    {"@type":"Question","name":"Is there a limit on how many pages I can remove?","acceptedAnswer":{"@type":"Answer","text":"No page count limit. You can remove one page or dozens. The only restriction is the upload file size: 10MB free, 200MB for Pro users."}},
    {"@type":"Question","name":"Can I remove pages from a scanned PDF?","acceptedAnswer":{"@type":"Answer","text":"Yes. Scanned PDFs remove pages exactly like any other PDF. The tool works on any PDF regardless of how it was created."}}
  ]
}
]
</script>
@endsection

@section('content')
<div class="hero">
  <div class="badge">🗑️ Remove Pages from PDF</div>
  <h1>Remove Pages from PDF — Free Online Tool</h1>
  <p>Delete specific pages from any PDF instantly. Enter the pages you want to keep, download the cleaned PDF. No signup, no watermark, no quality loss.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">📄</div>
    <div class="upload-title">Drop your PDF here to remove pages</div>
    <div class="upload-sub">Click to browse · Up to 10MB free · Instant download</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="page-input-section" style="display:none;margin-top:24px;">
    <div style="background:rgba(255,107,107,.08);border:1px solid rgba(255,107,107,.25);border-radius:10px;padding:14px 18px;margin-bottom:18px;">
      <div style="color:#ff6b6b;font-weight:600;font-size:13px;margin-bottom:4px;">⚠️ Important: Enter pages to KEEP, not pages to delete</div>
      <div style="color:#8888a8;font-size:12px;line-height:1.5;">This tool works by extracting the pages you want to keep. Enter the page numbers you want in the final document, and the pages you leave out will be removed.</div>
    </div>
    <div style="margin-bottom:16px;">
      <label style="display:block;font-size:13px;color:#8888a8;margin-bottom:8px;font-weight:500;">Pages to KEEP (everything else is removed):</label>
      <input type="text" id="pages-input" placeholder="e.g. 1-2, 4-6, 8-10"
        style="width:100%;padding:12px 16px;background:#07070d;border:1px solid rgba(255,255,255,.2);border-radius:10px;color:#eeeef8;font-size:15px;outline:none;box-sizing:border-box;"
        onfocus="this.style.borderColor='#5b5cff'" onblur="this.style.borderColor='rgba(255,255,255,.2)'">
      <div style="margin-top:6px;color:#8888a8;font-size:12px;">Example: to delete page 3 from a 10-page PDF, enter <code style="color:#9898ff;">1-2, 4-10</code></div>
    </div>
    <div id="file-info" style="color:#8888a8;font-size:13px;margin-bottom:16px;"></div>
    <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
      <button onclick="document.getElementById('pdfInput').click()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px;">Change File</button>
      <button onclick="removePages()" style="background:#5b5cff;color:#fff;border:none;padding:12px 32px;border-radius:99px;cursor:pointer;font-size:15px;font-weight:600;">Remove Pages →</button>
    </div>
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Files are automatically deleted after 2 hours · 100% secure</p>
  </div>
</div>

{{-- QUICK EXAMPLES --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:18px;padding:28px;">
    <h2 style="font-size:20px;font-weight:700;margin-bottom:6px;">💡 Quick Reference: What to Enter</h2>
    <p style="color:#8888a8;font-size:13px;margin-bottom:20px;">Remember: enter pages to KEEP, not pages to delete</p>
    <div style="display:flex;flex-direction:column;gap:12px;">
      @foreach([
        ['Delete page 3 from a 10-page PDF','Enter: 1-2, 4-10','Keeps all pages except page 3'],
        ['Delete first page (cover page)','Enter: 2-[last page]','Useful for removing title pages before sharing'],
        ['Delete last page','Enter: 1-[second to last]','Common for removing blank end pages'],
        ['Delete pages 5, 8, and 12','Enter: 1-4, 6-7, 9-11, 13-[last]','Skip the pages you want to remove'],
        ['Keep only the first 3 pages','Enter: 1-3','Everything after page 3 is removed'],
      ] as $ex)
      <div style="background:#07070d;border-radius:10px;padding:14px 16px;">
        <div style="font-weight:600;font-size:13px;color:#eeeef8;margin-bottom:4px;">{{ $ex[0] }}</div>
        <code style="color:#9898ff;font-size:13px;">{{ $ex[1] }}</code>
        <div style="color:#8888a8;font-size:12px;margin-top:4px;">{{ $ex[2] }}</div>
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- HOW IT WORKS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">How to Remove PDF Pages in 3 Steps</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
    @foreach([
      ['📤','1. Upload Your PDF','Drag and drop or click to select your PDF. Files up to 10MB are free. Encrypted in transit.'],
      ['🔢','2. Enter Pages to Keep','Type the page numbers you want to keep — the tool removes everything else automatically.'],
      ['⬇️','3. Download Cleaned PDF','Your PDF downloads instantly with the unwanted pages removed. Full quality, no watermark.'],
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
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">Why PDFTash for Removing PDF Pages?</h2>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['🎯','Precise Page Control','Remove exactly the pages you specify. Single pages, ranges, or combinations — total precision over your document.'],
      ['🚫','No Signup Ever','Remove pages from any PDF without creating an account or providing any personal information.'],
      ['✅','No Watermark','The cleaned PDF output has zero added branding. It looks exactly as if those pages were never there.'],
      ['🔒','Private & Secure','All files are encrypted during upload and download. Auto-deleted after 2 hours with no exceptions.'],
      ['⚡','Instant Processing','Page removal happens in seconds on our servers. No waiting, no queue for standard PDF sizes.'],
      ['📱','Works Everywhere','Runs in any browser on any device — Chrome, Safari, Firefox, Edge — desktop, tablet, or mobile.'],
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
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">PDFTash vs Competitors for Removing Pages</h2>
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
          ['100% Free','✅','❌ Paid after 2/hr','❌ Limited'],
          ['No Signup Required','✅','✅','✅'],
          ['No Daily Limit','✅','❌ 2 tasks/hr','❌ Rate limited'],
          ['Remove Multiple Pages','✅','✅','✅'],
          ['No Watermark on Output','✅','✅','✅'],
          ['Zero Quality Loss','✅','✅','✅'],
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
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">Related PDF Tools</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([
      ['Split PDF','/split-pdf'],
      ['Extract Pages from PDF','/extract-pages-from-pdf'],
      ['Merge PDF','/merge-pdf'],
      ['Combine PDF Pages','/combine-pdf-pages'],
      ['Split into Multiple Files','/split-pdf-into-multiple-files'],
      ['Compress PDF','/compress-pdf'],
      ['Sign PDF','/sign-pdf'],
    ] as $t)
    <a href="{{ $t[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — Remove Pages from PDF</h2>
  <div class="faq-item">
    <h3>How do I remove a specific page from a PDF?</h3>
    <p>Upload your PDF, then in the page input box, enter the pages you want to KEEP. For example, to remove page 3 from a 10-page PDF, enter <code style="color:#9898ff">1-2, 4-10</code>. The tool extracts those pages into a new PDF, effectively deleting page 3 from the output.</p>
  </div>
  <div class="faq-item">
    <h3>Can I delete multiple pages from a PDF at once?</h3>
    <p>Yes. The page input supports any combination of page numbers and ranges. To remove pages 3, 7, and 10-12 from a 15-page PDF, enter <code style="color:#9898ff">1-2, 4-6, 8-9, 13-15</code> in the keep field. All specified pages will appear in the output; the rest are removed.</p>
  </div>
  <div class="faq-item">
    <h3>Why do I enter pages to KEEP instead of pages to DELETE?</h3>
    <p>The underlying PDF engine uses a page extraction model (the same as our <a href="/extract-pages-from-pdf" style="color:#5b5cff">Extract Pages</a> tool). Entering pages to keep is more reliable because you explicitly control what is in the output. There is no risk of accidentally including an unwanted page through an inversion error.</p>
  </div>
  <div class="faq-item">
    <h3>Will removing pages reduce the file size?</h3>
    <p>Yes. Removing pages removes their content — images, fonts, and any page-specific data. The resulting PDF will be proportionally smaller. If you need to reduce it further, run the output through our <a href="/compress-pdf" style="color:#5b5cff">Compress PDF</a> tool.</p>
  </div>
  <div class="faq-item">
    <h3>What happens to the original PDF after removing pages?</h3>
    <p>The original PDF is never modified. PDFTash creates a completely new PDF with only the pages you specified. Both the original upload and the output are automatically and permanently deleted from our servers after 2 hours.</p>
  </div>
  <div class="faq-item">
    <h3>Can I remove pages from a scanned PDF?</h3>
    <p>Yes. The tool works with all PDF types — scanned image PDFs, text PDFs, mixed content, and PDFs from any source. Scanned PDFs are stored as image pages and remove exactly like any other type of PDF page.</p>
  </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
let currentFile = null;

const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = '#5b5cff'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.style.borderColor = 'rgba(255,255,255,.15)';
    const file = e.dataTransfer.files[0];
    if (file && file.type === 'application/pdf') setFile(file);
});

function handleFile(input) { if (input.files[0]) setFile(input.files[0]); }

function setFile(file) {
    currentFile = file;
    dropZone.style.display = 'none';
    document.getElementById('page-input-section').style.display = 'block';
    document.getElementById('file-info').textContent = `File: ${file.name} (${(file.size/1024).toFixed(0)} KB)`;
}

async function removePages() {
    const pages = document.getElementById('pages-input').value.trim();
    if (!pages) { alert('Please enter the page numbers you want to KEEP in the output.'); return; }
    if (!currentFile) { alert('Please upload a PDF first.'); return; }

    const result = document.getElementById('result');
    result.style.display = 'block';
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Removing pages from your PDF...</div>';
    document.getElementById('page-input-section').style.display = 'none';

    const formData = new FormData();
    formData.append('file', currentFile);
    formData.append('pages', pages);
    formData.append('_token', CSRF);

    try {
        const resp = await fetch('/api/pdf/split', {method:'POST', body:formData});
        if (resp.ok) {
            const blob = await resp.blob();
            const url = URL.createObjectURL(blob);
            const sizeKB = (blob.size / 1024).toFixed(0);
            const origKB = (currentFile.size / 1024).toFixed(0);
            result.innerHTML = `
                <div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;">
                    <div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:8px">✅ Pages removed successfully!</div>
                    <div style="color:#8888a8;font-size:14px">${origKB} KB → <strong style="color:#eeeef8">${sizeKB} KB</strong></div>
                </div>
                <a href="${url}" download="cleaned.pdf" style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">⬇ Download Cleaned PDF</a>
                <br><br>
                <button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Remove Pages from Another PDF</button>`;
        } else {
            const data = await resp.json().catch(()=>({}));
            result.innerHTML = `<div style="color:#ff6b6b;padding:20px">Error: ${data.error || 'Something went wrong. Please check your page numbers and try again.'}</div>`;
            document.getElementById('page-input-section').style.display = 'block';
        }
    } catch(e) {
        result.innerHTML = `<div style="color:#ff6b6b;padding:20px">Connection error. Please try again.</div>`;
        document.getElementById('page-input-section').style.display = 'block';
    }
}
</script>
@endsection
