@extends('tools.layout')

@section('title', 'PDF Text Editor — Edit PDF Text Online Free')
@section('description', 'Edit PDF text directly online. Upload your PDF, click any text to edit it in place, and download the modified PDF instantly. No software needed.')
@section('keywords', 'pdf text editor, edit pdf text online, edit pdf online free, modify pdf text, pdf editor, change text in pdf')
@section('slug', 'pdf-text-editor')

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Edit PDF Text Online",
  "description": "Click any text in your PDF to edit it directly in your browser, then download the modified PDF.",
  "step": [
    {"@type":"HowToStep","position":1,"name":"Upload PDF","text":"Drop or choose your PDF file."},
    {"@type":"HowToStep","position":2,"name":"Click to Edit","text":"Click any text on the rendered PDF page to edit it inline."},
    {"@type":"HowToStep","position":3,"name":"Download","text":"Click Download to save your changes as a new PDF."}
  ]
}
</script>
@endsection

@section('content')

<style>
/* ── Editor layout ─────────────────────────────────────────────────── */
#editor-bar{
  position:sticky;top:0;z-index:80;
  display:flex;align-items:center;gap:12px;flex-wrap:wrap;
  padding:10px 20px;
  background:rgba(10,10,20,0.95);backdrop-filter:blur(16px);
  border-bottom:1px solid rgba(255,255,255,.1);
}
.ebar-info{font-size:13px;color:#8888a8;flex:1;min-width:120px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.ebar-info strong{color:#eeeef8;}
.ebar-nav{display:flex;align-items:center;gap:6px;}
.ebar-btn{width:30px;height:30px;border-radius:6px;background:#16162a;border:1px solid rgba(255,255,255,.12);
  color:#eeeef8;font-size:14px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .15s;}
.ebar-btn:hover{background:#22223a;border-color:#5b5cff;}
.ebar-btn:disabled{opacity:.35;cursor:default;}
#page-indicator{font-size:13px;color:#8888a8;padding:0 4px;white-space:nowrap;}
.ebar-zoom{height:30px;padding:0 10px;background:#16162a;border:1px solid rgba(255,255,255,.12);
  border-radius:6px;color:#eeeef8;font-size:12px;cursor:pointer;}
#change-badge{display:none;padding:4px 12px;background:rgba(91,92,255,.2);border:1px solid rgba(91,92,255,.4);
  border-radius:99px;font-size:12px;font-weight:600;color:#9898ff;white-space:nowrap;}
#download-btn{padding:8px 20px;background:linear-gradient(135deg,#5b5cff,#7475ff);
  color:#fff;border:none;border-radius:99px;font-size:13px;font-weight:700;cursor:pointer;
  box-shadow:0 2px 14px rgba(91,92,255,.35);transition:all .2s;white-space:nowrap;}
#download-btn:hover{transform:translateY(-1px);box-shadow:0 4px 20px rgba(91,92,255,.5);}
#download-btn:disabled{opacity:.5;cursor:default;transform:none;}

/* ── Pages container ───────────────────────────────────────────────── */
#pages-wrap{
  padding:32px 20px 60px;
  display:flex;flex-direction:column;align-items:center;gap:24px;
  background:#111118;min-height:60vh;
}
.pdf-page-wrap{
  position:relative;display:inline-block;
  box-shadow:0 8px 40px rgba(0,0,0,.6);
  border-radius:4px;overflow:hidden;
}
.pdf-page-wrap canvas{display:block;}

/* ── Text layer ────────────────────────────────────────────────────── */
.text-layer{
  position:absolute;top:0;left:0;right:0;bottom:0;
  overflow:hidden;pointer-events:none;
  line-height:1;user-select:text;
}
.t-item{
  position:absolute;
  cursor:text;pointer-events:all;
  white-space:pre;
  border-radius:2px;
  transform-origin:0 100%;
  transition:background .12s;
  color:transparent; /* hide duplicate text, only show on hover/edit */
}
.t-item:hover{
  background:rgba(255,220,80,.22);
  outline:1px dashed rgba(255,220,80,.5);
}
.t-item.editing{
  color:#111 !important;
  background:#fff !important;
  outline:2px solid #5b5cff !important;
  border-radius:3px;
  z-index:20;
  min-width:20px;
  box-shadow:0 2px 12px rgba(91,92,255,.5);
}
.t-item.changed{
  background:rgba(91,92,255,.18);
  outline:1px solid rgba(91,92,255,.4);
}
.t-item.changed:hover{
  background:rgba(91,92,255,.28);
}
.t-item.changed.editing{
  color:#111 !important;
  background:#eef !important;
}

/* ── Tooltip ────────────────────────────────────────────────────────── */
#edit-tip{
  position:fixed;bottom:24px;left:50%;transform:translateX(-50%);
  background:#1e1e33;border:1px solid rgba(255,255,255,.12);border-radius:10px;
  padding:10px 18px;font-size:13px;color:#8888a8;z-index:100;
  box-shadow:0 4px 24px rgba(0,0,0,.4);pointer-events:none;
  opacity:0;transition:opacity .25s;white-space:nowrap;
}
#edit-tip.show{opacity:1;}

/* ── Loading overlay ────────────────────────────────────────────────── */
#loading-overlay{
  position:fixed;inset:0;z-index:200;background:rgba(7,7,13,.92);
  display:flex;flex-direction:column;align-items:center;justify-content:center;gap:16px;
}
.spin{width:44px;height:44px;border:3px solid rgba(91,92,255,.3);border-top-color:#5b5cff;
  border-radius:50%;animation:spin .75s linear infinite;}
