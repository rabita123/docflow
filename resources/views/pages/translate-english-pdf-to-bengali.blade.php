@extends('tools.layout')
@section('title', 'Translate English PDF to Bengali Free — ইংরেজি PDF বাংলায়')
@section('description', 'Translate English PDF documents to Bengali online free. AI-powered translation with accurate Bengali script. No signup. Perfect for students and professionals in Bangladesh.')
@section('keywords', 'translate english pdf to bengali, english to bengali pdf, pdf english to bengali translation, translate pdf to bangla free, bengali pdf translator, ইংরেজি থেকে বাংলা pdf')
@section('slug', 'translate-english-pdf-to-bengali')
@section('schema')
<script type="application/ld+json">
[{"@context":"https://schema.org","@type":"SoftwareApplication","name":"PDFTash — Translate English PDF to Bengali","applicationCategory":"WebApplication","operatingSystem":"Any","description":"Free AI tool to translate English PDF documents to Bengali online. Accurate Bangla script output. No signup required. Ideal for students and professionals in Bangladesh and West Bengal.","url":"https://pdftash.com/translate-english-pdf-to-bengali","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"aggregateRating":{"@type":"AggregateRating","ratingValue":"4.9","reviewCount":"3241"}},
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
{"@type":"Question","name":"How do I translate an English PDF to Bengali for free?","acceptedAnswer":{"@type":"Answer","text":"Upload your English PDF above. PDFTash AI translates it to Bengali (Bangla) in 10–30 seconds. Download as TXT or PDF. No signup needed."}},
{"@type":"Question","name":"Does it support both Bangladesh Bengali and West Bengal Bengali?","acceptedAnswer":{"@type":"Answer","text":"Yes. The AI outputs standard Bengali (বাংলা) which is understood in both Bangladesh and West Bengal, India."}},
{"@type":"Question","name":"Can I translate Bengali PDF back to English?","acceptedAnswer":{"@type":"Answer","text":"Yes — use the Translate PDF tool and select English as the target language to convert Bengali PDFs to English."}},
{"@type":"Question","name":"Is this useful for BUET, DU or HSC students?","acceptedAnswer":{"@type":"Answer","text":"Yes. PDFTash is widely used by Bangladeshi students to translate English textbooks, research papers, and lecture notes to Bengali for easier study."}},
{"@type":"Question","name":"How many PDFs can I translate per day?","acceptedAnswer":{"@type":"Answer","text":"Free users get 1 translation per day. Pro users ($2/month) get unlimited Bengali translations and access to all 12+ languages."}}
]}]
</script>
@endsection
@section('content')
<div class="hero">
  <div style="display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin-bottom:20px;">
    <div class="badge">🇧🇩 English → Bengali</div>
    <div class="badge" style="background:rgba(0,229,160,.1);border-color:rgba(0,229,160,.4);color:#00e5a0;">🆓 Free</div>
  </div>
  <h1>Translate English PDF to Bengali — ইংরেজি PDF বাংলায়</h1>
  <p>Upload any English PDF and get an accurate Bengali translation in seconds. AI outputs proper Bangla script. No signup, no watermark, instant download.</p>
</div>

