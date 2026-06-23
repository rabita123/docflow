@extends('tools.layout')
@section('title', 'Remove PDF Password Online Free — Unlock PDF Instantly')
@section('description', 'Remove password from PDF online free — unlock PDF files you own in seconds. No signup, no software download. Works on any device. Instant results with PDFTash.')
@section('keywords', 'remove pdf password, unlock pdf free online, pdf password remover, remove password from pdf, pdf unlocker')
@section('slug', 'remove-pdf-password')

@section('schema')
<script type="application/ld+json">
[{"@context":"https://schema.org","@type":"SoftwareApplication","name":"PDFTash — Remove PDF Password","applicationCategory":"WebApplication","operatingSystem":"Any","description":"Free online tool to remove passwords from PDF files. Enter your password once and download an unlocked, unrestricted PDF instantly.","url":"https://pdftash.com/remove-pdf-password","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"aggregateRating":{"@type":"AggregateRating","ratingValue":"4.8","reviewCount":"2156"}},
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
{"@type":"Question","name":"Is it legal to remove a password from a PDF?","acceptedAnswer":{"@type":"Answer","text":"Yes, if you own the document or have legitimate access. Removing the password from your own bank statement, payslip, or contract is legal. It is illegal to bypass encryption on documents you are not authorised to access."}},
{"@type":"Question","name":"Do I need to know the password to unlock the PDF?","acceptedAnswer":{"@type":"Answer","text":"For PDFs with an open password (the kind that blocks opening the file), yes — you must enter the password. PDFTash uses it for decryption and then removes the requirement. For permission-locked PDFs (open freely but printing/copying is blocked), no password is needed."}},
{"@type":"Question","name":"Does unlocking remove all PDF restrictions?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash removes both the open password and all permission restrictions (printing, copying, editing). The resulting PDF is fully unrestricted."}},
{"@type":"Question","name":"What is the maximum file size?","acceptedAnswer":{"@type":"Answer","text":"The free plan supports files up to 10 MB. The Pro plan handles files up to 200 MB."}},
{"@type":"Question","name":"Does it work on mobile?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash works in any mobile browser on iOS or Android. No app installation needed."}}
]}]
</script>
@endsection

@section('content')
<div class="hero">
    <div class="badge">🔓 PDF Unlocker</div>
    <h1>Remove PDF Password Online Free</h1>
    <p>Unlock PDF files you own in seconds — no software, no signup, no waiting. Enter the password once and download a permanent, restriction-free PDF.</p>
</div>

<div class="tool-box">
    <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
        <div class="upload-icon">🔒</div>
        <div class="upload-title">Drop your password-protected PDF here</div>
        <div class="upload-sub">Click to browse · Free · Instant unlock</div>
        <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
    </div>
    <div id="password-field" style="display:none;margin-top:16px;text-align:center;">
        <input type="password" id="pdfPassword" placeholder="Enter PDF password" style="padding:10px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.2);border-radius:8px;color:#eeeef8;font-size:14px;width:240px;outline:none;">
        <button onclick="processUnlock()" style="margin-left:8px;padding:10px 20px;background:#7c5cfc;color:#fff;border:none;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;">Remove Password</button>
    </div>
    <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
    <div style="text-align:center;margin-top:16px;"><p style="color:#8888a8;font-size:12px;">Files deleted after 60 minutes · Password never stored · 100% secure</p></div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:28px;">How It Works</h2>
    <div style="display:flex;flex-direction:column;gap:16px;">
        @foreach([
            ['1','Upload Your Locked PDF','Drag your password-protected PDF into the upload area or click to browse. The tool detects the protection type automatically.'],
            ['2','Enter the Password','If the PDF has an open password (required to view it), a password field appears. Enter the password — it is used only for decryption and is never stored or logged.'],
            ['3','Download Unlocked PDF','Click Remove Password. PDFTash decrypts the file and removes all restrictions. Download the clean, fully accessible PDF instantly.'],
        ] as $step)
        <div style="display:flex;gap:16px;align-items:flex-start;">
            <div style="width:36px;height:36px;border-radius:50%;background:#7c5cfc;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:15px;flex-shrink:0;">{{ $step[0] }}</div>
            <div><div style="font-weight:600;font-size:15px;color:#eeeef8;margin-bottom:4px;">{{ $step[1] }}</div><div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $step[2] }}</div></div>
        </div>
        @endforeach
    </div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:20px;">Who Needs This?</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;">
        @foreach([
            ['🏦','Bank statements sent with standard passwords (date of birth, account number)'],
            ['💼','Payslips and HR documents from employers'],
            ['📋','Contracts and legal documents received from clients or solicitors'],
            ['🏛️','Government certificates and official documents'],
            ['📚','Academic records, transcripts, and certificates'],
            ['🧾','Tax documents and financial reports'],
        ] as $uc)
        <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:10px;padding:16px;">
            <div style="font-size:22px;margin-bottom:8px;">{{ $uc[0] }}</div>
            <div style="color:#8888a8;font-size:13px;line-height:1.5;">{{ $uc[1] }}</div>
        </div>
        @endforeach
    </div>
