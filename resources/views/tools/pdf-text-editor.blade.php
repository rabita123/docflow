@extends('tools.layout')

@section('title', 'PDF Text Editor — Edit PDF Text Online Free')
@section('description', 'Edit PDF text online for free. Upload a PDF, edit the extracted text directly in your browser, and download as a new PDF instantly. No signup needed.')
@section('keywords', 'pdf text editor, edit pdf text online, edit pdf online free, pdf editor, modify pdf text, pdf text changer')
@section('slug', 'pdf-text-editor')

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Edit PDF Text Online",
  "description": "Edit the text content of any PDF document in your browser and download as a new PDF.",
  "step": [
    {"@type":"HowToStep","position":1,"name":"Upload PDF","text":"Drag and drop or click to upload your PDF file."},
    {"@type":"HowToStep","position":2,"name":"Edit Text","text":"The PDF text is extracted and shown in an editable editor. Make your changes."},
    {"@type":"HowToStep","position":3,"name":"Download","text":"Click Download PDF to get your edited document instantly."}
  ]
}
</script>
@endsection

@section('content')
<div class="hero">
  <div class="badge">✏️ PDF Text Editor</div>
  <h1>Edit PDF Text Online Free</h1>
  <p>Upload any PDF, edit the text directly in your browser, and download as a clean new PDF — no software needed.</p>
</div>

{{-- STEP 1: Upload --}}
<div class="tool-box" id="step-upload">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">📄</div>
    <div class="upload-title">Drop your PDF here to Edit</div>
    <div class="upload-sub">Click to browse · Max 10MB · No signup needed</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="upload-status" style="display:none;text-align:center;padding:20px;color:#8888a8;font-size:14px;"></div>
</div>