@keyframes spin{to{transform:rotate(360deg)}}
#loading-text{color:#8888a8;font-size:14px;}
</style>

{{-- ── UPLOAD STATE ──────────────────────────────────────────────────── --}}
<div id="state-upload">
  <div class="hero">
    <div class="badge">✏️ PDF Text Editor</div>
    <h1>Edit PDF Text Online Free</h1>
    <p>Click any text on your PDF to edit it directly — no re-typing, no re-creating from scratch. Download your edited PDF instantly.</p>
  </div>

  <div class="tool-box" style="max-width:640px;">
    <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfFile').click()">
      <div class="upload-icon">📄</div>
      <div class="upload-title">Drop your PDF here</div>
      <div class="upload-sub">Click to browse · Max 20MB · Works in your browser</div>
      <input type="file" id="pdfFile" accept=".pdf" style="display:none" onchange="loadPdf(this.files[0])">
    </div>
    <p style="text-align:center;color:#44445a;font-size:12px;margin-top:12px;">Your PDF is processed entirely in your browser — never uploaded to any server.</p>
  </div>
</div>

{{-- ── EDITOR STATE ──────────────────────────────────────────────────── --}}
<div id="state-editor" style="display:none;">

  {{-- Sticky toolbar --}}
  <div id="editor-bar">
    <div class="ebar-info"><strong id="bar-filename">document.pdf</strong> <span id="bar-pages"></span></div>
    <div class="ebar-nav">
      <button class="ebar-btn" id="btn-prev" onclick="goPage(-1)" title="Previous page">‹</button>
      <span id="page-indicator">1 / 1</span>
      <button class="ebar-btn" id="btn-next" onclick="goPage(1)" title="Next page">›</button>
    </div>
    <select class="ebar-zoom" id="zoom-select" onchange="setZoom(this.value)">
      <option value="0.75">75%</option>
      <option value="1" selected>100%</option>
      <option value="1.25">125%</option>
      <option value="1.5">150%</option>
      <option value="2">200%</option>
    </select>
    <div id="change-badge">0 changes</div>
    <button id="download-btn" onclick="downloadEdited()">⬇ Download PDF</button>
    <button onclick="resetEditor()"
      style="padding:8px 16px;background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.12);border-radius:99px;font-size:12px;cursor:pointer;">
      ✕ New File
    </button>
  </div>

  {{-- Pages --}}
  <div id="pages-wrap"></div>

</div>

