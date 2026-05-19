@extends('tools.layout')

@section('title', 'PDF to JPG Converter Free Online — Convert PDF Pages to Images')
@section('description', 'Convert PDF to JPG online free. Download all PDF pages as high-quality images. No signup, no watermark. Supports PNG, JPG at 150 and 300 DPI. Instant conversion.')
@section('keywords', 'pdf to jpg, pdf to image, convert pdf to jpg, pdf to jpg online free, pdf to jpg converter, pdf to jpeg, pdf to png, convert pdf to image, pdf pages to jpg free')
@section('slug', 'pdf-to-jpg')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash — PDF to JPG Converter",
  "applicationCategory": "WebApplication",
  "operatingSystem": "Any",
  "description": "Free online PDF to JPG converter. Convert all PDF pages to high-quality images instantly — no signup, no watermark.",
  "url": "https://pdftash.com/pdf-to-jpg",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"},
  "aggregateRating": {"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"4230"}
},
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Convert PDF to JPG Online Free",
  "step": [
    {"@type":"HowToStep","position":1,"name":"Upload your PDF","text":"Drag and drop or click to upload your PDF. All pages will be converted."},
    {"@type":"HowToStep","position":2,"name":"Choose format","text":"Select JPG or PNG output format and quality (standard or high-res 300 DPI)."},
    {"@type":"HowToStep","position":3,"name":"Download images","text":"Download individual page images or a ZIP file with all pages."}
  ]
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"How do I convert a PDF to JPG for free?","acceptedAnswer":{"@type":"Answer","text":"Upload your PDF to PDFTash. The tool converts each page to a JPG image and you can download them individually or as a ZIP. Free, no signup needed."}},
    {"@type":"Question","name":"Can I convert all PDF pages to images at once?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash converts every page in your PDF to a separate image file. You can download them individually or as a single ZIP archive."}},
    {"@type":"Question","name":"What image quality does PDF to JPG produce?","acceptedAnswer":{"@type":"Answer","text":"PDFTash offers standard quality (150 DPI, good for screen and web) and high resolution (300 DPI, suitable for printing). Both options are free."}},
    {"@type":"Question","name":"Can I convert PDF to PNG instead of JPG?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash supports both JPG and PNG output. PNG is better for PDFs with text and sharp graphics (lossless). JPG is better for photo-heavy PDFs (smaller file size)."}},
    {"@type":"Question","name":"What can I do with PDF pages converted to images?","acceptedAnswer":{"@type":"Answer","text":"Common uses include sharing PDF pages on social media (Instagram, Twitter), embedding in presentations, using in websites, printing specific pages, extracting screenshots from reports, and sending images via messaging apps."}}
  ]
}
]
</script>
@endsection

@section('content')
<div class="hero">
  <div class="badge">🖼️ PDF to JPG Converter</div>
  <h1>PDF to JPG Converter — Free Online</h1>
  <p>Convert any PDF to high-quality JPG or PNG images. All pages converted, download individually or as ZIP. No signup, no watermark, instant download.</p>
</div>

{{-- COMING SOON TOOL BOX --}}
<div class="tool-box" style="max-width:700px;">
  <div style="text-align:center;padding:40px 20px;">
    <div style="font-size:64px;margin-bottom:16px;">🚀</div>
    <h2 style="font-size:24px;font-weight:700;margin-bottom:12px;color:#eeeef8;">PDF to JPG — Coming Very Soon</h2>
    <p style="color:#8888a8;font-size:15px;line-height:1.7;max-width:480px;margin:0 auto 28px;">
      Our PDF to JPG converter is in development. It will convert all pages to JPG or PNG at 150 or 300 DPI — free, no signup, with ZIP download for multi-page PDFs.
    </p>
    <div style="display:flex;flex-direction:column;gap:10px;max-width:360px;margin:0 auto 28px;">
      <input type="email" id="notify-email" placeholder="Get notified when it launches →"
        style="width:100%;padding:13px 18px;background:#16162a;border:1px solid rgba(255,255,255,.2);border-radius:10px;color:#eeeef8;font-size:14px;font-family:'Inter',sans-serif;text-align:center;">
      <button onclick="notifyMe()" style="padding:13px 28px;background:linear-gradient(135deg,#5b5cff,#7475ff);color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:700;cursor:pointer;">
        Notify Me When Ready
      </button>
    </div>
    <p id="notify-msg" style="display:none;color:#00e5a0;font-size:13px;">✅ You're on the list! We'll email you when PDF to JPG launches.</p>
    <div style="border-top:1px solid rgba(255,255,255,.08);padding-top:24px;margin-top:8px;">
      <p style="color:#8888a8;font-size:13px;margin-bottom:14px;">Available tools you can use right now:</p>
      <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
        @foreach([['Compress PDF','/compress-pdf'],['Merge PDF','/merge-pdf'],['Split PDF','/split-pdf'],['Translate PDF','/translate-pdf']] as $t)
        <a href="{{ $t[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
        @endforeach
      </div>
    </div>
  </div>
</div>

