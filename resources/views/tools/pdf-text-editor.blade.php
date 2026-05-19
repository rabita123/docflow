@extends('tools.layout')

@section('title', 'PDF Text Editor — Edit PDF Online Free')
@section('description', 'Edit PDF text online like Sejda but better. Click text to edit, add new text, whiteout content, highlight, change fonts & colors. Download instantly. Free.')
@section('keywords', 'pdf text editor, edit pdf online, edit pdf text, sejda alternative, pdf editor online free, modify pdf, change text in pdf')
@section('slug', 'pdf-text-editor')

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash PDF Text Editor",
  "applicationCategory": "WebApplication",
  "description": "Edit PDF text online. Click any text to edit, add new text, whiteout, highlight. Better than Sejda.",
  "url": "https://pdftash.com/pdf-text-editor",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"}
}
</script>
@endsection

@section('content')
<style>
/* ─── Reset for editor ─────────────────────────────────── */
#pdf-editor-shell * { box-sizing: border-box; }
#pdf-editor-shell { display:none; position:fixed; inset:0; z-index:150;
  background:#1a1a2e; flex-direction:column; font-family:'Inter',sans-serif; }
#pdf-editor-shell.open { display:flex; }

/* ─── Main toolbar ─────────────────────────────────────── */
#main-bar {
  display:flex; align-items:center; gap:8px; padding:0 14px;
  height:50px; background:#0d0d1f; border-bottom:1px solid rgba(255,255,255,.1);
  flex-shrink:0; z-index:10; overflow-x:auto;
}
#main-bar::-webkit-scrollbar { height:3px; }
#main-bar::-webkit-scrollbar-thumb { background:rgba(91,92,255,.4); border-radius:2px; }
.bar-logo { font-weight:800; font-size:15px; color:#5b5cff; margin-right:4px; white-space:nowrap; }
.bar-fname { font-size:13px; color:#8888a8; max-width:220px; overflow:hidden;
  text-overflow:ellipsis; white-space:nowrap; }
.bar-sep { width:1px; height:24px; background:rgba(255,255,255,.1); margin:0 4px; }
.tool-btn {
  display:flex; align-items:center; gap:5px;
  padding:6px 12px; border-radius:7px; border:none; cursor:pointer;
  font-size:12px; font-weight:600; color:#8888a8; background:transparent;
  transition:all .15s; white-space:nowrap;
}
.tool-btn:hover { background:rgba(255,255,255,.07); color:#eeeef8; }
.tool-btn.active { background:rgba(91,92,255,.2); color:#9898ff; }
.tool-btn .ti { font-size:15px; }
#bar-right { margin-left:auto; display:flex; align-items:center; gap:8px; }
#btn-undo { width:32px; height:32px; border-radius:7px; border:1px solid rgba(255,255,255,.1);
  background:transparent; color:#8888a8; cursor:pointer; font-size:15px; display:flex;
  align-items:center; justify-content:center; transition:all .15s; }
#btn-undo:hover:not(:disabled) { background:rgba(255,255,255,.07); color:#eeeef8; }
#btn-undo:disabled { opacity:.3; cursor:default; }
#zoom-sel { height:32px; padding:0 8px; background:#16162a; border:1px solid rgba(255,255,255,.12);
  border-radius:7px; color:#eeeef8; font-size:12px; cursor:pointer; }
#btn-download { padding:8px 18px; background:linear-gradient(135deg,#5b5cff,#7475ff);
  color:#fff; border:none; border-radius:7px; font-size:13px; font-weight:700;
  cursor:pointer; transition:all .2s; white-space:nowrap; }
#btn-download:hover { transform:translateY(-1px); box-shadow:0 3px 14px rgba(91,92,255,.5); }
#btn-download:disabled { opacity:.5; cursor:default; transform:none; box-shadow:none; }
#btn-close-editor { width:32px; height:32px; border-radius:7px; border:1px solid rgba(255,255,255,.1);
  background:transparent; color:#8888a8; cursor:pointer; font-size:16px; display:flex;
  align-items:center; justify-content:center; transition:all .15s; }
#btn-close-editor:hover { background:rgba(255,100,100,.15); color:#ff6b6b; border-color:rgba(255,100,100,.3); }

/* ─── Format bar ───────────────────────────────────────── */
#format-bar {
  display:none; align-items:center; gap:4px; padding:0 14px;
  height:42px; background:#12122a; border-bottom:1px solid rgba(255,255,255,.08);
  flex-shrink:0; overflow-x:auto; flex-wrap:nowrap;
}
#format-bar.visible { display:flex; }
.fmt-sep { width:1px; height:20px; background:rgba(255,255,255,.1); margin:0 4px; flex-shrink:0; }
.fmt-btn { width:30px; height:28px; border-radius:5px; border:1px solid rgba(255,255,255,.1);
  background:transparent; color:#8888a8; cursor:pointer; font-size:13px; font-weight:700;
  display:flex; align-items:center; justify-content:center; transition:all .12s; flex-shrink:0; }
