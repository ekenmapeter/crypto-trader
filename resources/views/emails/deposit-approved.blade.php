@include('emails._layout_open', ['title' => 'Deposit Approved', 'accentClass' => 'success'])

<div style="text-align:center;">
    <div class="email-icon success">✅</div>
    <h1 class="email-title">Deposit Approved!</h1>
    <p class="email-subtitle">Your deposit has been reviewed and your wallet has been credited.</p>
</div>

<p>Hello <strong>{{ $deposit->user->username }}</strong>,</p>
<p>Great news! Your deposit request has been approved and your wallet balance has been updated successfully.</p>

<table class="detail-table">
    <tr>
        <td class="key">Asset</td>
        <td class="val">{{ $deposit->walletType->coin_name }}</td>
    </tr>
    <tr>
        <td class="key">Amount</td>
        <td class="val">{{ number_format($deposit->amount, 8) }} {{ strtoupper($deposit->walletType->short_code) }}</td>
    </tr>
    <tr>
        <td class="key">Status</td>
        <td class="val"><span class="badge badge-success">Credited</span></td>
    </tr>
    <tr>
        <td class="key">Date</td>
        <td class="val">{{ $deposit->updated_at->format('M d, Y H:i') }}</td>
    </tr>
</table>

<div class="info-box success">
    <p>✅ Your funds are now available in your wallet and ready to use.</p>
</div>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/user') }}" class="btn-cta success">View Dashboard →</a>
</div>

<div class="divider"></div>
<p style="font-size:13px;text-align:center;color:#475569;">Thank you for choosing {{ $adminSetting->site_name ?? 'QFSWORLD' }}.</p>

@include('emails._layout_close')
