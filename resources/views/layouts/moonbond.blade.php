<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" class="dark">
<head>
    <title>{{ $title ?? ($adminSetting->site_name ?? 'Moonbond') . ' - Digital Cloud wallet' }}</title>
    <style>
        :root {
            --AppColor: #007bcf;
            --oColor: rgba(0, 123, 207, 0.37);
            --wbColor: #fff;
            --d_Color: #00528a;
            --siteUrl: "{{ url('/') }}/";
        }
    </style>
    <meta name="theme-color" content="#007bcf" />
    <meta name="msapplication-navbutton-color" content="#007bcf" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="application-name" content="{{ $adminSetting->admin_email ?? 'contact@moonbond.com' }}" />
    <meta name="apple-mobile-web-app-title" content="{{ $adminSetting->admin_email ?? 'contact@moonbond.com' }}" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="robots" content="noimageindex,noarchive" />
    <meta name="keywords" content="wallet,crypto,Trade,Trading" />
    <meta name="description" content="We are a registered digital asset management firm. The platform, which includes advanced basic and technical analysis at the source of high return performance, offers high & fixed interest return. Aiming for success with its international investor network, experienced team, privileged information from business and technology world" />
    <meta property="og:description" content="We are a registered digital asset management firm. The platform, which includes advanced basic and technical analysis at the source of high return performance, offers high & fixed interest return. Aiming for success with its international investor network, experienced team, privileged information from business and technology world" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:image" content="{{ asset('moonbond/images/logo.png') }}" />
    <meta property="og:title" content="{{ $adminSetting->site_name ?? 'Moonbond' }}" />
    <meta property="og:type" content="crypto:wallet" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ asset('moonbond/images/favicon.ico') }}" type="image/x-icon" />

    <link href="{{ asset('moonbond/assets/css/font-awesome.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('moonbond/assets/js/jquery-3.4.1.min.js') }}"></script>
    <link href="{{ asset('moonbond/assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('moonbond/assets/vendors/revolution/css/settings.css') }}" rel="stylesheet" />
    <link href="{{ asset('moonbond/assets/vendors/revolution/css/layers.css') }}" rel="stylesheet" />
    <link href="{{ asset('moonbond/assets/vendors/owl-carousel/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('moonbond/assets/vendors/animate-css/animate.css') }}" rel="stylesheet" />

    <link href="{{ asset('moonbond/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('moonbond/assets/css/responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('moonbond/assets/css/custom.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('moonbond/assets/css/marquee.css') }}" />

    <style>
        .svg-icon { width: 1em; height: 1em; }
        .svg-icon path, .svg-icon polygon, .svg-icon rect { fill: #4691f6; }
        .svg-icon circle { stroke: #4691f6; stroke-width: 1; }
        iframe.goog-te-banner-frame { display: none !important; }
        body { position: static !important; top: 0px !important; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div class="main">
        <header class="main_menu_area">
            <div class="top_menu">
                <div class="container">
                    <div class="float-md-right">
                        <ul class="top_social">
                            <li>
                                <a href="mailto:{{ $adminSetting->admin_email ?? 'contact@moonbond.com' }}">
                                    <i class="fa fa-envelope"></i> <span>{{ $adminSetting->admin_email ?? 'contact@moonbond.com' }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="main_menu_inner">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('moonbond/images/logo.png') }}" width="180" alt="" /></a>
                        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="my_toggle_menu">
                                <span></span><span></span><span></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Reviews</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login <img src="{{ asset('moonbond/assets/img/pn3.png') }}" width="20px" /></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Create Account <img src="{{ asset('moonbond/assets/img/pn3.png') }}" width="20px" /></a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="footer_area">
            <div class="footer_widgets_area p_100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-sm-6">
                            <aside class="f_widget about_widget">
                                <img class="img-fluid" src="{{ asset('moonbond/images/logo.png') }}" width="180" alt="" />
                                <p>
                                    {{ $adminSetting->site_name ?? 'Moonbond' }} is a decentralized multi-chain crypto wallet dedicated to providing safe and convenient one-stop digital asset management services to users around the world. We are now serving nearly 5 million users across 113 countries.
                                </p>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <aside class="f_widget resource_widget">
                                <div class="f_title"><h3>RESOURCES</h3></div>
                                <ul>
                                    <li><a href="{{ url('/') }}"><i class="fa fa-angle-double-right"></i>Home</a></li>
                                    <li><a href="#more"><i class="fa fa-angle-double-right"></i>More</a></li>
                                    <li><a href="#about"><i class="fa fa-angle-double-right"></i>About</a></li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="f_title"><h3>Contact Us</h3></div>
                            <aside class="f_widget about_widget">
                                <ul>
                                    <li style="color: white;"><i class="fa fa-envelope"> Email : </i> <a style="color: #0080db;" href="mailto:{{ $adminSetting->admin_email ?? 'contact@moonbond.com' }}">{{ $adminSetting->admin_email ?? 'contact@moonbond.com' }}</a></li>
                                    <li style="color: white;"><i class="fa fa-map-marker"> Address : </i> <a style="color: #0080db;" href="#">Flat 233, Apt Parkview, Great West Rd, Brentford TW8 9GU, United Kingdom </a></li>
                                    <li style="color: white;"><i class="fa fa-link"> Link : </i> <a style="color: #0080db;" href="{{ url('/') }}">{{ url('/') }}/ </a></li>
                                </ul>
                                <img class="img-fluid" src="{{ asset('moonbond/assets/img/security.png') }}" width="100" height="90" alt="" />
                            </aside>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('login') }}">
                                <img src="{{ asset('moonbond/assets/img/ios.png') }}" width="220px" />
                                <img src="{{ asset('moonbond/assets/img/play.png') }}" width="220px" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_copyright" style="color: white;">
                Copyright &copy;2026 All rights reserved | {{ $adminSetting->site_name ?? 'Moonbond' }}
            </div>
        </footer>
    </div>

    <script src="{{ asset('moonbond/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('moonbond/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('moonbond/assets/vendors/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('moonbond/assets/vendors/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('moonbond/assets/vendors/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('moonbond/assets/vendors/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
    <script src="{{ asset('moonbond/assets/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('moonbond/assets/vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('moonbond/assets/vendors/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('moonbond/assets/vendors/counterup/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('moonbond/assets/vendors/counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('moonbond/assets/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('moonbond/assets/vendors/animate-css/wow.min.js') }}"></script>
    <script src="{{ asset('moonbond/assets/vendors/parallax/parallax.min.js') }}"></script>
    <script src="{{ asset('moonbond/assets/vendors/counterup/apear.js') }}"></script>
    <script src="{{ asset('moonbond/assets/vendors/counterup/countto.js') }}"></script>
    <script src="{{ asset('moonbond/assets/js/theme.js') }}"></script>
    <script src="{{ asset('moonbond/assets/js/recent.js') }}"></script>
    <script type="text/javascript" src="{{ asset('moonbond/assets/js/marquee.js') }}"></script>
    <script type="text/javascript" src="{{ asset('moonbond/assets/js/particle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('moonbond/assets/js/custom.js') }}"></script>

    @stack('scripts')
</body>
</html>
