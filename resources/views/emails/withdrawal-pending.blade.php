@include('emails._layout_open', ['title' => 'Withdrawal Request Received', 'accentClass' => ''])

<div style="text-align:center;">
    <div class="email-icon">⏳</div>
    <h1 class="email-title">Withdrawal Request Received</h1>
    <p class="email-subtitle">We've got your request and it's now under review.</p>
</div>

<p>Hello <strong>{{ $withdrawal->user->firstname }}</strong>,</p>
<p>We have received your withdrawal request. Your funds have been temporarily held and our team will process your request shortly.</p>

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
        <td class="val"><span class="badge badge-info">Pending Review</span></td>
    </tr>
</table>

<div class="info-box">
    <p>📧 You will receive another email once your request has been approved and processed. This usually takes <strong style="color:#93c5fd;">1–3 business days</strong>.</p>
</div>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/user') }}" class="btn-cta">View Dashboard →</a>
</div>

@include('emails._layout_close')
