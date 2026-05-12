@extends('tools.layout')

@section('title', 'Sign PDF Online Free — Add Digital Signature')
@section('description', 'Add digital signature to PDF online for free. Sign PDF documents electronically. No signup needed. Fast and secure.')
@section('keywords', 'sign pdf online, digital signature pdf, electronic signature pdf, sign pdf free, pdf signature')
@section('slug', 'sign-pdf')

@section('content')
<div class="hero">
  <div class="badge">✍️ Free PDF Signer</div>
  <h1>Sign PDF Online Free</h1>
  <p>Add your digital signature to any PDF document online. Fast, free, and secure. No signup needed.</p>
</div>

<div class="tool-box">
  <div class="upload-area" onclick="window.location.href='/#sign'">
    <div class="upload-icon">✍️</div>
    <div class="upload-title">Drop your PDF here</div>
    <div class="upload-sub">Draw, type or upload your signature · Free</div>
  </div>
  <div style="text-align:center">
    <a href="/#sign" class="btn">Sign PDF Free →</a>
  </div>
</div>

<div class="features">
  <div class="feature">
    <div class="feature-icon">✏️</div>
    <div class="feature-title">Draw Signature</div>
    <div class="feature-desc">Draw your signature with mouse or touch</div>
  </div>
  <div class="feature">
    <div class="feature-icon">⌨️</div>
    <div class="feature-title">Type Signature</div>
    <div class="feature-desc">Type your name and choose a signature style</div>
  </div>
  <div class="feature">
    <div class="feature-icon">📤</div>
    <div class="feature-title">Upload Signature</div>
    <div class="feature-desc">Upload an image of your handwritten signature</div>
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>How to sign a PDF online for free?</h3>
    <p>Upload your PDF to PDFTash, click "Add Signature", draw or type your signature, position it on the document, and download your signed PDF. No signup required.</p>
  </div>
  <div class="faq-item">
    <h3>Is an electronic PDF signature legally valid?</h3>
    <p>Electronic signatures are legally valid in most countries including Bangladesh, USA, UK, and EU under respective e-signature laws.</p>
  </div>
  <div class="faq-item">
    <h3>Can I sign a PDF on my phone?</h3>
    <p>Yes! PDFTash works on mobile devices. You can draw your signature with your finger on any smartphone or tablet.</p>
  </div>
  <div class="faq-item">
    <h3>Is my signature secure?</h3>
    <p>Yes! Your signature and PDF are processed securely and automatically deleted after 2 hours. We never store your personal information.</p>
  </div>
</div>
@endsection