{{-- Loading overlay --}}
<div id="loading-overlay" style="display:none;">
  <div class="spin"></div>
  <div id="loading-text">Rendering PDF…</div>
</div>

{{-- Edit tooltip --}}
<div id="edit-tip">✏️ Click on any text to edit it</div>

{{-- ── HOW IT WORKS ──────────────────────────────────────────────────── --}}
<div id="info-section">
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">How PDF Text Editor Works</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
    @foreach([
      ['📤','Upload PDF','Drop your PDF file. It\'s processed entirely in your browser — private and instant.'],
      ['✏️','Click to Edit','Click any text on the rendered PDF page to edit it inline. Changes highlight in blue.'],
      ['⬇️','Download','Click Download — your edits are saved back into the PDF and downloaded instantly.'],
    ] as $i => $s)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:24px;text-align:center;">
      <div style="width:32px;height:32px;background:#5b5cff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:14px;color:#fff;margin:0 auto 12px;">{{ $i+1 }}</div>
      <div style="font-size:28px;margin-bottom:10px;">{{ $s[0] }}</div>
      <div style="font-weight:600;margin-bottom:6px;font-size:14px;">{{ $s[1] }}</div>
      <div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $s[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>Can I edit any PDF?</h3>
    <p>You can edit any PDF that contains selectable text. Scanned PDFs (image-only) don't have editable text layers — for those you would need OCR first.</p>
  </div>
  <div class="faq-item">
    <h3>Is my PDF safe?</h3>
    <p>Yes. Your PDF is processed entirely in your browser using JavaScript. It is never uploaded to any server. 100% private.</p>
  </div>
  <div class="faq-item">
    <h3>Will the layout stay the same?</h3>
    <p>Yes. The original PDF layout, images, and formatting are preserved. Only the text you edit is changed. The rest of the PDF stays exactly as it was.</p>
  </div>
  <div class="faq-item">
    <h3>What happens to fonts?</h3>
    <p>Edited text is redrawn with a standard font (Helvetica). If the original used a custom font, the style of edited words may differ slightly, but the size and position are matched.</p>
  </div>
</div>
</div>

<script>
// ── Load PDF.js and pdf-lib from CDN ─────────────────────────────────────
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

// ── State ────────────────────────────────────────────────────────────────
let pdfJsDoc   = null;   // PDF.js document
let pdfBytes   = null;   // original ArrayBuffer (for pdf-lib save)
let scale      = 1;
let totalPages = 0;
let currentPage = 1;
let changeCount = 0;

// ── Drag & Drop ──────────────────────────────────────────────────────────
const dz = document.getElementById('drop-zone');
dz.addEventListener('dragover', e => { e.preventDefault(); dz.style.borderColor = '#5b5cff'; });
dz.addEventListener('dragleave', () => { dz.style.borderColor = ''; });
dz.addEventListener('drop', e => {
  e.preventDefault(); dz.style.borderColor = '';
  const f = e.dataTransfer.files[0];
  if (f && f.name.toLowerCase().endsWith('.pdf')) loadPdf(f);
  else alert('Please drop a PDF file.');
});

// ── Load PDF ─────────────────────────────────────────────────────────────
async function loadPdf(file) {
  if (!file) return;
  if (!window.pdfjsLib || !window.PDFLib) {
    // Libraries may still be loading — wait up to 5s
    let waited = 0;
    while ((!window.pdfjsLib || !window.PDFLib) && waited < 5000) {
      await new Promise(r => setTimeout(r, 200));
      waited += 200;
    }
    if (!window.pdfjsLib || !window.PDFLib) {
      alert('PDF libraries failed to load. Please refresh and try again.');
      return;
    }
  }

  showLoading('Reading PDF…');

  try {
    pdfBytes = await file.arrayBuffer();
    pdfJsDoc = await pdfjsLib.getDocument({ data: pdfBytes.slice(0) }).promise;
    totalPages = pdfJsDoc.numPages;
    currentPage = 1;

    document.getElementById('bar-filename').textContent = file.name;
    document.getElementById('bar-pages').textContent = `· ${totalPages} page${totalPages > 1 ? 's' : ''}`;
    document.getElementById('state-upload').style.display = 'none';
    document.getElementById('info-section').style.display = 'none';
    document.getElementById('state-editor').style.display = 'block';

    await renderAllPages();
    hideLoading();
    showTip();
  } catch (e) {
    hideLoading();
    alert('Could not open PDF: ' + e.message);
  }
}

// ── Render all pages ─────────────────────────────────────────────────────
async function renderAllPages() {
  const wrap = document.getElementById('pages-wrap');
  wrap.innerHTML = '';
  changeCount = 0;
  updateChangeBadge();

  for (let p = 1; p <= totalPages; p++) {
    document.getElementById('loading-text').textContent = `Rendering page ${p} of ${totalPages}…`;
    const pageEl = await renderPage(p);
    wrap.appendChild(pageEl);
  }

  updatePageNav();
}

async function renderPage(pageNum) {
  const page     = await pdfJsDoc.getPage(pageNum);
  const viewport = page.getViewport({ scale });

  // Canvas
  const canvas = document.createElement('canvas');
  canvas.width  = viewport.width;
  canvas.height = viewport.height;
  await page.render({ canvasContext: canvas.getContext('2d'), viewport }).promise;

  // Text layer
  const textContent = await page.getTextContent();
  const textLayer   = buildTextLayer(textContent, viewport, pageNum);

  // Page wrapper
  const pageWrap = document.createElement('div');
  pageWrap.className = 'pdf-page-wrap';
  pageWrap.dataset.page = pageNum;
  pageWrap.style.width  = viewport.width + 'px';
  pageWrap.style.height = viewport.height + 'px';
  pageWrap.appendChild(canvas);
  pageWrap.appendChild(textLayer);

  return pageWrap;
}

// ── Build editable text layer ────────────────────────────────────────────
function buildTextLayer(textContent, viewport, pageNum) {
  const layer = document.createElement('div');
  layer.className = 'text-layer';

  // Group items into editable blocks (adjacent items on same line)
  const blocks = groupItems(textContent.items, viewport);

  blocks.forEach((block, idx) => {
    const span = document.createElement('span');
    span.className    = 't-item';
    span.textContent  = block.str;
    span.dataset.orig = block.str;
    span.dataset.page = pageNum;
    span.dataset.idx  = idx;

    // Position
    span.style.left     = block.x + 'px';
    span.style.top      = block.y + 'px';
    span.style.fontSize = block.fontSize + 'px';
    span.style.lineHeight = '1';

    // Store PDF coordinates on the element
    span.dataset.pdfX    = block.pdfX;
    span.dataset.pdfY    = block.pdfY;
    span.dataset.pdfW    = block.pdfW;
    span.dataset.pdfH    = block.pdfH;
    span.dataset.pdfSize = block.pdfFontSize;

    // Click to edit
    span.addEventListener('click', e => {
      e.stopPropagation();
      startEditing(span);
    });

    // Finish editing on blur
    span.addEventListener('blur', () => finishEditing(span));

    // Tab to next
    span.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === 'Tab') {
        e.preventDefault();
        span.blur();
        // Focus next span
        const all = Array.from(document.querySelectorAll('.t-item'));
        const next = all[all.indexOf(span) + 1];
        if (next) next.click();
      }
      if (e.key === 'Escape') {
        // Revert
        span.textContent = span.dataset.orig;
        span.blur();
      }
    });

    layer.appendChild(span);
  });

  return layer;
}

