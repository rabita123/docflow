@extends('tools.layout')

@section('title', 'Merge PDFs for Email — Combine & Send Under 25MB Free')
@section('description', 'Merge multiple PDF files and compress the result for email attachment. Under 25MB guaranteed. Free, no signup. Works for Gmail, Outlook, Yahoo Mail.')
@section('keywords', 'merge pdf for email, combine pdf for email, merge pdf email attachment, join pdf files email, merge and compress pdf')
@section('slug', 'merge-pdf-for-email')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash — Merge PDFs for Email",
  "applicationCategory": "WebApplication",
  "operatingSystem": "Any",
  "description": "Merge multiple PDFs and compress the result for email attachment. Under 25MB guaranteed. Free, no signup required.",
  "url": "https://pdftash.com/merge-pdf-for-email",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"},
  "aggregateRating": {"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"970"}
},
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Merge PDFs for Email in 2 Steps",
  "description": "Combine your PDFs then compress for email — free, no signup.",
  "step": [
    {"@type":"HowToStep","position":1,"name":"Merge your PDFs","text":"Go to the Merge PDF tool, upload all your files, drag to reorder, and download the combined PDF."},
    {"@type":"HowToStep","position":2,"name":"Compress for email","text":"Upload the merged PDF to the Compress PDF tool. PDFTash will reduce it to well under 25MB for email attachment."}
  ]
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"What is Gmail's file attachment size limit?","acceptedAnswer":{"@type":"Answer","text":"Gmail allows attachments up to 25MB. If your merged PDF exceeds this, compress it first using PDFTash to get it under the limit."}},
    {"@type":"Question","name":"What is Outlook's attachment limit?","acceptedAnswer":{"@type":"Answer","text":"Microsoft Outlook (Office 365) has a 20MB attachment limit per message. Some corporate Outlook servers are configured even lower, at 10MB. Always compress before sending."}},
    {"@type":"Question","name":"How do I merge multiple PDFs and keep the size small?","acceptedAnswer":{"@type":"Answer","text":"Use the two-step workflow: first merge all your PDFs into one using the PDFTash Merge tool, then compress the result using the Compress PDF tool. This combination produces the smallest possible output."}},
    {"@type":"Question","name":"Can I merge and compress in one step?","acceptedAnswer":{"@type":"Answer","text":"PDFTash's workflow is merge first, then compress. This gives you the best quality-to-size ratio. Running compression on the final merged document is more efficient than compressing individual files first."}},
    {"@type":"Question","name":"What if my merged PDF is still over 25MB after compression?","acceptedAnswer":{"@type":"Answer","text":"Run the compressed file through the Compress PDF tool a second time. Each pass reduces the size further. You can also split off any pages you don't need to send using the Split PDF tool."}},
    {"@type":"Question","name":"Does Yahoo Mail have the same attachment size limit?","acceptedAnswer":{"@type":"Answer","text":"Yahoo Mail allows attachments up to 25MB per email, the same as Gmail. For larger files, both services suggest using cloud links instead — but with PDFTash compression, most merged PDFs will fit comfortably."}}
  ]
}
]
</script>
@endsection

@section('content')
<div class="hero">
  <div class="badge">📧 Merge PDFs for Email</div>
  <h1>Merge PDFs for Email — Under 25MB Guaranteed</h1>
  <p>Combine all your PDF files into one attachment-ready document. Two easy steps: merge, then compress. Works for Gmail, Outlook, Yahoo Mail — free, no signup.</p>
</div>

