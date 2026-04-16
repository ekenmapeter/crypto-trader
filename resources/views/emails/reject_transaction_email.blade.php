@include('emails._layout_open', ['title' => 'Transaction Declined', 'accentClass' => 'danger'])

<div style="text-align:center;">
    <div class="email-icon danger">❌</div>
    <h1 class="email-title">Transaction Declined</h1>
    <p class="email-subtitle">Unfortunately your transaction could not be completed.</p>
</div>

<p>We're sorry to inform you that your transaction has been declined.</p>
<p>{{ $activities->message }}</p>

<div class="info-box danger">
    <p>❌ This transaction has been reviewed and declined by our team. Please contact support if you believe this is an error.</p>
</div>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/user') }}" class="btn-cta">Go to Dashboard →</a>
</div>

<div class="divider"></div>
<p style="font-size:13px;text-align:center;">
    Need help? Contact us at
    <a href="mailto:{{ $adminSetting->support_email ?? 'support@qfsworld.com' }}">{{ $adminSetting->support_email ?? 'support@qfsworld.com' }}</a>
</p>

@include('emails._layout_close')
