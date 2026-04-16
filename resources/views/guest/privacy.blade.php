@extends('layouts.moonbond')

@section('content')
<div class="page-banner-area bg-f0f4fc" style="background: #0a3d91; padding: 100px 0;">
    <div class="container">
        <div class="page-banner-content text-center">
            <h1 class="fw-bolder text-white">Privacy Policy</h1>
        </div>
    </div>
</div>

<div class="terms-condition-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="condition-content">
                    <h3 class="fw-bold">1. Data Collection.</h3>
                    <p class="fs-5">
                    Your privacy is important to us. It is {{ $adminSetting->site_name ?? 'Moonbond' }}'s policy to respect your privacy regarding any information we may collect from you across our website.
                    </p>
                    <h3 class="fw-bold">2. Use of Information.</h3>
                    <p class="fs-5">
                    We only ask for personal information when we truly need it to provide a service to you. We collect it by fair and lawful means, with your knowledge and consent.
                    </p>
                    <h3 class="fw-bold">3. Cookies.</h3>
                    <p class="fs-5">
                    We use “cookies” to collect information about you and your activity across our site. A cookie is a small piece of data that our website stores on your computer.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
