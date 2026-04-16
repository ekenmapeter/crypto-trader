<!DOCTYPE html>
<html lang="en" data-sidebar="dark" data-sidebar-size="sm" data-sidebar-image="img-3" data-preloader="enable" data-bs-theme="dark" data-layout-width="fluid" data-layout-position="fixed" data-layout-style="default" data-topbar="light" data-sidebar-visibility="show">
<head>
    <meta charset="utf-8" />
    <title>Login | {{ $adminSetting->site_name ?? 'Moonbond' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('moonbond/images/favicon.ico') }}" />
    <link href="{{ asset('moonbond/panel/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('moonbond/panel/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('moonbond/panel/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('moonbond/panel/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="auth-page-wrapper pt-5">
        <div class="auth-one-bg-position" id="auth-particles">
            <div class="bg-overlay"></div>
        </div>
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="{{ url('/') }}" class="d-inline-block auth-logo">
                                    <img src="{{ asset('moonbond/images/logo.png') }}" alt="" height="40" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to {{ $adminSetting->site_name ?? 'Moonbond' }}.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <div class="alert bg-light text-center">
                                        <small class="fs-6 text-white">Please make sure you are visiting</small>
                                        <p class="text-white mb-0"><span class="text-success"><i class="ri-lock-2-fill align-bottom"></i> https://</span>{{ request()->getHost() }}</p>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="login" class="form-label">Email or Username</label>
                                            <input type="text" name="login" class="form-control" id="login" placeholder="Enter email or username" value="{{ old('login') }}" required>
                                            @error('login')
                                                <span class="text-danger fs-12">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                                            </div>
                                            <label class="form-label" for="password">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5" placeholder="Enter password" name="password" id="password" required>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                            @error('password')
                                                <span class="text-danger fs-12">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="mb-0 text-white-50">Don't have an account? <a href="{{ route('register') }}" class="fw-semibold text-decoration-underline text-primary"> Sign Up </a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer mb-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-white-50">
                                &copy; <script>document.write(new Date().getFullYear());</script> {{ $adminSetting->site_name ?? 'Moonbond' }}. Standard Cryptocurrency Bitcoin Wallet
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{ asset('moonbond/panel/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('moonbond/panel/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('moonbond/panel/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('moonbond/panel/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('moonbond/panel/assets/libs/particles.js/particles.js') }}"></script>
    <script>
        document.getElementById("password-addon").addEventListener("click",function(){var e=document.getElementById("password");"password"===e.type?e.type="text":e.type="password"});
    </script>
    @if(session('status'))
        <script>
            Swal.fire({ title: 'Success', text: "{{ session('status') }}", icon: 'success' });
        </script>
    @endif
</body>
</html>
