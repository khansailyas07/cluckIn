<!doctype html>
<html lang="en" dir="<?php echo e(session('direction') == 2 ? 'rtl' : 'ltr'); ?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> <?php echo e(@Helper::appdata()->title); ?> | <?php echo e(trans('labels.signup')); ?> </title>
    <link rel="icon" href="<?php echo e(Helper::image_path(@Helper::appdata()->favicon)); ?>"><!-- Favicon -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'web-assets/css/bootstrap.min.css')); ?>"><!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'web-assets/css/font_awesome/all.css')); ?>"><!-- Font Awesome CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'web-assets/css/style.css')); ?>"><!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'web-assets/css/responsive.css')); ?>"><!-- Media Query Resposive CSS -->
    <!-- COMMON-CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/css/toastr/toastr.min.css')); ?>"><!-- Toastr CSS -->
</head>
<body>
    <!--Preloader start here-->
    <div id="preload" class="bg-light">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class='loader-icon'><img src="<?php echo e(Helper::image_path(@Helper::appdata()->logo)); ?>" alt="Swipy">
                </div>
            </div>
        </div>
    </div>
    <!--Preloader area end here-->
    <main>
        <div class="img-fluid">
            <!-- Sticky Background Image -->
            <div class="auth_form_container container d-flex justify-content-center align-items-center">
                <div class="auth_form_inner box col-12">
                    <div class="row">
                        <div class="col-lg-4 col-12 px-sm-5 py-4 my-3 px-4">
                            <!-- Authentication Form Body -->
                            <form action="<?php echo e(route('adduser')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <!-- Authentication Form Inner Content -->
                                <div>
                                    <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(Helper::image_path(@Helper::appdata()->logo)); ?>" alt="" class="login-form-logo"></a>
                                    <h5 class="bottom-line py-2 mb-0 fw-bold w-auto">Signup</h5>
                                    <h7 class="fs-7">Fill up below details and create your Account.</h7>
                                </div>
                                <div class="form-body mt-4">
                                    <div class="form-group mb-md-3 mb-2">
                                        <label class="form-label fs-7 mb-1" for="name"><?php echo e(trans('labels.full_name')); ?></label>
                                        <?php if(session()->has('social_login')): ?>
                                            <input type="text" class="form-control custom-input rounded mb-1" name="name" value="<?php echo e(session()->get('social_login')['name']); ?>"  placeholder="<?php echo e(trans('labels.full_name')); ?>">
                                        <?php else: ?>
                                            <input type="text" class="form-control custom-input rounded mb-1" name="name" value="<?php echo e(old('name')); ?>"  placeholder="<?php echo e(trans('labels.full_name')); ?>">    
                                        <?php endif; ?>
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group mb-md-3 mb-2">
                                        <label class="form-label fs-7 mb-1" for="email"><?php echo e(trans('labels.email')); ?></label>
                                        <?php if(session()->has('social_login')): ?>
                                            <input type="email" class="form-control custom-input rounded mb-1" name="email" value="<?php echo e(session()->get('social_login')['email']); ?>" id="email" placeholder="<?php echo e(trans('labels.email')); ?>">
                                        <?php else: ?>
                                        <input type="email" class="form-control custom-input rounded mb-1" name="email" value="<?php echo e(old('email')); ?>" id="email" placeholder="<?php echo e(trans('labels.email')); ?>">
                                        <?php endif; ?>
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md">
                                                <label class="form-label fs-7 mb-1" for="mobile"><?php echo e(trans('labels.mobile')); ?></label>
                                                <div class="input-group mb-md-3 mb-2">
                                                    <input type="hidden" name="country" id="country" value="91">
                                                    <input type="tel" id="mobile" name="mobile" class="form-control custom-input rounded mb-3" placeholder="<?php echo e(trans('labels.mobile')); ?>" value="<?php echo e(old('mobile')); ?>">
                                                    <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label fs-7 mb-1" for="referral_code"><?php echo e(trans('labels.referral_code')); ?> </label>
                                                <input type="text" class="form-control custom-input rounded mb-md-3 mb-2" id="referral_code_o" name="referral_code" placeholder="<?php echo e(trans('labels.referral_code_o')); ?>" <?php if(isset($_GET['referral'])): ?> value="<?php echo e($_GET['referral']); ?>" <?php endif; ?>>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if(!session()->has('social_login')): ?>
                                    <?php if(\App\SystemAddons::where('unique_identifier', 'otp')->first() == null || \App\SystemAddons::where('unique_identifier', 'otp')->first()->activated != 1): ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md">
                                                    <label class="form-label fs-7 mb-1" for="password"><?php echo e(trans('labels.password')); ?></label>
                                                        <input type="password" class="form-control custom-input rounded mb-md-3 mb-2" id="password" name="password" placeholder="<?php echo e(trans('labels.password')); ?>" value="<?php echo e(old('password')); ?>">
                                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                    <div class="col-md">
                                                        <label class="form-label fs-7 mb-1" for="confirm_password"><?php echo e(trans('labels.confirm_password')); ?></label>
                                                        <input type="password" class="form-control custom-input rounded mb-md-3 mb-2" id="confirm_password" name="password_confirmation" placeholder="<?php echo e(trans('labels.confirm_password')); ?>" value="<?php echo e(old('password_confirmation')); ?>">
                                                        <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <input type="checkbox" name="checkbox" id="checkbox" value="1" class="form-check-input me-1" <?php echo e(old('checkbox') == 1 ? 'checked' : ''); ?>>
                                        <label for="checkbox" class="form-check-label m-auto fs-7">
                                        <?php echo e(trans('labels.i_accepts_the')); ?> <a href="<?php echo e(URL::to('terms-conditions')); ?>" class="text-primary text-decoration-none fw-medium"><?php echo e(trans('labels.terms_conditions')); ?></a></label>
                                        <?php $__errorArgs = ['checkbox'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <br> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-primary w-100"><?php echo e(trans('labels.signup')); ?></button>
                                    </div>
                                </div>
                                <div class="form-group text-center mt-3">
                                    <p class="mb-0 fs-7">
                                        <?php echo e(trans('labels.already_account')); ?> 
                                        <a href="<?php echo e('login'); ?>" class="text-primary fw-medium text-decoration-none"><?php echo e(trans('labels.signin')); ?></a>
                                    </p>
                                </div>
                            </form>
                        </div>
                        <div class="image col-8">
                                <img src="<?php echo e(url(env('ASSETSPATHURL').'web-assets/images/bg1.jpg')); ?>" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="<?php echo e(url(env('ASSETSPATHURL').'web-assets/js/jquery/jquery-3.6.0.js')); ?>"></script><!-- jQuery JS -->
    <script src="<?php echo e(url(env('ASSETSPATHURL').'web-assets/js/bootstrap/bootstrap.bundle.min.js')); ?>"></script><!-- Bootstrap JS -->
    <!-- COMMON-JS -->
    <script src="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/js/toastr/toastr.min.js')); ?>"></script><!-- Toastr JS -->
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
        <?php if(Session::has('success')): ?>
            toastr.success("<?php echo e(session('success')); ?>");
        <?php endif; ?>
        <?php if(Session::has('error')): ?>
            toastr.error("<?php echo e(session('error')); ?>");
        <?php endif; ?>
        // for-page-loader
        $(window).on('load', function() {
            "use strict";
            $("#preload").delay(600).fadeOut(500);
            $(".pre-loader").delay(600).fadeOut(500);
        })
    </script>
    <script src="<?php echo e(url(env('ASSETSPATHURL').'web-assets/js/intl-tel-input/17.0.8.intlTelInput.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'web-assets/js/intl-tel-input/17.0.8.intlTelInput.min.css')); ?>">
    <script src="<?php echo e(url(env('ASSETSPATHURL').'web-assets/js/intl-tel-input/17.0.8.utils.js')); ?>"></script>
    <script>
        var input = $('#mobile');
        var iti = intlTelInput(input.get(0))
        iti.setCountry("in");
        input.on('countrychange', function(e) {
            $('#country').val(iti.getSelectedCountryData().dialCode);
        });
        $('.iti--allow-dropdown').addClass('w-100');
    </script>
</body>
</html><?php /**PATH C:\wamp64\www\single-restaurant\resources\views/web/auth/register.blade.php ENDPATH**/ ?>