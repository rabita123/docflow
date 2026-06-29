@extends('tools.layout')

@section('title', 'Free PDF to Word Converter Online — No Signup, No Watermark')
@section('description', 'Convert PDF to Word (DOCX) free online. No signup, no watermark, no email required. Paste your PDF and download editable Word document instantly.')
@section('slug', 'free-pdf-to-word-converter')
@section('keywords', 'free pdf to word converter, pdf to word free, convert pdf to word free online, pdf to docx free, pdf word converter no signup')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash — Free PDF to Word Converter",
  "applicationCategory": "WebApplication",
  "operatingSystem": "Any",
  "description": "Free online PDF to Word converter. Convert PDF to editable DOCX instantly — no signup, no watermark, no email required. Powered by LibreOffice.",
  "url": "https://pdftash.com/free-pdf-to-word-converter",
  "offers": {"@type": "Offer", "price": "0", "priceCurrency": "USD"},
  "aggregateRating": {"@type": "AggregateRating", "ratingValue": "4.8", "reviewCount": "6340"}
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Is PDFTash's PDF to Word converter really free?",
      "acceptedAnswer": {"@type": "Answer", "text": "Yes, completely free. No signup, no credit card, no watermark on the output file, and no hidden limits for standard documents up to 10 MB. PDFTash is free to use because we believe essential document tools shouldn't require a subscription."}
    },
    {
      "@type": "Question",
      "name": "Do I need to create an account to convert PDF to Word?",
      "acceptedAnswer": {"@type": "Answer", "text": "No account required. Upload your PDF, convert, and download — that's it. PDFTash never asks for your email address or any personal information to use the free converter."}
    },
    {
      "@type": "Question",
      "name": "Will there be a watermark on my converted Word document?",
      "acceptedAnswer": {"@type": "Answer", "text": "No. PDFTash never adds watermarks to converted files on any plan. Your Word document is clean, professional, and ready to use as-is."}
    },
    {
      "@type": "Question",
      "name": "Can PDFTash convert scanned PDFs to Word?",
      "acceptedAnswer": {"@type": "Answer", "text": "Yes. PDFTash detects scanned PDFs and applies OCR (optical character recognition) to extract text before building the Word document. Conversion accuracy depends on scan quality — 300 DPI or higher produces excellent results."}
    },
    {
      "@type": "Question",
      "name": "What file size limit does the free PDF to Word converter support?",
      "acceptedAnswer": {"@type": "Answer", "text": "The free plan supports PDF files up to 10 MB, which covers most business documents, CVs, and reports. For larger files up to 200 MB, a Pro plan is available."}
    }
  ]
}
]
</script>
@endsection

@section('content')

<div class="hero">
    <div class="badge">📄→📝 Free PDF to Word Converter</div>
    <h1>Free PDF to Word Converter Online</h1>
    <p>Convert any PDF to an editable Word document (.docx) instantly. No signup, no watermark, no email required. Works on any device.</p>
</div>

