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

// --- LİNK KLASÖRLERİNİ TARAMA (Media/ İÇİNDEN) ---

$links = [];
$baseDir = __DIR__;

// 'Media' klasörünün içindeki klasörleri bul
$directories = glob($baseDir . '/Media/*', GLOB_ONLYDIR);

foreach ($directories as $dir) {
    $platform = basename($dir);
    
    $numberFile = $dir . '/number.txt';
    $nameFile = $dir . '/name.txt';
    $linkFile = $dir . '/link.txt';
    $logoFile = $dir . '/logo.png'; 
    $logoUrl = 'Media/' . $platform . '/logo.png';

    if (
        file_exists($numberFile) &&
        file_exists($nameFile) &&
        file_exists($linkFile) &&
        file_exists($logoFile)
    ) {
        $number = (int)trim(file_get_contents($numberFile));
        $name = trim(file_get_contents($nameFile));
        $link_raw = trim(file_get_contents($linkFile)); // Ham linki oku

        // === DÜZELTME: LİNK PROTOKOL KONTROLÜ ===
        $link = $link_raw; // Varsayılan değer

        // Eğer link bir protokolle (örn: http:, https:, mailto:, tel:) veya '//' ile başlamıyorsa
        if (!preg_match('/^([a-z]+:|\/\/)/i', $link_raw)) {
            
            // Eğer geçerli bir e-posta adresiyse, 'mailto:' ekle
            if (filter_var($link_raw, FILTER_VALIDATE_EMAIL)) {
                $link = 'mailto:' . $link_raw;
            } 
            // Değilse (örn: www.example.com), başına '//' ekle
            // Bu, onu tarayıcı için mutlak bir URL ('//www.example.com') yapar
            else {
                $link = '//' . $link_raw;
            }
        }
        // === DÜZELTME SONU ===

        // Link bilgilerini diziye ekle
        $links[] = [
            'platform' => $platform,
            'number'   => $number,
            'name'     => $name,
            'link'     => $link, // Düzeltilmiş linki kullan
            'logo'     => $logoUrl
        ];
    }
}

