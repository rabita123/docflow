<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Highlight PDF Online Free — Annotate, Underline, Draw | PDFTash</title>
<meta name="description" content="Highlight, underline, strikethrough and annotate any PDF online free. No signup, no upload to server — all processing happens in your browser.">
<meta name="keywords" content="highlight pdf online free, annotate pdf online, underline pdf, pdf highlighter, mark up pdf free">
<link rel="canonical" href="https://pdftash.com/highlight-pdf">
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<meta property="og:title" content="Highlight PDF Online Free | PDFTash">
<meta property="og:description" content="Highlight, underline, and annotate any PDF in your browser. Free, private, no signup.">
<meta property="og:url" content="https://pdftash.com/highlight-pdf">
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"SoftwareApplication","name":"PDF Highlighter","url":"https://pdftash.com/highlight-pdf","applicationCategory":"UtilitiesApplication","operatingSystem":"Any","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"description":"Highlight, underline, and annotate any PDF online free. No signup required."}
</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
:root{
  --bg:#0d0d14;--bg2:#13131e;--bg3:#1a1a28;--bg4:#222233;
  --border:rgba(255,255,255,.07);--border2:rgba(255,255,255,.13);
  --accent:#5b5cff;--text:#eeeef8;--text2:#8888a8;
}
body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;}

/* NAV */
nav{display:flex;align-items:center;justify-content:space-between;padding:14px 32px;background:rgba(13,13,20,.95);backdrop-filter:blur(20px);border-bottom:1px solid var(--border);position:sticky;top:0;z-index:200;}
.nav-logo{display:flex;align-items:center;gap:8px;text-decoration:none;color:var(--text);font-weight:700;font-size:18px;}
.nav-logo img{height:28px;}
.nav-back{display:flex;align-items:center;gap:6px;padding:7px 16px;background:var(--bg3);border:1px solid var(--border2);border-radius:8px;color:var(--text2);font-size:13px;font-weight:500;text-decoration:none;transition:.2s;}
.nav-back:hover{color:var(--text);border-color:var(--accent);}

