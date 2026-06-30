<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Highlight PDF Online Free — Annotate, Underline, Draw | PDFTash</title>
<meta name="description" content="Highlight, underline, strikethrough and annotate any PDF online free. Add draggable text and images. No signup — runs in your browser.">
<meta name="keywords" content="highlight pdf online free, annotate pdf online, underline pdf, pdf highlighter, add text to pdf, add image to pdf">
<link rel="canonical" href="https://pdftash.com/highlight-pdf">
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<meta property="og:title" content="Highlight PDF Online Free | PDFTash">
<meta property="og:description" content="Highlight, underline, add draggable text and images to any PDF. Free, private, no signup.">
<meta property="og:url" content="https://pdftash.com/highlight-pdf">
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"SoftwareApplication","name":"PDF Highlighter","url":"https://pdftash.com/highlight-pdf","applicationCategory":"UtilitiesApplication","operatingSystem":"Any","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"description":"Highlight, underline, and annotate any PDF online free. Add draggable text and images. No signup required."}
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
.anno-canvas{position:absolute;top:0;left:0;}

/* SIZE CONTROL */
#zoom-ctrl{display:flex;align-items:center;gap:6px;}
#zoom-ctrl button{background:var(--bg3);border:1px solid var(--border2);border-radius:6px;color:var(--text);padding:4px 10px;cursor:pointer;font-size:14px;}
#zoom-ctrl span{font-size:12px;color:var(--text2);min-width:40px;text-align:center;}

/* Floating text input overlay */
.text-input-overlay{
  position:absolute;
  background:rgba(255,255,210,0.95);
  border:2px dashed #5b5cff;
  border-radius:4px;
  padding:4px 6px;
  outline:none;
  resize:none;
  font-family:'Inter',sans-serif;
  min-width:60px;
  min-height:24px;
  z-index:100;
  color:#000;
  line-height:1.3;
  overflow:hidden;
  white-space:pre;
}
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
  <p>Highlight, underline, draw, add draggable text and images to any PDF. All processing happens in your browser — your files never leave your device.</p>

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
    <button class="tb-btn" id="tool-select" onclick="setTool('select')" title="Select & Move">↖ Select</button>
    <button class="tb-btn active" id="tool-highlight" onclick="setTool('highlight')" title="Highlight">🖊 Highlight</button>
    <button class="tb-btn" id="tool-underline" onclick="setTool('underline')" title="Underline">U̲ Underline</button>
    <button class="tb-btn" id="tool-strikethrough" onclick="setTool('strikethrough')" title="Strikethrough">S̶ Strike</button>
    <button class="tb-btn" id="tool-pen" onclick="setTool('pen')" title="Freehand Draw">✏️ Draw</button>
    <button class="tb-btn" id="tool-rectangle" onclick="setTool('rectangle')" title="Rectangle">▭ Rect</button>
    <button class="tb-btn" id="tool-text" onclick="setTool('text')" title="Add Text">T Text</button>
    <button class="tb-btn" id="tool-image" onclick="triggerImagePicker()" title="Insert Image">🖼 Image</button>
    <button class="tb-btn" id="tool-eraser" onclick="setTool('eraser')" title="Eraser">⌫ Erase</button>

    <div class="tb-sep"></div>
    <span class="tb-label">COLOR</span>
    <div id="color-swatches" style="display:flex;gap:5px;align-items:center;">
      <div class="color-swatch active" style="background:#FFE033;" data-color="#FFE033" onclick="setColor('#FFE033',this)" title="Yellow"></div>
      <div class="color-swatch" style="background:#6EE7B7;" data-color="#6EE7B7" onclick="setColor('#6EE7B7',this)" title="Green"></div>
      <div class="color-swatch" style="background:#FCA5A5;" data-color="#FCA5A5" onclick="setColor('#FCA5A5',this)" title="Pink"></div>
      <div class="color-swatch" style="background:#93C5FD;" data-color="#93C5FD" onclick="setColor('#93C5FD',this)" title="Blue"></div>
      <div class="color-swatch" style="background:#C4B5FD;" data-color="#C4B5FD" onclick="setColor('#C4B5FD',this)" title="Purple"></div>
      <div class="color-swatch" style="background:#F97316;" data-color="#F97316" onclick="setColor('#F97316',this)" title="Orange"></div>
      <div class="color-swatch" style="background:#EF4444;" data-color="#EF4444" onclick="setColor('#EF4444',this)" title="Red"></div>
      <div class="color-swatch" style="background:#111;" data-color="#111111" onclick="setColor('#111111',this)" title="Black"></div>
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
    <button class="tb-btn" onclick="undoLast()" title="Undo (Ctrl+Z)">↩ Undo</button>
    <button class="tb-btn" onclick="clearPage()" title="Clear page annotations">🗑 Clear</button>

    <button class="tb-download" onclick="downloadPDF()">⬇ Download PDF</button>
  </div>

  <div id="main-area">
    <div id="thumbs-panel"></div>
    <div id="canvas-area"></div>
  </div>
