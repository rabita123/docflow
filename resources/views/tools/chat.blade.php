@extends('tools.layout')

@section('title', 'Chat with PDF Online Free — AI PDF Chat')
@section('description', 'Chat with your PDF documents using AI. Ask questions, get summaries, extract information from any PDF. Free online tool.')
@section('keywords', 'chat with pdf, ai pdf chat, talk to pdf, ask pdf questions, pdf ai assistant free')
@section('slug', 'chat-with-pdf')

@section('content')
<div class="hero">
  <div class="badge">🤖 AI PDF Chat</div>
  <h1>Chat with PDF Using AI</h1>
  <p>Upload any PDF and start asking questions. Our AI reads your document and answers instantly. No signup needed.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">💬</div>
    <div class="upload-title">Drop your PDF here to Chat</div>
    <div class="upload-sub">Ask questions about any PDF · Powered by AI</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>

  <div id="chat-ui" style="display:none;margin-top:16px;">
    <div id="messages" style="background:#0f0f1a;border:1px solid rgba(255,255,255,.11);border-radius:12px;padding:16px;min-height:120px;max-height:350px;overflow-y:auto;margin-bottom:12px;font-size:14px;color:#eeeef8;"></div>
    <div style="display:flex;gap:8px;">
      <input type="text" id="question" placeholder="Ask anything about your PDF..." onkeydown="if(event.key==='Enter')sendMsg()" style="flex:1;padding:10px 14px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:10px;color:#eeeef8;font-size:14px;">
      <button type="button" onclick="sendMsg()" style="padding:10px 20px;background:#5b5cff;color:#fff;border:none;border-radius:10px;font-weight:600;cursor:pointer;">Send</button>
    </div>
  </div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Your files are automatically deleted after 2 hours</p>
  </div>
</div>

<div class="features">
  <div class="feature">
    <div class="feature-icon">🧠</div>
    <div class="feature-title">Smart AI</div>
    <div class="feature-desc">Advanced AI understands complex documents</div>
  </div>
  <div class="feature">
    <div class="feature-icon">⚡</div>
    <div class="feature-title">Instant Answers</div>
    <div class="feature-desc">Get answers to your questions in seconds</div>
  </div>
  <div class="feature">
    <div class="feature-icon">📊</div>
    <div class="feature-title">Any PDF Type</div>
    <div class="feature-desc">Works with reports, books, contracts, research papers</div>
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>How does AI PDF chat work?</h3>
    <p>Upload your PDF to PDFTash, then type your question in the chat box. Our AI reads the entire document and gives you accurate answers based on the content.</p>
  </div>
  <div class="faq-item">
    <h3>What types of PDFs can I chat with?</h3>
    <p>You can chat with any PDF — research papers, legal contracts, financial reports, books, user manuals, and more.</p>
  </div>
  <div class="faq-item">
    <h3>Is PDF AI chat free?</h3>
    <p>Yes! Free users get 1 AI chat per day. Pro users ($9/mo) get unlimited AI chat with any PDF documents.</p>
  </div>
  <div class="faq-item">
    <h3>How is this different from ChatGPT?</h3>
    <p>ChatGPT cannot read your PDF files directly. PDFTash AI is specifically designed to analyze and answer questions from your PDF documents accurately.</p>
  </div>
  <div class="faq-item">
    <h3>Can I summarize a PDF using AI?</h3>
    <p>Yes! Just ask "Summarize this document" and PDFTash AI will give you a clear, concise summary of your entire PDF.</p>
  </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
let chatFileId = null;

const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = '#5b5cff'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    const f = e.dataTransfer.files[0];
    if (f && f.type === 'application/pdf') uploadFile(f);
});

function handleFile(input) {
    if (input.files[0]) uploadFile(input.files[0]);
}

async function uploadFile(file) {
    dropZone.querySelector('.upload-title').textContent = '⏳ Uploading ' + file.name + '...';
    const formData = new FormData();
    formData.append('file', file);
    formData.append('_token', CSRF);

    try {
        const resp = await fetch('/api/ai/upload-for-chat', { method: 'POST', body: formData });
        const data = await resp.json();
        if (data.file_id || data.id) {
            chatFileId = data.file_id || data.id;
            dropZone.querySelector('.upload-title').textContent = '✅ ' + file.name;
            document.getElementById('chat-ui').style.display = 'block';
            addMsg('assistant', 'PDF uploaded! Ask me anything about this document.');
        } else {
            dropZone.querySelector('.upload-title').textContent = 'Error: ' + (data.error || 'Upload failed');
        }
    } catch(e) {
        dropZone.querySelector('.upload-title').textContent = 'Connection error. Please try again.';
    }
}

function addMsg(role, text) {
    const msgs = document.getElementById('messages');
    const color = role === 'user' ? '#5b5cff' : '#00e5a0';
    const label = role === 'user' ? 'You' : 'AI';
    msgs.innerHTML += `<div style="margin-bottom:12px;"><span style="color:${color};font-weight:600;font-size:12px">${label}</span><div style="margin-top:4px;line-height:1.6">${text}</div></div>`;
    msgs.scrollTop = msgs.scrollHeight;
}

async function sendMsg() {
    const input = document.getElementById('question');
    const q = input.value.trim();
    if (!q || !chatFileId) return;
    input.value = '';
    addMsg('user', q);
    addMsg('assistant', '⏳ Thinking...');

    const formData = new FormData();
    formData.append('file_id', chatFileId);
    formData.append('message', q);
    formData.append('_token', CSRF);

    try {
        const resp = await fetch('/api/ai/chat', { method: 'POST', body: formData });
        const data = await resp.json();
        const msgs = document.getElementById('messages');
        const lastMsg = msgs.lastElementChild;
        if (lastMsg) lastMsg.querySelector('div').textContent = data.reply || data.response || data.error || 'No response';
    } catch(e) {
        const msgs = document.getElementById('messages');
        const lastMsg = msgs.lastElementChild;
        if (lastMsg) lastMsg.querySelector('div').textContent = 'Connection error. Please try again.';
    }
}
</script>
@endsection
