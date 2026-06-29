@extends('tools.layout')

@section('title', 'Summarize PDF Online Free — AI PDF Summarizer No Signup')
@section('description', 'Get an AI summary of any PDF in seconds. Extracts key points, conclusions and action items from any document. Free, no signup required, no page limits.')
@section('keywords', 'summarize pdf, ai pdf summarizer, pdf summarizer online free, summarize pdf online, pdf summary generator, summarize research paper, summarize pdf without reading, key points from pdf')
@section('slug', 'summarize-pdf')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash — AI PDF Summarizer",
  "applicationCategory": "WebApplication",
  "operatingSystem": "Any",
  "description": "Free AI PDF summarizer. Upload any PDF and get a clear, structured summary with key points, conclusions, and action items — no signup required.",
  "url": "https://pdftash.com/summarize-pdf",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"},
  "aggregateRating": {"@type":"AggregateRating","ratingValue":"4.9","reviewCount":"1932"}
},
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Summarize a PDF with AI",
  "description": "Get a full AI summary of any PDF in 3 steps — free, no signup.",
  "step": [
    {"@type":"HowToStep","position":1,"name":"Upload your PDF","text":"Drag and drop or click to upload any PDF. Research papers, reports, legal documents, textbooks — any PDF works."},
    {"@type":"HowToStep","position":2,"name":"AI reads your document","text":"PDFTash AI extracts and analyzes the full text content of your PDF, identifying key sections, themes, and data points."},
    {"@type":"HowToStep","position":3,"name":"Get your summary","text":"Receive a structured summary with key points, main conclusions, and action items — ready to copy or download."}
  ]
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"Is the PDF summarizer completely free?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash summarizes PDFs for free with no signup required. Free users get 1 AI summary per day. Pro users ($2/month) get unlimited summaries."}},
    {"@type":"Question","name":"How accurate is the AI PDF summary?","acceptedAnswer":{"@type":"Answer","text":"PDFTash uses advanced AI — one of the most accurate large language models available. Summaries preserve key facts, quotes, and data points faithfully."}},
    {"@type":"Question","name":"Can I summarize a 100-page research paper?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash processes up to 200MB PDFs. For very long documents, the AI intelligently samples key sections to produce a comprehensive summary."}},
    {"@type":"Question","name":"Can I ask follow-up questions after the summary?","acceptedAnswer":{"@type":"Answer","text":"Yes — use the Chat with PDF tool to ask specific follow-up questions after reviewing your summary."}},
    {"@type":"Question","name":"Does PDF summarizer work on scanned documents?","acceptedAnswer":{"@type":"Answer","text":"It works best on text-based PDFs. Scanned image PDFs require OCR processing first — our AI handles this automatically but accuracy depends on scan quality."}}
  ]
}
]
</script>
@endsection

@section('content')
<div class="hero">
  <div class="badge">🤖 AI PDF Summarizer</div>
  <h1>Summarize PDF Online Free — AI Summary in Seconds</h1>
  <p>Upload any PDF and get a clear AI-generated summary with key points, conclusions, and action items. No signup. No page limits. AI-Powered.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">📄</div>
    <div class="upload-title">Drop your PDF here to Summarize</div>
    <div class="upload-sub">Research papers, reports, contracts, textbooks — any PDF</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Files deleted automatically after 2 hours · 100% private</p>
  </div>
</div>

