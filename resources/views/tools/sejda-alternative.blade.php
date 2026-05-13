@extends('tools.layout')

@section('title', 'Best Free Sejda Alternative — PDFTash')
@section('description', 'Looking for a free Sejda alternative? PDFTash offers 20+ PDF tools with AI — compress, merge, split, chat and translate. No signup needed. Completely free.')
@section('keywords', 'sejda alternative, sejda alternative free, free sejda alternative, sejda pdf alternative, best sejda alternative 2026')
@section('slug', 'sejda-alternative')

@section('content')

<!-- Hero -->
<div class="hero">
  <div class="badge">🏆 #1 Free Sejda Alternative</div>
  <h1>The Best Free<br><span style="color:#5b5cff;">Sejda Alternative</span></h1>
  <p>Everything Sejda offers — plus AI features. No daily limits on basic tools. No signup needed. Completely free.</p>
  <a href="/" class="btn" style="margin-top:0">Try PDFTash Free →</a>
</div>

<!-- Comparison Table -->
<div style="max-width:800px;margin:0 auto 80px;padding:0 20px;">
  <h2 style="font-size:28px;font-weight:700;margin-bottom:32px;text-align:center;">PDFTash vs Sejda</h2>

  <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:20px;overflow:hidden;">
    <!-- Header -->
    <div style="display:grid;grid-template-columns:2fr 1fr 1fr;background:#0a0a15;padding:16px 24px;border-bottom:1px solid rgba(255,255,255,.08);">
      <div style="font-size:13px;color:#8888a8;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Feature</div>
      <div style="font-size:14px;font-weight:700;color:#5b5cff;text-align:center;">PDFTash</div>
      <div style="font-size:14px;font-weight:600;color:#8888a8;text-align:center;">Sejda</div>
    </div>

    <!-- Rows -->
    @php
    $rows = [
        ['Free to use', '✅ Always free', '⚠️ Limited'],
        ['No signup needed', '✅ Yes', '✅ Yes'],
        ['Compress PDF', '✅ Free', '✅ 3/day free'],
        ['Merge PDF', '✅ Free', '✅ 3/day free'],
        ['Split PDF', '✅ Free', '✅ 3/day free'],
        ['AI Chat with PDF', '✅ Free', '❌ No'],
        ['AI Translate PDF', '✅ 12+ languages', '❌ No'],
        ['AI Summarize PDF', '✅ Free', '❌ No'],
        ['Bengali Support', '✅ Yes', '❌ No'],
        ['File size (free)', '✅ 10MB', '⚠️ 50MB but 3/day'],
        ['Pro price', '✅ $9/mo', '⚠️ $7.50/mo'],
        ['Unlimited Pro', '✅ Yes', '⚠️ Limited'],
    ];
    @endphp

    @foreach($rows as $i => $row)
    <div style="display:grid;grid-template-columns:2fr 1fr 1fr;padding:14px 24px;border-bottom:1px solid rgba(255,255,255,.05);{{ $i % 2 === 0 ? 'background:rgba(255,255,255,.02)' : '' }}">
      <div style="font-size:14px;color:#ccc;">{{ $row[0] }}</div>
      <div style="font-size:14px;text-align:center;color:{{ str_contains($row[1], '✅') ? '#00e5a0' : '#8888a8' }}">{{ $row[1] }}</div>
      <div style="font-size:14px;text-align:center;color:{{ str_contains($row[2], '✅') ? '#00e5a0' : (str_contains($row[2], '❌') ? '#ff6b6b' : '#ffcc44') }}">{{ $row[2] }}</div>
    </div>
    @endforeach

    <!-- CTA row -->
    <div style="display:grid;grid-template-columns:2fr 1fr 1fr;padding:20px 24px;background:#0a0a15;">
      <div></div>
      <div style="text-align:center;">
        <a href="/" style="display:inline-block;padding:10px 20px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600;font-size:13px;">Try Free →</a>
      </div>
      <div style="text-align:center;">
        <span style="color:#8888a8;font-size:13px;">sejda.com</span>
      </div>
    </div>
  </div>
</div>

