@include('emails._layout_open', ['title' => 'Card Request Not Approved', 'accentClass' => 'danger'])

<div style="text-align:center;">
    <div class="email-icon danger">❌</div>
    <h1 class="email-title">Card Request Not Approved</h1>
    <p class="email-subtitle">Unfortunately your card application could not be approved at this time.</p>
</div>

<p>Dear <strong>{{ $cardRequest->cardholder_name }}</strong>,</p>
<p>We regret to inform you that your card request has not been approved at this time. Please review the details and reason below.</p>

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
        <td class="val"><span class="badge badge-danger">Rejected</span></td>
    </tr>
    <tr>
        <td class="key">Processed On</td>
        <td class="val">{{ $cardRequest->rejected_at->format('F j, Y \a\t g:i A') }}</td>
    </tr>
</table>

@if($cardRequest->admin_notes)
<div class="info-box danger">
    <p><strong style="color:#fca5a5;">Reason for Rejection:</strong></p>
    <p>{{ $cardRequest->admin_notes }}</p>
</div>
@endif

<div class="info-box">
    <p>💡 <strong style="color:#93c5fd;">Next Steps:</strong> You may be able to reapply in the future. Please review the feedback above and ensure all requirements are met before submitting a new application.</p>
</div>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/user') }}" class="btn-cta">Go to Dashboard →</a>
</div>

<div class="divider"></div>
<p style="font-size:13px;text-align:center;">
    Need help? Contact us at
    <a href="mailto:{{ $adminSetting->support_email ?? '' }}">{{ $adminSetting->support_email ?? '' }}</a>
</p>

@include('emails._layout_close')