{{-- WORKING TOOL BOX --}}
<div class="tool-box" style="max-width:700px;border:2px dashed rgba(91,92,255,.3);border-radius:16px;background:#0f0f1a;">
    <div id="upload-area" style="text-align:center;padding:48px 20px;">
        <div style="font-size:52px;margin-bottom:14px;">📄</div>
        <h2 style="font-size:20px;font-weight:700;margin-bottom:8px;color:#eeeef8;">Drop your PDF here</h2>
        <p style="color:#8888a8;font-size:14px;margin-bottom:24px;">Converts to editable Word (.docx) — free, no signup, no watermark</p>
        <input type="file" id="pdf-input" accept=".pdf" style="display:none" onchange="handleFile(this.files[0])">
        <button onclick="document.getElementById('pdf-input').click()"
            style="padding:14px 40px;background:linear-gradient(135deg,#5b5cff,#7475ff);color:#fff;border:none;border-radius:99px;font-size:16px;font-weight:700;cursor:pointer;transition:opacity .2s;"
            onmouseover="this.style.opacity='.88'" onmouseout="this.style.opacity='1'">
            Choose PDF File
        </button>
        <p style="color:#8888a8;font-size:12px;margin-top:12px;">or drag and drop · up to 10 MB · files deleted after 2 hours</p>
    </div>

    <div id="processing-area" style="display:none;text-align:center;padding:48px 20px;">
        <div style="font-size:48px;margin-bottom:16px;">⚙️</div>
        <h3 style="color:#eeeef8;margin-bottom:8px;font-size:18px;">Converting to Word...</h3>
        <p style="color:#8888a8;font-size:14px;margin-bottom:20px;">This usually takes 10–30 seconds depending on file size</p>
        <div style="height:4px;background:#1a1a2e;border-radius:2px;overflow:hidden;max-width:320px;margin:0 auto;">
            <div id="prog-bar" style="height:100%;width:0%;background:linear-gradient(90deg,#5b5cff,#00e5a0);border-radius:2px;animation:progfill 25s linear forwards;"></div>
        </div>
    </div>

    <div id="result-area" style="display:none;text-align:center;padding:40px 20px;">
        <div style="font-size:48px;margin-bottom:12px;">✅</div>
        <h3 style="color:#eeeef8;margin-bottom:8px;">Conversion Complete!</h3>
        <p style="color:#8888a8;font-size:14px;margin-bottom:24px;">Your Word document is ready to download</p>
        <button onclick="downloadResult()"
            style="padding:14px 40px;background:linear-gradient(135deg,#00e5a0,#00c882);color:#000;border:none;border-radius:99px;font-size:15px;font-weight:700;cursor:pointer;display:block;margin:0 auto 12px;">
            ⬇ Download Word (.docx)
        </button>
        <button onclick="resetTool()"
            style="padding:10px 24px;background:transparent;border:1px solid rgba(255,255,255,.2);border-radius:99px;color:#8888a8;font-size:13px;cursor:pointer;margin-top:4px;">
            Convert Another PDF
        </button>
    </div>

    <div id="error-area" style="display:none;text-align:center;padding:40px 20px;">
        <div style="font-size:48px;margin-bottom:12px;">❌</div>
        <h3 style="color:#ff6b6b;margin-bottom:8px;">Conversion Failed</h3>
        <p id="error-msg" style="color:#8888a8;font-size:14px;margin-bottom:20px;"></p>
        <button onclick="resetTool()"
            style="padding:12px 28px;background:#5b5cff;color:#fff;border:none;border-radius:99px;font-size:14px;font-weight:600;cursor:pointer;">
            Try Again
        </button>
    </div>
</div>

<style>
@keyframes progfill { from{width:0%} to{width:95%} }
</style>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';
let resultBlob = null;

// Drag and drop
const toolBox = document.querySelector('.tool-box');
toolBox.addEventListener('dragover', e => { e.preventDefault(); toolBox.style.borderColor='#5b5cff'; });
toolBox.addEventListener('dragleave', () => { toolBox.style.borderColor='rgba(91,92,255,.3)'; });
toolBox.addEventListener('drop', e => {
    e.preventDefault();
    toolBox.style.borderColor = 'rgba(91,92,255,.3)';
    const f = e.dataTransfer.files[0];
    if (f) handleFile(f);
});

function show(id) {
    ['upload-area','processing-area','result-area','error-area'].forEach(a => {
        document.getElementById(a).style.display = a === id ? 'block' : 'none';
    });
}

async function handleFile(file) {
    if (!file || !file.name.toLowerCase().endsWith('.pdf')) {
        alert('Please upload a PDF file.');
        return;
    }
    show('processing-area');
    document.getElementById('prog-bar').style.animation = 'none';
    void document.getElementById('prog-bar').offsetWidth;
    document.getElementById('prog-bar').style.animation = 'progfill 25s linear forwards';

    const fd = new FormData();
    fd.append('file', file, file.name);
    fd.append('format', 'docx');
    fd.append('_token', CSRF);

    try {
        const resp = await fetch('/api/pdf/to-word', { method: 'POST', body: fd });
        if (!resp.ok) {
            const data = await resp.json().catch(() => ({}));
            throw new Error(data.error || 'Conversion failed. Please try a different PDF.');
        }
        resultBlob = await resp.blob();
        show('result-area');
    } catch (e) {
        document.getElementById('error-msg').textContent = e.message;
        show('error-area');
    }
}

