<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Privacy Policy — PDFTash</title>
<meta name="description" content="PDFTash privacy policy. We don't store your files. PDFs are auto-deleted after 2 hours. Learn what we collect and how we protect your data.">
<meta name="robots" content="index, follow">
<meta property="og:type" content="website">
<meta property="og:title" content="Privacy Policy — PDFTash">
<meta property="og:description" content="PDFTash privacy policy. We don't store your files. PDFs are auto-deleted after 2 hours.">
<meta property="og:url" content="https://pdftash.com/privacy">
<meta property="og:site_name" content="PDFTash">
<meta property="og:image" content="https://pdftash.com/og-image.png">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Privacy Policy — PDFTash">
<meta name="twitter:description" content="PDFTash privacy policy. We don't store your files. PDFs are auto-deleted after 2 hours.">
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="alternate icon" href="/favicon.ico">
<link rel="canonical" href="https://pdftash.com/privacy">
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Privacy Policy",
  "url": "https://pdftash.com/privacy"
}
</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
  --bg: #0d0d14;
  --bg2: #13131f;
  --accent: #7c5cfc;
  --text: #e8e8f0;
  --text2: rgba(255,255,255,.55);
  --border: rgba(255,255,255,0.08);
  --r: 12px;
}
*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
html { scroll-behavior: smooth; }
body {
  font-family: 'Inter', sans-serif;
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
  line-height: 1.7;
}
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: var(--bg2); }
::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 99px; opacity: .5; }

/* NAV */
nav {
  position: sticky;
  top: 0;
  z-index: 100;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 14px 40px;
  background: rgba(13,13,20,0.94);
  backdrop-filter: blur(24px);
  border-bottom: 1px solid var(--border);
}
.nav-logo { display: flex; align-items: center; text-decoration: none; }
.nav-logo img { height: 34px; width: auto; display: block; }
.nav-logo span {
  font-size: 20px;
  font-weight: 700;
  color: var(--text);
  margin-left: 8px;
  letter-spacing: -.3px;
}
.nav-links { display: flex; gap: 28px; list-style: none; }
.nav-links a {
  color: var(--text2);
  font-size: 14px;
  font-weight: 500;
  text-decoration: none;
  transition: color .2s;
}
.nav-links a:hover { color: var(--text); }
.nav-cta {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 8px 20px;
  background: var(--accent);
  color: #fff;
  font-size: 14px;
  font-weight: 600;
  text-decoration: none;
  border-radius: 8px;
  transition: opacity .2s;
}
.nav-cta:hover { opacity: .88; }
.hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; background: none; border: none; padding: 4px; }
.hamburger span { display: block; width: 22px; height: 2px; background: var(--text2); border-radius: 2px; transition: .2s; }

/* HERO */
.hero {
  text-align: center;
  padding: 80px 24px 60px;
  background: linear-gradient(160deg, var(--bg) 0%, var(--bg2) 100%);
  border-bottom: 1px solid var(--border);
}
.hero-badge {
  display: inline-block;
  padding: 4px 14px;
  background: rgba(124,92,252,.15);
  border: 1px solid rgba(124,92,252,.3);
  border-radius: 99px;
  font-size: 12px;
  font-weight: 600;
  color: var(--accent);
  letter-spacing: .5px;
  text-transform: uppercase;
  margin-bottom: 20px;
}
.hero h1 {
  font-size: clamp(2rem, 5vw, 3rem);
  font-weight: 800;
  letter-spacing: -.5px;
  margin-bottom: 12px;
  color: var(--text);
}
.hero-meta {
  font-size: 14px;
  color: var(--text2);
}
.hero-meta strong { color: rgba(255,255,255,.75); }