</div>

<!-- Hidden image file input -->
<input type="file" id="image-input" accept="image/*" style="display:none">

<!-- PDF.js + jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

// ─── State ────────────────────────────────────────────────────────────────────
let pdfDoc        = null;
let pdfBytes      = null;
let currentTool   = 'highlight';
let currentColor  = '#FFE033';
let thickness     = 16;
let scale         = 1.5;

// Stroke-based annotations (highlight, pen, underline, etc.)
const strokes = {};        // strokes[pageNum] = [{tool,color,thickness,points,...}]
let drawing       = false;
let currentStroke = null;
let startX, startY;

// Object-based annotations (text, image)
const annotations = {};    // annotations[pageNum] = [{id,type,x,y,width,height,...}]

// Selection state
let selectedId    = null;   // id of selected annotation
let selectedPage  = null;   // page of selected annotation

// Drag / resize state
let dragState     = null;
// {mode:'move'|'resize', handle:'nw'|'ne'|'sw'|'se',
//  startX, startY, origX, origY, origW, origH}

// Undo history per page: [{type:'stroke'|'annotation', annoId}]
const history = {};

// Canvas refs
const pageCanvases = {}; // pageCanvases[n] = {pdf, anno, viewport}

// ─── File Input ───────────────────────────────────────────────────────────────
document.getElementById('file-input').addEventListener('change', e => {
  if (e.target.files[0]) loadPDF(e.target.files[0]);
});

const dz = document.getElementById('dropzone');
dz.addEventListener('click', () => document.getElementById('file-input').click());
dz.addEventListener('dragover', e => { e.preventDefault(); dz.classList.add('drag-over'); });
dz.addEventListener('dragleave', () => dz.classList.remove('drag-over'));
dz.addEventListener('drop', e => {
  e.preventDefault(); dz.classList.remove('drag-over');
  const f = e.dataTransfer.files[0];
  if (f && f.type === 'application/pdf') loadPDF(f);
});

async function loadPDF(file) {
  const reader = new FileReader();
  reader.onload = async (ev) => {
    pdfBytes = new Uint8Array(ev.target.result);
    pdfDoc   = await pdfjsLib.getDocument({ data: pdfBytes }).promise;
    document.getElementById('upload-state').style.display = 'none';
    document.getElementById('editor-state').style.display = 'flex';
    await renderAllPages();
  };
  reader.readAsArrayBuffer(file);
}

// ─── Image Input ──────────────────────────────────────────────────────────────
let imagePlacePage = 1; // which page to place image on

function triggerImagePicker() {
  imagePlacePage = getVisiblePage();
  document.getElementById('image-input').click();
}

document.getElementById('image-input').addEventListener('change', e => {
  const file = e.target.files[0];
  if (!file) return;
  const url  = URL.createObjectURL(file);
  const img  = new Image();
  img.onload = () => {
    placeImageAnnotation(imagePlacePage, img);
    URL.revokeObjectURL(url);
    // Switch to select so user can immediately drag it
    setTool('select');
  };
  img.src = url;
  e.target.value = '';
});