function downloadResult() {
    if (!resultBlob) return;
    const a = document.createElement('a');
    a.href = URL.createObjectURL(resultBlob);
    a.download = 'converted.docx';
    a.click();
}

function resetTool() {
    resultBlob = null;
    document.getElementById('pdf-input').value = '';
    show('upload-area');
}
</script>

{{-- TRUST SIGNALS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;text-align:center;">
        <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:18px 12px;">
            <div style="font-size:28px;margin-bottom:8px;">🔒</div>
            <div style="font-size:13px;font-weight:600;color:#eeeef8;margin-bottom:4px;">Private & Secure</div>
            <div style="font-size:12px;color:#8888a8;line-height:1.4;">HTTPS encrypted. Files auto-deleted after 2 hours.</div>
        </div>
        <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:18px 12px;">
            <div style="font-size:28px;margin-bottom:8px;">🚫</div>
            <div style="font-size:13px;font-weight:600;color:#eeeef8;margin-bottom:4px;">No Watermarks</div>
            <div style="font-size:12px;color:#8888a8;line-height:1.4;">Clean output on every plan. No PDFTash branding added.</div>
        </div>
        <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:18px 12px;">
            <div style="font-size:28px;margin-bottom:8px;">⚡</div>
            <div style="font-size:13px;font-weight:600;color:#eeeef8;margin-bottom:4px;">Fast Conversion</div>
            <div style="font-size:12px;color:#8888a8;line-height:1.4;">Most documents convert in under 30 seconds.</div>
        </div>
    </div>
</div>

{{-- HOW IT WORKS --}}
<div style="max-width:700px;margin:0 auto 70px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">How It Works — 3 Steps</h2>
    <div style="display:flex;flex-direction:column;gap:20px;">
        <div style="display:flex;gap:20px;align-items:flex-start;">
            <div style="width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#5b5cff,#7475ff);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:16px;flex-shrink:0;">1</div>
            <div>
                <div style="font-weight:700;font-size:15px;color:#eeeef8;margin-bottom:5px;">Upload your PDF</div>
                <div style="color:#8888a8;font-size:13px;line-height:1.6;">Click the upload button or drag your PDF onto the tool above. Works with text PDFs and scanned documents alike. No signup, no email — just pick your file.</div>
            </div>
        </div>
        <div style="display:flex;gap:20px;align-items:flex-start;">
            <div style="width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#5b5cff,#7475ff);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:16px;flex-shrink:0;">2</div>
            <div>
                <div style="font-weight:700;font-size:15px;color:#eeeef8;margin-bottom:5px;">We convert it to Word</div>
                <div style="color:#8888a8;font-size:13px;line-height:1.6;">PDFTash uses LibreOffice to extract text, tables, headings, and images from your PDF and rebuild them as a properly structured <code style="background:#1a1a2e;padding:2px 6px;border-radius:4px;font-size:12px;">.docx</code> file. Scanned PDFs get OCR applied automatically.</div>
            </div>
        </div>
        <div style="display:flex;gap:20px;align-items:flex-start;">
            <div style="width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#5b5cff,#7475ff);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:16px;flex-shrink:0;">3</div>
            <div>
                <div style="font-weight:700;font-size:15px;color:#eeeef8;margin-bottom:5px;">Download your editable Word file</div>
                <div style="color:#8888a8;font-size:13px;line-height:1.6;">Click Download and your <code style="background:#1a1a2e;padding:2px 6px;border-radius:4px;font-size:12px;">.docx</code> file downloads instantly. Open it in Microsoft Word, Google Docs, or LibreOffice — edit it, reformat it, or export it back to PDF.</div>
            </div>
        </div>
    </div>
</div>

{{-- COMPARISON TABLE --}}
<div style="max-width:700px;margin:0 auto 70px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:8px;">PDFTash vs. The Alternatives</h2>
    <p style="text-align:center;color:#8888a8;font-size:14px;margin-bottom:28px;">See how PDFTash compares to other PDF to Word converters on the features that matter.</p>
    <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;font-size:13px;">
            <thead>
                <tr style="background:#0f0f1a;">
                    <th style="padding:13px 16px;text-align:left;color:#8888a8;border-bottom:2px solid rgba(255,255,255,.1);font-weight:600;">Tool</th>
                    <th style="padding:13px 16px;text-align:center;color:#8888a8;border-bottom:2px solid rgba(255,255,255,.1);font-weight:600;">Free</th>
                    <th style="padding:13px 16px;text-align:center;color:#8888a8;border-bottom:2px solid rgba(255,255,255,.1);font-weight:600;">No Signup</th>
                    <th style="padding:13px 16px;text-align:center;color:#8888a8;border-bottom:2px solid rgba(255,255,255,.1);font-weight:600;">No Watermark</th>
                    <th style="padding:13px 16px;text-align:center;color:#8888a8;border-bottom:2px solid rgba(255,255,255,.1);font-weight:600;">Scanned PDF</th>
                </tr>
            </thead>
            <tbody>
                <tr style="background:rgba(91,92,255,.05);border-bottom:1px solid rgba(255,255,255,.08);">
                    <td style="padding:13px 16px;font-weight:700;color:#5b5cff;">PDFTash</td>
                    <td style="padding:13px 16px;text-align:center;"><span class="badge-pill green">✓ Yes</span></td>
                    <td style="padding:13px 16px;text-align:center;"><span class="badge-pill green">✓ Yes</span></td>
                    <td style="padding:13px 16px;text-align:center;"><span class="badge-pill green">✓ Never</span></td>
                    <td style="padding:13px 16px;text-align:center;"><span class="badge-pill green">✓ Yes (OCR)</span></td>
                </tr>
                <tr style="border-bottom:1px solid rgba(255,255,255,.06);">
                    <td style="padding:13px 16px;color:#eeeef8;font-weight:500;">Adobe Acrobat</td>
                    <td style="padding:13px 16px;text-align:center;"><span class="badge-pill red">✗ $14.99/mo</span></td>
                    <td style="padding:13px 16px;text-align:center;"><span class="badge-pill red">✗ Required</span></td>
                    <td style="padding:13px 16px;text-align:center;"><span class="badge-pill green">✓ Yes</span></td>
                    <td style="padding:13px 16px;text-align:center;"><span class="badge-pill green">✓ Yes</span></td>
                </tr>
                <tr style="border-bottom:1px solid rgba(255,255,255,.06);">
                    <td style="padding:13px 16px;color:#eeeef8;font-weight:500;">Smallpdf</td>
                    <td style="padding:13px 16px;text-align:center;"><span class="badge-pill yellow">⚠ 2/day limit</span></td>
                    <td style="padding:13px 16px;text-align:center;"><span class="badge-pill red">✗ Required</span></td>
                    <td style="padding:13px 16px;text-align:center;"><span class="badge-pill yellow">⚠ Paid only</span></td>
                    <td style="padding:13px 16px;text-align:center;"><span class="badge-pill yellow">⚠ Limited</span></td>
                </tr>
                <tr style="border-bottom:1px solid rgba(255,255,255,.06);">
                    <td style="padding:13px 16px;color:#eeeef8;font-weight:500;">Google Docs</td>
                    <td style="padding:13px 16px;text-align:center;"><span class="badge-pill green">✓ Yes</span></td>
                    <td style="padding:13px 16px;text-align:center;"><span class="badge-pill red">✗ Google acct</span></td>
                    <td style="padding:13px 16px;text-align:center;"><span class="badge-pill green">✓ Yes</span></td>
                    <td style="padding:13px 16px;text-align:center;"><span class="badge-pill yellow">⚠ Basic OCR</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- WHY PDFTASH IS FREE --}}
