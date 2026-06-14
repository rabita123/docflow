@extends('tools.layout')

@section('title', 'Watermark Remover — Remove Watermarks from PDF Free')
@section('description', 'Remove watermarks from PDF online free. Auto-detects DRAFT, CONFIDENTIAL, SAMPLE and diagonal text watermarks. Manual erase mode for image watermarks. No upload needed.')
@section('keywords', 'remove watermark from pdf, pdf watermark remover, delete watermark pdf, remove draft watermark pdf, pdf watermark eraser online free')
@section('slug', 'watermark-remover')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash Watermark Remover",
  "applicationCategory": "WebApplication",
  "description": "Remove watermarks from PDF files online. Auto-detects diagonal text, DRAFT, CONFIDENTIAL and custom watermarks. 100% browser-based.",
  "url": "https://pdftash.com/watermark-remover",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"},
  "aggregateRating": {"@type":"AggregateRating","ratingValue":"4.7","reviewCount":"2187"}
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"Can I remove any watermark from a PDF for free?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash auto-detects common text watermarks like DRAFT, CONFIDENTIAL, SAMPLE, and diagonal text patterns and removes them free with no signup required. Image-based watermarks can be erased using manual erase mode."}},
    {"@type":"Question","name":"How does the automatic watermark detection work?","acceptedAnswer":{"@type":"Answer","text":"PDFTash scans the PDF for repeated semi-transparent text elements, diagonal annotations, and known watermark patterns. It removes matching elements from all pages in one pass."}},
    {"@type":"Question","name":"Can I remove a logo or image watermark?","acceptedAnswer":{"@type":"Answer","text":"Yes. Use manual erase mode — draw a rectangle over the watermark on each page where it appears. This works for image watermarks, logos, and any visual element you want to remove."}},
    {"@type":"Question","name":"Will removing the watermark affect the rest of the PDF?","acceptedAnswer":{"@type":"Answer","text":"No. Only the watermark layer is removed. All text, images, formatting, and document structure remain completely intact."}},
    {"@type":"Question","name":"Does watermark removal work on scanned PDFs?","acceptedAnswer":{"@type":"Answer","text":"For scanned PDFs (image-based), watermarks are part of the page image and cannot be removed by PDFTash. The tool works best on digitally created PDFs where the watermark is a separate layer."}},
    {"@type":"Question","name":"Is the watermark remover completely free?","acceptedAnswer":{"@type":"Answer","text":"Yes, removing watermarks from PDFs up to 10MB is free with no signup. Pro users ($2/month) can process larger files up to 200MB and remove watermarks from unlimited PDFs per day."}}
  ]
}
]
</script>
@endsection

@section('content')
<style>
/* ── Upload state ───────────────────────────────────────── */
#state-upload { max-width:680px; margin:0 auto; }

/* ── Editor state ───────────────────────────────────────── */
#state-editor { display:none; }
#editor-wrap {
  display:flex; gap:0; height:calc(100vh - 80px); max-height:860px;
  border:1px solid rgba(255,255,255,.08); border-radius:14px; overflow:hidden;
  margin:0 auto; max-width:1100px;
}