/* UPLOAD STATE */
#upload-state{max-width:680px;margin:80px auto;padding:0 24px;text-align:center;}
.upload-hero-tag{display:inline-flex;align-items:center;gap:6px;background:rgba(91,92,255,.1);border:1px solid rgba(91,92,255,.25);border-radius:99px;padding:5px 14px;font-size:12px;font-weight:600;color:var(--accent);margin-bottom:24px;}
#upload-state h1{font-size:clamp(28px,5vw,48px);font-weight:800;letter-spacing:-1.5px;line-height:1.1;margin-bottom:16px;}
#upload-state h1 span{background:linear-gradient(135deg,#5b5cff,#a78bfa);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
#upload-state p{color:var(--text2);font-size:16px;line-height:1.7;margin-bottom:40px;max-width:480px;margin-left:auto;margin-right:auto;}
.dropzone{background:var(--bg2);border:2px dashed rgba(91,92,255,.35);border-radius:20px;padding:60px 40px;cursor:pointer;transition:.25s;position:relative;}
.dropzone:hover,.dropzone.drag-over{border-color:var(--accent);background:rgba(91,92,255,.05);}
.dropzone-icon{font-size:48px;margin-bottom:16px;}
.dropzone-title{font-size:18px;font-weight:700;margin-bottom:8px;}
.dropzone-sub{font-size:13px;color:var(--text2);margin-bottom:24px;}
.dropzone-btn{display:inline-flex;align-items:center;gap:8px;padding:12px 28px;background:var(--accent);color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;transition:.2s;}
.dropzone-btn:hover{background:#7475ff;transform:translateY(-1px);}
.trust-pills{display:flex;justify-content:center;flex-wrap:wrap;gap:12px;margin-top:32px;}
.trust-pill{display:flex;align-items:center;gap:6px;background:rgba(255,255,255,.04);border:1px solid var(--border);border-radius:99px;padding:6px 14px;font-size:12px;color:var(--text2);}

/* EDITOR STATE */
#editor-state{display:none;flex-direction:column;height:calc(100vh - 57px);}

/* TOOLBAR */
#toolbar{display:flex;align-items:center;gap:4px;padding:8px 16px;background:var(--bg2);border-bottom:1px solid var(--border);flex-wrap:wrap;flex-shrink:0;}
.tb-sep{width:1px;height:28px;background:var(--border2);margin:0 4px;}
.tb-label{font-size:11px;color:var(--text2);font-weight:600;margin-right:4px;white-space:nowrap;}
.tb-btn{display:flex;align-items:center;gap:5px;padding:6px 12px;border:1px solid transparent;border-radius:7px;background:none;color:var(--text2);font-size:12px;font-weight:500;cursor:pointer;transition:.15s;white-space:nowrap;}
.tb-btn:hover{background:var(--bg3);color:var(--text);border-color:var(--border2);}
.tb-btn.active{background:rgba(91,92,255,.15);color:var(--accent);border-color:rgba(91,92,255,.4);}
.color-swatch{width:22px;height:22px;border-radius:5px;border:2px solid transparent;cursor:pointer;transition:.15s;flex-shrink:0;}
.color-swatch:hover,.color-swatch.active{border-color:#fff;transform:scale(1.15);}
.tb-download{margin-left:auto;display:flex;align-items:center;gap:6px;padding:7px 18px;background:var(--accent);color:#fff;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;transition:.2s;}
.tb-download:hover{background:#7475ff;}
#thickness-slider{width:80px;accent-color:var(--accent);}

/* MAIN AREA */
#main-area{display:flex;flex:1;overflow:hidden;}

/* THUMBNAILS */
#thumbs-panel{width:88px;background:var(--bg2);border-right:1px solid var(--border);overflow-y:auto;padding:10px 6px;display:flex;flex-direction:column;gap:8px;flex-shrink:0;}
.thumb-item{cursor:pointer;border-radius:6px;overflow:hidden;border:2px solid transparent;transition:.15s;background:var(--bg3);}
.thumb-item.active{border-color:var(--accent);}
.thumb-item canvas{width:100%;display:block;}
.thumb-num{text-align:center;font-size:10px;color:var(--text2);padding:3px 0;}

/* CANVAS AREA */
#canvas-area{flex:1;overflow:auto;background:#525659;display:flex;flex-direction:column;align-items:center;padding:24px;gap:24px;}
.page-wrapper{position:relative;box-shadow:0 8px 40px rgba(0,0,0,.6);line-height:0;}
.page-wrapper canvas{display:block;}
.anno-canvas{position:absolute;top:0;left:0;cursor:crosshair;}

/* SIZE CONTROL */
#zoom-ctrl{display:flex;align-items:center;gap:6px;}
#zoom-ctrl button{background:var(--bg3);border:1px solid var(--border2);border-radius:6px;color:var(--text);padding:4px 10px;cursor:pointer;font-size:14px;}
#zoom-ctrl span{font-size:12px;color:var(--text2);min-width:40px;text-align:center;}
</style>
</head>
<body>

<nav>
  <a href="/" class="nav-logo">
    <img src="/logo.svg" alt="PDFTash">
    <span>PDFTash</span>
  </a>
  <a href="/" class="nav-back">← All Tools</a>
</nav>

<!-- UPLOAD STATE -->
<div id="upload-state">
  <div class="upload-hero-tag">✨ Free — No Signup — Runs in Browser</div>
  <h1>Highlight & Annotate<br><span>Any PDF Free</span></h1>
  <p>Highlight text, underline, strikethrough, draw freehand, and add text notes. All processing happens in your browser — your files never leave your device.</p>

  <div class="dropzone" id="dropzone">
    <div class="dropzone-icon">🖊️</div>
    <div class="dropzone-title">Drop your PDF here</div>
    <div class="dropzone-sub">or click to browse · No file size limit · 100% private</div>
    <button class="dropzone-btn" onclick="event.stopPropagation(); document.getElementById('file-input').click()">
      📂 Choose PDF File
    </button>
    <input type="file" id="file-input" accept=".pdf" style="display:none">
  </div>

  <div class="trust-pills">
    <div class="trust-pill">🔒 Processed in your browser</div>
    <div class="trust-pill">🚫 No upload to server</div>
    <div class="trust-pill">⚡ Instant — no waiting</div>
    <div class="trust-pill">💸 100% free</div>
  </div>
</div>

<!-- EDITOR STATE -->
<div id="editor-state">

  <!-- TOOLBAR -->
  <div id="toolbar">
    <span class="tb-label">TOOL</span>
    <button class="tb-btn active" id="tool-highlight" onclick="setTool('highlight')" title="Highlight">🖊 Highlight</button>
    <button class="tb-btn" id="tool-underline" onclick="setTool('underline')" title="Underline">U̲ Underline</button>
    <button class="tb-btn" id="tool-strikethrough" onclick="setTool('strikethrough')" title="Strikethrough">S̶ Strikethrough</button>
    <button class="tb-btn" id="tool-pen" onclick="setTool('pen')" title="Freehand Draw">✏️ Draw</button>
    <button class="tb-btn" id="tool-rectangle" onclick="setTool('rectangle')" title="Rectangle">▭ Rectangle</button>
    <button class="tb-btn" id="tool-text" onclick="setTool('text')" title="Add Text">T Text</button>
    <button class="tb-btn" id="tool-eraser" onclick="setTool('eraser')" title="Eraser">⌫ Eraser</button>

    <div class="tb-sep"></div>
    <span class="tb-label">COLOR</span>
    <div id="color-swatches" style="display:flex;gap:5px;align-items:center;">
      <div class="color-swatch active" style="background:#FFE033;" data-color="#FFE033" onclick="setColor('#FFE033',this)" title="Yellow"></div>
      <div class="color-swatch" style="background:#6EE7B7;" data-color="#6EE7B7" onclick="setColor('#6EE7B7',this)" title="Green"></div>
      <div class="color-swatch" style="background:#FCA5A5;" data-color="#FCA5A5" onclick="setColor('#FCA5A5',this)" title="Pink"></div>
      <div class="color-swatch" style="background:#93C5FD;" data-color="#93C5FD" onclick="setColor('#93C5FD',this)" title="Blue"></div>
      <div class="color-swatch" style="background:#C4B5FD;" data-color="#C4B5FD" onclick="setColor('#C4B5FD',this)" title="Purple"></div>
      <div class="color-swatch" style="background:#F97316;" data-color="#F97316" onclick="setColor('#F97316',this)" title="Orange"></div>
      <input type="color" id="custom-color" value="#FFE033" title="Custom color" style="width:22px;height:22px;border:none;border-radius:5px;cursor:pointer;background:none;padding:0;" onchange="setColor(this.value,null)">
    </div>

    <div class="tb-sep"></div>
    <span class="tb-label">SIZE</span>
    <input type="range" id="thickness-slider" min="1" max="40" value="16" oninput="setThickness(this.value)">
    <span id="thickness-label" style="font-size:12px;color:var(--text2);min-width:28px;">16</span>

    <div class="tb-sep"></div>
    <div id="zoom-ctrl">
      <button onclick="zoom(-0.2)">−</button>
      <span id="zoom-label">100%</span>
      <button onclick="zoom(0.2)">+</button>
    </div>

    <div class="tb-sep"></div>
    <button class="tb-btn" onclick="undoLast()" title="Undo">↩ Undo</button>
    <button class="tb-btn" onclick="clearPage()" title="Clear page annotations">🗑 Clear</button>

    <button class="tb-download" onclick="downloadPDF()">⬇ Download PDF</button>
  </div>

  <div id="main-area">
    <div id="thumbs-panel"></div>
    <div id="canvas-area"></div>
  </div>
</div>

<!-- PDF.js + jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

let pdfDoc = null;
let pdfBytes = null;
let currentTool = 'highlight';
let currentColor = '#FFE033';
let thickness = 16;
let scale = 1.5;
let currentPage = 1;

// Per-page annotation strokes
// strokes[pageNum] = [{tool, color, thickness, points:[{x,y}], ...}]
const strokes = {};
let drawing = false;
let currentStroke = null;
let startX, startY;

// Canvas refs: pageCanvases[n] = {pdf: canvas, anno: canvas}
const pageCanvases = {};

// ── File input ──────────────────────────────────────────────────────────────
document.getElementById('file-input').addEventListener('change', e => {
  const file = e.target.files[0];
  if (file) loadPDF(file);
});

const dz = document.getElementById('dropzone');
dz.addEventListener('click', () => document.getElementById('file-input').click());
dz.addEventListener('dragover', e => { e.preventDefault(); dz.classList.add('drag-over'); });
dz.addEventListener('dragleave', () => dz.classList.remove('drag-over'));
dz.addEventListener('drop', e => {
  e.preventDefault(); dz.classList.remove('drag-over');
  const file = e.dataTransfer.files[0];
  if (file && file.type === 'application/pdf') loadPDF(file);
});

async function loadPDF(file) {
  const reader = new FileReader();
  reader.onload = async (e) => {
    pdfBytes = new Uint8Array(e.target.result);
    pdfDoc = await pdfjsLib.getDocument({ data: pdfBytes }).promise;
    document.getElementById('upload-state').style.display = 'none';
    document.getElementById('editor-state').style.display = 'flex';
    await renderAllPages();
  };
  reader.readAsArrayBuffer(file);
}

async function renderAllPages() {
  const thumbsPanel = document.getElementById('thumbs-panel');
  const canvasArea  = document.getElementById('canvas-area');
  thumbsPanel.innerHTML = '';
  canvasArea.innerHTML  = '';

  for (let i = 1; i <= pdfDoc.numPages; i++) {
    const page = await pdfDoc.getPage(i);
    const vp   = page.getViewport({ scale });

    // Main page wrapper
    const wrapper = document.createElement('div');
    wrapper.className = 'page-wrapper';
    wrapper.id = 'page-wrapper-' + i;
    wrapper.style.width  = vp.width + 'px';
    wrapper.style.height = vp.height + 'px';

    // PDF render canvas
    const pdfCanvas = document.createElement('canvas');
    pdfCanvas.width  = vp.width;
    pdfCanvas.height = vp.height;
    await page.render({ canvasContext: pdfCanvas.getContext('2d'), viewport: vp }).promise;

    // Annotation canvas on top
    const annoCanvas = document.createElement('canvas');
    annoCanvas.className = 'anno-canvas';
    annoCanvas.width  = vp.width;
    annoCanvas.height = vp.height;
    annoCanvas.dataset.page = i;

    wrapper.appendChild(pdfCanvas);
    wrapper.appendChild(annoCanvas);
    canvasArea.appendChild(wrapper);

    pageCanvases[i] = { pdf: pdfCanvas, anno: annoCanvas, viewport: vp };
    strokes[i] = [];

    // Annotation events
    annoCanvas.addEventListener('mousedown', e => startDraw(e, i));
    annoCanvas.addEventListener('mousemove', e => continueDraw(e, i));
    annoCanvas.addEventListener('mouseup',   e => endDraw(e, i));
    annoCanvas.addEventListener('mouseleave',e => endDraw(e, i));
    annoCanvas.addEventListener('touchstart', e => startDraw(touchToMouse(e, annoCanvas), i), {passive:false});
    annoCanvas.addEventListener('touchmove',  e => { e.preventDefault(); continueDraw(touchToMouse(e, annoCanvas), i); }, {passive:false});
    annoCanvas.addEventListener('touchend',   e => endDraw(e, i));

    // Thumbnail
    const thumbItem = document.createElement('div');
    thumbItem.className = 'thumb-item' + (i === 1 ? ' active' : '');
    thumbItem.id = 'thumb-' + i;
    thumbItem.onclick = () => {
      document.getElementById('page-wrapper-' + i).scrollIntoView({ behavior: 'smooth', block: 'start' });
      document.querySelectorAll('.thumb-item').forEach(t => t.classList.remove('active'));
      thumbItem.classList.add('active');
    };
    const thumbCanvas = document.createElement('canvas');
    const thumbScale  = 72 / vp.width;
    const thumbVP     = page.getViewport({ scale: thumbScale });
    thumbCanvas.width  = thumbVP.width;
    thumbCanvas.height = thumbVP.height;
    await page.render({ canvasContext: thumbCanvas.getContext('2d'), viewport: thumbVP }).promise;
    const thumbNum = document.createElement('div');
    thumbNum.className = 'thumb-num';
    thumbNum.textContent = i;
    thumbItem.appendChild(thumbCanvas);
    thumbItem.appendChild(thumbNum);
    thumbsPanel.appendChild(thumbItem);
  }
}

function touchToMouse(e, canvas) {
  const touch = e.touches[0] || e.changedTouches[0];
  const rect = canvas.getBoundingClientRect();
  return { clientX: touch.clientX, clientY: touch.clientY, _rect: rect };
}

function getPos(e, canvas) {
  const rect = canvas ? canvas.getBoundingClientRect() : e._rect;
  const scaleX = canvas ? canvas.width / rect.width : 1;
  const scaleY = canvas ? canvas.height / rect.height : 1;
  return {
    x: (e.clientX - rect.left) * scaleX,
    y: (e.clientY - rect.top)  * scaleY
  };
}

function startDraw(e, page) {
  const canvas = pageCanvases[page].anno;
  const pos = getPos(e, canvas);
  drawing = true;
  startX = pos.x; startY = pos.y;

  if (currentTool === 'text') {
    const text = prompt('Enter text:');
    if (!text) { drawing = false; return; }
    strokes[page].push({ tool:'text', color:currentColor, thickness, x:pos.x, y:pos.y, text });
    redrawPage(page);
    drawing = false;
    return;
  }

  currentStroke = { tool: currentTool, color: currentColor, thickness, points:[{x:pos.x,y:pos.y}] };
}

function continueDraw(e, page) {
  if (!drawing || !currentStroke) return;
  const canvas = pageCanvases[page].anno;
  const pos = getPos(e, canvas);

  if (currentTool === 'pen' || currentTool === 'eraser') {
    currentStroke.points.push({x:pos.x, y:pos.y});
  } else {
    currentStroke.endX = pos.x;
    currentStroke.endY = pos.y;
  }
  redrawPage(page, currentStroke);
}

function endDraw(e, page) {
  if (!drawing || !currentStroke) return;
  drawing = false;
  strokes[page].push(currentStroke);
  currentStroke = null;
  redrawPage(page);
}

function redrawPage(page, liveStroke) {
  const canvas = pageCanvases[page].anno;
  const ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  const allStrokes = liveStroke ? [...strokes[page], liveStroke] : strokes[page];

  allStrokes.forEach(s => drawStroke(ctx, s));
}

function drawStroke(ctx, s) {
  ctx.save();
  const alpha = (s.tool === 'highlight') ? 0.35 : 1;
  ctx.globalAlpha = alpha;
  ctx.strokeStyle = s.color;
  ctx.fillStyle   = s.color;
  ctx.lineWidth   = s.thickness;
  ctx.lineCap     = 'round';
  ctx.lineJoin    = 'round';

  if (s.tool === 'eraser') {
    ctx.globalCompositeOperation = 'destination-out';
    ctx.globalAlpha = 1;
    ctx.lineWidth   = s.thickness * 2;
  }

  if (s.tool === 'pen' || s.tool === 'eraser') {
    if (s.points.length < 2) {
      ctx.beginPath();
      ctx.arc(s.points[0].x, s.points[0].y, s.thickness/2, 0, Math.PI*2);
      ctx.fill();
    } else {
      ctx.beginPath();
      ctx.moveTo(s.points[0].x, s.points[0].y);
      s.points.forEach(p => ctx.lineTo(p.x, p.y));
      ctx.stroke();
    }
  } else if (s.tool === 'highlight' || s.tool === 'rectangle') {
    const x = Math.min(s.points[0].x, s.endX ?? s.points[0].x);
    const y = Math.min(s.points[0].y, s.endY ?? s.points[0].y);
    const w = Math.abs((s.endX ?? s.points[0].x) - s.points[0].x);
    const h = s.tool === 'highlight' ? s.thickness : Math.abs((s.endY ?? s.points[0].y) - s.points[0].y);
    if (s.tool === 'highlight') {
      ctx.fillRect(x, y - h * 0.75, w || 80, h);
    } else {
      ctx.strokeRect(x, y, w || 40, h || 20);
    }
  } else if (s.tool === 'underline') {
    const x = Math.min(s.points[0].x, s.endX ?? s.points[0].x);
    const y = s.points[0].y;
    const w = Math.abs((s.endX ?? s.points[0].x + 80) - s.points[0].x) || 80;
    ctx.lineWidth = Math.max(2, s.thickness / 6);
    ctx.beginPath();
    ctx.moveTo(x, y + 4);
    ctx.lineTo(x + w, y + 4);
    ctx.stroke();
  } else if (s.tool === 'strikethrough') {
    const x = Math.min(s.points[0].x, s.endX ?? s.points[0].x);
    const y = s.points[0].y;
    const w = Math.abs((s.endX ?? s.points[0].x + 80) - s.points[0].x) || 80;
    ctx.lineWidth = Math.max(2, s.thickness / 6);
    ctx.beginPath();
    ctx.moveTo(x, y - s.thickness * 0.3);
    ctx.lineTo(x + w, y - s.thickness * 0.3);
    ctx.stroke();
  } else if (s.tool === 'text') {
    ctx.globalAlpha = 1;
    ctx.font = `${s.thickness}px Inter, sans-serif`;
    ctx.fillText(s.text, s.x, s.y);
  }
  ctx.restore();
}

// ── Tools ──────────────────────────────────────────────────────────────────
function setTool(t) {
  currentTool = t;
  document.querySelectorAll('[id^="tool-"]').forEach(b => b.classList.remove('active'));
  const btn = document.getElementById('tool-' + t);
  if (btn) btn.classList.add('active');
}

function setColor(c, el) {
  currentColor = c;
  document.querySelectorAll('.color-swatch').forEach(s => s.classList.remove('active'));
  if (el) el.classList.add('active');
}

function setThickness(v) {
  thickness = parseInt(v);
  document.getElementById('thickness-label').textContent = v;
}

function undoLast() {
  // Find current visible page
  const visible = getVisiblePage();
  if (strokes[visible] && strokes[visible].length > 0) {
    strokes[visible].pop();
    redrawPage(visible);
  }
}

function clearPage() {
  const visible = getVisiblePage();
  if (confirm('Clear all annotations on this page?')) {
    strokes[visible] = [];
    redrawPage(visible);
  }
}

function getVisiblePage() {
  const area = document.getElementById('canvas-area');
  const areaRect = area.getBoundingClientRect();
  let best = 1, bestDist = Infinity;
  for (let i = 1; i <= pdfDoc.numPages; i++) {
    const el = document.getElementById('page-wrapper-' + i);
    if (!el) continue;
    const r = el.getBoundingClientRect();
    const dist = Math.abs(r.top - areaRect.top);
    if (dist < bestDist) { bestDist = dist; best = i; }
  }
  return best;
}

// ── Zoom ───────────────────────────────────────────────────────────────────
function zoom(delta) {
  scale = Math.min(3, Math.max(0.5, scale + delta));
  document.getElementById('zoom-label').textContent = Math.round(scale / 1.5 * 100) + '%';
  renderAllPages();
}

// ── Download PDF ───────────────────────────────────────────────────────────
async function downloadPDF() {
  const btn = document.querySelector('.tb-download');
  btn.textContent = '⏳ Preparing…';
  btn.disabled = true;

  try {
    const { jsPDF } = window.jspdf;
    const firstPage = await pdfDoc.getPage(1);
    const firstVP   = firstPage.getViewport({ scale: 2 });
    const pdf = new jsPDF({
      orientation: firstVP.width > firstVP.height ? 'landscape' : 'portrait',
      unit: 'px',
      format: [firstVP.width, firstVP.height],
      hotfixes: ['px_scaling']
    });

    for (let i = 1; i <= pdfDoc.numPages; i++) {
      if (i > 1) pdf.addPage([firstVP.width, firstVP.height]);

      // Re-render page at 2x for quality
      const page = await pdfDoc.getPage(i);
      const vp   = page.getViewport({ scale: 2 });
      const offscreen = document.createElement('canvas');
      offscreen.width  = vp.width;
      offscreen.height = vp.height;
      await page.render({ canvasContext: offscreen.getContext('2d'), viewport: vp }).promise;

      // Draw annotations scaled to 2x
      const ctx = offscreen.getContext('2d');
      const annoCanvas = pageCanvases[i].anno;
      const scaleRatio = vp.width / annoCanvas.width;
      ctx.save();
      ctx.scale(scaleRatio, scaleRatio);
      // Re-draw strokes at higher resolution
      strokes[i].forEach(s => drawStroke(ctx, s));
      ctx.restore();

      pdf.addImage(offscreen.toDataURL('image/jpeg', 0.92), 'JPEG', 0, 0, vp.width, vp.height);
    }

    pdf.save('annotated.pdf');
  } catch(err) {
    alert('Download failed: ' + err.message);
  }

  btn.textContent = '⬇ Download PDF';
  btn.disabled = false;
}
</script>

</body>
</html>
