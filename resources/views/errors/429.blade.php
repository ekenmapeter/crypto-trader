<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>429 — Too Many Requests | QFSWORLD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        body{background:#080d1a;font-family:'Inter',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;overflow:hidden;color:#e2e8f0;}
        .blob{position:fixed;border-radius:50%;filter:blur(100px);opacity:.12;pointer-events:none;z-index:0;}
        .blob-1{width:600px;height:600px;background:#d97706;top:-200px;left:-150px;animation:drift1 14s ease-in-out infinite alternate;}
        .blob-2{width:500px;height:500px;background:#b45309;bottom:-150px;right:-100px;animation:drift2 16s ease-in-out infinite alternate;}
        @keyframes drift1{from{transform:translate(0,0);}to{transform:translate(60px,40px);}}
        @keyframes drift2{from{transform:translate(0,0);}to{transform:translate(-50px,-30px);}}
        .grid-overlay{position:fixed;inset:0;z-index:0;pointer-events:none;background-image:linear-gradient(rgba(59,130,246,.04) 1px,transparent 1px),linear-gradient(90deg,rgba(59,130,246,.04) 1px,transparent 1px);background-size:40px 40px;}
        .particle{position:fixed;border-radius:50%;background:rgba(245,158,11,.4);pointer-events:none;z-index:0;}
        @keyframes float-up{0%{transform:translateY(0);opacity:0;}50%{opacity:.6;}100%{transform:translateY(-100vh);opacity:0;}}
        .status-bar{position:fixed;top:0;left:0;right:0;height:3px;z-index:20;background:linear-gradient(90deg,#d97706,#f59e0b,#fbbf24);}
        .logo{position:fixed;top:24px;left:32px;z-index:10;display:flex;align-items:center;gap:10px;text-decoration:none;}
        .logo-badge{width:36px;height:36px;background:linear-gradient(135deg,#2563eb,#3b82f6);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:800;color:white;}
        .logo-name{font-size:15px;font-weight:700;color:#fff;letter-spacing:.06em;}
        .card{position:relative;z-index:1;background:rgba(13,21,42,.85);border:1px solid rgba(245,158,11,.2);border-radius:24px;padding:56px 48px;max-width:540px;width:100%;text-align:center;backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);box-shadow:0 30px 80px rgba(0,0,0,.6);animation:card-in .6s cubic-bezier(.34,1.56,.64,1) forwards;}
        @keyframes card-in{from{opacity:0;transform:translateY(30px) scale(.96);}to{opacity:1;transform:translateY(0) scale(1);}}
        .error-code{font-size:110px;font-weight:900;line-height:1;background:linear-gradient(135deg,#d97706,#f59e0b,#fbbf24);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;letter-spacing:-5px;margin-bottom:4px;animation:code-pulse 3s ease-in-out infinite;}
        @keyframes code-pulse{0%,100%{filter:brightness(1);}50%{filter:brightness(1.25);}}
        .icon-wrap{width:80px;height:80px;background:rgba(217,119,6,.1);border:1px solid rgba(245,158,11,.25);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;animation:warn-pulse 1.5s ease-in-out infinite;}
        @keyframes warn-pulse{0%,100%{box-shadow:0 0 0 0 rgba(245,158,11,.25);}50%{box-shadow:0 0 20px 8px rgba(245,158,11,.1);}}
        .error-title{font-size:28px;font-weight:800;color:#f1f5f9;margin-bottom:10px;}
        .error-msg{font-size:15px;color:#64748b;line-height:1.7;margin-bottom:28px;}
        /* Cool-down timer */
        .cooldown-wrap{background:rgba(217,119,6,.07);border:1px solid rgba(245,158,11,.15);border-radius:12px;padding:20px;margin-bottom:28px;}
        .cooldown-label{font-size:12px;color:#64748b;margin-bottom:8px;text-transform:uppercase;letter-spacing:.06em;}
        .cooldown-timer{font-size:40px;font-weight:800;color:#fbbf24;font-variant-numeric:tabular-nums;}
        .cooldown-sub{font-size:12px;color:#475569;margin-top:6px;}
        .btn-group{display:flex;flex-direction:column;gap:12px;}
        .btn-primary{display:flex;align-items:center;justify-content:center;gap:8px;background:linear-gradient(135deg,#2563eb,#3b82f6);color:#fff;border:none;border-radius:12px;padding:14px 24px;font-size:15px;font-weight:600;cursor:pointer;text-decoration:none;transition:all .2s;font-family:'Inter',sans-serif;}
        .btn-primary:hover{background:linear-gradient(135deg,#1d4ed8,#2563eb);box-shadow:0 8px 25px rgba(37,99,235,.4);transform:translateY(-1px);}
        .btn-secondary{display:flex;align-items:center;justify-content:center;gap:8px;background:rgba(255,255,255,.05);color:#94a3b8;border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:13px 24px;font-size:14px;font-weight:500;cursor:pointer;text-decoration:none;transition:all .2s;font-family:'Inter',sans-serif;}
        .btn-secondary:hover{background:rgba(255,255,255,.09);color:#e2e8f0;}
        @media(max-width:600px){.card{padding:40px 24px;margin:16px;}.error-code{font-size:80px;}}
    </style>
</head>
<body>
    <div class="status-bar"></div>
    <a href="{{ url('/') }}" class="logo"><div class="logo-badge">Q</div><span class="logo-name">QFSWORLD</span></a>
    <div class="blob blob-1"></div><div class="blob blob-2"></div>
    <div class="grid-overlay"></div>
    <div id="particles"></div>

    <div class="card">
        <div class="icon-wrap"><span style="font-size:32px;">⚠️</span></div>
        <div class="error-code">429</div>
        <h1 class="error-title">Too Many Requests</h1>
        <p class="error-msg">You've made too many requests in a short period. Please slow down and try again after the cool-down period.</p>

        <div class="cooldown-wrap">
            <div class="cooldown-label">Cool-down period</div>
            <div class="cooldown-timer" id="cooldown">1:00</div>
            <div class="cooldown-sub">Requests will be available again shortly</div>
        </div>

        <div class="btn-group">
            <button onclick="window.location.reload()" class="btn-primary" id="retry-btn" disabled style="opacity:.5;cursor:not-allowed;">
                <i class="fas fa-redo" style="font-size:13px;"></i> <span id="retry-label">Please wait...</span>
            </button>
            <a href="{{ url('/') }}" class="btn-secondary">
                <i class="fas fa-home" style="font-size:12px;"></i> Return to Home
            </a>
        </div>
    </div>

    <script>
        let cd = 60;
        const el = document.getElementById('cooldown');
        const btn = document.getElementById('retry-btn');
        const lbl = document.getElementById('retry-label');
        const t = setInterval(() => {
            cd--;
            const m = Math.floor(cd/60), s = cd%60;
            el.textContent = `${m}:${s.toString().padStart(2,'0')}`;
            if (cd <= 0) {
                clearInterval(t);
                btn.disabled = false; btn.style.opacity = '1'; btn.style.cursor = 'pointer';
                lbl.textContent = 'Try Again Now';
                el.textContent = 'Ready!'; el.style.color = '#34d399';
            }
        }, 1000);
        (function(){const c=document.getElementById('particles');for(let i=0;i<30;i++){const p=document.createElement('div');p.className='particle';const s=Math.random()*3+1;p.style.cssText=`width:${s}px;height:${s}px;left:${Math.random()*100}vw;top:${Math.random()*100}vh;animation:float-up ${Math.random()*15+8}s linear ${Math.random()*6}s infinite;`;c.appendChild(p);}})();
    </script>
</body>
</html>
