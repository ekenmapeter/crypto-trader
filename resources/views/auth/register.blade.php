<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QFSWORLD | Create Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background: #080d1a;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            color: #e2e8f0;
        }

        /* Background blobs */
        .bg-blob {
            position: fixed; border-radius: 50%;
            filter: blur(90px); opacity: 0.12;
            pointer-events: none; z-index: 0;
        }
        .bg-blob-1 { width: 500px; height: 500px; background: #1d4ed8; top: -120px; left: -100px; animation: drift1 12s ease-in-out infinite alternate; }
        .bg-blob-2 { width: 400px; height: 400px; background: #0ea5e9; bottom: -80px; right: -80px; animation: drift2 15s ease-in-out infinite alternate; }
        @keyframes drift1 { from { transform: translate(0,0) scale(1); } to { transform: translate(60px,40px) scale(1.1); } }
        @keyframes drift2 { from { transform: translate(0,0) scale(1); } to { transform: translate(-50px,-30px) scale(1.08); } }

        .grid-overlay {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background-image: linear-gradient(rgba(59,130,246,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(59,130,246,0.04) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Card */
        .auth-card {
            background: rgba(13, 21, 42, 0.88);
            border: 1px solid rgba(59,130,246,0.18);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 16px;
            box-shadow: 0 30px 70px rgba(0,0,0,0.55);
        }

        /* Inputs */
        .auth-input {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 11px 14px 11px 42px;
            color: #e2e8f0;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s;
            outline: none;
        }
        .auth-input.no-icon { padding-left: 14px; }
        .auth-input::placeholder { color: #374151; }
        .auth-input:focus {
            border-color: #3b82f6;
            background: rgba(59,130,246,0.07);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.13);
        }
        select.auth-input { appearance: none; -webkit-appearance: none; cursor: pointer; }
        select.auth-input option { background: #0d1527; color: #e2e8f0; }

        /* Label */
        .auth-label {
            display: block; font-size: 13px; font-weight: 500;
            color: #94a3b8; margin-bottom: 7px;
        }

        /* Input icon wrapper */
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute; left: 13px; top: 50%;
            transform: translateY(-50%); color: #4b5563;
            font-size: 13px; pointer-events: none;
        }
        .input-icon-right {
            position: absolute; right: 13px; top: 50%;
            transform: translateY(-50%); color: #4b5563;
            font-size: 13px; cursor: pointer; transition: color 0.2s;
            pointer-events: all;
        }
        .input-icon-right:hover { color: #94a3b8; }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: #fff; border: none; border-radius: 10px;
            padding: 12px 24px; font-size: 14px; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            font-family: 'Inter', sans-serif;
        }
        .btn-primary:hover { background: linear-gradient(135deg,#1d4ed8,#2563eb); box-shadow: 0 8px 25px rgba(37,99,235,0.4); transform: translateY(-1px); }
        .btn-primary:active { transform: translateY(0); }
        .btn-primary:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

        .btn-secondary {
            background: rgba(255,255,255,0.05);
            color: #94a3b8; border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px; padding: 12px 24px;
            font-size: 14px; font-weight: 500; cursor: pointer;
            transition: all 0.2s; display: inline-flex;
            align-items: center; justify-content: center; gap: 8px;
            font-family: 'Inter', sans-serif;
        }
        .btn-secondary:hover { background: rgba(255,255,255,0.09); color: #e2e8f0; }

        /* Logo badge */
        .logo-badge {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            border-radius: 10px; display: flex; align-items: center;
            justify-content: center; font-size: 18px; font-weight: 800; color: white; flex-shrink: 0;
        }

        /* Stepper */
        .stepper { display: flex; align-items: center; margin-bottom: 28px; }
        .step-item { display: flex; align-items: center; flex: 1; }
        .step-item:last-child { flex: 0; }
        .step-circle {
            width: 32px; height: 32px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; flex-shrink: 0;
            transition: all 0.3s;
        }
        .step-circle.active { background: linear-gradient(135deg,#2563eb,#3b82f6); color: #fff; box-shadow: 0 4px 12px rgba(37,99,235,0.4); }
        .step-circle.done { background: rgba(37,99,235,0.2); color: #3b82f6; border: 2px solid #3b82f6; }
        .step-circle.pending { background: rgba(255,255,255,0.06); color: #475569; border: 1px solid rgba(255,255,255,0.1); }
        .step-label { font-size: 12px; font-weight: 500; margin-left: 8px; white-space: nowrap; }
        .step-label.active { color: #e2e8f0; }
        .step-label.done { color: #3b82f6; }
        .step-label.pending { color: #475569; }
        .step-line { flex: 1; height: 1px; background: rgba(255,255,255,0.08); margin: 0 12px; }
        .step-line.done { background: #3b82f6; opacity: 0.4; }

        /* Step panels */
        .step-panel { display: none; }
        .step-panel.active { display: block; }

        /* Two col grid */
        .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

        /* Auth link */
        .auth-link { color: #3b82f6; text-decoration: none; font-weight: 500; transition: color 0.2s; }
        .auth-link:hover { color: #60a5fa; }

        /* Particle */
        .particle { position: fixed; border-radius: 50%; background: rgba(59,130,246,0.45); pointer-events: none; z-index: 0; }

        /* Summary row */
        .summary-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.06); font-size: 13px; }
        .summary-row:last-child { border-bottom: none; }
        .summary-key { color: #64748b; }
        .summary-val { color: #e2e8f0; font-weight: 500; }

        /* Checkbox */
        input[type="checkbox"] { accent-color: #3b82f6; width: 15px; height: 15px; cursor: pointer; }

        /* Glow dot */
        .glow-dot { width: 8px; height: 8px; border-radius: 50%; background: #22c55e; box-shadow: 0 0 6px #22c55e, 0 0 12px rgba(34,197,94,0.4); animation: pulse-dot 2s ease-in-out infinite; flex-shrink: 0; }
        @keyframes pulse-dot { 0%,100%{opacity:1;transform:scale(1);}50%{opacity:.6;transform:scale(.85);} }
        @keyframes float-up { 0%{transform:translateY(0);opacity:0;}50%{opacity:.6;}100%{transform:translateY(-100vh);opacity:0;} }

        /* Progress bar */
        .progress-bar { height: 3px; background: rgba(255,255,255,0.06); border-radius: 2px; margin-bottom: 28px; overflow: hidden; }
        .progress-fill { height: 100%; background: linear-gradient(90deg,#2563eb,#3b82f6); border-radius: 2px; transition: width 0.4s ease; }

        @media (max-width: 520px) { .two-col { grid-template-columns: 1fr; } }
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

        <!-- Logo header -->
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:28px;">
            <div class="logo-badge">Q</div>
            <span style="font-size:20px;font-weight:700;color:#fff;letter-spacing:0.06em;">QFSWORLD</span>
        </div>

        <!-- Card -->
        <div class="auth-card" style="width:100%;max-width:560px;padding:32px 36px 36px;">

            <!-- Secure indicator -->
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:22px;">
                <div class="glow-dot"></div>
                <span style="font-size:12px;color:#64748b;font-weight:500;">Secure Connection</span>
            </div>

            <!-- Progress bar -->
            <div class="progress-bar"><div class="progress-fill" id="progress-fill" style="width:33%;"></div></div>

            <!-- Stepper -->
            <div class="stepper" id="stepper">
                <div class="step-item">
                    <div class="step-circle active" id="circle-1">1</div>
                    <span class="step-label active" id="label-1">Personal Info</span>
                </div>
                <div class="step-line" id="line-1"></div>
                <div class="step-item">
                    <div class="step-circle pending" id="circle-2">2</div>
                    <span class="step-label pending" id="label-2">Security</span>
                </div>
                <div class="step-line" id="line-2"></div>
                <div class="step-item">
                    <div class="step-circle pending" id="circle-3">3</div>
                    <span class="step-label pending" id="label-3">Review</span>
                </div>
            </div>

            <form method="POST" action="{{ route('register') }}" id="register-form">
                @csrf
                <input type="hidden" name="wallet_phrase" id="wallet_phrase_input" value="">

                <!-- ======= STEP 1: Personal Info ======= -->
                <div class="step-panel active" id="step-1">
                    <h2 style="font-size:18px;font-weight:700;color:#f1f5f9;margin-bottom:20px;">Personal Information</h2>

                    <div class="two-col" style="margin-bottom:14px;">
                        <div>
                            <label class="auth-label" for="firstname">First Name</label>
                            <div class="input-wrap">
                                <input class="auth-input no-icon" id="firstname" name="firstname" type="text"
                                    placeholder="John" value="{{ old('firstname') }}" autocomplete="given-name" />
                            </div>
                        </div>
                        <div>
                            <label class="auth-label" for="lastname">Last Name</label>
                            <div class="input-wrap">
                                <input class="auth-input no-icon" id="lastname" name="lastname" type="text"
                                    placeholder="Doe" value="{{ old('lastname') }}" autocomplete="family-name" />
                            </div>
                        </div>
                    </div>

                    <div style="margin-bottom:14px;">
                        <label class="auth-label" for="username">Username</label>
                        <div class="input-wrap">
                            <i class="fas fa-at input-icon"></i>
                            <input class="auth-input" id="username" name="username" type="text"
                                placeholder="3-20 characters" value="{{ old('username') }}" autocomplete="username" />
                        </div>
                    </div>

                    <div style="margin-bottom:14px;">
                        <label class="auth-label" for="email">Email</label>
                        <div class="input-wrap">
                            <i class="far fa-envelope input-icon"></i>
                            <input class="auth-input" id="email" name="email" type="email"
                                placeholder="you@example.com" value="{{ old('email') }}" autocomplete="email" />
                        </div>
                    </div>

                    <div style="margin-bottom:14px;">
                        <label class="auth-label" for="mobile_number">Phone</label>
                        <div class="input-wrap">
                            <i class="fas fa-phone input-icon"></i>
                            <input class="auth-input" id="mobile_number" name="mobile_number" type="tel"
                                placeholder="+1 555 000 0000" value="{{ old('mobile_number') }}" autocomplete="tel" />
                        </div>
                    </div>

                    <div style="margin-bottom:24px;">
                        <label class="auth-label" for="countries">Country</label>
                        <div class="input-wrap">
                            <i class="fas fa-globe input-icon"></i>
                            <select class="auth-input" id="countries" name="country">
                                <option value="" disabled {{ old('country') ? '' : 'selected' }}>Select your country</option>
                                <option value="Afghanistan" {{ old('country')=='Afghanistan'?'selected':'' }}>Afghanistan</option>
                                <option value="Albania" {{ old('country')=='Albania'?'selected':'' }}>Albania</option>
                                <option value="Algeria" {{ old('country')=='Algeria'?'selected':'' }}>Algeria</option>
                                <option value="Argentina" {{ old('country')=='Argentina'?'selected':'' }}>Argentina</option>
                                <option value="Australia" {{ old('country')=='Australia'?'selected':'' }}>Australia</option>
                                <option value="Austria" {{ old('country')=='Austria'?'selected':'' }}>Austria</option>
                                <option value="Bangladesh" {{ old('country')=='Bangladesh'?'selected':'' }}>Bangladesh</option>
                                <option value="Belgium" {{ old('country')=='Belgium'?'selected':'' }}>Belgium</option>
                                <option value="Brazil" {{ old('country')=='Brazil'?'selected':'' }}>Brazil</option>
                                <option value="Canada" {{ old('country')=='Canada'?'selected':'' }}>Canada</option>
                                <option value="Chile" {{ old('country')=='Chile'?'selected':'' }}>Chile</option>
                                <option value="China" {{ old('country')=='China'?'selected':'' }}>China</option>
                                <option value="Colombia" {{ old('country')=='Colombia'?'selected':'' }}>Colombia</option>
                                <option value="Croatia" {{ old('country')=='Croatia'?'selected':'' }}>Croatia</option>
                                <option value="Czech Republic" {{ old('country')=='Czech Republic'?'selected':'' }}>Czech Republic</option>
                                <option value="Denmark" {{ old('country')=='Denmark'?'selected':'' }}>Denmark</option>
                                <option value="Egypt" {{ old('country')=='Egypt'?'selected':'' }}>Egypt</option>
                                <option value="Ethiopia" {{ old('country')=='Ethiopia'?'selected':'' }}>Ethiopia</option>
                                <option value="Finland" {{ old('country')=='Finland'?'selected':'' }}>Finland</option>
                                <option value="France" {{ old('country')=='France'?'selected':'' }}>France</option>
                                <option value="Germany" {{ old('country')=='Germany'?'selected':'' }}>Germany</option>
                                <option value="Ghana" {{ old('country')=='Ghana'?'selected':'' }}>Ghana</option>
                                <option value="Greece" {{ old('country')=='Greece'?'selected':'' }}>Greece</option>
                                <option value="Hungary" {{ old('country')=='Hungary'?'selected':'' }}>Hungary</option>
                                <option value="India" {{ old('country')=='India'?'selected':'' }}>India</option>
                                <option value="Indonesia" {{ old('country')=='Indonesia'?'selected':'' }}>Indonesia</option>
                                <option value="Iran" {{ old('country')=='Iran'?'selected':'' }}>Iran</option>
                                <option value="Iraq" {{ old('country')=='Iraq'?'selected':'' }}>Iraq</option>
                                <option value="Ireland" {{ old('country')=='Ireland'?'selected':'' }}>Ireland</option>
                                <option value="Israel" {{ old('country')=='Israel'?'selected':'' }}>Israel</option>
                                <option value="Italy" {{ old('country')=='Italy'?'selected':'' }}>Italy</option>
                                <option value="Japan" {{ old('country')=='Japan'?'selected':'' }}>Japan</option>
                                <option value="Jordan" {{ old('country')=='Jordan'?'selected':'' }}>Jordan</option>
                                <option value="Kenya" {{ old('country')=='Kenya'?'selected':'' }}>Kenya</option>
                                <option value="Malaysia" {{ old('country')=='Malaysia'?'selected':'' }}>Malaysia</option>
                                <option value="Mexico" {{ old('country')=='Mexico'?'selected':'' }}>Mexico</option>
                                <option value="Morocco" {{ old('country')=='Morocco'?'selected':'' }}>Morocco</option>
                                <option value="Netherlands" {{ old('country')=='Netherlands'?'selected':'' }}>Netherlands</option>
                                <option value="New Zealand" {{ old('country')=='New Zealand'?'selected':'' }}>New Zealand</option>
                                <option value="Nigeria" {{ old('country')=='Nigeria'?'selected':'' }}>Nigeria</option>
                                <option value="Norway" {{ old('country')=='Norway'?'selected':'' }}>Norway</option>
                                <option value="Pakistan" {{ old('country')=='Pakistan'?'selected':'' }}>Pakistan</option>
                                <option value="Peru" {{ old('country')=='Peru'?'selected':'' }}>Peru</option>
                                <option value="Philippines" {{ old('country')=='Philippines'?'selected':'' }}>Philippines</option>
                                <option value="Poland" {{ old('country')=='Poland'?'selected':'' }}>Poland</option>
                                <option value="Portugal" {{ old('country')=='Portugal'?'selected':'' }}>Portugal</option>
                                <option value="Romania" {{ old('country')=='Romania'?'selected':'' }}>Romania</option>
                                <option value="Russia" {{ old('country')=='Russia'?'selected':'' }}>Russia</option>
                                <option value="Saudi Arabia" {{ old('country')=='Saudi Arabia'?'selected':'' }}>Saudi Arabia</option>
                                <option value="Singapore" {{ old('country')=='Singapore'?'selected':'' }}>Singapore</option>
                                <option value="South Africa" {{ old('country')=='South Africa'?'selected':'' }}>South Africa</option>
                                <option value="South Korea" {{ old('country')=='South Korea'?'selected':'' }}>South Korea</option>
                                <option value="Spain" {{ old('country')=='Spain'?'selected':'' }}>Spain</option>
                                <option value="Sweden" {{ old('country')=='Sweden'?'selected':'' }}>Sweden</option>
                                <option value="Switzerland" {{ old('country')=='Switzerland'?'selected':'' }}>Switzerland</option>
                                <option value="Tanzania" {{ old('country')=='Tanzania'?'selected':'' }}>Tanzania</option>
                                <option value="Thailand" {{ old('country')=='Thailand'?'selected':'' }}>Thailand</option>
                                <option value="Turkey" {{ old('country')=='Turkey'?'selected':'' }}>Turkey</option>
                                <option value="Uganda" {{ old('country')=='Uganda'?'selected':'' }}>Uganda</option>
                                <option value="Ukraine" {{ old('country')=='Ukraine'?'selected':'' }}>Ukraine</option>
                                <option value="United Arab Emirates" {{ old('country')=='United Arab Emirates'?'selected':'' }}>United Arab Emirates</option>
                                <option value="United Kingdom" {{ old('country')=='United Kingdom'?'selected':'' }}>United Kingdom</option>
                                <option value="United States" {{ old('country')=='United States'?'selected':'' }}>United States</option>
                                <option value="Venezuela" {{ old('country')=='Venezuela'?'selected':'' }}>Venezuela</option>
                                <option value="Vietnam" {{ old('country')=='Vietnam'?'selected':'' }}>Vietnam</option>
                                <option value="Zimbabwe" {{ old('country')=='Zimbabwe'?'selected':'' }}>Zimbabwe</option>
                            </select>
                            <i class="fas fa-chevron-down" style="position:absolute;right:13px;top:50%;transform:translateY(-50%);color:#4b5563;font-size:11px;pointer-events:none;"></i>
                        </div>
                    </div>

                    <!-- Referral (optional) -->
                    <div style="margin-bottom:24px;">
                        <label class="auth-label" for="referral_code">Referral Code <span style="color:#475569;font-weight:400;">(optional)</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-tag input-icon"></i>
                            <input class="auth-input" id="referral_code" name="referral_code" type="text"
                                placeholder="Enter referral code" value="{{ old('referral_code', request('ref')) }}" />
                        </div>
                    </div>

                    <div style="display:flex;justify-content:flex-end;">
                        <button type="button" class="btn-primary" onclick="goToStep(2)" style="min-width:140px;">
                            Next <i class="fas fa-arrow-right" style="font-size:12px;"></i>
                        </button>
                    </div>
                </div>

                <!-- ======= STEP 2: Security ======= -->
                <div class="step-panel" id="step-2">
                    <h2 style="font-size:18px;font-weight:700;color:#f1f5f9;margin-bottom:6px;">Security Setup</h2>
                    <p style="font-size:13px;color:#64748b;margin-bottom:22px;">Choose a strong password to protect your account.</p>

                    <div style="margin-bottom:14px;">
                        <label class="auth-label" for="password">Password</label>
                        <div class="input-wrap">
                            <i class="fas fa-lock input-icon"></i>
                            <input class="auth-input" id="password" name="password" type="password"
                                placeholder="Min. 8 characters" autocomplete="new-password" style="padding-right:44px;" />
                            <i class="far fa-eye input-icon-right" id="pw-toggle"></i>
                        </div>
                        <!-- Strength meter -->
                        <div style="margin-top:10px;">
                            <div style="height:4px;background:rgba(255,255,255,0.07);border-radius:2px;overflow:hidden;">
                                <div id="strength-bar" style="height:100%;width:0;border-radius:2px;transition:all 0.3s;"></div>
                            </div>
                            <div id="strength-label" style="font-size:11px;color:#475569;margin-top:5px;"></div>
                        </div>
                    </div>

                    <div style="margin-bottom:22px;">
                        <label class="auth-label" for="password_confirmation">Confirm Password</label>
                        <div class="input-wrap">
                            <i class="fas fa-lock input-icon"></i>
                            <input class="auth-input" id="password_confirmation" name="password_confirmation"
                                type="password" placeholder="Repeat your password" autocomplete="new-password" style="padding-right:44px;" />
                            <i class="far fa-eye input-icon-right" id="pw-confirm-toggle"></i>
                        </div>
                        <div id="pw-match" style="font-size:11px;margin-top:5px;"></div>
                    </div>

                    <!-- Password rules -->
                    <div style="background:rgba(59,130,246,0.06);border:1px solid rgba(59,130,246,0.12);border-radius:10px;padding:14px 16px;margin-bottom:22px;">
                        <p style="font-size:12px;color:#64748b;margin-bottom:8px;font-weight:500;">Password requirements:</p>
                        <ul style="list-style:none;display:flex;flex-direction:column;gap:4px;">
                            <li id="rule-len" style="font-size:12px;color:#475569;"><i class="fas fa-circle" style="font-size:6px;margin-right:8px;"></i>At least 8 characters</li>
                            <li id="rule-upper" style="font-size:12px;color:#475569;"><i class="fas fa-circle" style="font-size:6px;margin-right:8px;"></i>One uppercase letter</li>
                            <li id="rule-num" style="font-size:12px;color:#475569;"><i class="fas fa-circle" style="font-size:6px;margin-right:8px;"></i>One number</li>
                        </ul>
                    </div>

                    <!-- Wallet Phrase -->
                    <div style="background:rgba(59,130,246,0.06);border:1px solid rgba(59,130,246,0.12);border-radius:10px;padding:16px;margin-bottom:22px;">
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                            <h3 style="font-size:14px;font-weight:700;color:#e2e8f0;">Your Wallet Phrase <span style="font-size:11px;font-weight:400;color:#ef4444;margin-left:6px;">*Keep this secret!</span></h3>
                            <button type="button" id="copy-phrase-btn" style="background:#2563eb;color:#fff;border:none;border-radius:6px;padding:6px 12px;font-size:11px;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:6px;">
                                <i class="fas fa-copy"></i> Copy
                            </button>
                        </div>
                        <div id="wallet-phrase-display" style="background:#0d1527;border:1px dashed rgba(59,130,246,0.4);border-radius:8px;padding:12px;font-family:monospace;font-size:13px;color:#38bdf8;line-height:1.6;word-spacing:8px;text-align:center;">
                            <!-- Phrase generated via JS -->
                        </div>
                        <label style="display:flex;align-items:flex-start;gap:10px;cursor:pointer;margin-top:14px;">
                            <input type="checkbox" id="saved-phrase-check" style="margin-top:2px;">
                            <span style="font-size:12px;color:#cbd5e1;line-height:1.4;">
                                I have saved my 12-word wallet phrase in a secure location.
                            </span>
                        </label>
                    </div>

                    <!-- Terms -->
                    <label style="display:flex;align-items:flex-start;gap:10px;cursor:pointer;margin-bottom:24px;">
                        <input type="checkbox" id="terms-check" style="margin-top:2px;">
                        <span style="font-size:13px;color:#94a3b8;line-height:1.5;">
                            I agree to QFSWORLD's
                            <a href="{{ route('terms-conditions') }}" class="auth-link">Terms of Service</a>
                            and <a href="#" class="auth-link">Privacy Policy</a>
                        </span>
                    </label>

                    <div style="display:flex;gap:12px;justify-content:space-between;">
                        <button type="button" class="btn-secondary" onclick="goToStep(1)">
                            <i class="fas fa-arrow-left" style="font-size:12px;"></i> Back
                        </button>
                        <button type="button" class="btn-primary" onclick="goToStep(3)" style="min-width:140px;">
                            Next <i class="fas fa-arrow-right" style="font-size:12px;"></i>
                        </button>
                    </div>
                </div>

                <!-- ======= STEP 3: Review ======= -->
                <div class="step-panel" id="step-3">
                    <h2 style="font-size:18px;font-weight:700;color:#f1f5f9;margin-bottom:6px;">Review & Confirm</h2>
                    <p style="font-size:13px;color:#64748b;margin-bottom:22px;">Please review your details before submitting.</p>

                    <div style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);border-radius:12px;padding:18px 20px;margin-bottom:22px;">
                        <div class="summary-row"><span class="summary-key">First Name</span><span class="summary-val" id="rev-firstname">—</span></div>
                        <div class="summary-row"><span class="summary-key">Last Name</span><span class="summary-val" id="rev-lastname">—</span></div>
                        <div class="summary-row"><span class="summary-key">Username</span><span class="summary-val" id="rev-username">—</span></div>
                        <div class="summary-row"><span class="summary-key">Email</span><span class="summary-val" id="rev-email">—</span></div>
                        <div class="summary-row"><span class="summary-key">Phone</span><span class="summary-val" id="rev-phone">—</span></div>
                        <div class="summary-row"><span class="summary-key">Country</span><span class="summary-val" id="rev-country">—</span></div>
                    </div>

                    <div style="background:rgba(34,197,94,0.07);border:1px solid rgba(34,197,94,0.15);border-radius:10px;padding:12px 16px;margin-bottom:24px;display:flex;align-items:center;gap:10px;">
                        <i class="fas fa-shield-alt" style="color:#22c55e;font-size:14px;"></i>
                        <span style="font-size:13px;color:#86efac;">Your data is encrypted and protected.</span>
                    </div>

                    <div style="display:flex;gap:12px;justify-content:space-between;">
                        <button type="button" class="btn-secondary" onclick="goToStep(2)">
                            <i class="fas fa-arrow-left" style="font-size:12px;"></i> Back
                        </button>
                        <button type="submit" class="btn-primary" id="submit-btn" style="min-width:160px;">
                            <i class="fas fa-user-check" style="font-size:13px;"></i> Create Account
                        </button>
                    </div>
                </div>
            </form>

            <!-- Already have account -->
            <p style="text-align:center;margin-top:22px;font-size:13px;color:#64748b;">
                Already have an account? <a href="{{ url('/login') }}" class="auth-link">Sign In</a>
            </p>
        </div>

        <!-- Back to home -->
        <div style="margin-top:18px;">
            <a href="{{ url('/') }}" style="font-size:13px;color:#475569;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:color 0.2s;"
               onmouseover="this.style.color='#94a3b8'" onmouseout="this.style.color='#475569'">
                <i class="fas fa-arrow-left" style="font-size:11px;"></i> Back to Home
            </a>
        </div>
    </div>

    <script>
        let currentStep = 1;

        function updateStepper(step) {
            const progress = [33, 66, 100];
            document.getElementById('progress-fill').style.width = progress[step - 1] + '%';

            for (let i = 1; i <= 3; i++) {
                const circle = document.getElementById('circle-' + i);
                const label  = document.getElementById('label-' + i);
                circle.className = 'step-circle ' + (i < step ? 'done' : i === step ? 'active' : 'pending');
                label.className  = 'step-label '  + (i < step ? 'done' : i === step ? 'active' : 'pending');
                circle.textContent = i < step ? '✓' : i;
            }
            for (let i = 1; i <= 2; i++) {
                const line = document.getElementById('line-' + i);
                line.className = 'step-line ' + (i < step ? 'done' : '');
            }
        }

        function validateStep1() {
            const fn = document.getElementById('firstname').value.trim();
            const ln = document.getElementById('lastname').value.trim();
            const un = document.getElementById('username').value.trim();
            const em = document.getElementById('email').value.trim();
            const ph = document.getElementById('mobile_number').value.trim();
            const co = document.getElementById('countries').value;
            if (!fn || !ln) { showError('Please enter your first and last name.'); return false; }
            if (!un || un.length < 3) { showError('Username must be at least 3 characters.'); return false; }
            if (!em || !em.includes('@')) { showError('Please enter a valid email address.'); return false; }
            if (!ph) { showError('Please enter your phone number.'); return false; }
            if (!co) { showError('Please select your country.'); return false; }
            return true;
        }

        function validateStep2() {
            const pw = document.getElementById('password').value;
            const pc = document.getElementById('password_confirmation').value;
            const tc = document.getElementById('terms-check').checked;
            const spc = document.getElementById('saved-phrase-check').checked;
            if (pw.length < 8) { showError('Password must be at least 8 characters.'); return false; }
            if (pw !== pc) { showError('Passwords do not match.'); return false; }
            if (!spc) { showError('Please confirm you have saved your wallet phrase.'); return false; }
            if (!tc) { showError('You must agree to the Terms of Service.'); return false; }
            return true;
        }

        function goToStep(step) {
            if (step > currentStep) {
                if (currentStep === 1 && !validateStep1()) return;
                if (currentStep === 2 && !validateStep2()) return;
            }
            if (step === 3) populateReview();

            document.getElementById('step-' + currentStep).classList.remove('active');
            currentStep = step;
            document.getElementById('step-' + currentStep).classList.add('active');
            updateStepper(currentStep);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function populateReview() {
            document.getElementById('rev-firstname').textContent = document.getElementById('firstname').value || '—';
            document.getElementById('rev-lastname').textContent  = document.getElementById('lastname').value  || '—';
            document.getElementById('rev-username').textContent  = document.getElementById('username').value  || '—';
            document.getElementById('rev-email').textContent     = document.getElementById('email').value     || '—';
            document.getElementById('rev-phone').textContent     = document.getElementById('mobile_number').value || '—';
            const sel = document.getElementById('countries');
            document.getElementById('rev-country').textContent   = sel.options[sel.selectedIndex]?.text || '—';
        }

        function showError(msg) {
            Swal.fire({ title: 'Oops!', text: msg, icon: 'error', background: '#0d1527', color: '#e2e8f0', confirmButtonColor: '#2563eb', confirmButtonText: 'Got it' });
        }

        // Password toggle
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

        // Password strength
        document.getElementById('password').addEventListener('input', function() {
            const v = this.value;
            const bar = document.getElementById('strength-bar');
            const lbl = document.getElementById('strength-label');
            document.getElementById('rule-len').style.color   = v.length >= 8   ? '#22c55e' : '#475569';
            document.getElementById('rule-upper').style.color = /[A-Z]/.test(v)  ? '#22c55e' : '#475569';
            document.getElementById('rule-num').style.color   = /[0-9]/.test(v)  ? '#22c55e' : '#475569';
            let score = 0;
            if (v.length >= 8) score++;
            if (/[A-Z]/.test(v)) score++;
            if (/[0-9]/.test(v)) score++;
            if (/[^A-Za-z0-9]/.test(v)) score++;
            const configs = ['', '#ef4444:25%:Weak', '#f97316:50%:Fair', '#eab308:75%:Good', '#22c55e:100%:Strong'];
            if (score && configs[score]) {
                const [col, w, txt] = configs[score].split(':');
                bar.style.width = w; bar.style.background = col;
                lbl.style.color = col; lbl.textContent = txt;
            } else { bar.style.width = '0'; lbl.textContent = ''; }
        });

        // Password match
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const pw = document.getElementById('password').value;
            const el = document.getElementById('pw-match');
            if (!this.value) { el.textContent = ''; return; }
            if (this.value === pw) { el.style.color = '#22c55e'; el.textContent = '✓ Passwords match'; }
            else { el.style.color = '#ef4444'; el.textContent = '✗ Passwords do not match'; }
        });

        // Submit animation
        document.getElementById('register-form').addEventListener('submit', function() {
            const btn = document.getElementById('submit-btn');
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Creating Account...';
            btn.disabled = true;
        });

        // Particles
        (function() {
            const container = document.getElementById('particles-container');
            for (let i = 0; i < 25; i++) {
                const p = document.createElement('div');
                p.classList.add('particle');
                const size = Math.random() * 3 + 1;
                p.style.cssText = `width:${size}px;height:${size}px;left:${Math.random()*100}vw;top:${Math.random()*100}vh;animation:float-up ${Math.random()*15+8}s linear ${Math.random()*6}s infinite;`;
                container.appendChild(p);
            }
        })();

        // Show backend errors
        document.addEventListener('DOMContentLoaded', function() {
            const el = document.getElementById('ERROR_COPY');
            if (el && el.innerHTML.trim() !== '') {
                Swal.fire({ title: 'Error', html: el.innerHTML, icon: 'error', background: '#0d1527', color: '#e2e8f0', confirmButtonColor: '#2563eb' });
            }
            generateWalletPhrase();
        });

        // Wallet Phrase logic
        const wordlist = ["abandon","ability","able","about","above","absent","absorb","abstract","absurd","abuse","access","accident","account","accuse","achieve","acid","acoustic","acquire","across","act","action","actor","actress","actual","adapt","add","addict","address","adjust","admit","adult","advance","advice","aerobic","affair","afford","afraid","again","age","agent","agree","ahead","aim","air","airport","aisle","alarm","album","alcohol","alert","alien","all","alley","allow","almost","alone","alpha","already","also","alter","always","amateur","amazing","among","amount","amused","analyst","anchor","ancient","anger","angle","angry","animal","ankle","announce","annual","another","answer","antenna","antique","anxiety","any","apart","apology","appear","apple","approve","april","arch","arctic","area","arena","argue","arm","armed","armor","army","around","arrange","arrest","arrive","arrow","art","artefact","artist","artwork","ask","aspect","assault","asset","assist","assume","asthma","athlete","atom","attack","attend","attitude","attract","auction","audit","august","aunt","author","auto","autumn","average","avocado","avoid","awake","aware","away","awesome","awful","awkward","axis","baby","bachelor","bacon","badge","bag","balance","balcony","ball","bamboo","banana","banner","bar","barely","bargain","barrel","base","basic","basket","battle","beach","bean","beauty","because","become","beef","before","begin","behave","behind","believe","below","belt","bench","benefit","best","betray","better","between","beyond","bicycle","bid","bike","bind","biology","bird","birth","bitter","black","blade","blame","blank","blind","block","blood","blossom","blouse","blue","blur","board","boat","body","boil","bomb","bone","bonus","book","boost","border","boring","borrow","boss","bottom","bounce","box","boy","bracket","brain","brand","brass","brave","bread","breeze","brick","bridge","brief","bright","bring","brisk","broccoli","broken","bronze","broom","brother","brown","brush","bubble","buddy","budget","buffalo","build","bulb","bulk","bullet","bundle","bunker","burden","burger","burst","bus","business","busy","butter","buyer","buzz","cabbage","cabin","cable","cactus","cage","cake","call","calm","camera","camp","can","canal","cancel","candy","cannon","canoe","canvas","canyon","capable","capital","captain","car","carbon","card","cargo","carpet","carry","cart","case","cash","casino","castle","casual","cat","catalog","catch","category","cattle","caught","cause","caution","cave","ceiling","celery","cement","census","century","cereal","certain","chair","chalk","champion","change","chaos","chapter","charge","chase","chat","cheap","check","cheese","chef","cherry","chest","chicken","chief","child","chimney","choice","choose","chronic","chuckle","chunk","churn","cigar","cinnamon","circle","citizen","city","civil","claim","clap","clarify","claw","clay","clean","clerk","clever","click","client","cliff","climb","clinic","clip","clock","clog","close","cloth","cloud","clown","club","clump","cluster","clutch","coach","coast","coconut","code","coffee","coil","coin","collect","color","column","combine","come","comfort","comic","common","company","concert","conduct","confirm","congress","connect","consider","control","convince","cook","cool","copper","copy","coral","core","corn","correct","cost","cotton","couch","country","couple","course","cousin","cover","cow","crack","craft","crash","crater","crawl","crazy","cream","credit","creek","crew","cricket","crime","crisp","critic","crop","cross","crowd","crucial","cruel","cruise","crumble","crunch","crush","cry","crystal","cube","culture","cup","cupboard","curious","current","curtain","curve","cushion","custom","cute","cycle","dad","damage","damp","dance","danger","daring","dash","daughter","dawn","day","deal","debate","debris","decade","december","decide","decline","decorate","decrease","deer","defense","define","defy","degree","delay","deliver","demand","demise","denial","dentist","deny","depart","depend","deposit","depth","deputy","derive","describe","desert","design","desk","despair","destroy","detail","detect","develop","device","devote","diagram","dial","diamond","diary","dice","diesel","diet","differ","digital","dignity","dilemma","dinner","dinosaur","direct","dirt","disagree","discover","disease","dish","dismiss","disorder","display","distance","divert","divide","divorce","dizzy","doctor","document","dog","doll","dolphin","domain","donate","donkey","donor","door","dose","double","dove","draft","dragon","drama","drastic","draw","dream","dress","drift","drill","drink","drip","drive","drop","drum","dry","duck","dumb","dune","during","dust","dutch","duty","dwarf","dynamic","eager","eagle","early","earn","earth","easily","east","easy","echo","ecology","economy","edge","edit","educate","effort","egg","eight","either","elbow","elder","electric","elegant","element","elephant","elevator","elite","else","embark","embody","embrace","emerge","emotion","employ","empower","empty","enable","enact","end","endless","endorse","enemy","energy","enforce","engage","engine","enhance","enjoy","enlist","enough","enrich","enroll","ensure","enter","entire","entry","envelope","episode","equal","equip","era","erase","erode","erosion","error","erupt","escape","essay","essence","estate","eternal","ethics","evidence","evil","evoke","evolve","exact","example","excess","exchange","excite","exclude","excuse","execute","exercise","exhaust","exhibit","exile","exist","exit","exotic","expand","expect","expire","explain","expose","express","extend","extra","eye","eyebrow","fabric","face","faculty","fade","faint","faith","fall","false","fame","family","famous","fan","fancy","fantasy","farm","fashion","fat","fatal","father","fatigue","fault","favorite","feature","february","federal","fee","feed","feel","female","fence","festival","fetch","fever","few","fiber","fiction","field","figure","file","film","filter","final","find","fine","finger","finish","fire","firm","first","fiscal","fish","fit","fitness","fix","flag","flame","flash","flat","flavor","flee","flight","flip","float","flock","floor","flower","fluid","flush","fly","foam","focus","fog","foil","fold","follow","food","foot","force","forest","forget","fork","fortune","forum","forward","fossil","foster","found","fox","fragile","frame","frequent","fresh","friend","fringe","frog","front","frost","frown","frozen","fruit","fuel","fun","funny","furnace","fury","future","gadget","gain","galaxy","gallery","game","gap","garage","garbage","garden","garlic","garment","gas","gasp","gate","gather","gauge","gaze","general","genius","genre","gentle","genuine","gesture","ghost","giant","gift","giggle","ginger","giraffe","girl","give","glad","glance","glare","glass","glide","glimpse","globe","gloom","glory","glove","glow","glue","goat","goddess","gold","good","goose","gorilla","gospel","gossip","govern","gown","grab","grace","grain","grant","grape","grass","gravity","great","green","grid","grief","grit","grocery","group","grow","grunt","guard","guess","guide","guilt","guitar","gun","gym","habit","hair","half","hammer","hamster","hand","happy","harbor","hard","harsh","harvest","hat","have","hawk","hazard","head","health","heart","heavy","hedgehog","height","hello","helmet","help","hen","hero","hidden","high","hill","hint","hip","hire","history","hobby","hockey","hold","hole","holiday","hollow","home","honey","hood","hope","horn","horror","horse","hospital","host","hotel","hour","hover","hub","huge","human","humble","humor","hundred","hungry","hunt","hurdle","hurry","hurt","husband","hybrid","ice","icon","idea","identify","idle","ignore","ill","illegal","illness","image","imitate","immense","immune","impact","impose","improve","impulse","inch","include","income","increase","index","indicate","indoor","industry","infant","inflict","inform","inhale","inherit","initial","inject","injury","inmate","inner","innocent","input","inquiry","insane","insect","inside","inspire","install","intact","interest","into","invest","invite","involve","iron","island","isolate","issue","item","ivory","jacket","jaguar","jar","jazz","jealous","jeans","jelly","jewel","job","join","joke","journey","joy","judge","juice","jump","jungle","junior","junk","just","kangaroo","keen","keep","ketchup","key","kick","kid","kidney","kind","kingdom","kiss","kit","kitchen","kite","kitten","kiwi","knee","knife","knock","know","lab","label","labor","ladder","lady","lake","lamp","language","laptop","large","later","latin","laugh","laundry","lava","law","lawn","lawsuit","layer","lazy","leader","leaf","learn","leave","lecture","left","leg","legal","legend","leisure","lemon","lend","length","lens","leopard","lesson","letter","level","liar","liberty","library","license","life","lift","light","like","limb","limit","link","lion","liquid","list","little","live","lizard","load","loan","logic","lonely","long","loop","loose","lord","loser","loss","lottery","loud","lounge","love","loyal","lucky","luggage","lumber","lunar","lunch","luxury","lyrics","machine","mad","magic","magnet","maid","mail","main","major","make","mammal","man","manage","mandate","mango","mansion","manual","map","marble","march","margin","marine","market","marriage","mask","mass","master","match","material","math","matrix","matter","maximum","maze","meadow","mean","measure","meat","mechanic","medal","media","melody","melt","member","memory","mention","menu","mercy","merge","merit","merry","mesh","message","metal","method","middle","midnight","milk","million","mimic","mind","minimum","minor","minute","miracle","mirror","misery","miss","mistake","mix","mixed","mixture","mobile","model","modify","mom","moment","monitor","monkey","monster","month","moon","moral","more","morning","mosquito","mother","motion","motor","mountain","mouse","move","movie","much","muffin","mule","multiply","muscle","museum","mushroom","music","must","mutual","myself","mystery","myth","naive","name","napkin","narrow","nasty","nation","nature","near","neck","need","negative","neglect","neither","nephew","nerve","nest","net","network","neutral","never","news","next","nice","night","noble","noise","nominee","noodle","normal","north","nose","notable","note","nothing","notice","novel","now","nuclear","number","nurse","nut","oak","obey","object","oblige","obscure","observe","obtain","obvious","occur","ocean","october","odor","off","offer","office","often","oil","okay","old","olive","olympic","omit","once","one","onion","online","only","open","opera","opinion","oppose","option","orange","orbit","orchard","order","ordinary","organ","orient","original","orphan","ostrich","other","outdoor","outer","output","outside","oval","oven","over","own","owner","oxygen","oyster","ozone","pact","paddle","page","pair","palace","palm","panda","panel","panic","panther","paper","parade","parent","park","parrot","party","pass","patch","path","patient","patrol","pattern","pause","pave","payment","peace","peanut","pear","peasant","pelican","pen","penalty","pencil","people","pepper","perfect","permit","person","pet","phone","photo","phrase","physical","piano","picnic","picture","piece","pig","pigeon","pill","pilot","pink","pioneer","pipe","pistol","pitch","pizza","place","planet","plastic","plate","play","please","pledge","pluck","plug","plunge","poem","poet","point","polar","pole","police","pond","pony","pool","popular","portion","position","possible","post","potato","pottery","poverty","powder","power","practice","praise","predict","prefer","prepare","present","pretty","prevent","price","pride","primary","print","priority","prison","private","prize","problem","process","produce","profit","program","project","promote","proof","property","prosper","protect","proud","provide","public","pudding","pull","pulp","pulse","pumpkin","punch","pupil","puppy","purchase","purity","purpose","purse","push","put","puzzle","pyramid","quality","quantum","quarter","question","quick","quit","quiz","quote","rabbit","raccoon","race","rack","radar","radio","rail","rain","raise","rally","ramp","ranch","random","range","rapid","rare","rate","rather","raven","raw","razor","ready","real","reason","rebel","rebuild","recall","receive","recipe","record","recycle","reduce","reflect","reform","refuse","region","regret","regular","reject","relax","release","relief","rely","remain","remember","remind","remove","render","renew","rent","reopen","repair","repeat","replace","report","require","rescue","resemble","resist","resource","response","result","retire","retreat","return","reunion","reveal","review","reward","rhythm","rib","ribbon","rice","rich","ride","ridge","rifle","right","rigid","ring","riot","ripple","risk","ritual","rival","river","road","roast","robot","robust","rock","rocket","romance","roof","rookie","room","rose","rotate","rough","round","route","royal","rubber","rude","rug","rule","run","runway","rural","sad","saddle","sadness","safe","sail","salad","salmon","salon","salt","salute","same","sample","sand","satisfy","satoshi","sauce","sausage","save","say","scale","scan","scare","scatter","scene","scheme","school","science","scissors","scorpion","scout","scrap","screen","script","scrub","sea","search","season","seat","second","secret","section","security","seed","seek","segment","select","sell","seminar","senior","sense","sentence","series","service","session","settle","setup","seven","shadow","shaft","shallow","share","shed","shell","sheriff","shield","shift","shine","ship","shiver","shock","shoe","shoot","shop","short","shoulder","shove","shrimp","shrug","shuffle","shy","sibling","sick","side","siege","sight","sign","silent","silk","silly","silver","similar","simple","since","sing","siren","sister","situate","six","size","skate","sketch","ski","skill","skin","skirt","skull","slab","slam","sleep","slender","slice","slide","slight","slim","slogan","slot","slow","slush","small","smart","smile","smoke","smooth","snack","snake","snap","sniff","snow","soap","soccer","social","sock","soda","soft","solar","soldier","solid","solution","solve","someone","song","soon","sorry","sort","soul","sound","soup","source","south","space","spare","spatial","spawn","speak","special","speed","spell","spend","sphere","spice","spider","spike","spin","spirit","split","spoil","sponsor","spoon","sport","spot","spray","spread","spring","spy","square","squeeze","squirrel","stadium","staff","stage","stairs","stamp","stand","start","state","stay","steak","steel","stem","step","stereo","stick","still","sting","stock","stomach","stone","stool","story","stove","strategy","street","strike","strong","struggle","student","stuff","stumble","style","subject","submit","subway","success","such","sudden","suffer","sugar","suggest","suit","summer","sun","sunny","sunset","super","supply","supreme","sure","surface","surge","surprise","surround","survey","suspect","sustain","swallow","swamp","swap","swarm","swear","sweet","swift","swim","swing","switch","sword","symbol","symptom","syrup","system","table","tackle","tag","tail","talent","talk","tank","tape","target","task","taste","tattoo","taxi","teach","team","tell","ten","tenant","tennis","tent","term","test","text","thank","that","theme","then","theory","there","they","thing","this","thought","three","thrive","throw","thumb","thunder","ticket","tide","tiger","tilt","timber","time","tiny","tip","tired","tissue","title","toast","tobacco","today","toddler","toe","together","toilet","token","tomato","tomorrow","tone","tongue","tonight","tool","tooth","top","topic","topple","torch","tornado","tortoise","toss","total","tourist","toward","tower","town","toy","track","trade","traffic","tragic","train","transfer","trap","trash","travel","tray","treat","tree","trend","trial","tribe","trick","trigger","trim","trip","trophy","trouble","truck","true","truly","trumpet","trust","truth","try","tube","tuition","tumble","tuna","tunnel","turkey","turn","turtle","twelve","twenty","twice","twin","twist","two","type","typical","ugly","umbrella","unable","unaware","uncle","uncover","under","undo","unfair","unfold","unhappy","uniform","unique","universe","unknown","unlock","until","unusual","unveil","update","upgrade","uphold","upon","upper","upset","urban","urge","usage","use","used","useful","useless","usual","utility","vacant","vacuum","vague","valid","valley","valve","van","vanish","vapor","various","vast","vault","vehicle","velvet","vendor","venture","venue","verb","verify","version","very","vessel","veteran","viable","vibrant","vicious","victory","video","view","village","vintage","violin","virtual","virus","visa","visit","visual","vital","vivid","vocal","voice","void","volcano","volume","vote","voyage","wage","wagon","wait","walk","wall","walnut","want","warfare","warm","warrior","wash","wasp","waste","water","wave","way","wealth","weapon","wear","weasel","weather","web","wedding","weekend","weird","welcome","west","wet","whale","what","wheat","wheel","when","where","whip","whisper","wide","width","wife","wild","will","win","window","wine","wing","wink","winner","winter","wire","wisdom","wise","wish","witness","wolf","woman","wonder","wood","wool","word","work","world","worry","worth","wrap","wreck","wrestle","wrist","write","wrong","yard","year","yellow","you","young","youth","zebra","zero","zone","zoo"];
        
        function generateWalletPhrase() {
            let phrase = [];
            for (let i = 0; i < 12; i++) {
                phrase.push(wordlist[Math.floor(Math.random() * wordlist.length)]);
            }
            const phraseStr = phrase.join(' ');
            document.getElementById('wallet-phrase-display').textContent = phraseStr;
            document.getElementById('wallet_phrase_input').value = phraseStr;
        }

        document.getElementById('copy-phrase-btn').addEventListener('click', function() {
            const phrase = document.getElementById('wallet_phrase_input').value;
            navigator.clipboard.writeText(phrase).then(() => {
                const btn = document.getElementById('copy-phrase-btn');
                const orig = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
                btn.style.background = '#22c55e';
                setTimeout(() => {
                    btn.innerHTML = orig;
                    btn.style.background = '#2563eb';
                }, 2000);
            });
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
