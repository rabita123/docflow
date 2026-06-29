@extends('tools.layout')

@section('title', 'PDF Table to CSV / Excel — Extract Tables from PDF Free')
@section('description', 'Extract tables from any PDF and download as CSV or Excel (.xlsx). AI-powered table detection works on invoices, reports, financial statements, and data sheets. No signup required.')
@section('keywords', 'pdf table to csv, pdf to excel, extract table from pdf, pdf table extractor, convert pdf table to excel, pdf data extraction')
@section('slug', 'pdf-to-csv')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash — PDF Table to CSV / Excel",
  "applicationCategory": "WebApplication",
  "operatingSystem": "Any",
  "description": "Extract tables from PDFs and download as CSV or Excel. AI detects and structures tables from invoices, reports, financial statements, and more.",
  "url": "https://pdftash.com/pdf-to-csv",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"},
  "aggregateRating": {"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"1243"}
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"What types of PDFs work?","acceptedAnswer":{"@type":"Answer","text":"The tool works best with text-based PDFs like invoices, financial reports, statements, and data exports. For scanned PDFs, run OCR first at pdftash.com/ocr-pdf to add a text layer."}},
    {"@type":"Question","name":"Can I download as Excel (.xlsx)?","acceptedAnswer":{"@type":"Answer","text":"Yes. After AI extracts the tables, click 'Download Excel (.xlsx)' to get a real .xlsx file that opens in Microsoft Excel, Google Sheets, or LibreOffice."}},
    {"@type":"Question","name":"What if my PDF has multiple tables?","acceptedAnswer":{"@type":"Answer","text":"PDFTash detects all tables in the PDF and shows them as separate previews. Each table has its own CSV and Excel download button."}},
    {"@type":"Question","name":"Is there a file size limit?","acceptedAnswer":{"@type":"Answer","text":"Free users can extract tables from PDFs up to 10MB. Pro users ($2/month) can process files up to 200MB with no daily limits."}},
    {"@type":"Question","name":"Does it work on invoices and financial reports?","acceptedAnswer":{"@type":"Answer","text":"Yes — invoices, bank statements, financial reports, pricing tables, product catalogs, and any structured data in PDF form. advanced AI understands table context and extracts it accurately."}},
  ]
}
]
</script>
@endsection

@section('content')
<div class="hero">
  <div style="display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin-bottom:24px;">
    <div class="badge">📊 AI Table Extractor</div>
    <div class="badge" style="background:rgba(91,255,154,.1);border-color:rgba(91,255,154,.4);color:#5bff9a;">✅ CSV + Excel</div>
  </div>
  <h1>PDF Table to CSV / Excel</h1>
  <p>Upload any PDF and AI instantly finds every table inside — invoices, reports, statements, data sheets. Preview the data, then download as CSV or Excel (.xlsx) in one click.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">📊</div>
    <div class="upload-title">Drop your PDF here to extract tables</div>
    <div class="upload-sub">AI will find and structure all tables automatically</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>

  <div id="extract-btn-wrap" style="display:none;text-align:center;margin-top:20px;">
    <button type="button" onclick="processExtract()" id="extract-btn"
      style="padding:14px 40px;background:linear-gradient(135deg,#5b5cff,#7b5fff);color:#fff;border:none;border-radius:99px;font-size:15px;font-weight:700;cursor:pointer;box-shadow:0 4px 20px rgba(91,92,255,.35);">
      📊 Extract Tables →
    </button>
  </div>

  <div id="loading" style="display:none;text-align:center;margin-top:24px;">
    <div style="color:#8888a8;padding:20px">
      🤖 AI is scanning for tables... <span id="timer">0s</span><br>
      <small style="font-size:12px;margin-top:6px;display:block;">Detecting and structuring all tables in the PDF</small>
    </div>
  </div>

  <div id="result" style="display:none;margin-top:24px;"></div>

  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">🔐 Your files are processed securely and deleted after 2 hours</p>
  </div>
</div>

