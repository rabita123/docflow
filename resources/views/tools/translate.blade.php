@extends('tools.layout')

@section('title', 'Translate PDF Online Free — PDF to Bengali, Hindi, Arabic')
@section('description', 'Translate PDF documents to Bengali, Hindi, Arabic, Spanish and 12+ languages online free. No signup needed. AI-powered translation.')
@section('keywords', 'translate pdf, pdf translator, translate pdf to bengali, pdf to hindi, translate pdf online free')
@section('slug', 'translate-pdf')

@section('content')
<div class="hero">
  <div class="badge">🌐 AI PDF Translator</div>
  <h1>Translate PDF to Any Language Free</h1>
  <p>Translate your PDF documents to Bengali, Hindi, Arabic, Spanish and 12+ languages using AI. Fast, accurate, and free.</p>
</div>

<div class="tool-box">
  <div class="upload-area" onclick="window.location.href='/#translate'">
    <div class="upload-icon">🌍</div>
    <div class="upload-title">Upload PDF to Translate</div>
    <div class="upload-sub">Supports 12+ languages including Bengali · AI-powered</div>
  </div>
  <div style="text-align:center">
    <a href="/#translate" class="btn">Translate PDF Free →</a>
  </div>
</div>

<div class="features">
  <div class="feature">
    <div class="feature-icon">🇧🇩</div>
    <div class="feature-title">Bengali Support</div>
    <div class="feature-desc">Translate PDF to Bengali accurately with AI</div>
  </div>
  <div class="feature">
    <div class="feature-icon">🌐</div>
    <div class="feature-title">12+ Languages</div>
    <div class="feature-desc">English, Bengali, Hindi, Arabic, Spanish and more</div>
  </div>
  <div class="feature">
    <div class="feature-icon">🤖</div>
    <div class="feature-title">AI Powered</div>
    <div class="feature-desc">Natural, accurate translation that preserves meaning</div>
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>How to translate a PDF to Bengali online for free?</h3>
    <p>Upload your PDF to PDFTash, select Bengali as the target language, and click "Translate". Our AI will translate your entire PDF accurately in seconds.</p>
  </div>
  <div class="faq-item">
    <h3>What languages are supported for PDF translation?</h3>
    <p>PDFTash supports 12+ languages including Bengali, Hindi, Arabic, Spanish, French, German, Chinese, Japanese, Portuguese, Russian, Italian, and English.</p>
  </div>
  <div class="faq-item">
    <h3>Is the PDF translation accurate?</h3>
    <p>Yes! PDFTash uses advanced AI to provide natural, accurate translations that preserve the meaning and context of your original document.</p>
  </div>
  <div class="faq-item">
    <h3>Can I translate a PDF from Bengali to English?</h3>
    <p>Yes! PDFTash can translate PDFs in both directions — Bengali to English and English to Bengali. Perfect for students and professionals in Bangladesh.</p>
  </div>
  <div class="faq-item">
    <h3>How much does PDF translation cost?</h3>
    <p>Free users get 1 PDF translation per day. Pro users ($9/mo) get unlimited translations to all 12+ languages.</p>
  </div>
</div>
@endsection