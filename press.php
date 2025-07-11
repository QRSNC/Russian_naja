<?php
session_start();
$nonce = base64_encode(random_bytes(12));
header(
  "Content-Security-Policy: default-src 'self'; "
. "script-src 'self' 'nonce-$nonce'; "
. "style-src  'self' 'nonce-$nonce' https://fonts.googleapis.com; "
. "font-src   'self' https://fonts.gstatic.com; "
. "img-src    'self' data:; "
. "connect-src 'self';"
);

// --- Basın görsellerini ana dizinden tara ---
$pressImages = [];
foreach (glob(__DIR__ . '/t*.{png,jpg,jpeg,webp}', GLOB_BRACE) as $file) {
    $pressImages[] = basename($file);
}
natsort($pressImages);
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Testimonials – Russian Language Odyssey</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800;900&display=swap" rel="stylesheet" />
  <style nonce="<?= $nonce ?>">
    :root { --primary:#f28b82; }
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
    body{min-height:100vh;background:#000;color:#fff;overflow-x:hidden;}

    /* NAVBAR & LOGO */
    .navbar{position:fixed;top:20px;left:50%;transform:translateX(-50%);display:flex;gap:16px;padding:12px 24px;border-radius:24px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.24);backdrop-filter:blur(22px) saturate(160%);-webkit-backdrop-filter:blur(22px) saturate(160%);box-shadow:0 16px 32px rgba(242,139,130,.35);width:max-content;max-width:95vw;justify-content:center;z-index:1000}
    .navbar a{position:relative;display:inline-block;padding:10px 20px;border-radius:16px;color:#fff;text-decoration:none;font-weight:800;font-size:.95rem;letter-spacing:.5px;white-space:nowrap;transition:color .25s ease}
    .navbar a::before{content:'';position:absolute;inset:0;border-radius:inherit;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.24);backdrop-filter:blur(18px) saturate(160%);-webkit-backdrop-filter:blur(18px) saturate(160%);opacity:0;transition:opacity .3s ease;z-index:-1}
    .navbar a:hover::before{opacity:1}.navbar a:hover{color:var(--primary)}
    .site-logo{position:fixed;top:20px;left:24px;width:56px;height:56px;border-radius:50%;overflow:hidden;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.2);box-shadow:0 4px 12px rgba(0,0,0,.3);z-index:1001}
    .site-logo img{width:100%;height:100%;object-fit:cover}
    .hamburger-btn{position:fixed;top:28px;right:24px;width:40px;height:40px;background:none;border:none;cursor:pointer;z-index:1002;display:none}
    .hamburger-btn span{display:block;width:100%;height:2px;background-color:#fff;margin-bottom:8px;transition:transform .3s ease,opacity .3s ease}
    .hamburger-btn span:last-child{margin-bottom:0}
    .hamburger-btn.open span:nth-child(1){transform:translateY(10px) rotate(45deg)}
    .hamburger-btn.open span:nth-child(2){opacity:0}
    .hamburger-btn.open span:nth-child(3){transform:translateY(-10px) rotate(-45deg)}
    .mobile-menu{position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.7);backdrop-filter:blur(22px) saturate(160%);z-index:1001;display:none;flex-direction:column;justify-content:center;align-items:center;gap:24px}
    .mobile-menu a{font-size:1.5rem;font-weight:800;color:#fff;text-decoration:none;padding:16px 32px;border-radius:12px;transition:background-color .3s ease}
    .mobile-menu a:hover{background-color:rgba(255,255,255,.1)}

    /* CONTENT */
    .press-wrapper{padding-top:140px;padding-bottom:60px;padding-left:24px;padding-right:24px;max-width:1400px;margin:auto}
    h1.press-title{font-size:3.4rem;font-weight:900;text-align:center;margin-bottom:16px;background:linear-gradient(90deg,var(--primary),#ffb7b2 60%,var(--primary));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
    .press-desc{max-width:880px;margin:0 auto 48px;font-size:1.25rem;line-height:1.65;opacity:.88;text-align:center}
    .press-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:24px}
    .press-item{opacity:0;transform:scale(.9);transition:opacity .6s ease,transform .6s ease;cursor:pointer}
    .press-item.visible{opacity:1;transform:scale(1)}
    .press-item img{width:100%;border-radius:16px;display:block;box-shadow:0 8px 20px rgba(0,0,0,.4)}
    .no-images-message {grid-column:1/-1;text-align:center;opacity:.8}

    /* LIGHTBOX */
    .lightbox{position:fixed;inset:0;background:rgba(0,0,0,.85);display:flex;align-items:center;justify-content:center;visibility:hidden;opacity:0;transition:opacity .3s ease,visibility .3s ease;z-index:10000}
    .lightbox.show{visibility:visible;opacity:1}
    .lightbox img#lbImg{max-width:90vw;max-height:90vh;border-radius:16px;box-shadow:0 10px 32px rgba(0,0,0,.6)}
    .lb-close{position:absolute;top:20px;right:28px;width:36px;height:36px;cursor:pointer}
    .lb-nav{position:absolute;top:50%;transform:translateY(-50%);font-size:4rem;color:#fff;user-select:none;cursor:pointer;padding:12px 20px;opacity:.6;transition:opacity .25s ease}
    .lb-prev{left:10px}.lb-next{right:10px}.lb-nav:hover{opacity:1}

    /* AI PANEL & KVKK */
    .contact-btn{position:fixed;right:32px;bottom:32px;width:72px;height:72px;cursor:pointer;z-index:998}
    .contact-btn img{width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 6px 12px rgba(242,139,130,.4));transition:opacity .3s ease,transform .3s ease}
    .contact-btn:hover img{transform:scale(1.06) rotate(4deg)}
    #ai-panel{position:fixed;bottom:120px;right:32px;width:320px;background:rgba(0,0,0,.9);padding:16px;border-radius:12px;color:#fff;display:none;z-index:999}
    #ai-panel input,#ai-panel button{width:100%;padding:8px;margin-top:8px;border-radius:8px;border:none}
    #ai-panel button{background:var(--primary);color:#fff;font-weight:bold}
    #ai-response{font-size:.9rem;margin-top:10px;max-height:320px;overflow-y:auto;display:flex;flex-direction:column;gap:4px}
    .chat-bubble{max-width:80%;padding:10px 14px}
    .user-bubble{align-self:flex-end;background:var(--primary);color:#000;border-radius:18px 18px 0 18px;margin:6px 0 0}
    .ai-bubble{align-self:flex-start;background:#333;color:#fff;border-radius:18px 18px 18px 0;margin:0 0 10px}
    .kvkk-fixed{position:fixed;bottom:12px;left:16px;background:rgba(0,0,0,.6);color:#eee;font-size:.8rem;padding:6px 12px;border-radius:8px;z-index:999}
    .kvkk-fixed a{color:var(--primary);text-decoration:underline}
    
    /* MOBİL UYUMLULUK */
    @media(max-width:768px){
      .navbar{display:none}
      .hamburger-btn{display:block}
      .site-logo{top:15px;left:15px;width:48px;height:48px}
      .press-wrapper{padding-top:120px; padding-left:15px; padding-right:15px;}
      h1.press-title{font-size:2.5rem}
      .press-desc{font-size:1rem}
      .press-grid{grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:16px}
      .lb-close{width:28px;height:28px;top:15px;right:15px}
      .lb-nav{font-size:2.5rem;padding:8px 12px}
      .lb-prev{left:5px}.lb-next{right:5px}
      .contact-btn{right:20px;bottom:30px;width:60px;height:60px}
      .contact-btn:hover img{transform:none}
      #ai-panel{width:calc(100% - 40px);right:20px;bottom:100px;max-height:50vh}
      #ai-response{max-height:200px}
      .kvkk-fixed{font-size:.7rem}
    }
    @media(max-width:480px){
      .press-grid{grid-template-columns:repeat(auto-fill,minmax(120px,1fr))}
    }
  </style>
</head>
<body>
  <a href="index" class="site-logo"><img src="logo.png" alt="Site Logo"></a>
  <button class="hamburger-btn"><span></span><span></span><span></span></button>
  <div class="mobile-menu">
    <a href="index">Home</a><a href="about">About Me</a><a href="link">Let's Start</a><a href="press">Testimonials</a>
  </div>
  <nav class="navbar">
    <a href="index">Home</a><a href="about">About Me</a><a href="link">Let's Start</a><a href="press">Testimonials</a>
  </nav>

  <div class="press-wrapper">
    <h1 class="press-title">Student Testimonials</h1>
    <p class="press-desc">
      Over the years, hundreds of learners have joined our language journey.  
      Below you can find snapshots and media mentions celebrating their success stories.
    </p>
    <div class="press-grid" id="pressGrid">
      <?php foreach ($pressImages as $img): ?>
        <div class="press-item"><img src="<?= htmlspecialchars($img, ENT_QUOTES, 'UTF-8') ?>" loading="lazy" alt="Press mention"></div>
      <?php endforeach; ?>
      <?php if (!$pressImages): ?>
        <p class="no-images-message">No press clippings found.</p>
      <?php endif; ?>
    </div>
  </div>

  <div class="lightbox" id="lightbox">
    <img src="image3.png" alt="Close" class="lb-close" id="lbClose">
    <div class="lb-nav lb-prev" id="lbPrev">&#10094;</div>
    <img src="" alt="Large view" id="lbImg">
    <div class="lb-nav lb-next" id="lbNext">&#10095;</div>
  </div>

  <div class="contact-btn" title="AI Help"><img src="image.png" alt="AI Help"></div>
  <div id="ai-panel">
    <input type="text" id="ai-input" placeholder="Ask me anything..." autocomplete="off">
    <button id="ai-send">Send</button>
    <div id="ai-response"></div>
  </div>
  <div class="kvkk-fixed">
    Bu site kişisel veri saklamaz. <a href="kvkk.html" target="_blank">KVKK Aydınlatma Metni</a>
  </div>

  <script nonce="<?= $nonce ?>">
  (() => {
    // Tüm JS kodları önceki haliyle aynı ve doğru çalışmaktadır.
    const hamburgerBtn=document.querySelector('.hamburger-btn'),mobileMenu=document.querySelector('.mobile-menu');
    hamburgerBtn.addEventListener('click',()=>{hamburgerBtn.classList.toggle('open');mobileMenu.style.display=mobileMenu.style.display==='flex'?'none':'flex';});
    const aiBtn=document.querySelector('.contact-btn img'),aiPanel=document.getElementById('ai-panel'),aiInput=document.getElementById('ai-input'),aiSend=document.getElementById('ai-send'),aiBox=document.getElementById('ai-response');
    const swap=s=>{aiBtn.style.opacity='0';setTimeout(()=>{aiBtn.src=s;aiBtn.style.opacity='1';},150);};
    document.querySelector('.contact-btn').onclick=()=>{const o=aiPanel.style.display==='block';aiPanel.style.display=o?'none':'block';swap(o?'image.png':'image2.png');};
    aiInput.onkeydown=e=>{if(e.key==='Enter'){e.preventDefault();aiSend.click();}};
    aiSend.onclick=async()=>{const t=aiInput.value.trim();if(!t)return;bubble('user',t);aiInput.value='';const w=bubble('ai','Thinking…');try{const r=await fetch('send_ai.php',{method:'POST',headers:{'Content-Type':'application/x-www-form-urlencoded'},body:new URLSearchParams({message:t})});const j=await r.json();w.textContent=j.text||'Sorry, no reply.';}catch{w.textContent='Error contacting AI.';}};
    function bubble(s,t){const d=document.createElement('div');d.textContent=t;d.className='chat-bubble '+(s==='user'?'user-bubble':'ai-bubble');aiBox.appendChild(d);aiBox.scrollTop=aiBox.scrollHeight;return d}
    const items=document.querySelectorAll('.press-item');if(items.length>0){const obs=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');obs.unobserve(e.target);}});},{threshold:.1});items.forEach(it=>obs.observe(it));}
    const imgs=[...document.querySelectorAll('.press-item img')];if(imgs.length>0){const lb=document.getElementById('lightbox'),lbImg=document.getElementById('lbImg');let cur=0;const show=i=>(cur=i,lbImg.src=imgs[i].src,lb.classList.add('show'));const close=()=>lb.classList.remove('show');imgs.forEach((im,i)=>im.onclick=()=>show(i));document.getElementById('lbClose').onclick=close;lb.onclick=e=>{if(e.target===lb)close();};const nav=d=>show((cur+d+imgs.length)%imgs.length);document.getElementById('lbPrev').onclick=()=>nav(-1);document.getElementById('lbNext').onclick=()=>nav(1);document.onkeydown=e=>{if(!lb.classList.contains('show'))return;if(e.key==='Escape')close();if(e.key==='ArrowRight')nav(1);if(e.key==='ArrowLeft')nav(-1);}}
  })();
  </script>
</body>
</html>