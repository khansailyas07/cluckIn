<?php $__env->startSection('page_title'); ?>
| <?php echo e(trans('labels.home')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Slider Area Start Here -->
<?php if(count($sliders)>0): ?>
<section class="slider-area">
    <div id="slidercarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sliderdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                <img src="<?php echo e(Helper::image_path($sliderdata->image)); ?>" class="d-block img-fluid" alt="slider">
                <div class="carousel-caption d-flex h-100 align-items-center justify-content-center flex-column">
                    <h5><?php echo e($sliderdata->title); ?></h5>
                    <p><?php echo e($sliderdata->description); ?></p>
                    <?php if($sliderdata['item_info'] != ''): ?>
                    <a href="<?php echo e(URL::to('/item-' . $sliderdata['item_info']->slug)); ?>" class="btn btn-primary fw-bold px-4 py-2"><?php echo e(trans('labels.explore')); ?> <i class="fa-solid fa-circle-arrow-right"></i> </a>
                    <?php endif; ?>
                    <?php if($sliderdata['category_info'] != ''): ?>
                    <a href="<?php echo e(URL::to('/menu/?category=' . $sliderdata['category_info']->slug)); ?>" class="btn btn-primary fw-bold px-4 py-2"><?php echo e(trans('labels.explore')); ?> <i class="fa-solid fa-circle-arrow-right"></i> </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <button class="carousel-control-prev <?php echo e(count($sliders) == 1 ? 'd-none' : ''); ?>" type="button" data-bs-target="#slidercarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next <?php echo e(count($sliders) == 1 ? 'd-none' : ''); ?>" type="button" data-bs-target="#slidercarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
</section>
<?php endif; ?>
<!-- Slider Area End Here -->
<!-- Promotional topbanners Start Here -->
<?php if(count($banners['topbanners']) > 0): ?>
<section class="banner1 my-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="news-slider" class="owl-carousel">
                    <?php $__currentLoopData = $banners['topbanners']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bannerdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="post-slide">
                        <div class="post-img">
                            <?php if($bannerdata['item_info'] != ''): ?>
                            <a href="<?php echo e(URL::to('/item-' . $bannerdata['item_info']->slug)); ?>">
                                <?php elseif($bannerdata['category_info'] != ''): ?>
                                <a href="<?php echo e(URL::to('/menu/?category=' . $bannerdata['category_info']->slug)); ?>">
                                    <?php else: ?>
                                    <a href="javascript:void(0);">
                                        <?php endif; ?>
                                        <img src="<?php echo e($bannerdata['image']); ?>" alt="banner">
                                    </a>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- Promotional topbanners End Here -->
<!-- Category Section Start Here -->
<?php if(count(Helper::get_categories()) > 0): ?>
<section class="category">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="text-uppercase fw-bold"><?php echo e(trans('labels.categories')); ?></h1>
                        <p class="sub-lables text-capitalize my-3"><?php echo e(trans('labels.top_categories')); ?></p>
                    </div>
                    <div class="col-auto text-end align-center">
                        <a href="<?php echo e(route('categories')); ?>" class="btn btn-sm btn-outline-primary px-4 py-2"><?php echo e(trans('labels.view_all')); ?></a>
                    </div>
                </div>
                <div id="category" class="owl-carousel mt-2">
                    <?php $__currentLoopData = Helper::get_categories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorydata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="category-wrapper mx-2">
                        <a href="<?php echo e(URL::to('/menu/?category=' . $categorydata->slug)); ?>">
                            <div class="cat rounded-circle">
                                <img src="<?php echo e(Helper::image_path($categorydata->image)); ?>" class="rounded-circle" alt="category">
                            </div>
                        </a>
                        <p class="text-center my-2"><?php echo e($categorydata->category_name); ?></p>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- Category Section End Here -->
<!-- topitemlist dishes Section Start Here -->
<?php if(count($topitemlist) > 0): ?>
<section class="menu my-5">
    <div class="container">
        <div class="row align-items-center justify-content-between my-2">
            <div class="col-auto menu-heading">
                <h1 class="text-uppercase"><?php echo e(trans('labels.trending')); ?></h1>
                <p class="sub-lables text-capitalize my-3"><?php echo e(trans('labels.top_trending')); ?></p>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(URL::to('/view-all?type=topitems')); ?>" class="btn btn-sm btn-outline-primary px-4 py-2"><?php echo e(trans('labels.view_all')); ?></a>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $topitemlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('web.home1.itemview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- topitemlist dishes Section End Here -->
<!-- Promotional bannersection1 Start Here -->
<?php if(count($banners['bannersection1']) > 0): ?>
<section class="banner2 my-md-5 my-sm-3">
    <div id="banner1" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php $__currentLoopData = $banners['bannersection1']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bannerdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                <?php if($bannerdata['item_info'] != ''): ?>
                <a href="<?php echo e(URL::to('/item-' . $bannerdata['item_info']->slug)); ?>">
                    <?php elseif($bannerdata['category_info'] != ''): ?>
                    <a href=" <?php echo e(URL::to('/menu/?category=' . $bannerdata['category_info']->slug)); ?> ">
                        <?php else: ?>
                    <a href="javascript:void(0)">
                        <?php endif; ?>
                        <img src="<?php echo e($bannerdata['image']); ?>" height="400" alt="banner2">
                    </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <button class="carousel-control-prev <?php echo e(count($banners['bannersection1']) == 1 ? 'd-none' : ''); ?>" type="button" data-bs-target="#banner1" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?php echo e(trans('labels.previous')); ?></span>
        </button>
        <button class="carousel-control-next <?php echo e(count($banners['bannersection1']) == 1 ? 'd-none' : ''); ?>" type="button" data-bs-target="#banner1" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?php echo e(trans('labels.next')); ?></span>
        </button>
    </div>
</section>
<?php endif; ?>
<!-- Promotional bannersection1 End Here -->
<!-- todayspecial Dishes Section Start Here -->
<?php if(count($todayspecial) > 0): ?>
<section class="menu my-5">
    <div class="container">
        <div class="row align-items-center justify-content-between my-2">
            <div class="col-auto menu-heading">
                <h1 class="text-uppercase"><?php echo e(trans('labels.todays_special')); ?></h1>
                <p class="sub-lables text-capitalize my-3"><?php echo e(trans('labels.top_special')); ?></p>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(URL::to('/view-all?type=todayspecial')); ?>" class="btn btn-sm btn-outline-primary px-4 py-2"><?php echo e(trans('labels.view_all')); ?></a>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $todayspecial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('web.home1.itemview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- todayspecial Dishes Section End Here -->
<!-- Promotional bannersection2 Start Here -->
<?php if(count($banners['bannersection2']) > 0): ?>
<section class="banner1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div id="bannersection2" class="owl-carousel">
                    <?php $__currentLoopData = $banners['bannersection2']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bannerdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="post-slide">
                        <div class="post-img">
                            <?php if($bannerdata['item_info'] != ''): ?>
                            <a href="<?php echo e(URL::to('/item-' . $bannerdata['item_info']->slug)); ?>">
                            <?php elseif($bannerdata['category_info'] != ''): ?>
                            <a href="<?php echo e(URL::to('/menu/?category=' . $bannerdata['category_info']->slug)); ?>">
                            <?php else: ?>
                            <a href="javascript:void(0);">
                                <?php endif; ?>
                                <img src="<?php echo e($bannerdata['image']); ?>" alt="banner">
                            </a>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- Promotional bannersection2 End Here -->
<!-- Table Resrvation Section Start Here -->
<section class="my-5 ">
    <div class="container">
        <div class="table-booking row align-items-center bg-section-gray rounded-5">
            <div class="reservation-content py-sm-5 py-0 px-sm-5 px-3 col-md-6">
                    <h1 class="text-uppercase"><?php echo e(trans('labels.book_table')); ?></h1>
                    <p class="sub-lables"><?php echo e(trans('labels.make_reservation')); ?></p>
                <div>
                    <a href="<?php echo e(route('reservation')); ?>" class="btn btn-primary px-4 py-2 btn-sm" role="button"><?php echo e(trans('labels.book_now')); ?></a>
                </div>
            </div>
            <div class="col-md-6 p-2">
                <img src="<?php echo e(Helper::image_path(@Helper::appdata()->booknow_bg_image)); ?>" class="w-100 object-fit-cover rounded-5" alt="table booking">
            </div>
        </div>
    </div>
</section>
<!-- Table Resrvation Section End Here -->
<!-- recommended Section Start Here -->
<?php if(count($recommended) > 0): ?>
<section class="menu my-5">
    <div class="container">
        <div class="row align-items-center justify-content-between my-2">
            <div class="col-auto menu-heading">
                <h1 class="text-uppercase"><?php echo e(trans('labels.recommended')); ?></h1>
                <p class="sub-lables text-capitalize my-3"><?php echo e(trans('labels.top_recommended')); ?></p>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(URL::to('/view-all?type=recommended')); ?>" class="btn btn-sm btn-outline-primary px-4 py-2"><?php echo e(trans('labels.view_all')); ?></a>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $recommended; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('web.home1.itemview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- recommended Section End Here -->
<!-- Promotional bannersection3 Start Here -->
<?php if(count($banners['bannersection3']) > 0): ?>
<section class="banner2 mt-md-5 mt-sm-3 mb-0">
    <div id="banner3" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php $__currentLoopData = $banners['bannersection3']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bannerdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                <?php if($bannerdata['item_info'] != ''): ?>
                <a href="<?php echo e(URL::to('/item-' . $bannerdata['item_info']->slug)); ?>">
                    <?php elseif($bannerdata['category_info'] != ''): ?>
                    <a href=" <?php echo e(URL::to('/menu/?category=' . $bannerdata['category_info']->slug)); ?> ">
                        <?php else: ?>
                        <a href="javascript:void(0)">
                            <?php endif; ?>
                            <img src="<?php echo e($bannerdata['image']); ?>" height="400" alt="banner3">
                        </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <button class="carousel-control-prev <?php echo e(count($banners['bannersection3']) == 1 ? 'd-none' : ''); ?>" type="button" data-bs-target="#banner3" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?php echo e(trans('labels.previous')); ?></span>
        </button>
        <button class="carousel-control-next <?php echo e(count($banners['bannersection3']) == 1 ? 'd-none' : ''); ?>" type="button" data-bs-target="#banner3" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?php echo e(trans('labels.next')); ?></span>
        </button>
    </div>
</section>
<?php endif; ?>
<!-- Promotional bannersection3 End Here -->
<!-- Testimonials Section Start Here -->
<?php if(count($testimonials) > 0): ?>
<section class="testimonial bg-section-gray py-5">
    <div class="container">
        <div class="row align-items-center justify-content-center ">
            <div>
                <h1 class="text-uppercase"><?php echo e(trans('labels.reviews')); ?></h1>
                <p class="sub-lables text-capitalize my-3"><?php echo e(trans('labels.top_testimonial')); ?></p>
            </div>
            <div class="testimonial-1 owl-carousel owl-theme mt-4">
                <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $testimonialdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item box p-4">
                    <p class="col-11"><?php echo e(Str::limit($testimonialdata->comment, 75)); ?></p>
                    <div class="col-12">
                        <div class="col-3 my-4">
                            <img src="<?php echo e($testimonialdata['user_info']->profile_image); ?>" class="w-100" alt="">
                        </div>
                        <div>
                            <div class="review-star fs-7 mt-3">
                                <i class="fa-solid fa-star fs-6"></i>
                                <i class="fa-solid fa-star fs-6"></i>
                                <i class="fa-solid fa-star fs-6"></i>
                                <i class="fa-solid fa-star fs-6"></i>
                                <i class="fa-solid fa-star fs-6"></i>
                                <span> (<?php echo e(number_format($testimonialdata->ratting, 1)); ?>/5.0)</span>
                            </div>
                            <h4 class="text-capitalize d-flex align-items-center fs-5 fw-medium my-1">- <?php echo e($testimonialdata['user_info']->name); ?></h4>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- Testimonials Section End Here -->
<!-- App Download Section Start Here -->
<?php if(!empty(@Helper::appdata()->mobile_app_image)): ?>
<section>
    <div class="app_download">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-5 col-12 d-flex justify-content-center align-items-center app-screen p-5 d-md-block d-none">
                    <img src="<?php echo e(Helper::image_path(@Helper::appdata()->mobile_app_image)); ?>" alt="app-screen" class="w-100 object-fit-cover">
                </div>
                <div class="col-md-7 col-12 d-flex align-items-center">
                    <div class="app_content">
                        <h1 class="text-uppercase"><?php echo e(@Helper::appdata()->mobile_app_title); ?></h1>
                        <span class="text-muted"><?php echo e(@Helper::appdata()->mobile_app_description); ?></span>
                        <div class="my-4 d-flex">
                            <?php if(!@Helper::appdata()->android == ''): ?>
                            <a href="<?php echo e(@Helper::appdata()->android); ?>" target="_blank">
                                <img src="<?php echo e(Helper::web_image_path('playstore.png')); ?>" width="100%" height="46" alt="">
                            </a>
                            <?php endif; ?>
                            <?php if(!@Helper::appdata()->ios == ''): ?>
                            <a class="ms-3" href="<?php echo e(@Helper::appdata()->ios); ?>" target="_blank">
                                <img src="<?php echo e(Helper::web_image_path('appstore.svg')); ?>" width="100%" height="46" alt="">
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- App Download Section End Here -->

<!-- slider-gallery start Here -->
<section class="my-5 theme-2-gallery">
    <div class="container">
        <div class="row align-items-center my-2">
            <div class="gallery-heading col-auto menu-heading">
                <h1 class="text-uppercase"><?php echo e(trans('labels.gallery')); ?></h1>
                <p class="sub-lables text-capitalize my-3"><?php echo e(trans('labels.our_gallery')); ?></p>
            </div>
        </div>
    </div>
    <div class="gallery owl-carousel owl-theme">
        <?php $__currentLoopData = $getgalleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="item"> 
            <img src="<?php echo e($image->image_url); ?>" href="javascript:void(0)" alt="">
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<!-- slider-gallery end Here -->

<!-- Blog Section Start Here -->
<?php if(count($getblogs) > 0): ?>
<section>
    <div class="blog-wrapper mt-5">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto blog-heading">
                    <h1 class="text-uppercase"><?php echo e(trans('labels.latest_blogs')); ?></h1>
                    <p class="sub-lables text-capitalize my-3"><?php echo e(trans('labels.top_blogs')); ?></p>
                </div>
                <div class="col-auto">
                    <a href="<?php echo e(route('blogs')); ?>" class="btn btn-sm btn-outline-primary px-4 py-2"><?php echo e(trans('labels.view_all')); ?></a>
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $getblogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bloglist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('web.blogs.blogview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- Blog Section End Here -->

<?php echo $__env->make('web.subscribeform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <!-- JS For Promotional Banner Section 1 -->
    <script>
        $(document).ready(function() {
            $("#news-slider ").owlCarousel({
                rtl: <?php if(session()->get('direction') == '2'): ?>
                    true
                <?php else: ?>
                    false
                <?php endif; ?> ,
                loop: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    400: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    600: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    800: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    1000: {
                        items: 3,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    1200: {
                        items: 3,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    }
                }
            });
        });
    </script>
    <!-- JS For Category Section -->
    <script>
        $(document).ready(function() {
            $("#category").owlCarousel({
                rtl: <?php if(session()->get('direction') == '2'): ?>
                    true
                <?php else: ?>
                    false
                <?php endif; ?> ,
                loop: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                    },
                    400: {
                        items: 3,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 65,
                    },
                    600: {
                        items: 4,
                        nav: false,
                        dots: false,
                        margin: 38,
                    },
                    800: {
                        items: 5,
                        nav: false,
                        dots: false,
                        margin: 45,
                    },
                    1000: {
                        items: 6,
                        dots: false,
                        nav: false,
                        loop: false,
                        arrows: true,
                        margin: 35,
                    },
                }
            });
        });
    </script>
    <!-- JS For Promotional Banner Section 3 -->
    <script>
        $(document).ready(function() {
            $("#bannersection2").owlCarousel({
                rtl: <?php if(session()->get('direction') == '2'): ?>
                    true
                <?php else: ?>
                    false
                <?php endif; ?> ,
                loop: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    400: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    600: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    800: {
                        items: 2,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    1000: {
                        items: 3,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    },
                    1200: {
                        items: 4,
                        nav: false,
                        dots: false,
                        arrow: true,
                        margin: 10,
                        loop: false,
                        // rewind: true
                    }
                }
            });
            $('.testimonial-1').owlCarousel({
                rtl: <?php if(session()->get('direction') == '2'): ?>
                    true
                <?php else: ?>
                    false
                <?php endif; ?> ,
                loop:true,
                margin:10,
                nav:false,
                dots:true,
                autoplay:true,
                autoplayTimeout: 4000,
                responsive:{
                    0:{
                        items:1
                    },
                    500:{
                        items:2
                    },
                    1000:{
                        items:3
                    },
                    1200:{
                        items:4
                    },
                }
            });
        });
    </script>
    <!-- slider-gallery -->
        <script>
            $('.gallery').owlCarousel({
                rtl: <?php if(session()->get('direction') == '2'): ?>
                        true
                    <?php else: ?>
                        false
                    <?php endif; ?> ,
                loop:true,
                margin:10,
                responsiveClass:true,
                nav:false,
                dots:false,
                center:true,
                responsive:{
                    0:{
                        items:1,
                    },
                    600:{
                        items:3,
                    },
                    1000:{
                        items:5,
                    }
                }
            });
        </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\single-restaurant\resources\views/web/home1/index.blade.php ENDPATH**/ ?>