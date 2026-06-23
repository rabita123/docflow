@extends('tools.layout')
@section('title', 'Compress PDF Free Online — Reduce PDF Size Instantly, No Signup')
@section('description', 'Compress PDF online for free — reduce file size by up to 90% instantly. No signup, no watermark, no software needed. Free up to 10 MB. Powered by Ghostscript.')
@section('keywords', 'compress pdf free, compress pdf online free, reduce pdf size free, pdf compressor free')
@section('slug', 'compress-pdf-free')

@section('schema')
<script type="application/ld+json">
[{"@context":"https://schema.org","@type":"SoftwareApplication","name":"PDFTash — Compress PDF Free","applicationCategory":"WebApplication","operatingSystem":"Any","description":"Free online PDF compressor. Reduce PDF file size by up to 90% using Ghostscript. No signup, no watermark, files up to 10 MB on the free plan.","url":"https://pdftash.com/compress-pdf-free","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"aggregateRating":{"@type":"AggregateRating","ratingValue":"4.9","reviewCount":"4213"}},
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
{"@type":"Question","name":"How much can I reduce my PDF size for free?","acceptedAnswer":{"@type":"Answer","text":"Scanned PDFs typically reduce 60–90%. Image-heavy PDFs reduce 40–70%. Text-only PDFs reduce 20–40%. There is no limit on how many files you can compress on the free plan."}},
{"@type":"Question","name":"Does compressing a PDF reduce quality?","acceptedAnswer":{"@type":"Answer","text":"Text is never affected — it remains vector-sharp at any zoom. Images are re-encoded at high quality (85–90%), which is visually indistinguishable from the original at normal viewing sizes."}},
{"@type":"Question","name":"Is there a file size limit?","acceptedAnswer":{"@type":"Answer","text":"The free plan supports files up to 10 MB. The Pro plan handles files up to 200 MB."}},
{"@type":"Question","name":"Can I compress a PDF to a specific size like 200 KB or 1 MB?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash offers size-targeted compression at /compress-pdf-to-200kb and /compress-pdf-to-1mb for specific upload limits."}},
{"@type":"Question","name":"Does PDFTash add a watermark to compressed PDFs?","acceptedAnswer":{"@type":"Answer","text":"No. PDFTash never adds watermarks on any plan. Your compressed PDF is clean and professional with no tool branding."}}
]}]
</script>
@endsection

@section('content')
<div class="hero">
    <div class="badge">🗜️ Free PDF Compressor</div>
    <h1>Compress PDF Free Online</h1>
    <p>Reduce PDF file size by up to 90% — free, instant, no signup required. Powered by Ghostscript, the same engine used by Adobe. No watermark, ever.</p>
</div>

