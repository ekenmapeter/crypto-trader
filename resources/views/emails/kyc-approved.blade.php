@include('emails._layout_open', ['title' => 'KYC Verification Approved', 'accentClass' => 'success'])

<div style="text-align:center;">
    <div class="email-icon success">🎉</div>
    <h1 class="email-title">KYC Verification Approved!</h1>
    <p class="email-subtitle">Your identity has been verified. Full platform access is now unlocked.</p>
</div>

<p>Hello <strong>{{ $user->name }}</strong>,</p>
<p>Great news! Your KYC (Know Your Customer) verification has been reviewed and approved. Your account is now fully verified.</p>

<table class="detail-table">
    <tr>
        <td class="key">Approval Date</td>
        <td class="val">{{ $verification->updated_at->format('M d, Y H:i') }}</td>
    </tr>
    <tr>
        <td class="key">Document Type</td>
        <td class="val">{{ $verification->document_type }}</td>
    </tr>
    <tr>
        <td class="key">Country</td>
        <td class="val">{{ $verification->country }}</td>
    </tr>
    <tr>
        <td class="key">Status</td>
        <td class="val"><span class="badge badge-success">Verified</span></td>
    </tr>
</table>

<div class="info-box success">
    <p><strong style="color:#6ee7b7;">With your verified account you can now:</strong></p>
    <p>• Access higher transaction limits<br>• Use all platform features<br>• Enjoy enhanced security benefits</p>
</div>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/user') }}" class="btn-cta success">Go to Dashboard →</a>
</div>

<div class="divider"></div>
<p style="font-size:13px;text-align:center;color:#475569;">Thank you for your patience during the verification process.</p>

@include('emails._layout_close')
