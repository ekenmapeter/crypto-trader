@extends('layouts.moonbond')

@section('content')
<div id="particles-js"></div>
<div class="inner-slider" id="slider-carousel">
    <!--<p><a target="__blank" href="{{ url('/') }}/assets/bespend.apk" class="text-white text-uppercase"><img src="{{ asset('moonbond/assets/images/play.png') }}" width="200px" /></a></p>-->
    <div class="exp">
        <h1>Trusted By Millions <span class="yellow-color">{{ $adminSetting->site_name ?? 'Moonbond' }} </span> <br /></h1>
        <p>{{ $adminSetting->site_name ?? 'Moonbond' }} is the best place to buy, sell & earn cryptocurrency. The most widely used crypto trading platform for the needs of everyone. Buy crypto and trade crypto.</p>
        <div class="mt-3">
            <a class="btn text-white mr-3" style="background-color: #222; border: 6px solid#0b0e12a8;" href="{{ route('register') }}">REGISTER</a>
            <a class="btn text-white mr-3" href="{{ route('login') }}" style="background-color: #222; border: 6px solid#0b0e12a8;">LOGIN</a>
        </div>
        <img src="{{ asset('moonbond/assets/img/pn3.png') }}" width="70px" />
    </div>
    <div class="exp">
        <h1>Steps to digital asset <span class="yellow-color">Freedom</span></h1>
        <p>{{ $adminSetting->site_name ?? 'Moonbond' }} Get started in minutes with as little as $10.</p>
        <div class="mt-3">
            <a class="btn text-white mr-3" style="background-color: #222; border: 6px solid#0b0e12a8;" href="{{ route('register') }}">REGISTER</a>
            <a class="btn text-white mr-3" href="{{ route('login') }}" style="background-color: #222; border: 6px solid#0b0e12a8;">LOGIN</a>
            <img src="{{ asset('moonbond/assets/img/pn3.png') }}" width="70px" />
        </div>
    </div>
    <div class="exp">
        <h1>
            MOST <span class="yellow-color">SECURE</span> <br />
            CRYPTO CURRENCY
        </h1>
        <p>Bitcoin is a fully decentralized crypto currency that ensures transparency with the block chain technology.</p>
        <div class="mt-3">
            <a class="btn text-white mr-3" style="background-color: #222; border: 6px solid#0b0e12a8;" href="{{ route('register') }}">REGISTER</a>
            <a class="btn text-white mr-3" href="{{ route('login') }}" style="background-color: #222; border: 6px solid#0b0e12a8;">LOGIN</a>
            <img src="{{ asset('moonbond/assets/img/pn3.png') }}" width="70px" />
        </div>
    </div>
</div>

<section class="own_trending_area mt-3" id="about">
    <div class="container">
        <div class="main_title" style="margin: 35px 0 0 0; color: #fff;">
            <h3>Own Your Crypto Adventure</h3>
        </div>
        <br />
        <div class="row mb-3">
            <div class="col-lg-6">
                <div class="trending_list">
                    <div class="media">
                        <div class="d-flex"></div>
                        <div class="media-body">
                            <a>
                                <h4 class="my-3">Start exploring the finest crypto assets in the Web3 World and securely managing your portfolio.</h4>
                            </a>
                            <p class="my-3">
                                {{ $adminSetting->site_name ?? 'Moonbond' }} wallet is a multichain wallet. By importing existing wallets or creating new ones, you may start managing your crypto portfolio across more than 90 blockchain networks.
                            </p>
                            <p class="my-3">{{ $adminSetting->site_name ?? 'Moonbond' }} adopts a special DESM (Double Encryption Storage Mechanism). Your assets will be intact even your device gets stolen.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="trending_img">
                    <img class="img-fluid" src="{{ asset('moonbond/assets/img/pn.png') }}" alt="" width="130%;" />
                </div>
            </div>
        </div>
    </div>
</section>