<div class="tool-box">
    <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
        <div class="upload-icon">📄</div>
        <div class="upload-title">Drop your PDF here to compress it — free</div>
        <div class="upload-sub">Click to browse · Up to 10 MB · No signup needed</div>
        <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
    </div>
    <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
    <div style="text-align:center;margin-top:16px;"><p style="color:#8888a8;font-size:12px;">Files deleted after 60 minutes · No watermark added · 100% secure</p></div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:28px;">How It Works</h2>
    <div style="display:flex;flex-direction:column;gap:16px;">
        @foreach([
            ['1','Upload Your PDF','Drag your PDF into the upload area or click to browse. Supports all PDF types — text, scanned, image-heavy, and mixed. Free up to 10 MB.'],
            ['2','Automatic Compression','PDFTash uses Ghostscript to intelligently downsample images, remove redundant data streams, subset fonts, and strip metadata — all without touching your text content.'],
            ['3','Download Smaller PDF','Your compressed PDF is ready in seconds. You\'ll see the before and after file sizes so you know exactly how much was saved. Download with one click.'],
        ] as $step)
        <div style="display:flex;gap:16px;align-items:flex-start;">
            <div style="width:36px;height:36px;border-radius:50%;background:#7c5cfc;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:15px;flex-shrink:0;">{{ $step[0] }}</div>
            <div><div style="font-weight:600;font-size:15px;color:#eeeef8;margin-bottom:4px;">{{ $step[1] }}</div><div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $step[2] }}</div></div>
        </div>
        @endforeach
    </div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:16px;">Typical Compression Results</h2>
    <p style="text-align:center;color:#8888a8;font-size:13px;margin-bottom:20px;">Results based on real-world documents processed by PDFTash:</p>
    <table class="comparison-table">
        <thead>
            <tr>
                <th>Document Type</th>
                <th>Typical Size</th>
                <th>After Compression</th>
                <th>Reduction</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Scanned document (10 pages)</td>
                <td>~50 MB</td>
                <td>3–8 MB</td>
                <td><strong style="color:#00e5a0;">85–94%</strong></td>
            </tr>
            <tr>
                <td>Image-heavy presentation</td>
                <td>~20 MB</td>
                <td>4–8 MB</td>
                <td><strong style="color:#00e5a0;">60–80%</strong></td>
            </tr>
            <tr>
                <td>CV / Resume</td>
                <td>~3 MB</td>
                <td>0.5–1.5 MB</td>
                <td><strong style="color:#00e5a0;">50–83%</strong></td>
            </tr>
            <tr>
                <td>Text report / Contract</td>
                <td>~2 MB</td>
                <td>0.8–1.5 MB</td>
                <td><strong style="color:#00e5a0;">25–40%</strong></td>
            </tr>
            <tr>
                <td>Mixed (text + images)</td>
                <td>~8 MB</td>
                <td>2–4 MB</td>
                <td><strong style="color:#00e5a0;">50–70%</strong></td>
            </tr>
        </tbody>
    </table>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:16px;">Need a Specific File Size?</h2>
    <p style="text-align:center;color:#8888a8;margin-bottom:20px;">For common upload limits, use these targeted compression tools:</p>
    <div style="display:flex;gap:12px;flex-wrap:wrap;justify-content:center;">
        <a href="/compress-pdf-to-200kb" style="display:flex;flex-direction:column;align-items:center;padding:20px 28px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:12px;text-decoration:none;color:#eeeef8;min-width:140px;" onmouseover="this.style.borderColor='#7c5cfc'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">
            <span style="font-size:28px;margin-bottom:8px;">📦</span>
            <span style="font-weight:700;font-size:16px;color:#7c5cfc;">200 KB</span>
            <span style="font-size:12px;color:#8888a8;margin-top:4px;">Government portals</span>
        </a>
        <a href="/compress-pdf-to-1mb" style="display:flex;flex-direction:column;align-items:center;padding:20px 28px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:12px;text-decoration:none;color:#eeeef8;min-width:140px;" onmouseover="this.style.borderColor='#7c5cfc'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">
            <span style="font-size:28px;margin-bottom:8px;">💼</span>
            <span style="font-weight:700;font-size:16px;color:#7c5cfc;">1 MB</span>
            <span style="font-size:12px;color:#8888a8;margin-top:4px;">Job applications</span>
        </a>
        <a href="/compress-pdf-for-email" style="display:flex;flex-direction:column;align-items:center;padding:20px 28px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:12px;text-decoration:none;color:#eeeef8;min-width:140px;" onmouseover="this.style.borderColor='#7c5cfc'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">
            <span style="font-size:28px;margin-bottom:8px;">📧</span>
            <span style="font-weight:700;font-size:16px;color:#7c5cfc;">For Email</span>
            <span style="font-size:12px;color:#8888a8;margin-top:4px;">Under 25 MB</span>
        </a>
        <a href="/reduce-pdf-size-for-whatsapp" style="display:flex;flex-direction:column;align-items:center;padding:20px 28px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:12px;text-decoration:none;color:#eeeef8;min-width:140px;" onmouseover="this.style.borderColor='#7c5cfc'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">
            <span style="font-size:28px;margin-bottom:8px;">📱</span>
            <span style="font-weight:700;font-size:16px;color:#7c5cfc;">WhatsApp</span>
            <span style="font-size:12px;color:#8888a8;margin-top:4px;">Fast mobile send</span>
        </a>
    </div>
</div>

