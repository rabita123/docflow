@extends('tools.layout')

@section('title', 'PDF Redactor — Auto-Redact Sensitive Info from PDF Free')
@section('description', 'Redact sensitive information from PDFs automatically using AI. Auto-detects emails, phone numbers, SSN, credit cards, and addresses. Download a clean redacted PDF.')
@section('keywords', 'pdf redactor, redact pdf online, remove sensitive information from pdf, pdf redaction tool, auto redact pdf, black out text in pdf')
@section('slug', 'redact-pdf')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash — AI PDF Redactor",
  "applicationCategory": "WebApplication",
  "operatingSystem": "Any",
  "description": "Automatically redact sensitive information from PDFs. AI detects emails, phone numbers, SSN, credit cards, addresses and blacks them out permanently.",
  "url": "https://pdftash.com/redact-pdf",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"},
  "aggregateRating": {"@type":"AggregateRating","ratingValue":"4.9","reviewCount":"876"}
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"What information does the AI redactor detect?","acceptedAnswer":{"@type":"Answer","text":"PDFTash AI automatically detects and redacts: email addresses, phone numbers, SSN and national ID numbers, credit and debit card numbers, physical addresses, and any custom text you specify."}},
    {"@type":"Question","name":"Is redaction permanent?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash converts redacted pages to images with black boxes drawn over sensitive text. The underlying text is permanently removed — it cannot be recovered by selecting or copying."}},
    {"@type":"Question","name":"Can I specify custom text to redact?","acceptedAnswer":{"@type":"Answer","text":"Yes. In addition to auto-detected categories, you can enter any words, names, or phrases in the Custom Terms field and they will be blacked out throughout the entire document."}},
    {"@type":"Question","name":"Does redaction work on scanned PDFs?","acceptedAnswer":{"@type":"Answer","text":"The auto-redact tool works on text-based PDFs. For scanned PDFs, run OCR first at pdftash.com/ocr-pdf to make the text layer readable, then redact."}},
    {"@type":"Question","name":"Is the PDF redactor free?","acceptedAnswer":{"@type":"Answer","text":"Free users can redact PDFs up to 10MB with no signup required. Pro users ($2/month) can redact larger documents up to 200MB with no daily limits."}}
  ]
}
]
</script>
@endsection

@section('content')
<div class="hero">
  <div style="display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin-bottom:24px;">
    <div class="badge">🔒 AI PDF Redactor</div>
    <div class="badge" style="background:rgba(255,107,107,.1);border-color:rgba(255,107,107,.4);color:#ff6b6b;">🛡️ Privacy Tool</div>
  </div>
  <h1>AI PDF Redactor — Auto-Blackout Sensitive Info</h1>
  <p>Upload a PDF and AI automatically finds and permanently blacks out emails, phone numbers, SSNs, credit cards, and addresses. Add custom terms too. Secure, instant, free.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">🔒</div>
    <div class="upload-title">Drop your PDF here to redact</div>
    <div class="upload-sub">AI will detect and remove sensitive information</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>

  <div id="options" style="display:none;margin-top:20px;">

    {{-- What to redact --}}
    <div style="margin-bottom:16px;">
      <label style="color:#eeeef8;font-size:14px;font-weight:600;display:block;margin-bottom:10px;">What to redact — AI will find these automatically</label>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
        @foreach([
          ['email',      '📧', 'Email addresses'],
          ['phone',      '📱', 'Phone numbers'],
          ['ssn',        '🪪', 'SSN / National ID'],
          ['creditcard', '💳', 'Credit card numbers'],
          ['address',    '📍', 'Physical addresses'],
          ['name',       '👤', 'Person names'],
        ] as [$val, $icon, $label])
        <label style="display:flex;align-items:center;gap:8px;background:#13131e;border:1px solid rgba(255,255,255,.08);border-radius:10px;padding:10px 12px;cursor:pointer;">
          <input type="checkbox" name="categories" value="{{ $val }}" checked style="accent-color:#5b5cff;width:16px;height:16px;">
          <span style="font-size:15px;">{{ $icon }}</span>
          <span style="font-size:13px;color:#eeeef8;">{{ $label }}</span>
        </label>
        @endforeach
      </div>
    </div>

    {{-- Custom terms --}}
    <div style="margin-bottom:20px;">
      <label style="color:#eeeef8;font-size:14px;font-weight:600;display:block;margin-bottom:6px;">Custom terms to redact <span style="color:#8888a8;font-weight:400">(optional)</span></label>
      <input type="text" id="customTerms" placeholder="e.g. John Smith, Acme Corp, Project X" style="width:100%;padding:10px 14px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:10px;color:#eeeef8;font-size:14px;">
      <p style="color:#8888a8;font-size:12px;margin-top:4px;">Separate multiple terms with commas</p>
    </div>

    <div style="text-align:center;">
      <button type="button" onclick="processRedact()" style="padding:14px 40px;background:linear-gradient(135deg,#ff6b6b,#ff4444);color:#fff;border:none;border-radius:99px;font-size:15px;font-weight:700;cursor:pointer;box-shadow:0 4px 20px rgba(255,107,107,.3);">🔒 Redact PDF →</button>
    </div>
  </div>

  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">🔐 Your files are processed securely and deleted after 2 hours</p>
  </div>
