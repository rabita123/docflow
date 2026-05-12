<div class="tool-box">
  <div style="text-align:center;margin-bottom:20px;">
    <p style="color:#8888a8;font-size:14px;">Upload your PDF below to compress it instantly</p>
  </div>

  <!-- Embed actual compress tool -->
  <div id="compress-tool">
    <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
      <div class="upload-icon">🗜️</div>
      <div class="upload-title">Drop your PDF here to Compress</div>
      <div class="upload-sub">Click to browse · Max 10MB free · No signup needed</div>
      <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
    </div>
    <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  </div>

  <div style="text-align:center;margin-top:20px;">
    <p style="color:#8888a8;font-size:12px;">🔒 Your files are automatically deleted after 2 hours</p>
  </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

// Drag and drop
const dropZone = document.getElementById('drop-zone');
dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.style.borderColor = '#5b5cff';
});
dropZone.addEventListener('dragleave', () => {
    dropZone.style.borderColor = 'rgba(255,255,255,.15)';
});
dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    const file = e.dataTransfer.files[0];
    if (file && file.type === 'application/pdf') {
        processFile(file);
    }
});

function handleFile(input) {
    const file = input.files[0];
    if (file) processFile(file);
}

async function processFile(file) {
    const result = document.getElementById('result');
    result.style.display = 'block';
    result.innerHTML = '<div style="color:#8888a8">⏳ Compressing your PDF...</div>';

    const formData = new FormData();
    formData.append('pdf', file);
    formData.append('_token', CSRF);

    try {
        const resp = await fetch('/api/pdf/compress', {
            method: 'POST',
            body: formData
        });

        if (resp.ok) {
            const blob = await resp.blob();
            const url = URL.createObjectURL(blob);
            const originalSize = (file.size / 1024).toFixed(0);
            const newSize = (blob.size / 1024).toFixed(0);
            const savings = (((file.size - blob.size) / file.size) * 100).toFixed(0);

            result.innerHTML = `
                <div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;margin-bottom:16px;">
                    <div style="color:#00e5a0;font-size:18px;font-weight:700;margin-bottom:8px">✅ Compressed Successfully!</div>
                    <div style="color:#8888a8;font-size:14px">
                        ${originalSize}KB → ${newSize}KB 
                        <span style="color:#00e5a0;font-weight:600">(${savings}% smaller)</span>
                    </div>
                </div>
                <a href="${url}" download="compressed.pdf" 
                   style="display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600;font-size:16px">
                   ⬇️ Download Compressed PDF
                </a>
                <br><br>
                <button onclick="location.reload()" 
                   style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">
                   Compress Another PDF
                </button>
            `;
        } else {
            const data = await resp.json();
            if (data.error === 'free_limit_reached') {
                result.innerHTML = `
                    <div style="background:#1a0a0a;border:1px solid #ff6b6b;border-radius:12px;padding:20px;">
                        <div style="color:#ff6b6b;font-weight:700;margin-bottom:8px">Daily limit reached!</div>
                        <div style="color:#8888a8;font-size:14px;margin-bottom:16px">Upgrade to Pro for unlimited access</div>
                        <a href="/#pricing" style="display:inline-block;padding:12px 24px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:600">
                            Upgrade to Pro →
                        </a>
                    </div>
                `;
            } else {
                result.innerHTML = `<div style="color:#ff6b6b">❌ Error: ${data.error || 'Something went wrong'}</div>`;
            }
        }
    } catch(e) {
        result.innerHTML = `<div style="color:#ff6b6b">❌ Connection error. Please try again.</div>`;
    }
}
</script>