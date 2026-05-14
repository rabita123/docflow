@extends('tools.layout')

@section('title', 'Chat with PDF Online Free — Ask AI Questions About Any PDF')
@section('description', 'Chat with any PDF using AI. Ask questions, get instant answers, extract key information and summaries from any document. Free, no signup needed.')
@section('keywords', 'chat with pdf, ai pdf chat, talk to pdf, ask pdf questions, pdf ai assistant free, chatpdf alternative, pdf question answering, ai document chat')
@section('slug', 'chat-with-pdf')

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"How does Chat with PDF work?","acceptedAnswer":{"@type":"Answer","text":"Upload your PDF to PDFTash. Our AI reads the document and you can then ask any question about its content. The AI answers instantly based on the document text."}},
    {"@type":"Question","name":"What kinds of questions can I ask about my PDF?","acceptedAnswer":{"@type":"Answer","text":"You can ask anything — summarize this document, what are the key points, explain section 3, what does this contract say about payment terms, find all dates mentioned, and more."}},
    {"@type":"Question","name":"Is Chat with PDF free?","acceptedAnswer":{"@type":"Answer","text":"Yes. Free users get 1 AI chat session per day. Pro users ($9/month) get unlimited AI chats with larger PDF files up to 200MB."}},
    {"@type":"Question","name":"Is PDFTash a good ChatPDF alternative?","acceptedAnswer":{"@type":"Answer","text":"Yes! PDFTash offers the same AI chat functionality as ChatPDF — completely free with no signup. Plus PDF tools like compress, merge, translate and sign."}},
    {"@type":"Question","name":"What languages can I chat in?","acceptedAnswer":{"@type":"Answer","text":"You can ask questions in any language including English, Bengali, Hindi, Arabic, Spanish and more. The AI understands and responds in your language."}}
  ]
}
</script>
@endsection

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

{{-- HOW IT WORKS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">How to Chat with Your PDF</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
    @foreach([
      ['📤','Upload PDF','Drop your PDF file. The AI reads and indexes the full document.'],
      ['💬','Ask Anything','Type your question — summarize, explain, find information, compare sections.'],
      ['🤖','Get Answers','AI responds instantly based on your document content.'],
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
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:32px;">What Can You Ask Your PDF?</h2>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['📝','Summarize Documents','Ask "Summarize this document in 5 bullet points" to get a quick overview.'],
      ['⚖️','Understand Contracts','Ask "What are the payment terms?" or "When does this contract expire?"'],
      ['🎓','Study & Research','Ask questions about a research paper or textbook chapter to understand faster.'],
      ['📊','Extract Data','Ask "List all dates mentioned" or "What are the key statistics in this report?"'],
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
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:22px;font-weight:700;margin-bottom:20px;">More Free PDF Tools</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([['Compress PDF','/compress-pdf'],['Merge PDF','/merge-pdf'],['Split PDF','/split-pdf'],['Translate PDF','/translate-pdf'],['Sign PDF','/sign-pdf']] as $t)
    <a href="{{ $t[1] }}" style="padding:10px 18px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
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