function startEditing(span) {
  // Deactivate any current editor
  document.querySelectorAll('.t-item.editing').forEach(s => s !== span && finishEditing(s));

  span.contentEditable = 'true';
  span.classList.add('editing');
  span.focus();

  // Select all text
  const range = document.createRange();
  range.selectNodeContents(span);
  const sel = window.getSelection();
  sel.removeAllRanges();
  sel.addRange(range);

  hideTip();
}

function finishEditing(span) {
  span.contentEditable = 'false';
  span.classList.remove('editing');

  const newText = span.textContent;
  const origText = span.dataset.orig;

  if (newText !== origText) {
    span.classList.add('changed');
    if (!span.dataset.changed) {
      span.dataset.changed = '1';
      changeCount++;
    }
  } else {
    span.classList.remove('changed');
    if (span.dataset.changed) {
      delete span.dataset.changed;
      changeCount = Math.max(0, changeCount - 1);
    }
  }
  updateChangeBadge();
}

// ── Group text items into editable blocks ────────────────────────────────
function groupItems(items, viewport) {
  const processed = items
    .filter(item => item.str && item.str.trim())
    .map(item => {
      const tx = pdfjsLib.Util.transform(viewport.transform, item.transform);
      const fh = Math.sqrt(tx[2] * tx[2] + tx[3] * tx[3]);
      const fw = item.width * viewport.scale;
      return {
        str   : item.str,
        x     : tx[4],
        y     : tx[5] - fh,         // top of glyph
        bottom: tx[5],               // baseline
        w     : Math.abs(fw),
        h     : fh,
        fontSize: fh,
        pdfX  : item.transform[4],
        pdfY  : item.transform[5],
        pdfW  : Math.abs(item.width),
        pdfH  : fh / viewport.scale,
        pdfFontSize: Math.sqrt(item.transform[0] ** 2 + item.transform[1] ** 2),
      };
    })
    .filter(i => i.w > 0 && i.h > 0);

  if (!processed.length) return [];

  // Sort: top→bottom, left→right
  processed.sort((a, b) => {
    const dy = a.bottom - b.bottom;
    if (Math.abs(dy) > a.h * 0.5) return dy;
    return a.x - b.x;
  });

  const blocks = [];
  let group = [processed[0]];

  for (let i = 1; i < processed.length; i++) {
    const cur  = processed[i];
    const last = group[group.length - 1];
    const sameBaseline = Math.abs(cur.bottom - last.bottom) < last.h * 0.4;
    const closeX = sameBaseline && (cur.x - (last.x + last.w)) < last.h * 1.8;

    if (sameBaseline && closeX) {
      group.push(cur);
    } else {
      blocks.push(mergeGroup(group));
      group = [cur];
    }
  }
  blocks.push(mergeGroup(group));

  return blocks;
}

