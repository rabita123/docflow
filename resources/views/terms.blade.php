<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Terms of Service — PDFTash</title>
<meta name="description" content="PDFTash terms of service. Free plan: 3 PDF tasks/day, 1 AI task/day. Pro plan: unlimited tasks for $2/month. Read our acceptable use policy and file handling terms.">
<meta name="robots" content="index, follow">
<meta property="og:type" content="website">
<meta property="og:title" content="Terms of Service — PDFTash">
<meta property="og:description" content="PDFTash terms of service. Free and Pro plan details, acceptable use, file handling, and more.">
<meta property="og:url" content="https://pdftash.com/terms">
<meta property="og:site_name" content="PDFTash">
<meta property="og:image" content="https://pdftash.com/og-image.png">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Terms of Service — PDFTash">
<meta name="twitter:description" content="PDFTash terms of service. Free and Pro plan details, acceptable use, file handling, and more.">
<link rel="canonical" href="https://pdftash.com/terms">
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "Terms of Service",
  "url": "https://pdftash.com/terms"
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

/* LAYOUT */
.page-grid {
  display: grid;
  grid-template-columns: 220px 1fr;
  gap: 48px;
  max-width: 1000px;
  margin: 0 auto;
  padding: 60px 24px 80px;
  align-items: start;
}

/* TOC */
.toc {
  position: sticky;
  top: 80px;
}
.toc-title {
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  color: var(--text2);
  margin-bottom: 12px;
  padding-bottom: 10px;
  border-bottom: 1px solid var(--border);
}
.toc-list { list-style: none; }
.toc-list li + li { margin-top: 2px; }
.toc-list a {
  display: block;
  padding: 6px 10px;
  font-size: 13px;
  color: var(--text2);
  text-decoration: none;
  border-radius: 6px;
  transition: background .15s, color .15s;
}
.toc-list a:hover {
  background: var(--bg2);
  color: var(--text);
}

/* CONTENT */
.content { min-width: 0; }
.section {
  margin-bottom: 52px;
  scroll-margin-top: 90px;
}
.section h2 {
  font-size: 1.2rem;
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
  width: 30px;
  height: 30px;
  background: rgba(124,92,252,.15);
  border-radius: 7px;
  font-size: 15px;
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
  line-height: 1.65;
}
.section ul li::before {
  content: '→';
  position: absolute;
  left: 0;
  color: var(--accent);
  font-size: 13px;
}

/* PLAN TABLE */
.plan-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 16px;
  border-radius: var(--r);
  overflow: hidden;
  font-size: 14px;
}
.plan-table th {
  background: rgba(124,92,252,.15);
  color: var(--text);
  font-weight: 600;
  padding: 12px 16px;
  text-align: left;
  border-bottom: 1px solid var(--border);
}
.plan-table th:first-child { width: 40%; }
.plan-table td {
  padding: 11px 16px;
  color: var(--text2);
  border-bottom: 1px solid var(--border);
  vertical-align: middle;
}
.plan-table tr:last-child td { border-bottom: none; }
.plan-table tr:hover td { background: rgba(255,255,255,.02); }
.plan-table .free { color: rgba(124,252,180,.8); font-weight: 500; }
.plan-table .pro { color: var(--accent); font-weight: 600; }
.plan-table .feature-label { color: var(--text); font-weight: 500; }

/* HIGHLIGHT & WARNING BOXES */
.box {
  border-radius: var(--r);
  padding: 16px 20px;
  margin-top: 14px;
  font-size: 14px;
  line-height: 1.65;
  color: var(--text2);
}
.box-info {
  background: var(--bg2);
  border: 1px solid var(--border);
  border-left: 3px solid var(--accent);
}
.box-warn {
  background: rgba(255, 200, 80, .06);
  border: 1px solid rgba(255, 200, 80, .2);
  border-left: 3px solid rgba(255, 200, 80, .6);
  color: rgba(255,235,160,.7);
}
.box p { margin: 0; }

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
.footer-copy { font-size: 12px; color: rgba(255,255,255,.3); }

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
  .page-grid { grid-template-columns: 1fr; }
  .toc { display: none; }
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
  <h1>Terms of Service</h1>
  <p class="hero-meta">Effective: <strong>June 2026</strong> &nbsp;·&nbsp; pdftash.com</p>
