@include('emails._layout_open', ['title' => 'Withdrawal Approved', 'accentClass' => 'success'])

<div style="text-align:center;">
    <div class="email-icon success">💸</div>
    <h1 class="email-title">Withdrawal Approved!</h1>
    <p class="email-subtitle">Your withdrawal has been processed and is on its way.</p>
</div>

<p>Hello <strong>{{ $withdrawal->user->username }}</strong>,</p>
<p>Your withdrawal request has been reviewed and approved. Your funds are being processed and will arrive at your destination shortly.</p>

<table class="detail-table">
    <tr>
        <td class="key">Asset</td>
        <td class="val">{{ $withdrawal->walletType->coin_name }}</td>
    </tr>
    <tr>
        <td class="key">Amount</td>
        <td class="val">{{ number_format($withdrawal->amount, 8) }} {{ strtoupper($withdrawal->walletType->short_code) }}</td>
    </tr>
    <tr>
        <td class="key">Method</td>
        <td class="val">{{ ucfirst($withdrawal->method) }}</td>
    </tr>
    <tr>
        <td class="key">Status</td>
        <td class="val"><span class="badge badge-success">Approved</span></td>
    </tr>
    <tr>
        <td class="key">Date</td>
        <td class="val">{{ $withdrawal->updated_at->format('M d, Y H:i') }}</td>
    </tr>
</table>

<div class="info-box success">
    <p>✅ Funds are on their way! Delivery time depends on network congestion and your chosen method.</p>
</div>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/user') }}" class="btn-cta success">View Dashboard →</a>
</div>

<div class="divider"></div>
<p style="font-size:13px;text-align:center;color:#475569;">Thank you for choosing {{ $adminSetting->site_name ?? 'QFSWORLD' }}.</p>

@include('emails._layout_close')