// ─── Render Pages ─────────────────────────────────────────────────────────────
async function renderAllPages() {
  const thumbsPanel = document.getElementById('thumbs-panel');
  const canvasArea  = document.getElementById('canvas-area');
  thumbsPanel.innerHTML = '';
  canvasArea.innerHTML  = '';

  // Reset per-page data
  for (let i = 1; i <= pdfDoc.numPages; i++) {
    if (!strokes[i])     strokes[i]     = [];
    if (!annotations[i]) annotations[i] = [];
    if (!history[i])     history[i]     = [];
  }

  for (let i = 1; i <= pdfDoc.numPages; i++) {
    const page = await pdfDoc.getPage(i);
    const vp   = page.getViewport({ scale });

    // Page wrapper
    const wrapper = document.createElement('div');
    wrapper.className = 'page-wrapper';
    wrapper.id        = 'page-wrapper-' + i;
    wrapper.style.width  = vp.width  + 'px';
    wrapper.style.height = vp.height + 'px';

    // PDF canvas
    const pdfCanvas = document.createElement('canvas');
    pdfCanvas.width  = vp.width;
    pdfCanvas.height = vp.height;
    await page.render({ canvasContext: pdfCanvas.getContext('2d'), viewport: vp }).promise;

    // Annotation canvas
    const annoCanvas = document.createElement('canvas');
    annoCanvas.className  = 'anno-canvas';
    annoCanvas.width      = vp.width;
    annoCanvas.height     = vp.height;
    annoCanvas.dataset.page = i;
    annoCanvas.style.cursor = 'crosshair';

    wrapper.appendChild(pdfCanvas);
    wrapper.appendChild(annoCanvas);
    canvasArea.appendChild(wrapper);

    pageCanvases[i] = { pdf: pdfCanvas, anno: annoCanvas, viewport: vp };

    // Bind events
    bindPageEvents(annoCanvas, i);

    // Redraw existing annotations (in case of zoom re-render)
    redrawPage(i);

    // Thumbnail
    const thumbItem = document.createElement('div');
    thumbItem.className = 'thumb-item' + (i === 1 ? ' active' : '');
    thumbItem.id = 'thumb-' + i;
    thumbItem.onclick = () => {
      document.getElementById('page-wrapper-' + i)
              .scrollIntoView({ behavior: 'smooth', block: 'start' });
      document.querySelectorAll('.thumb-item').forEach(t => t.classList.remove('active'));
      thumbItem.classList.add('active');
    };
    const thumbCanvas  = document.createElement('canvas');
    const thumbScale   = 72 / vp.width;
    const thumbVP      = page.getViewport({ scale: thumbScale });
    thumbCanvas.width  = thumbVP.width;
    thumbCanvas.height = thumbVP.height;
    await page.render({ canvasContext: thumbCanvas.getContext('2d'), viewport: thumbVP }).promise;
    const thumbNum = document.createElement('div');
    thumbNum.className   = 'thumb-num';
    thumbNum.textContent = i;
    thumbItem.appendChild(thumbCanvas);
    thumbItem.appendChild(thumbNum);
    thumbsPanel.appendChild(thumbItem);
  }
}

function bindPageEvents(canvas, pageNum) {
  canvas.addEventListener('mousedown',  e => onDown(e, pageNum));
  canvas.addEventListener('mousemove',  e => onMove(e, pageNum));
  canvas.addEventListener('mouseup',    e => onUp(e, pageNum));
  canvas.addEventListener('mouseleave', e => onUp(e, pageNum));
  canvas.addEventListener('touchstart', e => onDown(touchEvt(e, canvas), pageNum), { passive: false });
  canvas.addEventListener('touchmove',  e => { e.preventDefault(); onMove(touchEvt(e, canvas), pageNum); }, { passive: false });
  canvas.addEventListener('touchend',   e => onUp(touchEvt(e, canvas), pageNum));
}

// ─── Coordinate Helpers ───────────────────────────────────────────────────────
function touchEvt(e, canvas) {
  const t = e.touches[0] || e.changedTouches[0];
  return { clientX: t.clientX, clientY: t.clientY, _canvas: canvas };
}