<section id="howorks">
    <div class="bg-feature work-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading m-auto text-center">
                        <h2 class="f-xbold text-white">{{ $adminSetting->site_name ?? 'Moonbond' }}</h2>
                        <hr class="seperator" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="work-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 m-auto">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="work-inner-box">
                                <div class="icon-box work-icon icon-lg">
                                    <svg class="svg-icon" viewBox="0 0 20 20">
                                        <path fill="none" d="M16.85,7.275l-3.967-0.577l-1.773-3.593c-0.208-0.423-0.639-0.69-1.11-0.69s-0.902,0.267-1.11,0.69L7.116,6.699L3.148,7.275c-0.466,0.068-0.854,0.394-1,0.842c-0.145,0.448-0.023,0.941,0.314,1.27l2.871,2.799l-0.677,3.951c-0.08,0.464,0.112,0.934,0.493,1.211c0.217,0.156,0.472,0.236,0.728,0.236c0.197,0,0.396-0.048,0.577-0.143l3.547-1.864l3.548,1.864c0.18,0.095,0.381,0.143,0.576,0.143c0.256,0,0.512-0.08,0.729-0.236c0.381-0.277,0.572-0.747,0.492-1.211l-0.678-3.951l2.871-2.799c0.338-0.329,0.459-0.821,0.314-1.27C17.705,7.669,17.316,7.343,16.85,7.275z M13.336,11.754l0.787,4.591l-4.124-2.167l-4.124,2.167l0.788-4.591L3.326,8.5l4.612-0.67l2.062-4.177l2.062,4.177l4.613,0.67L13.336,11.754z"></path>
                                    </svg>
                                </div>
                                <h4>Customizable Watch Lists</h4>
                                <p>Keep track of your own portfolio and monitor over your asset across 100+ exchanges</p>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="work-inner-box">
                                <div class="icon-box work-icon icon-lg">
                                    <svg class="svg-icon" viewBox="0 0 20 20">
                                        <path fill="none" d="M16.85,7.275l-3.967-0.577l-1.773-3.593c-0.208-0.423-0.639-0.69-1.11-0.69s-0.902,0.267-1.11,0.69L7.116,6.699L3.148,7.275c-0.466,0.068-0.854,0.394-1,0.842c-0.145,0.448-0.023,0.941,0.314,1.27l2.871,2.799l-0.677,3.951c-0.08,0.464,0.112,0.934,0.493,1.211c0.217,0.156,0.472,0.236,0.728,0.236c0.197,0,0.396-0.048,0.577-0.143l3.547-1.864l3.548,1.864c0.18,0.095,0.381,0.143,0.576,0.143c0.256,0,0.512-0.08,0.729-0.236c0.381-0.277,0.572-0.747,0.492-1.211l-0.678-3.951l2.871-2.799c0.338-0.329,0.459-0.821,0.314-1.27C17.705,7.669,17.316,7.343,16.85,7.275z M13.336,11.754l0.787,4.591l-4.124-2.167l-4.124,2.167l0.788-4.591L3.326,8.5l4.612-0.67l2.062-4.177l2.062,4.177l4.613,0.67L13.336,11.754z"></path>
                                    </svg>
                                </div>
                                <h4>Performance Overview</h4>
                                <p>Working with seasoned high-value asset management, cryptocurrency and Blockchain. Follow the latest market trends in real-time.</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="work-inner-box">
                                <div class="icon-box work-icon icon-lg">
                                    <svg class="svg-icon" viewBox="0 0 20 20">
                                        <path fill="none" d="M16.85,7.275l-3.967-0.577l-1.773-3.593c-0.208-0.423-0.639-0.69-1.11-0.69s-0.902,0.267-1.11,0.69L7.116,6.699L3.148,7.275c-0.466,0.068-0.854,0.394-1,0.842c-0.145,0.448-0.023,0.941,0.314,1.27l2.871,2.799l-0.677,3.951c-0.08,0.464,0.112,0.934,0.493,1.211c0.217,0.156,0.472,0.236,0.728,0.236c0.197,0,0.396-0.048,0.577-0.143l3.547-1.864l3.548,1.864c0.18,0.095,0.381,0.143,0.576,0.143c0.256,0,0.512-0.08,0.729-0.236c0.381-0.277,0.572-0.747,0.492-1.211l-0.678-3.951l2.871-2.799c0.338-0.329,0.459-0.821,0.314-1.27C17.705,7.669,17.316,7.343,16.85,7.275z M13.336,11.754l0.787,4.591l-4.124-2.167l-4.124,2.167l0.788-4.591L3.326,8.5l4.612-0.67l2.062-4.177l2.062,4.177l4.613,0.67L13.336,11.754z"></path>
                                    </svg>
                                </div>
                                <h4>Advanced Charting</h4>
                                <p>Set up technical indicators and conduct market analysis</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="security_area p_100">
    <div class="container">
        <div class="main_title" style="color: #fff;">
            <h2>Secure & Transparent</h2>
            <p>Your security is our priority. {{ $adminSetting->site_name ?? 'Moonbond' }} uses advanced encryption and decentralized protocols to protect your assets.</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="security_item">
                    <img src="{{ asset('moonbond/assets/img/security-1.png') }}" alt="" />
                    <h3>Double Encryption</h3>
                    <p>Advanced DESM mechanism ensuring your private keys are never exposed.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="security_item">
                    <img src="{{ asset('moonbond/assets/img/pn1.png') }}" alt="" width="60" />
                    <h3>Multi-Chain Support</h3>
                    <p>Manage assets across 90+ blockchain networks from a single interface.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="security_item">
                    <img src="{{ asset('moonbond/assets/img/pn2.png') }}" alt="" width="60" />
                    <h3>Instant Swaps</h3>
                    <p>Swap tokens instantly with the best rates in the market.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="global_reach_area p_100 bg-f0f4fc" style="background: rgba(10, 61, 145, 0.05);">
    <div class="container text-center">
        <div class="main_title">
            <h2>Serving Users Globally</h2>
            <p>Nearly 5 million users across 113 countries trust {{ $adminSetting->site_name ?? 'Moonbond' }} for their digital asset management.</p>
        </div>
        <div class="mt-5">
            <img src="{{ asset('moonbond/assets/img/parallax-bg.jpg') }}" class="img-fluid rounded shadow-lg" alt="Global Reach" style="max-height: 400px; width: 100%; object-fit: cover; opacity: 0.8;" />
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
$.ajax({
    type: "GET",
    url: "https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD,EUR,CNY,ETH",
    dataType: "json",
    success: function (data) {
        $("#usd").text("$ " + data.USD);
        $("#eur").text("€ " + data.EUR);
        $("#cny").text("¥ " + data.CNY);
        $(function () {
            $(".simple-marquee-container").SimpleMarquee({
                duration: 100000,
            });
        });
    },
});
</script>
@endpush
