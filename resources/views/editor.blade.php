<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>PDF Editor – PDFTash</title>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --bg:#0d0d14;--bg2:#13131f;--bg3:#1a1a2e;
  --accent:#7c5cfc;--accent2:#6448e0;
  --border:rgba(255,255,255,0.08);
  --text:#e8e8f0;--text2:rgba(255,255,255,0.55);
  --radius:10px;
  --header:56px;
}
html,body{height:100%;overflow:hidden;background:var(--bg);color:var(--text);font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;font-size:14px}

/* ── HEADER ── */
#header{
  position:fixed;top:0;left:0;right:0;height:var(--header);
  background:var(--bg2);border-bottom:1px solid var(--border);
  display:flex;align-items:center;gap:12px;padding:0 16px;z-index:100;
}
#logo-wrap{display:flex;align-items:center;gap:8px;flex-shrink:0;text-decoration:none}
#logo-wrap img{height:30px}
#logo-wrap span{font-weight:700;font-size:1rem;color:var(--text)}

#toolbar{
  flex:1;display:flex;align-items:center;gap:4px;
  overflow-x:auto;scrollbar-width:none;padding:4px 8px;
}
#toolbar::-webkit-scrollbar{display:none}

.tool-sep{width:1px;height:28px;background:var(--border);flex-shrink:0;margin:0 4px}
.tool-group-label{font-size:0.65rem;color:var(--text2);text-transform:uppercase;letter-spacing:.06em;margin-right:2px;flex-shrink:0}

.tool-btn{
  display:flex;align-items:center;gap:5px;
  padding:6px 12px;border-radius:8px;border:none;
  background:transparent;color:var(--text);cursor:pointer;
  font-size:0.82rem;white-space:nowrap;flex-shrink:0;
  transition:background .15s,color .15s;
}
.tool-btn:hover{background:rgba(124,92,252,.18);color:#fff}
.tool-btn.active{background:var(--accent);color:#fff}
.tool-btn .icon{font-size:1rem}

#header-right{display:flex;align-items:center;gap:10px;flex-shrink:0}
#file-name{font-size:0.82rem;color:var(--text2);max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
#btn-download{
  padding:7px 16px;border-radius:8px;border:none;
  background:var(--accent);color:#fff;cursor:pointer;font-size:0.82rem;font-weight:600;
  transition:background .15s;display:none;
}
#btn-download:hover{background:var(--accent2)}

/* ── BODY LAYOUT ── */
#body{
  position:fixed;top:var(--header);left:0;right:0;bottom:0;
  display:flex;overflow:hidden;
}

/* ── LEFT SIDEBAR ── */
#sidebar{
  width:200px;flex-shrink:0;
  background:var(--bg2);border-right:1px solid var(--border);
  overflow-y:auto;padding:12px 8px;display:flex;flex-direction:column;gap:8px;
  scrollbar-width:thin;scrollbar-color:rgba(255,255,255,.1) transparent;
}
#sidebar::-webkit-scrollbar{width:4px}
#sidebar::-webkit-scrollbar-thumb{background:rgba(255,255,255,.1);border-radius:4px}
#sidebar-empty{color:var(--text2);font-size:0.78rem;text-align:center;margin-top:20px}

.thumb-card{
  cursor:pointer;border-radius:8px;overflow:hidden;
  border:2px solid transparent;transition:border-color .15s;
  background:var(--bg3);width:100%;
}
.thumb-card:hover{border-color:rgba(124,92,252,.5)}
.thumb-card.active{border-color:var(--accent)}
.thumb-card canvas{width:100%;display:block}
.thumb-label{
  font-size:0.7rem;color:var(--text2);text-align:center;
  padding:4px 0;background:var(--bg3);
}

/* ── MAIN VIEWER ── */
#viewer{
  flex:1;overflow-y:auto;overflow-x:auto;
  background:var(--bg);padding:24px;
  display:flex;flex-direction:column;align-items:center;gap:16px;
  scrollbar-width:thin;scrollbar-color:rgba(255,255,255,.12) transparent;
}
#viewer::-webkit-scrollbar{width:6px}
#viewer::-webkit-scrollbar-thumb{background:rgba(255,255,255,.12);border-radius:4px}

.page-wrap{
  background:#fff;box-shadow:0 4px 24px rgba(0,0,0,.6);
  border-radius:4px;overflow:hidden;flex-shrink:0;
}
.page-wrap canvas{display:block}

