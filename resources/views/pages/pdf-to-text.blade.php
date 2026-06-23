@extends('tools.layout')
@section('title', 'PDF to Text Converter Free Online — Extract Text Instantly')
@section('description', 'Convert PDF to text online free — extract all text from any PDF instantly. Works for text PDFs and scanned documents (with OCR). No signup, no software download.')
@section('keywords', 'pdf to text, convert pdf to text online, extract text from pdf free, pdf text extractor')
@section('slug', 'pdf-to-text-online')

@section('schema')
<script type="application/ld+json">
[{"@context":"https://schema.org","@type":"SoftwareApplication","name":"PDFTash — PDF to Text Converter","applicationCategory":"WebApplication","operatingSystem":"Any","description":"Free online PDF to text converter. Extract all text from any PDF instantly — supports text PDFs and scanned documents via OCR.","url":"https://pdftash.com/pdf-to-text","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"aggregateRating":{"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"2089"}},
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
{"@type":"Question","name":"How accurate is PDF text extraction?","acceptedAnswer":{"@type":"Answer","text":"For text-based PDFs, accuracy is 99%+ — the text data is read directly from the PDF's content stream with no interpretation needed. For scanned PDFs, OCR accuracy is 97%+ on good-quality scans at 300 DPI or higher."}},
{"@type":"Question","name":"Does it work on scanned PDFs?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash automatically detects scanned PDFs and runs OCR before extraction. You don't need to run OCR separately — upload your scanned PDF and receive the extracted text directly."}},
{"@type":"Question","name":"Will the formatting (headers, columns, tables) be preserved in the text output?","acceptedAnswer":{"@type":"Answer","text":"The extracted text file preserves paragraph breaks and reading order, but not visual formatting like columns, headers, or tables. For table data, use the PDF to CSV tool instead. For preserving document structure, use the Translate or OCR tools which output a new PDF."}},
{"@type":"Question","name":"What languages are supported for scanned PDF text extraction?","acceptedAnswer":{"@type":"Answer","text":"Over 30 languages including English, Bengali, Hindi, Arabic, French, German, Spanish, Portuguese, Russian, Chinese, Japanese, and Korean."}},
{"@type":"Question","name":"Can I copy-paste the extracted text?","acceptedAnswer":{"@type":"Answer","text":"Yes. The extracted text is delivered as a plain .txt file or displayed directly in the browser for copying. You can paste it into Word, Google Docs, an email, or any other text editor."}}
]}]
</script>
@endsection

@section('content')
<div class="hero">
    <div class="badge">📝 PDF to Text</div>
    <h1>PDF to Text Converter — Free Online</h1>
    <p>Extract all text from any PDF instantly — supports text PDFs (instant, 99% accurate) and scanned PDFs (automatic OCR). No signup, no download, no watermark.</p>
</div>

<div class="tool-box">
    <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
        <div class="upload-icon">📄</div>
        <div class="upload-title">Drop your PDF here to extract text</div>
        <div class="upload-sub">Click to browse · Text PDF or scanned · Free & instant</div>
        <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
    </div>
    <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
    <div style="text-align:center;margin-top:16px;"><p style="color:#8888a8;font-size:12px;">Files deleted after 60 minutes · Scanned PDFs use OCR automatically · No signup</p></div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:28px;">How It Works</h2>
    <div style="display:flex;flex-direction:column;gap:16px;">
        @foreach([
            ['1','Upload Your PDF','Drag your PDF into the upload area or click to browse. Works with any PDF — text, scanned, or mixed pages.'],
            ['2','Automatic Text Extraction','PDFTash detects whether your PDF has a text layer (instant extraction) or is scanned (automatic OCR). No manual steps needed — just upload.'],
            ['3','Copy or Download Text','The extracted text appears in the browser for immediate copying, or download it as a .txt file. Paste into Word, Google Docs, or any application.'],
        ] as $step)
        <div style="display:flex;gap:16px;align-items:flex-start;">
            <div style="width:36px;height:36px;border-radius:50%;background:#7c5cfc;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:15px;flex-shrink:0;">{{ $step[0] }}</div>
            <div><div style="font-weight:600;font-size:15px;color:#eeeef8;margin-bottom:4px;">{{ $step[1] }}</div><div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $step[2] }}</div></div>
        </div>
        @endforeach
    </div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:20px;">Why Extract PDF Text?</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;">
        @foreach([
            ['📋','Copy content from PDFs that restrict text selection or copy-paste'],
            ['🔍','Full-text search and indexing in databases and knowledge management systems'],
            ['🤖','Feed document content to AI tools, summarisers, and text analysers'],
            ['✍️','Edit PDF content in Word or Google Docs by extracting first'],
            ['🌐','Prepare text for translation tools that require plain text input'],
            ['♿','Accessibility — convert PDFs to text for screen readers and assistive technology'],
        ] as $uc)
        <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:10px;padding:16px;">
            <div style="font-size:22px;margin-bottom:8px;">{{ $uc[0] }}</div>
            <div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $uc[1] }}</div>
        </div>
        @endforeach
    </div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:16px;">Text PDF vs Scanned PDF</h2>
    <table class="comparison-table">
        <thead>
            <tr><th>Feature</th><th>Text PDF</th><th>Scanned PDF</th></tr>
        </thead>
        <tbody>
            <tr><td>Text extraction speed</td><td style="color:#00e5a0;">Instant</td><td>5–30 sec (OCR)</td></tr>
            <tr><td>Accuracy</td><td style="color:#00e5a0;">99%+</td><td>95–99% (depends on scan quality)</td></tr>
            <tr><td>Can you select text?</td><td style="color:#00e5a0;">Yes</td><td style="color:#ff6b6b;">No (before OCR)</td></tr>
            <tr><td>Works with PDFTash?</td><td style="color:#00e5a0;">Yes — direct extraction</td><td style="color:#00e5a0;">Yes — auto OCR first</td></tr>
        </tbody>
    </table>
