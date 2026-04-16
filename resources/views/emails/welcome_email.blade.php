@php $accentClass = ''; @endphp
@include('emails._layout_open', [
    'title' => 'Welcome to ' . ($adminSetting->site_name ?? 'QFSWORLD'),
    'accentClass' => '',
])

<!-- Icon -->
<div style="text-align:center;">
    <h1 class="email-title">Welcome to the Future of Finance</h1>
    <p class="email-subtitle">Your account at {{ $adminSetting->site_name ?? 'QFSWORLD' }} is ready — let's get started.
    </p>
</div>

<p>Hello <strong>{{ $user->firstname }}</strong>,</p>
<p>Congratulations! Your account has been successfully created. We're thrilled to have you on board.</p>
<p>A <strong>Welcome Bonus</strong> has been credited to your account to help you get started on our platform.</p>

<!-- Credentials table -->
<div style="margin:24px 0;">
    <p
        style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#475569;margin-bottom:10px;">
        Your Account Details</p>
    <table class="detail-table">
        <tr>
            <td class="key">Username</td>
            <td class="val">{{ $user->username }}</td>
        </tr>
        <tr>
            <td class="key">Email</td>
            <td class="val">{{ $user->email }}</td>
        </tr>
        <tr>
            <td class="key">Status</td>
            <td class="val"><span class="badge badge-success">Active</span></td>
        </tr>
    </table>
</div>

<div class="info-box">
    <p><strong style="color:#93c5fd;">Security Tip:</strong> Never share your password or login credentials with
        anyone, including our support team.</p>
</div>

<div style="text-align:center;margin:28px 0 8px;">
    <a href="{{ url('/login') }}" class="btn-cta">Access Your Dashboard →</a>
</div>

<div class="divider"></div>
<p style="font-size:13px;text-align:center;">
    Need help? Reach our support team at
    <a
        href="mailto:{{ $adminSetting->support_email ?? 'support@qfsworld.com' }}">{{ $adminSetting->support_email ?? 'support@qfsworld.com' }}</a>
</p>

@include('emails._layout_close')