/* CONTENT */
.content-wrap {
  max-width: 780px;
  margin: 0 auto;
  padding: 60px 24px 80px;
}
.section {
  margin-bottom: 52px;
}
.section h2 {
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--text);
  margin-bottom: 14px;
  padding-bottom: 10px;
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  gap: 10px;
}
.section h2 .icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 32px;
  height: 32px;
  background: rgba(124,92,252,.15);
  border-radius: 8px;
  font-size: 16px;
  flex-shrink: 0;
}
.section p {
  color: var(--text2);
  font-size: 15px;
  line-height: 1.75;
  margin-bottom: 12px;
}
.section p:last-child { margin-bottom: 0; }
.section ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.section ul li {
  color: var(--text2);
  font-size: 15px;
  padding-left: 20px;
  position: relative;
}
.section ul li::before {
  content: '→';
  position: absolute;
  left: 0;
  color: var(--accent);
  font-size: 13px;
}
.highlight-box {
  background: var(--bg2);
  border: 1px solid var(--border);
  border-left: 3px solid var(--accent);
  border-radius: var(--r);
  padding: 18px 22px;
  margin-top: 14px;
}
.highlight-box p {
  margin: 0;
  font-size: 14px;
}
a.email-link {
  color: var(--accent);
  text-decoration: none;
  font-weight: 500;
}
a.email-link:hover { text-decoration: underline; }

/* FOOTER */
footer {
  background: var(--bg2);
  border-top: 1px solid var(--border);
  padding: 40px 24px 28px;
  text-align: center;
}
.footer-links {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 6px 20px;
  margin-bottom: 18px;
  list-style: none;
}
.footer-links a {
  color: var(--text2);
  font-size: 13px;
  text-decoration: none;
  transition: color .2s;
}
.footer-links a:hover { color: var(--text); }
.footer-links li:not(:last-child)::after {
  content: '·';
  margin-left: 20px;
  color: var(--border);
  pointer-events: none;
}
.footer-copy {
  font-size: 12px;
  color: rgba(255,255,255,.3);
}

/* RESPONSIVE */
@media (max-width: 768px) {
  nav { padding: 12px 20px; }
  .nav-links, .nav-cta { display: none; }
  .hamburger { display: flex; }
  nav.open .nav-links {
    display: flex;
    flex-direction: column;
    position: absolute;
    top: 100%;
    left: 0; right: 0;
    background: var(--bg2);
    border-bottom: 1px solid var(--border);
    padding: 16px 20px 20px;
    gap: 16px;
  }
  nav.open .nav-cta { display: inline-flex; width: fit-content; }
  .hero { padding: 60px 20px 44px; }
}
</style>
</head>
<body>

<nav id="main-nav">
  <a href="/" class="nav-logo">
    <img src="/logo.svg" alt="PDFTash logo">
    <span>PDFTash</span>
  </a>
  <ul class="nav-links">
    <li><a href="/">Home</a></li>
    <li><a href="/#tools">Tools</a></li>
    <li><a href="/blog">Blog</a></li>
    <li><a href="/pricing">Pricing</a></li>
  </ul>
  <a href="/" class="nav-cta">Try Free →</a>
  <button class="hamburger" aria-label="Toggle menu" onclick="document.getElementById('main-nav').classList.toggle('open')">
    <span></span><span></span><span></span>
  </button>
</nav>

<section class="hero">
  <div class="hero-badge">Legal</div>
  <h1>Privacy Policy</h1>
  <p class="hero-meta">Last updated: <strong>June 2026</strong> &nbsp;·&nbsp; pdftash.com</p>
</section>