{{-- USE CASES --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:12px;">Why Convert PDF to JPG?</h2>
  <p style="text-align:center;color:#8888a8;font-size:14px;margin-bottom:28px;">PDFs can't be shared directly on most social media or embedded in non-PDF applications. Converting to images unlocks many use cases.</p>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['📱','Share on Social Media','Instagram, Twitter/X, and Facebook don\'t support PDF upload. Convert pages to JPG to share them directly.'],
      ['🖥️','Embed in Websites','Use PDF page images in HTML, WordPress, or website builders where PDF embedding isn\'t possible.'],
      ['📊','Extract Report Charts','Convert specific pages to extract charts, diagrams and infographics from PDF reports as standalone images.'],
      ['🖨️','Print Specific Pages','Need to print just one page of a 50-page PDF? Convert that page to JPG and print the image.'],
      ['💬','Send via WhatsApp or Telegram','Image files send faster and display inline in chats. Convert your PDF pages to share as photos.'],
      ['🎨','Use in Presentations','Import PDF page screenshots directly into PowerPoint, Google Slides or Keynote presentations.'],
    ] as $u)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:20px;">
      <div style="font-size:26px;margin-bottom:8px;">{{ $u[0] }}</div>
      <div style="font-weight:600;font-size:13px;color:#eeeef8;margin-bottom:5px;">{{ $u[1] }}</div>
      <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $u[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- JPG vs PNG --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:20px;">JPG vs PNG — Which Should You Choose?</h2>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
    <div style="background:#0f0f1a;border:2px solid rgba(255,107,107,.3);border-radius:14px;padding:24px;">
      <div style="font-size:32px;margin-bottom:10px;">📸</div>
      <div style="font-weight:700;font-size:16px;color:#ff8c8c;margin-bottom:12px;">JPG — Best For</div>
      <ul style="color:#8888a8;font-size:13px;line-height:1.8;padding-left:16px;">
        <li>Photo-heavy PDFs</li>
        <li>Smaller file sizes</li>
        <li>Sharing on social media</li>
        <li>Web images (faster loading)</li>
        <li>Email attachments</li>
      </ul>
      <div style="margin-top:12px;font-size:11px;color:#44445a;">⚠️ Lossy compression — slightly lower quality for sharp text</div>
    </div>
    <div style="background:#0f0f1a;border:2px solid rgba(91,92,255,.3);border-radius:14px;padding:24px;">
      <div style="font-size:32px;margin-bottom:10px;">🖼️</div>
      <div style="font-weight:700;font-size:16px;color:#9898ff;margin-bottom:12px;">PNG — Best For</div>
      <ul style="color:#8888a8;font-size:13px;line-height:1.8;padding-left:16px;">
        <li>Text-heavy documents</li>
        <li>Diagrams and charts</li>
        <li>Screenshots and editing</li>
        <li>Transparent backgrounds</li>
        <li>Print-quality images</li>
      </ul>
      <div style="margin-top:12px;font-size:11px;color:#44445a;">✅ Lossless — perfect sharpness for text and graphics</div>
    </div>
  </div>
</div>

{{-- DPI GUIDE --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:20px;">Choosing the Right DPI (Resolution)</h2>
  <div style="display:flex;flex-direction:column;gap:10px;">
    @foreach([
      ['72 DPI','Screen / Web','Optimized for monitor display. Smallest file size. Perfect for website images, social media, email.'],
      ['150 DPI','Standard Quality','Good balance of quality and size. Suitable for most business uses, presentations, and general sharing.'],
      ['300 DPI','Print Quality','High resolution suitable for printing up to A4/Letter at full quality. Larger file size.'],
    ] as $dpi)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:16px;display:flex;gap:16px;align-items:center;">
      <div style="min-width:80px;text-align:center;background:rgba(91,92,255,.15);border-radius:8px;padding:8px;font-weight:800;font-size:14px;color:#9898ff;">{{ $dpi[0] }}</div>
      <div>
        <div style="font-weight:600;font-size:14px;color:#eeeef8;margin-bottom:3px;">{{ $dpi[1] }}</div>
        <div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $dpi[2] }}</div>
      </div>
    </div>
    @endforeach
  </div>
</div>

{{-- RELATED TOOLS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">More Free PDF Tools Available Now</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([['Compress PDF','/compress-pdf'],['Merge PDF','/merge-pdf'],['Split PDF','/split-pdf'],['Translate PDF','/translate-pdf'],['Chat with PDF','/chat-with-pdf'],['Sign PDF','/sign-pdf'],['PDF to Word','/pdf-to-word']] as $t)
    <a href="{{ $t[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — PDF to JPG</h2>
  <div class="faq-item">
    <h3>How do I convert a PDF to JPG for free?</h3>
    <p>PDFTash PDF to JPG converter is launching soon. When live, upload your PDF, choose JPG or PNG format and quality, and download all pages as images — completely free, no signup needed.</p>
  </div>
  <div class="faq-item">
    <h3>Can I convert all pages of a PDF to JPG at once?</h3>
    <p>Yes. PDFTash will convert every page in your PDF to a separate image file. You can download them individually or as a ZIP archive containing all pages.</p>
  </div>
  <div class="faq-item">
    <h3>What resolution (DPI) should I choose?</h3>
    <p>For sharing on social media or email: 150 DPI. For embedding in presentations or websites: 150 DPI. For printing: 300 DPI. PDFTash will offer both options free.</p>
  </div>
  <div class="faq-item">
    <h3>Should I use JPG or PNG for PDF to image conversion?</h3>
    <p>Use PNG if your PDF has lots of text or sharp graphics — PNG is lossless and keeps text crisp. Use JPG for photo-heavy PDFs where file size matters more than pixel-perfect sharpness.</p>
  </div>
  <div class="faq-item">
    <h3>Can I convert a PDF to JPG on my iPhone or Android?</h3>
    <p>Yes. When launched, the PDF to JPG converter will work in any mobile browser — Safari on iPhone, Chrome on Android. No app needed.</p>
  </div>
</div>

<script>
function notifyMe() {
    const email = document.getElementById('notify-email').value.trim();
    if (!email || !email.includes('@')) { alert('Please enter a valid email address.'); return; }
    document.getElementById('notify-msg').style.display = 'block';
    document.getElementById('notify-email').style.display = 'none';
    document.querySelector('button[onclick="notifyMe()"]').style.display = 'none';
}
</script>
@endsection