function getPos(e, canvas) {
  const c    = canvas || e._canvas;
  const rect = c.getBoundingClientRect();
  return {
    x: (e.clientX - rect.left) * (c.width  / rect.width),
    y: (e.clientY - rect.top)  * (c.height / rect.height)
  };
}

// Canvas coords → CSS px within the page-wrapper
function canvasToCss(canvas, cx, cy) {
  const rect = canvas.getBoundingClientRect();
  return {
    x: cx * (rect.width  / canvas.width),
    y: cy * (rect.height / canvas.height)
  };
}

// ─── Hit Testing ──────────────────────────────────────────────────────────────
const HANDLE_R = 6; // handle half-size in canvas px

function getHandles(a) {
  return [
    { id: 'nw', x: a.x,           y: a.y },
    { id: 'ne', x: a.x + a.width, y: a.y },
    { id: 'sw', x: a.x,           y: a.y + a.height },
    { id: 'se', x: a.x + a.width, y: a.y + a.height },
  ];
}

function hitTestHandle(a, x, y) {
  for (const h of getHandles(a)) {
    if (Math.abs(x - h.x) <= HANDLE_R + 4 && Math.abs(y - h.y) <= HANDLE_R + 4) return h.id;
  }
  return null;
}

function hitTestAnnotation(pageNum, x, y) {
  const list = annotations[pageNum] || [];
  for (let i = list.length - 1; i >= 0; i--) {
    const a = list[i];
    if (x >= a.x - 4 && x <= a.x + a.width + 4 &&
        y >= a.y - 4 && y <= a.y + a.height + 4) {
      return a;
    }
  }
  return null;
}

// ─── Mouse / Touch Handlers ───────────────────────────────────────────────────
function onDown(e, pageNum) {
  const canvas = pageCanvases[pageNum].anno;
  const pos    = getPos(e, canvas);

  // ── SELECT TOOL ──────────────────────────────────────────────────────────
  if (currentTool === 'select') {
    // Check resize handles first
    if (selectedPage === pageNum && selectedId !== null) {
      const selAnno = (annotations[pageNum] || []).find(a => a.id === selectedId);
      if (selAnno) {
        const h = hitTestHandle(selAnno, pos.x, pos.y);
        if (h) {
          dragState = {
            mode: 'resize', handle: h,
            startX: pos.x, startY: pos.y,
            origX: selAnno.x, origY: selAnno.y,
            origW: selAnno.width, origH: selAnno.height
          };
          return;
        }
      }
    }

    // Hit test annotations
    const hit = hitTestAnnotation(pageNum, pos.x, pos.y);
    if (hit) {
      // Deselect previous page if different
      if (selectedPage !== null && selectedPage !== pageNum) redrawPage(selectedPage);
      selectedId   = hit.id;
      selectedPage = pageNum;
      dragState    = { mode: 'move', startX: pos.x, startY: pos.y, origX: hit.x, origY: hit.y };
      redrawPage(pageNum);
    } else {
      // Deselect
      const prevPage = selectedPage;
      selectedId   = null;
      selectedPage = null;
      dragState    = null;
      if (prevPage !== null) redrawPage(prevPage);
    }
    return;
  }

  // ── TEXT TOOL ─────────────────────────────────────────────────────────────
  if (currentTool === 'text') {
    e.preventDefault(); // prevent default focus-steal that causes immediate blur
    createTextInput(pageNum, pos.x, pos.y);
    return;
  }

  // ── STROKE TOOLS ─────────────────────────────────────────────────────────
  drawing = true;
  startX  = pos.x;
  startY  = pos.y;
  currentStroke = {
    tool: currentTool, color: currentColor,
    thickness, points: [{ x: pos.x, y: pos.y }]
  };
}

