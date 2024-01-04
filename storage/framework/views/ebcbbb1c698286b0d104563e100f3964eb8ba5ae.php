<?php $__env->startSection('page_title'); ?>
| <?php echo e(trans('labels.my_cart')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb-sec">
    <div class="container">
        <div class="breadcrumb-sec-content">
            <h1><?php echo e(trans('labels.my_cart')); ?></h1>
            <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item <?php echo e(session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                        <a class="text-muted" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                    </li>
                    <li class="breadcrumb-item <?php echo e(session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active" aria-current="page"><?php echo e(trans('labels.cart')); ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section>
    <div class="container">
        <div class="cart-view my-5">
            <?php if(count($getcartlist) > 0): ?>
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <?php
                    $totaltax = 0;
                    $totaltaxamount = 0;
                    $order_total = 0;
                    $total_item_qty = 0;
                    ?>
                    <?php $__currentLoopData = $getcartlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="text-danger err<?php echo e($item['id']); ?>"></span>
                    <div class="order-list mb-4">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-2 col-sm-2 p-0 col-auto d-none d-md-flex  justify-content-center item-img-none">
                                <div class="item-img">
                                    <img src="<?php echo e(Helper::image_path($item->item_image)); ?>" alt="item-image">
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-12 col-detail">
                                <div class="row">
                                    <div class="col-md-10 col-sm-10 col-10 p-0">
                                        <?php
                                        $addons_id = explode(',', $item['addons_id']);
                                        $addons_price = explode(',', $item['addons_price']);
                                        $addons_name = explode(',', $item['addons_name']);
                                        ?>

                                        <div class="item-title d-flex align-items-center mb-0">
                                            <img <?php if($item->item_type == 1): ?> src="<?php echo e(Helper::image_path('veg.svg')); ?>" <?php else: ?> src="<?php echo e(Helper::image_path('nonveg.svg')); ?>" <?php endif; ?>
                                            alt="" class="me-1">
                                            <?php echo e($item->item_name); ?> <?php if($item['addons_id'] != ''): ?> : <?php echo e(Helper::currency_format($item['item_price'])); ?> <?php endif; ?>
                                        </div>
                                        <p class="mb-0"><small><?php echo e($item->variation != '' ? $item->variation : '-'); ?></small></p>
                                        <p class="mb-0">
                                            <?php if($item['addons_id'] != ''): ?>
                                            <small><a class="text-muted" href="javascript:void(0)" onclick="showaddons('<?php echo e($item['addons_name']); ?>','<?php echo e($item['addons_price']); ?>')" data-bs-toggle="modal" data-bs-target="#modal_selected_addons"><?php echo e(trans('labels.addons')); ?> <i class="fa-solid fa-angles-right"></i></a></small>
                                            <?php else: ?>
                                            <small>-</small>
                                            <?php endif; ?>
                                        </p>
                                        <p class="item-price text-start text_green"><?php echo e(Helper::currency_format($item['item_price'] + $item['addons_total_price'])); ?></p>
                                        <?php
                                        $tax = ($item['item_price'] * $item['qty'] * $item['tax']) / 100;
                                        $total_price = ($item['item_price'] + $item['addons_total_price']) * $item['qty'];
                                        $totaltaxamount += (float) $tax;
                                        $order_total += (float) $total_price;
                                        $total_item_qty += $item['qty'];
                                        ?>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-2 d-flex align-items-end justify-content-between flex-column quantity-column">
                                        <a href="javascript:void(0)" onclick="deletecartitem('<?php echo e($item['id']); ?>','<?php echo e(URL::to('/cart/deleteitem')); ?> ') ">
                                            <i class="fa-solid fa-trash-can text-primary mb-2"></i> </a>
                                        <div class="item-quantity">
                                            <button class="btn btn-sm item-quantity-minus" onclick="qtyupdate('<?php echo e($item['id']); ?>','minus','<?php echo e(URL::to('/cart/qtyupdate')); ?>')">-</button>
                                            <input class="item-quantity-input" type="text" value="<?php echo e($item['qty']); ?>" readonly />
                                            <button class="btn btn-sm item-quantity-plus" onclick="qtyupdate('<?php echo e($item['id']); ?>','plus','<?php echo e(URL::to('/cart/qtyupdate')); ?>')">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="promocode mb-4 py-4">
                        <div class="row justify-content-between align-items-center mb-2">
                            <div class="col-auto"><label for="offer_code"><?php echo e(trans('labels.apply_promo')); ?></label>
                            </div>
                            <?php if(!session()->get('discount_data')): ?>
                            <div class="col-auto"><a href="javascript:void(0)" class="text-uppercase" data-bs-toggle="modal" data-bs-target="#promocodemodal"><?php echo e(trans('labels.select_promocode')); ?></a></div>
                            <?php endif; ?>
                        </div>
                        <div class="row justify-content-between align-items-center">
                            <?php if(session()->get('discount_data')): ?>
                            <form action="<?php echo e(URL::to('/promocodes/remove')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="d-flex">
                                    <input type="text" class="form-control" name="offer_code" value="<?php echo e(session()->get('discount_data')['offer_code']); ?>" id="offer_code" placeholder="<?php echo e(trans('labels.have_promocode')); ?>" disabled>
                                    <button type="submit" class="btn btn-primary bg-primary border-0 ms-2"><?php echo e(trans('labels.remove')); ?>

                                    </button>
                                </div>
                            </form>
                            <?php else: ?>
                            <form action="<?php echo e(URL::to('/promocodes/apply')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="d-flex">
                                    <input type="hidden" name="order_amount" value="<?php echo e($order_total); ?>">
                                    <input type="text" class="form-control" name="offer_code" value="<?php echo e(old('offer_code')); ?>" id="offer_code" placeholder="<?php echo e(trans('labels.have_promocode')); ?>" readonly>
                                    <button type="submit" class="btn px-4 btn-primary bg-primary border-0 <?php echo e(session()->get('direction') == '2' ? 'me-2' : 'ms-2'); ?>"><?php echo e(trans('labels.apply')); ?></button>
                                </div>
                                <?php $__errorArgs = ['offer_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </form>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="summary py-3 mb-4">
                        <h2 class="border-bottom"><?php echo e(trans('labels.bill_details')); ?></h2>
                        <div class="bill-details border-bottom">
                            <?php
                            if (session()->has('discount_data')) {
                            $discount_amount = session()->get('discount_data')['offer_amount'];
                            } else {
                            $discount_amount = 0;
                            }
                            $grand_total = $order_total - $discount_amount + $totaltaxamount;
                            ?>
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto"><span><?php echo e(trans('labels.order_total')); ?></span></div>
                                <div class="col-auto">
                                    <p><?php echo e(Helper::currency_format($order_total)); ?></p>
                                </div>
                            </div>
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto"><span><?php echo e(trans('labels.tax')); ?></span></div>
                                <div class="col-auto">
                                    <p><?php echo e(Helper::currency_format($totaltaxamount)); ?></p>
                                </div>
                            </div>
                            <?php if(session()->has('discount_data')): ?>
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto"><span><?php echo e(trans('labels.discount')); ?>

                                        <?php echo e(session()->has('discount_data') == true ? '(' . session()->get('discount_data')['offer_code'] . ')' : ''); ?>

                                    </span></div>
                                <div class="col-auto">
                                    <p>- <?php echo e(Helper::currency_format($discount_amount)); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="bill-total mt-2">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto"><span><?php echo e(trans('labels.grand_total')); ?></span></div>
                                <div class="col-auto"><span><?php echo e(Helper::currency_format($grand_total)); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="summary py-3 mb-4 <?php if($getsettings->pickup_delivery != 1): ?> d-none <?php endif; ?>">
                        <div class="order-option">

                            <?php if($getsettings->pickup_delivery == 1): ?>
                            
                                <label class="form-check-label" for="delivery">
                                    <input class="form-check-input" type="radio" name="order_type" value="1" checked id="delivery">
                                    <div class="home-delivery-img">
                                        <img src="<?php echo e(Helper::web_image_path('delivery.png')); ?>" alt="">
                                        <span><?php echo e(trans('labels.delivery')); ?></span>
                                    </div>
                                </label>

                                <label class="form-check-label" for="pickup">
                                    <input class="form-check-input" type="radio" name="order_type" value="2" <?php echo e(session()->get('order_type') == 2 ? 'checked' : ''); ?> id="pickup">
                                    <div class="home-delivery-img">
                                        <img src="<?php echo e(Helper::web_image_path('takeaway.png')); ?>" alt="">
                                        <span><?php echo e(trans('labels.take_away')); ?></span>
                                    </div>
                                </label>

                            <?php elseif($getsettings->pickup_delivery == 2): ?>
                            
                                <input type="radio" name="order_type" value="1" checked id="delivery">

                            <?php elseif($getsettings->pickup_delivery == 3): ?>
                            
                                <input type="radio" name="order_type" value="2" checked id="pickup">
                    
                            <?php endif; ?>

                        </div>
                    </div>
                    

                    <a class="d-none" id="data" data-url="<?php echo e(URL::to('/holduser')); ?>" data-next-url="<?php echo e(route('checkout')); ?>"></a>

                    <button class="btn btn-success w-100 py-2" onclick="isopenclose('<?php echo e(URL::to('/isopenclose')); ?>','<?php echo e($total_item_qty); ?>','<?php echo e($order_total); ?>')"><?php echo e(trans('labels.continue')); ?></button>

                    <!-- MODAL_USER_TYPE_SELECTION--START -->

                    <div class="modal fade" id="useroption" tabindex="-1" aria-labelledby="useroptionLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="useroptionLabel">
                                        <?php echo e(trans('labels.user_option')); ?>

                                    </h5>
                                    <button type="button" class="btn-close m-0 <?php echo e(session()->get('direction') == 2 ? 'close' : ''); ?>" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="fs-7 twoline">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit, aut! Deleniti est assumenda natus esse magni cupiditate dolor earum, laboriosam magnam deserunt accusantium vitae nam adipisci blanditiis quaerat voluptates numquam.
                                    </p>
                                    <div class="d-grid gap-2 d-flex justify-content-start social-share-icon">
                                        <a class="btn btn-primary bg-danger border-0 w-100 p-3" href="javascript:void(0)" onclick="showlogin()" type="button">
                                            <i class="fa-solid fa-user-plus"></i>
                                            <span class="px-2"><?php echo e(trans('labels.create_account')); ?></span>
                                        </a>
                                        <a class="btn btn-success w-100 p-3" href="javascript:void(0)" onclick="holduser(this)" data-url="<?php echo e(URL::to('/holduser')); ?>" data-next-url="<?php echo e(route('checkout')); ?>" type="submit">
                                            <i class="fa-solid fa-address-card"></i>
                                            <span class="px-2"><?php echo e(trans('labels.continue_as_guest')); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- MODAL-ORDER-TYPE-SELECTION--END -->
                </div>
            </div>
            <?php else: ?>
             <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- MODAL_SELECTED_ADDONS--START -->
<div class="modal fade" id="modal_selected_addons" tabindex="-1" aria-labelledby="selected_addons_Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selected_addons_Label"><?php echo e(trans('labels.selected_addons')); ?></h5>
                <button type="button" class="btn-close m-0 <?php echo e(session()->get('direction') == 2 ? 'close' : ''); ?>" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary px-4 py-2" data-bs-dismiss="modal"><?php echo e(trans('labels.close')); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL_SELECTED_ADDONS--END -->

<!-- MODAL-PROMOCOE---START -->
<div class="modal fade" id="promocodemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-body py-0 px-4 rounded">
                <div class="modal-header border-0 px-0 pb-0">
                    <h5 class="modal-title fw-semibold" id="exampleModalLabel"><?php echo e(trans('labels.apply_promo')); ?></h5>
                    <button type="button" class="btn-close btn-sm m-0 <?php echo e(session()->get('direction') == 2 ? 'close' : ''); ?>" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>                
                <?php $__currentLoopData = $getpromocodelist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promocode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $count = Helper::getcouponcodecount($promocode->offer_code);
                    ?>
                    <div class="card my-4 border-0">
                        <div class="card-body p-0 <?php echo e(session()->get('direction') == '2' ? 'pe-3' : 'ps-3'); ?>">
                            <?php if($promocode->usage_type == 1): ?>
                                <?php if($count < $promocode->usage_limit): ?>
                                <div class="coupon bg-white rounded d-flex justify-content-between">
                                    <div class="left-side py-3 d-flex w-100 justify-content-start">
                                        <div>
                                            <h6><?php echo e($promocode->offer_name); ?></h6>
                                            <p class="dark_color mb-0 fw-600 fs-7 dark_color">
                                                <?php echo e(trans('labels.promocode')); ?> :
                                                <span class="fw-normal text-decoration-underline text-uppercase text-primary"><?php echo e($promocode->offer_code); ?></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="<?php echo e(session()->get('direction') == '2' ? 'left-side-rtl' : 'right-side'); ?>">
                                        <div class="info m-3 d-flex align-items-center">
                                            <span class="<?php echo e(session()->get('direction') == '2' ? 'coupn-circle-up-rtl' : 'coupn-circle-up'); ?>"></span>
                                            <span class="<?php echo e(session()->get('direction') == '2' ? 'coupn-circle-down-rtl' : 'coupn-circle-down'); ?>"></span>
                                            <div class="w-100 d-flex flex-column align-items-center">
                                                <div class="block">
                                                    <span class="time">
                                                        <span><?php echo e($promocode->offer_type == 1 ? Helper::currency_format($promocode->offer_amount) : $promocode->offer_amount . '%'); ?>

                                                        </span>
                                                    </span>
                                                </div>
                                                <button class="btn px-4 btn-sm btn-outline-primary btn-block" onclick="getoffercode('<?php echo e($promocode->offer_code); ?>')" data-bs-dismiss="modal"><?php echo e(trans('labels.copy')); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="coupon bg-white rounded d-flex justify-content-between">
                                    <div class="left-side py-3 d-flex w-100 justify-content-start">
                                        <div>
                                            <h6><?php echo e($promocode->offer_name); ?></h6>
                                            <p class="dark_color mb-0 fw-600 fs-7 dark_color">
                                                <?php echo e(trans('labels.promocode')); ?> :
                                                <span class="fw-normal text-decoration-underline text-uppercase text-primary"><?php echo e($promocode->offer_code); ?></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="<?php echo e(session()->get('direction') == '2' ? 'left-side-rtl' : 'right-side'); ?>">
                                        <div class="info m-3 d-flex align-items-center">
                                            <span class="<?php echo e(session()->get('direction') == '2' ? 'coupn-circle-up-rtl' : 'coupn-circle-up'); ?>"></span>
                                            <span class="<?php echo e(session()->get('direction') == '2' ? 'coupn-circle-down-rtl' : 'coupn-circle-down'); ?>"></span>
                                            <div class="w-100 d-flex flex-column align-items-center">
                                                <div class="block">
                                                    <span class="time">
                                                        <span><?php echo e($promocode->offer_type == 1 ? Helper::currency_format($promocode->offer_amount) : $promocode->offer_amount . '%'); ?>

                                                        </span>
                                                    </span>
                                                </div>
                                                <button class="btn px-4 btn-sm btn-outline-primary btn-block" onclick="getoffercode('<?php echo e($promocode->offer_code); ?>')" data-bs-dismiss="modal"><?php echo e(trans('labels.copy')); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<!-- MODAL-PROMOCOE---END -->
<?php echo $__env->make('web.subscribeform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(url(env('ASSETSPATHURL').'web-assets/js/custom/cart.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\single-restaurant\resources\views/web/cart/cart.blade.php ENDPATH**/ ?>