@extends('tools.layout')

@section('title', 'Combine PDF Pages Online Free — Arrange & Merge Pages')
@section('description', 'Combine specific pages from multiple PDFs into one document. Select which pages to include, rearrange them, and download instantly. Free, no signup.')
@section('keywords', 'combine pdf pages, merge pdf pages, combine specific pages from pdf, merge selected pdf pages, combine pages from multiple pdfs')
@section('slug', 'combine-pdf-pages')

@section('schema')
<script type="application/ld+json">
[
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "PDFTash — Combine PDF Pages Online",
  "applicationCategory": "WebApplication",
  "operatingSystem": "Any",
  "description": "Combine specific pages from multiple PDF documents into one file. Select page ranges, rearrange them, and download instantly. Free, no signup required.",
  "url": "https://pdftash.com/combine-pdf-pages",
  "offers": {"@type":"Offer","price":"0","priceCurrency":"USD"},
  "aggregateRating": {"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"1050"}
},
{
  "@context": "https://schema.org",
  "@type": "HowTo",
  "name": "How to Combine Specific Pages from Multiple PDFs",
  "description": "Extract the pages you need and merge them into one document using PDFTash.",
  "step": [
    {"@type":"HowToStep","position":1,"name":"Extract pages from each PDF","text":"Use the Split PDF or Extract Pages tool to pull out the specific pages you want from each source PDF."},
    {"@type":"HowToStep","position":2,"name":"Merge the extracted pages","text":"Upload all extracted page PDFs to the Merge PDF tool, arrange in the desired order, and click Merge."},
    {"@type":"HowToStep","position":3,"name":"Download the combined document","text":"Download your new PDF containing exactly the pages you selected, in the order you arranged them."}
  ]
},
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"How do I select specific pages from multiple PDFs to combine?","acceptedAnswer":{"@type":"Answer","text":"Use the Extract Pages from PDF tool to pull the exact pages you want from each source document. Then use Merge PDF to combine those extracted pages into one document."}},
    {"@type":"Question","name":"Can I reorder pages from different PDFs?","acceptedAnswer":{"@type":"Answer","text":"Yes. After extracting the pages you want from each source PDF, upload them all to the Merge PDF tool. Drag the files to set the order you want. The merge follows your arrangement exactly."}},
    {"@type":"Question","name":"Is there a limit on how many pages I can combine?","acceptedAnswer":{"@type":"Answer","text":"No. PDFTash has no page count limit. You can combine documents with hundreds of pages. The only limit is the per-file upload size: 10MB for free users, 200MB for Pro users."}},
    {"@type":"Question","name":"What is the difference between Combine PDF Pages and Merge PDF?","acceptedAnswer":{"@type":"Answer","text":"Merge PDF combines entire documents end-to-end. Combine PDF Pages is the workflow of first extracting specific pages from each source, then merging only those selected pages into a new document."}},
    {"@type":"Question","name":"Can I combine pages from more than two PDFs?","acceptedAnswer":{"@type":"Answer","text":"Yes. There is no limit on the number of source PDFs. Extract pages from as many documents as you need, then merge them all in one operation."}},
    {"@type":"Question","name":"Will the page quality be preserved when combining?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash does not re-encode any content during extraction or merging. Images, text, and graphics remain at full original quality."}}
  ]
}
]
</script>
@endsection

@section('content')
<div class="hero">
  <div class="badge">📋 Combine PDF Pages</div>
  <h1>Combine PDF Pages Online Free — Arrange &amp; Merge Pages</h1>
  <p>Select specific pages from multiple PDF documents, arrange them in any order, and combine them into a single PDF. Free, no signup, instant download.</p>
</div>