function onMove(e, pageNum) {
  const canvas = pageCanvases[pageNum].anno;
  const pos    = getPos(e, canvas);

  // ── Drag annotation ───────────────────────────────────────────────────────
  if (dragState && selectedPage === pageNum && selectedId !== null) {
    const anno = (annotations[pageNum] || []).find(a => a.id === selectedId);
    if (!anno) return;

    if (dragState.mode === 'move') {
      anno.x = dragState.origX + (pos.x - dragState.startX);
      anno.y = dragState.origY + (pos.y - dragState.startY);
    } else if (dragState.mode === 'resize') {
      const dx = pos.x - dragState.startX;
      const dy = pos.y - dragState.startY;
      const h  = dragState.handle;
      if (h === 'se') {
        anno.width  = Math.max(20, dragState.origW + dx);
        anno.height = Math.max(20, dragState.origH + dy);
      } else if (h === 'ne') {
        anno.width  = Math.max(20, dragState.origW + dx);
        anno.y      = dragState.origY + dy;
        anno.height = Math.max(20, dragState.origH - dy);
      } else if (h === 'sw') {
        anno.x      = dragState.origX + dx;
        anno.width  = Math.max(20, dragState.origW - dx);
        anno.height = Math.max(20, dragState.origH + dy);
      } else if (h === 'nw') {
        anno.x      = dragState.origX + dx;
        anno.y      = dragState.origY + dy;
        anno.width  = Math.max(20, dragState.origW - dx);
        anno.height = Math.max(20, dragState.origH - dy);
      }
    }
    redrawPage(pageNum);

    // Cursor
    const h = hitTestHandle(anno, pos.x, pos.y);
    const cursors = { nw: 'nw-resize', ne: 'ne-resize', sw: 'sw-resize', se: 'se-resize' };
    canvas.style.cursor = h ? (cursors[h] || 'move') : 'move';
    return;
  }

  // ── Cursor update (select tool, not dragging) ─────────────────────────────
  if (currentTool === 'select') {
    if (selectedPage === pageNum && selectedId !== null) {
      const anno = (annotations[pageNum] || []).find(a => a.id === selectedId);
      if (anno) {
        const h = hitTestHandle(anno, pos.x, pos.y);
        const cursors = { nw: 'nw-resize', ne: 'ne-resize', sw: 'sw-resize', se: 'se-resize' };
        if (h) { canvas.style.cursor = cursors[h]; return; }
      }
    }
    const hit = hitTestAnnotation(pageNum, pos.x, pos.y);
    canvas.style.cursor = hit ? 'move' : 'default';
    return;
  }

  // ── Continue stroke ───────────────────────────────────────────────────────
  if (!drawing || !currentStroke) return;

  if (currentTool === 'pen' || currentTool === 'eraser') {
    currentStroke.points.push({ x: pos.x, y: pos.y });
  } else {
    currentStroke.endX = pos.x;
    currentStroke.endY = pos.y;
  }
  redrawPage(pageNum, currentStroke);
}

function onUp(e, pageNum) {
  // End drag
  if (dragState) {
    dragState = null;
    return;
  }

  // End stroke
  if (!drawing || !currentStroke) return;
  drawing = false;
  strokes[pageNum].push(currentStroke);
  history[pageNum].push({ type: 'stroke' });
  currentStroke = null;
  redrawPage(pageNum);
}