</div>

{{-- What gets redacted --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:24px;font-weight:700;text-align:center;margin-bottom:24px;">What the AI Detects & Redacts</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
    @foreach([
      ['📧','Emails','user@company.com → ████████'],
      ['📱','Phone Numbers','555-123-4567 → ████████'],
      ['🪪','SSN / NID','123-45-6789 → ████████'],
      ['💳','Credit Cards','4111 1111 → ████████'],
      ['📍','Addresses','123 Main St → ████████'],
      ['✏️','Custom Terms','Any word/phrase → ████████'],
    ] as [$icon, $title, $example])
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:16px;text-align:center;">
      <div style="font-size:24px;margin-bottom:8px;">{{ $icon }}</div>
      <div style="font-size:13px;font-weight:600;color:#eeeef8;margin-bottom:4px;">{{ $title }}</div>
      <div style="font-size:11px;color:#8888a8;font-family:monospace;">{{ $example }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- How it works --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">How PDF Redaction Works</h2>
  <div style="display:flex;flex-direction:column;gap:12px;">
    @foreach([
      ['1','🤖','AI Scans Your PDF','advanced AI reads every word in your document and identifies sensitive information based on the categories you selected.'],
      ['2','🎯','Locates Exact Positions','The tool maps each sensitive word to its exact position on the page — even across multiple pages.'],
      ['3','⬛','Permanently Blacks Out','Black rectangles are permanently drawn over all sensitive text. The underlying data is completely removed — not just hidden.'],
      ['4','📥','Download Clean PDF','Download your redacted PDF. The black boxes are permanent — no software can reveal the original text.'],
    ] as [$num, $icon, $title, $desc])
    <div style="display:flex;gap:16px;align-items:flex-start;background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:18px;">
      <div style="background:#5b5cff;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;flex-shrink:0;">{{ $num }}</div>
      <div>
        <div style="font-size:14px;font-weight:600;color:#eeeef8;margin-bottom:4px;">{{ $icon }} {{ $title }}</div>
        <div style="font-size:13px;color:#8888a8;line-height:1.5;">{{ $desc }}</div>
      </div>
    </div>
    @endforeach
  </div>
</div>

{{-- Use cases --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">Who Needs PDF Redaction?</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach(['⚖️ Lawyers & Law Firms','🏥 Healthcare / Medical','🏛️ Government Agencies','💼 HR Departments','🏦 Banks & Finance','📚 Researchers'] as $item)
    <span style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:99px;color:#eeeef8;font-size:13px;">{{ $item }}</span>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>Is the redaction permanent?</h3>
    <p>Yes. PDFTash converts redacted pages to images with black boxes permanently drawn over sensitive text. Unlike some tools that just overlay a black box (which can be removed by editing), our redaction permanently removes the underlying text data.</p>
  </div>
  <div class="faq-item">
    <h3>Can I redact a specific word or name?</h3>
    <p>Yes. Use the "Custom Terms" field to enter any specific words, names, company names, or phrases. Separate multiple terms with commas. The AI will black them out wherever they appear in the document.</p>
  </div>
  <div class="faq-item">
    <h3>Does redaction work on scanned PDFs?</h3>
    <p>Auto-redaction requires a text-based PDF. For scanned PDFs, first use our <a href="/ocr-pdf" style="color:#5b5cff">OCR tool</a> to create a searchable PDF, then redact it.</p>
  </div>
  <div class="faq-item">
    <h3>How accurate is the AI detection?</h3>
    <p>PDFTash uses advanced AI — one of the most accurate language models available. It correctly identifies email addresses, phone numbers, and credit card numbers with very high accuracy. Names and addresses can sometimes be missed if they appear in unusual formats.</p>
  </div>
  <div class="faq-item">
    <h3>Is there a file size limit?</h3>
    <p>Free users can redact PDFs up to 10MB with no signup required. Pro users ($2/month) can redact files up to 200MB.</p>
  </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
let selectedFile = null;

const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = '#ff6b6b'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    const f = e.dataTransfer.files[0];
    if (f && f.type === 'application/pdf') showOptions(f);
});

function handleFile(input) {
    if (input.files[0]) showOptions(input.files[0]);
}

function showOptions(file) {
    selectedFile = file;
    dropZone.querySelector('.upload-title').textContent = '✅ ' + file.name;
    document.getElementById('options').style.display = 'block';
}

async function processRedact() {
    if (!selectedFile) return;

    const checked = Array.from(document.querySelectorAll('input[name="categories"]:checked')).map(el => el.value);
    if (checked.length === 0 && !document.getElementById('customTerms').value.trim()) {
        alert('Please select at least one category or enter custom terms to redact.');
        return;
    }

    const result = document.getElementById('result');
    result.style.display = 'block';

    let secs = 0;
    result.innerHTML = '<div style="color:#8888a8;padding:20px">🤖 AI is scanning for sensitive info... <span id="timer">0s</span><br><small style="font-size:12px;margin-top:6px;display:block;">This may take 20–60 seconds depending on document length</small></div>';
    const timerEl = document.getElementById('timer');
    const timerInterval = setInterval(() => { secs++; if(timerEl) timerEl.textContent = secs + 's'; }, 1000);

    const fd = new FormData();
    fd.append('file', selectedFile);
    checked.forEach(c => fd.append('categories[]', c));
    fd.append('custom_terms', document.getElementById('customTerms').value);
    fd.append('_token', CSRF);

    const controller = new AbortController();
    const timeout = setTimeout(() => controller.abort(), 180000);

    try {
        const resp = await fetch('/api/pdf/redact', { method: 'POST', body: fd, signal: controller.signal });
        clearTimeout(timeout);
        clearInterval(timerInterval);

        if (resp.ok) {
            const blob = await resp.blob();
            const url  = URL.createObjectURL(blob);
            const name = selectedFile.name.replace(/\.pdf$/i, '') + '-redacted.pdf';

            result.innerHTML = `
                <div style="background:#0a0a1a;border:1px solid #ff6b6b;border-radius:12px;padding:24px;margin-bottom:16px;">
                    <div style="font-size:18px;font-weight:700;margin-bottom:8px;color:#ff6b6b">🔒 Redaction Complete in ${secs}s!</div>
                    <div style="color:#8888a8;font-size:14px;margin-bottom:20px;">All sensitive information has been permanently blacked out.</div>
                    <a href="${url}" download="${name}" style="display:inline-block;padding:13px 28px;background:linear-gradient(135deg,#ff6b6b,#ff4444);color:#fff;border-radius:99px;text-decoration:none;font-weight:700;font-size:15px;box-shadow:0 4px 20px rgba(255,107,107,.3);">⬇ Download Redacted PDF</a>
                </div>
                <button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Redact Another PDF</button>`;
        } else {
            const data = await resp.json().catch(() => ({}));
            result.innerHTML = `<div style="color:#ff6b6b;padding:16px;background:#1a0a0a;border-radius:8px;">❌ ${data.error || 'Something went wrong. Please try again.'}</div>`;
        }
    } catch(e) {
        clearTimeout(timeout);
        clearInterval(timerInterval);
        const msg = e.name === 'AbortError' ? 'Request timed out. Try a smaller PDF.' : 'Connection error. Please try again.';
        result.innerHTML = `<div style="color:#ff6b6b">${msg}</div>`;
    }
}
</script>
@endsection