<div class="content-wrap">

  <div class="section">
    <h2><span class="icon">🔒</span> We Don't Store Your Files</h2>
    <p>PDFTash is built on a simple principle: your documents are yours. PDFs you upload are processed entirely in memory and automatically deleted from our servers within <strong style="color:var(--text)">2 hours</strong> of upload — no exceptions.</p>
    <p>We never sell, share, analyze, or retain your uploaded documents. No human at PDFTash ever reads your files.</p>
    <div class="highlight-box">
      <p>Files are processed securely, stored temporarily in isolated server storage, and permanently deleted within 2 hours. We do not use your files for any purpose beyond the tool you requested.</p>
    </div>
  </div>

  <div class="section">
    <h2><span class="icon">📊</span> What We Collect</h2>
    <p>We collect only what is necessary to operate the service:</p>
    <ul>
      <li><strong style="color:var(--text)">Anonymous usage statistics</strong> — page views and tool usage counts via Google Analytics. No personally identifiable information is linked to these stats.</li>
      <li><strong style="color:var(--text)">Account email</strong> — only if you choose to create an account. Optional and used solely for account management.</li>
      <li><strong style="color:var(--text)">Payment information</strong> — handled entirely by Lemon Squeezy, our payment processor. We never see, store, or have access to your card numbers or financial details.</li>
    </ul>
  </div>

  <div class="section">
    <h2><span class="icon">🍪</span> Cookies</h2>
    <p>We use Google Analytics cookies to understand aggregate site usage — which tools are popular, how many visitors we have, and similar statistics.</p>
    <ul>
      <li>No tracking cookies beyond Google Analytics</li>
      <li>No ad retargeting or advertising cookies</li>
      <li>No third-party marketing pixels</li>
    </ul>
    <p style="margin-top:12px;">You can opt out of Google Analytics tracking by using the <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener" class="email-link">Google Analytics Opt-out Browser Add-on</a>.</p>
  </div>

  <div class="section">
    <h2><span class="icon">🛡️</span> File Security</h2>
    <ul>
      <li>All file uploads are transmitted over HTTPS / TLS encryption</li>
      <li>Files are stored temporarily in isolated server storage — separate from other users' files</li>
      <li>Automatic deletion within 2 hours of upload, regardless of processing status</li>
      <li>No human review of uploaded file contents</li>
      <li>Access to file storage is restricted to automated processing systems only</li>
    </ul>
  </div>

  <div class="section">
    <h2><span class="icon">🤖</span> AI Processing</h2>
    <p>PDFTash offers AI-powered tools including Summarize, Translate, and Chat with PDF. When you use these features, the extracted text content of your PDF is sent to <strong style="color:var(--text)">our AI API</strong> for processing.</p>
    <ul>
      <li>Our AI provider's privacy policy applies to text processed through their API</li>
      <li>Your PDF text is <strong style="color:var(--text)">not used to train AI models</strong></li>
      <li>Text is sent only for the specific task you requested and is not retained beyond standard data handling practices</li>
    </ul>
    <div class="highlight-box">
      <p>If your documents contain sensitive information, we recommend using non-AI tools for those files, for those files.</p>
    </div>
  </div>

  <div class="section">
    <h2><span class="icon">⚖️</span> Your Rights</h2>
    <p>You have full control over your data:</p>
    <ul>
      <li><strong style="color:var(--text)">Access</strong> — request a copy of any personal data we hold about you</li>
      <li><strong style="color:var(--text)">Delete</strong> — request deletion of your account and all associated data</li>
      <li><strong style="color:var(--text)">Export</strong> — export your account data at any time from your account settings</li>
    </ul>
    <p style="margin-top:12px;">To exercise any of these rights, email us at <a href="mailto:privacy@pdftash.com" class="email-link">privacy@pdftash.com</a>. We respond within 7 business days.</p>
  </div>

  <div class="section">
    <h2><span class="icon">✉️</span> Contact</h2>
    <p>For any privacy-related questions, concerns, or requests, contact us at:</p>
    <div class="highlight-box">
      <p><a href="mailto:privacy@pdftash.com" class="email-link">privacy@pdftash.com</a></p>
    </div>
  </div>

</div>

<footer>
  <ul class="footer-links">
    <li><a href="/">Home</a></li>
    <li><a href="/#tools">Tools</a></li>
    <li><a href="/blog">Blog</a></li>
    <li><a href="/pricing">Pricing</a></li>
    <li><a href="/about">About</a></li>
    <li><a href="/privacy" style="color:var(--text)">Privacy</a></li>
    <li><a href="/terms">Terms</a></li>
    <li><a href="/refund">Refund Policy</a></li>
  </ul>
  <p class="footer-copy">&copy; 2025–2026 PDFTash. All rights reserved.</p>
</footer>

</body>
</html>
