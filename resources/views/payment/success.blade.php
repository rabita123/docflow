<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Successful — PDFTash</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Inter',sans-serif;background:#07070d;color:#fff;
  display:flex;align-items:center;justify-content:center;min-height:100vh;padding:20px;}
.box{max-width:480px;width:100%;text-align:center;}
.icon{font-size:72px;margin-bottom:24px;animation:bounce .6s ease;}
@keyframes bounce{0%{transform:scale(0)}60%{transform:scale(1.2)}100%{transform:scale(1)}}
h1{font-size:32px;font-weight:700;margin-bottom:12px;}
p{color:#8888a8;font-size:16px;line-height:1.65;margin-bottom:32px;}
.features{background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:16px;
  padding:24px;margin-bottom:32px;text-align:left;}
.feature{display:flex;gap:10px;padding:8px 0;font-size:14px;color:#8888a8;border-bottom:1px solid rgba(255,255,255,.06);}
.feature:last-child{border-bottom:none;}
.feature span{color:#00e5a0;font-weight:600;flex-shrink:0;}
.btn{display:inline-block;padding:14px 32px;background:#5b5cff;color:#fff;
  border-radius:99px;text-decoration:none;font-weight:600;font-size:16px;
  transition:all .2s;}
.btn:hover{background:#7475ff;transform:translateY(-2px);}
.confetti{position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;overflow:hidden;z-index:-1;}
</style>
</head>
<body>
<div class="box">
  <div class="icon">🎉</div>
  <h1>Welcome to Pro!</h1>
  <p>Your payment was successful. You now have <strong style="color:#fff">unlimited access</strong> to all PDFTash Pro features.</p>

  <div class="features">
    <div class="feature"><span>✓</span> Unlimited PDF tasks every day</div>
    <div class="feature"><span>✓</span> All 20+ PDF tools unlocked</div>
    <div class="feature"><span>✓</span> Unlimited AI Chat, Summarize & Translate</div>
    <div class="feature"><span>✓</span> PDF Translation to 12+ languages</div>
    <div class="feature"><span>✓</span> 2GB document storage</div>
    <div class="feature"><span>✓</span> Priority support</div>
  </div>

  <a href="/" class="btn">Start Using PDFTash Pro →</a>
</div>
</body>
</html>