</section>

<div class="page-grid">

  <!-- TOC sidebar -->
  <aside class="toc">
    <p class="toc-title">On this page</p>
    <ul class="toc-list">
      <li><a href="#acceptance">Acceptance</a></li>
      <li><a href="#plans">Free vs Pro Plans</a></li>
      <li><a href="#acceptable-use">Acceptable Use</a></li>
      <li><a href="#file-handling">File Handling</a></li>
      <li><a href="#ai-features">AI Features</a></li>
      <li><a href="#no-warranty">No Warranty</a></li>
      <li><a href="#liability">Limitation of Liability</a></li>
      <li><a href="#changes">Changes to Terms</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
  </aside>

  <!-- Main content -->
  <main class="content">

    <div class="section" id="acceptance">
      <h2><span class="icon">📋</span> Acceptance of Terms</h2>
      <p>By accessing or using PDFTash (pdftash.com), you agree to be bound by these Terms of Service. If you do not agree to these terms, please do not use the service.</p>
      <p>These terms apply to all users of PDFTash, including visitors who use tools without an account, registered free users, and Pro subscribers.</p>
    </div>

    <div class="section" id="plans">
      <h2><span class="icon">💎</span> Free vs Pro Plans</h2>
      <p>PDFTash is free to use with generous daily limits. A Pro plan is available for users who need more.</p>
      <table class="plan-table">
        <thead>
          <tr>
            <th>Feature</th>
            <th>Free</th>
            <th>Pro</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="feature-label">PDF Tool Tasks</td>
            <td class="free">3 / day</td>
            <td class="pro">Unlimited</td>
          </tr>
          <tr>
            <td class="feature-label">AI Tasks (Summarize, Translate, Chat)</td>
            <td class="free">1 / day</td>
            <td class="pro">Unlimited</td>
          </tr>
          <tr>
            <td class="feature-label">Max File Size</td>
            <td class="free">10 MB</td>
            <td class="pro">200 MB</td>
          </tr>
          <tr>
            <td class="feature-label">Watermarks</td>
            <td class="free">None</td>
            <td class="pro">None</td>
          </tr>
          <tr>
            <td class="feature-label">Signup Required</td>
            <td class="free">No</td>
            <td class="pro">Yes (for billing)</td>
          </tr>
          <tr>
            <td class="feature-label">Price</td>
            <td class="free">$0</td>
            <td class="pro">$2 / month</td>
          </tr>
        </tbody>
      </table>
      <div class="box box-info">
        <p>Pro subscriptions are billed monthly through Lemon Squeezy. You may cancel at any time. Cancellations take effect at the end of the current billing period.</p>
      </div>
    </div>

    <div class="section" id="acceptable-use">
      <h2><span class="icon">✅</span> Acceptable Use</h2>
      <p>You agree to use PDFTash only for lawful purposes and in accordance with these terms. You must not:</p>
      <ul>
        <li>Upload files that contain illegal content, malware, viruses, or other harmful software</li>
        <li>Use PDFTash to process files you do not have the legal right to use, copy, or modify</li>
        <li>Attempt to reverse engineer, scrape, or overload PDFTash's servers or infrastructure</li>
        <li>Use PDFTash to infringe on intellectual property rights of third parties</li>
        <li>Circumvent or attempt to bypass daily usage limits through automated means</li>
        <li>Resell access to PDFTash or use it as a backend for other services without permission</li>
      </ul>
    </div>

    <div class="section" id="file-handling">
      <h2><span class="icon">📁</span> File Handling</h2>
      <p>PDFTash temporarily stores uploaded files solely for the purpose of processing your request.</p>
      <ul>
        <li>Files are automatically and permanently deleted within <strong style="color:var(--text)">2 hours</strong> of upload</li>
        <li>Processed output files are also deleted within the same timeframe</li>
        <li>We are not responsible for data loss — do not use PDFTash as a file storage or backup service</li>
        <li>Always keep copies of important documents before uploading them for processing</li>
      </ul>
      <div class="box box-warn">
        <p>PDFTash is a processing tool, not a storage service. Files cannot be recovered after deletion. Always download your processed files promptly.</p>
      </div>
    </div>

    <div class="section" id="ai-features">
      <h2><span class="icon">🤖</span> AI Features</h2>
      <p>PDFTash offers AI-powered tools including PDF Summarization, Translation, and Chat with PDF. These features are powered by Anthropic's Claude AI.</p>
      <ul>
        <li>AI outputs (summaries, translations, extracted data) may contain errors or inaccuracies</li>
        <li>Always review AI-generated content before relying on it for professional, legal, or medical decisions</li>
        <li>PDFTash does not warrant the accuracy, completeness, or fitness of AI-generated outputs for any specific purpose</li>
        <li>Use of AI features is subject to Anthropic's terms of service and usage policies</li>
      </ul>
      <div class="box box-info">
        <p>AI features are experimental tools to assist your workflow. They are not a substitute for professional advice. PDFTash is not liable for decisions made based on AI-generated outputs.</p>
      </div>
    </div>

    <div class="section" id="no-warranty">
      <h2><span class="icon">⚠️</span> No Warranty</h2>
      <p>PDFTash is provided <strong style="color:var(--text)">"as is"</strong> and <strong style="color:var(--text)">"as available"</strong> without warranties of any kind, either express or implied.</p>
      <ul>
        <li>We do not guarantee 100% uptime or uninterrupted availability of the service</li>
        <li>We do not warrant that the service will be error-free or that results will be accurate in all cases</li>
        <li>Tool outputs depend on the quality and content of your uploaded files</li>
        <li>We may temporarily suspend service for maintenance, updates, or unforeseen issues</li>
      </ul>
    </div>

    <div class="section" id="liability">
      <h2><span class="icon">⚖️</span> Limitation of Liability</h2>
      <p>To the fullest extent permitted by applicable law, PDFTash and its operators shall not be liable for any indirect, incidental, special, consequential, or punitive damages arising from:</p>
      <ul>
        <li>Your use of or inability to use the service</li>
        <li>Loss of data, files, or documents processed through the service</li>
        <li>Errors or inaccuracies in AI-generated outputs</li>
        <li>Unauthorized access to your uploaded files (though we take security seriously)</li>
        <li>Service interruptions or downtime</li>
      </ul>
      <p>PDFTash's total liability to you for any claims arising from these terms or use of the service shall not exceed the amount you paid to PDFTash in the 12 months preceding the claim.</p>
    </div>

    <div class="section" id="changes">
      <h2><span class="icon">🔄</span> Changes to These Terms</h2>
      <p>We may update these Terms of Service from time to time. When we do, we will update the effective date at the top of this page.</p>
      <p>Your continued use of PDFTash after changes are published constitutes your acceptance of the updated terms. We recommend reviewing this page periodically.</p>
      <p>For material changes that significantly affect your rights, we will make reasonable efforts to notify registered users via email.</p>
    </div>

    <div class="section" id="contact">
      <h2><span class="icon">✉️</span> Contact</h2>
      <p>For legal inquiries, questions about these terms, or to report misuse, contact us at:</p>
      <div class="box box-info">
        <p><a href="mailto:legal@pdftash.com" class="email-link">legal@pdftash.com</a></p>
      </div>
    </div>

  </main>
</div>

<footer>
  <ul class="footer-links">
    <li><a href="/">Home</a></li>
    <li><a href="/#tools">Tools</a></li>
    <li><a href="/blog">Blog</a></li>
    <li><a href="/pricing">Pricing</a></li>
    <li><a href="/about">About</a></li>
    <li><a href="/privacy">Privacy</a></li>
    <li><a href="/terms" style="color:var(--text)">Terms</a></li>
  </ul>
  <p class="footer-copy">&copy; 2025–2026 PDFTash. All rights reserved.</p>
</footer>

</body>
</html>
