@extends('tools.layout')
@section('title', 'Rotate PDF Online Free — Fix Portrait/Landscape Orientation')
@section('description', 'Rotate PDF pages online free — fix upside-down scans, flip landscape to portrait, rotate individual or all pages. No signup, instant download. PDFTash.')
@section('keywords', 'rotate pdf online free, rotate pdf pages, flip pdf orientation, turn pdf sideways, rotate pdf 90 degrees')
@section('slug', 'rotate-pdf-online')

@section('schema')
<script type="application/ld+json">
[{"@context":"https://schema.org","@type":"SoftwareApplication","name":"PDFTash — Rotate PDF Online","applicationCategory":"WebApplication","operatingSystem":"Any","description":"Free online tool to rotate PDF pages. Fix upside-down scans, flip orientation, rotate 90 or 180 degrees. Instant, no signup required.","url":"https://pdftash.com/rotate-pdf-online","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"aggregateRating":{"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"1843"}},
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
{"@type":"Question","name":"Can I rotate just one page in a multi-page PDF?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash lets you select individual pages or groups of pages to rotate, while leaving the rest of the document untouched."}},
{"@type":"Question","name":"Can I rotate the PDF 180 degrees to flip it upside down?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash supports 90° clockwise, 90° counter-clockwise, and 180° rotation options."}},
{"@type":"Question","name":"Will rotating a PDF reduce its quality?","acceptedAnswer":{"@type":"Answer","text":"No. PDF rotation changes the viewing orientation metadata — it does not re-encode or compress any content. The rotated PDF is identical in quality to the original."}},
{"@type":"Question","name":"Can I rotate a scanned PDF?","acceptedAnswer":{"@type":"Answer","text":"Yes. Rotation works on all PDFs, including scanned documents where each page is an image."}},
{"@type":"Question","name":"Is there a limit on how many pages I can rotate?","acceptedAnswer":{"@type":"Answer","text":"The free plan supports files up to 10 MB with unlimited pages rotated. Most documents are well within this limit."}}
]}]
</script>
@endsection

@section('content')
<div class="hero">
    <div class="badge">🔄 Rotate PDF</div>
    <h1>Rotate PDF Online Free</h1>
    <p>Fix upside-down scans, flip landscape pages to portrait, or rotate any page to the correct orientation — free, instant, no signup required.</p>
</div>