/* ── UPLOAD ZONE ── */
#upload-zone{
  flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;
}
#drop-card{
  border:2px dashed rgba(124,92,252,.4);border-radius:16px;
  padding:56px 48px;text-align:center;max-width:440px;width:100%;
  background:rgba(124,92,252,.04);transition:border-color .2s,background .2s;cursor:pointer;
}
#drop-card.dragover{border-color:var(--accent);background:rgba(124,92,252,.1)}
#drop-icon{font-size:3rem;margin-bottom:16px}
#drop-card h2{font-size:1.2rem;font-weight:700;margin-bottom:8px}
#drop-card p{color:var(--text2);font-size:0.88rem;margin-bottom:24px}
#btn-browse{
  padding:10px 28px;border-radius:10px;border:none;
  background:var(--accent);color:#fff;cursor:pointer;font-size:0.9rem;font-weight:600;
  transition:background .15s;
}
#btn-browse:hover{background:var(--accent2)}
#file-input{display:none}
#upload-hint{margin-top:16px;font-size:0.78rem;color:var(--text2)}

/* ── RIGHT PANEL ── */
#right-panel{
  width:320px;flex-shrink:0;
  background:var(--bg2);border-left:1px solid var(--border);
  transform:translateX(100%);transition:transform .25s ease;
  display:flex;flex-direction:column;overflow:hidden;
}
#right-panel.open{transform:translateX(0)}

#panel-header{
  display:flex;align-items:center;justify-content:space-between;
  padding:16px;border-bottom:1px solid var(--border);flex-shrink:0;
}
#panel-title{font-size:1rem;font-weight:700}
#panel-close{
  background:none;border:none;color:var(--text2);cursor:pointer;
  font-size:1.2rem;line-height:1;padding:4px;border-radius:6px;
  transition:color .15s,background .15s;
}
#panel-close:hover{color:var(--text);background:rgba(255,255,255,.06)}

#panel-body{flex:1;overflow-y:auto;padding:16px;display:flex;flex-direction:column;gap:14px;scrollbar-width:thin;scrollbar-color:rgba(255,255,255,.1) transparent}
#panel-body::-webkit-scrollbar{width:4px}
#panel-body::-webkit-scrollbar-thumb{background:rgba(255,255,255,.1);border-radius:4px}

#panel-desc{font-size:0.83rem;color:var(--text2);line-height:1.5}

.field-group{display:flex;flex-direction:column;gap:6px}
.field-label{font-size:0.78rem;color:var(--text2);font-weight:500}
.field-input{
  width:100%;padding:9px 12px;border-radius:8px;border:1px solid var(--border);
  background:var(--bg3);color:var(--text);font-size:0.85rem;outline:none;
  transition:border-color .15s;
}
.field-input:focus{border-color:rgba(124,92,252,.6)}
.field-select{
  width:100%;padding:9px 12px;border-radius:8px;border:1px solid var(--border);
  background:var(--bg3);color:var(--text);font-size:0.85rem;outline:none;cursor:pointer;
  transition:border-color .15s;
}
.field-select:focus{border-color:rgba(124,92,252,.6)}

.check-group{display:flex;flex-direction:column;gap:8px}
.check-item{display:flex;align-items:center;gap:8px;cursor:pointer;font-size:0.83rem;color:var(--text)}
.check-item input[type=checkbox]{accent-color:var(--accent);width:15px;height:15px;cursor:pointer}

/* Multi-file */
#multi-file-list{display:flex;flex-direction:column;gap:6px}
.multi-file-item{
  display:flex;align-items:center;justify-content:space-between;
  padding:7px 10px;background:var(--bg3);border-radius:8px;font-size:0.8rem;
}
.multi-file-item span{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:200px}
.multi-remove{background:none;border:none;color:var(--text2);cursor:pointer;font-size:1rem;padding:2px 6px;border-radius:4px;transition:color .15s}
.multi-remove:hover{color:#f55}
#btn-add-more{
  padding:7px 12px;border-radius:8px;border:1px dashed rgba(124,92,252,.4);
  background:transparent;color:var(--accent);cursor:pointer;font-size:0.82rem;
  transition:border-color .15s,background .15s;
}
#btn-add-more:hover{background:rgba(124,92,252,.08)}
#multi-input{display:none}

#btn-process{
  width:100%;padding:11px;border-radius:10px;border:none;
  background:var(--accent);color:#fff;cursor:pointer;font-size:0.9rem;font-weight:700;
  transition:background .15s,opacity .15s;margin-top:4px;
}
#btn-process:hover{background:var(--accent2)}
#btn-process:disabled{opacity:.5;cursor:not-allowed}