{{-- Use cases strip --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:24px;font-weight:700;text-align:center;margin-bottom:24px;">Works on Any PDF with Tables</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
    @foreach([
      ['🧾','Invoices','Line items, prices, totals'],
      ['📈','Financial Reports','P&L, balance sheets, KPIs'],
      ['🏦','Bank Statements','Transactions, balances'],
      ['📋','Data Sheets','Product specs, comparisons'],
      ['📊','Research Papers','Statistical tables, results'],
      ['🛒','Price Catalogs','SKU lists, pricing tables'],
    ] as [$icon, $title, $desc])
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:16px;text-align:center;">
      <div style="font-size:28px;margin-bottom:8px;">{{ $icon }}</div>
      <div style="font-size:13px;font-weight:600;color:#eeeef8;margin-bottom:4px;">{{ $title }}</div>
      <div style="font-size:11px;color:#8888a8;">{{ $desc }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- How it works --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">How Table Extraction Works</h2>
  <div style="display:flex;flex-direction:column;gap:12px;">
    @foreach([
      ['1','📤','Upload Your PDF','Drop any PDF — invoices, reports, spreadsheets exported as PDF, financial statements.'],
      ['2','🤖','AI Finds Every Table','advanced AI scans the entire document, identifies all tables, and structures them with proper headers and rows.'],
      ['3','👁️','Preview in Browser','All extracted tables appear as clean HTML tables directly in your browser before downloading.'],
      ['4','⬇️','Download CSV or Excel','Click to download any table as a CSV file or a real Excel .xlsx file — ready for analysis.'],
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

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>What types of PDFs does this work on?</h3>
    <p>Best results with text-based PDFs: invoices, financial reports, bank statements, research papers, product catalogs, and any PDF that was exported from Word, Excel, or a reporting tool. For scanned image-based PDFs, use our <a href="/ocr-pdf" style="color:#5b5cff">OCR tool</a> first to add a text layer.</p>
  </div>
  <div class="faq-item">
    <h3>Can I get a real Excel file, not just CSV?</h3>
    <p>Yes. The tool generates real .xlsx files (not renamed CSV). Click "Download Excel (.xlsx)" after extraction to get a file that opens directly in Microsoft Excel, Google Sheets, or LibreOffice Calc.</p>
  </div>
  <div class="faq-item">
    <h3>What if my PDF has multiple tables?</h3>
    <p>Each table is extracted and shown as a separate preview with its own download buttons. You can download tables individually as CSV or Excel.</p>
  </div>
  <div class="faq-item">
    <h3>How accurate is the extraction?</h3>
    <p>PDFTash uses advanced AI — one of the most accurate language models. For well-structured PDFs, accuracy is very high. Complex merged cells or rotated tables may require some cleanup, which you can do after downloading in Excel.</p>
  </div>
  <div class="faq-item">
    <h3>Is there a file size limit?</h3>
    <p>Free users can extract tables from PDFs up to 10MB. Pro users ($2/month) get 200MB limit and no daily usage caps.</p>
  </div>
</div>

{{-- SheetJS for real .xlsx generation client-side --}}
<script src="https://cdn.sheetjs.com/xlsx-0.20.3/package/dist/xlsx.full.min.js"></script>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
let selectedFile = null;
let extractedTables = [];

// ── Drag & drop ───────────────────────────────────────────────────────────────
const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = '#5b5cff'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    const f = e.dataTransfer.files[0];
    if (f && f.type === 'application/pdf') showFile(f);
});

function handleFile(input) {
    if (input.files[0]) showFile(input.files[0]);
}

function showFile(file) {
    selectedFile = file;
    dropZone.querySelector('.upload-title').textContent = '✅ ' + file.name;
    dropZone.querySelector('.upload-sub').textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
    document.getElementById('extract-btn-wrap').style.display = 'block';
}

// ── Main extraction ───────────────────────────────────────────────────────────
async function processExtract() {
    if (!selectedFile) return;

    document.getElementById('extract-btn-wrap').style.display = 'none';
    document.getElementById('loading').style.display = 'block';
    document.getElementById('result').style.display = 'none';

    let secs = 0;
    const timerEl = document.getElementById('timer');
    const timerInterval = setInterval(() => { secs++; if (timerEl) timerEl.textContent = secs + 's'; }, 1000);

    const fd = new FormData();
    fd.append('file', selectedFile);
    fd.append('_token', CSRF);

    const controller = new AbortController();
    const timeout = setTimeout(() => controller.abort(), 120000);

    try {
        const resp = await fetch('/api/pdf/table-extract', { method: 'POST', body: fd, signal: controller.signal });
        clearTimeout(timeout);
        clearInterval(timerInterval);
        document.getElementById('loading').style.display = 'none';

        if (resp.ok) {
            const data = await resp.json();
            extractedTables = data.tables || [];
            renderResults(extractedTables, secs);
        } else {
            const data = await resp.json().catch(() => ({}));
            showError(data.error || 'Something went wrong. Please try again.');
        }
    } catch(e) {
        clearTimeout(timeout);
        clearInterval(timerInterval);
        document.getElementById('loading').style.display = 'none';
        const msg = e.name === 'AbortError' ? 'Request timed out. Try a smaller PDF.' : 'Connection error. Please try again.';
        showError(msg);
    }
}

function showError(msg) {
    const result = document.getElementById('result');
    result.style.display = 'block';
    result.innerHTML = `<div style="color:#ff6b6b;padding:16px;background:#1a0a0a;border:1px solid rgba(255,107,107,.3);border-radius:8px;">❌ ${msg}</div>`;
}

// ── Render extracted tables ───────────────────────────────────────────────────
function renderResults(tables, secs) {
    const result = document.getElementById('result');
    result.style.display = 'block';

    if (!tables.length) {
        result.innerHTML = `<div style="color:#ff6b6b;padding:16px;background:#1a0a0a;border:1px solid rgba(255,107,107,.3);border-radius:8px;">❌ No tables found in this PDF. Make sure it contains structured table data and is not a scanned image.</div>`;
        return;
    }

    let html = `
        <div style="background:#0a1a0a;border:1px solid #5bff9a;border-radius:12px;padding:20px;margin-bottom:24px;text-align:center;">
            <div style="font-size:18px;font-weight:700;margin-bottom:6px;color:#5bff9a">✅ Found ${tables.length} table${tables.length > 1 ? 's' : ''} in ${secs}s!</div>
            <div style="color:#8888a8;font-size:13px;">Preview below — download each table as CSV or Excel</div>
        </div>`;

    tables.forEach((table, idx) => {
        const name = table.name || ('Table ' + (idx + 1));
        const headers = table.headers || [];
        const rows = table.rows || [];

        html += `
        <div style="margin-bottom:32px;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;flex-wrap:wrap;gap:8px;">
                <div style="font-size:15px;font-weight:700;color:#eeeef8;">📋 ${escHtml(name)}</div>
                <div style="display:flex;gap:8px;">
                    <button onclick="downloadCsv(${idx})"
                        style="padding:8px 16px;background:#16162a;border:1px solid rgba(255,255,255,.2);border-radius:99px;color:#eeeef8;cursor:pointer;font-size:13px;font-weight:600;">
                        ⬇ CSV
                    </button>
                    <button onclick="downloadXlsx(${idx})"
                        style="padding:8px 16px;background:linear-gradient(135deg,#5b5cff,#7b5fff);border:none;border-radius:99px;color:#fff;cursor:pointer;font-size:13px;font-weight:600;">
                        ⬇ Excel (.xlsx)
                    </button>
                </div>
            </div>
            <div style="overflow-x:auto;border-radius:10px;border:1px solid rgba(255,255,255,.08);">
                <table style="width:100%;border-collapse:collapse;font-size:13px;">
                    <thead>
                        <tr style="background:#13131e;">
                            ${headers.map(h => `<th style="padding:10px 14px;text-align:left;color:#5b5cff;font-weight:600;white-space:nowrap;border-bottom:1px solid rgba(255,255,255,.08);">${escHtml(h)}</th>`).join('')}
                        </tr>
                    </thead>
                    <tbody>
                        ${rows.slice(0,50).map((row, ri) => `
                        <tr style="background:${ri % 2 === 0 ? '#0f0f1a' : '#13131e'};">
                            ${row.map(cell => `<td style="padding:9px 14px;color:#cccce0;border-bottom:1px solid rgba(255,255,255,.04);white-space:nowrap;">${escHtml(String(cell ?? ''))}</td>`).join('')}
                        </tr>`).join('')}
                        ${rows.length > 50 ? `<tr><td colspan="${headers.length}" style="padding:10px 14px;color:#8888a8;font-size:12px;text-align:center;">… and ${rows.length - 50} more rows (all included in download)</td></tr>` : ''}
                    </tbody>
                </table>
            </div>
            <div style="color:#8888a8;font-size:12px;margin-top:6px;">${rows.length} rows × ${headers.length} columns</div>
        </div>`;
    });

    html += `<div style="text-align:center;margin-top:8px;">
        <button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Extract from Another PDF</button>
    </div>`;

    result.innerHTML = html;
}

// ── Download helpers ──────────────────────────────────────────────────────────
function tableToSafeName(idx) {
    const t = extractedTables[idx];
    return (t?.name || ('Table_' + (idx + 1))).replace(/[^a-z0-9_\- ]/gi, '_');
}

function downloadCsv(idx) {
    const table = extractedTables[idx];
    if (!table) return;

    const rows = [table.headers || [], ...(table.rows || [])];
    const csv  = rows.map(row =>
        row.map(cell => {
            const s = String(cell ?? '');
            // Quote cells that contain commas, quotes, or newlines
            if (s.includes(',') || s.includes('"') || s.includes('\n')) {
                return '"' + s.replace(/"/g, '""') + '"';
            }
            return s;
        }).join(',')
    ).join('\r\n');

    const blob = new Blob(['\uFEFF' + csv], { type: 'text/csv;charset=utf-8;' });
    const url  = URL.createObjectURL(blob);
    const a    = document.createElement('a');
    a.href     = url;
    a.download = tableToSafeName(idx) + '.csv';
    a.click();
    URL.revokeObjectURL(url);
}

function downloadXlsx(idx) {
    const table = extractedTables[idx];
    if (!table || typeof XLSX === 'undefined') { downloadCsv(idx); return; }

    const rows = [table.headers || [], ...(table.rows || [])];
    const ws   = XLSX.utils.aoa_to_sheet(rows);

    // Bold header row
    const range = XLSX.utils.decode_range(ws['!ref'] || 'A1');
    for (let col = range.s.c; col <= range.e.c; col++) {
        const addr = XLSX.utils.encode_cell({ r: 0, c: col });
        if (ws[addr]) ws[addr].s = { font: { bold: true } };
    }

    // Auto-fit column widths
    ws['!cols'] = (table.headers || []).map((h, colIdx) => {
        const maxLen = Math.max(
            String(h || '').length,
            ...(table.rows || []).map(r => String(r[colIdx] ?? '').length)
        );
        return { wch: Math.min(Math.max(maxLen + 2, 8), 50) };
    });

    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, (table.name || 'Sheet1').substring(0, 31));
    XLSX.writeFile(wb, tableToSafeName(idx) + '.xlsx');
}

function escHtml(str) {
    return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}
</script>
@endsection