// ─── Text Input Overlay ───────────────────────────────────────────────────────
function createTextInput(pageNum, canvasX, canvasY) {
  // Remove any previous uncommitted input
  document.querySelectorAll('.text-input-overlay').forEach(el => el.remove());

  const canvas  = pageCanvases[pageNum].anno;
  const wrapper = document.getElementById('page-wrapper-' + pageNum);
  const css     = canvasToCss(canvas, canvasX, canvasY);

  const ta = document.createElement('textarea');
  ta.className    = 'text-input-overlay';
  ta.style.left   = css.x + 'px';
  ta.style.top    = css.y + 'px';
  ta.style.fontSize = Math.round(thickness * (canvas.getBoundingClientRect().width / canvas.width)) + 'px';
  // Keep text dark enough to see while typing (will render in chosen color)
  ta.style.color  = '#111';
  ta.rows         = 1;
  ta.placeholder  = 'Type here, Enter to place…';

  wrapper.appendChild(ta);

  // Stop mousedown inside textarea from bubbling to canvas (would create another input)
  ta.addEventListener('mousedown', ev => ev.stopPropagation());

  // Delay focus slightly so the mousedown that triggered this doesn't immediately steal focus back
  setTimeout(() => ta.focus(), 10);

  let committed = false;

  function commit() {
    if (committed) return;
    committed = true;
    const text = ta.value.trim();
    if (text) addTextAnnotation(pageNum, canvasX, canvasY, text);
    if (ta.parentNode) ta.parentNode.removeChild(ta);
    document.removeEventListener('mousedown', outsideClick);
  }

  ta.addEventListener('keydown', ev => {
    if (ev.key === 'Escape') {
      committed = true;
      if (ta.parentNode) ta.parentNode.removeChild(ta);
      document.removeEventListener('mousedown', outsideClick);
      return;
    }
    if (ev.key === 'Enter' && !ev.shiftKey) {
      ev.preventDefault();
      commit();
      return;
    }
    // Auto-grow textarea as user types
    requestAnimationFrame(() => {
      ta.style.width  = 'auto';
      ta.style.height = 'auto';
      ta.style.width  = (ta.scrollWidth + 6) + 'px';
      ta.style.height = (ta.scrollHeight + 4) + 'px';
    });
  });

  // Commit when clicking anywhere outside the textarea
  // Delayed registration so this mousedown event doesn't immediately trigger it
  function outsideClick(ev) {
    if (!ta.contains(ev.target)) commit();
  }
  setTimeout(() => document.addEventListener('mousedown', outsideClick), 50);
}

function addTextAnnotation(pageNum, x, y, text) {
  const canvas = pageCanvases[pageNum].anno;
  const ctx    = canvas.getContext('2d');
  ctx.font     = `${thickness}px Inter, sans-serif`;

  const lines  = text.split('\n');
  const lineH  = thickness * 1.25;
  const maxW   = Math.max(...lines.map(l => ctx.measureText(l).width));

  const anno = {
    id:       Date.now() + Math.random(),
    type:     'text',
    x, y,
    width:    maxW + 8,
    height:   lines.length * lineH + 4,
    text,
    fontSize: thickness,
    color:    currentColor
  };

  if (!annotations[pageNum]) annotations[pageNum] = [];
  annotations[pageNum].push(anno);
  history[pageNum].push({ type: 'annotation', annoId: anno.id });

  // Select the just-placed text
  selectedId   = anno.id;
  selectedPage = pageNum;
  setTool('select');

  redrawPage(pageNum);
}

// ─── Image Annotation ─────────────────────────────────────────────────────────
function placeImageAnnotation(pageNum, imgEl) {
  const canvas = pageCanvases[pageNum].anno;
  const maxW   = canvas.width  * 0.5;
  const maxH   = canvas.height * 0.5;
  let w = imgEl.naturalWidth;
  let h = imgEl.naturalHeight;
  if (w > maxW) { h = h * maxW / w; w = maxW; }
  if (h > maxH) { w = w * maxH / h; h = maxH; }
  const x = (canvas.width  - w) / 2;
  const y = (canvas.height - h) / 2;

  const anno = {
    id:     Date.now() + Math.random(),
    type:   'image',
    x, y,
    width:  w,
    height: h,
    img:    imgEl
  };

  if (!annotations[pageNum]) annotations[pageNum] = [];
  annotations[pageNum].push(anno);
  history[pageNum].push({ type: 'annotation', annoId: anno.id });

  selectedId   = anno.id;
  selectedPage = pageNum;
  redrawPage(pageNum);
}