<!-- Why PDFTash is better -->
<div style="max-width:700px;margin:0 auto 80px;padding:0 20px;">
  <h2 style="font-size:28px;font-weight:700;margin-bottom:32px;text-align:center;">Why PDFTash is the Best Sejda Alternative</h2>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:24px;">
      <div style="font-size:32px;margin-bottom:12px;">🤖</div>
      <div style="font-weight:600;margin-bottom:8px;">AI Features</div>
      <div style="color:#8888a8;font-size:13px;line-height:1.6;">Chat with PDF, AI translation and summarization. Sejda doesn't have these features.</div>
    </div>
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:24px;">
      <div style="font-size:32px;margin-bottom:12px;">🆓</div>
      <div style="font-weight:600;margin-bottom:8px;">Truly Free</div>
      <div style="color:#8888a8;font-size:13px;line-height:1.6;">No annoying "3 tasks per day" limit on basic tools. Use compress, merge and split freely.</div>
    </div>
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:24px;">
      <div style="font-size:32px;margin-bottom:12px;">🌐</div>
      <div style="font-weight:600;margin-bottom:8px;">12+ Languages</div>
      <div style="color:#8888a8;font-size:13px;line-height:1.6;">Translate PDF to Bengali, Hindi, Arabic, Spanish and 12+ languages. Unique feature.</div>
    </div>
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:24px;">
      <div style="font-size:32px;margin-bottom:12px;">⚡</div>
      <div style="font-weight:600;margin-bottom:8px;">Faster & Modern</div>
      <div style="color:#8888a8;font-size:13px;line-height:1.6;">Built with modern technology. Fast processing, clean UI, mobile friendly.</div>
    </div>
  </div>
</div>

<!-- All tools -->
<div style="max-width:700px;margin:0 auto 80px;padding:0 20px;">
  <h2 style="font-size:28px;font-weight:700;margin-bottom:32px;text-align:center;">All Free PDF Tools</h2>
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
    @php
    $tools = [
        ['🗜️', 'Compress PDF', '/compress-pdf'],
        ['📎', 'Merge PDF', '/merge-pdf'],
        ['✂️', 'Split PDF', '/split-pdf'],
        ['💬', 'Chat with PDF', '/chat-with-pdf'],
        ['🌐', 'Translate PDF', '/translate-pdf'],
        ['✍️', 'Sign PDF', '/sign-pdf'],
        ['🔒', 'Protect PDF', '/'],
        ['🔓', 'Unlock PDF', '/'],
        ['🖼️', 'PDF to Image', '/'],
    ];
    @endphp
    @foreach($tools as $tool)
    <a href="{{ $tool[2] }}" style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:16px;text-align:center;text-decoration:none;color:#fff;transition:all .2s;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.08)'">
      <div style="font-size:24px;margin-bottom:8px;">{{ $tool[0] }}</div>
      <div style="font-size:13px;font-weight:500;">{{ $tool[1] }}</div>
    </a>
    @endforeach
  </div>
</div>

<!-- FAQ -->
<div class="faq">
  <h2>Frequently Asked Questions</h2>

  <div class="faq-item">
    <h3>Is PDFTash really a free Sejda alternative?</h3>
    <p>Yes! PDFTash offers all the core PDF tools that Sejda provides — completely free. Plus AI features like Chat with PDF and PDF translation that Sejda doesn't have.</p>
  </div>

  <div class="faq-item">
    <h3>Why is PDFTash better than Sejda?</h3>
    <p>PDFTash has AI features (chat, translate, summarize) that Sejda doesn't offer. Our free plan also has fewer restrictions. And we support 12+ languages including Bengali.</p>
  </div>

  <div class="faq-item">
    <h3>Does PDFTash have a daily limit like Sejda?</h3>
    <p>Basic tools like compress, merge and split have generous free limits. AI features have a daily limit on the free plan. Pro users ($9/mo) get unlimited access to everything.</p>
  </div>

  <div class="faq-item">
    <h3>Is PDFTash safe to use?</h3>
    <p>Yes! All uploaded files are processed securely and automatically deleted after 2 hours. We never store or share your documents.</p>
  </div>

  <div class="faq-item">
    <h3>What other Sejda alternatives are there?</h3>
    <p>Other alternatives include Smallpdf, ILovePDF, and PDF24. But PDFTash is the only one with AI chat, AI translation to Bengali, and truly unlimited basic tools.</p>
  </div>
</div>

@endsection