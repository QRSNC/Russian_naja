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
 header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 <meta charset="UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <title>Russian Language Odyssey – Home</title>
 <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800;900&display=swap" rel="stylesheet" />
 <style nonce="<?= $nonce ?>">
   html{overflow-y:scroll;}
   :root{--primary:#f28b82;}
   *{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
   body{min-height:100vh;background:#000;color:#fff;overflow-x:hidden;}

   /* NAVBAR & LOGO */
   .navbar {
     position: fixed;
     top: 20px;
     left: 50%;
     transform: translateX(-50%);
     display: flex;
     gap: 16px;
     padding: 12px 24px;
     border-radius: 24px;
     background: rgba(255, 255, 255, .08);
     border: 1px solid rgba(255, 255, 255, .24);
     backdrop-filter: blur(22px) saturate(160%);
     -webkit-backdrop-filter: blur(22px) saturate(160%);
     box-shadow: 0 16px 32px rgba(242, 139, 130, .35);
     width: max-content;
     max-width: 95vw;
     justify-content: center;
     z-index: 1000;
   }
   .navbar a {
     position: relative;
     display: inline-block;
     padding: 10px 20px;
     border-radius: 16px;
     color: #fff;
     text-decoration: none;
     font-weight: 800;
     font-size: .95rem;
     letter-spacing: .5px;
     white-space: nowrap;
     transition: color .25s ease;
   }
   .navbar a::before {
     content: '';
     position: absolute;
     inset: 0;
     border-radius: inherit;
     background: rgba(255, 255, 255, .12);
     border: 1px solid rgba(255, 255, 255, .24);
     backdrop-filter: blur(18px) saturate(160%);
     -webkit-backdrop-filter: blur(18px) saturate(160%);
     opacity: 0;
     transition: opacity .3s ease;
     z-index: -1;
   }
   .navbar a:hover::before {
     opacity: 1
   }
   .navbar a:hover {
     color: var(--primary)
   }
   .site-logo {
     position: fixed;
     top: 20px;
     left: 24px;
     width: 56px;
     height: 56px;
     border-radius: 50%;
     overflow: hidden;
     background: rgba(255, 255, 255, .05);
     border: 1px solid rgba(255, 255, 255, .2);
     box-shadow: 0 4px 12px rgba(0, 0, 0, .3);
     z-index: 1001;
   }
   .site-logo img {
     width: 100%;
     height: 100%;
     object-fit: cover
   }
   .hamburger-btn {
     position: fixed;
     top: 20px;
     right: 24px;
     width: 40px;
     height: 40px;
     background: none;
     border: none;
     cursor: pointer;
     z-index: 1002;
     display: none;
   }
   .hamburger-btn span {
     display: block;
     width: 100%;
     height: 2px;
     background-color: #fff;
     margin-bottom: 8px;
     transition: transform 0.3s ease, opacity 0.3s ease;
   }
   .hamburger-btn span:last-child {
     margin-bottom: 0;
   }
   .hamburger-btn.open span:nth-child(1) {
     transform: translateY(10px) rotate(45deg);
   }
   .hamburger-btn.open span:nth-child(2) {
     opacity: 0;
   }
   .hamburger-btn.open span:nth-child(3) {
     transform: translateY(-10px) rotate(-45deg);
   }
   .mobile-menu {
     position: fixed;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
     background: rgba(0, 0, 0, .7);
     backdrop-filter: blur(22px) saturate(160%);
     -webkit-backdrop-filter: blur(22px) saturate(160%);
     z-index: 1001;
     display: none;
     flex-direction: column;
     justify-content: center;
     align-items: center;
     gap: 24px;
   }
   .mobile-menu a {
     font-size: 1.5rem;
     font-weight: 800;
     color: #fff;
     text-decoration: none;
     padding: 16px 32px;
     border-radius: 12px;
     transition: background-color 0.3s ease;
   }
   .mobile-menu a:hover {
     background-color: rgba(255, 255, 255, .1);
   }

   /* HERO */
   .hero {
     height: 100vh;
     display: flex;
     flex-direction: column;
     justify-content: center;
     align-items: center;
     text-align: center;
     padding: 0 24px
   }
   .hero h1 {
     font-size: 4.8rem;
     font-weight: 900;
     background: linear-gradient(90deg, var(--primary), #ffb7b2 60%, var(--primary));
     -webkit-background-clip: text;
     -webkit-text-fill-color: transparent;
     background-clip: text;
     margin-bottom: 32px
   }
   .hero p {
     max-width: 720px;
     font-size: 1.25rem;
     line-height: 1.65;
     opacity: .88
   }
   .cta {
     margin-top: 48px
   }
   .cta a {
     text-decoration: none
   }
   .cta button {
     padding: 16px 40px;
     border: none;
     border-radius: 40px;
     background: var(--primary);
     color: #fff;
     font-size: 1rem;
     font-weight: 800;
     cursor: pointer;
     box-shadow: 0 12px 28px rgba(242, 139, 130, .4);
     transition: transform .25s ease, box-shadow .25s ease
   }
   .cta button:hover {
     transform: translateY(-3px);
     box-shadow: 0 16px 32px rgba(242, 139, 130, .55)
   }

   /* ADVANTAGE SECTION */
   .benefits {
     padding: 100px 24px 120px;
     display: grid;
     grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
     gap: 40px;
     max-width: 1400px;
     margin: auto
   }
   .benefit-box {
     position: relative;
     padding: 32px 24px;
     border-radius: 24px;
     background: rgba(255, 255, 255, .05);
     border: 1px solid rgba(255, 255, 255, .12);
     backdrop-filter: blur(22px) saturate(160%);
     -webkit-backdrop-filter: blur(22px) saturate(160%);
     text-align: center;
     transition: transform .25s ease, box-shadow .25s ease
   }
   .benefit-box:hover {
     transform: translateY(-6px);
     box-shadow: 0 14px 32px rgba(242, 139, 130, .35)
   }
   .benefit-box img {
     width: 72px;
     height: 72px;
     margin-bottom: 24px;
     object-fit: contain;
     filter: drop-shadow(0 4px 8px rgba(0, 0, 0, .4))
   }
   .benefit-title {
     font-size: 1.3rem;
     font-weight: 800;
     margin-bottom: 12px;
     color: #fff
   }
   .benefit-desc {
     font-size: .95rem;
     line-height: 1.55;
     opacity: .9
   }

   /* CONTACT BTN & AI PANEL */
   .contact-btn {
     position: fixed;
     right: 32px;
     bottom: 32px;
     width: 72px;
     height: 72px;
     cursor: pointer;
     z-index: 998
   }
   .contact-btn img {
     width: 100%;
     height: 100%;
     object-fit: contain;
     filter: drop-shadow(0 6px 12px rgba(242, 139, 130, .4));
     transition: opacity .3s ease, transform .3s ease
   }
   .contact-btn:hover img {
     transform: scale(1.06) rotate(4deg)
   }
   #ai-panel {
     position: fixed;
     bottom: 120px;
     right: 32px;
     width: 320px;
     background: rgba(0, 0, 0, .9);
     padding: 16px;
     border-radius: 12px;
     color: #fff;
     display: none;
     z-index: 999
   }
   #ai-panel input,
   #ai-panel button {
     width: 100%;
     padding: 8px;
     margin-top: 8px;
     border-radius: 8px;
     border: none
   }
   #ai-panel button {
     background: var(--primary);
     color: #fff;
     font-weight: bold
   }
   #ai-response {
     font-size: .9rem;
     margin-top: 10px;
     max-height: 320px;
     overflow-y: auto;
     display: flex;
     flex-direction: column;
     gap: 4px
   }
   .kvkk-fixed {
     position: fixed;
     bottom: 12px;
     left: 16px;
     background: rgba(0, 0, 0, .6);
     color: #eee;
     font-size: .8rem;
     padding: 6px 12px;
     border-radius: 8px;
     z-index: 999
   }
   .kvkk-fixed a {
     color: var(--primary);
     text-decoration: underline
   }

   /* Mobil Cihazlar İçin Ayarlamalar */
   @media (max-width: 768px) {
     .navbar {
       display: none;
     }
     .hamburger-btn {
       display: block;
     }
     .site-logo {
       top: 15px;
       left: 15px;
       width: 48px;
       height: 48px;
     }
     .hero h1 {
       font-size: 2.8rem;
       margin-bottom: 24px;
     }
     .hero p {
       font-size: 1rem;
       padding: 0 15px;
     }
     .cta button {
       padding: 12px 30px;
       font-size: .9rem;
     }
     .benefits {
       padding: 60px 15px;
       grid-template-columns: 1fr;
       gap: 30px;
     }
     .benefit-box {
       padding: 24px 18px;
     }
     .benefit-box img {
       width: 60px;
       height: 60px;
       margin-bottom: 18px;
     }
     .benefit-title {
       font-size: 1.15rem;
     }
     .benefit-desc {
       font-size: .85rem;
     }
     .contact-btn {
       right: 20px;
       bottom: 20px;
       width: 60px;
       height: 60px;
     }
     /* DEĞİŞİKLİK: Mobil cihazlarda üzerine gelme (hover) efekti sıfırlandı. */
     .contact-btn:hover img {
       transform: none;
     }
     #ai-panel {
       width: calc(100% - 40px);
       right: 20px;
       bottom: 100px;
       max-height: 50vh;
     }
     #ai-response {
       max-height: 200px;
     }
     .kvkk-fixed {
       bottom: 6px;
       left: 10px;
       font-size: .7rem;
       padding: 4px 8px;
     }
   }

   @media (max-width: 480px) {
     .hero h1 {
       font-size: 2.2rem;
     }
     .hero p {
       font-size: 0.9rem;
     }
   }
 </style>
 </head>
 <body>
   <a href="index.php" class="site-logo"><img src="logo.png" alt="Site Logo" /></a>

   <button class="hamburger-btn">
     <span></span>
     <span></span>
     <span></span>
   </button>

   <div class="mobile-menu">
     <a href="index">Home</a>
     <a href="about">About Me</a>
     <a href="link">Let's Start</a>
     <a href="press">Testimonials</a>
   </div>

   <nav class="navbar">
     <a href="index">Home</a>
     <a href="about">About Me</a>
     <a href="link">Let's Start</a>
     <a href="press">Testimonials</a>
   </nav>

   <section class="hero">
     <h1>Master Russian with Confidence</h1>
     <p>Join our immersive journey and unlock the beauty of the Russian language through engaging lessons, cultural insights, and practical resources designed for modern learners.</p>
     <div class="cta"><a href="link.php"><button>Start Learning</button></a></div>
   </section>

   <section class="benefits">
     <div class="benefit-box">
       <img src="images/a1.png" alt="Flexible Schedule">
       <div class="benefit-title">Flexible Schedule</div>
       <div class="benefit-desc">Learn whenever it suits you, without compromising your daily routine.</div>
     </div>
     <div class="benefit-box">
       <img src="images/a2.png" alt="Personal Tutoring">
       <div class="benefit-title">Personal Tutoring</div>
       <div class="benefit-desc">One-on-one sessions focused on your unique goals and pace.</div>
     </div>
     <div class="benefit-box">
       <img src="images/a3.png" alt="Free Trial Lesson">
       <div class="benefit-title">Free Trial Lesson</div>
       <div class="benefit-desc">Experience our personalized approach firsthand to see how we can help you achieve your goals, completely free.</div>
     </div>
     <div class="benefit-box">
       <img src="images/a4.png" alt="Speaking Club">
       <div class="benefit-title">Speaking Club</div>
       <div class="benefit-desc">A relaxed and supportive environment for gaining fluency and confidence through practice.</div>
     </div>
   </section>

   <div class="contact-btn" title="AI Help"><img src="image.png" alt="AI Help" /></div>
   <div id="ai-panel">
     <input type="text" id="ai-input" placeholder="Ask me anything..." autocomplete="off" />
     <button id="ai-send">Send</button>
     <div id="ai-response"></div>
   </div>

   <div class="kvkk-fixed">
     Bu site kişisel veri saklamaz. <a href="kvkk.html" target="_blank">KVKK Aydınlatma Metni</a>
   </div>

   <script nonce="<?= $nonce ?>">
   (() => {
     const hamburgerBtn = document.querySelector('.hamburger-btn');
     const mobileMenu = document.querySelector('.mobile-menu');
     hamburgerBtn.addEventListener('click', () => {
       hamburgerBtn.classList.toggle('open');
       mobileMenu.style.display = mobileMenu.style.display === 'flex' ? 'none' : 'flex';
     });

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
         const r = await fetch('send_ai.php', { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:new URLSearchParams({message:txt}) });
         const j = await r.json(); wait.textContent = j.text || 'Sorry, no reply.';
       } catch { wait.textContent = 'Error contacting AI.'; }
     };
     const bubble = (side,text) => {
       const d = document.createElement('div');
       d.textContent = text;
       d.style.cssText = `align-self:${side==='user'?'flex-end':'flex-start'};background:${side==='user'?'var(--primary)':'#333'};color:${side==='user'?'#000':'#fff'};padding:10px 14px;border-radius:${side==='user'?'18px 18px 0 18px':'18px 18px 18px 0'};max-width:80%;margin:${side==='user'?'6px 0 0':'0 0 10px'};`;
       box.appendChild(d); box.scrollTop = box.scrollHeight; return d;
     };
   })();
   </script>
 </body>
 </html>