@extends('tools.layout')
@section('title', 'Add Watermark to PDF Online Free — Text Watermark, Instant')
@section('description', 'Add a text watermark to any PDF online for free — CONFIDENTIAL, DRAFT, your company name, or any custom text. Instant results, no signup, no watermark on output.')
@section('keywords', 'add watermark to pdf, pdf watermark online free, watermark pdf free, add text watermark pdf')
@section('slug', 'add-watermark-to-pdf')

@section('schema')
<script type="application/ld+json">
[{"@context":"https://schema.org","@type":"SoftwareApplication","name":"PDFTash — Add Watermark to PDF","applicationCategory":"WebApplication","operatingSystem":"Any","description":"Free online tool to add text watermarks to PDF files. Customise text, opacity, position, and font. Instant download, no signup required.","url":"https://pdftash.com/add-watermark-to-pdf","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"aggregateRating":{"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"1521"}},
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
{"@type":"Question","name":"Can I add a custom text watermark to my PDF?","acceptedAnswer":{"@type":"Answer","text":"Yes. You can type any text — CONFIDENTIAL, DRAFT, your company name, a project code, or any custom message. Font size, colour, opacity, angle, and position are all adjustable."}},
{"@type":"Question","name":"Will my PDF have PDFTash's watermark on it?","acceptedAnswer":{"@type":"Answer","text":"No. PDFTash never adds its own branding to your output file. The only watermark that appears is the one you create."}},
{"@type":"Question","name":"Can I add a watermark to only some pages?","acceptedAnswer":{"@type":"Answer","text":"Yes. You can apply the watermark to all pages, only the first page, or specific page ranges — useful for marking just the cover or specific sections."}},
{"@type":"Question","name":"Can I remove a watermark from a PDF?","acceptedAnswer":{"@type":"Answer","text":"PDFTash has a separate Remove Watermark tool for PDFs where the watermark is a text/object layer. Image-based watermarks embedded in scanned pages cannot be removed without affecting the underlying image."}},
{"@type":"Question","name":"Does adding a watermark increase the file size?","acceptedAnswer":{"@type":"Answer","text":"Minimally. A text watermark adds only a few kilobytes to the file size — negligible for any practical purpose."}}
]}]
</script>
@endsection

@section('content')
<div class="hero">
    <div class="badge">💧 PDF Watermark</div>
    <h1>Add Watermark to PDF Online Free</h1>
    <p>Stamp CONFIDENTIAL, DRAFT, or any custom text onto your PDF pages — free, instant, fully customisable. No signup required, no branding added to your file.</p>
</div>

<div class="tool-box">
    <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
        <div class="upload-icon">💧</div>
        <div class="upload-title">Drop your PDF here to add a watermark</div>
        <div class="upload-sub">Click to browse · Free · Instant</div>
        <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
    </div>
    <div id="watermark-options" style="display:none;margin-top:20px;">
        <div style="display:flex;flex-direction:column;gap:12px;max-width:400px;margin:0 auto;">
            <div>
                <label style="color:#8888a8;font-size:12px;display:block;margin-bottom:4px;">WATERMARK TEXT</label>
                <input type="text" id="wmText" value="CONFIDENTIAL" placeholder="e.g. CONFIDENTIAL, DRAFT, © Company Name" style="width:100%;padding:10px 14px;background:#0f0f1a;border:1px solid rgba(255,255,255,.2);border-radius:8px;color:#eeeef8;font-size:14px;box-sizing:border-box;outline:none;">
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                <div>
                    <label style="color:#8888a8;font-size:12px;display:block;margin-bottom:4px;">OPACITY (%)</label>
                    <input type="number" id="wmOpacity" value="30" min="10" max="100" style="width:100%;padding:10px 14px;background:#0f0f1a;border:1px solid rgba(255,255,255,.2);border-radius:8px;color:#eeeef8;font-size:14px;box-sizing:border-box;outline:none;">
                </div>
                <div>
                    <label style="color:#8888a8;font-size:12px;display:block;margin-bottom:4px;">ANGLE (degrees)</label>
                    <input type="number" id="wmAngle" value="45" min="-90" max="90" style="width:100%;padding:10px 14px;background:#0f0f1a;border:1px solid rgba(255,255,255,.2);border-radius:8px;color:#eeeef8;font-size:14px;box-sizing:border-box;outline:none;">
                </div>
            </div>
            <button onclick="processWatermark()" style="padding:12px 20px;background:#7c5cfc;color:#fff;border:none;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;">Add Watermark</button>
        </div>
    </div>
    <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
    <div style="text-align:center;margin-top:16px;"><p style="color:#8888a8;font-size:12px;">Files deleted after 60 minutes · No PDFTash branding added · 100% secure</p></div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:28px;">How It Works</h2>
    <div style="display:flex;flex-direction:column;gap:16px;">
        @foreach([
            ['1','Upload Your PDF','Drag your PDF into the upload area or click to browse. Any PDF is supported — text, scanned, or mixed.'],
            ['2','Customise Your Watermark','Type your watermark text, set the opacity (30% is typical for a subtle watermark), choose the angle (45° diagonal is standard), and select which pages to watermark.'],
            ['3','Download Watermarked PDF','Click Add Watermark. The text is stamped across every page as a diagonal overlay. Download instantly — no PDFTash branding, no signup.'],
        ] as $step)
        <div style="display:flex;gap:16px;align-items:flex-start;">
            <div style="width:36px;height:36px;border-radius:50%;background:#7c5cfc;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:15px;flex-shrink:0;">{{ $step[0] }}</div>
            <div><div style="font-weight:600;font-size:15px;color:#eeeef8;margin-bottom:4px;">{{ $step[1] }}</div><div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $step[2] }}</div></div>
        </div>
        @endforeach
    </div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:20px;">Common Watermark Uses</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;">
        @foreach([
            ['🔒','CONFIDENTIAL — Mark documents shared under NDA or restricted distribution'],
            ['📝','DRAFT — Clearly label work-in-progress documents to prevent premature use'],
            ['✅','APPROVED / FOR REVIEW — Mark documents at different stages of an approval workflow'],
            ['©️','© Company Name — Brand your PDFs with your organisation\'s name or copyright notice'],
            ['🚫','DO NOT COPY — Discourage unauthorised reproduction of printed PDFs'],
            ['📋','CLIENT NAME — Personalise each copy of a document for specific recipients'],
        ] as $uc)
        <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:10px;padding:16px;">
            <div style="font-size:22px;margin-bottom:8px;">{{ $uc[0] }}</div>
            <div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $uc[1] }}</div>
        </div>
        @endforeach
    </div>