{{-- STEP 2: Editor (hidden until text is extracted) --}}
<div id="step-editor" style="display:none;max-width:820px;margin:0 auto 40px;padding:0 20px;">

  {{-- Document title --}}
  <div style="margin-bottom:14px;">
    <label style="color:#eeeef8;font-size:13px;font-weight:600;display:block;margin-bottom:6px;">Document Title</label>
    <input type="text" id="doc-title" placeholder="My Edited Document"
      style="width:100%;padding:10px 14px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:10px;color:#eeeef8;font-size:14px;font-family:'Inter',sans-serif;">
  </div>

  {{-- Toolbar --}}
  <div id="toolbar" style="display:flex;flex-wrap:wrap;gap:6px;padding:10px 14px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:12px 12px 0 0;align-items:center;">

    {{-- Format buttons --}}
    <button onclick="fmt('bold')"      title="Bold"      style="width:32px;height:32px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:6px;color:#eeeef8;font-size:14px;font-weight:700;cursor:pointer;">B</button>
    <button onclick="fmt('italic')"    title="Italic"    style="width:32px;height:32px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:6px;color:#eeeef8;font-size:14px;font-style:italic;cursor:pointer;">I</button>
    <button onclick="fmt('underline')" title="Underline" style="width:32px;height:32px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:6px;color:#eeeef8;font-size:14px;text-decoration:underline;cursor:pointer;">U</button>

    <div style="width:1px;height:24px;background:rgba(255,255,255,.12);margin:0 4px;"></div>

    {{-- Headings --}}
    <button onclick="fmt('formatBlock','h2')" title="Heading" style="padding:0 10px;height:32px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:6px;color:#eeeef8;font-size:12px;font-weight:600;cursor:pointer;">H2</button>
    <button onclick="fmt('formatBlock','h3')" title="Subheading" style="padding:0 10px;height:32px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:6px;color:#eeeef8;font-size:12px;cursor:pointer;">H3</button>
    <button onclick="fmt('formatBlock','p')"  title="Paragraph" style="padding:0 10px;height:32px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:6px;color:#eeeef8;font-size:12px;cursor:pointer;">¶</button>

    <div style="width:1px;height:24px;background:rgba(255,255,255,.12);margin:0 4px;"></div>

    {{-- Lists --}}
    <button onclick="fmt('insertUnorderedList')" title="Bullet list" style="width:32px;height:32px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:6px;color:#eeeef8;font-size:15px;cursor:pointer;">≡</button>
    <button onclick="fmt('insertOrderedList')"   title="Numbered list" style="width:32px;height:32px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:6px;color:#eeeef8;font-size:12px;cursor:pointer;">1.</button>

    <div style="width:1px;height:24px;background:rgba(255,255,255,.12);margin:0 4px;"></div>

    {{-- Alignment --}}
    <button onclick="fmt('justifyLeft')"   title="Align left"   style="width:32px;height:32px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:6px;color:#eeeef8;font-size:13px;cursor:pointer;">⬅</button>
    <button onclick="fmt('justifyCenter')" title="Center"       style="width:32px;height:32px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:6px;color:#eeeef8;font-size:13px;cursor:pointer;">↔</button>
    <button onclick="fmt('justifyRight')"  title="Align right"  style="width:32px;height:32px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:6px;color:#eeeef8;font-size:13px;cursor:pointer;">➡</button>

    <div style="width:1px;height:24px;background:rgba(255,255,255,.12);margin:0 4px;"></div>

    {{-- Font size --}}
    <select id="font-size" onchange="applyFontSize()" style="height:32px;padding:0 8px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:6px;color:#eeeef8;font-size:12px;cursor:pointer;">
      <option value="11">Small</option>
      <option value="13" selected>Normal</option>
      <option value="15">Large</option>
      <option value="18">X-Large</option>
    </select>

    {{-- Font family --}}
    <select id="font-family" style="height:32px;padding:0 8px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:6px;color:#eeeef8;font-size:12px;cursor:pointer;">
      <option value="serif">Serif</option>
      <option value="sans">Sans-serif</option>
      <option value="mono">Monospace</option>
    </select>

    <div style="margin-left:auto;">
      <span id="char-count" style="color:#44445a;font-size:12px;"></span>
    </div>
  </div>

  {{-- Editor area --}}
  <div id="editor" contenteditable="true" spellcheck="true"
    style="min-height:400px;padding:24px 28px;background:#0d0d1f;border:1px solid rgba(255,255,255,.1);border-top:none;border-radius:0 0 12px 12px;color:#dde1f0;font-size:14px;line-height:1.85;font-family:'Georgia',serif;outline:none;white-space:pre-wrap;overflow-y:auto;">
  </div>

  {{-- Action buttons --}}
  <div style="display:flex;gap:12px;margin-top:16px;flex-wrap:wrap;">
    <button onclick="exportPdf()" id="export-btn"
      style="flex:1;min-width:200px;padding:14px 28px;background:linear-gradient(135deg,#5b5cff,#7475ff);color:#fff;border:none;border-radius:99px;font-size:15px;font-weight:700;cursor:pointer;box-shadow:0 4px 20px rgba(91,92,255,.3);">
      ⬇ Download as PDF
    </button>
    <button onclick="resetEditor()"
      style="padding:14px 24px;background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);border-radius:99px;font-size:14px;cursor:pointer;">
      ✕ Start Over
    </button>
  </div>

  <p style="color:#44445a;font-size:12px;margin-top:10px;text-align:center;">
    Formatting is preserved in the exported PDF
  </p>
</div>