// ─── Redraw ───────────────────────────────────────────────────────────────────
function redrawPage(pageNum, liveStroke) {
  const { anno: canvas } = pageCanvases[pageNum];
  const ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  // 1. Strokes
  const allStrokes = liveStroke ? [...strokes[pageNum], liveStroke] : strokes[pageNum];
  allStrokes.forEach(s => drawStroke(ctx, s));

  // 2. Object annotations (text, image)
  (annotations[pageNum] || []).forEach(a => {
    ctx.save();
    if (a.type === 'text') {
      ctx.globalAlpha = 1;
      ctx.font        = `${a.fontSize}px Inter, sans-serif`;
      ctx.fillStyle   = a.color;
      const lines = a.text.split('\n');
      const lineH = a.fontSize * 1.25;
      lines.forEach((line, idx) => {
        ctx.fillText(line, a.x + 4, a.y + a.fontSize + idx * lineH);
      });
    } else if (a.type === 'image') {
      ctx.drawImage(a.img, a.x, a.y, a.width, a.height);
    }
    ctx.restore();

    // Selection handles
    if (selectedPage === pageNum && selectedId === a.id) {
      ctx.save();
      ctx.strokeStyle = '#5b5cff';
      ctx.lineWidth   = 2;
      ctx.setLineDash([5, 3]);
      ctx.strokeRect(a.x - 2, a.y - 2, a.width + 4, a.height + 4);
      ctx.setLineDash([]);

      getHandles(a).forEach(h => {
        ctx.fillStyle   = '#ffffff';
        ctx.strokeStyle = '#5b5cff';
        ctx.lineWidth   = 1.5;
        ctx.fillRect(h.x - HANDLE_R, h.y - HANDLE_R, HANDLE_R * 2, HANDLE_R * 2);
        ctx.strokeRect(h.x - HANDLE_R, h.y - HANDLE_R, HANDLE_R * 2, HANDLE_R * 2);
      });

      // Delete hint
      ctx.fillStyle   = 'rgba(91,92,255,0.85)';
      ctx.font        = '11px Inter, sans-serif';
      ctx.fillText('Del to remove', a.x, a.y - 6);
      ctx.restore();
    }
  });
}

function drawStroke(ctx, s) {
  ctx.save();
  const alpha = (s.tool === 'highlight') ? 0.38 : 1;
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
      ctx.arc(s.points[0].x, s.points[0].y, s.thickness / 2, 0, Math.PI * 2);
      ctx.fill();
    } else {
      ctx.beginPath();
      ctx.moveTo(s.points[0].x, s.points[0].y);
      s.points.forEach(p => ctx.lineTo(p.x, p.y));
      ctx.stroke();
    }
  } else if (s.tool === 'rectangle') {
    const x = Math.min(s.points[0].x, s.endX ?? s.points[0].x);
    const y = Math.min(s.points[0].y, s.endY ?? s.points[0].y);
    const w = Math.abs((s.endX ?? s.points[0].x) - s.points[0].x);
    const h = Math.abs((s.endY ?? s.points[0].y) - s.points[0].y);
    ctx.strokeRect(x, y, w || 40, h || 20);
  } else if (s.tool === 'highlight') {
    const x = Math.min(s.points[0].x, s.endX ?? s.points[0].x);
    const y = s.points[0].y;
    const w = Math.abs((s.endX ?? s.points[0].x) - s.points[0].x) || 80;
    const h = s.thickness;
    ctx.fillRect(x, y - h * 0.75, w, h);
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
  }
  ctx.restore();
}

