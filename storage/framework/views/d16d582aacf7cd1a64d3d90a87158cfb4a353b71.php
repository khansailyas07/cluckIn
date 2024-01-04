<header>
    <?php if(env('Environment')=='sendbox'): ?>
    <div class="top-header">
        <div class="container">
            <div class="d-block d-md-flex justify-content-center align-items-center">
                <p class="text-center mb-0"> <a href="https://1.envato.market/zaoZ4r" target="_blank" class="fs-7 text-dark">This is a demo website - Buy genuine Single Restaurant we using our official link! Click Now >>> Buy Now</a></p>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="header-bar" id="header1">
        <nav class="navbar navbar-expand-lg sticky-top p-0">
            <div class="container navbar-container">
                <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                    <img class="img-resposive img-fluid" src="<?php echo e(Helper::image_path(@Helper::appdata()->logo)); ?>" alt="logo">
                </a>
                <div class="buttons d-flex align-items-center">
                    <?php if(\App\SystemAddons::where('unique_identifier', 'language')->first() != null && \App\SystemAddons::where('unique_identifier', 'language')->first()->activated == 1): ?>
                    <!-- language-btn -->
                    <div class="dropdown d-block d-lg-none">
                        <a class="btn text-white dropdown-toggle px-1 fs-6" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-globe fs-5"></i></a>
                        <ul class="dropdown-menu <?php echo e(session()->get('direction') == '2' ? 'min-dropdown-rtl' : 'min-dropdown'); ?>" aria-labelledby="dropdownMenuButton1">
                            <?php $__currentLoopData = Helper::language(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a class="dropdown-item text-dark d-flex" href="<?php echo e(URL::to('/language-'.$lang->code)); ?>"><img src="<?php echo e(Helper::image_path($lang->image)); ?>" class="img-fluid lag-img mx-1 rounded-5" alt=""><?php echo e($lang->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <!-- language-btn -->
                    <?php endif; ?>
                    <button class="btn hamburger-lines px-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
                <?php if(session()->get('direction') == ''): ?>
                <div class="border-0 offcanvas offcanvas-end  nav-sidebar" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <?php elseif(session()->get('direction') == '2'): ?>
                    <div class="border-0 offcanvas offcanvas-start  nav-sidebar" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                        <?php else: ?>
                        <div class="border-0 offcanvas offcanvas-end  nav-sidebar" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <?php endif; ?>
                            
                            <div class="offcanvas-header">
                                <button type="button" class="btn text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark  text-primary fs-3"></i></button>

                            </div>
                            <div class="offcanvas-body">
                                <a class="nav-link text-white <?php echo e(request()->is('/') || request()->is('home') ? 'active' : ''); ?>" aria-current="page" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                                <li class="nav-item dropdown list-unstyled">
                                    <a class="nav-link text-white dropdown-toggle <?php echo e(request()->is('menu*') ? 'active' : ''); ?>" href="javascript:void(0)" id="menudropdown" data-bs-toggle="dropdown" aria-expanded="false"><?php echo e(trans('labels.menu')); ?></a>
                                    <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="menudropdown" id="style-3">
                                        <?php $__currentLoopData = Helper::get_categories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a class="dropdown-item text-dark <?php if(isset($_GET['category']) && $_GET['category'] == $category->slug): ?> active <?php endif; ?>" href="<?php echo e(URL::to('/menu?category=' . $category->slug)); ?>"><?php echo e($category->category_name); ?></a>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                                <a class="nav-link text-white <?php echo e(request()->is('gallery') ? 'active' : ''); ?>" href="<?php echo e(route('gallery')); ?> "><?php echo e(trans('labels.gallery')); ?></a>
                                <a class="nav-link text-white <?php echo e(request()->is('blogs') ? 'active' : ''); ?>" href="<?php echo e(route('blogs')); ?> "><?php echo e(trans('labels.blogs')); ?></a>
                                <a class="nav-link text-white <?php echo e(request()->is('reservation') ? 'active' : ''); ?>" href="<?php echo e(route('reservation')); ?>"><?php echo e(trans('labels.book_table')); ?></a>
                                <a class="nav-link text-white <?php echo e(request()->is('contactus') ? 'active' : ''); ?>" href="<?php echo e(route('contact-us')); ?> "><?php echo e(trans('labels.help_contact_us')); ?></a>

                                <a class="nav-link text-white <?php echo e(request()->is('cart') ? 'active' : ''); ?>" href="<?php echo e(route('cart')); ?>"><?php echo e(trans('labels.cart')); ?></a>

                                <?php if(env('Environment') == 'sendbox'): ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link px-3 dropdown-toggle <?php echo e(request()->is('theme*') ? 'active' : ''); ?>" href="javascript:void(0)" id="menudropdown" data-bs-toggle="dropdown" aria-expanded="false"><?php echo e(trans('labels.themes')); ?> </a>
                                    <ul class="dropdown-menu theme-menu text-black " aria-labelledby="menudropdown" id="style-3">
                                        <li>
                                            <a class="nav-link" href="<?php echo e(URL::to('/?theme_id=1')); ?>">Theme-1</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="<?php echo e(URL::to('/?theme_id=2')); ?>">Theme-2 (Addon)</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="<?php echo e(URL::to('/?theme_id=3')); ?>">Theme-3  (Addon)</a>
                                        </li>
                                    </ul>
                                </li>
                                <?php endif; ?>

                                <a class="nav-link text-white" href="<?php echo e(route('search')); ?>"><?php echo e(trans('labels.search')); ?></a>
                                <?php if(Auth::user() && Auth::user()->type == 2): ?>
                                <div class="sidebar-login border-top">
                                    <ul class="navbar-nav my-3 px-3">
                                        <li class="nav-item dropdown">
                                            <div class="dropup">
                                                <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="profiledropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true"><i class="mx-2 fa-regular fa-user"></i>
                                                    <?php echo e(Str::limit(Auth::user()->name, 10)); ?>

                                                </a>
                                                <ul class="dropdown-menu <?php echo e(session()->get('direction') == '2' ? 'text-end' : 'text-start'); ?>" aria-labelledby="profiledropdown">
                                                    <li><a class="dropdown-item text-dark" href="<?php echo e(route('user-profile')); ?>"><i class="mx-2 fa-regular fa-user"></i><?php echo e(trans('labels.my_profile')); ?></a>
                                                    </li>
                                                    <li><a class="dropdown-item text-dark" href="<?php echo e(route('order-history')); ?>"><i class="mx-2 fa fa-list-check"></i><?php echo e(trans('labels.my_orders')); ?></a>
                                                    </li>
                                                    <li><a class="dropdown-item text-dark" href="<?php echo e(route('user-favouritelist')); ?>"><i class="mx-2 fa fa-heart-circle-check"></i><?php echo e(trans('labels.favourite_list')); ?></a>
                                                    </li>
                                                    <li><a class="dropdown-item text-dark" href="<?php echo e(route('user-changepassword')); ?>"><i class="mx-2 fa fa-key"></i><?php echo e(trans('labels.change_password')); ?></a>
                                                    </li>
                                                    <li><a class="dropdown-item text-dark" href="<?php echo e(route('address')); ?>"><i class="mx-2 fa-solid fa-location-crosshairs"></i><?php echo e(trans('labels.my_addresses')); ?></a>
                                                    </li>
                                                    <li><a class="dropdown-item text-dark" href="<?php echo e(route('user-wallet')); ?>"><i class="mx-2 fa fa-wallet"></i><?php echo e(trans('labels.my_wallet')); ?></a>
                                                    </li>
                                                    <li><a class="dropdown-item text-dark" href="<?php echo e(route('refer-earn')); ?>">
                                                            <i class="mx-2 fa-solid fa-share-nodes"></i><?php echo e(trans('labels.refer_earn')); ?> </a>
                                                    </li>
                                                    <li><a class="dropdown-item text-dark" href="javascript:void(0)" onclick="logout('<?php echo e(route('logout')); ?>','<?php echo e(trans('messages.are_you_sure_logout')); ?>','<?php echo e(trans('labels.logout')); ?>')"><i class="mx-2 fa fa-arrow-right-from-bracket"></i><?php echo e(trans('labels.logout')); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <?php else: ?>
                                <div class="sidebar-login">
                                    <a class="my-3 w-100 btn btn-primary" href="<?php echo e(route('login')); ?>"><?php echo e(trans('labels.signin')); ?></a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="navbar-collapse collapse">
                            <div class="navbar-nav mx-auto">
                                <a class="nav-link px-3 <?php echo e(request()->is('/') || request()->is('home') ? 'active' : ''); ?>" aria-current="page" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                                <li class="nav-item dropdown">
                                    <a class="nav-link px-3 dropdown-toggle <?php echo e(request()->is('menu*') ? 'active' : ''); ?>" href="javascript:void(0)" id="menudropdown" data-bs-toggle="dropdown" aria-expanded="false"><?php echo e(trans('labels.menu')); ?></a>
                                    <ul class="dropdown-menu dropdown-menu-custom" aria-labelledby="menudropdown" id="style-3">
                                        <?php $__currentLoopData = Helper::get_categories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a class="dropdown-item text-dark <?php if(isset($_GET['category']) && $_GET['category'] == $category->slug): ?> active <?php endif; ?> " href="<?php echo e(URL::to('menu?category=' . $category->slug)); ?>"><?php echo e($category->category_name); ?></a>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                                <a class="nav-link px-3 <?php echo e(request()->is('gallery') ? 'active' : ''); ?>" href="<?php echo e(route('gallery')); ?> "><?php echo e(trans('labels.gallery')); ?></a>
                                <a class="nav-link px-3 <?php echo e(request()->is('blogs') ? 'active' : ''); ?>" href="<?php echo e(route('blogs')); ?> "><?php echo e(trans('labels.blogs')); ?></a>
                                <a class="nav-link px-3 <?php echo e(request()->is('reservation') ? 'active' : ''); ?>" href="<?php echo e(URL::to('reservation')); ?>"><?php echo e(trans('labels.book_table')); ?></a>
                                <a class="nav-link px-3 <?php echo e(request()->is('contactus') ? 'active' : ''); ?>" href="<?php echo e(route('contact-us')); ?> "><?php echo e(trans('labels.help_contact_us')); ?></a>

                                <?php if(env('Environment') == 'sendbox'): ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link px-3 dropdown-toggle" href="javascript:void(0)" id="menudropdown" data-bs-toggle="dropdown" aria-expanded="false">Theme</a>
                                    <ul class="dropdown-menu theme-menu text-black " aria-labelledby="menudropdown" id="style-3">
                                        <li>
                                            <a class="nav-link" href="<?php echo e(URL::to('/?theme_id=1')); ?>">Theme-1</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="<?php echo e(URL::to('/?theme_id=2')); ?>">Theme-2 (Addon)</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="<?php echo e(URL::to('/?theme_id=3')); ?>">Theme-3 (Addon)</a>
                                        </li>
                                    </ul>
                                </li>
                                <?php endif; ?>

                            </div>
                            <div class="d-flex align-items-center nav-sidebar-d-none">
                                <div class="header-search mx-2">
                                    <input type="text" class="search-form" placeholder="<?php echo e(trans('labels.search_here')); ?>" required>
                                    <?php if(session()->get('direction') == ''): ?>
                                    <a href="<?php echo e(route('search')); ?>" class="search-button border-end pe-3">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </a>
                                    <?php elseif(session()->get('direction') == '2'): ?>
                                    <a href="<?php echo e(route('search')); ?>" class="search-button border-start ps-3">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </a>
                                    <?php else: ?>
                                    <a href="<?php echo e(route('search')); ?>" class="search-button border-end pe-3">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </a>
                                    <?php endif; ?>
                                </div>
                                <div class="cart-area mx-2 d-block">
                                    <a href="<?php echo e(route('cart')); ?>" href="<?php echo e(route('login')); ?>" class="text-white"><i class="fa-solid fa-cart-shopping"></i><span class="cart-badge"><?php echo e(Helper::get_user_cart()); ?></span></a>
                                </div>
                                <div class="mx-3">
                                    <?php if(Auth::user() && Auth::user()->type == 2): ?>
                                    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                                        <ul class="navbar-nav">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link px-3" href="<?php echo e(route('user-profile')); ?>" id="profiledropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-regular fa-user"></i>
                                                    <?php echo e(Str::limit(Auth::user()->name, 6)); ?>

                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="profiledropdown">
                                                    <li>
                                                        <a class="dropdown-item text-dark" href="<?php echo e(route('user-profile')); ?>">
                                                            <i class="mx-2 fa-regular fa-user"></i><?php echo e(trans('labels.my_profile')); ?>

                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-dark" href="javascript:void(0)" onclick="logout('<?php echo e(route('logout')); ?>','<?php echo e(trans('messages.are_you_sure_logout')); ?>','<?php echo e(trans('labels.logout')); ?>')">
                                                            <i class="mx-2 fa fa-arrow-right-from-bracket"></i><?php echo e(trans('labels.logout')); ?>

                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php else: ?>
                                    <div class="mx-4">
                                        <a href="<?php echo e(route('login')); ?>" class="btn btn-sm btn-primary log-btn"><?php echo e(trans('labels.signin')); ?></a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php if(\App\SystemAddons::where('unique_identifier', 'language')->first() != null && \App\SystemAddons::where('unique_identifier', 'language')->first()->activated == 1): ?>
                                <!-- language-btn -->
                                <div class="lag dropdown">
                                    <a class="btn btn-sm border-primary text-white dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><img src="<?php echo e(Helper::image_path(Session::get('flag'))); ?>" class="img-fluid lag-img mx-1 rounded-5" alt=""><?php echo e(Session::get('language')); ?></a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <?php $__currentLoopData = Helper::language(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a class="dropdown-item text-dark d-flex" href="<?php echo e(URL::to('/language-'.$lang->code)); ?>"><img src="<?php echo e(Helper::image_path($lang->image)); ?>" class="img-fluid lag-img mx-1 rounded-5" alt=""><?php echo e($lang->name); ?></a>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <!-- language-btn -->
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
        </nav>
    </div>
</header><?php /**PATH C:\wamp64\www\single-restaurant\resources\views/web/layout/header.blade.php ENDPATH**/ ?>