function mergeGroup(items) {
  const str   = items.map(i => i.str).join('');
  const x     = Math.min(...items.map(i => i.x));
  const y     = Math.min(...items.map(i => i.y));
  const right = Math.max(...items.map(i => i.x + i.w));
  const bot   = Math.max(...items.map(i => i.bottom));
  return {
    str, x, y,
    w          : right - x,
    h          : bot - y,
    fontSize   : items[0].fontSize,
    pdfX       : items[0].pdfX,
    pdfY       : items[0].pdfY,
    pdfW       : items.reduce((s, i) => s + i.pdfW, 0),
    pdfH       : items[0].pdfH,
    pdfFontSize: items[0].pdfFontSize,
  };
}

// ── Download edited PDF ──────────────────────────────────────────────────
async function downloadEdited() {
  if (!pdfBytes) return;

  const btn = document.getElementById('download-btn');
  btn.disabled = true;
  btn.textContent = '⏳ Saving…';

  try {
    const { PDFDocument, StandardFonts, rgb } = PDFLib;
    const pdfDoc   = await PDFDocument.load(pdfBytes);
    const helvetica = await pdfDoc.embedFont(StandardFonts.Helvetica);

    // Collect all changed spans
    const changedSpans = document.querySelectorAll('.t-item.changed');

    for (const span of changedSpans) {
      const pageNum  = parseInt(span.dataset.page);
      const newText  = span.textContent;
      const pdfPage  = pdfDoc.getPage(pageNum - 1);
      const { height: pageH } = pdfPage.getSize();

      const pdfX    = parseFloat(span.dataset.pdfX);
      const pdfY    = parseFloat(span.dataset.pdfY);
      const pdfW    = parseFloat(span.dataset.pdfW);
      const pdfH    = parseFloat(span.dataset.pdfH);
      const fontSize = parseFloat(span.dataset.pdfSize);

      // Cover old text with white rectangle
      pdfPage.drawRectangle({
        x      : pdfX - 1,
        y      : pdfY - pdfH * 0.25,
        width  : pdfW + 4,
        height : pdfH * 1.4,
        color  : rgb(1, 1, 1),
      });

      // Draw new text
      const safeFontSize = Math.max(4, Math.min(fontSize, 72));
      if (newText.trim()) {
        pdfPage.drawText(newText, {
          x      : pdfX,
          y      : pdfY,
          size   : safeFontSize,
          font   : helvetica,
          color  : rgb(0, 0, 0),
          maxWidth: pdfW + 40,
        });
      }
    }

    const savedBytes = await pdfDoc.save();
    const blob = new Blob([savedBytes], { type: 'application/pdf' });
    const url  = URL.createObjectURL(blob);
    const a    = document.createElement('a');
    a.href     = url;
    a.download = 'edited-' + (document.getElementById('bar-filename').textContent || 'document.pdf');
    a.click();
    setTimeout(() => URL.revokeObjectURL(url), 3000);

  } catch (e) {
    alert('Save failed: ' + e.message);
  } finally {
    btn.disabled = false;
    btn.textContent = '⬇ Download PDF';
  }
}