{{-- CTA CARD --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:24px;padding:40px;text-align:center;">
    <div style="font-size:48px;margin-bottom:16px;">📄</div>
    <h2 style="font-size:22px;font-weight:700;margin-bottom:12px;">Combine Pages from Multiple PDFs</h2>
    <p style="color:#8888a8;font-size:15px;line-height:1.7;margin-bottom:28px;">Use our Extract + Merge workflow to select exactly which pages you need from each PDF and combine them into one clean document.</p>
    <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
      <a href="/extract-pages-from-pdf" style="display:inline-block;padding:14px 28px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600;font-size:15px;">Step 1: Extract Pages →</a>
      <a href="/merge-pdf" style="display:inline-block;padding:14px 28px;background:#0f0f1a;border:1px solid rgba(255,255,255,.2);color:#eeeef8;border-radius:99px;text-decoration:none;font-weight:600;font-size:15px;">Step 2: Merge PDFs →</a>
    </div>
  </div>
</div>

{{-- THE WORKFLOW --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:12px;">How to Combine Specific PDF Pages</h2>
  <p style="text-align:center;color:#8888a8;font-size:14px;margin-bottom:28px;">A simple two-step workflow — extract then merge</p>
  <div style="display:flex;flex-direction:column;gap:16px;">
    @foreach([
      ['1','🔍','Extract Pages from Each PDF','Open each source PDF in our <a href="/extract-pages-from-pdf" style="color:#5b5cff">Extract Pages from PDF</a> tool. Enter the page numbers or ranges you want (e.g., 1-3, 5, 8-10). Download the extracted pages as a new PDF. Repeat for each source document.'],
      ['2','🔀','Merge the Extracted Pages','Upload all your extracted page PDFs to the <a href="/merge-pdf" style="color:#5b5cff">Merge PDF</a> tool. Drag the files to arrange them in the exact order you want in the final document.'],
      ['3','⬇️','Download Your Combined PDF','Click Merge and download your final PDF. It contains exactly the pages you selected, in the order you set — nothing more, nothing less.'],
    ] as $step)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:24px;display:flex;gap:20px;align-items:flex-start;">
      <div style="min-width:36px;height:36px;background:rgba(91,92,255,.2);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:800;color:#9898ff;flex-shrink:0;">{{ $step[0] }}</div>
      <div>
        <div style="font-size:20px;margin-bottom:8px;">{{ $step[1] }}</div>
        <div style="font-weight:600;font-size:15px;margin-bottom:6px;">{{ $step[2] }}</div>
        <div style="color:#8888a8;font-size:13px;line-height:1.6;">{!! $step[3] !!}</div>
      </div>
    </div>
    @endforeach
  </div>
</div>

{{-- USE CASES --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:12px;">When Do You Need to Combine Specific PDF Pages?</h2>
  <p style="text-align:center;color:#8888a8;font-size:14px;margin-bottom:28px;">Common real-world scenarios where page-level combining is essential</p>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
    @foreach([
      ['📑','Legal Documents','Pull signature pages and specific clauses from multiple contracts into one submission package.'],
      ['🎓','Academic Papers','Combine specific chapters or figures from different research papers for a literature review.'],
      ['📊','Financial Reports','Extract the summary and key tables from quarterly reports across multiple periods into one deck.'],
      ['🏥','Medical Records','Combine relevant pages from different hospital reports into a single document for a specialist.'],
      ['📋','Application Packages','Assemble required pages from various documents (certificates, transcripts, IDs) into one application PDF.'],
      ['🏢','Business Proposals','Extract relevant case studies and pricing pages from different decks to build a custom proposal.'],
    ] as $u)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:20px;">
      <div style="font-size:26px;margin-bottom:8px;">{{ $u[0] }}</div>
      <div style="font-weight:600;font-size:13px;color:#eeeef8;margin-bottom:5px;">{{ $u[1] }}</div>
      <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $u[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- PAGE RANGE SYNTAX --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:18px;padding:28px;">
    <h2 style="font-size:20px;font-weight:700;margin-bottom:20px;">📖 Page Range Syntax Guide</h2>
    <p style="color:#8888a8;font-size:13px;line-height:1.6;margin-bottom:20px;">When using the Extract Pages tool, enter page numbers using any of these formats:</p>
    <div style="display:flex;flex-direction:column;gap:10px;">
      @foreach([
        ['1, 3, 5','Individual pages separated by commas — extracts pages 1, 3, and 5'],
        ['1-5','A range — extracts pages 1 through 5 inclusive'],
        ['1-3, 7, 10-12','Mixed format — extracts pages 1 to 3, page 7, and pages 10 to 12'],
        ['2-','From page 2 to the end of the document'],
      ] as $syn)
      <div style="display:flex;gap:16px;align-items:flex-start;">
        <code style="background:rgba(91,92,255,.15);color:#9898ff;padding:4px 10px;border-radius:6px;font-size:13px;white-space:nowrap;flex-shrink:0;">{{ $syn[0] }}</code>
        <span style="color:#8888a8;font-size:13px;line-height:1.5;padding-top:2px;">{{ $syn[1] }}</span>
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- COMPARISON TABLE --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:22px;font-weight:700;text-align:center;margin-bottom:24px;">PDFTash vs Competitors for Combining Pages</h2>
  <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;font-size:13px;">
      <thead>
        <tr style="background:#0f0f1a;">
          <th style="padding:12px 16px;text-align:left;color:#8888a8;font-weight:600;border-bottom:1px solid rgba(255,255,255,.08);">Feature</th>
          <th style="padding:12px 16px;text-align:center;color:#9898ff;font-weight:700;border-bottom:1px solid rgba(255,255,255,.08);">PDFTash ✓</th>
          <th style="padding:12px 16px;text-align:center;color:#8888a8;font-weight:600;border-bottom:1px solid rgba(255,255,255,.08);">Smallpdf</th>
          <th style="padding:12px 16px;text-align:center;color:#8888a8;font-weight:600;border-bottom:1px solid rgba(255,255,255,.08);">iLovePDF</th>
        </tr>
      </thead>
      <tbody>
        @foreach([
          ['Extract Specific Pages','✅','✅','✅'],
          ['Merge Extracted Pages','✅','✅','✅'],
          ['No Signup Required','✅','✅','✅'],
          ['No Daily Limit','✅','❌ 2/hr free','❌ Rate limited'],
          ['No Watermark','✅','✅','✅'],
          ['Zero Quality Loss','✅','✅','✅'],
          ['AI Features (Chat, Translate)','✅','❌','❌'],
          ['Files Deleted After 2hr','✅','✅','✅'],
        ] as $row)
        <tr style="border-bottom:1px solid rgba(255,255,255,.05);">
          <td style="padding:11px 16px;color:#eeeef8;">{{ $row[0] }}</td>
          <td style="padding:11px 16px;text-align:center;color:#00e5a0;font-weight:600;">{{ $row[1] }}</td>
          <td style="padding:11px 16px;text-align:center;color:#8888a8;">{{ $row[2] }}</td>
          <td style="padding:11px 16px;text-align:center;color:#8888a8;">{{ $row[3] }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

{{-- RELATED TOOLS --}}
<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">Related PDF Tools</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([
      ['Merge PDF','/merge-pdf'],
      ['Split PDF','/split-pdf'],
      ['Extract Pages from PDF','/extract-pages-from-pdf'],
      ['Remove Pages from PDF','/remove-pages-from-pdf'],
      ['Merge PDF Files Online','/merge-pdf-files-online'],
      ['Compress PDF','/compress-pdf'],
      ['Chat with PDF','/chat-with-pdf'],
    ] as $t)
    <a href="{{ $t[1] }}" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;font-weight:500;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $t[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — Combine PDF Pages</h2>
  <div class="faq-item">
    <h3>How do I select specific pages from multiple PDFs to combine?</h3>
    <p>Use our <a href="/extract-pages-from-pdf" style="color:#5b5cff">Extract Pages from PDF</a> tool to pull the exact pages you want from each source document. Upload the PDF, enter the page numbers or ranges, and download the extracted pages. Repeat for each source PDF, then use <a href="/merge-pdf" style="color:#5b5cff">Merge PDF</a> to combine all extracted documents into one.</p>
  </div>
  <div class="faq-item">
    <h3>Can I combine pages from more than two PDF files?</h3>
    <p>Yes. There is no limit on the number of source PDFs. Extract the pages you want from as many documents as needed, then upload all the extracted files to the Merge PDF tool and combine them in one operation.</p>
  </div>
  <div class="faq-item">
    <h3>What is the difference between Combine PDF Pages and Merge PDF?</h3>
    <p>Merge PDF combines entire documents end-to-end. Combine PDF Pages refers to the workflow of first extracting specific pages from each source PDF, then merging only those selected pages into a new document. If you need all pages from all PDFs, just use Merge PDF directly.</p>
  </div>
  <div class="faq-item">
    <h3>Can I reorder pages from different PDFs before combining?</h3>
    <p>Yes. After extracting pages from each source PDF, upload all the extracted files to the Merge tool. Drag the file cards to arrange them in your desired order. The merged output will follow that sequence exactly.</p>
  </div>
  <div class="faq-item">
    <h3>Will the quality of combined pages be preserved?</h3>
    <p>Completely. PDFTash does not re-render or re-encode any content during extraction or merging. Images, text, fonts, and vector graphics remain at 100% original quality throughout the entire process.</p>
  </div>
  <div class="faq-item">
    <h3>Is there a page count limit for combining PDFs?</h3>
    <p>No. PDFTash has no page count limit. You can combine documents totalling hundreds or thousands of pages. The only limit is the per-file upload size: 10MB for free users, 200MB for Pro users.</p>
  </div>
</div>
@endsection
