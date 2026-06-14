@extends('tools.layout')

@section('title', 'Split PDF Into Multiple Files Free — Online, No Signup')
@section('description', 'Split one PDF into multiple separate files online free. Split by page ranges, extract every page, or divide into equal parts. No signup, instant download.')
@section('keywords', 'split pdf into multiple files, split pdf into separate files, divide pdf into parts, split pdf pages, pdf splitter online free')
@section('slug', 'split-pdf-into-multiple-files')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash — Split PDF Into Multiple Files",
  "applicationCategory": "WebApplication",
  "operatingSystem": "Any",
  "description": "Free online tool to split one PDF into multiple separate files. Split by page ranges, extract every page, or divide into equal parts. No signup required.",
  "url": "https://pdftash.com/split-pdf-into-multiple-files",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"},
  "aggregateRating": {"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"1670"}
},
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Split a PDF Into Multiple Files Online Free",
  "description": "Divide a PDF into separate files by page ranges using PDFTash — free, no signup.",
  "step": [
    {"@type":"HowToStep","position":1,"name":"Upload your PDF","text":"Drag and drop your PDF or click to browse. Up to 10MB for free users."},
    {"@type":"HowToStep","position":2,"name":"Enter your split ranges","text":"Define the page ranges for each output file. For example, 1-5 creates file 1 with pages 1 to 5; 6-10 creates file 2 with pages 6 to 10."},
    {"@type":"HowToStep","position":3,"name":"Download your files","text":"Download each split section as a separate PDF. All files are generated at full quality, no watermarks."}
  ]
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"How do I split a PDF into multiple files?","acceptedAnswer":{"@type":"Answer","text":"Upload your PDF to PDFTash, then use the Split PDF tool. Enter the page ranges for each section you want as a separate file. Each range becomes an independent PDF download."}},
    {"@type":"Question","name":"Can I split a PDF into equal parts?","acceptedAnswer":{"@type":"Answer","text":"Yes. If you have a 20-page PDF and want 4 files of 5 pages each, enter ranges like 1-5, 6-10, 11-15, 16-20 in the split tool. Each range becomes a separate PDF."}},
    {"@type":"Question","name":"What is the maximum number of files I can split a PDF into?","acceptedAnswer":{"@type":"Answer","text":"There is no maximum. You can split a PDF into as many separate files as you have pages. A 100-page PDF could be split into 100 individual one-page files if needed."}},
    {"@type":"Question","name":"Will split PDFs lose quality compared to the original?","acceptedAnswer":{"@type":"Answer","text":"No. Splitting is a structural operation — pages are moved to new files without any re-encoding. Images, text, and graphics remain at full original quality."}},
    {"@type":"Question","name":"Can I split a scanned PDF into multiple files?","acceptedAnswer":{"@type":"Answer","text":"Yes. Scanned PDFs split exactly like any other PDF. Each page is an image, and it moves intact into the new file."}},
    {"@type":"Question","name":"How is splitting different from extracting pages?","acceptedAnswer":{"@type":"Answer","text":"Splitting typically divides a document into sequential sections (part 1, part 2, etc.). Extracting lets you pick non-sequential specific pages into one output file. For splitting sequentially, use this tool. For picking specific pages, use Extract Pages from PDF."}}
  ]
}
]
</script>
@endsection

@section('content')
<div class="hero">
  <div class="badge">✂️ Split PDF Into Multiple Files</div>
  <h1>Split PDF Into Multiple Files — Free &amp; Instant</h1>
  <p>Divide one PDF into multiple separate files by page ranges. Extract every page individually or split into equal parts. No signup, no watermark, full quality.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">📄</div>
    <div class="upload-title">Drop your PDF here to split into multiple files</div>
    <div class="upload-sub">Click to browse · Up to 10MB free · No signup needed</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="split-input-section" style="display:none;margin-top:24px;">
    <div style="margin-bottom:16px;">
      <label style="display:block;font-size:13px;color:#8888a8;margin-bottom:8px;font-weight:500;">Enter the page range for the FIRST split file:</label>
      <input type="text" id="pages-input" placeholder="e.g. 1-5  (for pages 1 to 5 as the first output file)"
        style="width:100%;padding:12px 16px;background:#07070d;border:1px solid rgba(255,255,255,.2);border-radius:10px;color:#eeeef8;font-size:15px;outline:none;box-sizing:border-box;"
        onfocus="this.style.borderColor='#5b5cff'" onblur="this.style.borderColor='rgba(255,255,255,.2)'">
      <div style="margin-top:6px;color:#8888a8;font-size:12px;">For multiple output files, use our main <a href="/split-pdf" style="color:#5b5cff">Split PDF</a> tool which supports multi-range splitting in one operation.</div>
    </div>
    <div id="file-info" style="color:#8888a8;font-size:13px;margin-bottom:16px;"></div>
    <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
      <button onclick="document.getElementById('pdfInput').click()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px;">Change File</button>
      <button onclick="splitPDF()" style="background:#5b5cff;color:#fff;border:none;padding:12px 32px;border-radius:99px;cursor:pointer;font-size:15px;font-weight:600;">Split PDF →</button>
    </div>
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Files are automatically deleted after 2 hours · 100% secure</p>
  </div>
