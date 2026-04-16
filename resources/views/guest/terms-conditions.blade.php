@extends('layouts.moonbond')

@section('content')
<div class="page-banner-area bg-f0f4fc" style="background: #0a3d91; padding: 100px 0;">
    <div class="container">
        <div class="page-banner-content text-center">
            <h1 class="fw-bolder text-white">Terms & Conditions</h1>
        </div>
    </div>
</div>

<div class="terms-condition-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="condition-content">
                    <h3 class="fw-bold">1. Introduction.</h3>
                    <p class="fs-5">
                    These Terms And Conditions (these “Terms” or these “Terms And Conditions”) contained herein on this webpage, shall govern your use of this website, including all pages within this website.
                    </p>
                    <h3 class="fw-bold">2. Intellectual Property Rights.</h3>
                    <p class="fs-5">
                    Other than content you own, under these Terms, {{ $adminSetting->site_name ?? 'Moonbond' }} and/or its licensors own all rights to the intellectual property and material contained in this Website.
                    </p>
                    <h3 class="fw-bold">3. Restrictions.</h3>
                    <p class="fs-5">
                    You are expressly restricted from all of the following:
                    </p>
                    <div class="list">
                        <ul>
                            <li class="fs-5 fw-normal"><i class="fa fa-check"></i> selling, sublicensing and/or otherwise commercializing any Website material;</li>
                            <li class="fs-5 fw-normal"><i class="fa fa-check"></i> using this Website in any way that is, or may be, damaging to this Website;</li>
                            <li class="fs-5 fw-normal"><i class="fa fa-check"></i> using this Website in any way that impacts user access to this Website;</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
