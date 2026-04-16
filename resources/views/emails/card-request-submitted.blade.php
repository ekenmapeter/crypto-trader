@include('emails._layout_open', ['title' => 'Card Request Submitted', 'accentClass' => ''])

<div style="text-align:center;">
    <div class="email-icon">💳</div>
    <h1 class="email-title">Card Request Submitted</h1>
    <p class="email-subtitle">Your application is under review — we'll notify you shortly.</p>
</div>

<p>Dear <strong>{{ $cardRequest->cardholder_name }}</strong>,</p>
<p>Thank you for submitting your card request with {{ $adminSetting->site_name ?? 'QFSWORLD' }}. We have received your application and it is currently under review.</p>

<table class="detail-table">
    <tr>
        <td class="key">Card Type</td>
        <td class="val">{{ $cardRequest->card_type }}</td>
    </tr>
    <tr>
        <td class="key">Cardholder Name</td>
        <td class="val">{{ $cardRequest->cardholder_name }}</td>
    </tr>
    <tr>
        <td class="key">Email</td>
        <td class="val">{{ $cardRequest->email }}</td>
    </tr>
    <tr>
        <td class="key">Phone</td>
        <td class="val">{{ $cardRequest->phone_number }}</td>
    </tr>
    <tr>
        <td class="key">Submitted</td>
        <td class="val">{{ $cardRequest->created_at->format('F j, Y \a\t g:i A') }}</td>
    </tr>
    <tr>
        <td class="key">Status</td>
        <td class="val"><span class="badge badge-info">Under Review</span></td>
    </tr>
</table>

<div class="info-box">
    <p>🕒 <strong style="color:#93c5fd;">Review Timeline:</strong> Our team typically processes card applications within <strong style="color:#93c5fd;">2–3 business days</strong>. You'll receive an email once a decision has been made.</p>
</div>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/user') }}" class="btn-cta">View Dashboard →</a>
</div>

<div class="divider"></div>
<p style="font-size:13px;text-align:center;">
    Questions? Contact us at
    <a href="mailto:{{ $adminSetting->support_email ?? '' }}">{{ $adminSetting->support_email ?? '' }}</a>
</p>

@include('emails._layout_close')