.fmt-btn:hover { background:rgba(255,255,255,.08); color:#eeeef8; }
.fmt-btn.on { background:rgba(91,92,255,.25); color:#9898ff; border-color:rgba(91,92,255,.4); }
.fmt-sel { height:28px; padding:0 7px; background:#16162a; border:1px solid rgba(255,255,255,.12);
  border-radius:5px; color:#eeeef8; font-size:12px; cursor:pointer; flex-shrink:0; }
#fmt-color { width:28px; height:28px; padding:2px; border-radius:5px; cursor:pointer;
  border:1px solid rgba(255,255,255,.15); background:#16162a; flex-shrink:0; }
#fmt-color::-webkit-color-swatch-wrapper { padding:0; }
#fmt-color::-webkit-color-swatch { border:none; border-radius:3px; }
.fmt-label { font-size:11px; color:#8888a8; flex-shrink:0; }
#btn-del-box { padding:0 10px; height:28px; border-radius:5px; border:1px solid rgba(255,100,100,.3);
  background:transparent; color:#ff6b6b; cursor:pointer; font-size:12px; font-weight:600;
  white-space:nowrap; flex-shrink:0; }
#btn-del-box:hover { background:rgba(255,100,100,.1); }

/* ─── Editor body ──────────────────────────────────────── */
#editor-body { flex:1; overflow:auto; display:flex; justify-content:center;
  padding:32px 20px 60px; background:#111118; }
#pages-col { display:flex; flex-direction:column; gap:28px; align-items:center; }

/* ─── Page ─────────────────────────────────────────────── */
.page-wrap { position:relative; display:inline-block;
  box-shadow:0 8px 48px rgba(0,0,0,.7); cursor:crosshair; }
.page-wrap canvas { display:block; pointer-events:none; }

/* ─── Annotation layer ─────────────────────────────────── */
.annot-layer { position:absolute; inset:0; overflow:hidden; }

/* ─── PDF text zones (hover targets) ──────────────────── */
.pdf-zone { position:absolute; cursor:text; border-radius:2px; transition:background .1s; }
.pdf-zone:hover { background:rgba(255,220,50,.2); outline:1px dashed rgba(255,200,50,.5); }

/* ─── Text boxes (editable annotations) ───────────────── */
.tbox {
  position:absolute; cursor:move; min-width:30px; min-height:18px;
  padding:3px 5px; border:1.5px dashed transparent; border-radius:3px;
  outline:none; word-break:break-word; white-space:pre-wrap;
  transition:border-color .12s; z-index:5;
  line-height:1.25;
}
.tbox:hover { border-color:rgba(91,92,255,.5); }
.tbox.selected { border-color:#5b5cff !important; box-shadow:0 0 0 3px rgba(91,92,255,.18); z-index:10; }
.tbox.editing { cursor:text; }
.tbox-new { background:rgba(255,255,255,.95); color:#111; }
.tbox-existing { background:rgba(255,255,255,.97); color:#111; }

/* ─── Whiteout ─────────────────────────────────────────── */
.wout-rect { position:absolute; background:#fff; z-index:4; cursor:move; border:1.5px dashed transparent; }
.wout-rect:hover,.wout-rect.selected { border-color:#ff6b6b; box-shadow:0 0 0 3px rgba(255,107,107,.15); }

/* ─── Highlight ────────────────────────────────────────── */
.hl-rect { position:absolute; background:rgba(255,220,50,.45); z-index:3; cursor:move;
  border:1.5px dashed transparent; }
.hl-rect:hover,.hl-rect.selected { border-color:#ffcc44; }

/* ─── Draw rubber-band ─────────────────────────────────── */
#rubber-band { position:fixed; pointer-events:none; z-index:200; border:2px dashed #5b5cff;
  background:rgba(91,92,255,.08); display:none; }

/* ─── Loading ──────────────────────────────────────────── */
#editor-loading { position:absolute; inset:0; z-index:50; background:rgba(17,17,24,.92);
  display:flex; flex-direction:column; align-items:center; justify-content:center; gap:14px; }
.spin { width:40px; height:40px; border:3px solid rgba(91,92,255,.2); border-top-color:#5b5cff;
  border-radius:50%; animation:spin .7s linear infinite; }
@keyframes spin { to { transform:rotate(360deg) } }
#loading-msg { color:#8888a8; font-size:13px; }

/* ─── Status tip ───────────────────────────────────────── */
#status-tip { position:absolute; bottom:20px; left:50%; transform:translateX(-50%);
  background:#1e1e33; border:1px solid rgba(255,255,255,.12); border-radius:8px;
  padding:8px 16px; font-size:12px; color:#8888a8; pointer-events:none;
  opacity:0; transition:opacity .25s; white-space:nowrap; z-index:30; }
#status-tip.show { opacity:1; }

/* ─── AI Form Fill Modal ───────────────────────────────── */
#ai-fill-modal { display:none; position:fixed; inset:0; z-index:300;
  background:rgba(0,0,0,.75); backdrop-filter:blur(6px);
  align-items:center; justify-content:center; padding:20px; }
#ai-fill-modal.open { display:flex; }
#ai-fill-card { background:#16162a; border:1px solid rgba(255,255,255,.12);
  border-radius:16px; padding:28px; width:100%; max-width:520px;
  box-shadow:0 24px 64px rgba(0,0,0,.7); }
.aif-title { font-size:18px; font-weight:800; color:#eeeef8; margin:0 0 6px; }
.aif-sub { font-size:13px; color:#8888a8; margin:0 0 20px; line-height:1.55; }
#ai-fields-status { display:flex; align-items:center; gap:8px; flex-wrap:wrap;
  min-height:26px; margin-bottom:14px; font-size:12px; color:#8888a8; }
.aif-badge { background:rgba(0,229,160,.15); border:1px solid rgba(0,229,160,.3);
  border-radius:6px; padding:3px 10px; color:#00e5a0; font-size:11px; font-weight:700; flex-shrink:0; }
.aif-badge.warn { background:rgba(255,153,68,.1); border-color:rgba(255,153,68,.35); color:#ff9944; }
#ai-info-input { width:100%; min-height:100px; background:#0d0d1f;
  border:1px solid rgba(255,255,255,.12); border-radius:10px;
  color:#eeeef8; font-size:13px; padding:12px 14px; resize:vertical;
  font-family:inherit; line-height:1.6; }
#ai-info-input:focus { outline:none; border-color:rgba(91,92,255,.5); }
#ai-info-input::placeholder { color:#44445a; }
.aif-actions { display:flex; gap:8px; margin-top:16px; }
#btn-aif-cancel { flex:1; padding:10px; background:transparent;
  color:#8888a8; border:1px solid rgba(255,255,255,.1); border-radius:10px;
  font-size:13px; cursor:pointer; transition:all .15s; }
#btn-aif-cancel:hover { background:rgba(255,255,255,.05); color:#eeeef8; }
#btn-aif-run { flex:2; padding:10px 18px;
  background:linear-gradient(135deg,#5b5cff,#7b7cff);
  color:#fff; border:none; border-radius:10px; font-size:14px; font-weight:700;
  cursor:pointer; transition:all .2s; }
#btn-aif-run:hover:not(:disabled) { transform:translateY(-1px); box-shadow:0 4px 20px rgba(91,92,255,.5); }
#btn-aif-run:disabled { opacity:.5; cursor:default; transform:none; box-shadow:none; }
#aif-result { margin-top:16px; max-height:220px; overflow-y:auto; display:none; }
.aif-result-row { display:flex; justify-content:space-between; align-items:center;
  padding:7px 12px; background:#0d0d1f; border-radius:8px; margin-bottom:5px; font-size:12px; }
.aif-rkey { color:#8888a8; flex-shrink:0; margin-right:8px; }
.aif-rval { color:#eeeef8; font-weight:600; text-align:right; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width:240px; }
</style>

{{-- ── UPLOAD STATE ──────────────────────────────────────────────── --}}
<div id="state-upload">
  <div class="hero">
    <div class="badge">✏️ Advanced PDF Editor</div>
    <h1>Edit PDF Text Online</h1>
    <p>Click any text to edit it, add new text anywhere, whiteout content, highlight — and download your edited PDF instantly.</p>
  </div>

  <div class="tool-box" style="max-width:620px;">
    <div class="upload-area" id="upload-dz" onclick="document.getElementById('pdfFile').click()">
      <div class="upload-icon">📄</div>
      <div class="upload-title">Drop your PDF here</div>
      <div class="upload-sub">Click to browse · Processed in your browser · Private &amp; secure</div>
      <input type="file" id="pdfFile" accept=".pdf" style="display:none" onchange="openEditor(this.files[0])">
    </div>
    <p style="text-align:center;color:#44445a;font-size:12px;margin-top:12px;">
      Your PDF never leaves your device — 100% browser-based
    </p>
  </div>

  {{-- Feature highlights --}}
  <div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">What You Can Do</h2>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
      @foreach([
        ['✏️','Edit Existing Text','Click any text on the PDF to edit it directly in place.'],
        ['➕','Add New Text','Click any blank area to add a new text box anywhere.'],
        ['⬜','Whiteout Tool','Draw white rectangles to erase or cover any content.'],
        ['🖊','Highlight','Drag to highlight important text in yellow.'],
        ['🎨','Rich Formatting','Change font, size, color, bold, italic per text box.'],
        ['⬇️','Instant Download','Download your edited PDF with one click.'],
      ] as $f)
      <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:18px;text-align:center;">
        <div style="font-size:26px;margin-bottom:8px;">{{ $f[0] }}</div>
        <div style="font-weight:600;font-size:13px;margin-bottom:5px;">{{ $f[1] }}</div>
        <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $f[2] }}</div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="faq">
    <h2>Frequently Asked Questions</h2>
    <div class="faq-item">
      <h3>Is this better than Sejda PDF Editor?</h3>
      <p>Yes. PDFTash PDF Editor offers the same core features as Sejda — click to edit text, add text, whiteout — with no 3-tasks/day limit and complete browser-based privacy. Your PDF never gets uploaded to any server.</p>
    </div>
    <div class="faq-item">
      <h3>Can I edit any PDF?</h3>
      <p>You can edit any PDF with selectable text. Scanned image PDFs don't have editable text — you'd need OCR for those. You can still add new text and use whiteout on any PDF.</p>
    </div>
    <div class="faq-item">
      <h3>Is my PDF safe?</h3>
      <p>100% safe. Your PDF is processed entirely in your browser using JavaScript. It is never sent to our servers. Everything stays on your device.</p>
    </div>
    <div class="faq-item">
      <h3>Will fonts look the same?</h3>
      <p>The original PDF layout is preserved perfectly. Edited text is redrawn with matching size and position using standard fonts. The overall document appearance stays intact.</p>
    </div>
  </div>
</div>

{{-- ── EDITOR SHELL ───────────────────────────────────────────────── --}}
<div id="pdf-editor-shell">

  {{-- Main toolbar --}}
  <div id="main-bar">
    <span class="bar-logo">PDFTash</span>
    <span class="bar-fname" id="bar-fname">document.pdf</span>
    <div class="bar-sep"></div>

    {{-- Tool buttons --}}
    <button class="tool-btn active" id="btn-select" onclick="setMode('select')" title="Select / Move">
      <span class="ti">↖</span> Select
    </button>
    <button class="tool-btn" id="btn-text-tool" onclick="setMode('text')" title="Add text anywhere">
      <span class="ti">T</span> Text
    </button>
    <button class="tool-btn" id="btn-whiteout" onclick="setMode('whiteout')" title="Whiteout / Erase">
      <span class="ti">⬜</span> Whiteout
    </button>
    <button class="tool-btn" id="btn-highlight" onclick="setMode('highlight')" title="Highlight text">
      <span class="ti">🖊</span> Highlight
    </button>

    <div class="bar-sep"></div>

    <div id="bar-right">
      <button id="btn-undo" onclick="undo()" title="Undo (Ctrl+Z)" disabled>↩</button>
      <select id="zoom-sel" onchange="applyZoom(this.value)">
        <option value="0.8">80%</option>
        <option value="1" selected>100%</option>
        <option value="1.25">125%</option>
        <option value="1.5">150%</option>
        <option value="2">200%</option>
      </select>
      <span id="change-pill" style="display:none;padding:3px 10px;background:rgba(0,229,160,.15);
        border:1px solid rgba(0,229,160,.3);border-radius:99px;font-size:11px;font-weight:700;color:#00e5a0;"></span>
      <button id="btn-ai-fill" onclick="openAIFillModal()" title="AI Form Fill — auto-fill form fields with AI"
        style="padding:8px 14px;background:linear-gradient(135deg,rgba(91,92,255,.25),rgba(123,124,255,.2));
          color:#9898ff;border:1px solid rgba(91,92,255,.4);border-radius:7px;
          font-size:12px;font-weight:700;cursor:pointer;white-space:nowrap;
          transition:all .2s;display:flex;align-items:center;gap:5px;">
        ✨ AI Fill
      </button>
      <button id="btn-download" onclick="saveAndDownload()">⬇ Download PDF</button>
      <button id="btn-close-editor" onclick="closeEditor()" title="Close editor">✕</button>
    </div>
  </div>

  {{-- Format bar --}}
  <div id="format-bar">
    <span class="fmt-label">Font</span>
    <select class="fmt-sel" id="fmt-family" onchange="applyFormat('fontFamily',this.value)" style="width:110px;">
      <option value="Helvetica">Helvetica</option>
      <option value="Times New Roman">Times New Roman</option>
      <option value="Courier New">Courier New</option>
      <option value="Georgia">Georgia</option>
      <option value="Arial">Arial</option>
    </select>
    <select class="fmt-sel" id="fmt-size" onchange="applyFormat('fontSize',this.value+'px')" style="width:64px;">
      @foreach([8,9,10,11,12,14,16,18,20,24,28,32,36,42,48,56,64,72] as $s)
      <option value="{{ $s }}" {{ $s==14?'selected':'' }}>{{ $s }}</option>
      @endforeach
    </select>
    <div class="fmt-sep"></div>
    <button class="fmt-btn" id="fmt-bold"      onclick="toggleFormat('fontWeight','bold','normal')"    title="Bold"><b>B</b></button>
    <button class="fmt-btn" id="fmt-italic"    onclick="toggleFormat('fontStyle','italic','normal')"   title="Italic"><i>I</i></button>
    <button class="fmt-btn" id="fmt-underline" onclick="toggleFormat('textDecoration','underline','none')" title="Underline"><u>U</u></button>
    <div class="fmt-sep"></div>
    <span class="fmt-label">Color</span>
    <input type="color" id="fmt-color" value="#000000" onchange="applyFormat('color',this.value)" title="Text color">
    <div class="fmt-sep"></div>
    <button class="fmt-btn" onclick="applyFormat('textAlign','left')"   title="Align left">⬅</button>
    <button class="fmt-btn" onclick="applyFormat('textAlign','center')" title="Center">↔</button>
    <button class="fmt-btn" onclick="applyFormat('textAlign','right')"  title="Align right">➡</button>
    <div class="fmt-sep"></div>
    <button id="btn-del-box" onclick="deleteSelected()">🗑 Delete</button>
  </div>

  {{-- Editor body --}}
  <div id="editor-body">
    <div id="pages-col"></div>
  </div>

  {{-- Loading --}}
  <div id="editor-loading">
    <div class="spin"></div>
    <div id="loading-msg">Opening PDF…</div>
  </div>

  {{-- Status tip --}}
  <div id="status-tip"></div>
</div>

{{-- Rubber band for draw tools --}}
<div id="rubber-band"></div>

{{-- ── AI FORM FILL MODAL ─────────────────────────────────────────── --}}
<div id="ai-fill-modal" onclick="if(event.target===this)closeAIFillModal()">
  <div id="ai-fill-card">
    <p class="aif-title">✨ AI Form Fill</p>
    <p class="aif-sub">Describe yourself and the AI will automatically detect form fields and fill them in for you.</p>

    <div id="ai-fields-status">
      <div class="spin" style="width:14px;height:14px;border-width:2px;flex-shrink:0;"></div>
      <span>Scanning PDF for form fields…</span>
    </div>

    <textarea id="ai-info-input"
      placeholder="Example: My name is Sarah Johnson. Email: sarah@example.com. Phone: +1 (555) 987-6543. Company: TechCorp Inc. Address: 456 Oak Avenue, San Francisco, CA 94102. Date of birth: March 8, 1988. Job title: Software Engineer."></textarea>

    <div class="aif-actions">
      <button id="btn-aif-cancel" onclick="closeAIFillModal()">Cancel</button>
      <button id="btn-aif-run" onclick="runAIFill()">✨ Fill Form with AI</button>
    </div>

    <div id="aif-result"></div>
  </div>
</div>

<script>
/* ══════════════════════════════════════════════════════════════════
   LIBRARY LOADING
══════════════════════════════════════════════════════════════════ */
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

/* ══════════════════════════════════════════════════════════════════
   STATE
══════════════════════════════════════════════════════════════════ */
let pdfJsDoc = null, pdfBytes = null;
let scale = 1, totalPages = 0;
let mode = 'select';           // select | text | whiteout | highlight
let selected = null;           // currently selected DOM element
let undoStack = [];
let isDirty = false;
let fileName = 'document.pdf';

// Page dimensions store: { pageNum -> { w, h } } in PDF points
const pageDims = {};

/* ══════════════════════════════════════════════════════════════════
   UPLOAD / DRAG-DROP
══════════════════════════════════════════════════════════════════ */
const uploadDz = document.getElementById('upload-dz');
uploadDz.addEventListener('dragover', e => { e.preventDefault(); uploadDz.style.borderColor='#5b5cff'; });
uploadDz.addEventListener('dragleave', () => uploadDz.style.borderColor='');
uploadDz.addEventListener('drop', e => {
  e.preventDefault(); uploadDz.style.borderColor='';
  const f = e.dataTransfer.files[0];
  if (f?.name.toLowerCase().endsWith('.pdf')) openEditor(f);
  else alert('Please drop a PDF file.');
});

/* ══════════════════════════════════════════════════════════════════
   OPEN / CLOSE EDITOR
══════════════════════════════════════════════════════════════════ */
async function openEditor(file) {
  if (!file) return;
  await waitForLibs();

  fileName = file.name;
  document.getElementById('bar-fname').textContent = file.name;
  showEditorLoading('Reading PDF…');
  document.getElementById('pdf-editor-shell').classList.add('open');
  document.getElementById('state-upload').style.display = 'none';

  try {
    pdfBytes = await file.arrayBuffer();
    pdfJsDoc = await pdfjsLib.getDocument({ data: pdfBytes.slice(0) }).promise;
    totalPages = pdfJsDoc.numPages;
    await renderAll();
    hideEditorLoading();
    tipShow('✏️ Click existing text to edit it · Click blank space (in Text mode) to add text');
  } catch(e) {
    hideEditorLoading();
    alert('Could not open PDF: ' + e.message);
    closeEditor();
  }
}

function closeEditor() {
  document.getElementById('pdf-editor-shell').classList.remove('open');
  document.getElementById('state-upload').style.display = 'block';
  document.getElementById('pages-col').innerHTML = '';
  pdfJsDoc = null; pdfBytes = null; selected = null; undoStack = [];
  isDirty = false; updateUndoBtn(); updateChangePill();
}

async function waitForLibs(maxMs = 8000) {
  const t0 = Date.now();
  while ((!window.pdfjsLib || !window.PDFLib) && Date.now()-t0 < maxMs)
    await new Promise(r => setTimeout(r, 150));
  if (!window.pdfjsLib || !window.PDFLib) throw new Error('PDF libraries failed to load.');
}

/* ══════════════════════════════════════════════════════════════════
   RENDER
══════════════════════════════════════════════════════════════════ */
async function renderAll() {
  const col = document.getElementById('pages-col');
  col.innerHTML = '';
  for (let p = 1; p <= totalPages; p++) {
    document.getElementById('loading-msg').textContent = `Rendering page ${p} / ${totalPages}…`;
    col.appendChild(await buildPageEl(p));
  }
}

async function buildPageEl(pageNum) {
  const page     = await pdfJsDoc.getPage(pageNum);
  const viewport = page.getViewport({ scale });
  pageDims[pageNum] = { w: page.getViewport({scale:1}).width, h: page.getViewport({scale:1}).height };

  // Canvas
  const canvas = document.createElement('canvas');
  canvas.width  = viewport.width;
  canvas.height = viewport.height;
  await page.render({ canvasContext: canvas.getContext('2d'), viewport }).promise;

  // Text zones from PDF text content
  const tc       = await page.getTextContent();
  const annotDiv = document.createElement('div');
  annotDiv.className  = 'annot-layer';
  annotDiv.dataset.page = pageNum;
  buildTextZones(tc, viewport, annotDiv, pageNum);

  // Page wrapper
  const wrap = document.createElement('div');
  wrap.className = 'page-wrap';
  wrap.dataset.page = pageNum;
  wrap.style.width  = viewport.width + 'px';
  wrap.style.height = viewport.height + 'px';
  wrap.appendChild(canvas);
  wrap.appendChild(annotDiv);

  // Interaction on annotation layer
  annotDiv.addEventListener('mousedown', e => onAnnotMousedown(e, pageNum));

  return wrap;
}

/* ── Build clickable text zones from PDF.js text content ── */
function buildTextZones(tc, viewport, layer, pageNum) {
  const blocks = groupTextItems(tc.items, viewport);
  blocks.forEach(b => {
    const zone = document.createElement('div');
    zone.className   = 'pdf-zone';
    zone.dataset.page = pageNum;
    zone.dataset.origText = b.str;
    zone.dataset.pdfX  = b.pdfX;
    zone.dataset.pdfY  = b.pdfY;
    zone.dataset.pdfW  = b.pdfW;
    zone.dataset.pdfH  = b.pdfH;
    zone.dataset.pdfFs = b.pdfFontSize;
    zone.style.cssText = `left:${b.x}px;top:${b.y}px;width:${b.w}px;height:${b.h}px;`;
    zone.addEventListener('mousedown', e => {
      e.stopPropagation();
      onZoneClick(zone, b);
    });
    layer.appendChild(zone);
  });
}

/* ── Convert PDF.js text items into editable blocks ── */
function groupTextItems(items, viewport) {
  const pts = items.filter(i => i.str?.trim()).map(i => {
    const tx = pdfjsLib.Util.transform(viewport.transform, i.transform);
    const fh = Math.sqrt(tx[2]*tx[2] + tx[3]*tx[3]);
    return {
      str:tx[4], // use as key; actual below
      x:tx[4], y:tx[5]-fh, bottom:tx[5],
      w:Math.abs(i.width*viewport.scale), h:fh,
      str:i.str, fontSize:fh,
      pdfX:i.transform[4], pdfY:i.transform[5],
      pdfW:Math.abs(i.width), pdfH:fh/viewport.scale,
      pdfFontSize:Math.sqrt(i.transform[0]**2+i.transform[1]**2),
    };
  }).filter(i => i.w>0 && i.h>0);

  if (!pts.length) return [];
  pts.sort((a,b) => Math.abs(a.bottom-b.bottom) > a.h*.4 ? a.bottom-b.bottom : a.x-b.x);

  const blocks=[], grp=[pts[0]];
  for (let i=1; i<pts.length; i++) {
    const c=pts[i], l=grp[grp.length-1];
    if (Math.abs(c.bottom-l.bottom)<l.h*.4 && c.x-(l.x+l.w)<l.h*1.8) grp.push(c);
    else { blocks.push(mergeGrp(grp)); grp.length=0; grp.push(c); }
  }
  blocks.push(mergeGrp(grp));
  return blocks;
}

function mergeGrp(items) {
  const str=items.map(i=>i.str).join('');
  const x=Math.min(...items.map(i=>i.x));
  const right=Math.max(...items.map(i=>i.x+i.w));
  const y=Math.min(...items.map(i=>i.y));
  const bot=Math.max(...items.map(i=>i.bottom));
  const fi=items[0];
  return { str, x, y, w:right-x, h:bot-y,
    fontSize:fi.fontSize, pdfX:fi.pdfX, pdfY:fi.pdfY,
    pdfW:items.reduce((s,i)=>s+i.pdfW,0), pdfH:fi.pdfH, pdfFontSize:fi.pdfFontSize };
}

/* ══════════════════════════════════════════════════════════════════
   INTERACTION
══════════════════════════════════════════════════════════════════ */
function onAnnotMousedown(e, pageNum) {
  if (e.target.classList.contains('pdf-zone')) return; // handled by zone

  deselect();

  if (mode === 'text') {
    // Add new text box at click position
    const layer = e.currentTarget;
    const rect  = layer.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    const box = createTextBox(layer, x, y, '', pageNum, false);
    pushUndo({ type:'delete', el:box });
    focusBox(box);
    e.stopPropagation();

  } else if (mode === 'whiteout' || mode === 'highlight') {
    startDraw(e, pageNum, mode);
    e.stopPropagation();
  }
  // select mode: click on empty layer = deselect
}

function onZoneClick(zone, block) {
  if (mode !== 'select' && mode !== 'text') return;

  // Check if already converted to a tbox
  const existing = zone.parentElement?.querySelector(
    `.tbox[data-zone-id="${zone.dataset.zoneId}"]`
  );
  if (existing) { selectEl(existing); focusBox(existing); return; }

  // Convert zone to editable text box
  const layer = zone.parentElement;
  const zoneId = 'z' + Math.random().toString(36).slice(2);
  zone.dataset.zoneId = zoneId;

  const box = createTextBox(layer, block.x, block.y, block.str, zone.dataset.page, true);
  box.dataset.zoneId   = zoneId;
  box.dataset.origText = block.str;
  box.dataset.pdfX     = block.pdfX;
  box.dataset.pdfY     = block.pdfY;
  box.dataset.pdfW     = block.pdfW;
  box.dataset.pdfH     = block.pdfH;
  box.dataset.pdfFs    = block.pdfFontSize;
  box.style.fontSize   = block.fontSize + 'px';
  box.style.minWidth   = block.w + 'px';
  zone.style.display   = 'none'; // hide zone

  pushUndo({ type:'zone-restore', zone, box });
  focusBox(box);
  markDirty();
}

/* ── Create a text box div ── */
function createTextBox(layer, x, y, text, pageNum, isExisting) {
  const box = document.createElement('div');
  box.className     = 'tbox ' + (isExisting ? 'tbox-existing' : 'tbox-new');
  box.contentEditable = 'false';
  box.dataset.page  = pageNum;
  box.textContent   = text;
  box.style.cssText = `left:${x}px;top:${y}px;font-size:14px;color:#111;
    font-family:Helvetica,Arial,sans-serif;`;

  makeDraggable(box);

  box.addEventListener('mousedown', e => {
    e.stopPropagation();
    selectEl(box);
    if (e.detail === 2) focusBox(box); // double-click to edit
  });

  box.addEventListener('blur', () => {
    box.contentEditable = 'false';
    box.classList.remove('editing');
    updateChangePill();
  });

  box.addEventListener('input', () => markDirty());

  layer.appendChild(box);
  selectEl(box);
  return box;
}

function focusBox(box) {
  box.contentEditable = 'true';
  box.classList.add('editing');
  box.focus();
  // Move caret to end
  const r = document.createRange();
  r.selectNodeContents(box); r.collapse(false);
  window.getSelection().removeAllRanges();
  window.getSelection().addRange(r);
}

/* ══════════════════════════════════════════════════════════════════
   DRAW TOOLS (Whiteout / Highlight)
══════════════════════════════════════════════════════════════════ */
function startDraw(e, pageNum, drawMode) {
  const layer = e.currentTarget;
  const rect  = layer.getBoundingClientRect();
  let startX  = e.clientX - rect.left;
  let startY  = e.clientY - rect.top;

  const rb = document.getElementById('rubber-band');
  rb.style.cssText = `display:block;left:${e.clientX}px;top:${e.clientY}px;width:0;height:0;
    border-color:${drawMode==='whiteout'?'#ff6b6b':'#ffcc44'};
    background:${drawMode==='whiteout'?'rgba(255,255,255,.8)':'rgba(255,220,50,.3)'};`;

  function onMove(ev) {
    const cx = ev.clientX - rect.left;
    const cy = ev.clientY - rect.top;
    const x = Math.min(startX, cx), y = Math.min(startY, cy);
    const w = Math.abs(cx - startX), h = Math.abs(cy - startY);
    const screenX = x + rect.left, screenY = y + rect.top;
    rb.style.cssText = `display:block;left:${screenX}px;top:${screenY}px;width:${w}px;height:${h}px;
      border:2px dashed ${drawMode==='whiteout'?'#ff6b6b':'#ffcc44'};
      background:${drawMode==='whiteout'?'rgba(255,255,255,.7)':'rgba(255,220,50,.3)'};position:fixed;z-index:200;`;
  }

  function onUp(ev) {
    rb.style.display = 'none';
    document.removeEventListener('mousemove', onMove);
    document.removeEventListener('mouseup', onUp);

    const cx = ev.clientX - rect.left;
    const cy = ev.clientY - rect.top;
    const x = Math.min(startX, cx), y = Math.min(startY, cy);
    const w = Math.abs(cx - startX), h = Math.abs(cy - startY);
    if (w < 5 || h < 5) return;

    const el = document.createElement('div');
    el.className = drawMode === 'whiteout' ? 'wout-rect' : 'hl-rect';
    el.dataset.page = pageNum;
    el.style.cssText = `left:${x}px;top:${y}px;width:${w}px;height:${h}px;`;
    makeDraggable(el);
    el.addEventListener('mousedown', ev2 => { ev2.stopPropagation(); selectEl(el); });
    layer.appendChild(el);
    selectEl(el);
    pushUndo({ type:'delete', el });
    markDirty();
  }

  document.addEventListener('mousemove', onMove);
  document.addEventListener('mouseup', onUp);
}

/* ══════════════════════════════════════════════════════════════════
   DRAG TO MOVE
══════════════════════════════════════════════════════════════════ */
function makeDraggable(el) {
  let dragging=false, ox, oy, ex, ey;

  el.addEventListener('mousedown', e => {
    if (el.contentEditable === 'true') return; // editing
    dragging = true;
    ox = parseFloat(el.style.left)||0;
    oy = parseFloat(el.style.top)||0;
    ex = e.clientX; ey = e.clientY;
    e.preventDefault();
  });

  document.addEventListener('mousemove', e => {
    if (!dragging) return;
    el.style.left = ox + (e.clientX - ex) + 'px';
    el.style.top  = oy + (e.clientY - ey) + 'px';
  });

  document.addEventListener('mouseup', () => { if (dragging) { dragging=false; markDirty(); } });
}

/* ══════════════════════════════════════════════════════════════════
   SELECTION & FORMAT BAR
══════════════════════════════════════════════════════════════════ */
function selectEl(el) {
  if (selected && selected !== el) selected.classList.remove('selected');
  selected = el;
  el.classList.add('selected');

  const isText = el.classList.contains('tbox');
  const fbar = document.getElementById('format-bar');
  fbar.className = isText ? 'visible' : '';
  if (isText) syncFormatBar(el);
}

function deselect() {
  if (selected) {
    if (selected.contentEditable === 'true') {
      selected.contentEditable = 'false';
      selected.classList.remove('editing');
    }
    selected.classList.remove('selected');
    selected = null;
  }
  document.getElementById('format-bar').className = '';
}

function syncFormatBar(box) {
  const cs = window.getComputedStyle(box);
  document.getElementById('fmt-family').value    = cs.fontFamily.split(',')[0].replace(/['"]/g,'').trim();
  document.getElementById('fmt-size').value      = Math.round(parseFloat(cs.fontSize));
  document.getElementById('fmt-color').value     = rgbToHex(cs.color);
  document.getElementById('fmt-bold').classList.toggle('on',      cs.fontWeight >= 600);
  document.getElementById('fmt-italic').classList.toggle('on',    cs.fontStyle === 'italic');
  document.getElementById('fmt-underline').classList.toggle('on', cs.textDecoration.includes('underline'));
}

function applyFormat(prop, val) {
  if (!selected || !selected.classList.contains('tbox')) return;
  selected.style[prop] = val;
  markDirty();
}

function toggleFormat(prop, on, off) {
  if (!selected || !selected.classList.contains('tbox')) return;
  const cur = window.getComputedStyle(selected)[prop];
  const isOn = prop === 'fontWeight' ? cur >= 600 : cur === on;
  selected.style[prop] = isOn ? off : on;
  const btn = { fontWeight:'fmt-bold', fontStyle:'fmt-italic', textDecoration:'fmt-underline' }[prop];
  document.getElementById(btn)?.classList.toggle('on', !isOn);
  markDirty();
}

function deleteSelected() {
  if (!selected) return;
  pushUndo({ type:'restore', el:selected, parent:selected.parentElement,
    next:selected.nextSibling });
  // Restore zone if applicable
  if (selected.dataset.zoneId) {
    const zone = selected.parentElement?.querySelector(
      `.pdf-zone[data-zone-id="${selected.dataset.zoneId}"]`
    );
    if (zone) zone.style.display = '';
  }
  selected.remove();
  selected = null;
  document.getElementById('format-bar').className = '';
  markDirty();
}

// Click outside → deselect
document.addEventListener('mousedown', e => {
  if (!selected) return;
  if (!selected.contains(e.target) && !e.target.closest('#format-bar')) {
    deselect();
  }
});

/* ══════════════════════════════════════════════════════════════════
   MODE
══════════════════════════════════════════════════════════════════ */
const modeMap = { select:'btn-select', text:'btn-text-tool',
                  whiteout:'btn-whiteout', highlight:'btn-highlight' };
function setMode(m) {
  mode = m;
  Object.keys(modeMap).forEach(k => document.getElementById(modeMap[k])?.classList.toggle('active', k===m));
  document.querySelectorAll('.page-wrap').forEach(pw => {
    pw.style.cursor = m==='text' ? 'text' : m==='whiteout'||m==='highlight' ? 'crosshair' : 'default';
  });
  const tips = { select:'↖ Click text to edit · Drag elements to move',
    text:'T Click anywhere to add a new text box', whiteout:'⬜ Drag to draw a white rectangle',
    highlight:'🖊 Drag to highlight text' };
  tipShow(tips[m]);
}

/* ══════════════════════════════════════════════════════════════════
   ZOOM
══════════════════════════════════════════════════════════════════ */
async function applyZoom(val) {
  scale = parseFloat(val);
  showEditorLoading('Re-rendering…');
  await renderAll();
  hideEditorLoading();
}

/* ══════════════════════════════════════════════════════════════════
   UNDO
══════════════════════════════════════════════════════════════════ */
function pushUndo(action) {
  undoStack.push(action);
  if (undoStack.length > 40) undoStack.shift();
  updateUndoBtn();
}

function undo() {
  if (!undoStack.length) return;
  const action = undoStack.pop();
  if (action.type === 'delete') {
    action.el.remove();
  } else if (action.type === 'restore') {
    action.parent.insertBefore(action.el, action.next);
  } else if (action.type === 'zone-restore') {
    action.box.remove();
    action.zone.style.display = '';
  }
  updateUndoBtn();
  updateChangePill();
}

document.addEventListener('keydown', e => {
  if ((e.ctrlKey || e.metaKey) && e.key === 'z') { e.preventDefault(); undo(); }
  if (e.key === 'Delete' && selected && !selected.isContentEditable) deleteSelected();
  if (e.key === 'Escape') deselect();
});

function updateUndoBtn() {
  document.getElementById('btn-undo').disabled = undoStack.length === 0;
}

/* ══════════════════════════════════════════════════════════════════
   SAVE WITH PDF-LIB
══════════════════════════════════════════════════════════════════ */
async function saveAndDownload() {
  if (!pdfBytes) return;
  const btn = document.getElementById('btn-download');
  btn.disabled = true; btn.textContent = '⏳ Saving…';

  try {
    const { PDFDocument, StandardFonts, rgb, BlendMode } = PDFLib;
    const doc = await PDFDocument.load(pdfBytes);

    // Embed all font variants
    const fonts = {
      regular   : await doc.embedFont(StandardFonts.Helvetica),
      bold      : await doc.embedFont(StandardFonts.HelveticaBold),
      italic    : await doc.embedFont(StandardFonts.HelveticaOblique),
      boldItalic: await doc.embedFont(StandardFonts.HelveticaBoldOblique),
      mono      : await doc.embedFont(StandardFonts.Courier),
      serif     : await doc.embedFont(StandardFonts.TimesRoman),
    };

    // Collect all annotation elements (tboxes, wout-rects, hl-rects)
    const elems = document.querySelectorAll(
      '.tbox, .wout-rect, .hl-rect'
    );

    for (const el of elems) {
      const pageNum = parseInt(el.dataset.page);
      if (!pageNum) continue;
      const pdfPage = doc.getPage(pageNum - 1);
      const { width: pw, height: ph } = pdfPage.getSize();
      const dims = pageDims[pageNum] || { w: pw, h: ph };

      // Convert screen → PDF coordinates
      const sx = parseFloat(el.style.left)  || 0;
      const sy = parseFloat(el.style.top)   || 0;
      const sw = parseFloat(el.style.width) || el.offsetWidth;
      const sh = parseFloat(el.style.height)|| el.offsetHeight;

      const pdfX = sx / scale;
      const pdfY = dims.h - (sy + sh) / scale;  // flip Y
      const pdfW = sw / scale;
      const pdfH = sh / scale;

      /* ── Whiteout ── */
      if (el.classList.contains('wout-rect')) {
        pdfPage.drawRectangle({ x:pdfX, y:pdfY, width:pdfW+.5, height:pdfH+.5, color:rgb(1,1,1) });
        continue;
      }

      /* ── Highlight ── */
      if (el.classList.contains('hl-rect')) {
        pdfPage.drawRectangle({ x:pdfX, y:pdfY, width:pdfW, height:pdfH,
          color:rgb(1,.87,.1), opacity:.4 });
        continue;
      }

      /* ── Text box ── */
      const text = el.textContent || '';
      if (!text.trim()) continue;

      const cs       = window.getComputedStyle(el);
      const isBold   = parseInt(cs.fontWeight) >= 600;
      const isItalic = cs.fontStyle === 'italic';
      const isMono   = cs.fontFamily.includes('Courier') || cs.fontFamily.includes('mono');
      const isSerif  = cs.fontFamily.includes('Times') || cs.fontFamily.includes('Georgia') || cs.fontFamily.includes('serif');

      let font = fonts.regular;
      if (isMono)  font = fonts.mono;
      else if (isSerif) font = fonts.serif;
      else if (isBold && isItalic) font = fonts.boldItalic;
      else if (isBold)   font = fonts.bold;
      else if (isItalic) font = fonts.italic;

      const screenFs = parseFloat(cs.fontSize) || 14;
      const pdfFs    = Math.max(4, Math.min(screenFs / scale, 80));

      const hexColor = rgbToHex(cs.color) || '#000000';
      const r = parseInt(hexColor.slice(1,3),16)/255;
      const g = parseInt(hexColor.slice(3,5),16)/255;
      const b = parseInt(hexColor.slice(5,7),16)/255;

      // For existing text: white-rect original first
      if (el.dataset.pdfX) {
        const ox = parseFloat(el.dataset.pdfX);
        const oy = parseFloat(el.dataset.pdfY);
        const ow = parseFloat(el.dataset.pdfW);
        const of_ = parseFloat(el.dataset.pdfFs);
        pdfPage.drawRectangle({ x:ox-1, y:oy-of_*.35, width:ow+4, height:of_*1.5,
          color:rgb(1,1,1) });
      }

      // Draw text box background if new text
      if (!el.dataset.pdfX) {
        pdfPage.drawRectangle({ x:pdfX, y:pdfY, width:Math.max(pdfW,20)+4, height:pdfH+2,
          color:rgb(1,1,1), opacity:.01 });
      }

      // Write text — handle multiline
      const lines = text.split('\n').filter(l => l.trim());
      let lineY = pdfY + pdfH - pdfFs * .2;
      for (const line of lines) {
        if (lineY < pdfY) break;
        pdfPage.drawText(line, { x:pdfX, y:lineY, size:pdfFs, font, color:rgb(r,g,b),
          maxWidth:pdfW + 60 });
        lineY -= pdfFs * 1.3;
      }
    }

    const bytes = await doc.save();
    const blob  = new Blob([bytes], { type:'application/pdf' });
    const url   = URL.createObjectURL(blob);
    const a     = document.createElement('a');
    a.href = url; a.download = 'edited-' + fileName; a.click();
    setTimeout(() => URL.revokeObjectURL(url), 3000);
    tipShow('✅ PDF downloaded!');

  } catch(err) {
    alert('Save failed: ' + err.message);
  } finally {
    btn.disabled = false; btn.textContent = '⬇ Download PDF';
  }
}

/* ══════════════════════════════════════════════════════════════════
   HELPERS
══════════════════════════════════════════════════════════════════ */
function markDirty() {
  isDirty = true;
  updateChangePill();
}

function updateChangePill() {
  const changed = document.querySelectorAll('.tbox, .wout-rect, .hl-rect').length;
  const pill = document.getElementById('change-pill');
  if (changed > 0) { pill.style.display='inline-block'; pill.textContent = changed + ' edit' + (changed>1?'s':''); }
  else pill.style.display = 'none';
}

function rgbToHex(rgb) {
  if (!rgb || rgb === 'transparent') return '#000000';
  if (rgb.startsWith('#')) return rgb;
  const m = rgb.match(/\d+/g);
  if (!m) return '#000000';
  return '#' + m.slice(0,3).map(n => parseInt(n).toString(16).padStart(2,'0')).join('');
}

let tipTimer;
function tipShow(msg, ms=4000) {
  const tip = document.getElementById('status-tip');
  tip.textContent = msg;
  tip.classList.add('show');
  clearTimeout(tipTimer);
  tipTimer = setTimeout(() => tip.classList.remove('show'), ms);
}

function showEditorLoading(msg) {
  document.getElementById('loading-msg').textContent = msg;
  document.getElementById('editor-loading').style.display = 'flex';
}
function hideEditorLoading() {
  document.getElementById('editor-loading').style.display = 'none';
}

/* ══════════════════════════════════════════════════════════════════
   AI FORM FILL
══════════════════════════════════════════════════════════════════ */
let aifFields = []; // detected form fields

async function openAIFillModal() {
  if (!pdfJsDoc) { tipShow('⚠ Open a PDF first.'); return; }
  const modal = document.getElementById('ai-fill-modal');
  modal.classList.add('open');
  document.getElementById('aif-result').style.display = 'none';
  document.getElementById('btn-aif-run').disabled = false;
  document.getElementById('btn-aif-run').textContent = '✨ Fill Form with AI';

  // Scan for fields
  document.getElementById('ai-fields-status').innerHTML =
    '<div class="spin" style="width:14px;height:14px;border-width:2px;flex-shrink:0;"></div>' +
    '<span>Scanning PDF for form fields…</span>';

  aifFields = await detectFormFields();

  const n = aifFields.length;
  if (n > 0) {
    const preview = aifFields.slice(0, 5).map(f => f.label).join(', ') + (n > 5 ? '…' : '');
    document.getElementById('ai-fields-status').innerHTML =
      `<span class="aif-badge">${n} field${n > 1 ? 's' : ''} found</span>` +
      `<span>${preview}</span>`;
  } else {
    document.getElementById('ai-fields-status').innerHTML =
      '<span class="aif-badge warn">⚠ No AcroForm fields found</span>' +
      '<span>AI will match common labels from the PDF text</span>';
  }
}

function closeAIFillModal() {
  document.getElementById('ai-fill-modal').classList.remove('open');
}

/* ── Detect form fields: AcroForm widgets + visual fallback ── */
async function detectFormFields() {
  const fields = [];
  if (!pdfJsDoc) return fields;

  for (let p = 1; p <= totalPages; p++) {
    const page     = await pdfJsDoc.getPage(p);
    const viewport = page.getViewport({ scale });

    /* 1. AcroForm widget annotations — most reliable */
    try {
      const annotations = await page.getAnnotations();
      const widgets = annotations.filter(a => a.subtype === 'Widget' && a.fieldName);

      for (const annot of widgets) {
        if (annot.fieldType === 'Btn' && annot.checkBox !== undefined) continue; // skip checkboxes for now
        const vr = viewport.convertToViewportRectangle(annot.rect);
        const sx = Math.min(vr[0], vr[2]);
        const sy = Math.min(vr[1], vr[3]);
        const sw = Math.abs(vr[2] - vr[0]);
        const sh = Math.abs(vr[3] - vr[1]);
        if (sw < 5 || sh < 5) continue;

        fields.push({
          pageNum: p, source: 'acroform',
          label: annot.fieldName.split('.').pop() || annot.fieldName,
          x: sx, y: sy, w: sw, h: sh,
          pdfX: annot.rect[0], pdfY: annot.rect[1],
          pdfW: annot.rect[2] - annot.rect[0],
          pdfH: annot.rect[3] - annot.rect[1],
        });
      }
    } catch(_) {}

    /* 2. Visual detection — lines/labels ending with ':' */
    if (fields.filter(f => f.pageNum === p && f.source === 'acroform').length === 0) {
      try {
        const tc     = await page.getTextContent();
        const blocks = groupTextItems(tc.items, viewport);
        for (const block of blocks) {
          const txt = block.str.trim();
          const isLabel = /[:]\s*$/.test(txt) ||
            /^(name|first|last|middle|email|phone|fax|date|dob|birth|address|city|state|zip|postal|country|company|organization|title|position|signature|gender|nationality|passport|ssn|tax|id number|website|notes?|comments?|occupation|department|employee)\b/i.test(txt);
          if (!isLabel || txt.length < 2 || txt.length > 60) continue;

          // Place fill box to the right of the label; clamp to page width
          const pageW = viewport.width;
          const fieldX = block.x + block.w + 6;
          const fieldW = Math.max(120, Math.min(pageW - fieldX - 10, 260));
          const fieldY = block.y - 2;
          const fieldH = block.h + 4;
          if (fieldX + 40 > pageW) continue;

          fields.push({
            pageNum: p, source: 'visual',
            label: txt.replace(/[:\s]+$/, ''),
            x: fieldX, y: fieldY, w: fieldW, h: fieldH,
            pdfX: null, pdfY: null, pdfW: null, pdfH: null,
          });
        }
      } catch(_) {}
    }
  }

  return fields;
}

/* ── Call AI and place filled boxes ── */
async function runAIFill() {
  const userInfo = document.getElementById('ai-info-input').value.trim();
  if (!userInfo) { alert('Please enter your information first.'); return; }

  const btn = document.getElementById('btn-aif-run');
  btn.disabled = true;
  btn.textContent = '⏳ AI is filling fields…';

  try {
    // Build label list — use detected fields, or fallback to common labels
    const fieldLabels = aifFields.length
      ? aifFields.map(f => f.label).join(', ')
      : 'Full Name, First Name, Last Name, Email Address, Phone Number, Date, Company, Address, City, State, ZIP Code, Country, Job Title, Signature';

    const fd = new FormData();
    fd.append('field_labels', fieldLabels);
    fd.append('user_info', userInfo);
    fd.append('_token', document.querySelector('meta[name=csrf-token]')?.content || '');

    const resp = await fetch('/api/ai/form-fill', { method: 'POST', body: fd });
    const data = await resp.json();
    if (!resp.ok || data.error) throw new Error(data.error || 'API error');

    const fills = data.fills || {};
    const filled = Object.entries(fills).filter(([, v]) => v && v.trim());

    if (!filled.length) {
      alert('The AI could not find matching values. Please provide more details in the text box.');
      return;
    }

    // Place boxes
    let placed = 0;
    if (aifFields.length > 0) {
      for (const field of aifFields) {
        const value = fills[field.label] || '';
        if (!value || !value.trim()) continue;
        placeAIFilledBox(field, value);
        placed++;
      }
    } else {
      placed = placeGenericFills(fills);
    }

    // Results panel
    const rows = filled.map(([k, v]) =>
      `<div class="aif-result-row"><span class="aif-rkey">${k}</span><span class="aif-rval">${v}</span></div>`
    ).join('');
    document.getElementById('aif-result').innerHTML =
      `<div style="font-size:12px;color:#00e5a0;font-weight:700;margin-bottom:10px;">✅ Filled ${placed} field${placed !== 1 ? 's' : ''}</div>` + rows;
    document.getElementById('aif-result').style.display = 'block';

    markDirty();
    tipShow(`✨ AI filled ${placed} form field${placed !== 1 ? 's' : ''}!`, 5000);
    setTimeout(() => closeAIFillModal(), 3000);

  } catch (err) {
    alert('AI Fill failed: ' + err.message);
  } finally {
    btn.disabled = false;
    btn.textContent = '✨ Fill Form with AI';
  }
}

/* ── Place one AI-filled text box over a detected field ── */
function placeAIFilledBox(field, text) {
  const layer = document.querySelector(`.annot-layer[data-page="${field.pageNum}"]`);
  if (!layer) return;

  const { x, y, w, h } = field;
  const fs = Math.max(8, Math.min(Math.round(h * 0.58), 15));

  // For AcroForm fields: add a subtle white background rect
  if (field.source === 'acroform') {
    const bg = document.createElement('div');
    bg.className = 'wout-rect';
    bg.dataset.page = field.pageNum;
    bg.style.cssText = `left:${x}px;top:${y}px;width:${w}px;height:${h}px;`;
    makeDraggable(bg);
    bg.addEventListener('mousedown', ev => { ev.stopPropagation(); selectEl(bg); });
    layer.appendChild(bg);
  }

  // Create the text box
  const box = createTextBox(layer, x, y + (h - fs * 1.3) / 2, text, field.pageNum, false);
  box.style.fontSize   = fs + 'px';
  box.style.minWidth   = w + 'px';
  box.style.maxWidth   = w + 'px';
  box.style.background = 'transparent';
  box.classList.add('tbox-ai-filled');

  // Store PDF coords so saveAndDownload() can use them
  if (field.pdfX !== null) {
    box.dataset.pdfX  = field.pdfX;
    box.dataset.pdfY  = field.pdfY;
    box.dataset.pdfW  = field.pdfW;
    box.dataset.pdfH  = field.pdfH;
    box.dataset.pdfFs = fs / scale;
  }

  pushUndo({ type: 'delete', el: box });
}

/* ── Fallback: match fill keys against existing PDF text zones ── */
function placeGenericFills(fills) {
  let placed = 0;
  for (const [key, value] of Object.entries(fills)) {
    if (!value || !value.trim()) continue;
    let done = false;

    document.querySelectorAll('.pdf-zone').forEach(zone => {
      if (done) return;
      const zt = (zone.dataset.origText || '').toLowerCase().replace(/[:\s_]/g, '');
      const kt = key.toLowerCase().replace(/\s/g, '');
      if (zt.includes(kt) || kt.includes(zt.slice(0, Math.max(3, zt.length - 2)))) {
        const layer   = zone.parentElement;
        const pageNum = parseInt(zone.dataset.page);
        const zx = parseFloat(zone.style.left) + parseFloat(zone.style.width) + 6;
        const zy = parseFloat(zone.style.top);
        const zh = parseFloat(zone.style.height);
        const fs = Math.max(8, Math.min(Math.round(zh * 0.7), 15));
        const box = createTextBox(layer, zx, zy, value, pageNum, false);
        box.style.fontSize   = fs + 'px';
        box.style.background = 'transparent';
        pushUndo({ type: 'delete', el: box });
        placed++; done = true;
      }
    });
  }
  return placed;
}
</script>
@endsection