</div>

<div class="faq" style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:28px;">Frequently Asked Questions</h2>
    <div class="faq-item"><h3>How accurate is the text extraction?</h3><p>For text-based PDFs, accuracy is 99%+ because the text is read directly from the PDF's internal data without any interpretation. For scanned PDFs, OCR accuracy is 97%+ on good-quality scans (300 DPI or higher with clean, printed text). Handwritten text achieves 70–90% accuracy depending on legibility.</p></div>
    <div class="faq-item"><h3>Does it work on scanned PDFs?</h3><p>Yes. PDFTash automatically detects scanned PDFs and applies OCR before extraction. You don't need to run a separate OCR step — upload the scanned PDF and you'll receive the extracted text directly. For dedicated OCR with more language options, try the <a href="/ocr-pdf">OCR PDF tool</a>.</p></div>
    <div class="faq-item"><h3>Will headers, columns, and tables be preserved in the text output?</h3><p>The text output preserves paragraph breaks and reading order, but not visual layout like multi-column formatting or table grids. For table data specifically, use the <a href="/pdf-to-csv">PDF to CSV tool</a> which preserves rows and columns. For a document-structured output, use OCR which produces a new PDF with the text layer intact.</p></div>
    <div class="faq-item"><h3>What languages are supported?</h3><p>Over 30 languages including English, Bengali, Hindi, Arabic, French, German, Spanish, Portuguese, Russian, Chinese (Simplified and Traditional), Japanese, and Korean. Select the document language for best results on non-English content.</p></div>
    <div class="faq-item"><h3>Can I copy-paste the extracted text directly?</h3><p>Yes. Extracted text is shown in the browser in a selectable text area — click anywhere in it and use Ctrl+A, then Ctrl+C to copy all text. You can also download it as a .txt file for use in any application.</p></div>
</div>

<div style="max-width:700px;margin:0 auto 40px;padding:0 20px;text-align:center;">
    <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">Related Tools</h2>
    <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
        <a href="/ocr-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">OCR PDF</a>
        <a href="/extract-text-from-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Extract Text from PDF</a>
        <a href="/pdf-to-csv" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">PDF to CSV</a>
        <a href="/translate-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Translate PDF</a>
        <a href="/summarize-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Summarize PDF</a>
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
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Extracting text... (scanned PDFs use OCR automatically)</div>';
    const fd = new FormData();
    fd.append('file', file);
    fd.append('_token', CSRF);
    try {
        const resp = await fetch('/api/pdf/extract-text', { method: 'POST', body: fd });
        if (resp.ok) {
            const data = await resp.json();
            const text = data.text || '';
            const blob = new Blob([text], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            result.innerHTML = `<div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;text-align:left;"><div style="color:#00e5a0;font-size:16px;font-weight:700;margin-bottom:8px;">✅ Text Extracted!</div><textarea style="width:100%;height:200px;background:#060612;border:1px solid rgba(255,255,255,.1);border-radius:8px;color:#eeeef8;font-size:12px;padding:12px;box-sizing:border-box;resize:vertical;font-family:monospace;" readonly>${text.replace(/</g,'&lt;').replace(/>/g,'&gt;')}</textarea></div><a href="${url}" download="extracted-text.txt" style="display:inline-block;padding:14px 32px;background:#7c5cfc;color:#fff;border-radius:99px;text-decoration:none;font-weight:600;margin-right:10px">⬇ Download .txt</a><button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:14px 20px;border-radius:99px;cursor:pointer;font-size:14px">Extract Another</button>`;
        } else {
            const d = await resp.json().catch(() => ({}));
            result.innerHTML = `<div style="color:#ff6b6b">Error: ${d.error || 'Something went wrong.'}</div>`;
        }
    } catch (e) { result.innerHTML = `<div style="color:#ff6b6b">Connection error. Please try again.</div>`; }
}
</script>
@endsection
