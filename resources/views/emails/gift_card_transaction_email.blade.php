@include('emails._layout_open', ['title' => 'Gift Card Transaction Receipt', 'accentClass' => ''])

<div style="text-align:center;">
    <div class="email-icon">🎁</div>
    <h1 class="email-title">Gift Card Transaction Receipt</h1>
    <p class="email-subtitle">Your gift card has been successfully submitted.</p>
</div>

<p>Hello <strong>{{ $transaction->user->username ?? 'Valued Customer' }}</strong>,</p>
<p>We've received your gift card submission and it is currently being processed. Here are your transaction details:</p>

<table class="detail-table">
    <tr>
        <td class="key">Transaction ID</td>
        <td class="val" style="font-family:monospace;font-size:12px;">{{ $transaction->id }}</td>
    </tr>
    <tr>
        <td class="key">Card Type</td>
        <td class="val">{{ $transaction->card_type }}</td>
    </tr>
    <tr>
        <td class="key">Card Country</td>
        <td class="val">{{ $transaction->card_country_type }}</td>
    </tr>
    <tr>
        <td class="key">Card Amount</td>
        <td class="val">{{ $transaction->card_amount }}</td>
    </tr>
    <tr>
        <td class="key">Payout Amount</td>
        <td class="val"><strong style="color:#3b82f6;">{{ $transaction->amount }}</strong></td>
    </tr>
    <tr>
        <td class="key">Type</td>
        <td class="val"><span class="badge badge-info">Gift Card</span></td>
    </tr>
    <tr>
        <td class="key">Status</td>
        <td class="val"><span class="badge badge-warning">Pending</span></td>
    </tr>
</table>

<div class="info-box">
    <p>🔄 <strong style="color:#93c5fd;">Processing:</strong> Please allow up to 15 minutes for your transaction status to be updated. You can check the status anytime from your dashboard.</p>
</div>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/user') }}" class="btn-cta">Track Transaction →</a>
</div>

<div class="divider"></div>
<p style="font-size:13px;text-align:center;">
    Thank you for choosing {{ $adminSetting->site_name ?? 'QFSWORLD' }}.<br>
    <a href="mailto:{{ $adminSetting->support_email ?? '' }}">{{ $adminSetting->support_email ?? '' }}</a>
</p>

@include('emails._layout_close')