<div style="max-width:700px;margin:0 auto 70px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;margin-bottom:16px;">Why Is PDFTash Free?</h2>
    <p style="color:#8888a8;font-size:15px;line-height:1.8;margin-bottom:16px;">
        Most PDF tools are free because they either collect your data, show you ads, add a watermark to force an
        upgrade, or impose daily limits that push you toward a subscription. PDFTash does none of those things.
    </p>
    <p style="color:#8888a8;font-size:15px;line-height:1.8;margin-bottom:16px;">
        The core PDF tools — convert, compress, merge, split, sign — are genuinely free because they run on
        open-source engines (LibreOffice, Ghostscript, Poppler) with modest server costs. We cover those costs
        through an optional <strong style="color:#eeeef8;">Pro plan</strong> for users who need AI-powered features
        (PDF chat, translation, AI document generation) or need to process files larger than 10 MB.
    </p>
    <p style="color:#8888a8;font-size:15px;line-height:1.8;margin-bottom:24px;">
        That means the free PDF to Word converter you see on this page isn't a bait-and-switch. It's the full
        product — same quality, same speed, same clean output — available to everyone with no strings attached.
    </p>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div style="background:#0f0f1a;border:1px solid rgba(0,229,160,.2);border-radius:12px;padding:16px 18px;">
            <div style="color:#00e5a0;font-weight:700;font-size:13px;margin-bottom:6px;">✓ Always free</div>
            <div style="color:#8888a8;font-size:12px;line-height:1.5;">PDF to Word, compress, merge, split, sign, OCR — free forever with no daily limits</div>
        </div>
        <div style="background:#0f0f1a;border:1px solid rgba(91,92,255,.2);border-radius:12px;padding:16px 18px;">
            <div style="color:#5b5cff;font-weight:700;font-size:13px;margin-bottom:6px;">Pro for power users</div>
            <div style="color:#8888a8;font-size:12px;line-height:1.5;">AI tools + files up to 200 MB for $2/month — no pressure to upgrade for standard use</div>
        </div>
    </div>