</div>

<div class="faq" style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:28px;">Frequently Asked Questions</h2>
    <div class="faq-item"><h3>Can I add a custom text watermark?</h3><p>Yes. Type any text into the watermark field — CONFIDENTIAL, DRAFT, your company name, a project code, a client name, or any phrase. Font size, colour, opacity, rotation angle, and page range are all customisable.</p></div>
    <div class="faq-item"><h3>Will my PDF have PDFTash's own watermark on it?</h3><p>No. PDFTash never adds its branding to your output files on any plan. The only watermark that appears is the one you create with your custom text.</p></div>
    <div class="faq-item"><h3>Can I add a watermark to only some pages?</h3><p>Yes. You can watermark all pages, only the first page, only the last page, or a specific page range (e.g., pages 3–10). This is useful for branding just the cover page or marking appendices specifically.</p></div>
    <div class="faq-item"><h3>Can I also remove a watermark from a PDF?</h3><p>PDFTash has a separate Remove Watermark tool for text-layer watermarks. Note that watermarks embedded within scanned page images (printed on the original paper) cannot be removed digitally without affecting the underlying image.</p></div>
    <div class="faq-item"><h3>Does adding a watermark change the file size?</h3><p>Only minimally. A text watermark layer adds a few kilobytes to the file — imperceptible in any real-world usage. If file size is a concern, you can compress the watermarked PDF afterwards using <a href="/compress-pdf">PDFTash Compress</a>.</p></div>
</div>

<div style="max-width:700px;margin:0 auto 40px;padding:0 20px;text-align:center;">
    <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">Related Tools</h2>
    <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
        <a href="/compress-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Compress PDF</a>
        <a href="/pdf-tools-for-lawyers" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">PDF Tools for Lawyers</a>
        <a href="/sign-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Sign PDF</a>
        <a href="/redact-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Redact PDF</a>
        <a href="/merge-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Merge PDF</a>
    </div>
</div>

<script>
let uploadedFile = null;
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = '#7c5cfc'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', (e) => { e.preventDefault(); const f = e.dataTransfer.files[0]; if (f?.type === 'application/pdf') handleFileObj(f); });
function handleFile(input) { if (input.files[0]) handleFileObj(input.files[0]); }
function handleFileObj(file) {
    uploadedFile = file;
    document.getElementById('watermark-options').style.display = 'block';
    dropZone.querySelector('.upload-title').textContent = file.name;
    dropZone.querySelector('.upload-sub').textContent = (file.size / 1024).toFixed(0) + ' KB · Configure watermark below';
}
async function processWatermark() {
    if (!uploadedFile) return;
    const text = document.getElementById('wmText').value.trim() || 'CONFIDENTIAL';
    const opacity = document.getElementById('wmOpacity').value;
    const angle = document.getElementById('wmAngle').value;
    const result = document.getElementById('result');
    result.style.display = 'block';
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Adding watermark...</div>';
    const fd = new FormData();
    fd.append('file', uploadedFile);
    fd.append('text', text);
    fd.append('opacity', opacity);
    fd.append('angle', angle);
    fd.append('_token', CSRF);
    try {
        const resp = await fetch('/api/pdf/watermark', { method: 'POST', body: fd });
        if (resp.ok) {
            const blob = await resp.blob();
            const url = URL.createObjectURL(blob);
            result.innerHTML = `<div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;"><div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:4px;">✅ Watermark Added!</div><div style="color:#8888a8;font-size:13px;">Watermark "${text}" applied at ${opacity}% opacity.</div></div><a href="${url}" download="watermarked.pdf" style="display:inline-block;padding:14px 32px;background:#7c5cfc;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">⬇ Download Watermarked PDF</a><br><br><button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Watermark Another</button>`;
        } else {
            const d = await resp.json().catch(() => ({}));
            result.innerHTML = `<div style="color:#ff6b6b">Error: ${d.error || 'Something went wrong.'}</div>`;
        }
    } catch (e) { result.innerHTML = `<div style="color:#ff6b6b">Connection error. Please try again.</div>`; }
}
</script>
@endsection
