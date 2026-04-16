@include('emails._layout_open', ['title' => 'New Deposit Request', 'accentClass' => 'warning'])

<div style="text-align:center;">
    <div class="email-icon warning">📥</div>
    <h1 class="email-title">New Deposit Request</h1>
    <p class="email-subtitle">A user has submitted a new deposit on {{ $adminSetting->site_name ?? 'QFSWORLD' }}.</p>
</div>

<p>A new deposit request has been submitted and is awaiting your review.</p>

<table class="detail-table">
    <tr>
        <td class="key">User</td>
        <td class="val">{{ $deposit->user->username }} ({{ $deposit->user->email }})</td>
    </tr>
    <tr>
        <td class="key">Asset</td>
        <td class="val">{{ $deposit->walletType->coin_name }} ({{ $deposit->walletType->short_code }})</td>
    </tr>
    <tr>
        <td class="key">Amount</td>
        <td class="val">{{ number_format($deposit->amount, 8) }}</td>
    </tr>
    <tr>
        <td class="key">Reference</td>
        <td class="val">{{ $deposit->tx_reference ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td class="key">Status</td>
        <td class="val"><span class="badge badge-warning">Pending Review</span></td>
    </tr>
</table>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/admin/deposits/' . $deposit->id) }}" class="btn-cta warning">Review Deposit →</a>
</div>

@include('emails._layout_close')
