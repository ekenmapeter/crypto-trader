<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QFSWORLD | Verify Email</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0;}
        body{background:#080d1a;font-family:'Inter',sans-serif;min-height:100vh;overflow-x:hidden;color:#e2e8f0;}
        .bg-blob{position:fixed;border-radius:50%;filter:blur(90px);opacity:0.12;pointer-events:none;z-index:0;}
        .bg-blob-1{width:500px;height:500px;background:#1d4ed8;top:-120px;left:-100px;animation:drift1 12s ease-in-out infinite alternate;}
        .bg-blob-2{width:400px;height:400px;background:#0ea5e9;bottom:-80px;right:-80px;animation:drift2 15s ease-in-out infinite alternate;}
        @keyframes drift1{from{transform:translate(0,0) scale(1);}to{transform:translate(60px,40px) scale(1.1);}}
        @keyframes drift2{from{transform:translate(0,0) scale(1);}to{transform:translate(-50px,-30px) scale(1.08);}}
        .grid-overlay{position:fixed;inset:0;z-index:0;pointer-events:none;background-image:linear-gradient(rgba(59,130,246,0.04) 1px,transparent 1px),linear-gradient(90deg,rgba(59,130,246,0.04) 1px,transparent 1px);background-size:40px 40px;}
        .auth-card{background:rgba(13,21,42,0.88);border:1px solid rgba(59,130,246,0.18);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border-radius:16px;box-shadow:0 30px 70px rgba(0,0,0,0.55);}
        .btn-primary{width:100%;background:linear-gradient(135deg,#2563eb,#3b82f6);color:#fff;border:none;border-radius:10px;padding:13px 24px;font-size:15px;font-weight:600;cursor:pointer;transition:all 0.2s;display:flex;align-items:center;justify-content:center;gap:8px;font-family:'Inter',sans-serif;}
        .btn-primary:hover{background:linear-gradient(135deg,#1d4ed8,#2563eb);box-shadow:0 8px 25px rgba(37,99,235,0.4);transform:translateY(-1px);}
        .btn-primary:active{transform:translateY(0);}
        .btn-primary:disabled{opacity:0.7;cursor:not-allowed;transform:none;}
        .logo-badge{width:40px;height:40px;background:linear-gradient(135deg,#2563eb,#3b82f6);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;font-weight:800;color:white;flex-shrink:0;}
        .auth-link{color:#3b82f6;text-decoration:none;font-weight:500;transition:color 0.2s;}
        .auth-link:hover{color:#60a5fa;}
        .glow-dot{width:8px;height:8px;border-radius:50%;background:#22c55e;box-shadow:0 0 6px #22c55e,0 0 12px rgba(34,197,94,0.4);animation:pulse-dot 2s ease-in-out infinite;flex-shrink:0;}
        @keyframes pulse-dot{0%,100%{opacity:1;transform:scale(1);}50%{opacity:.6;transform:scale(.85);}}
        .particle{position:fixed;border-radius:50%;background:rgba(59,130,246,0.45);pointer-events:none;z-index:0;}
        @keyframes float-up{0%{transform:translateY(0);opacity:0;}50%{opacity:.6;}100%{transform:translateY(-100vh);opacity:0;}}
        /* Email icon pulse animation */
        @keyframes email-glow{0%,100%{box-shadow:0 0 15px rgba(37,99,235,0.3);}50%{box-shadow:0 0 30px rgba(37,99,235,0.6);}}
        .email-icon-wrap{animation:email-glow 2.5s ease-in-out infinite;}
    </style>
</head>
<body>
    <div class="bg-blob bg-blob-1"></div>
    <div class="bg-blob bg-blob-2"></div>
    <div class="grid-overlay"></div>
    <div id="particles-container"></div>

    <div style="position:relative;z-index:1;min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:32px 16px;">

        <!-- Logo -->
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:28px;">
            <div class="logo-badge">Q</div>
            <span style="font-size:20px;font-weight:700;color:#fff;letter-spacing:0.06em;">QFSWORLD</span>
        </div>

        <!-- Card -->
        <div class="auth-card" style="width:100%;max-width:420px;padding:36px 32px;text-align:center;">
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:22px;justify-content:center;">
                <div class="glow-dot"></div>
                <span style="font-size:12px;color:#64748b;font-weight:500;">Secure Connection</span>
            </div>

            <!-- Animated email icon -->
            <div class="email-icon-wrap" style="width:72px;height:72px;background:rgba(37,99,235,0.12);border:1px solid rgba(59,130,246,0.25);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 22px;">
                <i class="fas fa-envelope-open-text" style="color:#3b82f6;font-size:28px;"></i>
            </div>

            <h2 style="font-size:22px;font-weight:700;color:#f1f5f9;margin-bottom:10px;">Check Your Email</h2>
            <p style="font-size:13px;color:#64748b;margin-bottom:8px;line-height:1.7;">
                Thanks for signing up! Before getting started, please verify your email address by clicking on the link we sent you.
            </p>
            <p style="font-size:13px;color:#64748b;margin-bottom:24px;">Didn't receive an email? We'll resend it below.</p>

            @if (session('status') == 'verification-link-sent')
            <div style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.2);border-radius:10px;padding:12px 16px;margin-bottom:22px;display:flex;align-items:center;gap:10px;text-align:left;">
                <i class="fas fa-check-circle" style="color:#22c55e;font-size:14px;flex-shrink:0;"></i>
                <span style="font-size:13px;color:#86efac;">A new verification link has been sent to your email address!</span>
            </div>
            @endif

            <!-- Resend button -->
            <form method="POST" action="{{ route('verification.send') }}" id="resend-form" style="margin-bottom:14px;">
                @csrf
                <button type="submit" class="btn-primary" id="resend-btn">
                    <i class="fas fa-paper-plane" style="font-size:13px;"></i>
                    Resend Verification Email
                </button>
            </form>

            <!-- Divider -->
            <div style="display:flex;align-items:center;gap:12px;margin:16px 0;">
                <div style="flex:1;height:1px;background:rgba(255,255,255,0.07);"></div>
                <span style="font-size:12px;color:#475569;">or</span>
                <div style="flex:1;height:1px;background:rgba(255,255,255,0.07);"></div>
            </div>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="background:none;border:none;color:#64748b;font-size:13px;cursor:pointer;font-family:'Inter',sans-serif;display:inline-flex;align-items:center;gap:6px;transition:color 0.2s;padding:8px 16px;border-radius:8px;border:1px solid rgba(255,255,255,0.07);"
                    onmouseover="this.style.color='#94a3b8';this.style.background='rgba(255,255,255,0.04)'"
                    onmouseout="this.style.color='#64748b';this.style.background='none'">
                    <i class="fas fa-sign-out-alt" style="font-size:12px;"></i> Sign Out
                </button>
            </form>
        </div>

        <!-- Tips -->
        <div style="margin-top:18px;max-width:420px;width:100%;background:rgba(59,130,246,0.05);border:1px solid rgba(59,130,246,0.1);border-radius:12px;padding:16px 20px;">
            <p style="font-size:12px;color:#64748b;line-height:1.7;">
                <i class="fas fa-info-circle" style="color:#3b82f6;margin-right:6px;"></i>
                Check your spam folder if you don't see the email. Make sure to add <strong style="color:#94a3b8;">noreply@qfsworld.com</strong> to your contacts.
            </p>
        </div>
    </div>

    <script>
        document.getElementById('resend-form').addEventListener('submit', function() {
            const btn = document.getElementById('resend-btn');
            btn.innerHTML='<i class="fas fa-circle-notch fa-spin"></i> Sending...';
            btn.disabled=true;
        });
        (function(){const c=document.getElementById('particles-container');for(let i=0;i<25;i++){const p=document.createElement('div');p.classList.add('particle');const s=Math.random()*3+1;p.style.cssText=`width:${s}px;height:${s}px;left:${Math.random()*100}vw;top:${Math.random()*100}vh;animation:float-up ${Math.random()*15+8}s linear ${Math.random()*6}s infinite;`;c.appendChild(p);}})();
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];s1.async=true;s1.src='https://embed.tawk.to/69c5ab7a92329d1c3229c49e/1jkm2bm2t';s1.charset='UTF-8';s1.setAttribute('crossorigin','*');s0.parentNode.insertBefore(s1,s0);})();
    </script>
    <!--End of Tawk.to Script-->
</body>
</html>
