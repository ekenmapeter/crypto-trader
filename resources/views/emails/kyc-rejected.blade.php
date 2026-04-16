@include('emails._layout_open', ['title' => 'KYC Verification Rejected', 'accentClass' => 'danger'])

<div style="text-align:center;">
    <div class="email-icon danger">⚠️</div>
    <h1 class="email-title">KYC Verification Rejected</h1>
    <p class="email-subtitle">Please review the reason and resubmit your verification.</p>
</div>

<p>Hello <strong>{{ $user->name }}</strong>,</p>
<p>We regret to inform you that your KYC verification has been rejected. Please review the details and reason below, then resubmit your documents.</p>

<table class="detail-table">
    <tr>
        <td class="key">Submission Date</td>
        <td class="val">{{ $verification->created_at->format('M d, Y H:i') }}</td>
    </tr>
    <tr>
        <td class="key">Document Type</td>
        <td class="val">{{ $verification->document_type }}</td>
    </tr>
    <tr>
        <td class="key">Country</td>
        <td class="val">{{ $verification->country }}</td>
    </tr>
    <tr>
        <td class="key">Status</td>
        <td class="val"><span class="badge badge-danger">Rejected</span></td>
    </tr>
</table>

@if($reason)
<div class="info-box danger">
    <p><strong style="color:#fca5a5;">Reason for Rejection:</strong></p>
    <p>{{ $reason }}</p>
</div>
@endif

<div class="info-box">
    <p><strong style="color:#93c5fd;">Next Steps:</strong></p>
    <p>
        1. Review the rejection reason above<br>
        2. Ensure all documents are clear and legible<br>
        3. Verify all information matches your official documents<br>
        4. Resubmit your KYC verification
    </p>
</div>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/user/kyc') }}" class="btn-cta">Resubmit KYC →</a>
</div>

<div class="divider"></div>
<p style="font-size:13px;text-align:center;">
    Need assistance? Contact us at
    <a href="mailto:{{ $adminSetting->support_email ?? '' }}">{{ $adminSetting->support_email ?? '' }}</a>
</p>

@include('emails._layout_close')
