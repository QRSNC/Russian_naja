<?php
// GÜVENLİK İÇİN NONCE OLUŞTURMA VE OTURUM BAŞLATMA
session_start();
$nonce = base64_encode(random_bytes(12));

// GÜVENLİK BAŞLIKLARI
header(
  "Content-Security-Policy: default-src 'self'; "
. "script-src 'self' 'nonce-$nonce'; "
. "style-src  'self' 'nonce-$nonce' https://fonts.googleapis.com; "
. "font-src   'self' https://fonts.gstatic.com; "
. "img-src    'self' data:; "
. "connect-src 'self';"
);
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
?>
<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>LET’S START</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800;900&display=swap" rel="stylesheet">
<style nonce="<?= $nonce ?>">
:root{--primary:#f28b82;}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Poppins',sans-serif;background:#000;color:#fff;overflow-x:hidden;overflow-y:auto;animation:fade .6s}
@keyframes fade{from{opacity:0;transform:translateY(10px)}to{opacity:1}}
/* --- NAVBAR, LOGO, HAMBURGER & MOBİL MENÜ --- */
.site-logo{position:fixed;top:20px;left:24px;width:56px;height:56px;border-radius:50%;overflow:hidden;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.2);box-shadow:0 4px 12px rgba(0,0,0,.3);z-index:1001}
.site-logo img{width:100%;height:100%;object-fit:cover}
.navbar{position:fixed;top:20px;left:50%;transform:translateX(-50%);display:flex;gap:16px;padding:12px 24px;border-radius:24px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.24);backdrop-filter:blur(22px)saturate(160%);box-shadow:0 16px 32px rgba(242,139,130,.35);width:max-content;max-width:95vw;z-index:1000}
.navbar a{position:relative;display:inline-block;padding:10px 20px;border-radius:16px;color:#fff;text-decoration:none;font-weight:800;font-size:.95rem;letter-spacing:.5px;transition:color .25s}
.navbar a::before{content:'';position:absolute;inset:0;border-radius:inherit;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.24);backdrop-filter:blur(18px) saturate(160%);opacity:0;transition:opacity .3s;z-index:-1}
.navbar a:hover::before{opacity:1}
.navbar a:hover{color:var(--primary)}
.hamburger-btn{position:fixed;top:28px;right:24px;width:40px;height:40px;background:none;border:none;cursor:pointer;z-index:1002;display:none}
.hamburger-btn span{display:block;width:100%;height:2px;background-color:#fff;margin-bottom:8px;transition:transform .3s ease,opacity .3s ease}
.hamburger-btn span:last-child{margin-bottom:0}
.hamburger-btn.open span:nth-child(1){transform:translateY(10px) rotate(45deg)}
.hamburger-btn.open span:nth-child(2){opacity:0}
.hamburger-btn.open span:nth-child(3){transform:translateY(-10px) rotate(-45deg)}
.mobile-menu{position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.7);backdrop-filter:blur(22px) saturate(160%);z-index:1001;display:none;flex-direction:column;justify-content:center;align-items:center;gap:24px}
.mobile-menu a{font-size:1.5rem;font-weight:800;color:#fff;text-decoration:none;padding:16px 32px;border-radius:12px;transition:background-color .3s ease}
.mobile-menu a:hover{background-color:rgba(255,255,255,.1)}

/* --- HERO --- */
.main{padding-top:140px;text-align:center}
.main h1{font-size:5.5rem;font-weight:900;font-style:italic;background:linear-gradient(90deg,var(--primary),#ffb7b2 60%,var(--primary));-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:6px}
.main p{font-size:1.25rem;line-height:1.6;max-width:720px;margin:0 auto 48px;padding:0 24px;opacity:.88}

/* --- PACKAGES --- */
.packages{display:flex;flex-wrap:wrap;gap:48px;justify-content:center;margin-bottom:72px;padding:0 24px}
.pkg{flex:1 1 500px;max-width:600px;min-height:300px;padding:60px 40px;border-radius:20px;cursor:pointer;position:relative;transition:.3s}
.pkg:hover{transform:scale(1.03);box-shadow:0 0 30px rgba(255,255,255,.07)}
.pkg.less{border:3px solid #ff7aac;box-shadow:0 0 18px #ff7aac}
.pkg.best{border:3px solid #ffd74d;box-shadow:0 0 18px #ffd74d}
.pkg::before{content:'';position:absolute;top:14px;left:14px;width:24px;height:24px;background:url(images/link.png) center/contain no-repeat}
.pkg-title{font-size:1.8rem;font-weight:800;margin-bottom:18px}
.pkg-desc{opacity:.9;margin-bottom:16px;font-size:1.05rem}
.pkg-list{list-style:disc inside;color:#ddd;font-size:.95rem;margin-left:18px}
.pkg-list li{margin:8px 0}

/* --- SOCIAL BOXES --- */
.socials{display:flex;flex-wrap:wrap;gap:24px;justify-content:center;padding:0 24px;margin-bottom:100px}
.social-box{width:180px;height:60px;border:3px solid transparent;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.95rem;color:#fff;text-decoration:none;transition:transform .25s, color .25s;position:relative; border-radius: 16px; padding: 0 5px;}
.social-box:hover{transform:translateY(-3px)}
.social-box.revealed{color: #fff; font-size: 0.85rem;}
.ig{border-image:linear-gradient(135deg,#f58529,#dd2a7b,#8134af) 1}
.x{border-image:linear-gradient(135deg,#000,#555) 1}
.wa{border-image:linear-gradient(135deg,#1ebe57,#128c41) 1}
.mail{border-image:linear-gradient(135deg,#4e8cff,#1f62ff) 1}
.social-box::before{content:'';position:absolute;inset:0;padding:3px;background:inherit;border:inherit;-webkit-mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);-webkit-mask-composite:xor;mask-composite:exclude; border-radius: 16px;}

/* --- AI PANEL & KVKK --- */
.contact-btn{position:fixed;right:32px;bottom:32px;width:72px;height:72px;cursor:pointer;z-index:998}
.contact-btn img{width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 6px 12px rgba(242,139,130,.4));transition:opacity .3s ease,transform .3s ease}
.contact-btn:hover img{transform:scale(1.06) rotate(4deg)}
#ai-panel{position:fixed;bottom:120px;right:32px;width:320px;background:rgba(0,0,0,.9);padding:16px;border-radius:12px;color:#fff;display:none;z-index:999}
#ai-panel input,#ai-panel button{width:100%;padding:8px;margin-top:8px;border:none;border-radius:8px}
#ai-panel button{background:var(--primary);color:#fff;font-weight:bold}
#ai-response{font-size:.9rem;margin-top:10px;max-height:320px;overflow-y:auto;display:flex;flex-direction:column;gap:4px}
.chat-bubble{max-width:80%;padding:10px 14px}
.user-bubble{align-self:flex-end;background:var(--primary);color:#000;border-radius:18px 18px 0 18px;margin:6px 0 0}
.ai-bubble{align-self:flex-start;background:#333;color:#fff;border-radius:18px 18px 18px 0;margin:0 0 10px}
.kvkk-fixed{position:fixed;bottom:12px;left:16px;background:rgba(0,0,0,.6);color:#eee;font-size:.8rem;padding:6px 12px;border-radius:8px;z-index:999}
.kvkk-fixed a{color:var(--primary);text-decoration:underline}

/* --- MOBİL UYUMLULUK --- */
@media (max-width: 768px) {
  .navbar {display: none;}
  .hamburger-btn {display: block;}
  .site-logo {top: 15px;left: 15px;width: 48px;height: 48px;}
  .main{padding-top:120px;}
  .main h1 {font-size: 3.5rem;}
  .main p {font-size: 1rem;}
  .packages {gap: 30px;}
  .pkg {padding: 40px 24px;}
  .contact-btn {right: 20px; bottom: 30px; width: 60px; height: 60px;}
  .contact-btn:hover img {transform: none;}
  #ai-panel {width: calc(100% - 40px);right: 20px;bottom: 100px;max-height: 50vh;}
  #ai-response {max-height: 200px;}
  .kvkk-fixed {font-size: .7rem;}
}
@media (max-width: 480px) {
  .main h1 {font-size: 2.8rem;}
  .main p {font-size: 0.9rem;}
  .pkg-title{font-size: 1.5rem;}
  .pkg-desc{font-size: 1rem;}
  .pkg-list{font-size: .9rem;}
  .socials { padding: 0 40px; }
  .social-box { width: 100%; font-size: 0.9rem;}
}
</style>
</head>
<body>

<a href="index" class="site-logo"><img src="logo.png" alt="Logo"></a>

<button class="hamburger-btn"><span></span><span></span><span></span></button>
<div class="mobile-menu">
  <a href="index">Home</a><a href="about">About Me</a><a href="link">Let's Start</a><a href="press">Testimonials</a>
</div>

<nav class="navbar">
  <a href="index">Home</a><a href="about">About Me</a><a href="link">Let's Start</a><a href="press">Testimonials</a>
</nav>

<section class="main">
  <h1>LET’S START</h1>
  <p>Choose the journey that fits you best and follow me on social media to stay inspired every day.</p>
</section>

<section class="packages">
  <div class="pkg less" data-pack="preply">
    <div class="pkg-title">Preply Pack</div>
    <div class="pkg-desc">One-on-one lessons on international platform.</div>
    <ul class="pkg-list">
      <li>Modern Live Lesson Platform</li>
      <li>Personalized lesson plans</li>
      <li>One-on-one lessons</li>
    </ul>
  </div>
  <div class="pkg best" data-pack="immersion">
    <div class="pkg-title">Full Immersion Pack</div>
    <div class="pkg-desc">Goal-oriented modern lessons</div>
    <ul class="pkg-list">
      <li>One-on-one/Mini Group Lessons</li>
      <li>Personalized AI</li>
      <li>Conversation club</li>
    </ul>
  </div>
</section>

<section class="socials">
  <a href="https://example.com" target="_blank" class="social-box ig">Instagram</a>
  <a href="https://example.com" target="_blank" class="social-box x">X / Twitter</a>
  <a href="#" class="social-box wa" id="waBtn">WhatsApp</a>
  <a href="#" class="social-box mail" id="mailBtn">E-mail</a>
</section>

<div class="contact-btn" title="AI Help"><img src="image.png" alt="AI"></div>
<div id="ai-panel">
  <input id="ai-input" placeholder="Ask me anything…"><button id="ai-send">Send</button><div id="ai-response"></div>
</div>

<div class="kvkk-fixed">
  Bu site kişisel veri saklamaz. <a href="kvkk.html" target="_blank">KVKK Aydınlatma Metni</a>
</div>

<script nonce="<?= $nonce ?>">
(() => {
  // Gerekli Değişkenler
  const tel = '+1 555 123 4567';
  const mail = 'hello@russian-odyssey.com';

  // Hamburger Menu
  const hamburgerBtn = document.querySelector('.hamburger-btn');
  const mobileMenu = document.querySelector('.mobile-menu');
  hamburgerBtn.addEventListener('click', () => {
    hamburgerBtn.classList.toggle('open');
    mobileMenu.style.display = mobileMenu.style.display === 'flex' ? 'none' : 'flex';
  });

  // Paket Pop-up Mantığı
  document.querySelectorAll('.pkg').forEach(pkg => {
    pkg.onclick = () => {
      const key = pkg.dataset.pack; // 'preply' veya 'immersion'
      
      const preplyList = `<li>Paid Trial Lesson</li><li>E-books included</li><li>Modern Live Lesson Platform</li><li>Level assessment test</li><li>Personalized lesson plans</li><li>Flexible Schedule</li><li>One-on-one lessons</li><li>Progress tracking</li>`;
      const immersionList = `<li>Free Trial Lesson</li><li>E-books included</li><li>Modern Live Lesson Platform</li><li>Level assessment test</li><li>Personalized lesson plans</li><li>Flexible Schedule</li><li>One-on-one/Mini Group 2-4 person Lessons (optional)</li><li>Progress tracking</li><li>Personalized AI</li><li>Conversation club</li><li>Visualized training</li><li>Interactive training</li><li>Training through real-life scenarios</li>`;
      
      const isImmersion = key === 'immersion';

      // Fiyat bilgileri
      const preplyPriceHTML = `<div class="price-tag">Fee per lesson: $15</div>`;
      const immersionPriceHTML = `<div class="price-tag"> Fee per lesson:<br>Individual: $20<br>2-person group: $12<br>4-person group: $7</div>`;
      const priceHTML = isImmersion ? immersionPriceHTML : preplyPriceHTML;
      
      const contactBtns = isImmersion ? `<button class="cBtn" data-type="wa">WhatsApp</button><button class="cBtn" data-type="mail">E-mail</button>` : '';
      const step2Message = isImmersion ? 'Please get in touch with us via the contact channels we’ve listed. TIP: Click on the WhatsApp and Email buttons to see the communication channels.' : 'Now we’ll redirect you to our booking page.';
      const step2ButtonAction = isImmersion ? 'window.close();' : "location.href='https://example.com';";
      const step2ButtonText = isImmersion ? 'CLOSE' : 'LET’S GO';

      const popHTML = `<!DOCTYPE html><html><head><meta charset=utf-8><meta name=viewport content="width=device-width,initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&display=swap" rel="stylesheet">
<style nonce="<?= $nonce ?>">
  :root{--primary:#f28b82;}
  body{margin:0;padding:30px;background:#000;font-family:Poppins,sans-serif;color:#fff;text-align:center}
  h2{font-size:2rem;margin-bottom:10px;background:linear-gradient(90deg,var(--primary),#ffb7b2);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
  /* DEĞİŞİKLİK 2: Fiyat etiketi stili güncellendi */
  .price-tag{font-size:1.5rem;font-weight:800;color:#ffd74d;margin:24px auto 18px auto;line-height:1.4;max-width:400px;text-align:left;padding-left:20px;}
  .intro{opacity:.9;margin-bottom:18px}
  ul{list-style:disc inside;text-align:left;margin:0 auto 24px;max-width:400px}
  li{margin:8px 0}
  .cBtn{margin:8px 6px;padding:12px 28px;font-weight:700;border:none;border-radius:30px;cursor:pointer;background:#222;color:#fff;transition:.2s;border:2px solid var(--primary)}
  .cBtn.reveal{background:#000;color:var(--primary);word-break:break-all}
  label{display:flex;align-items:center;gap:8px;justify-content:center;margin:20px 0}
  button.main{padding:12px 28px;border:none;border-radius:30px;font-weight:800;cursor:pointer;background:var(--primary);color:#fff}
  #step2{display:none}
  .kvkk{position:static; margin-top:20px; font-size:.8rem; color:#ccc}
  .kvkk a{color:var(--primary)}
</style></head><body>
<h2>${isImmersion ? 'Full Immersion Pack' : 'Preply Pack'}</h2>
<p class="intro">We’re thrilled you chose us! Let’s make fluency happen together.</p>
<ul>${isImmersion ? immersionList : preplyList}</ul>
${priceHTML}
${contactBtns}
<div id="step1"><label><input type=checkbox id=ok> I have read and accept the terms.</label><button class="main" id=cont disabled>Continue</button></div>
<div id="step2"><p>${step2Message}</p><button class="main" id=go>${step2ButtonText}</button></div>
<div class=kvkk>Bu pencere kişisel veri saklamaz. <a href=kvkk.html target=_blank>KVKK Aydınlatma Metni</a></div>
<script nonce="<?= $nonce ?>">
  const tel='${tel}',mail='${mail}';
  document.querySelectorAll('.cBtn').forEach(b=>{b.onclick=()=>{b.textContent=b.dataset.type==='wa'?tel:mail;b.classList.add('reveal');};});
  const ok=document.getElementById('ok'),c=document.getElementById('cont'),s1=document.getElementById('step1'),s2=document.getElementById('step2');
  ok.onchange=()=>c.disabled=!ok.checked;
  c.onclick=()=>{s1.style.display='none';s2.style.display='block';};
  document.getElementById('go').onclick=()=>{${step2ButtonAction}};
<\/script></body></html>`;

      const w = window.open('', '_blank', 'width=540,height=720');
      if (w) {
        w.document.write(popHTML);
        w.document.close();
      } else {
        alert('Popup blocked. Please allow popups for this site.');
      }
    };
  });

  // Ana Sayfa WA / Mail Butonları
  document.getElementById('waBtn').onclick = e => {
    e.preventDefault();
    e.target.textContent = tel;
    e.target.classList.add('revealed');
  };
  document.getElementById('mailBtn').onclick = e => {
    e.preventDefault();
    e.target.textContent = mail;
    e.target.classList.add('revealed');
  };

  // AI Panel
  const aiBtn = document.querySelector('.contact-btn img'),
        aiPanel = document.getElementById('ai-panel'),
        aiInput = document.getElementById('ai-input'),
        aiSend = document.getElementById('ai-send'),
        aiBox = document.getElementById('ai-response');
  const swap = src => { aiBtn.style.opacity=0; setTimeout(()=>{aiBtn.src=src;aiBtn.style.opacity=1;},150); };
  document.querySelector('.contact-btn').onclick = () => {
    const isOpen = aiPanel.style.display === 'block';
    aiPanel.style.display = isOpen ? 'none' : 'block';
    swap(isOpen ? 'image.png' : 'image2.png');
  };
  aiInput.onkeydown = e => { if (e.key === 'Enter') { e.preventDefault(); aiSend.click(); } };
  aiSend.onclick = async () => {
    const txt = aiInput.value.trim(); if (!txt) return;
    bubble('user', txt); aiInput.value = '';
    const wait = bubble('ai', 'Thinking…');
    try {
      const r = await fetch('send_ai.php', { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:new URLSearchParams({message:txt}) });
      const j = await r.json(); wait.textContent = j.text || 'Sorry, no reply.';
    } catch { wait.textContent = 'Error contacting AI.'; }
  };
  function bubble(side, txt) {
    const d = document.createElement('div');
    d.textContent = txt;
    d.className = 'chat-bubble ' + (side === 'user' ? 'user-bubble' : 'ai-bubble');
    aiBox.appendChild(d);
    aiBox.scrollTop = aiBox.scrollHeight;
    return d;
  }
})();
</script>
</body></html>