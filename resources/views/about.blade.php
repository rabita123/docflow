<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About PDFTash — Free PDF Tools with AI</title>
<meta name="description" content="PDFTash is a free online PDF toolkit with 20+ tools and AI features. No watermarks, no signup required. Built in 2025.">
<meta name="robots" content="index, follow">
<meta property="og:type" content="website">
<meta property="og:title" content="About PDFTash — Free PDF Tools with AI">
<meta property="og:description" content="PDFTash is a free online PDF toolkit with 20+ tools and AI features. No watermarks, no signup required.">
<meta property="og:url" content="https://pdftash.com/about">
<meta property="og:site_name" content="PDFTash">
<meta property="og:image" content="https://pdftash.com/og-image.png">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="About PDFTash — Free PDF Tools with AI">
<meta name="twitter:description" content="PDFTash is a free online PDF toolkit with 20+ tools and AI features. No watermarks, no signup required.">
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="alternate icon" href="/favicon.ico">
<link rel="canonical" href="https://pdftash.com/about">
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "AboutPage",
  "name": "About PDFTash",
  "url": "https://pdftash.com/about"
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
::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 99px; }

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
.hamburger span { display: block; width: 22px; height: 2px; background: var(--text2); border-radius: 2px; }

/* HERO */
.hero {
  text-align: center;
  padding: 90px 24px 70px;
  background: linear-gradient(160deg, var(--bg) 0%, var(--bg2) 60%, var(--bg) 100%);
  border-bottom: 1px solid var(--border);
  position: relative;
  overflow: hidden;
}
.hero::before {
  content: '';
  position: absolute;
  top: -120px; left: 50%;
  transform: translateX(-50%);
  width: 600px; height: 600px;
  background: radial-gradient(circle, rgba(124,92,252,.12) 0%, transparent 70%);
  pointer-events: none;
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
  margin-bottom: 24px;
}
.hero h1 {
  font-size: clamp(1.9rem, 5vw, 3.2rem);
  font-weight: 800;
  letter-spacing: -.6px;
  max-width: 720px;
  margin: 0 auto 18px;
  color: var(--text);
  line-height: 1.2;
}
.hero p {
  font-size: 1.05rem;
  color: var(--text2);
  max-width: 560px;
  margin: 0 auto;
  line-height: 1.7;
}

/* SECTIONS */
.wrap {
  max-width: 1060px;
  margin: 0 auto;
  padding: 0 24px;
}
.section {
  padding: 72px 0;
  border-bottom: 1px solid var(--border);
}
.section:last-child { border-bottom: none; }
.section-label {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: var(--accent);
  margin-bottom: 12px;
}
.section-title {
  font-size: clamp(1.5rem, 3vw, 2rem);
  font-weight: 800;
  color: var(--text);
  letter-spacing: -.4px;
  margin-bottom: 22px;
  line-height: 1.25;
}
.section-body {
  color: var(--text2);
  font-size: 15.5px;
  line-height: 1.8;
  max-width: 680px;
}
.section-body p + p { margin-top: 16px; }

/* STORY layout */
.story-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 56px;
  align-items: start;
}

/* DIFF CARDS */
.diff-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
  margin-top: 36px;
}
.diff-card {
  background: var(--bg2);
  border: 1px solid var(--border);
  border-radius: var(--r);
  padding: 24px 20px;
  transition: border-color .2s, transform .2s;
}
.diff-card:hover {
  border-color: rgba(124,92,252,.4);
  transform: translateY(-2px);
}
.diff-card .icon {
  font-size: 28px;
  margin-bottom: 14px;
  display: block;
}
.diff-card h3 {
  font-size: 15px;
  font-weight: 700;
  color: var(--text);
  margin-bottom: 8px;
}
.diff-card p {
  font-size: 13.5px;
  color: var(--text2);
  line-height: 1.6;
}

/* TOOLS LIST */
.tools-intro {
  display: flex;
  align-items: baseline;
  gap: 16px;
  margin-bottom: 28px;
  flex-wrap: wrap;
}
.tools-count {
  font-size: 3rem;
  font-weight: 800;
  color: var(--accent);
  line-height: 1;
}
.tools-subtitle {
  font-size: 1.1rem;
  color: var(--text2);
}
.tools-cols {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 8px 24px;
}
.tool-item {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 8px 0;
  font-size: 14px;
  color: var(--text2);
  border-bottom: 1px solid var(--border);
}
.tool-item::before {
  content: '';
  width: 6px; height: 6px;
  background: var(--accent);
  border-radius: 50%;
  flex-shrink: 0;
  opacity: .7;
}