{{-- HOW IT WORKS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">How PDF Text Editor Works</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
    @foreach([
      ['📤','Upload PDF','Drop your PDF file. Text is extracted instantly from all pages.'],
      ['✏️','Edit Freely','Make any changes — fix typos, rewrite sections, reformat text.'],
      ['⬇️','Download PDF','Export your edited content as a clean, professionally formatted PDF.'],
    ] as $i => $s)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:24px;text-align:center;">
      <div style="width:32px;height:32px;background:#5b5cff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:14px;margin:0 auto 12px;">{{ $i+1 }}</div>
      <div style="font-size:28px;margin-bottom:10px;">{{ $s[0] }}</div>
      <div style="font-weight:600;margin-bottom:6px;font-size:14px;">{{ $s[1] }}</div>
      <div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $s[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- USE CASES --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">What Can You Edit?</h2>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['📋','Fix Typos & Errors','Correct spelling mistakes, grammar issues, or outdated information in any PDF.'],
      ['📝','Update Documents','Refresh reports, letters, or forms with new text without recreating them.'],
      ['🎓','Reformat Notes','Clean up extracted study notes, reorganize content, and add headings.'],
      ['📊','Edit Reports','Modify text in business reports, proposals, or contracts quickly.'],
    ] as $u)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:20px;">
      <div style="font-size:28px;margin-bottom:8px;">{{ $u[0] }}</div>
      <div style="font-weight:600;font-size:14px;margin-bottom:6px;">{{ $u[1] }}</div>
      <div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $u[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- RELATED TOOLS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:20px;">Related PDF Tools</h2>
  <div style="display:flex;flex-wrap:wrap;gap:10px;justify-content:center;">
    @foreach([
      ['/compress-pdf','🗜️ Compress PDF'],
      ['/merge-pdf','🔗 Merge PDF'],
      ['/split-pdf','✂️ Split PDF'],
      ['/translate-pdf','🌐 Translate PDF'],
      ['/ai-pdf-generator','✨ AI PDF Generator'],
      ['/chat-with-pdf','💬 Chat with PDF'],
    ] as $t)
    <a href="{{ $t[0] }}" style="padding:8px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#ccc;text-decoration:none;font-size:13px;transition:all .2s;"
       onmouseover="this.style.borderColor='#5b5cff';this.style.color='#fff'"
       onmouseout="this.style.borderColor='rgba(255,255,255,.1)';this.style.color='#ccc'">
      {{ $t[1] }}
    </a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>Can I edit text in any PDF?</h3>
    <p>Yes, as long as the PDF contains selectable text. Scanned PDFs (image-only) cannot be edited — for those, you would need OCR first.</p>
  </div>
  <div class="faq-item">
    <h3>Does the formatting stay the same?</h3>
    <p>The text content is fully editable. The original PDF layout is not preserved — the editor gives you clean, reformatted output. You can apply your own bold, italic, headings and alignment.</p>
  </div>
  <div class="faq-item">
    <h3>Is my PDF secure?</h3>
    <p>Yes. Your file is processed on our server and automatically deleted immediately after text extraction. We never store your documents.</p>
  </div>
  <div class="faq-item">
    <h3>What is the maximum file size?</h3>
    <p>Free users can edit PDFs up to 10MB. The tool supports up to 30 pages of text extraction.</p>
  </div>
  <div class="faq-item">
    <h3>Can I use this on mobile?</h3>
    <p>Yes! The PDF Text Editor works on any device — desktop, tablet or mobile browser. No app download needed.</p>
  </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

// ── Drag & Drop ────────────────────────────────────────────────────────────
const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.style.borderColor = '#5b5cff'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', e => {
    e.preventDefault();
    dropZone.style.borderColor = 'rgba(255,255,255,.15)';
    const f = e.dataTransfer.files[0];
    if (f && f.name.toLowerCase().endsWith('.pdf')) uploadFile(f);
    else alert('Please drop a PDF file.');
});

function handleFile(input) {
    if (input.files[0]) uploadFile(input.files[0]);
}

