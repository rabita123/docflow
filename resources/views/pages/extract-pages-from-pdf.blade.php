@extends('tools.layout')

@section('title', 'Extract Pages from PDF Free — Pull Specific Pages Online')
@section('description', 'Extract specific pages from any PDF online free. Enter page numbers or ranges, download extracted pages as a new PDF. No signup, instant download.')
@section('keywords', 'extract pages from pdf, extract pdf pages online, pull pages from pdf, extract specific pages pdf, pdf page extractor free')
@section('slug', 'extract-pages-from-pdf')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash — Extract Pages from PDF",
  "applicationCategory": "WebApplication",
  "operatingSystem": "Any",
  "description": "Free online tool to extract specific pages from any PDF. Enter page numbers or ranges and download the extracted pages as a new PDF. No signup required.",
  "url": "https://pdftash.com/extract-pages-from-pdf",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"},
  "aggregateRating": {"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"1490"}
},
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Extract Pages from a PDF Online Free",
  "description": "Pull specific pages from any PDF in 3 steps using PDFTash — free, no signup.",
  "step": [
    {"@type":"HowToStep","position":1,"name":"Upload your PDF","text":"Drag and drop your PDF or click to browse. Any PDF size up to 10MB (free) or 200MB (Pro) is accepted."},
    {"@type":"HowToStep","position":2,"name":"Enter page numbers","text":"Type the pages you want to extract — individual pages like 1, 3, 5 or ranges like 2-7. Mixed formats work too."},
    {"@type":"HowToStep","position":3,"name":"Download extracted pages","text":"Click Extract and download your new PDF containing only the pages you specified."}
  ]
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"How do I enter page numbers for extraction?","acceptedAnswer":{"@type":"Answer","text":"Enter individual page numbers separated by commas (e.g., 1, 3, 5) or use ranges with a dash (e.g., 2-7). You can mix both formats: 1-3, 5, 8-10. The pages will be extracted in the order you specify."}},
    {"@type":"Question","name":"What happens to the original PDF after extraction?","acceptedAnswer":{"@type":"Answer","text":"The original PDF is not modified. PDFTash creates a brand new PDF containing only the pages you specified. Your source file is automatically deleted from our servers after 2 hours."}},
    {"@type":"Question","name":"Can I extract pages from a password-protected PDF?","acceptedAnswer":{"@type":"Answer","text":"You need to unlock the PDF first before extracting pages. If you know the password, open the PDF in your browser or a PDF reader and re-save it without a password, then upload to PDFTash."}},
    {"@type":"Question","name":"Is there a limit on how many pages I can extract?","acceptedAnswer":{"@type":"Answer","text":"No. You can extract any number of pages from any PDF. Extract one page or one hundred — there is no page count limit."}},
    {"@type":"Question","name":"Will the extracted pages keep their original quality?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash extracts pages without re-encoding any content. Images, text, fonts, and vector graphics remain at 100% original quality in the output PDF."}},
    {"@type":"Question","name":"Can I extract the same page multiple times?","acceptedAnswer":{"@type":"Answer","text":"Yes. If you enter the same page number more than once (e.g., 1, 1, 3), the page will appear multiple times in the output. This is useful when you need duplicate copies of a page within one document."}}
  ]
}
]
</script>
@endsection