<div class="tool-box">
  <div class="upload-area" id="drop-zone" onclick="document.getElementById('pdfInput').click()">
    <div class="upload-icon">🇧🇩</div>
    <div class="upload-title">Drop your English PDF here — Get Bengali Translation</div>
    <div class="upload-sub">ইংরেজি PDF আপলোড করুন · Free · No signup</div>
    <input type="file" id="pdfInput" accept=".pdf" style="display:none" onchange="handleFile(this)">
  </div>
  <div id="result" style="display:none;text-align:center;margin-top:20px;"></div>
  <div style="text-align:center;margin-top:16px;"><p style="color:#8888a8;font-size:12px;">ফাইল ২ ঘণ্টা পর স্বয়ংক্রিয়ভাবে মুছে যাবে · ১০০% নিরাপদ</p></div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;">
  <h2 style="font-size:26px;font-weight:700;text-align:center;margin-bottom:12px;">কে এই টুল ব্যবহার করেন?</h2>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:24px;">
    @foreach([
      ['🎓','বিশ্ববিদ্যালয় শিক্ষার্থী','ইংরেজি রিসার্চ পেপার, টেক্সটবুক ও লেকচার নোট বাংলায় অনুবাদ করুন সহজে পড়ার জন্য।'],
      ['💼','চাকরিজীবী','ইংরেজি চুক্তি, রিপোর্ট ও অফিস ডকুমেন্ট বাংলায় বুঝুন।'],
      ['👨‍⚕️','ডাক্তার ও স্বাস্থ্যকর্মী','ইংরেজি মেডিকেল রিপোর্ট ও প্রেসক্রিপশন বাংলায় অনুবাদ করুন।'],
      ['📰','সাংবাদিক ও লেখক','ইংরেজি নথি থেকে বাংলায় কন্টেন্ট তৈরি করুন।'],
      ['🏛️','সরকারি কর্মকর্তা','ইংরেজি সরকারি নথি ও নির্দেশিকা বাংলায় বুঝুন।'],
      ['👨‍🏫','শিক্ষক','ইংরেজি শিক্ষা উপকরণ বাংলায় রূপান্তর করুন শিক্ষার্থীদের জন্য।'],
    ] as $f)
    <div style="background:#0f0f1a;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:20px;">
      <div style="font-size:24px;margin-bottom:8px;">{{ $f[0] }}</div>
      <div style="font-weight:600;font-size:13px;color:#eeeef8;margin-bottom:5px;">{{ $f[1] }}</div>
      <div style="color:#8888a8;font-size:12px;line-height:1.5;">{{ $f[2] }}</div>
    </div>
    @endforeach
  </div>
</div>

<div style="max-width:700px;margin:0 auto 60px;padding:0 20px;text-align:center;">
  <h2 style="font-size:20px;font-weight:700;margin-bottom:16px;">অন্য ভাষায় PDF অনুবাদ করুন</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    @foreach([['🇧🇩 সব বাংলা টুল','/pdf-translator-bengali'],['🇮🇳 Hindi','/translate-pdf-to-hindi'],['🇸🇦 Arabic','/translate-pdf-to-arabic'],['🇪🇸 Spanish','/translate-pdf-to-spanish'],['🌐 All Languages','/translate-pdf']] as $l)
    <a href="{{ $l[1] }}" style="padding:8px 16px;background:#0f0f1a;border:1px solid rgba(255,255,255,.1);border-radius:99px;color:#eeeef8;text-decoration:none;font-size:13px;" onmouseover="this.style.borderColor='#5b5cff'" onmouseout="this.style.borderColor='rgba(255,255,255,.1)'">{{ $l[0] }}</a>
    @endforeach
  </div>
</div>

<div class="faq">
  <h2>Frequently Asked Questions — English to Bengali PDF Translation</h2>
  <div class="faq-item">
    <h3>ইংরেজি PDF বাংলায় অনুবাদ করতে কতক্ষণ লাগে?</h3>
    <p>বেশিরভাগ PDF ১০–৩০ সেকেন্ডে অনুবাদ হয়। বড় ডকুমেন্ট (১০০+ পৃষ্ঠা) ৬০ সেকেন্ড পর্যন্ত সময় নিতে পারে।</p>
  </div>
  <div class="faq-item">
    <h3>অনুবাদের মান কেমন?</h3>
    <p>PDFTash Anthropic-এর advanced AI ব্যবহার করে যা বাংলা অনুবাদে অত্যন্ত নির্ভুল। প্যারাগ্রাফ স্ট্রাকচার বজায় রাখা হয়।</p>
  </div>
  <div class="faq-item">
    <h3>কি BUET বা DU-এর টেক্সটবুক অনুবাদ করা যাবে?</h3>
    <p>হ্যাঁ। বাংলাদেশের অনেক শিক্ষার্থী PDFTash ব্যবহার করে ইংরেজি টেক্সটবুক ও রিসার্চ পেপার বাংলায় অনুবাদ করেন। শুধু PDF আপলোড করুন এবং কয়েক সেকেন্ডে বাংলা অনুবাদ পান।</p>
  </div>
  <div class="faq-item">
    <h3>প্রতিদিন কতটি PDF অনুবাদ করা যাবে?</h3>
    <p>ফ্রি ব্যবহারকারীরা প্রতিদিন ১টি অনুবাদ করতে পারবেন। Pro প্ল্যান ($৯/মাস) এ সীমাহীন অনুবাদ পাবেন।</p>
  </div>
