@extends('tools.layout')

@section('title', 'Split PDF Online Free — Extract PDF Pages')
@section('description', 'Split PDF files online for free. Extract specific pages or split PDF into multiple files. No signup needed. Fast and secure.')
@section('keywords', 'split pdf, extract pdf pages, split pdf online free, divide pdf, separate pdf pages')
@section('slug', 'split-pdf')

@section('content')
<div class="hero">
  <div class="badge">✂️ Free PDF Splitter</div>
  <h1>Split PDF Online Free</h1>
  <p>Extract specific pages or split your PDF into multiple files. Fast, free, and secure. No signup needed.</p>
</div>

<div class="tool-box">
  <div class="upload-area" onclick="window.location.href='/#split'">
    <div class="upload-icon">✂️</div>
    <div class="upload-title">Drop your PDF here</div>
    <div class="upload-sub">Select pages to extract or split · Max 10MB free</div>
  </div>
  <div style="text-align:center">
    <a href="/#split" class="btn">Split PDF Free →</a>
  </div>
</div>

<div class="features">
  <div class="feature">
    <div class="feature-icon">📄</div>
    <div class="feature-title">Extract Pages</div>
    <div class="feature-desc">Select specific pages to extract from your PDF</div>
  </div>
  <div class="feature">
    <div class="feature-icon">📂</div>
    <div class="feature-title">Split by Range</div>
    <div class="feature-desc">Split PDF into multiple files by page range</div>
  </div>
  <div class="feature">
    <div class="feature-icon">🔒</div>
    <div class="feature-title">100% Secure</div>
    <div class="feature-desc">Files deleted automatically after 2 hours</div>
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>How to split a PDF file online for free?</h3>
    <p>Upload your PDF to PDFTash, select the pages you want to extract, and click "Split PDF". Download instantly. No signup required.</p>
  </div>
  <div class="faq-item">
    <h3>Can I extract specific pages from a PDF?</h3>
    <p>Yes! PDFTash lets you select any combination of pages to extract. For example, extract pages 1, 3, 5-10 from a large PDF.</p>
  </div>
  <div class="faq-item">
    <h3>Is PDFTash better than Smallpdf for splitting PDFs?</h3>
    <p>PDFTash offers the same PDF splitting as Smallpdf and Sejda — completely free with no daily limits. Plus AI features.</p>
  </div>
  <div class="faq-item">
    <h3>How many pages can I extract from a PDF?</h3>
    <p>Free users can extract any number of pages from PDFs up to 10MB. Pro users ($9/mo) can split PDFs up to 200MB.</p>
  </div>
</div>
@endsection