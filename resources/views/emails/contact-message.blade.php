@include('emails._layout_open', ['title' => 'New Contact Inquiry', 'accentClass' => ''])

<div style="text-align:center;">
    <div class="email-icon">✉️</div>
    <h1 class="email-title">New Contact Inquiry</h1>
    <p class="email-subtitle">A visitor has submitted a message via the contact form.</p>
</div>

<p>You have received a new message from the website contact form. Details are below:</p>

<table class="detail-table">
    <tr>
        <td class="key">Name</td>
        <td class="val">{{ $data['name'] ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td class="key">Email</td>
        <td class="val"><a href="mailto:{{ $data['email'] ?? '' }}" style="color:#3b82f6;">{{ $data['email'] ?? 'N/A' }}</a></td>
    </tr>
    <tr>
        <td class="key">Subject</td>
        <td class="val">{{ $data['subject'] ?? 'N/A' }}</td>
    </tr>
</table>

<div style="margin:20px 0;">
    <p style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#475569;margin-bottom:10px;">Message</p>
    <div style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);border-radius:10px;padding:18px 20px;">
        <p style="color:#94a3b8;font-size:14px;line-height:1.8;margin:0;white-space:pre-line;">{{ $data['message'] ?? 'N/A' }}</p>
    </div>
</div>

<div class="info-box">
    <p>💬 Reply directly to this inquiry by emailing <a href="mailto:{{ $data['email'] ?? '' }}" style="color:#60a5fa;">{{ $data['email'] ?? '' }}</a></p>
</div>

@include('emails._layout_close')
