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
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">✍️</div>
    <div class="upload-title">Drop your PDF here to Sign</div>
    <div class="upload-sub">Draw, type or upload your signature · Free</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>

  <div id="options" style="display:none;margin-top:16px;">
    <div style="margin-bottom:12px;">
      <label style="color:#eeeef8;font-size:14px;font-weight:600;display:block;margin-bottom:6px;">Signature type</label>
      <select id="sign-type" onchange="toggleSignType(this.value)" style="width:100%;padding:10px 14px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:10px;color:#eeeef8;font-size:14px;">
        <option value="text">Type signature</option>
        <option value="image">Upload signature image</option>
      </select>
    </div>
    <div id="text-group" style="margin-bottom:12px;">
      <label style="color:#eeeef8;font-size:14px;font-weight:600;display:block;margin-bottom:6px;">Your name / signature text</label>
      <input type="text" id="sign-text" placeholder="e.g. John Smith" style="width:100%;padding:10px 14px;background:#16162a;border:1px solid rgba(255,255,255,.15);border-radius:10px;color:#eeeef8;font-size:14px;box-sizing:border-box;">
    </div>
    <div id="image-group" style="display:none;margin-bottom:12px;">
      <label style="color:#eeeef8;font-size:14px;font-weight:600;display:block;margin-bottom:6px;">Signature image (PNG)</label>
      <input type="file" id="sign-img" accept="image/*" style="color:#eeeef8;font-size:14px;">
    </div>
    <div style="text-align:center;">
      <button type="button" onclick="processSign()" style="padding:14px 32px;background:#5b5cff;color:#fff;border:none;border-radius:99px;font-size:15px;font-weight:600;cursor:pointer;">Sign PDF →</button>
    </div>
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;">
    <p style="color:#8888a8;font-size:12px;">Your files are automatically deleted after 2 hours</p>
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

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
let selectedFile = null;

const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.style.borderColor = '#5b5cff'; });
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = 'rgba(255,255,255,.15)'; });
dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    const f = e.dataTransfer.files[0];
    if (f && f.type === 'application/pdf') showOptions(f);
});

function handleFile(input) {
    if (input.files[0]) showOptions(input.files[0]);
}

function showOptions(file) {
    selectedFile = file;
    dropZone.querySelector('.upload-title').textContent = '✅ ' + file.name;
    document.getElementById('options').style.display = 'block';
}

function toggleSignType(val) {
    document.getElementById('text-group').style.display = val === 'text' ? 'block' : 'none';
    document.getElementById('image-group').style.display = val === 'image' ? 'block' : 'none';
}

async function processSign() {
    if (!selectedFile) return;
    const result = document.getElementById('result');
    result.style.display = 'block';
    result.innerHTML = '<div style="color:#8888a8;padding:20px">⏳ Applying signature...</div>';

    const formData = new FormData();
    formData.append('file', selectedFile);
    formData.append('_token', CSRF);

    const signType = document.getElementById('sign-type').value;
    formData.append('sign_type', signType);

    if (signType === 'text') {
        formData.append('sign_text', document.getElementById('sign-text').value || 'Signature');
    } else {
        const imgFile = document.getElementById('sign-img').files[0];
        if (!imgFile) { result.innerHTML = '<div style="color:#ff6b6b">Please upload a signature image.</div>'; return; }
        formData.append('sign_file', imgFile);
    }

    formData.append('placement', 'last');
    formData.append('x', 10);
    formData.append('y', 85);
    formData.append('width', 150);
    formData.append('height', 50);

    try {
        const resp = await fetch('/api/pdf/sign', { method: 'POST', body: formData });
        if (resp.ok) {
            const blob = await resp.blob();
            const url = URL.createObjectURL(blob);
            result.innerHTML = `
                <div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;">
                    <div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:8px">Signed Successfully!</div>
                </div>
                <a href="${url}" download="signed.pdf" style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">Download Signed PDF</a>
                <br><br>
                <button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">Sign Another</button>`;
        } else {
            const data = await resp.json();
            if (data.error === 'free_limit_reached') {
                result.innerHTML = `
                    <div style="background:#1a0a0a;border:1px solid #ff6b6b;border-radius:12px;padding:20px;">
                        <div style="color:#ff6b6b;font-weight:700;margin-bottom:8px">Daily limit reached!</div>
                        <div style="color:#8888a8;font-size:14px;margin-bottom:16px">Upgrade to Pro for unlimited access</div>
                        <a href="/#pricing" style="display:inline-block;padding:12px 24px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">Upgrade to Pro →</a>
                    </div>`;
            } else {
                result.innerHTML = `<div style="color:#ff6b6b">Error: ${data.error || 'Something went wrong'}</div>`;
            }
        }
    } catch(e) {
        result.innerHTML = `<div style="color:#ff6b6b">Connection error. Please try again.</div>`;
    }
}
</script>
@endsection
