<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>PDF Editor – PDFTash</title>
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="alternate icon" href="/favicon.ico">
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
:root{ --header:96px; }   /* 2-row header */
#header{
  position:fixed;top:0;left:0;right:0;
  background:var(--bg2);border-bottom:1px solid var(--border);
  z-index:100;display:flex;flex-direction:column;
}
/* Row 1: Logo + filename + download */
#header-top{
  display:flex;align-items:center;gap:12px;padding:0 16px;height:48px;
  border-bottom:1px solid var(--border);
}
#logo-wrap{display:flex;align-items:center;gap:8px;flex-shrink:0;text-decoration:none}
#logo-wrap img{height:28px}
#logo-wrap span{font-weight:700;font-size:0.95rem;color:var(--text)}
#header-right{display:flex;align-items:center;gap:10px;margin-left:auto;flex-shrink:0}
#file-name{font-size:0.8rem;color:var(--text2);max-width:260px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
#btn-download{
  padding:6px 16px;border-radius:8px;border:none;
  background:var(--accent);color:#fff;cursor:pointer;font-size:0.82rem;font-weight:600;
  transition:background .15s;display:none;
}
#btn-download:hover{background:var(--accent2)}

/* Row 2: Full-width toolbar */
#toolbar{
  display:flex;align-items:center;gap:2px;
  height:48px;padding:0 10px;
  overflow-x:auto;scrollbar-width:thin;scrollbar-color:rgba(255,255,255,.1) transparent;
}
#toolbar::-webkit-scrollbar{height:3px}
#toolbar::-webkit-scrollbar-thumb{background:rgba(255,255,255,.15);border-radius:4px}

.tool-sep{width:1px;height:26px;background:var(--border);flex-shrink:0;margin:0 6px}
.tool-group-label{
  font-size:0.6rem;color:var(--text2);text-transform:uppercase;
  letter-spacing:.08em;flex-shrink:0;padding:0 4px 0 2px;
  border-right:1px solid var(--border);margin-right:4px;
}

.tool-btn{
  display:flex;flex-direction:column;align-items:center;justify-content:center;gap:1px;
  padding:4px 10px;border-radius:7px;border:none;
  background:transparent;color:var(--text);cursor:pointer;
  font-size:0.72rem;white-space:nowrap;flex-shrink:0;min-width:52px;
  transition:background .15s,color .15s;
}
.tool-btn:hover{background:rgba(124,92,252,.18);color:#fff}
.tool-btn.active{background:var(--accent);color:#fff}
.tool-btn .icon{font-size:1.15rem;line-height:1}

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
  position:relative;
}
#viewer::-webkit-scrollbar{width:6px}
#viewer::-webkit-scrollbar-thumb{background:rgba(255,255,255,.12);border-radius:4px}

.page-wrap{
  background:#fff;box-shadow:0 4px 24px rgba(0,0,0,.6);
  border-radius:4px;overflow:hidden;flex-shrink:0;position:relative;
}
.page-wrap canvas{display:block}

/* ── DRAGGABLE SIGNATURE ── */
#sig-drag-box{
  position:absolute;
  border:2px dashed #7c5cfc;
  border-radius:6px;
  background:rgba(124,92,252,0.08);
  cursor:grab;
  user-select:none;
  z-index:30;
  min-width:140px;
  min-height:44px;
  display:none;
  align-items:center;
  justify-content:center;
  padding:6px 14px;
  box-shadow:0 2px 12px rgba(124,92,252,0.25);
}
#sig-drag-box:active{cursor:grabbing;}
#sig-drag-box.dragging{border-style:solid;background:rgba(124,92,252,0.15);}
#sig-drag-label{
  position:absolute;top:-20px;left:50%;transform:translateX(-50%);
  background:#7c5cfc;color:#fff;font-size:10px;padding:2px 10px;
  border-radius:99px;white-space:nowrap;pointer-events:none;
}
#sig-drag-content{pointer-events:none;max-width:200px;max-height:70px;}
#sig-drag-content canvas,#sig-drag-content img{max-width:100%;max-height:64px;display:block;}
#sig-drag-content span{font-family:'Segoe Script','Comic Sans MS',cursive;font-size:22px;color:#111;white-space:nowrap;}

