@extends('tools.layout')

@section('title', 'Merge PDF Files Online Free — Combine PDF')
@section('description', 'Merge multiple PDF files into one online for free. Combine PDF documents easily. No signup needed. Fast and secure.')
@section('keywords', 'merge pdf, combine pdf, merge pdf files online free, join pdf files')
@section('slug', 'merge-pdf')

@section('content')
<div class="hero">
  <div class="badge">📎 Free PDF Merger</div>
  <h1>Merge PDF Files Online Free</h1>
  <p>Combine multiple PDF documents into one file. Fast, free, and secure. No signup needed.</p>
</div>

<div class="tool-box">
  <div class="upload-area" onclick="window.location.href='/#merge'">
    <div class="upload-icon">📑</div>
    <div class="upload-title">Drop your PDFs here</div>
    <div class="upload-sub">Upload multiple PDF files to merge · Max 10MB free</div>
  </div>
  <div style="text-align:center">
    <a href="/#merge" class="btn">Merge PDF Free →</a>
  </div>
</div>

<div class="features">
  <div class="feature">
    <div class="feature-icon">📚</div>
    <div class="feature-title">Multiple Files</div>
    <div class="feature-desc">Merge unlimited PDF files into one</div>
  </div>
  <div class="feature">
    <div class="feature-icon">🔄</div>
    <div class="feature-title">Custom Order</div>
    <div class="feature-desc">Arrange pages in any order</div>
  </div>
  <div class="feature">
    <div class="feature-icon">🔒</div>
    <div class="feature-title">100% Secure</div>
    <div class="feature-desc">Files deleted after 2 hours</div>
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>How to merge PDF files online for free?</h3>
    <p>Upload your PDF files to PDFTash, arrange them in your desired order, and click "Merge PDF". Download instantly. No signup required.</p>
  </div>
  <div class="faq-item">
    <h3>How many PDF files can I merge at once?</h3>
    <p>Free users can merge up to 5 PDF files per day. Pro users ($9/mo) can merge unlimited files.</p>
  </div>
  <div class="faq-item">
    <h3>Is PDFTash better than ILovePDF for merging?</h3>
    <p>PDFTash offers the same PDF merging as ILovePDF and Smallpdf — completely free. Plus unique AI features.</p>
  </div>
  <div class="faq-item">
    <h3>Will quality be affected when merging PDFs?</h3>
    <p>No! PDFTash merges PDF files without any quality loss. Your documents will look exactly the same.</p>
  </div>
</div>
@endsection