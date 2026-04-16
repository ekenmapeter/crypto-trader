@include('emails._layout_open', ['title' => 'Card Request Approved', 'accentClass' => 'success'])

<div style="text-align:center;">
    <div class="email-icon success">🎉</div>
    <h1 class="email-title">Card Request Approved!</h1>
    <p class="email-subtitle">Your card application has been approved and is now active.</p>
</div>

<p>Dear <strong>{{ $cardRequest->cardholder_name }}</strong>,</p>
<p>Great news! Your card request has been reviewed and approved by our team. Your card is now active and ready to use.</p>

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
        <td class="key">Status</td>
        <td class="val"><span class="badge badge-success">Approved</span></td>
    </tr>
    <tr>
        <td class="key">Approved On</td>
        <td class="val">{{ $cardRequest->approved_at->format('F j, Y \a\t g:i A') }}</td>
    </tr>
</table>

<div style="margin:20px 0;background:rgba(37,99,235,0.08);border:1px solid rgba(59,130,246,0.2);border-radius:12px;padding:20px;">
    <p style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#475569;margin-bottom:12px;">Your Card Details</p>
    <table style="width:100%;font-size:14px;">
        <tr>
            <td style="color:#64748b;padding:6px 0;width:45%;">Card Number</td>
            <td style="color:#e2e8f0;font-weight:600;font-family:monospace;letter-spacing:0.1em;">{{ $cardRequest->card_number }}</td>
        </tr>
        <tr>
            <td style="color:#64748b;padding:6px 0;">Expiry Date</td>
            <td style="color:#e2e8f0;font-weight:600;">{{ $cardRequest->expiry_date }}</td>
        </tr>
        <tr>
            <td style="color:#64748b;padding:6px 0;">CVV</td>
            <td style="color:#e2e8f0;font-weight:600;">{{ $cardRequest->cvv }}</td>
        </tr>
    </table>
</div>

<div class="info-box danger">
    <p>🔒 <strong style="color:#fca5a5;">Security Notice:</strong> Never share your card number, expiry date, or CVV with anyone — including our support team.</p>
</div>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/user') }}" class="btn-cta success">Go to Dashboard →</a>
</div>

<div class="divider"></div>
<p style="font-size:13px;text-align:center;color:#475569;">
    Questions? Contact us at
    <a href="mailto:{{ $adminSetting->support_email ?? '' }}">{{ $adminSetting->support_email ?? '' }}</a>
</p>

@include('emails._layout_close')