{{-- CTA CARD --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:24px;padding:40px;text-align:center;">
    <div style="font-size:48px;margin-bottom:16px;">📎</div>
    <h2 style="font-size:22px;font-weight:700;margin-bottom:12px;">Ready to Merge Your PDFs?</h2>
    <p style="color:#8888a8;font-size:15px;line-height:1.7;margin-bottom:28px;">Start with the Merge tool — upload all your files, set the order, download. Then compress the result for email if needed.</p>
    <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
      <a href="/merge-pdf" style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600;font-size:15px;">Step 1: Merge PDFs →</a>
      <a href="/compress-pdf" style="display:inline-block;padding:14px 32px;background:#0f0f1a;border:1px solid rgba(255,255,255,.2);color:#eeeef8;border-radius:99px;text-decoration:none;font-weight:600;font-size:15px;">Step 2: Compress for Email →</a>
    </div>
  </div>
</div>

{{-- EMAIL SIZE LIMITS TABLE --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:8px;">Email Attachment Size Limits by Provider</h2>
  <p style="text-align:center;color:#8888a8;font-size:14px;margin-bottom:24px;">Know the limit for your email provider before sending</p>
  <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;font-size:13px;">
      <thead>
        <tr style="background:#0f0f1a;">
          <th style="padding:12px 16px;text-align:left;color:#8888a8;font-weight:600;border-bottom:1px solid rgba(255,255,255,.08);">Email Provider</th>
          <th style="padding:12px 16px;text-align:center;color:#8888a8;font-weight:600;border-bottom:1px solid rgba(255,255,255,.08);">Attachment Limit</th>
          <th style="padding:12px 16px;text-align:center;color:#8888a8;font-weight:600;border-bottom:1px solid rgba(255,255,255,.08);">Recommended Target</th>
        </tr>
      </thead>
      <tbody>
        @foreach([
          ['📬 Gmail','25 MB','Under 20 MB'],
          ['📨 Outlook / Office 365','20 MB','Under 15 MB'],
          ['📩 Yahoo Mail','25 MB','Under 20 MB'],
          ['🏢 Corporate Outlook','10–20 MB (varies)','Under 10 MB'],
          ['📮 ProtonMail','25 MB','Under 20 MB'],
          ['📪 Apple Mail / iCloud','20 MB','Under 15 MB'],
        ] as $row)
        <tr style="border-bottom:1px solid rgba(255,255,255,.05);">
          <td style="padding:11px 16px;color:#eeeef8;">{{ $row[0] }}</td>
          <td style="padding:11px 16px;text-align:center;color:#ff6b6b;font-weight:600;">{{ $row[1] }}</td>
          <td style="padding:11px 16px;text-align:center;color:#00e5a0;font-weight:600;">{{ $row[2] }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

{{-- THE WORKFLOW --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:12px;">The Two-Step Workflow for Email-Ready PDFs</h2>
  <p style="text-align:center;color:#8888a8;font-size:14px;margin-bottom:28px;">Merge first, compress second — this order produces the best result</p>
  <div style="display:flex;flex-direction:column;gap:16px;">
    @foreach([
      ['1','📎','Merge All Your PDFs','Go to the Merge PDF tool and upload all the files you want to send. Drag to set the order. Click Merge and download your combined PDF.','Merge PDF →','/merge-pdf'],
      ['2','🗜️','Compress the Merged PDF','Upload the combined PDF to Compress PDF. PDFTash will shrink it to the smallest possible size while keeping text sharp and images clear.','Compress PDF →','/compress-pdf'],
      ['3','📧','Attach and Send','Your compressed PDF is ready to attach. Under 25MB, no watermark, clean and professional.','',''],
    ] as $step)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:24px;display:flex;gap:20px;align-items:flex-start;">
      <div style="min-width:36px;height:36px;background:rgba(91,92,255,.2);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:800;color:#9898ff;flex-shrink:0;">{{ $step[0] }}</div>
      <div style="flex:1;">
        <div style="font-size:20px;margin-bottom:8px;">{{ $step[1] }}</div>
        <div style="font-weight:600;font-size:15px;margin-bottom:6px;">{{ $step[2] }}</div>
        <div style="color:#8888a8;font-size:13px;line-height:1.6;margin-bottom:{{ $step[4] ? '12px' : '0' }}">{{ $step[3] }}</div>
        @if($step[4])
        <a href="{{ $step[5] }}" style="display:inline-block;padding:8px 20px;background:rgba(91,92,255,.15);border:1px solid rgba(91,92,255,.3);color:#9898ff;border-radius:99px;text-decoration:none;font-size:13px;font-weight:600;">{{ $step[4] }}</a>
        @endif
      </div>
    </div>
    @endforeach
  </div>
</div>

{{-- FEATURES --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">Why This Approach Works Best</h2>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['📉','Smaller Final Size','Compressing the merged output is more efficient than compressing files individually — the compressor can optimise shared resources across the whole document.'],
      ['🔢','One Attachment','Sending one merged PDF is cleaner than sending multiple files. Recipients get everything in order, in one click.'],
      ['📱','Works on All Devices','The merged and compressed PDF opens perfectly on any device — phone, tablet, desktop — without any special software.'],
      ['🔒','No Data Stored','Both tools delete your files after 2 hours. Nothing is stored, shared, or readable by us.'],
      ['✅','No Watermark Ever','Your email attachment will be completely clean — no PDFTash branding added at any step.'],
      ['⚡','Ready in Under 60s','The full merge + compress workflow takes under a minute for most documents. Faster than any alternative.'],
    ] as $f)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:20px;">
      <div style="font-size:26px;margin-bottom:8px;">{{ $f[0] }}</div>
      <div style="font-weight:600;font-size:13px;color:#eeeef8;margin-bottom:5px;">{{ $f[1] }}</div>
      <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $f[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- RELATED TOOLS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">Related PDF Tools</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([
      ['Merge PDF','/merge-pdf'],
      ['Compress PDF','/compress-pdf'],
      ['Compress for Email','/compress-pdf-for-email'],
      ['Merge PDF Files Online','/merge-pdf-files-online'],
      ['Merge Large PDFs','/merge-large-pdf-files'],
      ['Compress to 1MB','/compress-pdf-to-1mb'],
      ['Split PDF','/split-pdf'],
    ] as $t)
    <a href="{{ $t[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — Merge PDFs for Email</h2>
  <div class="faq-item">
    <h3>What is Gmail's attachment size limit?</h3>
    <p>Gmail allows attachments up to 25MB per email. However, if you want a safe margin (since some receiving servers have lower limits), aim for under 20MB. Use our <a href="/compress-pdf-for-email" style="color:#5b5cff">Compress PDF for Email</a> tool after merging to hit that target automatically.</p>
  </div>
  <div class="faq-item">
    <h3>What is Outlook's attachment size limit?</h3>
    <p>Microsoft Outlook and Office 365 allow up to 20MB per email. Corporate Outlook servers are often set lower — commonly 10MB. If you are sending to a business address, compress your merged PDF to under 10MB to be safe.</p>
  </div>
  <div class="faq-item">
    <h3>Should I compress before or after merging?</h3>
    <p>Compress after merging. When you compress the final merged document, the PDF compressor can optimize shared fonts, images, and resources across all pages at once. This produces a smaller file than compressing individual PDFs first.</p>
  </div>
  <div class="faq-item">
    <h3>Can I merge and compress in one single step?</h3>
    <p>PDFTash's tools are modular — merge with the <a href="/merge-pdf" style="color:#5b5cff">Merge PDF</a> tool, then compress with the <a href="/compress-pdf" style="color:#5b5cff">Compress PDF</a> tool. Both are free, both require no signup, and the whole workflow takes under 60 seconds.</p>
  </div>
  <div class="faq-item">
    <h3>What if the merged PDF is still too large for email after compression?</h3>
    <p>Run the compressed PDF through the compressor a second time for a further size reduction. You can also use our <a href="/split-pdf" style="color:#5b5cff">Split PDF</a> tool to remove any pages that don't need to be included in the email.</p>
  </div>
  <div class="faq-item">
    <h3>Does Yahoo Mail have the same 25MB limit as Gmail?</h3>
    <p>Yes. Yahoo Mail also allows attachments up to 25MB. ProtonMail matches this at 25MB. Apple Mail via iCloud is set at 20MB. For any provider, aiming for under 20MB ensures your email will deliver successfully regardless of any receiving server restrictions.</p>
  </div>
</div>
@endsection
