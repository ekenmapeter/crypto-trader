@include('emails._layout_open', ['title' => 'New Withdrawal Request', 'accentClass' => 'warning'])

<div style="text-align:center;">
    <div class="email-icon warning">📤</div>
    <h1 class="email-title">New Withdrawal Request</h1>
    <p class="email-subtitle">A user has submitted a new withdrawal on {{ $adminSetting->site_name ?? 'QFSWORLD' }}.</p>
</div>

<p>A new withdrawal request has been submitted and requires your review.</p>

<table class="detail-table">
    <tr>
        <td class="key">User</td>
        <td class="val">{{ $withdrawal->user->username }} ({{ $withdrawal->user->email }})</td>
    </tr>
    <tr>
        <td class="key">Asset</td>
        <td class="val">{{ $withdrawal->walletType->coin_name }} ({{ $withdrawal->walletType->short_code }})</td>
    </tr>
    <tr>
        <td class="key">Amount</td>
        <td class="val">{{ number_format($withdrawal->amount, 8) }}</td>
    </tr>
    <tr>
        <td class="key">Method</td>
        <td class="val">{{ ucfirst($withdrawal->method) }}</td>
    </tr>
    @if($withdrawal->method === 'crypto')
    <tr>
        <td class="key">Destination</td>
        <td class="val" style="word-break:break-all;">{{ $withdrawal->destination_address }}</td>
    </tr>
    @elseif($withdrawal->method === 'bank')
    <tr>
        <td class="key">Bank Details</td>
        <td class="val">
            {{ $withdrawal->bank_name }}<br>
            {{ $withdrawal->account_name }}<br>
            {{ $withdrawal->account_number }}
        </td>
    </tr>
    @endif
    <tr>
        <td class="key">Status</td>
        <td class="val"><span class="badge badge-warning">Pending Review</span></td>
    </tr>
</table>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/admin/withdrawals/' . $withdrawal->id) }}" class="btn-cta warning">Review Withdrawal →</a>
</div>

@include('emails._layout_close')