/* Progress */
#progress-wrap{display:none;flex-direction:column;gap:8px}
#progress-label{font-size:0.78rem;color:var(--text2)}
#progress-bar-outer{height:6px;border-radius:6px;background:rgba(255,255,255,.08);overflow:hidden}
#progress-bar-inner{
  height:100%;width:100%;border-radius:6px;
  background:linear-gradient(90deg,var(--accent),#a78bfa,var(--accent));
  background-size:200% 100%;
  animation:stripe 1.4s linear infinite;
}
@keyframes stripe{0%{background-position:100% 0}100%{background-position:-100% 0}}

/* Result */
#result-area{display:none;flex-direction:column;gap:10px}
#result-text{
  background:var(--bg3);border-radius:8px;padding:12px;
  font-size:0.82rem;color:var(--text);line-height:1.6;
  max-height:240px;overflow-y:auto;white-space:pre-wrap;
  border:1px solid var(--border);
}
#result-table{overflow-x:auto;border-radius:8px;border:1px solid var(--border)}
#result-table table{width:100%;border-collapse:collapse;font-size:0.78rem}
#result-table th,#result-table td{padding:7px 10px;border-bottom:1px solid var(--border);text-align:left}
#result-table th{background:var(--bg3);color:var(--text2)}
#btn-download-result{
  padding:9px;border-radius:8px;border:none;
  background:rgba(124,92,252,.2);color:var(--accent);cursor:pointer;font-size:0.85rem;font-weight:600;
  transition:background .15s;text-align:center;
}
#btn-download-result:hover{background:rgba(124,92,252,.35)}

#error-msg{
  padding:10px 12px;border-radius:8px;background:rgba(239,68,68,.12);
  border:1px solid rgba(239,68,68,.25);color:#f87171;font-size:0.82rem;display:none;
}

/* Responsive tweaks */
@media(max-width:768px){
  #sidebar{display:none}
  #right-panel{width:100%;position:absolute;top:0;bottom:0;right:0;z-index:50}
}
</style>
</head>
<body>

<!-- ── HEADER ── -->
<header id="header">
  <a id="logo-wrap" href="/">
    <img src="/logo.svg" alt="PDFTash">
    <span>PDFTash</span>
  </a>

  <div id="toolbar">
    <!-- JS will render tool buttons here -->
  </div>

  <div id="header-right">
    <span id="file-name">{{ $fileName }}</span>
    <button id="btn-download" onclick="downloadCurrent()">⬇ Download</button>
  </div>
</header>

<!-- ── BODY ── -->
<div id="body">

  <!-- Left sidebar: thumbnails -->
  <aside id="sidebar">
    <div id="sidebar-empty">Upload a PDF to see page thumbnails</div>
  </aside>

  <!-- Main area: viewer or upload zone -->
  <main id="viewer">
    @if(!$token)
    <div id="upload-zone">
      <div id="drop-card" id="drop-card">
        <div id="drop-icon">📄</div>
        <h2>Drop your PDF here</h2>
        <p>Drag & drop a PDF file or click to browse.<br>Your file stays private — processed in your session.</p>
        <button id="btn-browse" onclick="document.getElementById('file-input').click()">Choose PDF File</button>
        <div id="upload-hint">Max 50 MB · PDF only</div>
      </div>
      <input type="file" id="file-input" accept=".pdf,application/pdf">
    </div>
    @endif
  </main>

  <!-- Right panel: tool options -->
  <aside id="right-panel">
    <div id="panel-header">
      <span id="panel-title">Tool</span>
      <button id="panel-close" onclick="closePanel()" title="Close">✕</button>
    </div>
    <div id="panel-body">
      <p id="panel-desc"></p>
      <div id="panel-fields"></div>
      <div id="multi-wrap" style="display:none;flex-direction:column;gap:8px">
        <div class="field-label">PDF Files</div>
        <div id="multi-file-list"></div>
        <button id="btn-add-more" onclick="document.getElementById('multi-input').click()">+ Add more PDFs</button>
        <input type="file" id="multi-input" accept=".pdf" multiple>
      </div>
      <button id="btn-process" onclick="processTool()">Process</button>
      <div id="progress-wrap">
        <div id="progress-label">Processing…</div>
        <div id="progress-bar-outer"><div id="progress-bar-inner"></div></div>
      </div>
      <div id="result-area">
        <div id="result-text" style="display:none"></div>
        <div id="result-table" style="display:none"></div>
        <button id="btn-download-result" style="display:none" onclick="triggerResultDownload()">⬇ Download Result</button>
      </div>
      <div id="error-msg"></div>
    </div>
  </aside>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