// ── Page navigation ───────────────────────────────────────────────────────
function goPage(dir) {
  const newPage = currentPage + dir;
  if (newPage < 1 || newPage > totalPages) return;
  currentPage = newPage;
  const pageEl = document.querySelector(`.pdf-page-wrap[data-page="${currentPage}"]`);
  if (pageEl) pageEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
  updatePageNav();
}

function updatePageNav() {
  document.getElementById('page-indicator').textContent = `${currentPage} / ${totalPages}`;
  document.getElementById('btn-prev').disabled = currentPage <= 1;
  document.getElementById('btn-next').disabled = currentPage >= totalPages;
}

// Track current page on scroll
window.addEventListener('scroll', () => {
  document.querySelectorAll('.pdf-page-wrap').forEach(el => {
    const rect = el.getBoundingClientRect();
    if (rect.top >= 0 && rect.top < window.innerHeight * 0.5) {
      const p = parseInt(el.dataset.page);
      if (p && p !== currentPage) { currentPage = p; updatePageNav(); }
    }
  });
}, { passive: true });

// ── Zoom ─────────────────────────────────────────────────────────────────
async function setZoom(val) {
  scale = parseFloat(val);
  showLoading('Re-rendering…');
  await renderAllPages();
  hideLoading();
}

// ── Helpers ───────────────────────────────────────────────────────────────
function updateChangeBadge() {
  const badge = document.getElementById('change-badge');
  if (changeCount > 0) {
    badge.style.display = 'block';
    badge.textContent   = changeCount + (changeCount === 1 ? ' change' : ' changes');
  } else {
    badge.style.display = 'none';
  }
}

function showLoading(msg) {
  document.getElementById('loading-text').textContent = msg || 'Loading…';
  document.getElementById('loading-overlay').style.display = 'flex';
}
function hideLoading() {
  document.getElementById('loading-overlay').style.display = 'none';
}

let tipTimer;
function showTip() {
  const tip = document.getElementById('edit-tip');
  tip.classList.add('show');
  tipTimer = setTimeout(() => tip.classList.remove('show'), 4000);
}
function hideTip() {
  clearTimeout(tipTimer);
  document.getElementById('edit-tip').classList.remove('show');
}

function resetEditor() {
  pdfJsDoc = null; pdfBytes = null; changeCount = 0;
  document.getElementById('state-editor').style.display = 'none';
  document.getElementById('info-section').style.display = 'block';
  document.getElementById('state-upload').style.display = 'block';
  document.getElementById('pages-wrap').innerHTML = '';
  document.getElementById('pdfFile').value = '';
}

// Click outside editing span to deselect
document.addEventListener('click', e => {
  if (!e.target.classList.contains('t-item')) {
    document.querySelectorAll('.t-item.editing').forEach(s => finishEditing(s));
  }
});
</script>
@endsection