// ── Upload & Extract ───────────────────────────────────────────────────────
async function uploadFile(file) {
    const status = document.getElementById('upload-status');
    dropZone.style.display = 'none';
    status.style.display = 'block';
    status.innerHTML = '⏳ Extracting text from PDF...';

    const formData = new FormData();
    formData.append('file', file);
    formData.append('_token', CSRF);

    try {
        const resp = await fetch('/api/pdf/text-editor/extract', { method: 'POST', body: formData });
        const data = await resp.json();

        if (resp.ok) {
            // Populate editor
            const editor = document.getElementById('editor');
            // Convert plain text newlines to <p> tags for contenteditable
            const html = data.text
                .split(/\n{2,}/)
                .map(para => `<p>${para.replace(/\n/g, '<br>').replace(/</g, '&lt;').replace(/>/g, '&gt;')}</p>`)
                .join('');
            editor.innerHTML = html;

            document.getElementById('doc-title').value = data.original_name || 'Edited Document';
            updateCharCount();

            document.getElementById('step-upload').style.display = 'none';
            document.getElementById('step-editor').style.display = 'block';
        } else if (data.error === 'free_limit_reached') {
            status.innerHTML = `
                <div style="background:#1a0a0a;border:1px solid #ff6b6b;border-radius:12px;padding:20px;max-width:400px;margin:0 auto;">
                    <div style="color:#ff6b6b;font-weight:700;margin-bottom:8px;">Daily limit reached!</div>
                    <div style="color:#8888a8;font-size:14px;margin-bottom:16px;">Upgrade to Pro for unlimited access</div>
                    <a href="/#pricing" style="display:inline-block;padding:12px 24px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600;">Upgrade to Pro →</a>
                </div>`;
        } else {
            status.innerHTML = `<div style="color:#ff6b6b;">${data.error || 'Something went wrong. Please try again.'}</div>
                <button onclick="resetEditor()" style="margin-top:12px;background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:8px 20px;border-radius:99px;cursor:pointer;font-size:13px;">Try Again</button>`;
        }
    } catch (e) {
        status.innerHTML = `<div style="color:#ff6b6b;">Connection error. Please try again.</div>
            <button onclick="resetEditor()" style="margin-top:12px;background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:8px 20px;border-radius:99px;cursor:pointer;font-size:13px;">Try Again</button>`;
    }
}

// ── Toolbar helpers ────────────────────────────────────────────────────────
function fmt(cmd, val) {
    document.getElementById('editor').focus();
    document.execCommand(cmd, false, val || null);
}

function applyFontSize() {
    // execCommand fontSize uses 1-7 scale; we use custom CSS instead
    document.getElementById('editor').focus();
    const size = document.getElementById('font-size').value;
    document.execCommand('fontSize', false, '3'); // placeholder
    // replace font tags with span
    document.querySelectorAll('#editor font[size="3"]').forEach(el => {
        const span = document.createElement('span');
        span.style.fontSize = size + 'px';
        span.innerHTML = el.innerHTML;
        el.replaceWith(span);
    });
}

// ── Character counter ──────────────────────────────────────────────────────
const editor = document.getElementById('editor');
editor.addEventListener('input', updateCharCount);

function updateCharCount() {
    const count = editor.innerText.length;
    document.getElementById('char-count').textContent = count.toLocaleString() + ' characters';
}

// ── Export to PDF ──────────────────────────────────────────────────────────
async function exportPdf() {
    const content  = document.getElementById('editor').innerHTML;
    const title    = document.getElementById('doc-title').value.trim() || 'Edited Document';
    const fontSize = document.getElementById('font-size').value;
    const fontFam  = document.getElementById('font-family').value;
    const btn      = document.getElementById('export-btn');

    if (!content.trim()) { alert('Nothing to export.'); return; }

    btn.disabled = true;
    btn.textContent = '⏳ Generating PDF...';

    const formData = new FormData();
    formData.append('content',     content);
    formData.append('title',       title);
    formData.append('font_size',   fontSize);
    formData.append('font_family', fontFam);
    formData.append('_token',      CSRF);

    try {
        const resp = await fetch('/api/pdf/text-editor/export', { method: 'POST', body: formData });

        if (resp.ok) {
            const blob = await resp.blob();
            const url  = URL.createObjectURL(blob);
            const a    = document.createElement('a');
            a.href     = url;
            a.download = (title.replace(/[^a-z0-9]/gi, '-').toLowerCase() || 'edited-document') + '.pdf';
            a.click();
            URL.revokeObjectURL(url);
        } else {
            const data = await resp.json().catch(() => ({}));
            alert('Export failed: ' + (data.error || 'Please try again.'));
        }
    } catch (e) {
        alert('Connection error. Please try again.');
    } finally {
        btn.disabled = false;
        btn.textContent = '⬇ Download as PDF';
    }
}

// ── Reset ──────────────────────────────────────────────────────────────────
function resetEditor() {
    location.reload();
}
</script>
@endsection