// ── CONFIG ──────────────────────────────────────────────────────────────────
const TOKEN       = @json($token);
const CURRENT_FILE = @json($fileName);
const CSRF_TOKEN  = document.querySelector('meta[name="csrf-token"]').content;

pdfjsLib.GlobalWorkerOptions.workerSrc =
  'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

// ── TOOL DEFINITIONS ────────────────────────────────────────────────────────
const TOOLS = {
  compress:{title:'Compress PDF',desc:'Reduce file size without losing quality.',endpoint:'/api/pdf/compress',icon:'🗜️',
    fields:[{type:'select',name:'level',label:'Compression Level',opts:['recommended','high','low'],labels:['Recommended','High compression','Low compression']}]},
  rotate:{title:'Rotate Pages',desc:'Rotate PDF pages 90°, 180° or 270°.',endpoint:'/api/pdf/rotate',icon:'↻',
    fields:[
      {type:'select',name:'angle',label:'Rotation',opts:['90','180','270'],labels:['90° Clockwise','180° Flip','270° Counter-clockwise']},
      {type:'text',name:'pages',label:'Pages (comma-sep or "all")',placeholder:'all'}
    ]},
  split:{title:'Split PDF',desc:'Split PDF into separate files.',endpoint:'/api/pdf/split',icon:'✂️',
    fields:[
      {type:'select',name:'method',label:'Split Method',opts:['every','half','range'],labels:['Every N pages','Split in half','By page range']},
      {type:'text',name:'n',label:'Pages per part',placeholder:'1'},
      {type:'text',name:'ranges',label:'Page ranges',placeholder:'1-3,4-6'}
    ]},
  'delete-pages':{title:'Delete Pages',desc:'Remove specific pages from PDF.',endpoint:'/api/pdf/delete-pages',icon:'🗑️',
    fields:[{type:'text',name:'pages',label:'Pages to delete',placeholder:'1,3,5-8'}]},
  reorder:{title:'Reorder Pages',desc:'Specify new page order.',endpoint:'/api/pdf/reorder',icon:'↕️',
    fields:[{type:'text',name:'order',label:'New page order',placeholder:'3,1,2,4,5'}]},
  ocr:{title:'OCR PDF',desc:'Make scanned PDFs searchable with OCR.',endpoint:'/api/pdf/ocr',icon:'🔍',
    fields:[{type:'select',name:'language',label:'Language',opts:['eng','ben','ara','hin'],labels:['English','Bengali','Arabic','Hindi']}]},
  grayscale:{title:'Grayscale PDF',desc:'Convert all colors to black and white.',endpoint:'/api/pdf/grayscale',icon:'⚫',fields:[]},
  watermark:{title:'Add Watermark',desc:'Add diagonal text watermark.',endpoint:'/api/pdf/watermark',icon:'💧',
    fields:[
      {type:'text',name:'text',label:'Watermark text',placeholder:'CONFIDENTIAL'},
      {type:'select',name:'opacity',label:'Opacity',opts:['0.15','0.25','0.4'],labels:['Light','Medium','Dark']}
    ]},
  'page-numbers':{title:'Page Numbers',desc:'Add page numbers to PDF.',endpoint:'/api/pdf/page-numbers',icon:'#️⃣',
    fields:[
      {type:'select',name:'position',label:'Position',opts:['bottom-center','bottom-right','top-center'],labels:['Bottom Center','Bottom Right','Top Center']},
      {type:'text',name:'start',label:'Start number',placeholder:'1'}
    ]},
  protect:{title:'Protect PDF',desc:'Add password encryption.',endpoint:'/api/pdf/protect',icon:'🔒',
    fields:[{type:'password',name:'password',label:'Password',placeholder:'Enter password'}]},
  unlock:{title:'Unlock PDF',desc:'Remove password from PDF.',endpoint:'/api/pdf/unlock',icon:'🔓',
    fields:[{type:'password',name:'password',label:'Current password (if any)',placeholder:'Leave blank if none'}]},
  redact:{title:'Redact Sensitive Info',desc:'Black out private data using AI.',endpoint:'/api/pdf/redact',icon:'⬛',
    fields:[
      {type:'checkgroup',name:'categories',label:'Redact:',opts:['email','phone','ssn','creditcard','address','name'],
        labels:['Email addresses','Phone numbers','SSN / National ID','Credit card numbers','Physical addresses','Person names'],
        default:['email','phone','ssn']},
      {type:'text',name:'custom_terms',label:'Custom terms (comma-sep)',placeholder:'e.g. Company Name, Project X'}
    ]},
  summarize:{title:'AI Summarize',desc:'Get AI summary of your PDF.',endpoint:'/api/ai/summarize',icon:'📝',isAI:true,
    fields:[{type:'select',name:'length',label:'Length',opts:['short','medium','detailed'],labels:['Short','Medium','Detailed']}],
    textResult:true},
  translate:{title:'AI Translate',desc:'Translate PDF to another language.',endpoint:'/api/ai/translate',icon:'🌐',isAI:true,
    fields:[{type:'select',name:'language',label:'Translate to',
      opts:['Bengali','Arabic','Spanish','French','German','Hindi','Chinese'],
      labels:['Bengali (বাংলা)','Arabic','Spanish','French','German','Hindi','Chinese']}]},
  chat:{title:'Chat with PDF',desc:'Ask questions about your PDF.',icon:'💬',linkTo:'/chat-with-pdf',isAI:true},
  'extract-tables':{title:'Extract Tables',desc:'Extract tables to CSV/Excel.',endpoint:'/api/pdf/table-extract',icon:'📊',isAI:true,tableResult:true},
  merge:{title:'Merge PDFs',desc:'Combine multiple PDFs into one.',endpoint:'/api/pdf/merge',icon:'🔗',multiFile:true},
};