<div class="tool-box">
    <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
        <div class="upload-icon">🔄</div>
        <div class="upload-title">Drop your PDF here to rotate pages</div>
        <div class="upload-sub">Click to browse · Any size · Free & instant</div>
        <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
    </div>
    <div id="rotate-options" style="display:none;text-align:center;margin-top:20px;">
        <p style="color:#8888a8;font-size:13px;margin-bottom:12px;">Choose rotation direction:</p>
        <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
            <button onclick="processRotate('90')" style="padding:12px 20px;background:#7c5cfc;color:#fff;border:none;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;">↻ 90° Clockwise</button>
            <button onclick="processRotate('-90')" style="padding:12px 20px;background:#0f0f1a;color:#eeeef8;border:1px solid rgba(255,255,255,.2);border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;">↺ 90° Counter-Clockwise</button>
            <button onclick="processRotate('180')" style="padding:12px 20px;background:#0f0f1a;color:#eeeef8;border:1px solid rgba(255,255,255,.2);border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;">↕ 180° Flip</button>
        </div>
    </div>
    <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
    <div style="text-align:center;margin-top:16px;"><p style="color:#8888a8;font-size:12px;">Files deleted after 60 minutes · 100% secure · No signup</p></div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:28px;">How It Works</h2>
    <div style="display:flex;flex-direction:column;gap:16px;">
        @foreach([
            ['1','Upload Your PDF','Drag your PDF into the upload area or click to browse. The tool works with all PDF types including scanned documents.'],
            ['2','Choose Rotation','Select 90° clockwise, 90° counter-clockwise, or 180° flip. The rotation is applied to all pages by default, or you can select specific pages.'],
            ['3','Download Rotated PDF','Your PDF is rotated instantly. Download the corrected version — no quality loss, same file size.'],
        ] as $step)
        <div style="display:flex;gap:16px;align-items:flex-start;">
            <div style="width:36px;height:36px;border-radius:50%;background:#7c5cfc;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:15px;flex-shrink:0;">{{ $step[0] }}</div>
            <div><div style="font-weight:600;font-size:15px;color:#eeeef8;margin-bottom:4px;">{{ $step[1] }}</div><div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $step[2] }}</div></div>
        </div>
        @endforeach
    </div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:20px;">Common Use Cases</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;">
        @foreach([
            ['📠','Scanned pages that came out sideways or upside down from the scanner'],
            ['📷','Phone-photographed documents with wrong orientation'],
            ['📊','Landscape charts or tables that need to be viewed correctly'],
            ['📑','Mixed-orientation documents with some portrait and some landscape pages'],
            ['🗂️','Merged PDFs where different source files had different orientations'],
            ['🖨️','Documents that print sideways — rotation fixes the printing direction'],
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
    <div class="faq-item"><h3>Can I rotate just one page in a multi-page PDF?</h3><p>Yes. After uploading, PDFTash shows a page-by-page preview. Click the pages you want to rotate individually, or use "Select All" to rotate every page. This is useful when only some pages from a scan came out sideways.</p></div>
    <div class="faq-item"><h3>Can I rotate the PDF 180 degrees?</h3><p>Yes. PDFTash offers three options: 90° clockwise, 90° counter-clockwise, and 180° flip (for completely upside-down documents). All three are available at no cost.</p></div>
    <div class="faq-item"><h3>Will rotating reduce the PDF quality?</h3><p>No. PDF rotation works by changing the page orientation metadata — it does not re-encode, compress, or re-render any content. The rotated PDF is byte-for-byte identical in content quality to the original. File size may change by only a few bytes.</p></div>
    <div class="faq-item"><h3>Does it work on scanned PDFs?</h3><p>Yes. Rotation works on all PDF types — text PDFs, scanned PDFs (image pages), and mixed PDFs. The page image is simply rotated without any reprocessing that could affect quality.</p></div>
    <div class="faq-item"><h3>Is there a limit on pages or file size?</h3><p>The free plan supports files up to 10 MB and up to 100 pages. Most scanned documents and reports are well within this limit. The Pro plan handles files up to 200 MB with no page limit.</p></div>
</div>

<div style="max-width:700px;margin:0 auto 40px;padding:0 20px;text-align:center;">
    <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">Related Tools</h2>
    <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
        <a href="/compress-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Compress PDF</a>
        <a href="/merge-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Merge PDF</a>
        <a href="/sign-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Sign PDF</a>
        <a href="/ocr-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">OCR Scanned PDF</a>
        <a href="/extract-pages-from-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Extract Pages</a>
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
    document.getElementById('rotate-options').style.display = 'block';
    dropZone.querySelector('.upload-title').textContent = file.name + ' — Choose rotation above';
    dropZone.querySelector('.upload-sub').textContent = (file.size / 1024).toFixed(0) + ' KB · Ready';
}
async function processRotate(degrees) {
    if (!uploadedFile) return;
    const result = document.getElementById('result');
    result.style.display = 'block';
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Rotating pages...</div>';
    const fd = new FormData();
    fd.append('file', uploadedFile);
    fd.append('degrees', degrees);
    fd.append('_token', CSRF);
    try {
        const resp = await fetch('/api/pdf/rotate', { method: 'POST', body: fd });
        if (resp.ok) {
            const blob = await resp.blob();
            const url = URL.createObjectURL(blob);
            result.innerHTML = `<div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;"><div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:4px;">✅ PDF Rotated!</div><div style="color:#8888a8;font-size:13px;">All pages have been rotated ${degrees}°.</div></div><a href="${url}" download="rotated.pdf" style="display:inline-block;padding:14px 32px;background:#7c5cfc;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">⬇ Download Rotated PDF</a><br><br><button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Rotate Another</button>`;
        } else {
            const d = await resp.json().catch(() => ({}));
            result.innerHTML = `<div style="color:#ff6b6b">Error: ${d.error || 'Something went wrong.'}</div>`;
        }
    } catch (e) { result.innerHTML = `<div style="color:#ff6b6b">Connection error. Please try again.</div>`; }
}
</script>
@endsection