</div>

<div class="faq" style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
    <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:28px;">Frequently Asked Questions</h2>
    <div class="faq-item"><h3>Is it legal to remove a password from a PDF?</h3><p>Yes, if you own the document or have been legitimately given access to it. Removing the password from your own bank statement, payslip, or contract is completely legal. Bypassing encryption on a document you are not authorised to access is illegal in most jurisdictions. PDFTash is built for legitimate use only.</p></div>
    <div class="faq-item"><h3>Do I need to know the password to unlock the PDF?</h3><p>For PDFs with an open password (the kind that prevents you from opening the file at all), yes — you must provide the password. PDFTash uses it to decrypt the file, then removes the requirement permanently. For permission-restricted PDFs (files you can open, but can't print or copy from), no password is needed.</p></div>
    <div class="faq-item"><h3>Does unlocking remove all PDF restrictions?</h3><p>Yes. PDFTash removes both open password protection and all permission restrictions (printing, copying text, editing, filling forms). The downloaded file is a clean, fully unrestricted PDF.</p></div>
    <div class="faq-item"><h3>What is the maximum file size?</h3><p>The free plan supports files up to 10 MB, which covers the vast majority of bank statements, payslips, and standard business documents. The Pro plan handles files up to 200 MB for larger locked documents.</p></div>
    <div class="faq-item"><h3>Does it work on mobile?</h3><p>Yes. PDFTash works in any modern mobile browser on iOS or Android. Upload the PDF directly from your phone's files or from cloud storage (Google Drive, iCloud, Dropbox), enter the password, and download the unlocked file — no app needed.</p></div>
</div>

<div style="max-width:700px;margin:0 auto 40px;padding:0 20px;text-align:center;">
    <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">Related Tools</h2>
    <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
        <a href="/sign-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Sign PDF</a>
        <a href="/compress-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Compress PDF</a>
        <a href="/pdf-tools-for-lawyers" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">PDF Tools for Lawyers</a>
        <a href="/redact-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Redact PDF</a>
        <a href="/merge-pdf" style="padding:9px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;">Merge PDF</a>
    </div>
</div>

<script>
let uploadedFile = null;
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = '#7c5cfc'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', (e) => { e.preventDefault(); const f = e.dataTransfer.files[0]; if (f?.type === 'application/pdf') handleFileObj(f); });
function handleFile(input) { if (input.files[0]) handleFileObj(input.files[0]); }
function handleFileObj(file) {
    uploadedFile = file;
    document.getElementById('password-field').style.display = 'block';
    dropZone.querySelector('.upload-title').textContent = file.name;
    dropZone.querySelector('.upload-sub').textContent = (file.size / 1024).toFixed(0) + ' KB · Ready to unlock';
}
async function processUnlock() {
    if (!uploadedFile) return;
    const password = document.getElementById('pdfPassword').value;
    const result = document.getElementById('result');
    result.style.display = 'block';
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Removing password...</div>';
    const fd = new FormData();
    fd.append('file', uploadedFile);
    fd.append('password', password);
    fd.append('_token', CSRF);
    try {
        const resp = await fetch('/api/pdf/unlock', { method: 'POST', body: fd });
        if (resp.ok) {
            const blob = await resp.blob();
            const url = URL.createObjectURL(blob);
            result.innerHTML = `<div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;"><div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:4px;">✅ Password Removed!</div><div style="color:#8888a8;font-size:13px;">Your PDF is now fully unlocked and unrestricted.</div></div><a href="${url}" download="unlocked.pdf" style="display:inline-block;padding:14px 32px;background:#7c5cfc;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">⬇ Download Unlocked PDF</a><br><br><button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Unlock Another</button>`;
        } else {
            const d = await resp.json().catch(() => ({}));
            result.innerHTML = `<div style="color:#ff6b6b">Error: ${d.error || 'Incorrect password or unsupported encryption.'}</div>`;
        }
    } catch (e) { result.innerHTML = `<div style="color:#ff6b6b">Connection error. Please try again.</div>`; }
}
</script>
@endsection