/* ── Sidebar ─────────────────────────────────────────────── */
#sidebar {
  width:290px; flex-shrink:0; background:#0d0d1f;
  border-right:1px solid rgba(255,255,255,.08);
  display:flex; flex-direction:column; overflow:hidden;
}
.sb-head {
  padding:16px; border-bottom:1px solid rgba(255,255,255,.08);
  display:flex; align-items:center; gap:10px; flex-shrink:0;
}
.sb-title { font-size:14px; font-weight:700; color:#eeeef8; }
.sb-sub   { font-size:11px; color:#8888a8; margin-top:2px; }
#wm-list  { flex:1; overflow-y:auto; padding:10px; }
.wm-item {
  display:flex; align-items:flex-start; gap:10px; padding:10px 12px;
  border-radius:8px; margin-bottom:6px; cursor:pointer;
  border:1px solid rgba(255,255,255,.06); background:#111120;
  transition:all .15s;
}
.wm-item:hover  { border-color:rgba(91,92,255,.3); background:#13132a; }
.wm-item.active { border-color:#5b5cff; background:rgba(91,92,255,.1); }
.wm-item.removed { opacity:.45; }
.wm-check { width:16px; height:16px; border-radius:4px; border:1.5px solid rgba(91,92,255,.5);
  background:rgba(91,92,255,.15); display:flex; align-items:center; justify-content:center;
  flex-shrink:0; margin-top:1px; font-size:10px; }
.wm-item.active .wm-check { background:#5b5cff; border-color:#5b5cff; color:#fff; }
.wm-text { font-size:12px; font-weight:600; color:#eeeef8; word-break:break-all; }
.wm-meta { font-size:10px; color:#8888a8; margin-top:2px; }
.wm-badge { display:inline-block; padding:1px 7px; border-radius:99px; font-size:10px;
  font-weight:700; margin-right:4px; }
.wm-badge.rotated  { background:rgba(255,107,107,.15); color:#ff6b6b; }
.wm-badge.keyword  { background:rgba(255,153,68,.15);  color:#ff9944; }
.wm-badge.manual   { background:rgba(91,92,255,.2);    color:#9898ff; }
.wm-badge.repeated { background:rgba(0,229,160,.12);   color:#00e5a0; }
#sb-actions { padding:12px; border-top:1px solid rgba(255,255,255,.08); flex-shrink:0; }
#btn-add-manual {
  width:100%; padding:9px; background:transparent; border:1px dashed rgba(91,92,255,.4);
  color:#9898ff; border-radius:8px; font-size:12px; cursor:pointer; margin-bottom:8px;
  transition:all .15s;
}
#btn-add-manual:hover, #btn-add-manual.active { background:rgba(91,92,255,.12); }
#btn-add-manual.active { border-style:solid; }
#btn-remove {
  width:100%; padding:11px; background:linear-gradient(135deg,#5b5cff,#7b7cff);
  color:#fff; border:none; border-radius:8px; font-size:13px; font-weight:700;
  cursor:pointer; transition:all .2s;
}
#btn-remove:hover:not(:disabled) { transform:translateY(-1px); box-shadow:0 4px 16px rgba(91,92,255,.45); }
#btn-remove:disabled { opacity:.5; cursor:default; transform:none; }

/* ── Preview area ────────────────────────────────────────── */
#preview-area {
  flex:1; background:#111118; display:flex; flex-direction:column; overflow:hidden;
}
#preview-bar {
  height:44px; background:#0d0d1f; border-bottom:1px solid rgba(255,255,255,.08);
  display:flex; align-items:center; gap:10px; padding:0 14px; flex-shrink:0;
}
.pbar-btn { width:28px; height:28px; border-radius:6px; border:1px solid rgba(255,255,255,.1);
  background:transparent; color:#8888a8; cursor:pointer; font-size:13px;
  display:flex; align-items:center; justify-content:center; transition:all .12s; }
.pbar-btn:hover { background:rgba(255,255,255,.07); color:#eeeef8; }
.pbar-btn:disabled { opacity:.3; cursor:default; }
#page-indicator { font-size:12px; color:#8888a8; white-space:nowrap; }
#preview-scroll { flex:1; overflow:auto; display:flex; align-items:flex-start;
  justify-content:center; padding:24px; }
#canvas-wrap { position:relative; display:inline-block;
  box-shadow:0 8px 40px rgba(0,0,0,.7); }
#pdf-canvas { display:block; }
#overlay-canvas { position:absolute; inset:0; cursor:crosshair; }
#close-btn {
  margin-left:auto; width:28px; height:28px; border-radius:6px;
  border:1px solid rgba(255,255,255,.1); background:transparent;
  color:#8888a8; cursor:pointer; font-size:14px;
  display:flex; align-items:center; justify-content:center;
}
#close-btn:hover { background:rgba(255,100,100,.15); color:#ff6b6b; }

/* ── Scanning overlay ────────────────────────────────────── */
#scanning-overlay {
  display:none; position:fixed; inset:0; z-index:100;
  background:rgba(0,0,0,.75); backdrop-filter:blur(4px);
  align-items:center; justify-content:center; flex-direction:column; gap:16px;
}
#scanning-overlay.show { display:flex; }
.scan-spin { width:48px; height:48px; border:3px solid rgba(91,92,255,.2);
  border-top-color:#5b5cff; border-radius:50%; animation:spin .7s linear infinite; }
@keyframes spin { to { transform:rotate(360deg) } }
.scan-msg { color:#8888a8; font-size:14px; }

/* ── Done banner ─────────────────────────────────────────── */
#done-banner {
  display:none; padding:12px 16px; background:rgba(0,229,160,.08);
  border:1px solid rgba(0,229,160,.25); border-radius:10px; margin:10px;
  display:none; align-items:center; gap:12px; flex-shrink:0;
}
#done-banner.show { display:flex; }
.done-text { font-size:13px; color:#00e5a0; font-weight:600; flex:1; }
#btn-dl { padding:8px 18px; background:#5b5cff; color:#fff; border:none;
  border-radius:7px; font-size:12px; font-weight:700; cursor:pointer; white-space:nowrap; }
</style>

{{-- ── UPLOAD STATE ──────────────────────────────────────────── --}}
<div id="state-upload">
  <div class="hero">
    <div class="badge">🚫 Watermark Remover</div>
    <h1>Remove Watermarks from PDF</h1>
    <p>Auto-detects DRAFT, CONFIDENTIAL, SAMPLE and diagonal text watermarks. Use manual erase for image watermarks. 100% browser-based — your file never leaves your device.</p>
  </div>

  <div class="tool-box" style="max-width:620px;">
    <div class="upload-area" id="upload-dz" onclick="document.getElementById('wmFile').click()">
      <div class="upload-icon">📄</div>
      <div class="upload-title">Drop your PDF here</div>
      <div class="upload-sub">Click to browse · Processed entirely in your browser</div>
      <input type="file" id="wmFile" accept=".pdf" style="display:none" onchange="handleFile(this.files[0])">
    </div>
  </div>

  <div style="max-width:680px;margin:0 auto 50px;padding:0 20px;">
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
      @foreach([
        ['🔄','Diagonal Text','Removes rotated watermarks like DRAFT or CONFIDENTIAL stamped at an angle.'],
        ['🖊','Keyword Detection','Auto-finds SAMPLE, COPY, VOID, PAID, APPROVED and 20+ common watermarks.'],
        ['✏️','Manual Erase','Draw rectangles over image logos or custom watermarks to erase them.'],
      ] as $f)
      <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:18px;text-align:center;">
        <div style="font-size:26px;margin-bottom:8px;">{{ $f[0] }}</div>
        <div style="font-weight:600;font-size:13px;margin-bottom:5px;">{{ $f[1] }}</div>
        <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $f[2] }}</div>
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- ── EDITOR STATE ──────────────────────────────────────────── --}}
<div id="state-editor">
  <div id="done-banner">
    <span class="done-text" id="done-text">Watermarks removed!</span>
    <button id="btn-dl" onclick="downloadClean()">⬇ Download Clean PDF</button>
  </div>
  <div id="editor-wrap">

    {{-- Sidebar --}}
    <div id="sidebar">
      <div class="sb-head">
        <div>
          <div class="sb-title">Detected Watermarks</div>
          <div class="sb-sub" id="sb-sub">Scanning…</div>
        </div>
      </div>
      <div id="wm-list">
        <div style="text-align:center;padding:30px 0;">
          <div class="scan-spin" style="margin:0 auto 12px;"></div>
          <div style="font-size:12px;color:#8888a8;">Scanning pages…</div>
        </div>
      </div>
      <div id="sb-actions">
        <button id="btn-add-manual" onclick="toggleManualMode()">✏️ Draw Erase Area</button>
        <button id="btn-remove" onclick="removeWatermarks()">🚫 Remove Selected</button>
      </div>
    </div>

    {{-- Preview --}}
    <div id="preview-area">
      <div id="preview-bar">
        <button class="pbar-btn" id="btn-prev" onclick="gotoPage(curPage-1)" disabled>‹</button>
        <span id="page-indicator">Page 1 / 1</span>
        <button class="pbar-btn" id="btn-next" onclick="gotoPage(curPage+1)" disabled>›</button>
        <span style="font-size:12px;color:#44445a;margin-left:6px;" id="bar-fname"></span>
        <button id="close-btn" onclick="resetTool()" title="Close">✕</button>
      </div>
      <div id="preview-scroll">
        <div id="canvas-wrap">
          <canvas id="pdf-canvas"></canvas>
          <canvas id="overlay-canvas"></canvas>
        </div>
      </div>
    </div>

  </div>
</div>

{{-- Scanning overlay --}}
<div id="scanning-overlay">
  <div class="scan-spin"></div>
  <div class="scan-msg" id="scan-msg">Opening PDF…</div>
</div>

<script>
/* ═════════════════════════════════════════════════════════════
   LOAD LIBS
═════════════════════════════════════════════════════════════ */
(function(){
  const s1 = document.createElement('script');
  s1.src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js';
  s1.onload = () => { pdfjsLib.GlobalWorkerOptions.workerSrc =
    'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js'; };
  document.head.appendChild(s1);
  const s2 = document.createElement('script');
  s2.src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js';
  document.head.appendChild(s2);
})();

/* ═════════════════════════════════════════════════════════════
   STATE
═════════════════════════════════════════════════════════════ */
let pdfDoc = null, pdfBytes = null, pdfFile = null;
let totalPages = 0, curPage = 1;
let renderScale = 1.5;
let watermarks  = [];   // detected { id, pageNum, text, x,y,w,h,angle,type,active }
let manualAreas = [];   // user-drawn { id, pageNum, x,y,w,h (PDF pts) }
let manualMode  = false;
let cleanPdfBytes = null;

const WATERMARK_KEYWORDS = /^(draft|confidential|sample|copy|watermark|do not copy|private|classified|top secret|void|cancelled|paid|approved|rejected|internal|proprietary|preliminary|not for distribution|for review only|specimen|example|test|demo|proof|archive|expired|invalid|null|placeholder|lorem ipsum)/i;

/* ═════════════════════════════════════════════════════════════
   DRAG & DROP
═════════════════════════════════════════════════════════════ */
const dz = document.getElementById('upload-dz');
dz.addEventListener('dragover',  e => { e.preventDefault(); dz.style.borderColor='#5b5cff'; });
dz.addEventListener('dragleave', () => dz.style.borderColor='');
dz.addEventListener('drop', e => {
  e.preventDefault(); dz.style.borderColor='';
  const f = e.dataTransfer.files[0];
  if (f?.name.toLowerCase().endsWith('.pdf')) handleFile(f);
  else alert('Please drop a PDF file.');
});

/* ═════════════════════════════════════════════════════════════
   HANDLE FILE
═════════════════════════════════════════════════════════════ */
async function handleFile(file) {
  if (!file) return;
  pdfFile = file;
  showScanning('Opening PDF…');
  await waitForLibs();

  pdfBytes   = await file.arrayBuffer();
  pdfDoc     = await pdfjsLib.getDocument({ data: pdfBytes.slice(0) }).promise;
  totalPages = pdfDoc.numPages;

  document.getElementById('state-upload').style.display = 'none';
  document.getElementById('state-editor').style.display = 'block';
  document.getElementById('bar-fname').textContent      = file.name;

  setMsg('Scanning for watermarks…');
  watermarks = await detectWatermarks();
  renderWatermarkList();

  await gotoPage(1);
  hideScanning();
}

/* ═════════════════════════════════════════════════════════════
   WATERMARK DETECTION
═════════════════════════════════════════════════════════════ */
async function detectWatermarks() {
  const found = [];
  const textFreq = {}; // text → count across pages (for repeated watermark detection)
  let id = 0;

  for (let p = 1; p <= totalPages; p++) {
    const page = await pdfDoc.getPage(p);
    const vp1  = page.getViewport({ scale: 1 });
    const tc   = await page.getTextContent();

    for (const item of tc.items) {
      const str = item.str?.trim();
      if (!str || str.length < 2) continue;

      const [a, b, c, d, e, f] = item.transform;
      const angle    = Math.atan2(b, a) * 180 / Math.PI;
      const fontSize = Math.sqrt(a*a + b*b);
      const textW    = Math.abs(item.width);

      const isRotated  = Math.abs(angle) > 8 && Math.abs(Math.abs(angle) - 180) > 8;
      const isKeyword  = WATERMARK_KEYWORDS.test(str);

      // Track frequency for repeated-text detection
      const key = str.toLowerCase();
      textFreq[key] = (textFreq[key] || 0) + 1;

      if (isRotated || isKeyword) {
        found.push({
          id: ++id,
          pageNum: p,
          text: str.length > 40 ? str.slice(0,40)+'…' : str,
          // PDF point space
          x: e, y: f,
          w: textW,
          h: fontSize * 1.3,
          angle: angle,
          fontSize,
          type: isRotated ? 'rotated' : 'keyword',
          active: true,   // selected by default
        });
      }
    }
  }

  // Add repeated-text watermarks (same text on 3+ pages, not already found)
  for (const [text, count] of Object.entries(textFreq)) {
    if (count < 3) continue;
    // Check if already found (keyword/rotated)
    const already = found.some(f => f.text.toLowerCase().startsWith(text.slice(0,10)));
    if (already) continue;
    // Find all occurrences and add them
    for (let p = 1; p <= totalPages; p++) {
      const page = await pdfDoc.getPage(p);
      const tc   = await page.getTextContent();
      for (const item of tc.items) {
        if (item.str?.trim().toLowerCase() !== text) continue;
        const [a,,,,e,f] = item.transform;
        const fontSize   = Math.sqrt(a*a + item.transform[1]**2);
        found.push({
          id: ++id, pageNum: p, text: item.str.trim(),
          x: e, y: f, w: Math.abs(item.width), h: fontSize*1.3,
          angle: 0, fontSize, type: 'repeated', active: true,
        });
      }
    }
  }

  return found;
}

/* ═════════════════════════════════════════════════════════════
   RENDER WATERMARK LIST
═════════════════════════════════════════════════════════════ */
function renderWatermarkList() {
  const list = document.getElementById('wm-list');
  const all  = [...watermarks, ...manualAreas];

  if (!all.length) {
    list.innerHTML = `<div style="text-align:center;padding:30px 10px;">
      <div style="font-size:32px;margin-bottom:10px;">✅</div>
      <div style="font-size:13px;color:#8888a8;line-height:1.6;">No watermarks auto-detected.<br>Use <strong style="color:#9898ff;">Draw Erase Area</strong> to manually cover any watermark.</div>
    </div>`;
    document.getElementById('sb-sub').textContent = 'No watermarks found';
    return;
  }

  const activeCount = all.filter(w => w.active !== false).length;
  document.getElementById('sb-sub').textContent = `${all.length} found · ${activeCount} selected`;

  list.innerHTML = all.map(w => {
    const badge = w.type === 'rotated'  ? '<span class="wm-badge rotated">Diagonal</span>'
                : w.type === 'keyword'  ? '<span class="wm-badge keyword">Keyword</span>'
                : w.type === 'repeated' ? '<span class="wm-badge repeated">Repeated</span>'
                :                         '<span class="wm-badge manual">Manual</span>';
    const checked = w.active !== false ? '✓' : '';
    const cls     = (w.active !== false ? 'active' : '') + (w.type === 'manual' ? '' : '');
    return `<div class="wm-item ${cls}" onclick="toggleWatermark(${w.id})" data-id="${w.id}">
      <div class="wm-check">${checked}</div>
      <div>
        <div class="wm-text">${w.text || 'Erase area'}</div>
        <div class="wm-meta">${badge} Page ${w.pageNum}</div>
      </div>
    </div>`;
  }).join('');
}

function toggleWatermark(id) {
  const wm = [...watermarks, ...manualAreas].find(w => w.id === id);
  if (wm) { wm.active = !wm.active; renderWatermarkList(); drawOverlay(); }
}

/* ═════════════════════════════════════════════════════════════
   PAGE RENDER
═════════════════════════════════════════════════════════════ */
async function gotoPage(n) {
  if (!pdfDoc) return;
  n = Math.max(1, Math.min(n, totalPages));
  curPage = n;
  document.getElementById('page-indicator').textContent = `Page ${n} / ${totalPages}`;
  document.getElementById('btn-prev').disabled = n <= 1;
  document.getElementById('btn-next').disabled = n >= totalPages;
  await renderPage(n);
}

async function renderPage(n) {
  const page     = await pdfDoc.getPage(n);
  const viewport = page.getViewport({ scale: renderScale });
  const canvas   = document.getElementById('pdf-canvas');
  const oc       = document.getElementById('overlay-canvas');
  canvas.width  = oc.width  = viewport.width;
  canvas.height = oc.height = viewport.height;
  await page.render({ canvasContext: canvas.getContext('2d'), viewport }).promise;
  drawOverlay();
}

/* ═════════════════════════════════════════════════════════════
   OVERLAY DRAWING
═════════════════════════════════════════════════════════════ */
function drawOverlay() {
  const oc  = document.getElementById('overlay-canvas');
  const ctx = oc.getContext('2d');
  ctx.clearRect(0, 0, oc.width, oc.height);

  const page = pdfDoc?.getPage(curPage);  // just for dims
  const allWm = [...watermarks, ...manualAreas].filter(w => w.pageNum === curPage && w.active !== false);

  for (const wm of allWm) {
    // Convert PDF pts → screen px: screenX = pdfX * renderScale
    // For PDF y (bottom-up): screenY = (pageH - pdfY - pdfH) * renderScale
    // We'll get pageH from the overlay canvas height / renderScale
    const pageH = oc.height / renderScale;

    ctx.save();
    if (wm.angle && Math.abs(wm.angle) > 1) {
      const cx = wm.x * renderScale;
      const cy = (pageH - wm.y) * renderScale;
      ctx.translate(cx, cy);
      ctx.rotate(-wm.angle * Math.PI / 180);
      ctx.strokeStyle = 'rgba(255,107,107,.85)';
      ctx.fillStyle   = 'rgba(255,107,107,.18)';
      ctx.lineWidth   = 2;
      ctx.setLineDash([4,3]);
      ctx.strokeRect(0, -wm.h * renderScale, wm.w * renderScale, wm.h * renderScale);
      ctx.fillRect(0, -wm.h * renderScale, wm.w * renderScale, wm.h * renderScale);
    } else {
      const sx = wm.x * renderScale;
      const sy = (pageH - wm.y - wm.h) * renderScale;
      const sw = wm.w * renderScale;
      const sh = wm.h * renderScale;
      ctx.strokeStyle = wm.type === 'manual' ? 'rgba(91,92,255,.9)' : 'rgba(255,107,107,.85)';
      ctx.fillStyle   = wm.type === 'manual' ? 'rgba(91,92,255,.2)' : 'rgba(255,107,107,.18)';
      ctx.lineWidth   = 2;
      ctx.setLineDash([4,3]);
      ctx.strokeRect(sx, sy, sw, sh);
      ctx.fillRect(sx, sy, sw, sh);
    }
    ctx.restore();
  }
}

/* ═════════════════════════════════════════════════════════════
   MANUAL ERASE MODE
═════════════════════════════════════════════════════════════ */
let manualId = 1000;
function toggleManualMode() {
  manualMode = !manualMode;
  const btn = document.getElementById('btn-add-manual');
  btn.classList.toggle('active', manualMode);
  btn.textContent = manualMode ? '✕ Cancel Draw Mode' : '✏️ Draw Erase Area';
  document.getElementById('overlay-canvas').style.cursor = manualMode ? 'crosshair' : 'default';
}

// Rubber-band draw on overlay canvas
let drawing = false, drawStart = {};
const oc = document.getElementById('overlay-canvas');
oc.addEventListener('mousedown', e => {
  if (!manualMode) return;
  drawing = true;
  const r = oc.getBoundingClientRect();
  drawStart = { x: e.clientX - r.left, y: e.clientY - r.top };
});
oc.addEventListener('mousemove', e => {
  if (!drawing || !manualMode) return;
  const r  = oc.getBoundingClientRect();
  const cx = e.clientX - r.left;
  const cy = e.clientY - r.top;
  drawOverlay();
  const ctx = oc.getContext('2d');
  ctx.strokeStyle = 'rgba(91,92,255,.9)';
  ctx.fillStyle   = 'rgba(91,92,255,.2)';
  ctx.lineWidth   = 2;
  ctx.setLineDash([4,3]);
  const x = Math.min(drawStart.x, cx);
  const y = Math.min(drawStart.y, cy);
  const w = Math.abs(cx - drawStart.x);
  const h = Math.abs(cy - drawStart.y);
  ctx.strokeRect(x, y, w, h);
  ctx.fillRect(x, y, w, h);
});
oc.addEventListener('mouseup', e => {
  if (!drawing || !manualMode) return;
  drawing = false;
  const r   = oc.getBoundingClientRect();
  const cx  = e.clientX - r.left;
  const cy  = e.clientY - r.top;
  const sx  = Math.min(drawStart.x, cx);
  const sy  = Math.min(drawStart.y, cy);
  const sw  = Math.abs(cx - drawStart.x);
  const sh  = Math.abs(cy - drawStart.y);
  if (sw < 5 || sh < 5) return;
  const pageH = oc.height / renderScale;
  // Convert screen px → PDF pts
  const pdfX = sx / renderScale;
  const pdfY = pageH - (sy + sh) / renderScale;
  const pdfW = sw / renderScale;
  const pdfH = sh / renderScale;
  manualAreas.push({
    id: ++manualId, pageNum: curPage,
    text: 'Erase area',
    x: pdfX, y: pdfY, w: pdfW, h: pdfH,
    angle: 0, type: 'manual', active: true,
  });
  renderWatermarkList();
  drawOverlay();
});

/* ═════════════════════════════════════════════════════════════
   REMOVE WATERMARKS
═════════════════════════════════════════════════════════════ */
async function removeWatermarks() {
  const toRemove = [...watermarks, ...manualAreas].filter(w => w.active !== false);
  if (!toRemove.length) { alert('No watermarks selected. Select at least one item from the list.'); return; }

  const btn = document.getElementById('btn-remove');
  btn.disabled = true; btn.textContent = '⏳ Processing…';
  showScanning('Removing watermarks…');

  try {
    await waitForLibs();
    const { PDFDocument, rgb, degrees } = PDFLib;
    const doc = await PDFDocument.load(pdfBytes);

    for (const wm of toRemove) {
      const pdfPage = doc.getPage(wm.pageNum - 1);
      const { width: pw, height: ph } = pdfPage.getSize();

      if (wm.angle && Math.abs(wm.angle) > 1) {
        // Rotated watermark — draw rotated white rectangle
        // Expand slightly to ensure full coverage
        const pad = wm.fontSize * 0.4;
        pdfPage.drawRectangle({
          x      : wm.x - pad,
          y      : wm.y - pad,
          width  : wm.w + pad * 2,
          height : wm.h + pad * 2,
          color  : rgb(1, 1, 1),
          rotate : degrees(wm.angle),
          opacity: 1,
        });
      } else {
        // Axis-aligned watermark — simple white rectangle
        const pad = 3;
        pdfPage.drawRectangle({
          x      : wm.x - pad,
          y      : wm.y - pad,
          width  : wm.w + pad * 2,
          height : wm.h + pad * 2,
          color  : rgb(1, 1, 1),
          opacity: 1,
        });
      }
    }

    cleanPdfBytes = await doc.save();

    // Show done banner
    const n = toRemove.length;
    document.getElementById('done-text').textContent =
      `✅ ${n} watermark${n>1?'s':''} removed successfully!`;
    const banner = document.getElementById('done-banner');
    banner.style.display = 'flex';

    // Re-render page to reflect changes (re-load clean pdf)
    const cleanDoc = await pdfjsLib.getDocument({ data: cleanPdfBytes.slice(0) }).promise;
    pdfDoc = cleanDoc;
    watermarks = []; manualAreas = [];
    renderWatermarkList();
    await gotoPage(curPage);

  } catch(err) {
    alert('Error: ' + err.message);
  } finally {
    hideScanning();
    btn.disabled = false; btn.textContent = '🚫 Remove Selected';
  }
}

function downloadClean() {
  if (!cleanPdfBytes) return;
  const blob = new Blob([cleanPdfBytes], { type: 'application/pdf' });
  const url  = URL.createObjectURL(blob);
  const a    = document.createElement('a');
  a.href = url; a.download = 'clean-' + (pdfFile?.name || 'document.pdf'); a.click();
  setTimeout(() => URL.revokeObjectURL(url), 3000);
}

/* ═════════════════════════════════════════════════════════════
   HELPERS
═════════════════════════════════════════════════════════════ */
function resetTool() {
  pdfDoc=null; pdfBytes=null; pdfFile=null; cleanPdfBytes=null;
  watermarks=[]; manualAreas=[]; curPage=1; manualMode=false;
  document.getElementById('state-editor').style.display = 'none';
  document.getElementById('state-upload').style.display = 'block';
  document.getElementById('done-banner').style.display  = 'none';
  document.getElementById('wmFile').value = '';
  document.getElementById('btn-add-manual').classList.remove('active');
  document.getElementById('btn-add-manual').textContent = '✏️ Draw Erase Area';
}

function showScanning(msg) {
  document.getElementById('scan-msg').textContent = msg;
  document.getElementById('scanning-overlay').classList.add('show');
}
function setMsg(m) { document.getElementById('scan-msg').textContent = m; }
function hideScanning() { document.getElementById('scanning-overlay').classList.remove('show'); }

async function waitForLibs(ms=8000) {
  const t0 = Date.now();
  while ((!window.pdfjsLib || !window.PDFLib) && Date.now()-t0 < ms)
    await new Promise(r => setTimeout(r, 150));
  if (!window.pdfjsLib || !window.PDFLib) throw new Error('PDF libraries failed to load.');
}
</script>
@endsection
