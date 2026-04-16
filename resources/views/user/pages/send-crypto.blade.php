@include('user.components.user_head', ['title' => 'Send Assets'])

<style>
    /* ─── Page Shell ─────────────────────────────────── */
    .send-page {
        min-height: 100vh;
        background: #080d1a;
        padding-bottom: 100px;
    }

    /* ─── Top Bar ─────────────────────────────────────── */
    .send-topbar {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 18px 20px;
        background: transparent;
    }
    .send-topbar .back-btn {
        position: absolute;
        left: 20px;
        width: 36px; height: 36px;
        border-radius: 50%;
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.1);
        display: flex; align-items: center; justify-content: center;
        color: #e2e8f0;
        font-size: 14px;
        text-decoration: none;
        transition: background 0.2s;
    }
    .send-topbar .back-btn:hover { background: rgba(255,255,255,0.13); }
    .send-topbar h1 {
        font-size: 17px;
        font-weight: 700;
        color: #f1f5f9;
        letter-spacing: 0.02em;
    }

    /* ─── Content Wrapper ─────────────────────────────── */
    .send-body {
        max-width: 540px;
        margin: 0 auto;
        padding: 8px 20px 32px;
    }

    /* ─── Field Label ─────────────────────────────────── */
    .field-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #475569;
        margin-bottom: 10px;
        display: block;
    }

    /* ─── Shared Input Surface ────────────────────────── */
    .input-surface {
        background: #0d1527;
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 16px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .input-surface:focus-within {
        border-color: rgba(59,130,246,0.4);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.08);
    }

    /* ─── Asset Selector ──────────────────────────────── */
    .asset-select {
        width: 100%;
        background: transparent;
        border: none;
        outline: none;
        color: #e2e8f0;
        font-size: 15px;
        font-weight: 600;
        padding: 18px 20px;
        cursor: pointer;
        font-family: 'Inter', sans-serif;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 18px center;
        padding-right: 44px;
    }
    .asset-select option { background: #0d1527; color: #e2e8f0; }

    /* ─── Amount Field ────────────────────────────────── */
    .amount-wrap { display: flex; align-items: center; padding: 6px 18px; }
    .amount-input {
        flex: 1;
        background: transparent;
        border: none;
        outline: none;
        font-size: 32px;
        font-weight: 700;
        color: #94a3b8;
        padding: 14px 0;
        font-family: 'Inter', sans-serif;
        letter-spacing: -0.5px;
        min-width: 0;
    }
    .amount-input::placeholder { color: rgba(148,163,184,0.4); }
    .amount-input:focus { color: #e2e8f0; }
    .max-btn {
        background: rgba(59,130,246,0.12);
        border: 1px solid rgba(59,130,246,0.2);
        border-radius: 8px;
        color: #3b82f6;
        font-size: 11px;
        font-weight: 700;
        padding: 5px 10px;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
        font-family: 'Inter', sans-serif;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .max-btn:hover { background: rgba(59,130,246,0.22); }

    /* Balance hint below amount */
    .balance-hint {
        font-size: 12px;
        color: #334155;
        padding: 0 20px 14px;
        font-weight: 500;
    }
    .balance-hint span { color: #3b82f6; font-weight: 700; }

    /* ─── Address Field ───────────────────────────────── */
    .address-wrap { display: flex; align-items: center; padding: 0 18px; }
    .address-input {
        flex: 1;
        background: transparent;
        border: none;
        outline: none;
        color: #e2e8f0;
        font-size: 14px;
        font-weight: 500;
        padding: 18px 0;
        font-family: 'Inter', sans-serif;
        min-width: 0;
    }
    .address-input::placeholder { color: rgba(148,163,184,0.3); }
    .paste-btn {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 8px;
        color: #64748b;
        font-size: 18px;
        padding: 6px 10px;
        cursor: pointer;
        transition: all 0.2s;
        display: flex; align-items: center; justify-content: center;
        line-height: 1;
        flex-shrink: 0;
    }
    .paste-btn:hover { background: rgba(255,255,255,0.1); color: #94a3b8; }

    /* ─── Warning Box ─────────────────────────────────── */
    .warn-box {
        background: rgba(220,38,38,0.07);
        border: 1px solid rgba(239,68,68,0.18);
        border-radius: 14px;
        padding: 14px 16px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    .warn-icon {
        width: 32px; height: 32px;
        background: rgba(220,38,38,0.12);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        font-size: 14px;
    }
    .warn-box p {
        font-size: 12px;
        color: #94a3b8;
        line-height: 1.65;
        margin: 0;
    }
    .warn-box strong { color: #f87171; }

    /* ─── Network Badge Row ───────────────────────────── */
    .network-row {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 12px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .network-label { font-size: 12px; color: #475569; font-weight: 500; }
    .network-badge {
        font-size: 11px;
        font-weight: 700;
        color: #34d399;
        background: rgba(52,211,153,0.1);
        border: 1px solid rgba(52,211,153,0.2);
        border-radius: 20px;
        padding: 3px 10px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    /* ─── Confirm Button ──────────────────────────────── */
    .confirm-btn {
        width: 100%;
        background: #fff;
        color: #0a0a0a;
        border: none;
        border-radius: 18px;
        padding: 18px 24px;
        font-size: 15px;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.2s;
        font-family: 'Inter', sans-serif;
        display: flex; align-items: center; justify-content: center; gap: 10px;
    }
    .confirm-btn:hover {
        background: #f1f5f9;
        box-shadow: 0 10px 30px rgba(255,255,255,0.15);
        transform: translateY(-1px);
    }
    .confirm-btn:active { transform: translateY(0); box-shadow: none; }
    .confirm-btn:disabled { opacity: 0.4; cursor: not-allowed; transform: none; }

    /* ─── Section spacing ─────────────────────────────── */
    .field-group { margin-bottom: 24px; }

    /* ─── PIN Modal ───────────────────────────────────── */
    .pin-modal-backdrop {
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.75);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 100;
        display: flex; align-items: flex-end; justify-content: center;
        opacity: 0; visibility: hidden;
        transition: opacity 0.3s, visibility 0.3s;
    }
    .pin-modal-backdrop.open { opacity: 1; visibility: visible; }
    .pin-modal {
        width: 100%; max-width: 540px;
        background: #0d1527;
        border: 1px solid rgba(59,130,246,0.2);
        border-radius: 28px 28px 0 0;
        padding: 28px 24px 40px;
        transform: translateY(100%);
        transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1);
    }
    .pin-modal-backdrop.open .pin-modal { transform: translateY(0); }
    .pin-modal-handle {
        width: 40px; height: 4px;
        background: rgba(255,255,255,0.12);
        border-radius: 2px;
        margin: 0 auto 24px;
    }
    .pin-title { font-size: 18px; font-weight: 700; color: #f1f5f9; text-align: center; margin-bottom: 6px; }
    .pin-sub   { font-size: 13px; color: #475569; text-align: center; margin-bottom: 28px; }
    .pin-dots  { display: flex; justify-content: center; gap: 14px; margin-bottom: 32px; }
    .pin-dot   {
        width: 16px; height: 16px;
        border-radius: 50%;
        border: 2px solid rgba(255,255,255,0.15);
        background: transparent;
        transition: all 0.2s;
    }
    .pin-dot.filled { background: #3b82f6; border-color: #3b82f6; box-shadow: 0 0 10px rgba(59,130,246,0.5); }
    .numpad { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
    .num-key {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 14px;
        padding: 18px;
        font-size: 20px;
        font-weight: 700;
        color: #e2e8f0;
        cursor: pointer;
        transition: all 0.15s;
        text-align: center;
        font-family: 'Inter', sans-serif;
        user-select: none;
    }
    .num-key:hover  { background: rgba(255,255,255,0.1); transform: scale(1.04); }
    .num-key:active { background: rgba(59,130,246,0.2); transform: scale(0.96); }
    .num-key.del    { color: #ef4444; font-size: 16px; }
    .num-key.zero   { grid-column: 2; }

    /* ─── Review Summary (inline, inside modal) ───────── */
    .review-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid rgba(255,255,255,0.05);
        font-size: 13px;
    }
    .review-row:last-child { border-bottom: none; }
    .review-row .rkey { color: #475569; font-weight: 500; }
    .review-row .rval { color: #e2e8f0; font-weight: 600; text-align: right; max-width: 60%; word-break: break-all; }

    /* ─── Success flash ───────────────────────────────── */
    @keyframes slide-up { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
    .slide-up { animation: slide-up 0.4s ease forwards; }
</style>

<div class="send-page">

    {{-- Top Bar --}}
    <div class="send-topbar">
        <a href="{{ url()->previous() }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1>Send Assets</h1>
    </div>

    <div class="send-body">

        @if(session('success'))
            <div class="slide-up" style="background:rgba(52,211,153,0.1);border:1px solid rgba(52,211,153,0.2);border-radius:12px;padding:14px 18px;margin-bottom:24px;display:flex;align-items:center;gap:10px;">
                <i class="fas fa-check-circle" style="color:#34d399;font-size:16px;flex-shrink:0;"></i>
                <span style="font-size:13px;color:#6ee7b7;">{{ session('success') }}</span>
            </div>
        @endif

        <form id="sendForm" action="{{ url('send-crypto') }}" method="POST" onsubmit="return handleSend(event)">
            @csrf

            {{-- Hidden fields filled by JS --}}
            <input type="hidden" name="coin_id" id="coinIdInput">
            <input type="hidden" name="amount"  id="amountInput">

            {{-- ① SELECT ASSET --}}
            <div class="field-group">
                <label class="field-label">Select Asset</label>
                <div class="input-surface">
                    <select class="asset-select" id="assetSelect" onchange="onAssetChange(this)">
                        @forelse($userWallets as $wallet)
                            <option value="{{ $wallet->walletType->id }}"
                                    data-balance="{{ $wallet->amount }}"
                                    data-symbol="{{ strtoupper($wallet->walletType->short_code) }}"
                                    data-name="{{ $wallet->walletType->coin_name }}">
                                {{ $wallet->walletType->coin_name }} ({{ strtoupper($wallet->walletType->short_code) }}) — {{ number_format($wallet->amount, 8) }} Available
                            </option>
                        @empty
                            <option value="" disabled>No wallets found</option>
                        @endforelse
                    </select>
                </div>
            </div>

            {{-- ② AMOUNT --}}
            <div class="field-group">
                <label class="field-label">Amount to Send</label>
                <div class="input-surface">
                    <div class="amount-wrap">
                        <input type="number" step="0.00000001" min="0"
                               class="amount-input" id="amountField"
                               placeholder="0.00"
                               oninput="onAmountInput(this)" required>
                        <button type="button" class="max-btn" onclick="setMax()">Max</button>
                    </div>
                    <div class="balance-hint" id="balanceHint">
                        Available: <span id="balanceDisplay">0.00000000</span>
                    </div>
                </div>
            </div>

            {{-- ③ RECIPIENT ADDRESS --}}
            <div class="field-group">
                <label class="field-label">Recipient Wallet Address</label>
                <div class="input-surface">
                    <div class="address-wrap">
                        <input type="text" class="address-input" id="addressField"
                               name="destination_address"
                               placeholder="Paste address (0x… or bc1…)"
                               autocomplete="off" spellcheck="false" required>
                        <button type="button" class="paste-btn" onclick="pasteAddress()" title="Paste">
                            <i class="fas fa-paste"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- ④ NETWORK --}}
            <div class="field-group">
                <div class="network-row">
                    <span class="network-label">Network</span>
                    <span class="network-badge" id="networkBadge">—</span>
                </div>
            </div>

            {{-- ⑤ WARNING --}}
            <div class="field-group">
                <div class="warn-box">
                    <div class="warn-icon">🛡️</div>
                    <p>
                        Please double-check the recipient's address. Transactions on the blockchain are <strong>IRREVERSIBLE</strong>. Ensure you are sending to the correct network.
                    </p>
                </div>
            </div>

            {{-- ⑥ CONFIRM BUTTON --}}
            <button type="button" class="confirm-btn" id="confirmBtn" onclick="openPinModal()">
                <i class="fas fa-paper-plane" style="font-size:14px;"></i>
                Confirm & Send
            </button>

        </form><!-- /sendForm -->
    </div>

</div><!-- /send-page -->


{{-- ─── PIN / Review Modal ──────────────────────────────── --}}
<div class="pin-modal-backdrop" id="pinBackdrop" onclick="handleBackdropClick(event)">
    <div class="pin-modal" id="pinModal">
        <div class="pin-modal-handle"></div>

        {{-- Step 1: Review --}}
        <div id="stepReview">
            <p class="pin-title">Review Transaction</p>
            <p class="pin-sub">Please verify the details before sending.</p>

            <div style="background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.06);border-radius:14px;padding:6px 16px;margin-bottom:24px;">
                <div class="review-row">
                    <span class="rkey">Asset</span>
                    <span class="rval" id="rv-asset">—</span>
                </div>
                <div class="review-row">
                    <span class="rkey">Amount</span>
                    <span class="rval" id="rv-amount">—</span>
                </div>
                <div class="review-row">
                    <span class="rkey">To Address</span>
                    <span class="rval" id="rv-address">—</span>
                </div>
                <div class="review-row">
                    <span class="rkey">Network</span>
                    <span class="rval" id="rv-network">—</span>
                </div>
            </div>

            <button class="confirm-btn" onclick="goToPin()" style="margin-bottom:12px;">
                <i class="fas fa-lock" style="font-size:13px;"></i>
                Confirm Details
            </button>
            <button onclick="closePinModal()" style="width:100%;background:none;border:none;color:#475569;font-size:13px;font-family:'Inter',sans-serif;cursor:pointer;padding:8px;">Cancel</button>
        </div>

        {{-- Step 2: PIN --}}
        <div id="stepPin" style="display:none;">
            <p class="pin-title">Enter Your PIN</p>
            <p class="pin-sub">Enter your 4-digit transaction PIN to authorise.</p>

            <div class="pin-dots" id="pinDots">
                <div class="pin-dot" id="dot0"></div>
                <div class="pin-dot" id="dot1"></div>
                <div class="pin-dot" id="dot2"></div>
                <div class="pin-dot" id="dot3"></div>
            </div>

            <div class="numpad">
                <button class="num-key" onclick="numPress('1')">1</button>
                <button class="num-key" onclick="numPress('2')">2</button>
                <button class="num-key" onclick="numPress('3')">3</button>
                <button class="num-key" onclick="numPress('4')">4</button>
                <button class="num-key" onclick="numPress('5')">5</button>
                <button class="num-key" onclick="numPress('6')">6</button>
                <button class="num-key" onclick="numPress('7')">7</button>
                <button class="num-key" onclick="numPress('8')">8</button>
                <button class="num-key" onclick="numPress('9')">9</button>
                <button class="num-key zero" onclick="numPress('0')">0</button>
                <button class="num-key del" onclick="numDel()"><i class="fas fa-delete-left"></i></button>
            </div>

            <p id="pinError" style="color:#ef4444;font-size:12px;text-align:center;margin-top:14px;display:none;">Incorrect PIN. Please try again.</p>
            <button onclick="closePinModal()" style="width:100%;background:none;border:none;color:#475569;font-size:13px;font-family:'Inter',sans-serif;cursor:pointer;padding:12px 0 0;">Cancel</button>
        </div>

    </div>
</div>


@include('user.components.user')

<script>
// ─── Asset state ──────────────────────────────────────────
let currentBalance = 0;
let currentSymbol  = '';
let pinValue       = '';
const correctPin   = '{{ auth()->user()->pin ?? "0000" }}'; // use user's stored PIN if available

// ─── Init ─────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    const sel = document.getElementById('assetSelect');
    if (sel && sel.options.length > 0) onAssetChange(sel);
});

function onAssetChange(sel) {
    const opt = sel.options[sel.selectedIndex];
    currentBalance = parseFloat(opt.dataset.balance || 0);
    currentSymbol  = opt.dataset.symbol || '';
    const name     = opt.dataset.name   || '';

    document.getElementById('balanceDisplay').textContent =
        currentBalance.toFixed(8) + ' ' + currentSymbol;
    document.getElementById('networkBadge').textContent = currentSymbol;
    document.getElementById('coinIdInput').value = sel.value;

    // reset amount
    document.getElementById('amountField').value = '';
}

function onAmountInput(el) {
    const v = parseFloat(el.value) || 0;
    document.getElementById('amountInput').value = el.value;
}

function setMax() {
    const field = document.getElementById('amountField');
    field.value = currentBalance.toFixed(8);
    document.getElementById('amountInput').value = field.value;
}

async function pasteAddress() {
    try {
        const text = await navigator.clipboard.readText();
        document.getElementById('addressField').value = text;
    } catch {
        document.getElementById('addressField').focus();
    }
}

// ─── Validate & open modal ────────────────────────────────
function openPinModal() {
    const amount  = parseFloat(document.getElementById('amountField').value);
    const address = document.getElementById('addressField').value.trim();
    const sel     = document.getElementById('assetSelect');
    const opt     = sel.options[sel.selectedIndex];

    if (!amount || amount <= 0) {
        Swal.fire({ icon:'warning', title:'Amount required', text:'Please enter a valid amount to send.', background:'#0d1527', color:'#e2e8f0', confirmButtonColor:'#2563eb' });
        return;
    }
    if (amount > currentBalance) {
        Swal.fire({ icon:'error', title:'Insufficient balance', text:'Your balance is lower than the amount you want to send.', background:'#0d1527', color:'#e2e8f0', confirmButtonColor:'#ef4444' });
        return;
    }
    if (!address) {
        Swal.fire({ icon:'warning', title:'Address required', text:'Please paste the recipient wallet address.', background:'#0d1527', color:'#e2e8f0', confirmButtonColor:'#2563eb' });
        return;
    }

    // Populate review
    document.getElementById('rv-asset').textContent   = opt.dataset.name + ' (' + opt.dataset.symbol + ')';
    document.getElementById('rv-amount').textContent  = amount.toFixed(8) + ' ' + currentSymbol;
    document.getElementById('rv-address').textContent = address;
    document.getElementById('rv-network').textContent = currentSymbol;

    // Show Step 1 (review)
    document.getElementById('stepReview').style.display = '';
    document.getElementById('stepPin').style.display    = 'none';
    resetPin();

    document.getElementById('pinBackdrop').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closePinModal() {
    document.getElementById('pinBackdrop').classList.remove('open');
    document.body.style.overflow = '';
    resetPin();
}

function handleBackdropClick(e) {
    if (e.target === document.getElementById('pinBackdrop')) closePinModal();
}

function goToPin() {
    document.getElementById('stepReview').style.display = 'none';
    document.getElementById('stepPin').style.display    = '';
}

// ─── PIN Logic ────────────────────────────────────────────
function numPress(digit) {
    if (pinValue.length >= 4) return;
    pinValue += digit;
    updateDots();
    if (pinValue.length === 4) {
        setTimeout(checkPin, 200);
    }
}

function numDel() {
    pinValue = pinValue.slice(0, -1);
    updateDots();
    document.getElementById('pinError').style.display = 'none';
}

function updateDots() {
    for (let i = 0; i < 4; i++) {
        const dot = document.getElementById('dot' + i);
        dot.classList.toggle('filled', i < pinValue.length);
    }
}

function resetPin() {
    pinValue = '';
    updateDots();
    document.getElementById('pinError').style.display = 'none';
}

function checkPin() {
    // If user has no pin set, we skip pin check and submit directly
    const userPin = '{!! auth()->user()->transaction_pin ?? "" !!}';
    if (userPin === '' || pinValue === userPin || pinValue === correctPin) {
        submitSend();
    } else {
        document.getElementById('pinError').style.display = 'block';
        // Shake animation
        const modal = document.getElementById('pinModal');
        modal.style.animation = 'none';
        modal.offsetHeight;
        modal.style.animation = 'pin-shake 0.4s ease';
        setTimeout(resetPin, 800);
    }
}

function submitSend() {
    // Fill hidden inputs
    document.getElementById('amountInput').value = document.getElementById('amountField').value;
    document.getElementById('coinIdInput').value = document.getElementById('assetSelect').value;

    // Show sending state
    closePinModal();
    const btn = document.getElementById('confirmBtn');
    btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>&nbsp; Sending…';
    btn.disabled = true;

    document.getElementById('sendForm').submit();
}

function handleSend(e) {
    // Form is submitted programmatically from submitSend()
    return true;
}
</script>

<style>
@keyframes pin-shake {
    0%,100%{transform:translateX(0);}
    20%,60%{transform:translateX(-8px);}
    40%,80%{transform:translateX(8px);}
}
</style>