/* STATS */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
  margin-top: 36px;
}
.stat-card {
  background: var(--bg2);
  border: 1px solid var(--border);
  border-radius: var(--r);
  padding: 28px 20px;
  text-align: center;
}
.stat-number {
  font-size: 2.4rem;
  font-weight: 800;
  color: var(--accent);
  display: block;
  line-height: 1;
  margin-bottom: 8px;
}
.stat-label {
  font-size: 13px;
  color: var(--text2);
  font-weight: 500;
}

/* TECH */
.tech-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 24px;
}
.tech-pill {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 6px 14px;
  background: var(--bg2);
  border: 1px solid var(--border);
  border-radius: 99px;
  font-size: 13px;
  color: var(--text2);
  font-weight: 500;
}
.tech-pill strong { color: var(--text); }

/* CTA */
.cta-section {
  text-align: center;
  padding: 80px 24px;
  background: linear-gradient(135deg, rgba(124,92,252,.08) 0%, transparent 60%);
  border-top: 1px solid var(--border);
}
.cta-section h2 {
  font-size: clamp(1.6rem, 3vw, 2.2rem);
  font-weight: 800;
  letter-spacing: -.4px;
  margin-bottom: 14px;
}
.cta-section p {
  color: var(--text2);
  font-size: 15px;
  margin-bottom: 32px;
}
.btn-cta {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 14px 34px;
  background: var(--accent);
  color: #fff;
  font-size: 16px;
  font-weight: 700;
  text-decoration: none;
  border-radius: 10px;
  transition: opacity .2s, transform .2s;
  letter-spacing: -.2px;
}
.btn-cta:hover { opacity: .88; transform: translateY(-1px); }

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
.footer-copy { font-size: 12px; color: rgba(255,255,255,.3); }

