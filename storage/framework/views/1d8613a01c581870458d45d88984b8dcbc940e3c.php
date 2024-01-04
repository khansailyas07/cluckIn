<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/css/bootstrap/bootstrap-select.v1.14.0-beta2.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    <div id="privacy-policy-three" class="privacy-policy">
                        <form method="post" action="<?php echo e(URL::to('admin/item/store')); ?>" name="about" id="about" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cat_id" class="col-form-label"><?php echo e(trans('labels.category')); ?> <span class="text-danger">*</span> </label>
                                                <select name="cat_id" class="form-select" id="cat_id" data-url="<?php echo e(URL::to('admin/item/subcategories')); ?>">
                                                    <option value="" selected><?php echo e(trans('labels.select')); ?>

                                                    </option>
                                                    <?php $__currentLoopData = $getcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('cat_id') == $category->id ? 'selected' : ''); ?> data-id="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?>

                                                    </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['cat_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                <span class="emsg text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="subcat_id" class="col-form-label"><?php echo e(trans('labels.subcategory')); ?></label>
                                                <select name="subcat_id" class="form-select" id="subcat_id">
                                                    <option value="" selected><?php echo e(trans('labels.select')); ?></option>
                                                </select>
                                                <?php $__errorArgs = ['subcat_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(trans('labels.name')); ?> <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="item_name" value="<?php echo e(old('item_name')); ?>" placeholder="<?php echo e(trans('labels.name')); ?>">
                                        <?php $__errorArgs = ['item_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(trans('labels.addons')); ?></label>
                                        <select class="form-control selectpicker" name="addons_id[]" multiple data-live-search="true">
                                            <option value="" selected><?php echo e(trans('labels.select')); ?></option>
                                            <?php $__currentLoopData = $getaddons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $addons): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($addons->id); ?>" <?php echo e(!empty(old('addons_id')) && in_array($addons->id, old('addons_id')) ? 'selected' : ''); ?>>
                                                <?php echo e($addons->name); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="item_type" class="col-form-label"><?php echo e(trans('labels.item_type')); ?>

                                            <span class="text-danger">*</span> </label>
                                        <div class="col-md-12">
                                            <div class="form-check-inline">
                                                <input class="form-check-input me-0" type="radio" name="item_type" id="veg" value="1" checked <?php if(old('item_type')==1): ?> checked <?php endif; ?>>
                                                <label class="form-check-label" for="veg"> <img src="<?php echo e(Helper::image_path('veg.svg')); ?>" alt="" srcset=""> <?php echo e(trans('labels.veg')); ?></label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input me-0" type="radio" name="item_type" id="nonveg" value="2" <?php if(old('item_type')==2): ?> checked <?php endif; ?>>
                                                <label class="form-check-label" for="nonveg"> <img src="<?php echo e(Helper::image_path('nonveg.svg')); ?>" alt="" srcset=""> <?php echo e(trans('labels.nonveg')); ?></label>
                                            </div>
                                            <?php $__errorArgs = ['item_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <br><span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(trans('labels.item_has_variation')); ?> <span class="text-danger">*</span> </label>
                                        <div class="col-md-12">
                                            <div class="form-check-inline">
                                                <input class="form-check-input me-0 has_variation" type="radio" name="has_variation" id="no" value="2" checked <?php if(old('has_variation')==2): ?> checked <?php endif; ?>>
                                                <label class="form-check-label" for="no"><?php echo e(trans('labels.no')); ?></label>
                                            </div>
                                            <div class="form-check-inline">
                                                <input class="form-check-input me-0 has_variation" type="radio" name="has_variation" id="yes" value="1" <?php if(old('has_variation')==1): ?> checked <?php endif; ?>>
                                                <label class="form-check-label" for="yes"><?php echo e(trans('labels.yes')); ?></label>
                                            </div>
                                            <?php $__errorArgs = ['has_variation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <br><span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row dn <?php if($errors->has('variants_name.*') || $errors->has('variants_price.*')): ?> dn <?php endif; ?> <?php if(old('variants') == 2): ?> d-flex <?php endif; ?>" id="price_row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="price" class="col-form-label"><?php echo e(trans('labels.product_price')); ?> <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control numbers_only" name="price" id="price" value="<?php echo e(old('price')); ?>" placeholder="<?php echo e(trans('labels.product_price')); ?>">
                                        <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row panel-body dn <?php if($errors->has('variation.*') || $errors->has('product_price.*') || old('has_variation') == 1): ?> d-flex <?php endif; ?>" id="variations">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(trans('labels.attribute')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control attribute" name="attribute" value="<?php echo e(old('attribute')); ?>" placeholder="<?php echo e(trans('messages.enter_attribute')); ?>">
                                        <?php $__errorArgs = ['attribute'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(trans('labels.variation')); ?><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control variation" name="variation[]" placeholder="<?php echo e(trans('labels.variation')); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(trans('labels.product_price')); ?><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control numbers_only product_price" name="product_price[]" placeholder="<?php echo e(trans('labels.product_price')); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4 d-none">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(trans('labels.sale_price')); ?><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control numbers_only sale_price" name="sale_price[]" placeholder="<?php echo e(trans('labels.sale_price')); ?>" value="0">
                                    </div>
                                </div>
                                <div class="col-sm-1 d-flex align-items-end">
                                    <div class="form-group">
                                        <button class="btn btn-info" type="button" onclick="variation_fields('<?php echo e(trans('labels.variation')); ?>','<?php echo e(trans('labels.product_price')); ?>','<?php echo e(trans('labels.sale_price')); ?>');">
                                            <i class="fa-sharp fa-solid fa-plus"></i> </button>
                                    </div>
                                </div>
                            </div>
                            <div id="more_variation_fields"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label"><?php echo e(trans('labels.image')); ?> (512 x 512) <span class="text-danger">*</span> </label>
                                        <input type="file" class="form-control" name="image[]" id="image" accept="image/*" multiple>
                                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="gallery"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo e(trans('labels.preparation_time')); ?>

                                                    <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="preparation_time" placeholder="<?php echo e(trans('labels.preparation_time')); ?>" value="<?php echo e(old('preparation_time')); ?>">
                                                <?php $__errorArgs = ['preparation_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tax" class="col-form-label"><?php echo e(trans('labels.tax')); ?> (%)</label>
                                                <input type="text" class="form-control" name="tax" id="tax" value="0" placeholder="<?php echo e(trans('labels.tax')); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="col-form-label"><?php echo e(trans('labels.description')); ?></label>
                                        <textarea class="form-control" rows="5" name="description" id="description" placeholder="<?php echo e(trans('labels.description')); ?>"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-end">
                                <a href="<?php echo e(URL::to('admin/item')); ?>" class="btn btn-outline-danger"><?php echo e(trans('labels.cancel')); ?></a>
                                <button class="btn btn-primary" <?php if(env('Environment')=='sendbox' ): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/js/bootstrap/bootstrap-select.v1.14.0-beta2.min.js')); ?>">
</script>
<script src="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/js/custom/additem.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.theme.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\single-restaurant\resources\views/admin/item/additem.blade.php ENDPATH**/ ?>