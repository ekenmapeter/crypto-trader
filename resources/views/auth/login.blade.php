<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QFSWORLD | Secure Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            background: #080d1a;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Animated background blobs */
        .bg-blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            pointer-events: none;
            z-index: 0;
        }
        .bg-blob-1 {
            width: 500px; height: 500px;
            background: #1d4ed8;
            top: -100px; left: -100px;
            animation: drift1 12s ease-in-out infinite alternate;
        }
        .bg-blob-2 {
            width: 400px; height: 400px;
            background: #0ea5e9;
            bottom: -80px; right: -80px;
            animation: drift2 14s ease-in-out infinite alternate;
        }
        @keyframes drift1 {
            from { transform: translate(0, 0) scale(1); }
            to   { transform: translate(60px, 40px) scale(1.1); }
        }
        @keyframes drift2 {
            from { transform: translate(0, 0) scale(1); }
            to   { transform: translate(-50px, -30px) scale(1.08); }
        }

        /* Grid overlay */
        .grid-overlay {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background-image:
                linear-gradient(rgba(59,130,246,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,0.04) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Card */
        .auth-card {
            background: rgba(13, 21, 42, 0.85);
            border: 1px solid rgba(59,130,246,0.18);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 16px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(59,130,246,0.08);
        }

        /* Input */
        .auth-input {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 12px 12px 12px 44px;
            color: #e2e8f0;
            font-size: 14px;
            transition: all 0.2s;
            outline: none;
        }
        .auth-input::placeholder { color: #4b5563; }
        .auth-input:focus {
            border-color: #3b82f6;
            background: rgba(59,130,246,0.08);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
        }

        /* Select */
        select.auth-input { appearance: none; -webkit-appearance: none; cursor: pointer; }

        /* Button */
        .btn-primary {
            width: 100%;
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 13px 20px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            letter-spacing: 0.02em;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
            box-shadow: 0 8px 25px rgba(37,99,235,0.4);
            transform: translateY(-1px);
        }
        .btn-primary:active { transform: translateY(0); }

        /* Label */
        .auth-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #94a3b8;
            margin-bottom: 8px;
        }

        /* Input icon wrapper */
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #4b5563;
            font-size: 14px;
            pointer-events: none;
        }
        .input-icon-right {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #4b5563;
            font-size: 14px;
            cursor: pointer;
            transition: color 0.2s;
        }
        .input-icon-right:hover { color: #94a3b8; }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.08);
        }

        /* Logo badge */
        .logo-badge {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 800;
            color: white;
            flex-shrink: 0;
        }

        /* Left panel */
        .left-panel {
            background: linear-gradient(160deg, #080d1a 0%, #0d1527 60%, #0a1628 100%);
            position: relative;
            overflow: hidden;
        }
        .left-panel::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(37,99,235,0.15) 0%, transparent 70%);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Floating stat cards */
        .stat-card {
            background: rgba(13,21,42,0.7);
            border: 1px solid rgba(59,130,246,0.15);
            border-radius: 12px;
            padding: 14px 18px;
            backdrop-filter: blur(10px);
        }

        /* Link */
        .auth-link {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .auth-link:hover { color: #60a5fa; text-decoration: underline; }

        /* Checkbox */
        input[type="checkbox"] {
            accent-color: #3b82f6;
            width: 15px; height: 15px;
            cursor: pointer;
        }

        /* Particles */
        .particle {
            position: fixed;
            border-radius: 50%;
            background: rgba(59,130,246,0.5);
            pointer-events: none;
            z-index: 0;
        }

        /* Glow dot */
        .glow-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 6px #22c55e, 0 0 12px rgba(34,197,94,0.4);
            animation: pulse-dot 2s ease-in-out infinite;
            flex-shrink: 0;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(0.85); }
        }

        @keyframes float-up {
            0% { transform: translateY(0); opacity: 0; }
            50% { opacity: 0.6; }
            100% { transform: translateY(-100vh); opacity: 0; }
        }
    </style>
</head>

<body>
    <!-- Background effects -->
    <div class="bg-blob bg-blob-1"></div>
    <div class="bg-blob bg-blob-2"></div>
    <div class="grid-overlay"></div>
    <div id="particles-container"></div>

    <!-- Error data (hidden) -->
    @if ($errors->count() > 0)
    <div id="ERROR_COPY" style="display:none;">
        @foreach ($errors->all() as $error)
            {{ $error }} <br />
        @endforeach
    </div>
    @endif

    <div style="position:relative;z-index:1;min-height:100vh;display:flex;">

        <!-- ===== LEFT BRANDING PANEL ===== -->
        <div class="left-panel" style="flex:1;display:none;padding:48px;flex-direction:column;justify-content:center;" id="left-panel">
            <!-- Top logo -->
            <div style="display:flex;align-items:center;gap:14px;margin-bottom:64px;">
                <div class="logo-badge">Q</div>
                <span style="font-size:18px;font-weight:700;color:#fff;letter-spacing:0.05em;">QFSWORLD</span>
            </div>

            <!-- Hero text -->
            <div style="max-width:420px;">
                <h1 style="font-size:42px;font-weight:800;color:#fff;line-height:1.2;margin-bottom:16px;">
                    Steps to digital<br>asset <span style="color:#3b82f6;">Freedom</span>
                </h1>
                <p style="color:#64748b;font-size:16px;line-height:1.6;">
                    Secure. Fast. Decentralized.<br>
                    Your gateway to the future of finance.
                </p>
            </div>

            <!-- Stat cards -->
            <div style="margin-top:48px;display:flex;flex-direction:column;gap:14px;max-width:320px;">
                <div class="stat-card" style="display:flex;align-items:center;gap:14px;">
                    <div style="width:36px;height:36px;background:rgba(37,99,235,0.2);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-shield-alt" style="color:#3b82f6;font-size:14px;"></i>
                    </div>
                    <div>
                        <div style="color:#fff;font-size:14px;font-weight:600;">Bank-Grade Security</div>
                        <div style="color:#64748b;font-size:12px;">256-bit encryption</div>
                    </div>
                </div>
                <div class="stat-card" style="display:flex;align-items:center;gap:14px;">
                    <div style="width:36px;height:36px;background:rgba(37,99,235,0.2);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-bolt" style="color:#3b82f6;font-size:14px;"></i>
                    </div>
                    <div>
                        <div style="color:#fff;font-size:14px;font-weight:600;">Instant Transactions</div>
                        <div style="color:#64748b;font-size:12px;">Lightning-fast execution</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== RIGHT FORM PANEL ===== -->
        <div style="flex:1;display:flex;align-items:center;justify-content:center;padding:24px;min-height:100vh;">
            <div style="width:100%;max-width:440px;">

                <!-- Mobile logo (shown on small screens) -->
                <div id="mobile-logo" style="display:flex;align-items:center;gap:12px;margin-bottom:32px;justify-content:center;">
                    <div class="logo-badge">Q</div>
                    <span style="font-size:20px;font-weight:700;color:#fff;letter-spacing:0.05em;">QFSWORLD</span>
                </div>

                <!-- Card -->
                <div class="auth-card" style="padding:36px 32px;">
                    <!-- Secure indicator -->
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:24px;">
                        <div class="glow-dot"></div>
                        <span style="font-size:12px;color:#64748b;font-weight:500;">Secure Connection</span>
                    </div>

                    <h2 style="font-size:22px;font-weight:700;color:#f1f5f9;margin-bottom:4px;">Welcome back</h2>
                    <p style="font-size:14px;color:#64748b;margin-bottom:28px;">Sign in to your account</p>

                    <form method="POST" action="{{ route('login') }}" id="login-form">
                        @csrf

                        <!-- Email / Username -->
                        <div style="margin-bottom:18px;">
                            <label class="auth-label" for="login">Email or Username</label>
                            <div class="input-wrap">
                                <i class="far fa-envelope input-icon"></i>
                                <input class="auth-input" id="login" name="login" type="text"
                                    placeholder="Enter your email" value="{{ old('login') }}" autocomplete="username" />
                            </div>
                        </div>

                        <!-- Password -->
                        <div style="margin-bottom:18px;">
                            <label class="auth-label" for="password">Password</label>
                            <div class="input-wrap">
                                <i class="fas fa-lock input-icon"></i>
                                <input class="auth-input" id="password" type="password" name="password"
                                    autocomplete="current-password" placeholder="••••••••" style="padding-right:44px;" />
                                <i class="far fa-eye input-icon-right" id="password-toggle"></i>
                            </div>
                        </div>

                        <!-- Remember me + Forgot -->
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
                            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                                <input id="remember-me" name="remember" type="checkbox">
                                <span style="font-size:13px;color:#94a3b8;">Remember me</span>
                            </label>
                            <a href="{{ route('password.request') }}" class="auth-link" style="font-size:13px;">
                                Forgot password?
                            </a>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn-primary" id="submit-btn">
                            Sign In <i class="fas fa-arrow-right" style="font-size:13px;"></i>
                        </button>

                        <!-- Register link -->
                        <p style="text-align:center;margin-top:20px;font-size:13px;color:#64748b;">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="auth-link">Register</a>
                        </p>
                    </form>
                </div>

                <!-- Home link -->
                <div style="text-align:center;margin-top:20px;">
                    <a href="{{ url('/') }}" style="font-size:13px;color:#475569;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:color 0.2s;" onmouseover="this.style.color='#94a3b8'" onmouseout="this.style.color='#475569'">
                        <i class="fas fa-arrow-left" style="font-size:11px;"></i> Back to Home
                    </a>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Show left panel on larger screens
        function handleResize() {
            const leftPanel = document.getElementById('left-panel');
            const mobileLogo = document.getElementById('mobile-logo');
            if (window.innerWidth >= 900) {
                leftPanel.style.display = 'flex';
                mobileLogo.style.display = 'none';
            } else {
                leftPanel.style.display = 'none';
                mobileLogo.style.display = 'flex';
            }
        }
        handleResize();
        window.addEventListener('resize', handleResize);

        // Password toggle
        document.getElementById('password-toggle').addEventListener('click', function() {
            const pw = document.getElementById('password');
            if (pw.type === 'password') {
                pw.type = 'text';
                this.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                pw.type = 'password';
                this.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });

        // Submit animation
        document.getElementById('login-form').addEventListener('submit', function() {
            const btn = document.getElementById('submit-btn');
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Authenticating...';
            btn.disabled = true;
            btn.style.opacity = '0.8';
        });

        // Floating particles
        (function createParticles() {
            const container = document.getElementById('particles-container');
            for (let i = 0; i < 30; i++) {
                const p = document.createElement('div');
                p.classList.add('particle');
                const size = Math.random() * 3 + 1;
                p.style.cssText = `
                    width:${size}px;height:${size}px;
                    left:${Math.random()*100}vw;
                    top:${Math.random()*100}vh;
                    animation: float-up ${Math.random()*15+8}s linear ${Math.random()*6}s infinite;
                `;
                container.appendChild(p);
            }
        })();

        // Show errors
        document.addEventListener('DOMContentLoaded', function() {
            const errorEl = document.getElementById('ERROR_COPY');
            if (errorEl && errorEl.innerHTML.trim() !== '') {
                swal("Login Error", errorEl.innerText.trim(), "error");
            }
        });
    </script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/69c5ab7a92329d1c3229c49e/1jkm2bm2t';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
</body>
</html>
