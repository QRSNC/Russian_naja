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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>About Me – Russian Odyssey</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800;900&display=swap" rel="stylesheet">
  <style nonce="<?= $nonce ?>">
    :root{--primary:#f28b82;}
    *,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
    body{font-family:'Poppins',sans-serif;background:#000;color:#fff;overflow-x:hidden}

    /* Diğer tüm CSS kodları aynı kalmıştır... */
    .site-logo{position:fixed;top:20px;left:24px;width:56px;height:56px;border-radius:50%;overflow:hidden;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.2);box-shadow:0 4px 12px rgba(0,0,0,.3);z-index:1001}
    .site-logo img{width:100%;height:100%;object-fit:cover}
    .navbar{position:fixed;top:20px;left:50%;transform:translateX(-50%);display:flex;gap:16px;padding:12px 24px;border-radius:24px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.24);backdrop-filter:blur(22px) saturate(160%);box-shadow:0 16px 32px rgba(242,139,130,.35);width:max-content;max-width:95vw;z-index:1000}
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
    .section{position:relative;max-width:900px;margin:120px auto;padding:80px 40px;border-radius:24px;overflow:hidden;opacity:0;transform:translateY(60px);transition:opacity .8s,transform .8s}
    .section.show{opacity:1;transform:translateY(0)}
    .section::before{content:'';position:absolute;inset:0;background-image:var(--img);background-size:cover;background-position:center;opacity:.2;filter:brightness(.85);z-index:-1; transition: opacity 0.3s ease;}
    .section h2{font-size:2.4rem;font-weight:900;margin-bottom:18px;background:linear-gradient(90deg,var(--primary),#ffb7b2 60%,var(--primary));-webkit-background-clip:text;-webkit-text-fill-color:transparent}
    .section p,.section ul{font-size:1.05rem;line-height:1.6;opacity:.9}
    .section ul{margin-left:20px;list-style:disc}
    #s1::before { --img: url('images/t1.png'); }
    #s2::before { --img: url('images/t2.png'); }
    #s3::before { --img: url('images/t3.png'); }
    #s4::before { --img: url('images/t4.png'); }
    #s5::before { --img: url('images/t5.png'); }
    #s6::before { --img: url('images/t6.png'); }
    #s7::before { --img: url('images/t7.png'); }
    .video-container{position:relative;max-width:900px;margin:80px auto}
    .video-container video{width:100%;border-radius:12px;display:block}
    .video-overlay{position:absolute;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.6);display:flex;align-items:center;justify-content:center;cursor:pointer;border-radius:12px;z-index:2}
    .video-overlay h3{font-size:2rem;background:linear-gradient(90deg,var(--primary),#ffb7b2);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
    .video-controls{display:none;justify-content:center;gap:12px;margin:12px auto;max-width:900px;padding:0 24px}
    .video-controls button,.video-controls select{padding:8px 16px;border:none;border-radius:8px;background:var(--primary);color:#000;font-weight:800;cursor:pointer}
    .video-speed-label { display:flex; align-items:center; gap:4px; color:#fff; }
    .contact-btn{position:fixed;right:32px;bottom:32px;width:72px;height:72px;cursor:pointer;z-index:998}
    .contact-btn img{width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 6px 12px rgba(242,139,130,.4));transition:opacity .3s ease,transform .3s ease}
    #ai-panel{position:fixed;bottom:120px;right:32px;width:320px;background:rgba(0,0,0,.9);padding:16px;border-radius:12px;color:#fff;display:none;z-index:999}
    #ai-panel input,#ai-panel button{width:100%;padding:8px;margin-top:8px;border:none;border-radius:8px}
    #ai-panel button{background:var(--primary);color:#fff;font-weight:bold}
    #ai-response{font-size:.9rem;margin-top:10px;max-height:320px;overflow-y:auto;display:flex;flex-direction:column;gap:4px}
    .kvkk-fixed{position:fixed;bottom:12px;left:16px;background:rgba(0,0,0,.6);color:#eee;font-size:.8rem;padding:6px 12px;border-radius:8px;z-index:999}
    .kvkk-fixed a{color:var(--primary);text-decoration:underline}
    .chat-bubble { max-width: 80%; padding: 10px 14px; }
    .user-bubble { align-self: flex-end; background: var(--primary); color: #000; border-radius: 18px 18px 0 18px; margin: 6px 0 0; }
    .ai-bubble { align-self: flex-start; background: #333; color: #fff; border-radius: 18px 18px 18px 0; margin: 0 0 10px; }

    @media (max-width: 920px) {
      .section, .video-container { padding-left: 15px; padding-right: 15px; margin-left: 15px; margin-right: 15px; }
    }
    @media (max-width: 768px) {
      .navbar { display: none; }
      .hamburger-btn { display: block; }
      .site-logo { top: 15px; left: 15px; width: 48px; height: 48px; }
      .section { margin: 80px auto; padding: 40px 20px; }
      .section h2 { font-size: 2rem; }
      .section p, .section ul { font-size: 0.95rem; }
      .contact-btn { right: 20px; bottom: 30px; width: 60px; height: 60px; }
      #ai-panel { width: calc(100% - 40px); right: 20px; bottom: 100px; max-height: 50vh; }
      #ai-response { max-height: 200px; }
      .kvkk-fixed { bottom: 6px; left: 10px; font-size: .7rem; padding: 4px 8px; }
      .section::before { opacity: 0.3; }
      
      .video-overlay {
        background: #000;
      }
      /* DEĞİŞİKLİK: Mobil için video başlık boyutu biraz daha büyütüldü */
      .video-overlay h3 {
        font-size: 1.3rem; /* Önceki: 1.2rem */
      }
    }
    @media (max-width: 480px) {
      .section { padding: 30px 15px; }
      .section h2 { font-size: 1.8rem; }
      .section p, .section ul { font-size: 0.9rem; }
      
      /* DEĞİŞİKLİK: Daha küçük mobil ekranlar için başlık biraz daha büyütüldü */
      .video-overlay h3 {
        font-size: 1.1rem; /* Önceki: 1.0rem */
        padding: 0 10px;
      }
    }
  </style>
</head>
<body>

  <a href="index" class="site-logo"><img src="logo.png" alt="Logo"></a>
  <button class="hamburger-btn"><span></span><span></span><span></span></button>
  <div class="mobile-menu"><a href="index">Home</a><a href="about">About Me</a><a href="link">Let's Start</a><a href="press">Testimonials</a></div>
  <nav class="navbar"><a href="index">Home</a><a href="about">About Me</a><a href="link">Let's Start</a><a href="press">Testimonials</a></nav>

  <section id="s1" class="section">
    <h2>Hello, I’m Naja</h2>
    <p>Hello! My name is Naja. I’m sure you’re here because you want to learn Russian or are already studying it. Great! First, tell me about yourself, then — about me.</p>
  </section>
  <section id="s2" class="section">
    <h2>Why Do You Need Russian?</h2>
    <ul>
      <li>For hobby • For work • To enrich your résumé</li>
      <li>For travel • To follow MMA &amp; football stars</li>
      <li>To meet and build relationships with native speakers</li>
    </ul>
  </section>
  <section id="s3" class="section">
    <h2>Real Success Stories</h2>
    <ul>
      <li>An MMA fan from New Zealand learned to understand interviews with Makhachev &amp; Nurmagomedov.</li>
      <li>A young man from Jordan wanted to marry a Russian-speaking partner — they’re now happily married!</li>
      <li>A student from Poland aced her Russian school-exam with top marks.</li>
    </ul>
  </section>
  <section id="s4" class="section">
    <h2>Global Classroom</h2>
    <p>My students come from New Zealand, Turkey, the USA, Germany, South Korea, Bulgaria, Poland, the UAE, Jordan, Australia, Fiji and many other countries.</p>
  </section>
  <section id="s5" class="section">
    <h2>How I Help You Succeed</h2>
    <ul>
      <li>University degree in “Russian as a Foreign Language”.</li>
      <li>Many years of practical teaching experience.</li>
      <li>Individual approach and clear lesson planning.</li>
      <li>Deep understanding of each student’s motivation.</li>
    </ul>
  </section>
  <section id="s6" class="section">
    <h2>Teaching Methods</h2>
    <ul>
      <li>From the very first minute I speak exclusively in Russian.</li>
      <li>I use visual aids, puppets and acting techniques.</li>
      <li>Textbooks: <em>Zhivaya rech'</em>, <em>Poekhali</em>, <em>V mire lyudey</em> (advanced).</li>
      <li>Real-world materials: news articles, YouTube videos, interviews, series.</li>
    </ul>
  </section>
  <section id="s7" class="section">
    <h2>Ready to Start?</h2>
    <p>Book a trial lesson and we will get to know each other, identify your current level &amp; goals, and craft a personalized roadmap to Russian fluency.</p>
  </section>

  <div class="video-container">
    <video id="introVideo" playsinline preload="metadata"><source src="images/video.mp4" type="video/mp4">Your browser doesn’t support HTML5 video.</video>
    <div class="video-overlay" id="videoOverlay"><h3>Let’s watch your Russian journey</h3></div>
    <div class="video-controls" id="videoControls">
      <button id="playPauseBtn">Play</button><button id="fullscreenBtn">Fullscreen</button>
      <label class="video-speed-label">
        Speed:
        <select id="speedSelect"><option value="0.5">0.5x</option><option value="1" selected>1x</option><option value="1.5">1.5x</option><option value="2">2x</option></select>
      </label>
    </div>
  </div>

  <div class="contact-btn" title="AI Help"><img src="image.png" alt="AI Help"></div>
  <div id="ai-panel"><input id="ai-input" placeholder="Ask me anything…"><button id="ai-send">Send</button><div id="ai-response"></div></div>
  <div class="kvkk-fixed">Bu site kişisel veri saklamaz. <a href="kvkk.html" target="_blank">KVKK Aydınlatma Metni</a></div>

  <script nonce="<?= $nonce ?>">
  (() => {
    const hamburgerBtn = document.querySelector('.hamburger-btn');
    const mobileMenu = document.querySelector('.mobile-menu');
    hamburgerBtn.addEventListener('click', () => {
      hamburgerBtn.classList.toggle('open');
      mobileMenu.style.display = mobileMenu.style.display === 'flex' ? 'none' : 'flex';
    });

    const obs = new IntersectionObserver(entries=>{
      entries.forEach(e=>{ if(e.isIntersecting) e.target.classList.add('show'); });
    },{rootMargin:'0px 0px -20% 0px'});
    document.querySelectorAll('.section').forEach(s=>obs.observe(s));

    const video = document.getElementById('introVideo');
    const overlay = document.getElementById('videoOverlay');
    const playBtn = document.getElementById('playPauseBtn');
    const fullBtn = document.getElementById('fullscreenBtn');
    const speedSelect = document.getElementById('speedSelect');
    if (video) {
        overlay.addEventListener('click', ()=>{
            overlay.style.display='none';
            video.play();
            document.getElementById('videoControls').style.display='flex';
            playBtn.textContent = 'Pause';
        });
        playBtn.addEventListener('click', ()=>{
            if(video.paused){ video.play(); playBtn.textContent='Pause'; }
            else          { video.pause(); playBtn.textContent='Play'; }
        });
        fullBtn.addEventListener('click', ()=>{
            if(video.requestFullscreen) video.requestFullscreen();
            else if(video.webkitRequestFullscreen) video.webkitRequestFullscreen();
        });
        speedSelect.addEventListener('change', ()=> video.playbackRate = parseFloat(speedSelect.value) );
    }

    const btn = document.querySelector('.contact-btn img'),
          panel = document.getElementById('ai-panel'),
          input = document.getElementById('ai-input'),
          send  = document.getElementById('ai-send'),
          box   = document.getElementById('ai-response');
    const swap = src => { btn.style.opacity='0'; setTimeout(()=>{btn.src=src;btn.style.opacity='1';},150); };
    document.querySelector('.contact-btn').onclick = () => {
      const open = panel.style.display === 'block';
      panel.style.display = open ? 'none' : 'block';
      swap(open ? 'image.png' : 'image2.png');
    };
    input.onkeydown = e => { if (e.key === 'Enter') { e.preventDefault(); send.click(); } };
    send.onclick = async () => {
      const txt = input.value.trim(); if (!txt) return;
      bubble('user', txt); input.value = '';
      const wait = bubble('ai', 'Thinking...');
      try {
        const r = await fetch('send_ai.php', {
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body: new URLSearchParams({message:txt})
        });
        const j = await r.json(); wait.textContent = j.text || 'Sorry, no reply.';
      } catch { wait.textContent = 'Error contacting AI.'; }
    };
    const bubble = (side, text) => {
      const d = document.createElement('div');
      d.textContent = text;
      d.className = 'chat-bubble ' + (side === 'user' ? 'user-bubble' : 'ai-bubble');
      box.appendChild(d);
      box.scrollTop = box.scrollHeight;
      return d;
    };
  })();
  </script>
</body>
</html>