/* ── CROP OVERLAY ── */
#crop-overlay{
  position:absolute;inset:0;z-index:40;cursor:crosshair;display:none;
}
#crop-selection{
  position:absolute;border:2px solid #5b5cff;
  box-shadow:0 0 0 9999px rgba(0,0,0,.45);
  pointer-events:none;display:none;
}
.crop-handle{
  position:absolute;width:10px;height:10px;
  background:#fff;border:2px solid #5b5cff;border-radius:2px;
}
.crop-handle.tl{top:-5px;left:-5px;}
.crop-handle.tr{top:-5px;right:-5px;}
.crop-handle.bl{bottom:-5px;left:-5px;}
.crop-handle.br{bottom:-5px;right:-5px;}
#crop-hint{
  position:absolute;bottom:12px;left:50%;transform:translateX(-50%);
  background:rgba(91,92,255,.9);color:#fff;font-size:12px;font-weight:600;
  padding:5px 14px;border-radius:99px;white-space:nowrap;pointer-events:none;
}

/* Sign panel extras */
#sign-place-btn{
  width:100%;padding:9px;border-radius:8px;border:2px dashed rgba(124,92,252,.5);
  background:rgba(124,92,252,.08);color:var(--accent);cursor:pointer;font-size:0.85rem;
  font-weight:600;transition:all .15s;margin-top:8px;
}
#sign-place-btn:hover{background:rgba(124,92,252,.18);border-style:solid;}
#sign-place-hint{font-size:0.75rem;color:var(--text2);text-align:center;margin-top:6px;}

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
  <!-- Row 1: Logo + file info -->
  <div id="header-top">
    <a id="logo-wrap" href="/">
      <img src="/logo.svg" alt="PDFTash">
      <span>PDFTash</span>
    </a>
    <div id="header-right">
      <span id="file-name">{{ $fileName }}</span>
      <button id="btn-download" onclick="downloadCurrent()">⬇ Download</button>
    </div>
  </div>
  <!-- Row 2: Full-width toolbar -->
  <div id="toolbar">
    <!-- JS renders tool buttons -->
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
  highlight:{title:'Highlight PDF',desc:'Highlight, underline, draw and annotate your PDF.',endpoint:'',icon:'🖊️',externalUrl:'/highlight-pdf',fields:[]},
  'pdf-to-word':{title:'PDF to Word',desc:'Convert PDF to editable Word document (.docx).',endpoint:'/api/pdf/to-word',icon:'📝',resultFilename:'result.docx',
    fields:[{type:'hidden',name:'format',value:'docx'}]},
  ocr:{title:'OCR PDF',desc:'Make scanned PDFs searchable with OCR.',endpoint:'/api/pdf/ocr',icon:'🔍',
    fields:[
      {type:'select',name:'lang',label:'Language',opts:['eng','ben','ara','hin'],labels:['English','Bengali','Arabic','Hindi']},
      {type:'hidden',name:'format',value:'pdf'}
    ]},
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
  'extract-data':{title:'AI Data Extractor',desc:'Extract structured data (invoice, contact, table) using AI.',endpoint:'/api/ai/extract-data',icon:'🧠',isAI:true,textResult:true,
    fields:[{type:'select',name:'type',label:'Data Type',opts:['invoice','table','contact'],labels:['Invoice Data','Table / Grid Data','Contact Information']}]},
  merge:{title:'Merge PDFs',desc:'Combine multiple PDFs into one.',endpoint:'/api/pdf/merge',icon:'🔗',multiFile:true},
  sign:{title:'eSign PDF',desc:'Add your signature to the PDF.',endpoint:'/api/pdf/sign',icon:'✍️',signMode:true},
  'pdf-to-images':{title:'PDF to Images',desc:'Convert each page to a JPG/PNG image.',endpoint:'/api/pdf/to-images',icon:'🖼️',resultFilename:'pages.zip',
    fields:[
      {type:'select',name:'format',label:'Format',opts:['jpg','png'],labels:['JPG (smaller)','PNG (transparent)']},
      {type:'select',name:'dpi',label:'Quality',opts:['96','150','200','300'],labels:['96 DPI (screen)','150 DPI (standard)','200 DPI (high)','300 DPI (print)']}
    ]},
  'extract-text':{title:'Extract Text',desc:'Extract all text from PDF as a .txt file.',endpoint:'/api/pdf/to-text',icon:'📃',resultFilename:'extracted_text.txt',fields:[]},
  info:{title:'PDF Info',desc:'View metadata, page count and file details.',endpoint:'/api/pdf/info',icon:'ℹ️',textResult:true,fields:[]},
  crop:{title:'Crop PDF',desc:'Drag to select the area you want to keep.',endpoint:'/api/pdf/crop',icon:'✂️',cropMode:true,fields:[]},
};