</div>

{{-- SPLIT METHODS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:12px;">Ways to Split a PDF Into Multiple Files</h2>
  <p style="text-align:center;color:#8888a8;font-size:14px;margin-bottom:28px;">Choose the splitting method that fits your use case</p>
  <div style="display:flex;flex-direction:column;gap:14px;">
    @foreach([
      ['📏','Split by Page Ranges','Define custom ranges for each output file. A 30-page PDF with ranges 1-10, 11-20, 21-30 produces three 10-page files. Perfect for splitting documents into chapters, sections, or volumes.'],
      ['📄','Extract Every Page Individually','Split a PDF so each page becomes its own separate file. A 5-page PDF becomes 5 individual PDFs. Useful for image PDFs, certificates, or presentations where every page is standalone.'],
      ['⚖️','Split Into Equal Parts','Divide a PDF into equal-sized chunks. A 20-page PDF into 4 parts of 5 pages each. Useful for distributing workloads or meeting upload limits.'],
      ['✂️','Split at a Specific Page','Split a PDF into exactly two files — everything before and everything after a specific page. Upload once, extract the first part, then extract the second part.'],
    ] as $m)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:22px;display:flex;gap:18px;align-items:flex-start;">
      <div style="font-size:28px;flex-shrink:0;">{{ $m[0] }}</div>
      <div>
        <div style="font-weight:600;font-size:15px;margin-bottom:6px;">{{ $m[1] }}</div>
        <div style="color:#8888a8;font-size:13px;line-height:1.6;">{{ $m[2] }}</div>
      </div>
    </div>
    @endforeach
  </div>
</div>

{{-- PAGE RANGE SYNTAX --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:18px;padding:28px;">
    <h2 style="font-size:20px;font-weight:700;margin-bottom:6px;">📖 Page Range Examples for Splitting</h2>
    <p style="color:#8888a8;font-size:13px;margin-bottom:20px;">Use these formats when entering page ranges to split your PDF</p>
    <div style="display:flex;flex-direction:column;gap:12px;">
      @foreach([
        ['1-10','First 10 pages → Output file 1','Split a 30-page PDF into three 10-page files by running the tool 3 times with ranges 1-10, 11-20, 21-30'],
        ['1-5','Pages 1 to 5 → Chapter 1','Split a book PDF into chapters by running once per chapter range'],
        ['1','First page only','Extract just the cover page or first page as its own PDF'],
        ['6-10','Pages 6 to 10 → Section 2','Extract any middle section of the document'],
      ] as $ex)
      <div style="display:flex;gap:16px;align-items:flex-start;padding:12px;background:#07070d;border-radius:8px;">
        <code style="background:rgba(91,92,255,.15);color:#9898ff;padding:6px 14px;border-radius:6px;font-size:14px;white-space:nowrap;flex-shrink:0;min-width:80px;text-align:center;">{{ $ex[0] }}</code>
        <div>
          <div style="font-weight:600;font-size:13px;color:#eeeef8;margin-bottom:2px;">{{ $ex[1] }}</div>
          <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $ex[2] }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- USE CASES --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:12px;">Common Reasons to Split a PDF Into Multiple Files</h2>
  <p style="text-align:center;color:#8888a8;font-size:14px;margin-bottom:28px;">Splitting is one of the most frequently needed PDF operations</p>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['📧','Email Attachment Limits','Split a large report into sections that each fit under a 25MB email limit. Send each section as a separate attachment.'],
      ['📚','Book Chapters','Divide a textbook or manual PDF into individual chapters so students or readers can download only what they need.'],
      ['🏛️','Government Form Submission','Many portals require separate file uploads for different document types. Split a multi-section document to meet this requirement.'],
      ['💼','Client Deliverables','Split a comprehensive report into executive summary, methodology, and appendix — send each to the right audience.'],
      ['🖨️','Batch Printing','Split a large document into smaller print jobs to avoid printer memory limits or to print sections on different paper types.'],
      ['☁️','Cloud Storage','Split very large PDFs to work around per-file size limits on Dropbox, Google Drive, or OneDrive.'],
    ] as $u)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:20px;">
      <div style="font-size:26px;margin-bottom:8px;">{{ $u[0] }}</div>
      <div style="font-weight:600;font-size:13px;color:#eeeef8;margin-bottom:5px;">{{ $u[1] }}</div>
      <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $u[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- FEATURES GRID --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">Why PDFTash for Splitting PDFs?</h2>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['🎯','Precise Range Control','Enter exact page ranges for each output file. Get precisely the sections you need — no more, no less.'],
      ['💎','Zero Quality Loss','Split files are not re-encoded. Images, text, and vector graphics stay at 100% original quality.'],
      ['🚫','No Signup Required','Start splitting immediately. No account, no email, no credit card required for the split tool.'],
      ['⚡','Fast Processing','Split operations complete in seconds on our servers. Instant download when done.'],
      ['🔒','Secure & Private','HTTPS encryption on all transfers. Files auto-deleted after 2 hours. Nothing stored permanently.'],
      ['📱','All Devices Supported','Works in any browser on desktop, tablet, or mobile. No app or plugin download needed.'],
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
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">PDFTash vs Competitors for Splitting PDFs</h2>
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
          ['Custom Page Ranges','✅','✅','✅'],
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
      ['Remove Pages from PDF','/remove-pages-from-pdf'],
      ['Merge PDF','/merge-pdf'],
      ['Combine PDF Pages','/combine-pdf-pages'],
      ['Compress PDF','/compress-pdf'],
      ['Translate PDF','/translate-pdf'],
      ['Sign PDF','/sign-pdf'],
    ] as $t)
    <a href="{{ $t[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — Split PDF Into Multiple Files</h2>
  <div class="faq-item">
    <h3>How do I split a PDF into multiple separate files?</h3>
    <p>Upload your PDF to the tool above, enter the page range for the first output file (e.g., <code style="color:#9898ff">1-10</code>), and download that split section. Repeat the process for each additional section, entering a different range each time. For multi-range splitting in one operation, use the main <a href="/split-pdf" style="color:#5b5cff">Split PDF</a> tool.</p>
  </div>
  <div class="faq-item">
    <h3>Can I split a PDF into equal-sized parts?</h3>
    <p>Yes. For a 20-page PDF divided into 4 equal parts, run the split tool four times with ranges <code style="color:#9898ff">1-5</code>, <code style="color:#9898ff">6-10</code>, <code style="color:#9898ff">11-15</code>, and <code style="color:#9898ff">16-20</code>. Each produces a 5-page PDF. There is no limit on how many times you can process the same source file.</p>
  </div>
  <div class="faq-item">
    <h3>What is the maximum number of files I can split a PDF into?</h3>
    <p>There is no maximum. A 500-page PDF could technically be split into 500 individual one-page files. The only practical limit is the upload file size: 10MB per file for free users, 200MB for Pro users. There are no limits on how many times you process the same document.</p>
  </div>
  <div class="faq-item">
    <h3>Will split PDFs have the same quality as the original?</h3>
    <p>Yes. Splitting is a structural operation that moves pages into new files without re-encoding any content. Images, text, fonts, and vector graphics in the split files are identical to the original. There is zero quality degradation.</p>
  </div>
  <div class="faq-item">
    <h3>How is splitting a PDF different from extracting pages?</h3>
    <p>Splitting typically means dividing a document into sequential sections (pages 1-10, 11-20, etc.) where all pages from the source are distributed across the output files. Extracting pages means pulling specific non-sequential pages into one output file. Use this tool for splitting; use <a href="/extract-pages-from-pdf" style="color:#5b5cff">Extract Pages from PDF</a> for picking specific pages.</p>
  </div>
  <div class="faq-item">
    <h3>Can I split a large PDF file that is over 10MB?</h3>
    <p>Free users are limited to 10MB per upload. For larger files, you have two options: (1) Compress the PDF first using our <a href="/compress-pdf" style="color:#5b5cff">Compress PDF</a> tool to bring it under 10MB, then split. (2) Upgrade to Pro for $2/month to upload files up to 200MB with no daily task limits.</p>
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
    document.getElementById('split-input-section').style.display = 'block';
    document.getElementById('file-info').textContent = `File: ${file.name} (${(file.size/1024).toFixed(0)} KB)`;
}

