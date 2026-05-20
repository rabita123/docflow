@extends('tools.layout')

@section('title', 'AI Form Filler — Fill PDF Forms Automatically')
@section('description', 'Upload any PDF form and let AI fill it automatically. Detects all form fields — name, email, date, address — and fills them from your details instantly.')
@section('keywords', 'ai form filler, fill pdf form automatically, auto fill pdf, pdf form filler, fill pdf online, ai pdf form fill')
@section('slug', 'ai-form-fill')

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash AI Form Filler",
  "applicationCategory": "WebApplication",
  "description": "Upload a PDF form and let AI automatically detect and fill all form fields from your personal details.",
  "url": "https://pdftash.com/ai-form-fill",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"}
}
</script>
@endsection

@section('content')
<style>
/* ── Upload state ──────────────────────────────────────── */
#state-upload { max-width:680px; margin:0 auto; }

/* ── After upload: fill panel ──────────────────────────── */
#state-fill { display:none; max-width:680px; margin:0 auto; padding:0 20px 60px; }
.fill-card { background:#0f0f1a; border:1px solid rgba(255,255,255,.08);
  border-radius:16px; padding:28px; margin-bottom:20px; }
.fill-card-title { font-size:16px; font-weight:700; color:#eeeef8; margin:0 0 6px; }
.fill-card-sub { font-size:13px; color:#8888a8; margin:0 0 18px; line-height:1.5; }

/* Fields detected badges */
#fields-list { display:flex; flex-wrap:wrap; gap:7px; margin-bottom:18px; }
.field-chip { padding:4px 12px; background:rgba(91,92,255,.12);
  border:1px solid rgba(91,92,255,.3); border-radius:99px;
  font-size:11px; font-weight:600; color:#9898ff; }
.field-chip.visual { background:rgba(0,229,160,.08); border-color:rgba(0,229,160,.25); color:#00e5a0; }

/* User info textarea */
#user-info { width:100%; min-height:110px; background:#16162a;
  border:1px solid rgba(255,255,255,.12); border-radius:10px;
  color:#eeeef8; font-size:13px; padding:13px 15px; resize:vertical;
  font-family:inherit; line-height:1.6; }
#user-info:focus { outline:none; border-color:rgba(91,92,255,.5); }
#user-info::placeholder { color:#44445a; }

/* Buttons */
#btn-fill { width:100%; padding:14px; margin-top:14px;
  background:linear-gradient(135deg,#5b5cff,#7b7cff);
  color:#fff; border:none; border-radius:10px; font-size:15px; font-weight:700;
  cursor:pointer; transition:all .2s; }
#btn-fill:hover:not(:disabled) { transform:translateY(-1px); box-shadow:0 6px 24px rgba(91,92,255,.5); }
#btn-fill:disabled { opacity:.5; cursor:default; transform:none; box-shadow:none; }
#btn-change-file { background:transparent; border:1px solid rgba(255,255,255,.1);
  color:#8888a8; border-radius:8px; padding:7px 14px; font-size:12px; cursor:pointer; }
#btn-change-file:hover { color:#eeeef8; background:rgba(255,255,255,.05); }

/* File info banner */
#file-banner { display:flex; align-items:center; gap:14px; padding:14px 18px;
  background:#16162a; border:1px solid rgba(255,255,255,.08); border-radius:10px; margin-bottom:20px; }
.fb-icon { font-size:28px; flex-shrink:0; }
.fb-name { font-size:14px; font-weight:600; color:#eeeef8; }
.fb-meta { font-size:12px; color:#8888a8; margin-top:2px; }

/* Progress */
#fill-progress { display:none; text-align:center; padding:30px 0; }
.prog-spin { width:44px; height:44px; border:3px solid rgba(91,92,255,.2);
  border-top-color:#5b5cff; border-radius:50%; animation:spin .7s linear infinite; margin:0 auto 14px; }
@keyframes spin { to { transform:rotate(360deg) } }
.prog-msg { color:#8888a8; font-size:14px; }

/* Result */
#fill-result { display:none; }
.result-card { background:linear-gradient(135deg,rgba(0,229,160,.08),rgba(0,200,140,.05));
  border:1px solid rgba(0,229,160,.25); border-radius:14px; padding:24px; text-align:center; }
.result-title { font-size:22px; font-weight:800; color:#00e5a0; margin-bottom:8px; }
.result-sub { color:#8888a8; font-size:13px; margin-bottom:20px; }
#btn-download-filled { display:inline-block; padding:13px 36px;
  background:linear-gradient(135deg,#5b5cff,#7b7cff);
  color:#fff; border:none; border-radius:99px; font-size:15px; font-weight:700;
  cursor:pointer; transition:all .2s; text-decoration:none; }
#btn-download-filled:hover { transform:translateY(-1px); box-shadow:0 6px 24px rgba(91,92,255,.5); }
.result-fills { margin:20px 0 0; text-align:left; }
.rf-row { display:flex; justify-content:space-between; align-items:center;
  padding:8px 14px; background:rgba(255,255,255,.03); border-radius:8px; margin-bottom:5px; font-size:12px; }
.rf-key { color:#8888a8; flex-shrink:0; margin-right:10px; }
.rf-val { color:#eeeef8; font-weight:600; text-align:right; }

/* Try again */
#btn-try-again { background:transparent; border:1px solid rgba(255,255,255,.1);
  color:#8888a8; border-radius:8px; padding:9px 20px; font-size:13px; cursor:pointer;
  margin-top:12px; display:block; width:100%; }
#btn-try-again:hover { background:rgba(255,255,255,.05); color:#eeeef8; }
</style>

{{-- ── UPLOAD STATE ──────────────────────────────────────────────── --}}
<div id="state-upload">
  <div class="hero">
    <div style="display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin-bottom:24px;">
      <div class="badge">✨ Powered by Claude AI</div>
      <div class="badge" style="background:rgba(255,165,0,.1);border-color:rgba(255,165,0,.4);color:#ffa500;">🔒 Pro Feature</div>
    </div>
    <h1>AI Form Filler</h1>
    <p>Upload any PDF form — job application, lease, contract, registration — and AI fills all fields automatically. Requires a <strong style="color:#ffa500;">Pro plan</strong>.</p>
  </div>

  <div class="tool-box" style="max-width:620px;">
    <div class="upload-area" id="upload-dz" onclick="document.getElementById('formFile').click()">
      <div class="upload-icon">📋</div>
      <div class="upload-title">Drop your PDF form here</div>
      <div class="upload-sub">Click to browse · Works with any fillable or visual PDF form</div>
      <input type="file" id="formFile" accept=".pdf" style="display:none" onchange="handleFile(this.files[0])">
    </div>
  </div>

  {{-- How it works --}}
  <div style="max-width:680px;margin:0 auto 20px;padding:0 20px;">
    <h2 style="font-size:20px;font-weight:700;text-align:center;margin-bottom:20px;">How It Works</h2>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
      @foreach([
        ['1','Upload PDF Form','Drop any PDF form — job application, lease, contract, or any fillable form.'],
        ['2','Enter Your Details','Type your name, email, address, date and any other info in plain text.'],
        ['3','Download Filled PDF','AI detects every field, fills them in, and gives you the completed PDF.'],
      ] as $step)
      <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:18px;text-align:center;">
        <div style="width:32px;height:32px;background:rgba(91,92,255,.2);border:1px solid rgba(91,92,255,.4);
          border-radius:50%;font-size:14px;font-weight:800;color:#9898ff;
          display:flex;align-items:center;justify-content:center;margin:0 auto 10px;">{{ $step[0] }}</div>
        <div style="font-weight:600;font-size:13px;margin-bottom:5px;">{{ $step[1] }}</div>
        <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $step[2] }}</div>
      </div>
      @endforeach
    </div>
  </div>

  {{-- Works with --}}
  <div style="max-width:680px;margin:0 auto 50px;padding:0 20px;text-align:center;">
    <div style="font-size:12px;color:#44445a;margin-bottom:10px;">WORKS WITH</div>
    <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:8px;">
      @foreach(['Job Applications','Lease Agreements','Tax Forms','Medical Forms','Registration Forms','Visa Applications','Insurance Forms','Contracts'] as $form)
      <span style="padding:5px 14px;background:#0f0f1a;border:1px solid rgba(255,255,255,.07);
        border-radius:99px;font-size:12px;color:#8888a8;">{{ $form }}</span>
      @endforeach
    </div>
  </div>
</div>

{{-- ── FILL STATE ─────────────────────────────────────────────────── --}}
<div id="state-fill">

  {{-- File banner --}}
  <div id="file-banner">
    <div class="fb-icon">📋</div>
    <div style="flex:1;">
      <div class="fb-name" id="fb-name">form.pdf</div>
      <div class="fb-meta" id="fb-meta">Detecting fields…</div>
    </div>
    <button id="btn-change-file" onclick="resetTool()">✕ Change file</button>
  </div>

  {{-- Fields detected --}}
  <div class="fill-card" id="card-fields">
    <div class="fill-card-title" id="fields-title">Scanning form fields…</div>
    <div class="fill-card-sub" id="fields-sub">Please wait while we analyse your PDF.</div>
    <div id="fields-list"></div>
  </div>

  {{-- User info --}}
  <div class="fill-card">
    <div class="fill-card-title">Your Details</div>
    <div class="fill-card-sub">Write your information in plain text — the AI will match each piece to the right field.</div>
    <textarea id="user-info"
      placeholder="Example: My name is Sarah Johnson. Email: sarah@company.com. Phone: +44 7911 123456. Date of birth: 8 March 1988. Address: 12 Baker Street, London, W1U 6TN. Company: TechCorp Ltd. Job title: Senior Developer. Start date: 1 June 2026."></textarea>
    <button id="btn-fill" onclick="runFill()">✨ Fill Form with AI</button>
  </div>

  {{-- Progress --}}
  <div id="fill-progress" class="fill-card">
    <div class="prog-spin"></div>
    <div class="prog-msg" id="prog-msg">Analysing form fields…</div>
  </div>

  {{-- Result --}}
  <div id="fill-result">
    <div class="result-card">
      <div class="result-title">✅ Form Filled!</div>
      <div class="result-sub" id="result-sub">AI successfully filled your form. Download it below.</div>
      <button id="btn-download-filled" onclick="downloadFilled()">⬇ Download Filled PDF</button>
      <div class="result-fills" id="result-fills"></div>
    </div>
    <button id="btn-try-again" onclick="resetFill()">↩ Fill another form</button>
  </div>

</div>

<script>
/* ═══════════════════════════════════════════════════════════
   LOAD PDF.JS + PDF-LIB
═══════════════════════════════════════════════════════════ */
(function(){
  const s1 = document.createElement('script');
  s1.src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js';
  s1.onload = () => {
    pdfjsLib.GlobalWorkerOptions.workerSrc =
      'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
  };
  document.head.appendChild(s1);
  const s2 = document.createElement('script');
  s2.src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js';
  document.head.appendChild(s2);
})();

/* ═══════════════════════════════════════════════════════════
   STATE
═══════════════════════════════════════════════════════════ */
let pdfFile     = null;
let pdfJsDoc    = null;
let pdfBytes    = null;
let detectedFields = [];
let filledPdfBytes = null;

/* ═══════════════════════════════════════════════════════════
   DRAG & DROP
═══════════════════════════════════════════════════════════ */
const dz = document.getElementById('upload-dz');
dz.addEventListener('dragover',  e => { e.preventDefault(); dz.style.borderColor='#5b5cff'; });
dz.addEventListener('dragleave', () => dz.style.borderColor='');
dz.addEventListener('drop', e => {
  e.preventDefault(); dz.style.borderColor='';
  const f = e.dataTransfer.files[0];
  if (f?.name.toLowerCase().endsWith('.pdf')) handleFile(f);
  else alert('Please drop a PDF file.');
});

/* ═══════════════════════════════════════════════════════════
   HANDLE FILE
═══════════════════════════════════════════════════════════ */
async function handleFile(file) {
  if (!file) return;
  pdfFile = file;

  document.getElementById('state-upload').style.display = 'none';
  document.getElementById('state-fill').style.display   = 'block';
  document.getElementById('fb-name').textContent = file.name;
  document.getElementById('fb-meta').textContent = (file.size / 1024).toFixed(0) + ' KB · Detecting fields…';
  document.getElementById('fields-title').textContent = 'Scanning form fields…';
  document.getElementById('fields-sub').textContent   = 'Please wait…';
  document.getElementById('fields-list').innerHTML    = '';

  await waitForLibs();
  pdfBytes = await file.arrayBuffer();
  pdfJsDoc = await pdfjsLib.getDocument({ data: pdfBytes.slice(0) }).promise;

  detectedFields = await detectAllFields();

  const n = detectedFields.length;
  document.getElementById('fb-meta').textContent =
    `${(file.size/1024).toFixed(0)} KB · ${pdfJsDoc.numPages} page${pdfJsDoc.numPages>1?'s':''}`;

  if (n > 0) {
    const acro   = detectedFields.filter(f => f.source === 'acroform').length;
    const visual = detectedFields.filter(f => f.source === 'visual').length;
    document.getElementById('fields-title').textContent = `${n} form field${n>1?'s':''} detected`;
    document.getElementById('fields-sub').textContent   =
      (acro   ? `${acro} interactive field${acro>1?'s':''} · ` : '') +
      (visual ? `${visual} visual label${visual>1?'s':''}` : '') +
      ' — AI will fill them all.';

    const list = document.getElementById('fields-list');
    detectedFields.forEach(f => {
      const chip = document.createElement('span');
      chip.className = 'field-chip' + (f.source === 'visual' ? ' visual' : '');
      chip.textContent = f.label;
      list.appendChild(chip);
    });
  } else {
    document.getElementById('fields-title').textContent = 'No standard form fields found';
    document.getElementById('fields-sub').textContent   =
      'This PDF has no interactive fields. AI will scan the text for common labels and add filled text boxes.';
  }
}

/* ═══════════════════════════════════════════════════════════
   DETECT FIELDS — works entirely in PDF point space
   (i.transform[4/5] are PDF coords; no viewport conversion)
═══════════════════════════════════════════════════════════ */
async function detectAllFields() {
  const fields = [];
  const totalPages = pdfJsDoc.numPages;

  const LABEL_RE = /^(name|first|last|middle|full name|email|e-mail|phone|mobile|cell|fax|date|dob|date of birth|birth|address|street|city|state|zip|postal|country|company|organization|org|title|position|designation|signature|gender|nationality|passport|id|ssn|tax|website|note|comment|occupation|dept|department|employee|salary|age|building|room|floor|district|institute|discipline|subject|section|roll|reg|registration|administrative|mobile phone)\b/i;

  for (let p = 1; p <= totalPages; p++) {
    const page  = await pdfJsDoc.getPage(p);
    const vp1   = page.getViewport({ scale: 1 });
    const pageW = vp1.width;    // PDF points
    const pageH = vp1.height;   // PDF points

    /* 1 — AcroForm Widget annotations (already in PDF point space) */
    try {
      const annots  = await page.getAnnotations();
      const widgets = annots.filter(a => a.subtype === 'Widget' && a.fieldName);
      for (const w of widgets) {
        if (w.fieldType === 'Btn' && w.radioButton !== undefined) continue;
        const [x1,y1,x2,y2] = w.rect;
        const rw = Math.abs(x2-x1), rh = Math.abs(y2-y1);
        if (rw < 4 || rh < 4) continue;
        fields.push({
          pageNum: p, source: 'acroform',
          label: w.fieldName.split('.').pop() || w.fieldName,
          pdfRect: w.rect, pageW, pageH,
        });
      }
    } catch(_) {}

    /* 2 — Visual labels — pure PDF point space */
    if (!fields.some(f => f.pageNum === p && f.source === 'acroform')) {
      try {
        const tc = await page.getTextContent();

        // All items in PDF point space
        // i.transform = [a,b,c,d,e,f] — e=x, f=baseline-y (y increases upward in PDF)
        // font height ≈ |d| (scale factor)
        const pts = tc.items
          .filter(i => i.str)
          .map(i => ({
            str : i.str,
            x   : i.transform[4],           // left edge in PDF pts
            y   : i.transform[5],           // baseline (PDF: y up)
            w   : Math.abs(i.width),        // PDF pts
            h   : Math.abs(i.transform[3]) || Math.abs(i.transform[0]) || 10,
          }))
          .filter(i => i.h > 0);

        // Group into logical words/blocks on the same baseline
        pts.sort((a,b) => Math.abs(a.y-b.y) > a.h*.4 ? b.y-a.y : a.x-b.x); // top→bottom, left→right
        const blocks = [], grp = [pts[0]];
        for (let i = 1; i < pts.length; i++) {
          const c = pts[i], l = grp[grp.length-1];
          if (Math.abs(c.y - l.y) < l.h*.4 && c.x - (l.x+l.w) < l.h*1.8) grp.push(c);
          else { blocks.push(pdfMerge(grp)); grp.length=0; grp.push(c); }
        }
        if (grp.length) blocks.push(pdfMerge(grp));

        const seen = new Set();
        for (const b of blocks) {
          const txt      = b.str.trim();
          const cleanTxt = txt.replace(/[:\s_.\-]+$/, '').trim();
          if (!cleanTxt || cleanTxt.length < 2 || txt.length > 90) continue;
          if (seen.has(cleanTxt.toLowerCase())) continue;

          const selfColon = /:\s*$/.test(txt);
          const isKeyword = LABEL_RE.test(cleanTxt.replace(/[\/\-]/g,' '));
          if (!selfColon && !isKeyword) continue;

          // ── Find rightmost colon on the same baseline in raw pts ──
          const sameLine = pts.filter(ri =>
            Math.abs(ri.y - b.y) < b.h * 0.7 &&   // same line (PDF y)
            ri.x >= b.x                              // at or right of label start
          ).sort((a,c) => a.x - c.x);

          const colonItems     = sameLine.filter(ri => ri.str.includes(':'));
          const rightmostColon = colonItems[colonItems.length - 1];

          // ── Compute fill position in PDF points ──
          let fillPdfX, fillPdfW;
          if (selfColon) {
            fillPdfX = b.x + b.w + 2;
            fillPdfW = pageW - fillPdfX - 15;
          } else if (rightmostColon) {
            fillPdfX = rightmostColon.x + rightmostColon.w + 3;
            fillPdfW = pageW - fillPdfX - 15;
          } else {
            fillPdfX = b.x + b.w + 5;
            fillPdfW = Math.max(60, pageW - fillPdfX - 15);
          }

          if (fillPdfX + 15 > pageW) continue;

          seen.add(cleanTxt.toLowerCase());
          fields.push({
            pageNum: p, source: 'visual',
            label   : cleanTxt,
            fillPdfX,
            fillPdfY: b.y,       // baseline — used directly by pdf-lib drawText
            fillPdfW,
            fillPdfH: b.h,
            fillPdfFs: Math.max(7, Math.min(b.h * 0.72, 11)),
            pageW, pageH,
          });
        }
      } catch(_) {}
    }
  }
  return fields;
}

function pdfMerge(g) {
  return {
    str: g.map(i=>i.str).join(''),
    x  : Math.min(...g.map(i=>i.x)),
    y  : g[0].y,  // baseline from first item
    w  : Math.max(...g.map(i=>i.x+i.w)) - Math.min(...g.map(i=>i.x)),
    h  : Math.max(...g.map(i=>i.h)),
  };
}

// ── kept for pdf-text-editor compat ──
function groupBlocks(items, viewport) {
  const pts = items.filter(i => i.str?.trim()).map(i => {
    const tx = pdfjsLib.Util.transform(viewport.transform, i.transform);
    const fh = Math.sqrt(tx[2]*tx[2] + tx[3]*tx[3]);
    return { str:i.str, x:tx[4], y:tx[5]-fh, bottom:tx[5], w:Math.abs(i.width*viewport.scale), h:fh };
  }).filter(i => i.w > 0 && i.h > 0);
  if (!pts.length) return [];
  pts.sort((a,b) => Math.abs(a.bottom-b.bottom) > a.h*.4 ? a.bottom-b.bottom : a.x-b.x);
  const blocks=[], grp=[pts[0]];
  for (let i=1; i<pts.length; i++) {
    const c=pts[i], l=grp[grp.length-1];
    if (Math.abs(c.bottom-l.bottom)<l.h*.4 && c.x-(l.x+l.w)<l.h*1.8) grp.push(c);
    else { blocks.push(merge(grp)); grp.length=0; grp.push(c); }
  }
  blocks.push(merge(grp));
  return blocks;
}
function merge(g) {
  return { str:g.map(i=>i.str).join(''),
    x:Math.min(...g.map(i=>i.x)), y:Math.min(...g.map(i=>i.y)),
    w:Math.max(...g.map(i=>i.x+i.w))-Math.min(...g.map(i=>i.x)),
    h:Math.max(...g.map(i=>i.bottom))-Math.min(...g.map(i=>i.y)) };
}

/* ═══════════════════════════════════════════════════════════
   RUN FILL
═══════════════════════════════════════════════════════════ */
async function runFill() {
  const userInfo = document.getElementById('user-info').value.trim();
  if (!userInfo) { alert('Please enter your details first.'); return; }

  document.getElementById('btn-fill').disabled = true;
  showPanel('fill-progress');
  setMsg('Asking AI to fill your form…');

  try {
    /* Step 1 — call AI */
    const fieldLabels = detectedFields.length
      ? [...new Set(detectedFields.map(f => f.label))].join(', ')
      : 'Full Name, First Name, Last Name, Email Address, Phone Number, Date, Company, Address, City, State, ZIP Code, Country, Job Title, Date of Birth, Signature';

    const fd = new FormData();
    fd.append('field_labels', fieldLabels);
    fd.append('user_info', userInfo);
    fd.append('_token', document.querySelector('meta[name=csrf-token]')?.content || '');

    const resp = await fetch('/api/ai/form-fill', { method:'POST', body:fd });
    const data = await resp.json();
    if (data.error === 'pro_required' || data.error === 'free_limit_reached') { showProModal(); return; }
    if (!resp.ok || data.error) throw new Error(data.error || 'AI error');

    const fills = data.fills || {};
    const filled = Object.entries(fills).filter(([,v]) => v?.trim());
    if (!filled.length) throw new Error('AI could not match any fields. Try adding more detail to your description.');

    setMsg('Building filled PDF…');

    /* Step 2 — apply fills with pdf-lib */
    await waitForLibs();
    const { PDFDocument, StandardFonts, rgb } = PDFLib;

    // Load a fresh copy — never flatten, just draw text over field areas
    const doc = await PDFDocument.load(pdfBytes, { ignoreEncryption: true });
    const font = await doc.embedFont(StandardFonts.Helvetica);
    const fontBold = await doc.embedFont(StandardFonts.HelveticaBold);

    let placedCount = 0;

    if (detectedFields.length > 0) {
      for (const field of detectedFields) {
        const value = fills[field.label] || '';
        if (!value?.trim()) continue;

        const pdfPage = doc.getPage(field.pageNum - 1);

        if (field.source === 'acroform' && field.pdfRect) {
          // Cover the existing field widget with white, then draw text on top
          const [x1,y1,x2,y2] = field.pdfRect;
          const rx = Math.min(x1,x2), ry = Math.min(y1,y2);
          const rw = Math.abs(x2-x1), rh = Math.abs(y2-y1);
          const fs = Math.max(7, Math.min(rh * 0.55, 12));
          pdfPage.drawRectangle({ x:rx, y:ry, width:rw, height:rh, color:rgb(1,1,1), opacity:1 });
          pdfPage.drawText(value.slice(0, 100), {
            x: rx + 3, y: ry + (rh - fs) / 2 + 1,
            size: fs, font, color: rgb(0,0,0), maxWidth: rw - 6,
          });
          placedCount++;
        } else if (field.fillPdfX !== undefined) {
          pdfPage.drawText(value.slice(0, 80), {
            x: field.fillPdfX, y: field.fillPdfY,
            size: field.fillPdfFs, font, color: rgb(0,0,0), maxWidth: field.fillPdfW,
          });
          placedCount++;
        }
      }
    } else {
      // No detected fields — write fills as a summary block on page 1
      const page = doc.getPage(0);
      const { width:pw, height:ph } = page.getSize();
      let curY = ph - 50;
      page.drawText('Filled Details', { x:50, y:curY, size:13, font:fontBold, color:rgb(.22,.22,.9) });
      curY -= 22;
      for (const [k,v] of filled) {
        if (curY < 50) break;
        page.drawText(`${k}: ${v}`, { x:50, y:curY, size:10, font, color:rgb(0,0,0), maxWidth:pw-100 });
        curY -= 16;
        placedCount++;
      }
    }

    filledPdfBytes = await doc.save({ useObjectStreams: false });

    /* Step 3 — show result */
    showPanel('fill-result');
    document.getElementById('result-sub').textContent =
      `AI filled ${placedCount} field${placedCount!==1?'s':''} in your form. Download it below.`;

    const rows = filled.map(([k,v]) =>
      `<div class="rf-row"><span class="rf-key">${k}</span><span class="rf-val">${v}</span></div>`
    ).join('');
    document.getElementById('result-fills').innerHTML = rows;

  } catch(err) {
    showPanel('none');
    document.getElementById('btn-fill').disabled = false;
    alert('Error: ' + err.message);
  }
}

function downloadFilled() {
  if (!filledPdfBytes) return;
  const blob = new Blob([filledPdfBytes], { type:'application/pdf' });
  const url  = URL.createObjectURL(blob);
  const a    = document.createElement('a');
  a.href = url; a.download = 'filled-' + (pdfFile?.name || 'form.pdf'); a.click();
  setTimeout(() => URL.revokeObjectURL(url), 3000);
}

/* ═══════════════════════════════════════════════════════════
   HELPERS
═══════════════════════════════════════════════════════════ */
function showPanel(id) {
  ['fill-progress','fill-result'].forEach(p => {
    document.getElementById(p).style.display = (p === id) ? 'block' : 'none';
  });
  document.getElementById('card-fields').style.display =
    (id === 'fill-result') ? 'none' : 'block';
  document.querySelector('.fill-card:has(#user-info)').style.display =
    (id === 'fill-result' || id === 'fill-progress') ? 'none' : 'block';
}

function setMsg(msg) {
  document.getElementById('prog-msg').textContent = msg;
}

function resetFill() {
  showPanel('none');
  document.getElementById('card-fields').style.display = 'block';
  document.querySelector('.fill-card:has(#user-info)').style.display = 'block';
  document.getElementById('btn-fill').disabled = false;
}

function resetTool() {
  pdfFile=null; pdfJsDoc=null; pdfBytes=null; detectedFields=[]; filledPdfBytes=null;
  document.getElementById('state-fill').style.display  = 'none';
  document.getElementById('state-upload').style.display = 'block';
  document.getElementById('fields-list').innerHTML     = '';
  document.getElementById('user-info').value           = '';
  document.getElementById('formFile').value            = '';
}

async function waitForLibs(ms=8000) {
  const t0 = Date.now();
  while ((!window.pdfjsLib || !window.PDFLib) && Date.now()-t0 < ms)
    await new Promise(r => setTimeout(r,150));
  if (!window.pdfjsLib || !window.PDFLib) throw new Error('PDF libraries failed to load.');
}
</script>
@endsection