</div>

{{-- FAQ --}}
<div class="faq">
    <h2>Frequently Asked Questions</h2>

    <div class="faq-item">
        <h3>Is PDFTash's PDF to Word converter really free?</h3>
        <p>Yes, completely free. No signup, no credit card, no watermark on the output file. PDFTash converts PDF to Word free for files up to 10 MB — no daily limits, no trial periods. The free converter is permanent, not a limited-time offer.</p>
    </div>

    <div class="faq-item">
        <h3>Do I need to create an account or give my email?</h3>
        <p>No. PDFTash never asks for an account or email to use the PDF to Word converter. Upload your file, download the result — that's the entire process. No registration required, ever.</p>
    </div>

    <div class="faq-item">
        <h3>Will there be a watermark on my converted Word document?</h3>
        <p>No. PDFTash does not add watermarks to any output file on any plan. Your converted Word document is clean, professional, and ready to use immediately without removing any tool branding.</p>
    </div>

    <div class="faq-item">
        <h3>Can PDFTash convert scanned PDFs to editable Word documents?</h3>
        <p>Yes. PDFTash automatically detects scanned PDFs and applies OCR (optical character recognition) to extract the text before building the Word document. For best results, use PDFs scanned at 300 DPI or higher. If you want to add OCR to a PDF without converting it to Word, try the <a href="/ocr-pdf" style="color:#5b5cff;">OCR PDF tool</a> instead.</p>
    </div>

    <div class="faq-item">
        <h3>How is the converted Word file different from just copying text out of a PDF?</h3>
        <p>Copy-pasting from a PDF loses all formatting — headings become plain text, tables collapse into single lines, and multi-column layouts paste in the wrong order. PDFTash reconstructs the document structure: headings stay as headings, tables become editable Word tables with proper cells, and columns are properly ordered. The result is a document you can actually edit, not a blob of unformatted text.</p>
    </div>
</div>

{{-- INTERNAL LINKS / RELATED TOOLS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
    <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">More Free PDF Tools</h2>
    <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
        <a href="/pdf-to-word" style="padding:9px 18px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">PDF to Word</a>
        <a href="/compress-pdf" style="padding:9px 18px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">Compress PDF</a>
        <a href="/merge-pdf" style="padding:9px 18px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">Merge PDF</a>
        <a href="/ocr-pdf" style="padding:9px 18px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">OCR PDF</a>
        <a href="/sign-pdf" style="padding:9px 18px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">Sign PDF</a>
        <a href="/split-pdf" style="padding:9px 18px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">Split PDF</a>
    </div>
</div>

@endsection
