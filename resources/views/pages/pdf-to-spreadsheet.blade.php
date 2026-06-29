@extends('tools.layout')
@section('title', 'PDF to Spreadsheet — Convert PDF Data to Google Sheets & Excel')
@section('description', 'Convert any PDF to a spreadsheet online free. AI extracts tables into CSV or Excel format — ready to open in Google Sheets, Microsoft Excel, or LibreOffice. No signup.')
@section('keywords', 'pdf to spreadsheet, pdf to google sheets, pdf spreadsheet converter, convert pdf to spreadsheet online, pdf data to spreadsheet')
@section('slug', 'pdf-to-spreadsheet')
@section('schema')
<script type="application/ld+json">
[{"@context":"https://schema.org","@type":"SoftwareApplication","name":"PDFTash — PDF to Spreadsheet","applicationCategory":"WebApplication","operatingSystem":"Any","description":"Convert PDF tables to spreadsheets online free. AI extracts all table data into CSV or Excel format compatible with Google Sheets, Microsoft Excel, and LibreOffice Calc. No signup needed.","url":"https://pdftash.com/pdf-to-spreadsheet","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"aggregateRating":{"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"1876"}},
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
{"@type":"Question","name":"Can I open the output directly in Google Sheets?","acceptedAnswer":{"@type":"Answer","text":"Yes. Download the CSV file and open it directly in Google Sheets via File → Import, or download the .xlsx file and open it via File → Open. Both formats are fully compatible with Google Sheets."}},
{"@type":"Question","name":"What is the difference between CSV and Excel output?","acceptedAnswer":{"@type":"Answer","text":"CSV is a plain text file with comma-separated values — it opens in any spreadsheet app but doesn't support formatting. Excel (.xlsx) is a real Microsoft Excel file with bold headers, auto-fitted columns, and full spreadsheet features like formulas and sorting."}},
{"@type":"Question","name":"Does it work for Google Sheets users?","acceptedAnswer":{"@type":"Answer","text":"Yes. Download the CSV and import it into Google Sheets in seconds: go to File → Import → Upload, select your CSV, and choose 'comma' as separator. Your PDF table will appear as a Google Sheets spreadsheet instantly."}}
]}]
</script>
@endsection
@section('content')

<div class="hero">
  <div class="badge">📑 PDF to Spreadsheet</div>
  <h1>PDF to Spreadsheet — Google Sheets &amp; Excel</h1>
  <p>Convert any PDF table into a spreadsheet in seconds. Works with Google Sheets, Microsoft Excel, and LibreOffice. AI handles the extraction — you just download and open.</p>
</div>

<div style="max-width:700px;margin:0 auto 60px;background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:24px;padding:40px;text-align:center;">
  <div style="font-size:48px;margin-bottom:16px;">📑</div>
  <h2 style="font-size:22px;font-weight:700;margin-bottom:12px;">Convert PDF to Spreadsheet</h2>
  <p style="color:#8888a8;font-size:15px;margin-bottom:24px;">AI extracts all tables from your PDF into CSV or Excel. Open directly in Google Sheets, Microsoft Excel, or LibreOffice. No account required.</p>
  <a href="/pdf-to-csv" style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600;font-size:15px;">Convert PDF Now →</a>
  <p style="color:#8888a8;font-size:12px;margin-top:12px;">Free · No signup · Google Sheets + Excel compatible</p>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">Open in Any Spreadsheet App</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;text-align:center;">
    @foreach([
      ['🟢','Google Sheets','Import CSV directly via File → Import'],
      ['🟩','Microsoft Excel','Open .xlsx with one double-click'],
      ['📊','LibreOffice Calc','Full .xlsx and CSV support built-in'],
    ] as [$icon, $app, $desc])
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:20px;">
      <div style="font-size:32px;margin-bottom:10px;">{{ $icon }}</div>
      <div style="font-size:14px;font-weight:700;color:#eeeef8;margin-bottom:6px;">{{ $app }}</div>
      <div style="font-size:12px;color:#8888a8;line-height:1.5;">{{ $desc }}</div>
    </div>
    @endforeach
  </div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:20px;font-weight:700;text-align:center;margin-bottom:20px;">How to Open PDF Tables in Google Sheets</h2>
  <div style="display:flex;flex-direction:column;gap:10px;">
    @foreach([
      ['1','Upload your PDF to PDFTash and click Extract Tables'],
      ['2','Preview the extracted tables in your browser'],
      ['3','Click "Download CSV" on the table you want'],
      ['4','In Google Sheets, go to File → Import → Upload'],
      ['5','Select the CSV file and choose "Comma" as separator'],
      ['6','Click Import — your PDF table is now a Google Sheet!'],
    ] as [$num, $step])
    <div style="display:flex;gap:14px;align-items:center;background:#0f0f1a;border:1px solid rgba(255,255,255,.07);border-radius:10px;padding:14px 18px;">
      <div style="background:#5b5cff;color:#fff;border-radius:50%;width:26px;height:26px;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;flex-shrink:0;">{{ $num }}</div>
      <div style="font-size:14px;color:#cccce0;">{{ $step }}</div>
    </div>
    @endforeach
  </div>