@section('content')
<div class="hero">
  <div class="badge">✂️ Extract Pages from PDF</div>
  <h1>Extract Pages from PDF — Free Online Tool</h1>
  <p>Pull specific pages from any PDF instantly. Enter page numbers or ranges, download a new PDF with only the pages you need. No signup, no watermark.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">📄</div>
    <div class="upload-title">Drop your PDF here to extract pages</div>
    <div class="upload-sub">Click to browse · Up to 10MB free · No signup required</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="page-input-section" style="display:none;margin-top:24px;">
    <div style="margin-bottom:16px;">
      <label style="display:block;font-size:13px;color:#8888a8;margin-bottom:8px;font-weight:500;">Enter pages to extract (e.g. 1, 3-5, 8):</label>
      <input type="text" id="pages-input" placeholder="e.g. 1, 3-5, 8, 10-12"
        style="width:100%;padding:12px 16px;background:#07070d;border:1px solid rgba(255,255,255,.2);border-radius:10px;color:#eeeef8;font-size:15px;outline:none;box-sizing:border-box;"
        onfocus="this.style.borderColor='#5b5cff'" onblur="this.style.borderColor='rgba(255,255,255,.2)'">
      <div style="margin-top:6px;color:#8888a8;font-size:12px;">Use commas for individual pages and dashes for ranges. Example: <code style="color:#9898ff;">1-3, 5, 7-9</code></div>
    </div>
    <div id="file-info" style="color:#8888a8;font-size:13px;margin-bottom:16px;"></div>
    <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
      <button onclick="document.getElementById('pdfInput').click()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px;">Change File</button>
      <button onclick="extractPages()" style="background:#5b5cff;color:#fff;border:none;padding:12px 32px;border-radius:99px;cursor:pointer;font-size:15px;font-weight:600;">Extract Pages →</button>
    </div>
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Files are automatically deleted after 2 hours · 100% secure</p>
  </div>
</div>

