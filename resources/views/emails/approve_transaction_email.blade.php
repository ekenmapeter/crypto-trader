@include('emails._layout_open', ['title' => 'Transaction Approved', 'accentClass' => 'success'])

<div style="text-align:center;">
    <div class="email-icon success">✅</div>
    <h1 class="email-title">Transaction Approved</h1>
    <p class="email-subtitle">Your transaction has been successfully processed.</p>
</div>

<p>Congratulations!</p>
<p>{{ $activities->message }}</p>

<div class="info-box success">
    <p>✅ This transaction has been reviewed and approved by our team.</p>
</div>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/user') }}" class="btn-cta success">View Dashboard →</a>
</div>

<div class="divider"></div>
<p style="font-size:13px;text-align:center;">
    Thank you for choosing our platform.<br>
    <a href="mailto:{{ $adminSetting->support_email ?? 'support@qfsworld.com' }}">{{ $adminSetting->support_email ?? 'support@qfsworld.com' }}</a>
</p>

@include('emails._layout_close')