// Linkleri 'number.txt' içeriğine göre sırala
usort($links, function($a, $b) {
    return $a['number'] <=> $b['number'];
});

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Naja's Links – Connect With Me</title>
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800;900&display.swap" rel="stylesheet" />
  <style nonce="<?= $nonce ?>">
    /* === TEMEL STİLLER === */
    html{overflow-y:scroll;}
    :root{
      --primary:#f28b82; /* Ana pembe renk */
    }
    *{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
    body{min-height:100vh;background:#000;color:#fff;overflow-x:hidden;}

    /* === ORTAK BİLEŞENLER (DİĞER SAYFALARLA AYNI) === */
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
      opacity: 0;
      transition: opacity .3s ease;
      z-index: -1;
    }
    .navbar a:hover::before { opacity: 1 }
    .navbar a:hover { color: var(--primary) }
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
    .site-logo img { width: 100%; height: 100%; object-fit: cover }
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
    .hamburger-btn span:last-child { margin-bottom: 0; }
    .hamburger-btn.open span:nth-child(1) { transform: translateY(10px) rotate(45deg); }
    .hamburger-btn.open span:nth-child(2) { opacity: 0; }
    .hamburger-btn.open span:nth-child(3) { transform: translateY(-10px) rotate(-45deg); }
    .mobile-menu {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, .7);
      backdrop-filter: blur(22px) saturate(160%);
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
    .mobile-menu a:hover { background-color: rgba(255, 255, 255, .1); }
    .contact-btn{position:fixed;right:32px;bottom:32px;width:72px;height:72px;cursor:pointer;z-index:998}
    .contact-btn img{width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 6px 12px rgba(242,139,130,.4));transition:opacity .3s ease,transform .3s ease}
    .contact-btn:hover img{transform:scale(1.06) rotate(4deg)}
    #ai-panel{position:fixed;bottom:120px;right:32px;width:320px;background:rgba(0,0,0,.9);padding:16px;border-radius:12px;color:#fff;display:none;z-index:999}
    #ai-panel input,#ai-panel button{width:100%;padding:8px;margin-top:8px;border-radius:8px;border:none}
    #ai-panel button{background:var(--primary);color:#fff;font-weight:bold}
    #ai-response{font-size:.9rem;margin-top:10px;max-height:320px;overflow-y:auto;display:flex;flex-direction:column;gap:4px}
    .kvkk-fixed{position:fixed;bottom:12px;left:16px;background:rgba(0,0,0,.6);color:#eee;font-size:.8rem;padding:6px 12px;border-radius:8px;z-index:999}
    .kvkk-fixed a{color:var(--primary);text-decoration:underline}
    .chat-bubble { max-width: 80%; padding: 10px 14px; }
    .user-bubble { align-self: flex-end; background: var(--primary); color: #000; border-radius: 18px 18px 0 18px; margin: 6px 0 0; }
    .ai-bubble { align-self: flex-start; background: #333; color: #fff; border-radius: 18px 18px 18px 0; margin: 0 0 10px; }

    /* === BU SAYFAYA ÖZEL STİLLER === */
    .links-header {
      padding-top: 140px; 
      padding-bottom: 40px;
      text-align: center;
      max-width: 680px;
      margin: 0 auto;
      padding-left: 20px;
      padding-right: 20px;
    }
    .links-header h1 {
      font-size: 3.4rem;
      font-weight: 900;
      background: linear-gradient(90deg, var(--primary), #ffb7b2 60%, var(--primary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 16px;
    }
    .links-header p {
      font-size: 1.15rem;
      line-height: 1.6;
      opacity: .88;
    }
    .links-container {
      max-width: 680px;
      margin: 0 auto 120px;
      padding: 0 20px;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    /* Link Kutusu (LED Efekti) */
    .link-box {
      display: flex;
      align-items: center;
      padding: 16px 20px;
      text-decoration: none;
      color: #fff;
      font-weight: 800;
      font-size: 1.1rem;
      background: transparent; 
      border: 2px solid var(--primary);
      box-shadow: 0 0 8px 0px var(--primary);
      border-radius: 40px; 
      transition: transform .25s ease, box-shadow .25s ease;
    }
    .link-box:hover {
      transform: scale(1.03);
      box-shadow: 0 0 16px 2px var(--primary);
    }
    .link-box img {
      width: 48px;
      height: 48px;
      object-fit: contain;
      margin-right: 20px;
      border-radius: 50%; 
    }

    /* === MOBİL UYUMLULUK === */
    @media (max-width: 768px) {
      .navbar { display: none; }
      .hamburger-btn { display: block; }
      .site-logo {
        top: 15px;
        left: 15px;
        width: 48px;
        height: 48px;
      }
      .contact-btn {
        right: 20px;
        bottom: 20px;
        width: 60px;
        height: 60px;
      }
      .contact-btn:hover img { transform: none; }
      #ai-panel {
        width: calc(100% - 40px);
        right: 20px;
        bottom: 100px;
        max-height: 50vh;
      }
      #ai-response { max-height: 200px; }
      .kvkk-fixed {
        bottom: 6px;
        left: 10px;
        font-size: .7rem;
        padding: 4px 8px;
      }
      .links-header { padding-top: 120px; }
      .links-header h1 { font-size: 2.5rem; }
      .links-header p { font-size: 1rem; }
      .link-box {
        padding: 12px 15px;
        font-size: 1rem;
        border-radius: 30px;
      }
      .link-box img {
        width: 40px;
        height: 40px;
        margin-right: 15px;
      }
    }
  </style>
</head>
<body>

  <a href="index" class="site-logo"><img src="logo.png" alt="Site Logo" /></a>

  <button class="hamburger-btn">
    <span></span>
    <span></span>
    <span></span>
  </button>

  <div class="mobile-menu">
    <a href="index">GO TO MY WEB SITE</a>
  </div>

  <nav class="navbar">
    <a href="index">GO TO MY WEB SITE</a>
  </nav>

  <header class="links-header">
    <h1>Naja's Links</h1>
    <p>Connect with me through my official social media channels and platforms below. Click any link to get in touch or see my content.</p>
  </header>

  <main class="links-container">
    
    <?php if (empty($links)): ?>
      <p style="text-align: center; opacity: 0.7;">No links are configured yet. (Check 'Media' folder)</p>
    <?php else: ?>
      <?php foreach ($links as $item): ?>
        <?php
          // Güvenli HTML çıkışı için değişkenleri hazırla
          $name_safe = htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8');
          // Düzeltilmiş linki (protokol eklenmiş) güvenli hale getir
          $link_safe = htmlspecialchars($item['link'], ENT_QUOTES, 'UTF-8'); 
          $logo_safe = htmlspecialchars($item['logo'], ENT_QUOTES, 'UTF-8');
        ?>
        
        <a href="<?php echo $link_safe; ?>" 
           class="link-box" 
           target="_blank"  
           rel="noopener noreferrer">
          
          <img src="<?php echo $logo_safe; ?>" alt="<?php echo $name_safe; ?> logo" />
          <span><?php echo $name_safe; ?></span>
        </a>
      
      <?php endforeach; ?>
    <?php endif; ?>

  </main>
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
    // Mobil Menü (Hamburger) Fonksiyonu
    const hamburgerBtn = document.querySelector('.hamburger-btn');
    const mobileMenu = document.querySelector('.mobile-menu');
    hamburgerBtn.addEventListener('click', () => {
      hamburgerBtn.classList.toggle('open');
      mobileMenu.style.display = mobileMenu.style.display === 'flex' ? 'none' : 'flex';
    });

    // AI Panel Fonksiyonu
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
      d.className = 'chat-bubble ' + (side === 'user' ? 'user-bubble' : 'ai-bubble');
      box.appendChild(d); box.scrollTop = box.scrollHeight; return d;
    };
  })();
  </script>
</body>
</html>