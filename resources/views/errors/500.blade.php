<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 — Server Error | QFSWORLD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        body{background:#080d1a;font-family:'Inter',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;overflow:hidden;color:#e2e8f0;}
        .blob{position:fixed;border-radius:50%;filter:blur(100px);opacity:.12;pointer-events:none;z-index:0;}
        .blob-1{width:600px;height:600px;background:#7c3aed;top:-200px;left:-150px;animation:drift1 14s ease-in-out infinite alternate;}
        .blob-2{width:500px;height:500px;background:#dc2626;bottom:-150px;right:-100px;animation:drift2 16s ease-in-out infinite alternate;}
        @keyframes drift1{from{transform:translate(0,0);}to{transform:translate(60px,40px);}}
        @keyframes drift2{from{transform:translate(0,0);}to{transform:translate(-50px,-30px);}}
        .grid-overlay{position:fixed;inset:0;z-index:0;pointer-events:none;background-image:linear-gradient(rgba(59,130,246,.04) 1px,transparent 1px),linear-gradient(90deg,rgba(59,130,246,.04) 1px,transparent 1px);background-size:40px 40px;}
        .particle{position:fixed;border-radius:50%;background:rgba(124,58,237,.4);pointer-events:none;z-index:0;}
        @keyframes float-up{0%{transform:translateY(0);opacity:0;}50%{opacity:.6;}100%{transform:translateY(-100vh);opacity:0;}}
        .status-bar{position:fixed;top:0;left:0;right:0;height:3px;z-index:20;background:linear-gradient(90deg,#7c3aed,#8b5cf6,#a78bfa);}
        .logo{position:fixed;top:24px;left:32px;z-index:10;display:flex;align-items:center;gap:10px;text-decoration:none;}
        .logo-badge{width:36px;height:36px;background:linear-gradient(135deg,#2563eb,#3b82f6);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:800;color:white;}
        .logo-name{font-size:15px;font-weight:700;color:#fff;letter-spacing:.06em;}
        .card{position:relative;z-index:1;background:rgba(13,21,42,.85);border:1px solid rgba(124,58,237,.2);border-radius:24px;padding:56px 48px;max-width:540px;width:100%;text-align:center;backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);box-shadow:0 30px 80px rgba(0,0,0,.6);animation:card-in .6s cubic-bezier(.34,1.56,.64,1) forwards;}
        @keyframes card-in{from{opacity:0;transform:translateY(30px) scale(.96);}to{opacity:1;transform:translateY(0) scale(1);}}
        .error-code{font-size:110px;font-weight:900;line-height:1;background:linear-gradient(135deg,#7c3aed,#8b5cf6,#a78bfa);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;letter-spacing:-5px;margin-bottom:4px;animation:code-pulse 3s ease-in-out infinite;}
        @keyframes code-pulse{0%,100%{filter:brightness(1);}50%{filter:brightness(1.25);}}
        .icon-wrap{width:80px;height:80px;background:rgba(124,58,237,.1);border:1px solid rgba(124,58,237,.25);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;animation:glow-pulse 2.5s ease-in-out infinite;}
        @keyframes glow-pulse{0%,100%{box-shadow:0 0 0 0 rgba(124,58,237,.2);}50%{box-shadow:0 0 20px 8px rgba(124,58,237,.1);}}
        .error-title{font-size:28px;font-weight:800;color:#f1f5f9;margin-bottom:10px;}
        .error-msg{font-size:15px;color:#64748b;line-height:1.7;margin-bottom:28px;}
        .info-box{background:rgba(124,58,237,.07);border:1px solid rgba(124,58,237,.15);border-radius:12px;padding:16px 20px;margin-bottom:28px;text-align:left;}
        .info-box p{font-size:13px;color:#c4b5fd;line-height:1.7;}
        /* Crash animation */
        .crash-dots{display:flex;justify-content:center;gap:8px;margin-bottom:28px;}
        .crash-dot{width:10px;height:10px;border-radius:50%;background:#8b5cf6;animation:crash-bounce 1.4s ease-in-out infinite;}
        .crash-dot:nth-child(2){animation-delay:.2s;}
        .crash-dot:nth-child(3){animation-delay:.4s;}
        @keyframes crash-bounce{0%,80%,100%{transform:scale(0);opacity:.5;}40%{transform:scale(1);opacity:1;}}
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
        <div class="icon-wrap"><span style="font-size:32px;">⚡</span></div>
        <div class="error-code">500</div>
        <h1 class="error-title">Internal Server Error</h1>
        <p class="error-msg">Something went wrong on our end. Our team has been automatically notified and is working to fix the issue.</p>

        <div class="crash-dots">
            <div class="crash-dot"></div>
            <div class="crash-dot"></div>
            <div class="crash-dot"></div>
        </div>

        <div class="info-box">
            <p>🔧 <strong style="color:#a78bfa;">Don't worry — it's not you, it's us.</strong> This is a temporary issue and should be resolved shortly. Please try again in a few minutes.</p>
        </div>
        <div class="btn-group">
            <button onclick="window.location.reload()" class="btn-primary"><i class="fas fa-redo" style="font-size:13px;"></i> Try Again</button>
            <a href="{{ url('/') }}" class="btn-secondary"><i class="fas fa-home" style="font-size:12px;"></i> Return to Home</a>
        </div>
    </div>

    <script>
        (function(){const c=document.getElementById('particles');for(let i=0;i<30;i++){const p=document.createElement('div');p.className='particle';const s=Math.random()*3+1;p.style.cssText=`width:${s}px;height:${s}px;left:${Math.random()*100}vw;top:${Math.random()*100}vh;animation:float-up ${Math.random()*15+8}s linear ${Math.random()*6}s infinite;`;c.appendChild(p);}})();
    </script>
</body>
</html>