{{-- PAGE RANGE GUIDE --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:18px;padding:28px;">
    <h2 style="font-size:20px;font-weight:700;margin-bottom:20px;">📖 How to Enter Page Numbers</h2>
    <div style="display:flex;flex-direction:column;gap:12px;">
      @foreach([
        ['1, 3, 5','Extracts pages 1, 3, and 5 only'],
        ['2-6','Extracts pages 2 through 6 (five pages total)'],
        ['1-3, 7, 10-12','Extracts pages 1 to 3, page 7, and pages 10 to 12'],
        ['1','Extracts just the first page — useful for cover pages'],
        ['1, 1, 2','Extracts page 1 twice, then page 2 (duplicate pages allowed)'],
      ] as $ex)
      <div style="display:flex;gap:16px;align-items:center;padding:10px;background:#07070d;border-radius:8px;">
        <code style="background:rgba(91,92,255,.15);color:#9898ff;padding:6px 14px;border-radius:6px;font-size:14px;white-space:nowrap;flex-shrink:0;min-width:140px;text-align:center;">{{ $ex[0] }}</code>
        <span style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $ex[1] }}</span>
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- HOW IT WORKS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">How to Extract PDF Pages in 3 Steps</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
    @foreach([
      ['📤','1. Upload Your PDF','Drag and drop your PDF or click to browse. Any PDF up to 10MB is accepted free. Your file is encrypted in transit.'],
      ['🔢','2. Enter Page Numbers','Type the pages you want — individual numbers, ranges, or a mix. No page count limit.'],
      ['⬇️','3. Download Extracted PDF','Click Extract and download your new PDF instantly. Contains only the pages you specified, at full quality.'],
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
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">Why Use PDFTash to Extract PDF Pages?</h2>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['✂️','Flexible Page Selection','Enter single pages, ranges, or any combination. Supports: 1, 3-5, 8, 10-end. Maximum flexibility with minimum effort.'],
      ['🎯','Zero Quality Loss','Extracted pages retain 100% of their original quality — images, text, and vector graphics are not re-encoded.'],
      ['🚫','No Signup Required','Extract pages instantly without creating an account, providing an email, or entering payment details.'],
      ['⚡','Instant Processing','Extraction happens in seconds. Your new PDF downloads as soon as processing completes.'],
      ['🔒','Private & Secure','Files are encrypted during transfer and automatically deleted from servers after 2 hours.'],
      ['♾️','No Page Count Limit','Extract one page or one hundred. There is no maximum on the number of pages in your output.'],
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
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">PDFTash vs Competitors for Extracting Pages</h2>
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
          ['Page Range Input','✅','✅','✅'],
          ['No Watermark on Output','✅','✅','✅'],
          ['Zero Quality Loss','✅','✅','✅'],
          ['AI Features (Chat, Translate)','✅','❌','❌'],
          ['Files Auto-Deleted After 2hr','✅','✅','✅'],
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
      ['Remove Pages from PDF','/remove-pages-from-pdf'],
      ['Merge PDF','/merge-pdf'],
      ['Combine PDF Pages','/combine-pdf-pages'],
      ['Split into Multiple Files','/split-pdf-into-multiple-files'],
      ['Compress PDF','/compress-pdf'],
      ['Chat with PDF','/chat-with-pdf'],
    ] as $t)
    <a href="{{ $t[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — Extract Pages from PDF</h2>
  <div class="faq-item">
    <h3>How do I enter page numbers or ranges for extraction?</h3>
    <p>Type page numbers in the input field using commas to separate individual pages (e.g., <code style="color:#9898ff">1, 3, 5</code>) and dashes for ranges (e.g., <code style="color:#9898ff">2-6</code>). You can mix both formats freely: <code style="color:#9898ff">1-3, 5, 8-10</code> will extract pages 1 through 3, page 5, and pages 8 through 10.</p>
  </div>
  <div class="faq-item">
    <h3>What happens to the original PDF after I extract pages?</h3>
    <p>The original PDF is never modified. PDFTash creates a brand new PDF containing only the pages you specified. Both the original and the extracted output are automatically deleted from our servers after 2 hours. Nothing is stored permanently.</p>
  </div>
  <div class="faq-item">
    <h3>Can I extract pages from a password-protected PDF?</h3>
    <p>PDFTash cannot process password-protected PDFs directly. You need to remove the password first. If you know the password, open the file in Adobe Reader or Chrome (which can open PDFs), then print/save it as a new PDF without a password. Then upload to PDFTash.</p>
  </div>
  <div class="faq-item">
    <h3>Is there a limit on how many pages I can extract at once?</h3>
    <p>No. You can extract any number of pages in a single operation — from 1 page to the entire document. There is no page count limit in the extraction tool. The only restriction is the upload file size: 10MB for free users, 200MB for Pro users.</p>
  </div>
  <div class="faq-item">
    <h3>Will the extracted pages lose quality compared to the original?</h3>
    <p>No. PDFTash extracts pages by reading the PDF structure and writing only the specified pages to a new file. No content is re-rendered or re-encoded. Images, text, fonts, and vector graphics remain at exactly 100% original quality.</p>
  </div>
  <div class="faq-item">
    <h3>How is extracting pages different from splitting a PDF?</h3>
    <p>Split PDF typically divides a document into sequential parts (e.g., pages 1-5 and pages 6-10). Extract Pages lets you pick any specific pages in any order — you could extract page 3, then page 7, then pages 12-15. For splitting sequentially into multiple files, use our <a href="/split-pdf-into-multiple-files" style="color:#5b5cff">Split PDF into Multiple Files</a> tool.</p>
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

async function extractPages() {
    const pages = document.getElementById('pages-input').value.trim();
    if (!pages) { alert('Please enter the page numbers you want to extract.'); return; }
    if (!currentFile) { alert('Please upload a PDF first.'); return; }

    const result = document.getElementById('result');
    result.style.display = 'block';
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Extracting pages from your PDF...</div>';
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
            result.innerHTML = `
                <div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;">
                    <div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:8px">✅ Pages extracted successfully!</div>
                    <div style="color:#8888a8;font-size:14px">Output: <strong style="color:#eeeef8">${sizeKB} KB</strong> · Pages: <strong style="color:#eeeef8">${pages}</strong></div>
                </div>
                <a href="${url}" download="extracted-pages.pdf" style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">⬇ Download Extracted Pages</a>
                <br><br>
                <button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Extract from Another PDF</button>`;
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
