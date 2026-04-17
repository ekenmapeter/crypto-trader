
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e($title ?? ($adminSetting->site_name ?? 'QFSWORLD')); ?></title>
    <!--[if mso]><noscript><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml></noscript><![endif]-->
    <style>
        /* Reset */
        body,table,td,p,a,li,blockquote{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;}
        table,td{mso-table-lspace:0pt;mso-table-rspace:0pt;}
        img{-ms-interpolation-mode:bicubic;border:0;outline:none;text-decoration:none;}

        body {
            margin: 0 !important;
            padding: 0 !important;
            background-color: #080d1a !important;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        /* Wrapper */
        .email-wrapper {
            background-color: #080d1a;
            padding: 40px 16px;
        }

        /* Container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
        }

        /* Header */
        .email-header {
            text-align: center;
            padding-bottom: 28px;
        }
        .logo-badge {
            display: inline-block;
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            border-radius: 10px;
            line-height: 44px;
            font-size: 20px;
            font-weight: 800;
            color: #ffffff;
            text-align: center;
            vertical-align: middle;
            margin-right: 10px;
        }
        .site-name {
            font-size: 18px;
            font-weight: 700;
            color: #ffffff;
            vertical-align: middle;
            letter-spacing: 0.06em;
        }

        /* Card */
        .email-card {
            background: #0d1527;
            border: 1px solid rgba(59,130,246,0.2);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,0.6);
        }

        /* Card top accent bar (colour varies per type) */
        .card-accent {
            height: 4px;
            background: linear-gradient(90deg, #2563eb, #3b82f6, #60a5fa);
        }
        .card-accent.success { background: linear-gradient(90deg, #059669, #10b981, #34d399); }
        .card-accent.danger  { background: linear-gradient(90deg, #dc2626, #ef4444, #f87171); }
        .card-accent.warning { background: linear-gradient(90deg, #d97706, #f59e0b, #fbbf24); }

        /* Card body */
        .card-body {
            padding: 36px 40px;
        }

        /* Icon circle */
        .email-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(37,99,235,0.15);
            border: 1px solid rgba(59,130,246,0.25);
            text-align: center;
            line-height: 60px;
            font-size: 26px;
            margin: 0 auto 22px;
        }
        .email-icon.success { background: rgba(5,150,105,0.15); border-color: rgba(16,185,129,0.25); }
        .email-icon.danger  { background: rgba(220,38,38,0.15);  border-color: rgba(239,68,68,0.25); }
        .email-icon.warning { background: rgba(217,119,6,0.15);  border-color: rgba(245,158,11,0.25); }

        /* Typography */
        .email-title {
            font-size: 22px;
            font-weight: 700;
            color: #f1f5f9;
            margin: 0 0 8px;
        }
        .email-subtitle {
            font-size: 14px;
            color: #64748b;
            margin: 0 0 28px;
            line-height: 1.6;
        }
        p { font-size: 14px; color: #94a3b8; line-height: 1.7; margin: 0 0 16px; }
        strong { color: #e2e8f0; }
        a { color: #3b82f6; text-decoration: none; }
        a:hover { color: #60a5fa; }

        /* Detail table */
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 10px;
            overflow: hidden;
        }
        .detail-table td {
            padding: 12px 16px;
            font-size: 13px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .detail-table tr:last-child td { border-bottom: none; }
        .detail-table .key { color: #64748b; width: 38%; font-weight: 500; }
        .detail-table .val { color: #e2e8f0; font-weight: 600; }

        /* Status badge */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-success { background: rgba(16,185,129,0.15); color: #34d399; border: 1px solid rgba(16,185,129,0.2); }
        .badge-danger  { background: rgba(239,68,68,0.15);  color: #f87171; border: 1px solid rgba(239,68,68,0.2); }
        .badge-warning { background: rgba(245,158,11,0.15); color: #fbbf24; border: 1px solid rgba(245,158,11,0.2); }
        .badge-info    { background: rgba(59,130,246,0.15); color: #60a5fa; border: 1px solid rgba(59,130,246,0.2); }

        /* CTA Button */
        .btn-cta {
            display: inline-block;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: #ffffff !important;
            text-decoration: none;
            padding: 13px 32px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.02em;
            margin: 8px 0;
        }
        .btn-cta.success { background: linear-gradient(135deg, #059669, #10b981); }
        .btn-cta.warning { background: linear-gradient(135deg, #d97706, #f59e0b); color: #1a1a1a !important; }

        /* Info box */
        .info-box {
            background: rgba(59,130,246,0.07);
            border: 1px solid rgba(59,130,246,0.15);
            border-radius: 10px;
            padding: 14px 18px;
            margin: 18px 0;
        }
        .info-box.success { background: rgba(16,185,129,0.07); border-color: rgba(16,185,129,0.15); }
        .info-box.danger  { background: rgba(239,68,68,0.07);  border-color: rgba(239,68,68,0.15); }
        .info-box.warning { background: rgba(245,158,11,0.07); border-color: rgba(245,158,11,0.15); }
        .info-box p { margin: 0; font-size: 13px; }
        .info-box.success p { color: #6ee7b7; }
        .info-box.danger  p { color: #fca5a5; }
        .info-box.warning p { color: #fde68a; }

        /* Divider */
        .divider {
            height: 1px;
            background: rgba(255,255,255,0.06);
            margin: 24px 0;
        }

        /* Footer */
        .email-footer {
            text-align: center;
            padding: 24px 16px 16px;
        }
        .email-footer p {
            font-size: 12px;
            color: #374151;
            margin: 4px 0;
        }
        .email-footer a { color: #3b82f6; font-size: 12px; }

        @media only screen and (max-width: 620px) {
            .card-body { padding: 24px 20px !important; }
            .email-wrapper { padding: 20px 12px !important; }
        }
    </style>
</head>
<body>
<div class="email-wrapper">
<div class="email-container">

    <!-- Header: Logo -->
    <div class="email-header">
        <span class="logo-badge">Q</span>
        <span class="site-name"><?php echo e($adminSetting->site_name ?? 'QFSWORLD'); ?></span>
    </div>

    <!-- Card -->
    <div class="email-card">
        <div class="card-accent <?php echo e($accentClass ?? ''); ?>"></div>
        <div class="card-body">
<?php /**PATH C:\xampp\htdocs\Coin-trade\resources\views/emails/_layout_open.blade.php ENDPATH**/ ?>