const TOOLBAR_GROUPS = [
  {label:'EDIT',   tools:['compress','rotate','split','delete-pages','reorder']},
  {label:'ENHANCE',tools:['ocr','grayscale','watermark','page-numbers']},
  {label:'SECURITY',tools:['protect','unlock','redact']},
  {label:'AI',     tools:['summarize','translate','chat','extract-tables']},
  {label:'MERGE',  tools:['merge']},
];

// ── STATE ────────────────────────────────────────────────────────────────────
let activeTool    = null;
let pdfDoc        = null;
let resultBlob    = null;
let multiFiles    = [];   // extra files for merge
let currentFileName = CURRENT_FILE;

// ── BUILD TOOLBAR ────────────────────────────────────────────────────────────
(function buildToolbar() {
  const tb = document.getElementById('toolbar');
  TOOLBAR_GROUPS.forEach((grp, gi) => {
    if (gi > 0) {
      const sep = document.createElement('div');
      sep.className = 'tool-sep';
      tb.appendChild(sep);
    }
    const lbl = document.createElement('span');
    lbl.className = 'tool-group-label';
    lbl.textContent = grp.label;
    tb.appendChild(lbl);

    grp.tools.forEach(key => {
      const t = TOOLS[key];
      const btn = document.createElement('button');
      btn.className = 'tool-btn';
      btn.id = 'tbtn-' + key;
      btn.innerHTML = `<span class="icon">${t.icon}</span><span>${t.title.split(' ').slice(-1)[0] === t.title ? t.title : t.title}</span>`;
      // Shorten label for toolbar
      const shortLabel = {
        compress:'Compress',rotate:'Rotate',split:'Split','delete-pages':'Delete Pgs',
        reorder:'Reorder',ocr:'OCR',grayscale:'Grayscale',watermark:'Watermark',
        'page-numbers':'Page Nos',protect:'Protect',unlock:'Unlock',redact:'Redact',
        summarize:'Summarize',translate:'Translate',chat:'Chat','extract-tables':'Tables',
        merge:'Merge'
      }[key] || t.title;
      btn.innerHTML = `<span class="icon">${t.icon}</span><span>${shortLabel}</span>`;
      btn.addEventListener('click', () => openTool(key));
      tb.appendChild(btn);
    });
  });
})();

