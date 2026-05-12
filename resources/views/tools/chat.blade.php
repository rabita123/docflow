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
  <div class="upload-area" onclick="window.location.href='/#chat'">
    <div class="upload-icon">💬</div>
    <div class="upload-title">Upload PDF to Chat</div>
    <div class="upload-sub">Ask questions about any PDF · Powered by AI</div>
  </div>
  <div style="text-align:center">
    <a href="/#chat" class="btn">Chat with PDF Free →</a>
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
@endsection