</div>

<script>
const CSRF=document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')||'';let selectedFile=null;
const dropZone=document.getElementById('drop-zone');
dropZone.addEventListener('dragover',(e)=>{e.preventDefault();dropZone.style.borderColor='#5b5cff';});
dropZone.addEventListener('dragleave',()=>{dropZone.style.borderColor='rgba(255,255,255,.15)';});
dropZone.addEventListener('drop',(e)=>{e.preventDefault();const f=e.dataTransfer.files[0];if(f?.type==='application/pdf')showFile(f);});
function handleFile(input){if(input.files[0])showFile(input.files[0]);}
function showFile(file){selectedFile=file;dropZone.querySelector('.upload-title').textContent='✅ '+file.name;dropZone.onclick=processTranslate;}
async function processTranslate(){
    if(!selectedFile)return;const result=document.getElementById('result');result.style.display='block';
    let secs=0;result.innerHTML='<div style="color:#8888a8;padding:20px">⏳ বাংলায় অনুবাদ হচ্ছে... <span id="timer">0s</span></div>';
    const iv=setInterval(()=>{secs++;const t=document.getElementById('timer');if(t)t.textContent=secs+'s';},1000);
    const fd=new FormData();fd.append('file',selectedFile);fd.append('language','Bengali');fd.append('_token',CSRF);
    const ctrl=new AbortController();const to=setTimeout(()=>ctrl.abort(),150000);
    try{const resp=await fetch('/api/ai/translate',{method:'POST',body:fd,signal:ctrl.signal});
        clearTimeout(to);clearInterval(iv);const data=await resp.json();
        if(resp.ok){window._xlText=data.translation||data.text||'';const esc=window._xlText.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
            result.innerHTML=`<div style="background:#0a1a0a;border:1px solid #00e5a0;border-radius:12px;padding:20px;text-align:left;margin-bottom:16px;"><div style="color:#00e5a0;font-weight:700;margin-bottom:12px;">✅ বাংলায় অনুবাদ সম্পন্ন — ${secs}s!</div><div style="color:#eeeef8;font-size:14px;line-height:1.8;white-space:pre-wrap;max-height:320px;overflow-y:auto;border:1px solid rgba(255,255,255,.08);border-radius:8px;padding:14px;margin-bottom:16px;">${esc}</div><div style="display:flex;gap:10px;flex-wrap:wrap;"><button onclick="const b=new Blob([window._xlText],{type:'text/plain;charset=utf-8'});const a=document.createElement('a');a.href=URL.createObjectURL(b);a.download='translation-bengali.txt';a.click();" style="flex:1;min-width:140px;padding:11px 20px;background:#5b5cff;color:#fff;border:none;border-radius:99px;font-size:14px;font-weight:600;cursor:pointer;">⬇ Download TXT</button></div></div><button onclick="location.reload()" style="background:transparent;color:#8888a8;border:1px solid rgba(255,255,255,.15);padding:10px 20px;border-radius:99px;cursor:pointer;font-size:14px">আরেকটি অনুবাদ করুন</button>`;
        }else if(data.error==='pro_required'||data.error==='free_limit_reached'){result.innerHTML=`<div style="background:#1a1a0a;border:1px solid #ffa500;border-radius:12px;padding:20px;"><div style="color:#ffa500;font-weight:700;margin-bottom:8px">⚡ দৈনিক সীমা পূর্ণ হয়েছে</div><div style="color:#8888a8;font-size:14px;margin-bottom:16px">Pro প্ল্যানে আপগ্রেড করুন সীমাহীন অনুবাদের জন্য।</div><a href="/payment/checkout" style="display:inline-block;padding:12px 24px;background:#5b5cff;color:#fff;border-radius:99px;text-decoration:none;font-weight:700;">Upgrade to Pro →</a></div>`;}
        else{result.innerHTML=`<div style="color:#ff6b6b">Error: ${data.error||'কিছু একটা ভুল হয়েছে'}</div>`;}
    }catch(e){clearTimeout(to);clearInterval(iv);result.innerHTML=`<div style="color:#ff6b6b">${e.name==='AbortError'?'সময় শেষ হয়ে গেছে। ছোট PDF ব্যবহার করুন।':'সংযোগ ত্রুটি। আবার চেষ্টা করুন।'}</div>`;}
}
</script>
@endsection
