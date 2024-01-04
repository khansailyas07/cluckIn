<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo e(@Helper::appdata()->title); ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(Helper::image_path(@Helper::appdata()->favicon)); ?>"><!-- FAVICON ICON -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/css/bootstrap/bootstrap.min.css')); ?>"><!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/css/fontawesome/all.min.css')); ?>"><!-- FONTAWESOME CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/css/toastr/toastr.min.css')); ?>"><!-- FONTAWESOME CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/css/style.css')); ?>"><!-- CUSTOM CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/css/responsive.css')); ?>"><!-- RESPONSIVE CSS -->
</head>
<body>
    <?php echo $__env->make('admin.theme.preloader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="auth-main-content d-flex h-100 justify-content-center align-items-center">
        <div class="row justify-content-center align-items-center g-0 w-100">
            <div class="col-xl-4 col-lg-6 col-md-8 col-auto px-md-5 px-2">
                <div class="card box-shadow overflow-hidden border-0">
                    <div class="bg-primary-light">
                        <div class="row">
                            <div class="col-7 d-flex align-items-center">
                                <div class="text-primary p-4">
                                    <h4><?php echo e(trans('labels.forgot_password_q')); ?></h4>
                                </div>
                            </div>
                            <div class="col-5 align-self-end py-2">
                                <img src="<?php echo e(Helper::image_path('authformbgimage.png')); ?>" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <form class="my-3" method="POST" action="<?php echo e(URL::to('admin/send-pass')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" required="" autocomplete="email" autofocus placeholder="<?php echo e(trans('labels.email')); ?>" <?php if(env('Environment') == 'sendbox'): ?> value="admin@gmail.com" readonly="" <?php endif; ?>>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <button class="btn btn-primary w-100 my-3" <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.send')); ?></button>
                            <p class="fs-7 text-center"><?php echo e(trans('labels.already_account')); ?>

                                <a href="<?php echo e(URL::to('admin')); ?>"
                                    class="text-primary fw-semibold"><?php echo e(trans('labels.signin')); ?></a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="circles-backgound-area">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <script src="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/js/jquery/jquery.min.js')); ?>"></script><!-- JQUERY JS -->
    <script src="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/js/bootstrap/bootstrap.bundle.min.js')); ?>"></script><!-- BOOTSTRAP JS -->
    <script src="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/js/toastr/toastr.min.js')); ?>"></script><!-- TOASTR JS -->
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        <?php if(Session::has('success')): ?>
            toastr.success("<?php echo e(session('success')); ?>");
        <?php endif; ?>
        <?php if(Session::has('error')): ?>
            toastr.error("<?php echo e(session('error')); ?>");
        <?php endif; ?>
        $(window).on("load", function () {
            "use strict";
            $('#preloader').fadeOut('slow')
        });
        function myFunction() {
            "use strict";
            toastr.error("This operation was not performed due to demo mode");
        }
    </script>
</body>
</html><?php /**PATH C:\wamp64\www\single-restaurant\resources\views/admin/auth/forgot_password.blade.php ENDPATH**/ ?>