</div>

<div class="features">
  <div class="feature">
    <div class="feature-icon">🤖</div>
    <h3>AI Table Detection</h3>
    <p>Doesn't rely on pixel coordinates or rule-based parsing. advanced AI reads and understands your PDF's structure, extracting every table accurately — even complex multi-row headers.</p>
  </div>
  <div class="feature">
    <div class="feature-icon">📥</div>
    <h3>CSV &amp; Excel Output</h3>
    <p>Choose CSV for maximum compatibility (Google Sheets, Numbers, LibreOffice) or Excel .xlsx for bold headers, auto-fitted columns, and full Microsoft Excel features.</p>
  </div>
  <div class="feature">
    <div class="feature-icon">🔒</div>
    <h3>Private &amp; Secure</h3>
    <p>Files are uploaded over HTTPS and automatically deleted after 2 hours. No account means no personal data stored. Your documents stay private.</p>
  </div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">Related PDF Tools</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([
      ['PDF to Excel Free','/pdf-to-excel-free'],
      ['Extract Table from PDF','/extract-table-from-pdf'],
      ['Convert PDF to CSV','/convert-pdf-to-csv'],
      ['PDF Invoice to Excel','/pdf-invoice-to-excel'],
      ['PDF to Text','/to-text-pdf'],
    ] as $link)
    <a href="{{ $link[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $link[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — PDF to Spreadsheet</h2>

  <div class="faq-item">
    <h3>Can I open the output directly in Google Sheets?</h3>
    <p>Yes. Download the CSV file from PDFTash, then open Google Sheets and go to File → Import → Upload. Select your CSV file, set the separator type to "Comma", and click Import Data. Your PDF table will appear as a fully editable Google Sheets spreadsheet in seconds. Alternatively, download the .xlsx file and open it via File → Open in Google Sheets for even easier import.</p>
  </div>

  <div class="faq-item">
    <h3>What is the difference between CSV and Excel (.xlsx) output?</h3>
    <p>CSV (Comma-Separated Values) is a plain text file that any spreadsheet application can open. It has no formatting — no bold text, no colors, no column widths. Excel (.xlsx) is a real Microsoft Excel workbook with bold header rows, auto-fitted column widths, and full support for Excel formulas, sorting, and filtering. If you plan to work in Excel or share with Excel users, choose .xlsx. For Google Sheets or simple data imports, CSV works great.</p>
  </div>

  <div class="faq-item">
    <h3>My PDF table has merged cells — will they extract correctly?</h3>
    <p>Merged cells are one of the hardest challenges in PDF table extraction. PDFTash uses AI to understand cell context and will attempt to duplicate merged cell values across the appropriate rows. Complex merge patterns may require minor manual cleanup in your spreadsheet app after extraction.</p>
  </div>

  <div class="faq-item">
    <h3>Why is my PDF not converting to a spreadsheet?</h3>
    <p>There are two common reasons: (1) The PDF is a scanned image — use <a href="/ocr-pdf" style="color:#5b5cff">OCR PDF</a> first to add a text layer. (2) The PDF doesn't actually contain structured tables — if the "table" is just text formatted to look like a table with spaces, the extraction may be imperfect. In that case, use <a href="/to-text-pdf" style="color:#5b5cff">PDF to Text</a> to get the raw content and manually structure it.</p>
  </div>
</div>

@endsection
