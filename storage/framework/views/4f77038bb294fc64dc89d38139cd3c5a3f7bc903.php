<!doctype html>
<html lang="en" dir="<?php echo e(session('direction') == 2 ? 'rtl' : 'ltr'); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta property="og:title" content="<?php echo e(@Helper::appdata()->og_title); ?>" />
	<meta property="og:description" content="<?php echo e(@Helper::appdata()->og_description); ?>" />
	<meta property="og:image" content='<?php echo e(Helper::image_path(@Helper::appdata()->og_image)); ?>' />
    <title> <?php echo e(@Helper::appdata()->title); ?> <?php echo $__env->yieldContent('page_title'); ?></title>
    <link rel="icon" href="<?php echo e(Helper::image_path(@Helper::appdata()->favicon)); ?>"><!-- Favicon -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'web-assets/css/bootstrap.min.css')); ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'web-assets/css/owl_carousel/owl.carousel.min.css')); ?>">
    <!-- owl-carousel css -->
    <link rel="stylesheet"
        href="<?php echo e(url(env('ASSETSPATHURL').'web-assets/css/owl_carousel/owl.theme.default.min.css')); ?>">
    <!-- owl-carousel css -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'web-assets/css/font_awesome/all.css')); ?>">
    <!-- Font Awesome CSS -->
    <!-- COMMON-CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/css/toastr/toastr.min.css')); ?>"><!-- Toastr CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/css/sweetalert/sweetalert2.min.css')); ?>"><!-- Sweetalert CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'web-assets/css/style.css')); ?>"><!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'web-assets/css/responsive.css')); ?>"><!-- Media Query Resposive CSS -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <style>
        .breadcrumb-sec{
            background: url('<?php echo e(Helper::image_path(Helper::appdata()->breadcrumb_bg_image)); ?>') center center/cover no-repeat !important;
        }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
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
        <div class="wrapper">
            <input type="hidden" name="hdnsession" id="hdnsession" value="<?php echo e(session()->get('direction')); ?>">
            <?php echo $__env->make('web.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="content-wrapper">
                <?php echo $__env->yieldContent('content'); ?>
                <?php echo $__env->make('web.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </main>
    <!-- Modal Item Details -->
    <div class="modal fade modalitemdetails" id="modalitemdetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content p-4">
                <div class="modal-header align-items-start p-0 py-3">
                    <div class="d-flex">
                        <span id="item_type_image"></span>
                        <div class="d-grid <?php echo e(session()->get('direction') == '2' ? 'me-2' : 'ms-2'); ?>">
                            <p class="modal-title fs-5 fw-bold item_name"></p>
                            <p class="text-muted item_price"></p>
                        </div>
                    </div>
                    <button type="button"
                        class="btn-close mt-1 <?php echo e(session()->get('direction') == 2 ? 'close m-0' : ''); ?>"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0 ">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="item-details">
                                <div class="item-varition-list mb-4" id="variation">
                                    <h6 class="attribute fw-bold"></h6>
                                    <div class="varition-listing"></div>
                                </div>
                                <div class="item-addons-list mb-4" id="addons">
                                    <h6 class="fw-bold"><?php echo e(trans('labels.addons')); ?></h6>
                                    <div class="addons-listing"></div>
                                </div>
                                
                                <input type="hidden" name="slug" id="slug">
                                
                                <input type="hidden" name="item_name" id="item_name">
                                
                                <input type="hidden" name="item_type" id="item_type">
                                
                                <input type="hidden" name="image_name" id="image_name">
                                
                                <input type="hidden" name="tax" id="item_tax">
                                
                                <input type="hidden" name="item_price" id="item_price">
                                
                                <input type="hidden" name="addonstotal" id="addonstotal" value="0">
                                
                                <input type="hidden" name="subtotal" id="subtotal" value="0">
                                <div class="modal-footer px-0">
                                
                                    <a class="btn btn-success w-100 m-0 my-2" onclick="addtocart('<?php echo e(URL::to('addtocart')); ?>')"><?php echo e(trans('labels.add_to_cart')); ?></a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('cookie-consent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="<?php echo e(url(env('ASSETSPATHURL').'web-assets/js/jquery/jquery-3.6.0.js')); ?>"></script><!-- jQuery JS -->
    <script src="<?php echo e(url(env('ASSETSPATHURL').'web-assets/js/owl_carousel/owl.carousel.js')); ?>"></script><!-- owl carousel js -->
    <script src="<?php echo e(url(env('ASSETSPATHURL').'web-assets/js/bootstrap/bootstrap.bundle.min.js')); ?>"></script><!-- Bootstrap CSS -->
    <!-- COMMON-FOR-TOASTER-&-SWEETALERT -->
    <script src="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/js/toastr/toastr.min.js')); ?>"></script><!-- Toastr JS -->
    <script src="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/js/sweetalert/sweetalert2.min.js')); ?>"></script><!-- Sweetalert JS -->
    <script>
        // COMMON-SCRIPTS
        // to-display-success-error-message
        toastr.options = {
            "closeButton": true,
        }
        <?php if(Session::has('success')): ?>
            toastr.success("<?php echo e(session('success')); ?>");
        <?php endif; ?>
        <?php if(Session::has('error')): ?>
            toastr.error("<?php echo e(session('error')); ?>");
        <?php endif; ?>
        // for-sweetalert
        let are_you_sure = "<?php echo e(trans('messages.are_you_sure')); ?>";
        let yes = "<?php echo e(trans('messages.yes')); ?>";
        let no = "<?php echo e(trans('messages.no')); ?>";
        let wrong = "<?php echo e(trans('messages.wrong')); ?>";
        let record_safe = "<?php echo e(trans('messages.record_safe')); ?>";
        let okay = "<?php echo e(trans('labels.okay')); ?>";
        let track_order = "<?php echo e(trans('labels.track_order')); ?>";
        let continue_shopping = "<?php echo e(trans('labels.continue_shopping')); ?>";
        let order_placed = "<?php echo e(trans('labels.order_placed')); ?>";
        let order_placed_note = "<?php echo e(trans('messages.order_placed_note')); ?>";
        let restaurant_closed = "<?php echo e(trans('messages.restaurant_closed')); ?>";
        // others
        function currency_format(price) {
            "use strict";
            if ("<?php echo e(@Helper::appdata()->currency_position); ?>" == 1) {
                return "<?php echo e(@Helper::appdata()->currency); ?>" + parseFloat(price).toFixed(2);
            } else {
                return parseFloat(price).toFixed(2) + "<?php echo e(@Helper::appdata()->currency); ?>";
            }
        }
    </script>
    <script src="<?php echo e(url(env('ASSETSPATHURL').'web-assets/js/common.js')); ?>"></script><!-- web-common-js -->
    <?php echo $__env->yieldContent('scripts'); ?>

    <script>
        
        </script>
</body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/single-restaurant/resources/views/web/layout/default.blade.php ENDPATH**/ ?>