<div class="faq" style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:28px;">Frequently Asked Questions</h2>
    <div class="faq-item"><h3>How much can I reduce my PDF file size for free?</h3><p>It depends on content. Scanned PDFs typically reduce 60–90% — a 50 MB scanned contract can come down to 4–6 MB. Image-heavy presentations reduce 40–70%. Text-only documents (CVs, reports) reduce 20–40% since they're already compact. The free plan has no limit on the number of files you can compress.</p></div>
    <div class="faq-item"><h3>Does compressing reduce the visual quality of my PDF?</h3><p>Text is vector data and remains perfectly sharp at any zoom level — zero quality change. Images are re-encoded at 85–90% quality, which is visually identical to the original at normal viewing and print sizes. Only if you zoom in past 200% might you notice minor softening on photographs.</p></div>
    <div class="faq-item"><h3>Is there a file size limit on the free plan?</h3><p>The free plan supports files up to 10 MB. If your PDF is larger — such as a lengthy scanned report or a high-resolution product catalogue — the Pro plan ($9/month) handles files up to 200 MB. For very large files, try compressing in sections using the Split tool first.</p></div>
    <div class="faq-item"><h3>Can I compress to a specific target size like 200 KB or 1 MB?</h3><p>Yes. PDFTash offers dedicated size-targeted tools: <a href="/compress-pdf-to-200kb">Compress to 200 KB</a> for government portal uploads, and <a href="/compress-pdf-to-1mb">Compress to 1 MB</a> for job application portals. These use adaptive compression to meet the target while maintaining maximum possible quality.</p></div>
    <div class="faq-item"><h3>Does PDFTash add a watermark to compressed PDFs?</h3><p>No. PDFTash never adds its own branding or watermarks to any output file on any plan. Your compressed PDF is completely clean — it looks like it was processed by professional desktop software.</p></div>
</div>

<div style="max-width:700px;margin:0 auto 40px;padding:0 20px;text-align:center;">
    <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">Related Tools</h2>
    <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
        <a href="/compress-pdf-to-200kb" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Compress to 200KB</a>
        <a href="/compress-pdf-to-1mb" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Compress to 1MB</a>
        <a href="/compress-pdf-for-email" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Compress for Email</a>
        <a href="/compress-scanned-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Compress Scanned PDF</a>
        <a href="/compress-pdf-without-losing-quality" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Compress Without Quality Loss</a>
    </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = '#7c5cfc'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', (e) => { e.preventDefault(); const f = e.dataTransfer.files[0]; if (f?.type === 'application/pdf') processFile(f); });
function handleFile(input) { if (input.files[0]) processFile(input.files[0]); }
async function processFile(file) {
    const result = document.getElementById('result');
    result.style.display = 'block';
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Compressing your PDF...</div>';
    const fd = new FormData();
    fd.append('file', file);
    fd.append('_token', CSRF);
    try {
        const resp = await fetch('/api/pdf/compress', { method: 'POST', body: fd });
        if (resp.ok) {
            const blob = await resp.blob();
            const url = URL.createObjectURL(blob);
            const saved = (((file.size - blob.size) / file.size) * 100).toFixed(0);
            const sizeKB = (blob.size / 1024).toFixed(0);
            const origKB = (file.size / 1024).toFixed(0);
            result.innerHTML = `<div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;"><div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:8px">✅ Compressed Successfully!</div><div style="color:#8888a8;font-size:14px">${origKB} KB → <strong style="color:#eeeef8">${sizeKB} KB</strong> <span style="color:#00e5a0;font-weight:600">(${saved}% smaller)</span></div></div><a href="${url}" download="compressed.pdf" style="display:inline-block;padding:14px 32px;background:#7c5cfc;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">⬇ Download Compressed PDF</a><br><br><button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Compress Another</button>`;
        } else {
            const d = await resp.json().catch(() => ({}));
            result.innerHTML = `<div style="color:#ff6b6b">Error: ${d.error || 'Something went wrong.'}</div>`;
        }
    } catch (e) { result.innerHTML = `<div style="color:#ff6b6b">Connection error. Please try again.</div>`; }
}
</script>
@endsection
