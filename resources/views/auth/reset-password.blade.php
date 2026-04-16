<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QFSWORLD | Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
        .auth-input{width:100%;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:12px 14px 12px 44px;color:#e2e8f0;font-size:14px;font-family:'Inter',sans-serif;transition:all 0.2s;outline:none;}
        .auth-input::placeholder{color:#374151;}
        .auth-input:focus{border-color:#3b82f6;background:rgba(59,130,246,0.07);box-shadow:0 0 0 3px rgba(59,130,246,0.13);}
        .auth-label{display:block;font-size:13px;font-weight:500;color:#94a3b8;margin-bottom:7px;}
        .input-wrap{position:relative;}
        .input-icon{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#4b5563;font-size:13px;pointer-events:none;}
        .input-icon-right{position:absolute;right:14px;top:50%;transform:translateY(-50%);color:#4b5563;font-size:13px;cursor:pointer;transition:color 0.2s;}
        .input-icon-right:hover{color:#94a3b8;}
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
    </style>
</head>
<body>
    <div class="bg-blob bg-blob-1"></div>
    <div class="bg-blob bg-blob-2"></div>
    <div class="grid-overlay"></div>
    <div id="particles-container"></div>

    @if ($errors->count() > 0)
    <div id="ERROR_COPY" style="display:none;">
        @foreach ($errors->all() as $error)
            {{ $error }} <br />
        @endforeach
    </div>
    @endif

    <div style="position:relative;z-index:1;min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:32px 16px;">

        <!-- Logo -->
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:28px;">
            <div class="logo-badge">Q</div>
            <span style="font-size:20px;font-weight:700;color:#fff;letter-spacing:0.06em;">QFSWORLD</span>
        </div>

        <!-- Card -->
        <div class="auth-card" style="width:100%;max-width:420px;padding:36px 32px;">
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:22px;">
                <div class="glow-dot"></div>
                <span style="font-size:12px;color:#64748b;font-weight:500;">Secure Connection</span>
            </div>

            <div style="width:52px;height:52px;background:rgba(37,99,235,0.15);border:1px solid rgba(59,130,246,0.2);border-radius:14px;display:flex;align-items:center;justify-content:center;margin-bottom:18px;">
                <i class="fas fa-shield-alt" style="color:#3b82f6;font-size:20px;"></i>
            </div>

            <h2 style="font-size:22px;font-weight:700;color:#f1f5f9;margin-bottom:6px;">Reset Password</h2>
            <p style="font-size:13px;color:#64748b;margin-bottom:26px;">Create a new secure password for your account.</p>

            <form method="POST" action="{{ route('password.update') }}" id="reset-form">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div style="margin-bottom:16px;">
                    <label class="auth-label" for="email">Email Address</label>
                    <div class="input-wrap">
                        <i class="far fa-envelope input-icon"></i>
                        <input class="auth-input" id="email" name="email" type="email"
                            placeholder="you@example.com" value="{{ old('email', $request->email) }}" required autofocus />
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <label class="auth-label" for="password">New Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock input-icon"></i>
                        <input class="auth-input" id="password" name="password" type="password"
                            placeholder="Min. 8 characters" required style="padding-right:44px;" />
                        <i class="far fa-eye input-icon-right" id="pw-toggle"></i>
                    </div>
                    <div style="height:4px;background:rgba(255,255,255,0.07);border-radius:2px;overflow:hidden;margin-top:8px;">
                        <div id="strength-bar" style="height:100%;width:0;border-radius:2px;transition:all 0.3s;"></div>
                    </div>
                    <div id="strength-label" style="font-size:11px;color:#475569;margin-top:4px;"></div>
                </div>

                <div style="margin-bottom:24px;">
                    <label class="auth-label" for="password_confirmation">Confirm New Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock input-icon"></i>
                        <input class="auth-input" id="password_confirmation" name="password_confirmation"
                            type="password" placeholder="Repeat new password" required style="padding-right:44px;" />
                        <i class="far fa-eye input-icon-right" id="pw-confirm-toggle"></i>
                    </div>
                    <div id="pw-match" style="font-size:11px;margin-top:5px;"></div>
                </div>

                <button type="submit" class="btn-primary" id="submit-btn">
                    <i class="fas fa-check-circle" style="font-size:13px;"></i>
                    Reset Password
                </button>
            </form>

            <div style="text-align:center;margin-top:20px;">
                <a href="{{ route('login') }}" class="auth-link" style="font-size:13px;display:inline-flex;align-items:center;gap:6px;">
                    <i class="fas fa-arrow-left" style="font-size:11px;"></i> Back to Sign In
                </a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('pw-toggle').addEventListener('click', function() {
            const pw = document.getElementById('password');
            pw.type = pw.type === 'password' ? 'text' : 'password';
            this.classList.toggle('fa-eye'); this.classList.toggle('fa-eye-slash');
        });
        document.getElementById('pw-confirm-toggle').addEventListener('click', function() {
            const pw = document.getElementById('password_confirmation');
            pw.type = pw.type === 'password' ? 'text' : 'password';
            this.classList.toggle('fa-eye'); this.classList.toggle('fa-eye-slash');
        });
        document.getElementById('password').addEventListener('input', function() {
            const v = this.value;
            const bar = document.getElementById('strength-bar');
            const lbl = document.getElementById('strength-label');
            let score = 0;
            if (v.length >= 8) score++;
            if (/[A-Z]/.test(v)) score++;
            if (/[0-9]/.test(v)) score++;
            if (/[^A-Za-z0-9]/.test(v)) score++;
            const cfg = ['','#ef4444:25%:Weak','#f97316:50%:Fair','#eab308:75%:Good','#22c55e:100%:Strong'];
            if (score && cfg[score]) { const [c,w,t]=cfg[score].split(':'); bar.style.width=w; bar.style.background=c; lbl.style.color=c; lbl.textContent=t; }
            else { bar.style.width='0'; lbl.textContent=''; }
        });
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const pw = document.getElementById('password').value;
            const el = document.getElementById('pw-match');
            if (!this.value) { el.textContent=''; return; }
            if (this.value === pw) { el.style.color='#22c55e'; el.textContent='✓ Passwords match'; }
            else { el.style.color='#ef4444'; el.textContent='✗ Passwords do not match'; }
        });
        document.getElementById('reset-form').addEventListener('submit', function() {
            const btn = document.getElementById('submit-btn');
            btn.innerHTML='<i class="fas fa-circle-notch fa-spin"></i> Resetting...';
            btn.disabled=true;
        });
        (function(){const c=document.getElementById('particles-container');for(let i=0;i<25;i++){const p=document.createElement('div');p.classList.add('particle');const s=Math.random()*3+1;p.style.cssText=`width:${s}px;height:${s}px;left:${Math.random()*100}vw;top:${Math.random()*100}vh;animation:float-up ${Math.random()*15+8}s linear ${Math.random()*6}s infinite;`;c.appendChild(p);}})();
        document.addEventListener('DOMContentLoaded',function(){const el=document.getElementById('ERROR_COPY');if(el&&el.innerHTML.trim()!=='')swal("Error",el.innerText.trim(),"error");});
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];s1.async=true;s1.src='https://embed.tawk.to/69c5ab7a92329d1c3229c49e/1jkm2bm2t';s1.charset='UTF-8';s1.setAttribute('crossorigin','*');s0.parentNode.insertBefore(s1,s0);})();
    </script>
    <!--End of Tawk.to Script-->
</body>
</html>
