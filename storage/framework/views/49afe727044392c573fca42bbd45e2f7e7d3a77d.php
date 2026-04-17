<!DOCTYPE html>
<html lang="en" data-sidebar="dark" data-sidebar-size="sm" data-sidebar-image="img-3" data-preloader="enable" data-bs-theme="dark" data-layout-width="fluid" data-layout-position="fixed" data-layout-style="default" data-topbar="light" data-sidebar-visibility="show">
<head>
    <meta charset="utf-8" />
    <title>Register | <?php echo e($adminSetting->site_name ?? 'Moonbond'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo e(asset('moonbond/images/favicon.ico')); ?>" />
    <link href="<?php echo e(asset('moonbond/panel/assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('moonbond/panel/assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('moonbond/panel/assets/css/app.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('moonbond/panel/assets/css/custom.min.css')); ?>" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .step-panel { display: none; }
        .step-panel.active { display: block; }
        .valid { color: #22c55e; }
        .invalid { color: #ef4444; }
    </style>
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
                                <a href="<?php echo e(url('/')); ?>" class="d-inline-block auth-logo">
                                    <img src="<?php echo e(asset('moonbond/images/logo.png')); ?>" alt="" height="40" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-6">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Create New Account</h5>
                                    <p class="text-muted">Get your free <?php echo e($adminSetting->site_name ?? 'Moonbond'); ?> account now</p>
                                </div>
                                 <div class="p-2 mt-4">
                                     <?php if($errors->any()): ?>
                                         <div class="alert alert-danger">
                                             <ul class="mb-0">
                                                 <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                     <li><?php echo e($error); ?></li>
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                             </ul>
                                         </div>
                                     <?php endif; ?>
                                     <form method="POST" action="<?php echo e(route('register')); ?>" id="register-form">
                                         <?php echo csrf_field(); ?>
                                        
                                        <!-- Step 1: Personal Details -->
                                        <div class="step-panel active" id="step-1">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="firstname" class="form-label">First Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Enter first name" value="<?php echo e(old('firstname')); ?>" required>
                                                    <?php $__errorArgs = ['firstname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger fs-12"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="lastname" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter last name" value="<?php echo e(old('lastname')); ?>" required>
                                                    <?php $__errorArgs = ['lastname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger fs-12"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" value="<?php echo e(old('username')); ?>" required>
                                                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger fs-12"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email address" value="<?php echo e(old('email')); ?>" required>
                                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger fs-12"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="mobile_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                                    <input type="text" name="mobile_number" class="form-control" id="mobile_number" placeholder="Enter phone number" value="<?php echo e(old('mobile_number')); ?>" required>
                                                    <?php $__errorArgs = ['mobile_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger fs-12"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                                    <select name="country" class="form-select" id="country" required>
                                                        <option value="">Select Country</option>
                                                        <option value="United States">United States</option>
                                                        <option value="United Kingdom">United Kingdom</option>
                                                        <option value="Canada">Canada</option>
                                                        <option value="Nigeria">Nigeria</option>
                                                        
                                                    </select>
                                                    <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger fs-12"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="referral_code" class="form-label">Referral Code (Optional)</label>
                                                <input type="text" name="referral_code" class="form-control" id="referral_code" placeholder="Enter referral code" value="<?php echo e(old('referral_code', request('ref'))); ?>">
                                            </div>
                                            <div class="mt-4">
                                                <button type="button" class="btn btn-primary w-100" onclick="nextStep(2)">Next Step</button>
                                            </div>
                                        </div>

                                        <!-- Step 2: Security -->
                                        <div class="step-panel" id="step-2">
                                            <input type="hidden" name="wallet_phrase" id="wallet_phrase_input">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                                <div class="position-relative auth-pass-inputgroup">
                                                    <input type="password" name="password" class="form-control pe-5" placeholder="Enter password" id="password" required>
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button"><i class="ri-eye-fill align-middle"></i></button>
                                                </div>
                                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger fs-12"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                <div class="position-relative auth-pass-inputgroup">
                                                    <input type="password" name="password_confirmation" class="form-control pe-5" placeholder="Confirm password" id="password_confirmation" required>
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button"><i class="ri-eye-fill align-middle"></i></button>
                                                </div>
                                            </div>
                                            
                                            <div class="bg-light p-3 rounded mb-3">
                                                <h6 class="fs-13">Security Phrase (12 Words)</h6>
                                                <div id="wallet-phrase" class="p-2 bg-dark text-info text-center rounded fs-13 font-monospace mb-2">
                                                    
                                                </div>
                                                <button type="button" class="btn btn-sm btn-outline-primary" id="copy-phrase">Copy Phrase</button>
                                                <div class="form-check mt-2">
                                                    <input class="form-check-input" type="checkbox" id="phrase-saved" required>
                                                    <label class="form-check-label fs-12" for="phrase-saved">I have saved my security phrase in a safe place</label>
                                                </div>
                                            </div>

                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                                <label class="form-check-label fs-12" for="terms">I agree to the <a href="<?php echo e(route('terms-conditions')); ?>">Terms & Conditions</a></label>
                                            </div>

                                            <div class="d-flex gap-2">
                                                <button type="button" class="btn btn-light w-50" onclick="nextStep(1)">Back</button>
                                                <button type="submit" class="btn btn-primary w-50">Create Account</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="mb-0 text-white-50">Already have an account? <a href="<?php echo e(route('login')); ?>" class="fw-semibold text-decoration-underline text-primary"> Sign In </a> </p>
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
                                &copy; <script>document.write(new Date().getFullYear());</script> <?php echo e($adminSetting->site_name ?? 'Moonbond'); ?>. Standard Cryptocurrency Bitcoin Wallet
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="<?php echo e(asset('moonbond/panel/assets/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('moonbond/panel/assets/libs/simplebar/simplebar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('moonbond/panel/assets/libs/node-waves/waves.min.js')); ?>"></script>
    <script src="<?php echo e(asset('moonbond/panel/assets/libs/feather-icons/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('moonbond/panel/assets/libs/particles.js/particles.js')); ?>"></script>
    
    <script>
        function nextStep(step) {
            document.querySelectorAll('.step-panel').forEach(p => p.classList.remove('active'));
            document.getElementById('step-' + step).classList.add('active');
        }

        <?php if($errors->has('password') || $errors->has('terms')): ?>
            nextStep(2);
        <?php endif; ?>

        // Phrase Generation
        const words = ["alpha", "bravo", "charlie", "delta", "echo", "foxtrot", "golf", "hotel", "india", "juliet", "kilo", "lima", "mike", "november", "oscar", "papa", "quebec", "romeo", "sierra", "tango", "uniform", "victor", "whiskey", "xray", "yankee", "zulu"];
        function generatePhrase() {
            let phrase = [];
            for (let i = 0; i < 12; i++) {
                phrase.push(words[Math.floor(Math.random() * words.length)]);
            }
            return phrase.join(" ");
        }
        const generatedPhrase = generatePhrase();
        document.getElementById('wallet-phrase').innerText = generatedPhrase;
        document.getElementById('wallet_phrase_input').value = generatedPhrase;

        document.getElementById('copy-phrase').addEventListener('click', function() {
            navigator.clipboard.writeText(generatedPhrase);
            Swal.fire({ title: 'Copied!', text: 'Phrase copied to clipboard', icon: 'success', timer: 1500, showConfirmButton: false });
        });

        document.querySelectorAll(".password-addon").forEach(btn => {
            btn.addEventListener("click", function() {
                let input = this.parentElement.querySelector('input');
                input.type = input.type === "password" ? "text" : "password";
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Coin-trade\resources\views/auth/register.blade.php ENDPATH**/ ?>