// ── PANEL ────────────────────────────────────────────────────────────────────
function openTool(key) {
  // Deactivate previous
  if (activeTool) {
    const prev = document.getElementById('tbtn-' + activeTool);
    if (prev) prev.classList.remove('active');
  }

  if (activeTool === key) {
    closePanel();
    return;
  }

  activeTool = key;
  const btn = document.getElementById('tbtn-' + key);
  if (btn) btn.classList.add('active');

  const tool = TOOLS[key];
  document.getElementById('panel-title').textContent = tool.icon + ' ' + tool.title;
  document.getElementById('panel-desc').textContent  = tool.desc;
  document.getElementById('error-msg').style.display = 'none';
  document.getElementById('progress-wrap').style.display = 'none';
  hideResult();

  // Build fields
  const fieldsEl = document.getElementById('panel-fields');
  fieldsEl.innerHTML = '';

  (tool.fields || []).forEach(f => {
    const grp = document.createElement('div');
    grp.className = 'field-group';

    const lbl = document.createElement('label');
    lbl.className = 'field-label';
    lbl.textContent = f.label;

    if (f.type === 'select') {
      const sel = document.createElement('select');
      sel.className = 'field-select';
      sel.name = f.name;
      f.opts.forEach((opt, i) => {
        const o = document.createElement('option');
        o.value = opt;
        o.textContent = (f.labels && f.labels[i]) ? f.labels[i] : opt;
        sel.appendChild(o);
      });
      grp.appendChild(lbl);
      grp.appendChild(sel);
    } else if (f.type === 'checkgroup') {
      grp.appendChild(lbl);
      const cg = document.createElement('div');
      cg.className = 'check-group';
      f.opts.forEach((opt, i) => {
        const item = document.createElement('label');
        item.className = 'check-item';
        const cb = document.createElement('input');
        cb.type = 'checkbox';
        cb.name = f.name + '[]';
        cb.value = opt;
        if (f.default && f.default.includes(opt)) cb.checked = true;
        item.appendChild(cb);
        item.appendChild(document.createTextNode((f.labels && f.labels[i]) ? f.labels[i] : opt));
        cg.appendChild(item);
      });
      grp.appendChild(cg);
    } else {
      const inp = document.createElement('input');
      inp.type = f.type || 'text';
      inp.className = 'field-input';
      inp.name = f.name;
      if (f.placeholder) inp.placeholder = f.placeholder;
      grp.appendChild(lbl);
      grp.appendChild(inp);
    }

    fieldsEl.appendChild(grp);
  });

  // Multi-file
  const mw = document.getElementById('multi-wrap');
  if (tool.multiFile) {
    mw.style.display = 'flex';
    renderMultiList();
  } else {
    mw.style.display = 'none';
    multiFiles = [];
  }

  // Process btn
  const pb = document.getElementById('btn-process');
  if (tool.linkTo) {
    pb.textContent = '🔗 Open Tool';
  } else {
    pb.textContent = 'Process';
  }
  pb.disabled = false;

  document.getElementById('right-panel').classList.add('open');
}

function closePanel() {
  document.getElementById('right-panel').classList.remove('open');
  if (activeTool) {
    const btn = document.getElementById('tbtn-' + activeTool);
    if (btn) btn.classList.remove('active');
  }
  activeTool = null;
}

// ── MULTI-FILE MERGE ─────────────────────────────────────────────────────────
document.getElementById('multi-input').addEventListener('change', function() {
  Array.from(this.files).forEach(f => multiFiles.push(f));
  this.value = '';
  renderMultiList();
});

function renderMultiList() {
  const list = document.getElementById('multi-file-list');
  list.innerHTML = '';
  // Show current PDF first
  if (TOKEN) {
    const item = document.createElement('div');
    item.className = 'multi-file-item';
    item.innerHTML = `<span>📄 ${currentFileName} <em style="color:var(--text2);font-size:.75rem">(current)</em></span>`;
    list.appendChild(item);
  }
  multiFiles.forEach((f, i) => {
    const item = document.createElement('div');
    item.className = 'multi-file-item';
    item.innerHTML = `<span>📄 ${f.name}</span><button class="multi-remove" onclick="removeMulti(${i})">✕</button>`;
    list.appendChild(item);
  });
}

function removeMulti(i) {
  multiFiles.splice(i, 1);
  renderMultiList();
}

// ── PROCESS ──────────────────────────────────────────────────────────────────
async function processTool() {
  if (!activeTool) return;
  const tool = TOOLS[activeTool];

  if (tool.linkTo) {
    window.open(tool.linkTo, '_blank');
    return;
  }

  if (!TOKEN) {
    showError('Please upload a PDF first.');
    return;
  }

  hideError();
  hideResult();
  showProgress(true, 'Preparing…');
  document.getElementById('btn-process').disabled = true;

  // Fetch current PDF blob
  let pdfBlob;
  try {
    const resp = await fetch('/editor/file/' + TOKEN);
    if (!resp.ok) throw new Error('Could not load PDF');
    pdfBlob = await resp.blob();
  } catch(e) {
    showProgress(false);
    showError('Could not load PDF file. Please re-upload.');
    document.getElementById('btn-process').disabled = false;
    return;
  }

  // Build FormData
  const fd = new FormData();
  fd.append('_token', CSRF_TOKEN);

  if (tool.multiFile) {
    fd.append('files[]', pdfBlob, currentFileName);
    multiFiles.forEach(f => fd.append('files[]', f, f.name));
  } else {
    fd.append('file', pdfBlob, currentFileName);
  }

  // Collect fields
  const fieldsEl = document.getElementById('panel-fields');
  fieldsEl.querySelectorAll('input,select,textarea').forEach(el => {
    if (!el.name) return;
    if (el.type === 'checkbox') {
      if (el.checked) fd.append(el.name, el.value);
    } else {
      fd.append(el.name, el.value);
    }
  });

  showProgress(true, 'Processing…');

  try {
    const resp = await fetch(tool.endpoint, {
      method: 'POST',
      headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
      body: fd
    });

    if (!resp.ok) {
      let msg = 'Server error ' + resp.status;
      try { const d = await resp.json(); msg = d.error || d.message || msg; } catch(_){}
      throw new Error(msg);
    }

    if (tool.textResult) {
      const data = await resp.json();
      const text = data.summary || data.translation || data.text || JSON.stringify(data, null, 2);
      showProgress(false);
      showTextResult(text);
    } else if (tool.tableResult) {
      const data = await resp.json();
      showProgress(false);
      showTableResult(data.tables || []);
    } else {
      const blob = await resp.blob();
      resultBlob = blob;
      showProgress(false);
      showDownloadResult('result.pdf');
    }
  } catch(e) {
    showProgress(false);
    showError('Processing failed: ' + e.message);
  }

  document.getElementById('btn-process').disabled = false;
}

