@include('emails._layout_open', ['title' => 'Withdrawal Declined', 'accentClass' => 'danger'])

<div style="text-align:center;">
    <div class="email-icon danger">❌</div>
    <h1 class="email-title">Withdrawal Declined</h1>
    <p class="email-subtitle">Your withdrawal request could not be processed at this time.</p>
</div>

<p>Hello <strong>{{ $withdrawal->user->firstname }}</strong>,</p>
<p>We regret to inform you that your withdrawal request has been declined. Please see the details and reason below.</p>

<table class="detail-table">
    <tr>
        <td class="key">Amount</td>
        <td class="val">{{ number_format($withdrawal->amount, 2) }} {{ $withdrawal->walletType->short_code }}</td>
    </tr>
    <tr>
        <td class="key">Method</td>
        <td class="val">{{ ucfirst($withdrawal->method) }}</td>
    </tr>
    <tr>
        <td class="key">Date</td>
        <td class="val">{{ $withdrawal->created_at->format('jS F Y, g:i A') }}</td>
    </tr>
    <tr>
        <td class="key">Status</td>
        <td class="val"><span class="badge badge-danger">Declined</span></td>
    </tr>
</table>

@if($withdrawal->admin_notes)
<div class="info-box danger">
    <p><strong style="color:#fca5a5;">Reason for Decline:</strong></p>
    <p>{{ $withdrawal->admin_notes }}</p>
</div>
@endif

<div class="info-box">
    <p>💡 <strong style="color:#93c5fd;">Good news:</strong> Your funds have been automatically refunded to your available balance. You may submit a new withdrawal request or contact support for assistance.</p>
</div>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/user') }}" class="btn-cta">Go to Dashboard →</a>
</div>

<div class="divider"></div>
<p style="font-size:13px;text-align:center;">
    Need help? Contact support at
    <a href="mailto:{{ $adminSetting->support_email ?? '' }}">{{ $adminSetting->support_email ?? '' }}</a>
</p>

@include('emails._layout_close')