{{-- USE CASES --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:12px;">What Can You Summarize?</h2>
  <p style="text-align:center;color:#8888a8;font-size:14px;margin-bottom:28px;">From 10-page reports to 300-page academic theses — AI handles it all</p>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['📚','Research Papers','Get the abstract, methodology, results, and conclusions in plain language — without reading every word.'],
      ['⚖️','Legal Contracts','Identify key terms, obligations, payment clauses, and expiry dates without a lawyer.'],
      ['📊','Business Reports','Extract executive summary, KPIs, risks, and recommended actions from annual reports.'],
      ['📖','Textbooks & Manuals','Summarize individual chapters for study notes or quick reference.'],
      ['🏥','Medical Documents','Understand diagnoses, medication instructions, and follow-up requirements clearly.'],
      ['🏛️','Government Documents','Cut through bureaucratic language to get the actionable information you need.'],
    ] as $f)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:20px;">
      <div style="font-size:26px;margin-bottom:8px;">{{ $f[0] }}</div>
      <div style="font-weight:600;font-size:13px;color:#eeeef8;margin-bottom:6px;">{{ $f[1] }}</div>
      <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $f[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- HOW IT WORKS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">How PDF Summarization Works</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
    @foreach([
      ['📤','1. Upload','Drop your PDF. Any size, any topic. Encrypted in transit.'],
      ['🧠','2. AI Analyzes','advanced AI reads the full document, identifies key sections, themes, and data.'],
      ['📋','3. Get Summary','Receive structured key points, conclusions, and any action items.'],
    ] as $s)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:20px;text-align:center;">
      <div style="font-size:28px;margin-bottom:10px;">{{ $s[0] }}</div>
      <div style="font-weight:600;margin-bottom:6px;font-size:13px;">{{ $s[1] }}</div>
      <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $s[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- COMPARISON --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">PDFTash vs Other PDF Summarizers</h2>
  <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;font-size:13px;">
      <thead>
        <tr style="background:#0f0f1a;">
          <th style="padding:12px 16px;text-align:left;color:#8888a8;border-bottom:1px solid rgba(255,255,255,.08);">Feature</th>
          <th style="padding:12px 16px;text-align:center;color:#9898ff;font-weight:700;border-bottom:1px solid rgba(255,255,255,.08);">PDFTash ✓</th>
          <th style="padding:12px 16px;text-align:center;color:#8888a8;border-bottom:1px solid rgba(255,255,255,.08);">ChatPDF</th>
          <th style="padding:12px 16px;text-align:center;color:#8888a8;border-bottom:1px solid rgba(255,255,255,.08);">Smallpdf</th>
        </tr>
      </thead>
      <tbody>
        @foreach([
          ['Free to Summarize','✅','⚠️ 3/day','✅'],
          ['No Signup','✅','❌ Required','✅'],
          ['No Page Limit','✅','❌ 50 pages free','✅'],
          ['Ask Follow-up Questions','✅','✅','❌'],
          ['Translate After Summary','✅','❌','❌'],
          ['Full PDF Toolkit Included','✅','❌','✅'],
          ['AI Model Used','Claude (Anthropic)','GPT-4','Unknown'],
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
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">Related AI PDF Tools</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([
      ['💬 Chat with PDF','/chat-with-pdf'],
      ['🌍 Translate PDF','/translate-pdf'],
      ['✨ AI PDF Generator','/ai-pdf-generator'],
      ['📋 AI Form Fill','/ai-form-fill'],
      ['🗜️ Compress PDF','/compress-pdf'],
      ['💬 ChatPDF Alternative','/chatpdf-alternative'],
    ] as $t)
    <a href="{{ $t[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — AI PDF Summarizer</h2>
  <div class="faq-item">
    <h3>How long does it take to summarize a PDF?</h3>
    <p>Most PDFs are summarized in 10–30 seconds. Longer documents (100+ pages) may take up to 60 seconds. The AI processes your document server-side so your device performance doesn't matter.</p>
  </div>
  <div class="faq-item">
    <h3>Can I summarize a PDF in a different language?</h3>
    <p>Yes. The AI can summarize PDFs written in any language and produce the summary in English or your preferred language. You can also use the <a href="/translate-pdf" style="color:#5b5cff">Translate PDF</a> tool to get a translated version first.</p>
  </div>
  <div class="faq-item">
    <h3>How accurate is the AI summary?</h3>
    <p>PDFTash uses advanced AI — one of the most capable and accurate language models available. The summary faithfully represents the document's key points. For critical decisions, we recommend reading the relevant sections of the original document.</p>
  </div>
  <div class="faq-item">
    <h3>Can I get the summary as a downloadable file?</h3>
    <p>Yes. After the summary is generated, you can download it as a TXT file or copy it to your clipboard. PDF download of the summary is also available.</p>
  </div>
  <div class="faq-item">
    <h3>Does it work on scanned PDFs?</h3>
    <p>Yes, but accuracy depends on scan quality. Text-based PDFs (digitally created) produce the most accurate summaries. For scanned documents, the AI uses text extraction from the image content.</p>
  </div>
  <div class="faq-item">
    <h3>What's the file size limit for PDF summarization?</h3>
    <p>Free users can upload PDFs up to 10MB. Pro users can upload up to 200MB. For very long documents, the AI intelligently samples key sections to produce a comprehensive summary.</p>
  </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = '#5b5cff'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    const file = e.dataTransfer.files[0];
    if (file && file.type === 'application/pdf') processFile(file);
});
function handleFile(input) { if (input.files[0]) processFile(input.files[0]); }
async function processFile(file) {
    const result = document.getElementById('result');
    result.style.display = 'block';
    let secs = 0;
    result.innerHTML = '<div style="color:#8888a8;padding:20px">🤖 AI is reading your PDF... <span id="timer">0s</span></div>';
    const timerEl = document.getElementById('timer');
    const timerInterval = setInterval(() => { secs++; if(timerEl) timerEl.textContent = secs + 's'; }, 1000);
    const formData = new FormData();
    formData.append('file', file);
    formData.append('_token', CSRF);
    const controller = new AbortController();
    const timeout = setTimeout(() => controller.abort(), 150000);
    try {
        const resp = await fetch('/api/ai/summarize', {method:'POST', body:formData, signal: controller.signal});
        clearTimeout(timeout);
        clearInterval(timerInterval);
        if (resp.ok) {
            const data = await resp.json();
            const summary = data.summary || data.text || '';
            result.innerHTML = `
                <div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;text-align:left;">
                    <div style="color:#00e5a0;font-size:16px;font-weight:700;margin-bottom:12px">✅ Summary ready in ${secs}s</div>
                    <div style="color:#eeeef8;font-size:14px;line-height:1.7;white-space:pre-wrap;max-height:400px;overflow-y:auto;border:1px solid rgba(255,255,255,.08);border-radius:8px;padding:14px;margin-bottom:16px;">${summary.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')}</div>
                    <div style="display:flex;gap:10px;flex-wrap:wrap;">
                        <button onclick="navigator.clipboard.writeText(${JSON.stringify(summary)})" style="padding:10px 20px;background:#5b5cff;color:#fff;border:none;border-radius:99px;font-size:14px;font-weight:600;cursor:pointer;">📋 Copy Summary</button>
                        <a href="/chat-with-pdf" style="padding:10px 20px;background:#0f0f1a;color:#eeeef8;border:1px solid rgba(255,255,255,.15);border-radius:99px;font-size:14px;font-weight:600;text-decoration:none;">💬 Ask Follow-up Questions →</a>
                    </div>
                </div>
                <button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Summarize Another PDF</button>`;
        } else {
            const data = await resp.json().catch(()=>({}));
            if(data.error === 'pro_required' || data.error === 'free_limit_reached') {
                result.innerHTML = `<div style="background:#1a1a0a;border:1px solid #ffa500;border-radius:12px;padding:20px;"><div style="color:#ffa500;font-weight:700;margin-bottom:8px">⚡ Daily limit reached</div><div style="color:#8888a8;font-size:14px;margin-bottom:16px">Free users get 1 AI summary per day. Upgrade to Pro for unlimited summaries.</div><a href="/payment/checkout" style="display:inline-block;padding:12px 24px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:700;">Upgrade to Pro →</a></div>`;
            } else {
                result.innerHTML = `<div style="color:#ff6b6b">Error: ${data.error || 'Something went wrong. Please try again.'}</div>`;
            }
        }
    } catch(e) {
        clearTimeout(timeout);
        clearInterval(timerInterval);
        result.innerHTML = `<div style="color:#ff6b6b">${e.name==='AbortError'?'Request timed out. Try a smaller PDF.':'Connection error. Please try again.'}</div>`;
    }
}
</script>
@endsection