// ── UI HELPERS ───────────────────────────────────────────────────────────────
function showProgress(on, label) {
  const pw = document.getElementById('progress-wrap');
  if (on) {
    document.getElementById('progress-label').textContent = label || 'Processing…';
    pw.style.display = 'flex';
  } else {
    pw.style.display = 'none';
  }
}

function showError(msg) {
  const el = document.getElementById('error-msg');
  el.textContent = msg;
  el.style.display = 'block';
}

function hideError() {
  document.getElementById('error-msg').style.display = 'none';
}

function hideResult() {
  document.getElementById('result-area').style.display = 'none';
  document.getElementById('result-text').style.display = 'none';
  document.getElementById('result-table').style.display = 'none';
  document.getElementById('btn-download-result').style.display = 'none';
}

function showTextResult(text) {
  const ra = document.getElementById('result-area');
  ra.style.display = 'flex';
  const rt = document.getElementById('result-text');
  rt.textContent = text;
  rt.style.display = 'block';
}

function showTableResult(tables) {
  const ra = document.getElementById('result-area');
  ra.style.display = 'flex';
  const rt = document.getElementById('result-table');
  rt.style.display = 'block';
  if (!tables || tables.length === 0) {
    rt.innerHTML = '<p style="padding:12px;color:var(--text2);font-size:.82rem">No tables found.</p>';
    return;
  }
  let html = '';
  tables.forEach((tbl, ti) => {
    html += `<div style="padding:8px 10px;font-size:.75rem;color:var(--text2);border-bottom:1px solid var(--border)">Table ${ti+1}</div>`;
    html += '<table><thead><tr>';
    const headers = tbl.headers || (tbl.rows && tbl.rows[0] ? Object.keys(tbl.rows[0]) : []);
    headers.forEach(h => { html += `<th>${h}</th>`; });
    html += '</tr></thead><tbody>';
    (tbl.rows || []).forEach(row => {
      html += '<tr>';
      headers.forEach(h => { html += `<td>${row[h] ?? ''}</td>`; });
      html += '</tr>';
    });
    html += '</tbody></table>';
  });
  rt.innerHTML = html;
}

function showDownloadResult(name) {
  const ra = document.getElementById('result-area');
  ra.style.display = 'flex';
  const btn = document.getElementById('btn-download-result');
  btn.textContent = '⬇ Download ' + name;
  btn.style.display = 'block';
  btn.dataset.name = name;
}

function triggerResultDownload() {
  if (!resultBlob) return;
  const name = document.getElementById('btn-download-result').dataset.name || 'result.pdf';
  downloadBlob(resultBlob, name);
}

function downloadBlob(blob, name) {
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = name;
  document.body.appendChild(a);
  a.click();
  setTimeout(() => { URL.revokeObjectURL(url); a.remove(); }, 1000);
}

function downloadCurrent() {
  if (!TOKEN) return;
  const a = document.createElement('a');
  a.href = '/editor/file/' + TOKEN;
  a.download = currentFileName;
  document.body.appendChild(a);
  a.click();
  a.remove();
}

