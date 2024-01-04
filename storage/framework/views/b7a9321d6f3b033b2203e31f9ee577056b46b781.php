<div class="col-xl-3 col-lg-4 col-sm-6 col-xs-auto mb-3">
    <div class="card rounded">
        <a href="<?php echo e(URL::to('item-' . $itemdata->slug)); ?>">
            <div class="card-image">
                <img src="<?php if(@$itemdata['item_image']->image_url != null): ?> <?php echo e(@$itemdata['item_image']->image_url); ?> <?php else: ?> <?php echo e(@Helper::image_path('item_default.png')); ?> <?php endif; ?>"
                    class="card-img-top border-0 rounded-0 rounded-top position-relative" alt="dishes">
            </div>
            <div class="card-body pb-0">
                <div class="cat-name py-1 mb-2 col-lg-3 col-sm-4 col-3 text-center"><span><?php echo e($itemdata['category_info']->category_name); ?></span></div>
                <h5 class="item-card-title pb-3 fs-6 border-bottom">
                    <?php if($itemdata->item_type == 1): ?>
                        <img src="<?php echo e(Helper::image_path('veg.svg')); ?>" alt="" class=" <?php echo e(session()->get('direction') == "rtl" ? 'ms-1' : 'me-1'); ?>">
                    <?php else: ?>
                        <img src="<?php echo e(Helper::image_path('nonveg.svg')); ?>" alt="" class="<?php echo e(session()->get('direction') == "rtl" ? 'ms-1' : 'me-1'); ?>">
                    <?php endif; ?>
                    <?php echo e($itemdata->item_name); ?>

                </h5>
            </div>
        </a>
        <div class="img-overlay set-fav-<?php echo e($itemdata->id); ?>">
            <?php if(Auth::user() && Auth::user()->type == 2): ?>

                <?php if($itemdata->is_favorite == 1): ?>
                    <a class="heart-icon p-2 btn btn-wishlist"
                         href="javascript:void(0)" onclick="managefavorite('<?php echo e($itemdata->id); ?>',0,'<?php echo e(URL::to('/managefavorite')); ?>','<?php echo e(request()->url()); ?>')" title="<?php echo e(trans('labels.remove_wishlist')); ?>">
                        <i class="fa-solid fa-heart fs-5"></i> </a>
                <?php else: ?>
                    <a class="heart-icon p-2 btn btn-wishlist"
                        href="javascript:void(0)" onclick="managefavorite('<?php echo e($itemdata->id); ?>',1,'<?php echo e(URL::to('/managefavorite')); ?>','<?php echo e(request()->url()); ?>')" title="<?php echo e(trans('labels.add_wishlist')); ?>">
                        <i class="fa-regular fa-heart fs-5"></i> </a>
                <?php endif; ?>
            <?php endif; ?>    
        </div>
        <div class="item-card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <?php
             
                    if ($itemdata->has_variation == 1) {
                        
                        foreach ($itemdata['variation'] as $key => $value) {
                         
                            $price = $value->product_price;
                            if ($key == 0) {
                                break;
                            }
                        }
                    } else {
                        $price = $itemdata->item_price;
                    }

                    $image = (@$itemdata['item_image']->image_name != null) ? @$itemdata['item_image']->image_name : 'item_default.png';

                

                ?>
                <span class="green_color"><?php echo e(Helper::currency_format($price)); ?></span>
                <?php if($itemdata->is_cart == 1): ?>
                        <div class="item-quantity py-1 px-5">
                            <button type="button" class="btn btn-sm  fw-500" onclick="removefromcart('<?php echo e(URL::to('/cart')); ?>','<?php echo e(trans('messages.remove_cartitem_note')); ?>','<?php echo e(trans('labels.goto_cart')); ?>')">-</button>
                            <input class="fw-500 item-total-qty-<?php echo e($itemdata->slug); ?>" type="text" value="<?php echo e(Helper::get_item_cart($itemdata->id)); ?>" disabled/>
                            <?php if($itemdata->addons_id != '' || count($itemdata->variation) > 0): ?>
                                <a class="btn btn-sm fw-500" onclick="showitem('<?php echo e($itemdata->slug); ?>','<?php echo e(URL::to('/show-item')); ?>')">+</a>
                            <?php else: ?>
                                <a class="btn btn-sm fw-500" onclick="calladdtocart('<?php echo e($itemdata->slug); ?>','<?php echo e($itemdata->item_name); ?>','<?php echo e($itemdata->item_type); ?>','<?php echo e($image); ?>','<?php echo e($itemdata->tax); ?>','<?php echo e($itemdata->price); ?>','','','','','','<?php echo e(URL::to('addtocart')); ?>')">+</a>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <?php if($itemdata->addons_id != '' || count($itemdata->variation) > 0): ?>
                        <a class="btn btn-sm btn-dark fw-500 py-2 px-4 float-end"
                            onclick="showitem('<?php echo e($itemdata->slug); ?>','<?php echo e(URL::to('/show-item')); ?>')"><?php echo e(trans('labels.add')); ?> <i class="fa-solid fa-plus"></i></a>
                        <?php else: ?>
                            <a class="btn btn-sm btn-dark fw-500 py-2 px-4 float-end"
                                onclick="calladdtocart('<?php echo e($itemdata->slug); ?>','<?php echo e($itemdata->item_name); ?>','<?php echo e($itemdata->item_type); ?>','<?php echo e($image); ?>','<?php echo e($itemdata->tax); ?>','<?php echo e($itemdata->price); ?>','','','','','','<?php echo e(URL::to('addtocart')); ?>')"><?php echo e(trans('labels.add')); ?> <i class="fa-solid fa-plus"></i> </a>
                        <?php endif; ?>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\single-restaurant\resources\views/web/home1/itemview.blade.php ENDPATH**/ ?>