// ─── Tool / Color / Size ──────────────────────────────────────────────────────
function setTool(t) {
  currentTool = t;
  document.querySelectorAll('[id^="tool-"]').forEach(b => b.classList.remove('active'));
  const btn = document.getElementById('tool-' + t);
  if (btn) btn.classList.add('active');

  // Update all annotation canvas cursors
  Object.keys(pageCanvases).forEach(p => {
    const c = pageCanvases[p].anno;
    if (t === 'select') c.style.cursor = 'default';
    else if (t === 'eraser') c.style.cursor = 'cell';
    else c.style.cursor = 'crosshair';
  });
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

// ─── Undo / Clear ─────────────────────────────────────────────────────────────
function undoLast() {
  const p   = getVisiblePage();
  const h   = history[p];
  if (!h || !h.length) return;
  const last = h.pop();
  if (last.type === 'stroke') {
    strokes[p].pop();
  } else if (last.type === 'annotation') {
    annotations[p] = (annotations[p] || []).filter(a => a.id !== last.annoId);
    if (selectedId === last.annoId) { selectedId = null; selectedPage = null; }
  }
  redrawPage(p);
}

function clearPage() {
  const p = getVisiblePage();
  if (!confirm('Clear all annotations on this page?')) return;
  strokes[p]     = [];
  annotations[p] = [];
  history[p]     = [];
  if (selectedPage === p) { selectedId = null; selectedPage = null; }
  redrawPage(p);
}

// Delete selected annotation with keyboard
document.addEventListener('keydown', e => {
  if ((e.key === 'Delete' || e.key === 'Backspace') &&
      selectedId !== null && selectedPage !== null &&
      document.activeElement.tagName !== 'TEXTAREA' &&
      document.activeElement.tagName !== 'INPUT') {
    const p = selectedPage;
    annotations[p] = (annotations[p] || []).filter(a => a.id !== selectedId);
    history[p] = history[p].filter(h => h.annoId !== selectedId);
    selectedId   = null;
    selectedPage = null;
    redrawPage(p);
  }
  if ((e.ctrlKey || e.metaKey) && e.key === 'z') { e.preventDefault(); undoLast(); }
});

// ─── Zoom ─────────────────────────────────────────────────────────────────────
function zoom(delta) {
  scale = Math.min(3, Math.max(0.5, scale + delta));
  document.getElementById('zoom-label').textContent = Math.round(scale / 1.5 * 100) + '%';
  renderAllPages();
}

// ─── Visible Page ─────────────────────────────────────────────────────────────
function getVisiblePage() {
  const area     = document.getElementById('canvas-area');
  const areaRect = area.getBoundingClientRect();
  let best = 1, bestDist = Infinity;
  for (let i = 1; i <= pdfDoc.numPages; i++) {
    const el = document.getElementById('page-wrapper-' + i);
    if (!el) continue;
    const r    = el.getBoundingClientRect();
    const dist = Math.abs(r.top - areaRect.top);
    if (dist < bestDist) { bestDist = dist; best = i; }
  }
  return best;
}

// ─── Download PDF ─────────────────────────────────────────────────────────────
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

      const page = await pdfDoc.getPage(i);
      const vp   = page.getViewport({ scale: 2 });

      // Offscreen canvas at 2x
      const offscreen    = document.createElement('canvas');
      offscreen.width    = vp.width;
      offscreen.height   = vp.height;
      const ctx          = offscreen.getContext('2d');
      await page.render({ canvasContext: ctx, viewport: vp }).promise;

      // Scale factor from annotation-canvas to export canvas
      const annoCanvas  = pageCanvases[i].anno;
      const scaleRatio  = vp.width / annoCanvas.width;

      ctx.save();
      ctx.scale(scaleRatio, scaleRatio);

      // Draw strokes
      strokes[i].forEach(s => drawStroke(ctx, s));

      // Draw object annotations
      (annotations[i] || []).forEach(a => {
        ctx.save();
        if (a.type === 'text') {
          ctx.globalAlpha = 1;
          ctx.font        = `${a.fontSize}px Inter, sans-serif`;
          ctx.fillStyle   = a.color;
          const lines = a.text.split('\n');
          const lineH = a.fontSize * 1.25;
          lines.forEach((line, idx) => {
            ctx.fillText(line, a.x + 4, a.y + a.fontSize + idx * lineH);
          });
        } else if (a.type === 'image') {
          ctx.drawImage(a.img, a.x, a.y, a.width, a.height);
        }
        ctx.restore();
      });

      ctx.restore();

      pdf.addImage(offscreen.toDataURL('image/jpeg', 0.92), 'JPEG', 0, 0, vp.width, vp.height);
    }

    pdf.save('annotated.pdf');
  } catch (err) {
    alert('Download failed: ' + err.message);
  }

  btn.textContent = '⬇ Download PDF';
  btn.disabled = false;
}
</script>

</body>
</html>