/* RESPONSIVE */
@media (max-width: 900px) {
  .diff-grid { grid-template-columns: 1fr 1fr; }
  .tools-cols { grid-template-columns: 1fr 1fr; }
  .stats-grid { grid-template-columns: 1fr 1fr; }
  .story-grid { grid-template-columns: 1fr; gap: 0; }
}
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
  .hero { padding: 60px 20px 48px; }
  .diff-grid { grid-template-columns: 1fr; }
  .tools-cols { grid-template-columns: 1fr 1fr; }
  .stats-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 480px) {
  .tools-cols { grid-template-columns: 1fr; }
  .stats-grid { grid-template-columns: 1fr 1fr; }
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

<!-- HERO -->
<section class="hero">
  <div class="hero-badge">About Us</div>
  <h1>Built for people who work with PDFs every day</h1>
  <p>Professional PDF tools should be free, fast, and private. No watermarks. No daily limits. No nonsense.</p>
</section>

<!-- OUR STORY -->
<div class="wrap">
  <section class="section">
    <div class="story-grid">
      <div>
        <div class="section-label">Our Story</div>
        <h2 class="section-title">Started out of frustration</h2>
      </div>
      <div class="section-body">
        <p>PDFTash was built in 2025 because we were tired of PDF tools that slap watermarks on your work, force you to create an account just to compress a file, or cut you off after two uses a day. We believed there had to be a better way — and we built it.</p>
        <p>What started as a simple tool for compressing and merging PDFs grew into a full-featured platform with 20+ tools and AI features from Anthropic. You can now summarize, translate, and even have a conversation with your PDF — all for free, right in your browser. No signup. No watermark. No catch.</p>
      </div>
    </div>
  </section>

  <!-- WHAT MAKES US DIFFERENT -->
  <section class="section">
    <div class="section-label">Why PDFTash</div>
    <h2 class="section-title">What makes us different</h2>
    <div class="diff-grid">
      <div class="diff-card">
        <span class="icon">🚫</span>
        <h3>No Watermarks</h3>
        <p>Every tool — free or pro — produces clean output. Your files come back exactly as they should: yours.</p>
      </div>
      <div class="diff-card">
        <span class="icon">⚡</span>
        <h3>No Signup Required</h3>
        <p>Upload, process, download. No account needed. We don't gate the tools behind registration walls.</p>
      </div>
      <div class="diff-card">
        <span class="icon">🤖</span>
        <h3>AI-Powered</h3>
        <p>Summarize, translate, and chat with your PDFs using advanced AI — the most capable AI assistant available.</p>
      </div>
      <div class="diff-card">
        <span class="icon">🌏</span>
        <h3>Built for South Asia</h3>
        <p>First-class Bengali (Bangla) translation support, designed with South Asian users in mind from day one.</p>
      </div>
    </div>
  </section>

  <!-- OUR TOOLS -->
  <section class="section">
    <div class="section-label">Our Tools</div>
    <div class="tools-intro">
      <span class="tools-count">20+</span>
      <span class="tools-subtitle">free PDF tools in one place</span>
    </div>
    <div class="tools-cols">
      <div class="tool-item">Compress PDF</div>
      <div class="tool-item">Merge PDF</div>
      <div class="tool-item">Split PDF</div>
      <div class="tool-item">Rotate PDF</div>
      <div class="tool-item">PDF to Images</div>
      <div class="tool-item">Images to PDF</div>
      <div class="tool-item">PDF to Word</div>
      <div class="tool-item">Word to PDF</div>
      <div class="tool-item">Translate PDF</div>
      <div class="tool-item">Summarize PDF</div>
      <div class="tool-item">Chat with PDF</div>
      <div class="tool-item">Sign PDF</div>
      <div class="tool-item">Extract Text</div>
      <div class="tool-item">Extract Data</div>
      <div class="tool-item">Watermark PDF</div>
      <div class="tool-item">Crop PDF</div>
      <div class="tool-item">Protect PDF</div>
      <div class="tool-item">Unlock PDF</div>
      <div class="tool-item">PDF Info</div>
      <div class="tool-item">Reorder Pages</div>
    </div>
  </section>

  <!-- NUMBERS -->
  <section class="section">
    <div class="section-label">By the Numbers</div>
    <h2 class="section-title">Built to be genuinely free</h2>
    <div class="stats-grid">
      <div class="stat-card">
        <span class="stat-number">20+</span>
        <span class="stat-label">Free PDF Tools</span>
      </div>
      <div class="stat-card">
        <span class="stat-number">12+</span>
        <span class="stat-label">Supported Languages</span>
      </div>
      <div class="stat-card">
        <span class="stat-number">0</span>
        <span class="stat-label">Watermarks Added</span>
      </div>
      <div class="stat-card">
        <span class="stat-number">0</span>
        <span class="stat-label">Signups Required</span>
      </div>
    </div>
  </section>

  <!-- TECH STACK -->
  <section class="section">
    <div class="section-label">Under the Hood</div>
    <h2 class="section-title">Built with great tools</h2>
    <div class="section-body">
      <p>PDFTash is built on a modern, reliable stack chosen for performance and accuracy. Laravel powers the backend, while Ghostscript and Poppler handle the heavy lifting for PDF compression, conversion, and rendering. AI features are delivered through our AI API.</p>
    </div>
    <div class="tech-pills">
      <span class="tech-pill"><strong>Laravel</strong> — Backend framework</span>
      <span class="tech-pill"><strong>Ghostscript</strong> — PDF compression &amp; rendering</span>
      <span class="tech-pill"><strong>Poppler</strong> — PDF parsing &amp; conversion</span>
      <span class="tech-pill"><strong>AI Assistant</strong> — Summarize, translate, chat</span>
      <span class="tech-pill"><strong>Lemon Squeezy</strong> — Payments</span>
      <span class="tech-pill"><strong>HTTPS / TLS</strong> — Secure transfers</span>
    </div>
  </section>
</div>

<!-- CTA -->
<section class="cta-section">
  <h2>Ready to get started?</h2>
  <p>No account needed. No watermarks. Just fast, free PDF tools.</p>
  <a href="/" class="btn-cta">Try PDFTash Free →</a>
</section>

<footer>
  <ul class="footer-links">
    <li><a href="/">Home</a></li>
    <li><a href="/#tools">Tools</a></li>
    <li><a href="/blog">Blog</a></li>
    <li><a href="/pricing">Pricing</a></li>
    <li><a href="/about" style="color:var(--text)">About</a></li>
    <li><a href="/privacy">Privacy</a></li>
    <li><a href="/terms">Terms</a></li>
    <li><a href="/refund">Refund Policy</a></li>
  </ul>
  <p class="footer-copy">&copy; 2025–2026 PDFTash. All rights reserved.</p>
</footer>

</body>
</html>