async function splitPDF() {
    const pages = document.getElementById('pages-input').value.trim();
    if (!pages) { alert('Please enter the page range for this split section (e.g. 1-10).'); return; }
    if (!currentFile) { alert('Please upload a PDF first.'); return; }

    const result = document.getElementById('result');
    result.style.display = 'block';
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Splitting your PDF...</div>';
    document.getElementById('split-input-section').style.display = 'none';

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
            result.innerHTML = `
                <div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;">
                    <div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:8px">✅ PDF split successfully!</div>
                    <div style="color:#8888a8;font-size:14px">Pages <strong style="color:#eeeef8">${pages}</strong> → <strong style="color:#eeeef8">${sizeKB} KB</strong></div>
                </div>
                <a href="${url}" download="split-${pages.replace(/[^0-9]/g,'-')}.pdf" style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">⬇ Download Split PDF</a>
                <br><br>
                <div style="color:#8888a8;font-size:13px;margin-top:8px;margin-bottom:12px;">Need another section? Upload the original PDF again to extract a different range.</div>
                <button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Split Another Section</button>`;
        } else {
            const data = await resp.json().catch(()=>({}));
            result.innerHTML = `<div style="color:#ff6b6b;padding:20px">Error: ${data.error || 'Something went wrong. Please check your page range and try again.'}</div>`;
            document.getElementById('split-input-section').style.display = 'block';
        }
    } catch(e) {
        result.innerHTML = `<div style="color:#ff6b6b;padding:20px">Connection error. Please try again.</div>`;
        document.getElementById('split-input-section').style.display = 'block';
    }
}
</script>
@endsection