const TOOLBAR_GROUPS = [
  {label:'EDIT',    tools:['compress','rotate','split','delete-pages','reorder','crop']},
  {label:'MERGE',   tools:['merge']},
  {label:'ANNOTATE',tools:['highlight']},
  {label:'CONVERT', tools:['pdf-to-word','pdf-to-images','extract-text','grayscale']},
  {label:'ENHANCE', tools:['ocr','watermark','page-numbers']},
  {label:'SECURITY',tools:['protect','unlock','redact']},
  {label:'SIGN',    tools:['sign']},
  {label:'AI',      tools:['summarize','translate','chat','extract-tables','extract-data']},
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
  const shortLabels = {
    compress:'Compress',rotate:'Rotate',split:'Split','delete-pages':'Del Pages',
    reorder:'Reorder',crop:'Crop',ocr:'OCR',grayscale:'Grayscale',watermark:'Watermark',
    'page-numbers':'Page Nos',protect:'Protect',unlock:'Unlock',redact:'Redact',
    sign:'eSign',
    highlight:'Highlight',
    'pdf-to-word':'→ Word','pdf-to-images':'→ Images','extract-text':'Extract Text',
    info:'PDF Info',
    summarize:'Summarize',translate:'Translate',chat:'AI Chat',
    'extract-tables':'Tables','extract-data':'Data Extract',
    merge:'Merge'
  };

  TOOLBAR_GROUPS.forEach((grp, gi) => {
    // Group label as separator
    const lbl = document.createElement('span');
    lbl.className = 'tool-group-label';
    lbl.textContent = grp.label;
    tb.appendChild(lbl);

    grp.tools.forEach(key => {
      const t = TOOLS[key];
      const btn = document.createElement('button');
      btn.className = 'tool-btn';
      btn.id = 'tbtn-' + key;
      btn.title = t.title;
      btn.innerHTML = `<span class="icon">${t.icon}</span><span>${shortLabels[key] || t.title}</span>`;
      btn.addEventListener('click', () => openTool(key));
      tb.appendChild(btn);
    });

    if (gi < TOOLBAR_GROUPS.length - 1) {
      const sep = document.createElement('div');
      sep.className = 'tool-sep';
      tb.appendChild(sep);
    }
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

  // External tools open in a new page
  if (tool.externalUrl) {
    window.location.href = tool.externalUrl;
    return;
  }
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

    if (f.type === 'hidden') {
      const inp = document.createElement('input');
      inp.type = 'hidden';
      inp.name = f.name;
      inp.value = f.value || '';
      fieldsEl.appendChild(inp);
      return; // skip group wrapper, no label needed
    } else if (f.type === 'select') {
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

  // Sign special UI — drag-to-place approach
  if (tool.signMode) {
    fieldsEl.innerHTML = `
      <div class="field-group">
        <label class="field-label">Signature Method</label>
        <select class="field-select" id="sign-method-sel" onchange="toggleEditorSignMethod()">
          <option value="draw">Draw Signature</option>
          <option value="type">Type Signature</option>
          <option value="upload">Upload Image</option>
        </select>
      </div>
      <div id="ed-sign-draw" class="field-group">
        <label class="field-label">Draw your signature below</label>
        <canvas id="ed-sig-canvas" width="270" height="90"
          style="border:1px solid var(--border);border-radius:8px;background:#fff;cursor:crosshair;display:block;touch-action:none;"></canvas>
        <button type="button" onclick="clearEditorCanvas()"
          style="margin-top:5px;padding:4px 10px;background:transparent;border:1px solid var(--border);color:var(--text2);border-radius:6px;cursor:pointer;font-size:11px;">Clear</button>
      </div>
      <div id="ed-sign-type" class="field-group" style="display:none">
        <label class="field-label">Type your name</label>
        <input type="text" id="ed-sig-text" class="field-input" placeholder="Your Name" oninput="updateSigDragContent()">
      </div>
      <div id="ed-sign-upload" class="field-group" style="display:none">
        <label class="field-label">Upload signature image (PNG/JPG)</label>
        <input type="file" id="ed-sig-file" accept=".png,.jpg,.jpeg" class="field-input" onchange="updateSigDragContent()">
      </div>
      <button id="sign-place-btn" onclick="placeSigOnPDF()">📌 Place Signature on PDF</button>
      <p id="sign-place-hint">Click the button above, then drag your signature to any position on the PDF.</p>`;
    initEditorCanvas();
    // Remove old drag box if exists
    removeSigDragBox();
  }

  // Crop mode — show drag-select overlay on viewer
  if (tool.cropMode) {
    fieldsEl.innerHTML = `
      <div style="text-align:center;padding:12px 0;">
        <div style="font-size:36px;margin-bottom:10px;">✂️</div>
        <p style="font-size:13px;color:var(--text2);line-height:1.6;">Drag on the PDF to select the area you want to <strong style="color:var(--text)">keep</strong>.</p>
        <p style="font-size:11px;color:var(--text2);margin-top:8px;">The selection applies to all pages.</p>
      </div>
      <div id="crop-coords-display" style="font-size:11px;color:#5b5cff;text-align:center;min-height:18px;margin-top:4px;"></div>`;
    startCropMode();
  } else {
    stopCropMode();
  }

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
  stopCropMode();
  if (activeTool) {
    const btn = document.getElementById('tbtn-' + activeTool);
    if (btn) btn.classList.remove('active');
  }
  activeTool = null;
  removeSigDragBox();
}

// ── SIGN — DRAW CANVAS ───────────────────────────────────────────────────────
let edSignDrawing = false, edSignLastX = 0, edSignLastY = 0;

function initEditorCanvas() {
  setTimeout(() => {
    const c = document.getElementById('ed-sig-canvas');
    if (!c) return;
    const ctx = c.getContext('2d');
    ctx.strokeStyle = '#111';
    ctx.lineWidth = 2.5;
    ctx.lineCap = 'round';
    const pos = e => {
      const r = c.getBoundingClientRect();
      return e.touches
        ? {x: e.touches[0].clientX - r.left, y: e.touches[0].clientY - r.top}
        : {x: e.clientX - r.left, y: e.clientY - r.top};
    };
    c.addEventListener('mousedown',  e => { edSignDrawing=true; const p=pos(e); edSignLastX=p.x; edSignLastY=p.y; });
    c.addEventListener('touchstart', e => { e.preventDefault(); edSignDrawing=true; const p=pos(e); edSignLastX=p.x; edSignLastY=p.y; });
    c.addEventListener('mousemove',  e => { if(!edSignDrawing) return; const p=pos(e); ctx.beginPath(); ctx.moveTo(edSignLastX,edSignLastY); ctx.lineTo(p.x,p.y); ctx.stroke(); edSignLastX=p.x; edSignLastY=p.y; updateSigDragContent(); });
    c.addEventListener('touchmove',  e => { e.preventDefault(); if(!edSignDrawing) return; const p=pos(e); ctx.beginPath(); ctx.moveTo(edSignLastX,edSignLastY); ctx.lineTo(p.x,p.y); ctx.stroke(); edSignLastX=p.x; edSignLastY=p.y; });
    c.addEventListener('mouseup',   () => { edSignDrawing=false; updateSigDragContent(); });
    c.addEventListener('touchend',  () => { edSignDrawing=false; updateSigDragContent(); });
  }, 50);
}

function clearEditorCanvas() {
  const c = document.getElementById('ed-sig-canvas');
  if (c) { c.getContext('2d').clearRect(0, 0, c.width, c.height); updateSigDragContent(); }
}

function toggleEditorSignMethod() {
  const m = document.getElementById('sign-method-sel')?.value;
  document.getElementById('ed-sign-draw').style.display   = m==='draw'   ? 'block' : 'none';
  document.getElementById('ed-sign-type').style.display   = m==='type'   ? 'block' : 'none';
  document.getElementById('ed-sign-upload').style.display = m==='upload' ? 'block' : 'none';
  updateSigDragContent();
}

// ── SIGN — DRAG-TO-PLACE ──────────────────────────────────────────────────────
let sigDragState = { isDragging:false, startMouseX:0, startMouseY:0, startElX:0, startElY:0 };
let sigFinalPos  = { pageEl:null, xPct:65, yPct:80 }; // defaults

function placeSigOnPDF() {
  if (!TOKEN) { alert('Please upload a PDF first.'); return; }
  const firstPage = document.getElementById('page-wrap-1');
  if (!firstPage) { alert('PDF not loaded yet.'); return; }

  // Create or re-use drag box inside the first page
  removeSigDragBox();
  const box = document.createElement('div');
  box.id = 'sig-drag-box';
  box.style.display = 'flex';
  box.innerHTML = `<div id="sig-drag-label">✋ Drag to position</div><div id="sig-drag-content"></div>`;
  firstPage.appendChild(box);

  // Default position: bottom-right of page
  const pw = firstPage.offsetWidth, ph = firstPage.offsetHeight;
  box.style.left = (pw * 0.60) + 'px';
  box.style.top  = (ph * 0.82) + 'px';

  updateSigDragContent();
  makeSigDraggable(box);

  document.getElementById('sign-place-hint').textContent = '✅ Signature placed! Drag it anywhere on the PDF, then click Process.';
  document.getElementById('sign-place-btn').textContent  = '🔄 Re-place Signature';
}

function removeSigDragBox() {
  const old = document.getElementById('sig-drag-box');
  if (old) old.remove();
}

function updateSigDragContent() {
  const box = document.getElementById('sig-drag-content');
  if (!box) return;
  const method = document.getElementById('sign-method-sel')?.value || 'draw';
  box.innerHTML = '';
  if (method === 'type') {
    const txt = document.getElementById('ed-sig-text')?.value || 'Signature';
    const s = document.createElement('span');
    s.textContent = txt || 'Signature';
    box.appendChild(s);
  } else if (method === 'draw') {
    const c = document.getElementById('ed-sig-canvas');
    if (c) {
      const img = document.createElement('img');
      img.src = c.toDataURL('image/png');
      box.appendChild(img);
    }
  } else if (method === 'upload') {
    const f = document.getElementById('ed-sig-file')?.files[0];
    if (f) {
      const img = document.createElement('img');
      img.src = URL.createObjectURL(f);
      box.appendChild(img);
    }
  }
}

function makeSigDraggable(box) {
  const onDown = e => {
    e.preventDefault();
    const clientX = e.touches ? e.touches[0].clientX : e.clientX;
    const clientY = e.touches ? e.touches[0].clientY : e.clientY;
    sigDragState = { isDragging:true, startMouseX:clientX, startMouseY:clientY,
                     startElX:parseInt(box.style.left)||0, startElY:parseInt(box.style.top)||0 };
    box.classList.add('dragging');
  };
  const onMove = e => {
    if (!sigDragState.isDragging) return;
    e.preventDefault();
    const clientX = e.touches ? e.touches[0].clientX : e.clientX;
    const clientY = e.touches ? e.touches[0].clientY : e.clientY;
    const dx = clientX - sigDragState.startMouseX;
    const dy = clientY - sigDragState.startMouseY;
    const parent = box.parentElement;
    const newX = Math.max(0, Math.min(sigDragState.startElX + dx, parent.offsetWidth  - box.offsetWidth));
    const newY = Math.max(0, Math.min(sigDragState.startElY + dy, parent.offsetHeight - box.offsetHeight));
    box.style.left = newX + 'px';
    box.style.top  = newY + 'px';
  };
  const onUp = e => {
    if (!sigDragState.isDragging) return;
    sigDragState.isDragging = false;
    box.classList.remove('dragging');
    // Capture final position as % of page
    const parent = box.parentElement;
    sigFinalPos.pageEl = parent;
    sigFinalPos.xPct = Math.round((parseInt(box.style.left) / parent.offsetWidth)  * 100);
    sigFinalPos.yPct = Math.round((parseInt(box.style.top)  / parent.offsetHeight) * 100);
  };
  box.addEventListener('mousedown',  onDown);
  box.addEventListener('touchstart', onDown, {passive:false});
  document.addEventListener('mousemove', onMove);
  document.addEventListener('touchmove', onMove, {passive:false});
  document.addEventListener('mouseup',   onUp);
  document.addEventListener('touchend',  onUp);
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

  // Handle crop mode — use drag selection coords
  if (tool.cropMode) {
    if (!cropRect) {
      showProgress(false);
      showError('Please drag on the PDF to select the crop area first.');
      document.getElementById('btn-process').disabled = false;
      return;
    }
    // cropRect is in page-relative percentage {x1,y1,x2,y2} 0-100
    // API expects margins in pt — we send percentages and let the server handle it
    fd.append('crop_x1', cropRect.x1.toFixed(2));
    fd.append('crop_y1', cropRect.y1.toFixed(2));
    fd.append('crop_x2', cropRect.x2.toFixed(2));
    fd.append('crop_y2', cropRect.y2.toFixed(2));
  }

  // Handle sign mode — use drag position + sign content
  if (tool.signMode) {
    const method = document.getElementById('sign-method-sel')?.value || 'draw';

    // Check drag box placed
    const dragBox = document.getElementById('sig-drag-box');
    if (!dragBox) {
      showProgress(false);
      showError('Click "Place Signature on PDF" first, then drag it to position.');
      document.getElementById('btn-process').disabled = false;
      return;
    }

    // Read position from drag box
    const parent = dragBox.parentElement;
    const xPct = Math.round((parseInt(dragBox.style.left) / parent.offsetWidth)  * 100);
    const yPct = Math.round((parseInt(dragBox.style.top)  / parent.offsetHeight) * 100);

    fd.append('placement', 'last');
    fd.append('x', xPct);
    fd.append('y', yPct);
    fd.append('width',  '150');
    fd.append('height', '50');

    if (method === 'type') {
      const txt = document.getElementById('ed-sig-text')?.value?.trim() || '';
      if (!txt) { showProgress(false); showError('Please type your signature name.'); document.getElementById('btn-process').disabled=false; return; }
      fd.append('sign_type', 'text');
      fd.append('sign_text', txt);
      fd.append('font_size', '28');
    } else if (method === 'draw') {
      const c = document.getElementById('ed-sig-canvas');
      if (!c) { showProgress(false); showError('Canvas not ready.'); document.getElementById('btn-process').disabled=false; return; }
      fd.append('sign_type',  'image');
      fd.append('sign_image', c.toDataURL('image/png'));
    } else if (method === 'upload') {
      const f = document.getElementById('ed-sig-file')?.files[0];
      if (!f) { showProgress(false); showError('Please upload a signature image.'); document.getElementById('btn-process').disabled=false; return; }
      fd.append('sign_type', 'image');
      fd.append('sign_file', f, f.name);
    }
  }

  // Collect fields (skip sign-specific ones already handled above)
  if (!tool.signMode) {
    const fieldsEl = document.getElementById('panel-fields');
    fieldsEl.querySelectorAll('input,select,textarea').forEach(el => {
      if (!el.name) return;
      if (el.type === 'checkbox') {
        if (el.checked) fd.append(el.name, el.value);
      } else {
        fd.append(el.name, el.value);
      }
    });
  }

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
      let text = data.summary || data.translation || data.text || data.result || '';
      if (!text) {
        // info / extract-data: format JSON nicely
        text = Object.entries(data).map(([k,v]) => `${k}: ${typeof v==='object'?JSON.stringify(v,null,2):v}`).join('\n');
      }
      showProgress(false);
      showTextResult(text || JSON.stringify(data, null, 2));
    } else if (tool.tableResult) {
      const data = await resp.json();
      showProgress(false);
      showTableResult(data.tables || []);
    } else {
      const blob = await resp.blob();
      resultBlob = blob;
      showProgress(false);
      showDownloadResult(tool.resultFilename || 'result.pdf');
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
  ecmShow(resultBlob, name);
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

// ── CROP MODE ────────────────────────────────────────────────────────────────
let cropRect     = null;   // {x1,y1,x2,y2} in % of first page
let cropDragging = false;
let cropStart    = null;

function getCropOverlay() {
  return document.getElementById('crop-overlay');
}

function startCropMode() {
  const pageWrap = document.querySelector('.page-wrap');
  if (!pageWrap) return;

  // Remove any old overlay first
  const old = document.getElementById('crop-overlay');
  if (old) old.remove();

  // Build overlay and attach directly on the page so coords are page-relative
  const overlay = document.createElement('div');
  overlay.id = 'crop-overlay';
  overlay.style.display = 'block';
  overlay.innerHTML = `
    <div id="crop-selection">
      <div class="crop-handle tl"></div>
      <div class="crop-handle tr"></div>
      <div class="crop-handle bl"></div>
      <div class="crop-handle br"></div>
    </div>
    <div id="crop-hint">Drag to select the area to keep</div>`;
  pageWrap.appendChild(overlay);

  overlay.addEventListener('mousedown',  onCropDown);
  overlay.addEventListener('mousemove',  onCropMove);
  overlay.addEventListener('mouseup',    onCropUp);
  overlay.addEventListener('mouseleave', onCropUp);
  overlay.addEventListener('touchstart', e => { e.preventDefault(); onCropDown(touchPt(e)); }, {passive:false});
  overlay.addEventListener('touchmove',  e => { e.preventDefault(); onCropMove(touchPt(e)); }, {passive:false});
  overlay.addEventListener('touchend',   e => onCropUp(touchPt(e)));

  resetCropSelection();
}

function stopCropMode() {
  const overlay = getCropOverlay();
  if (overlay) overlay.remove();
  cropRect = null; cropDragging = false; cropStart = null;
}

function resetCropSelection() {
  cropRect = null; cropDragging = false; cropStart = null;
  const sel = document.getElementById('crop-selection');
  if (sel) sel.style.display = 'none';
  const d = document.getElementById('crop-coords-display');
  if (d) d.textContent = '';
}

function touchPt(e) {
  const t = e.touches[0] || e.changedTouches[0];
  return { clientX: t.clientX, clientY: t.clientY };
}

function onCropDown(e) {
  e.preventDefault();
  const overlay = getCropOverlay();
  if (!overlay) return;
  const rect = overlay.getBoundingClientRect();
  cropStart = { x: e.clientX - rect.left, y: e.clientY - rect.top };
  cropDragging = true;
  const sel = document.getElementById('crop-selection');
  if (sel) { sel.style.display = 'block'; sel.style.width = '0'; sel.style.height = '0'; }
}

function onCropMove(e) {
  if (!cropDragging || !cropStart) return;
  const overlay = getCropOverlay();
  if (!overlay) return;
  const rect = overlay.getBoundingClientRect();
  const curX = Math.max(0, Math.min(rect.width,  e.clientX - rect.left));
  const curY = Math.max(0, Math.min(rect.height, e.clientY - rect.top));

  const sel = document.getElementById('crop-selection');
  if (!sel) return;
  sel.style.left   = Math.min(cropStart.x, curX) + 'px';
  sel.style.top    = Math.min(cropStart.y, curY) + 'px';
  sel.style.width  = Math.abs(curX - cropStart.x) + 'px';
  sel.style.height = Math.abs(curY - cropStart.y) + 'px';
}

function onCropUp(e) {
  if (!cropDragging || !cropStart) return;
  cropDragging = false;

  const overlay = getCropOverlay();
  if (!overlay) return;
  const rect = overlay.getBoundingClientRect();
  const curX = Math.max(0, Math.min(rect.width,  e.clientX - rect.left));
  const curY = Math.max(0, Math.min(rect.height, e.clientY - rect.top));

  // overlay IS the page — convert directly to % of page dimensions
  const x1 = Math.min(cropStart.x, curX) / rect.width  * 100;
  const y1 = Math.min(cropStart.y, curY) / rect.height * 100;
  const x2 = Math.max(cropStart.x, curX) / rect.width  * 100;
  const y2 = Math.max(cropStart.y, curY) / rect.height * 100;

  if ((x2 - x1) < 2 || (y2 - y1) < 2) { resetCropSelection(); return; }

  cropRect = { x1: Math.max(0,x1), y1: Math.max(0,y1), x2: Math.min(100,x2), y2: Math.min(100,y2) };

  const d = document.getElementById('crop-coords-display');
  if (d) d.textContent = `Selection: ${Math.round(x2-x1)}% × ${Math.round(y2-y1)}% — Click Process to crop`;

  const hint = document.getElementById('crop-hint');
  if (hint) hint.textContent = '✅ Selection ready — click Process in the panel';
}

// ── Email Capture Modal (Editor) ──────────────────────────────────────────
let _ecmBlob = null, _ecmFname = null;

function ecmShow(blob, fname) {
  @if(Auth::check() && Auth::user()->plan === 'pro')
  downloadBlob(blob, fname); return;
  @endif
  const u = JSON.parse(localStorage.getItem('pdftash_usage') || '{}');
  if (u.emailDone) { downloadBlob(blob, fname); return; }

  _ecmBlob  = blob;
  _ecmFname = fname;
  document.getElementById('ecm-fname').textContent = fname;
  document.getElementById('ecm-email').value = '';
  const ov = document.getElementById('ecm-overlay');
  ov.style.display = 'flex';
  setTimeout(() => document.getElementById('ecm-email').focus(), 100);
}

function ecmSkip() {
  document.getElementById('ecm-overlay').style.display = 'none';
  if (_ecmBlob) { downloadBlob(_ecmBlob, _ecmFname); _ecmBlob = null; }
}

async function ecmSubmit() {
  const email = document.getElementById('ecm-email').value.trim();
  document.getElementById('ecm-overlay').style.display = 'none';
  if (email && /\S+@\S+\.\S+/.test(email)) {
    fetch('/save-lead', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || '' },
      body: JSON.stringify({ email, tool: 'editor' })
    }).catch(() => {});
    const stored = JSON.parse(localStorage.getItem('pdftash_usage') || '{}');
    stored.emailDone = true;
    localStorage.setItem('pdftash_usage', JSON.stringify(stored));
  }
  if (_ecmBlob) { downloadBlob(_ecmBlob, _ecmFname); _ecmBlob = null; }
}
</script>

<!-- Email Capture Modal -->
<div id="ecm-overlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.75);z-index:9999;align-items:center;justify-content:center;backdrop-filter:blur(4px);">
  <div style="background:#13131e;border:1px solid rgba(91,92,255,.35);border-radius:24px;padding:40px 36px;max-width:420px;width:90%;text-align:center;position:relative;box-shadow:0 24px 80px rgba(0,0,0,.6);">
    <button onclick="ecmSkip()" style="position:absolute;top:14px;right:16px;background:none;border:none;color:#44445a;font-size:22px;cursor:pointer;line-height:1;">×</button>
    <div style="font-size:44px;margin-bottom:14px;">🎉</div>
    <h3 style="font-size:20px;font-weight:800;color:#eeeef8;margin-bottom:6px;">Your file is ready!</h3>
    <div id="ecm-fname" style="font-size:13px;color:#5b5cff;font-weight:600;margin-bottom:20px;"></div>
    <div style="background:rgba(0,229,160,.08);border:1px solid rgba(0,229,160,.2);border-radius:12px;padding:12px 16px;margin-bottom:20px;">
      <span style="font-size:13px;color:#00e5a0;font-weight:600;">🎁 Get 3 bonus free uses today</span>
      <div style="font-size:12px;color:#8888a8;margin-top:4px;">Enter your email — we'll notify you when we add new tools.</div>
    </div>
    <div style="display:flex;gap:8px;margin-bottom:10px;">
      <input type="email" id="ecm-email" placeholder="your@email.com" style="flex:1;padding:12px 14px;background:#1a1a28;border:1px solid rgba(255,255,255,.13);border-radius:10px;color:#eeeef8;font-size:14px;outline:none;" onkeydown="if(event.key==='Enter')ecmSubmit()">
      <button onclick="ecmSubmit()" style="padding:12px 18px;background:#5b5cff;color:#fff;border:none;border-radius:10px;font-weight:700;cursor:pointer;font-size:14px;white-space:nowrap;">Get it →</button>
    </div>
    <button onclick="ecmSkip()" style="background:none;border:none;color:#44445a;font-size:12px;cursor:pointer;text-decoration:underline;margin-bottom:14px;">No thanks, just download</button>
    <div style="font-size:11px;color:#2a2a40;">🔒 No spam, ever.</div>
  </div>
</div>

</body>
</html>
