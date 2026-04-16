@include('emails._layout_open', ['title' => 'KYC Verification Submitted', 'accentClass' => ''])

<div style="text-align:center;">
    <div class="email-icon">📋</div>
    <h1 class="email-title">KYC Submitted for Review</h1>
    <p class="email-subtitle">We've received your verification documents and are reviewing them.</p>
</div>

<p>Hello <strong>{{ $user->name }}</strong>,</p>
<p>Your KYC verification has been successfully submitted and is currently under review by our compliance team.</p>

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
        <td class="val"><span class="badge badge-info">Under Review</span></td>
    </tr>
</table>

<div class="info-box">
    <p>🕒 <strong style="color:#93c5fd;">Review Timeline:</strong> Our team typically processes KYC submissions within <strong style="color:#93c5fd;">24–48 hours</strong>. You'll receive an email notification once the review is complete.</p>
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