// ── UPLOAD ZONE (no token) ───────────────────────────────────────────────────
@if(!$token)
(function setupUpload() {
  const dropCard = document.getElementById('drop-card');
  const fileInput = document.getElementById('file-input');

  if (!dropCard) return;

  dropCard.addEventListener('dragover', e => {
    e.preventDefault();
    dropCard.classList.add('dragover');
  });
  dropCard.addEventListener('dragleave', () => dropCard.classList.remove('dragover'));
  dropCard.addEventListener('drop', e => {
    e.preventDefault();
    dropCard.classList.remove('dragover');
    const files = e.dataTransfer.files;
    if (files.length) handleUpload(files[0]);
  });
  dropCard.addEventListener('click', e => {
    if (e.target.id !== 'btn-browse') fileInput.click();
  });
  fileInput.addEventListener('change', () => {
    if (fileInput.files.length) handleUpload(fileInput.files[0]);
  });

  async function handleUpload(file) {
    if (!file.type.includes('pdf') && !file.name.endsWith('.pdf')) {
      alert('Please select a PDF file.');
      return;
    }
    dropCard.innerHTML = `<div id="drop-icon">⏳</div><h2>Uploading…</h2><p>${file.name}</p>`;

    const fd = new FormData();
    fd.append('file', file, file.name);
    fd.append('_token', CSRF_TOKEN);

    try {
      const resp = await fetch('/editor/upload', {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
        body: fd
      });
      const data = await resp.json();
      if (!resp.ok || data.error) throw new Error(data.error || 'Upload failed');
      window.location.href = '/editor?token=' + encodeURIComponent(data.token) + '&name=' + encodeURIComponent(data.name);
    } catch(e) {
      dropCard.innerHTML = `<div id="drop-icon">❌</div><h2>Upload failed</h2><p>${e.message}</p>
        <button id="btn-browse" onclick="location.reload()">Try again</button>`;
    }
  }
})();
@endif

// ── PDF.JS RENDERING ─────────────────────────────────────────────────────────
@if($token)
(async function loadPDF() {
  const fileUrl = '/editor/file/' + TOKEN;
  const viewer  = document.getElementById('viewer');
  const sidebar = document.getElementById('sidebar');

  // Clear sidebar placeholder
  sidebar.innerHTML = '';

  // Show download btn
  document.getElementById('btn-download').style.display = 'inline-flex';

  try {
    const loadingTask = pdfjsLib.getDocument(fileUrl);
    pdfDoc = await loadingTask.promise;
  } catch(e) {
    viewer.innerHTML = `<div style="color:#f87171;text-align:center;padding:40px">Failed to load PDF: ${e.message}</div>`;
    return;
  }

  const numPages = pdfDoc.numPages;

  // Render all pages
  for (let i = 1; i <= numPages; i++) {
    const page = await pdfDoc.getPage(i);
    const viewport = page.getViewport({ scale: 1.2 });

    const wrap = document.createElement('div');
    wrap.className = 'page-wrap';
    wrap.id = 'page-wrap-' + i;

    const canvas = document.createElement('canvas');
    canvas.width  = viewport.width;
    canvas.height = viewport.height;
    const ctx = canvas.getContext('2d');

    wrap.appendChild(canvas);
    viewer.appendChild(wrap);

    await page.render({ canvasContext: ctx, viewport }).promise;
  }

  // Render thumbnails
  for (let i = 1; i <= numPages; i++) {
    const page = await pdfDoc.getPage(i);
    const viewport = page.getViewport({ scale: 0.2 });

    const card = document.createElement('div');
    card.className = 'thumb-card' + (i === 1 ? ' active' : '');
    card.id = 'thumb-' + i;

    const canvas = document.createElement('canvas');
    canvas.width  = viewport.width;
    canvas.height = viewport.height;
    const ctx = canvas.getContext('2d');

    const lbl = document.createElement('div');
    lbl.className = 'thumb-label';
    lbl.textContent = 'Page ' + i;

    card.appendChild(canvas);
    card.appendChild(lbl);
    sidebar.appendChild(card);

    await page.render({ canvasContext: ctx, viewport }).promise;

    card.addEventListener('click', () => {
      document.querySelectorAll('.thumb-card').forEach(c => c.classList.remove('active'));
      card.classList.add('active');
      const target = document.getElementById('page-wrap-' + i);
      if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  }

  // Sync active thumb on scroll
  viewer.addEventListener('scroll', () => {
    for (let i = numPages; i >= 1; i--) {
      const pw = document.getElementById('page-wrap-' + i);
      if (!pw) continue;
      const rect = pw.getBoundingClientRect();
      if (rect.top <= (window.innerHeight * 0.5)) {
        document.querySelectorAll('.thumb-card').forEach(c => c.classList.remove('active'));
        const th = document.getElementById('thumb-' + i);
        if (th) {
          th.classList.add('active');
          th.scrollIntoView({ block: 'nearest' });
        }
        break;
      }
    }
  });
})();
@endif
</script>
</body>
</html>
