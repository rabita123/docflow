@extends('tools.layout')

@section('title', 'Compress PDF Online Free — Reduce PDF Size')
@section('description', 'Compress PDF files online for free. Reduce PDF file size without losing quality. No signup needed. Fast and secure.')
@section('keywords', 'compress pdf, reduce pdf size, pdf compressor online free')
@section('slug', 'compress-pdf')

@section('content')
<div class="hero">
  <div class="badge">🗜️ Free PDF Compressor</div>
  <h1>Compress PDF Online Free</h1>
  <p>Reduce your PDF file size without losing quality. Fast, free, and secure. No signup needed.</p>
</div>

<div class="tool-box">
  <div class="upload-area" onclick="window.location.href='/#compress'">
    <div class="upload-icon">📄</div>
    <div class="upload-title">Drop your PDF here</div>
    <div class="upload-sub">Click to browse · Max 10MB free</div>
  </div>
  <div style="text-align:center">
    <a href="/#compress" class="btn">Compress PDF Free →</a>
  </div>
</div>

<div class="features">
  <div class="feature">
    <div class="feature-icon">⚡</div>
    <div class="feature-title">Fast Compression</div>
    <div class="feature-desc">Compress your PDF in seconds</div>
  </div>
  <div class="feature">
    <div class="feature-icon">🔒</div>
    <div class="feature-title">100% Secure</div>
    <div class="feature-desc">Files deleted after 2 hours</div>
  </div>
  <div class="feature">
    <div class="feature-icon">✨</div>
    <div class="feature-title">No Quality Loss</div>
    <div class="feature-desc">Smart compression maintains quality</div>
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>How to compress a PDF file online for free?</h3>
    <p>Upload your PDF to PDFTash, click "Compress PDF" and download instantly. No signup required.</p>
  </div>
  <div class="faq-item">
    <h3>Will compressing reduce quality?</h3>
    <p>PDFTash uses smart compression to reduce file size while maintaining the best possible quality.</p>
  </div>
  <div class="faq-item">
    <h3>What is the maximum PDF file size?</h3>
    <p>Free users can compress PDFs up to 10MB. Pro users ($9/mo) can compress up to 200MB.</p>
  </div>
  <div class="faq-item">
    <h3>Is PDFTash a good free alternative to Smallpdf?</h3>
    <p>Yes! PDFTash offers the same compression as Smallpdf and Sejda — completely free with no signup. Plus AI features.</p>
  </div>
</div>
@endsection