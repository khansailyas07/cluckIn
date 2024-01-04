<?php $__env->startSection('content'); ?>
    <?php
        if (request()->is('admin/bannersection-2*')) {
            $table_url = URL::to('admin/bannersection-2');
            $section = 2;
            $title = trans('labels.section-2');
            $img_size = '(1920 x 400)';
        } elseif (request()->is('admin/bannersection-3*')) {
            $table_url = URL::to('admin/bannersection-3');
            $section = 3;
            $title = trans('labels.section-3');
            $img_size = '(500 x 500)';
        } elseif (request()->is('admin/bannersection-4*')) {
            $table_url = URL::to('admin/bannersection-4');
            $section = 4;
            $title = trans('labels.section-4');
            $img_size = '(1920 x 400)';
        } else {
            $table_url = URL::to('admin/bannersection-1');
            $section = 1;
            $title = trans('labels.section-1');
            $img_size = '(400 x 240)';
        }
    ?>
    <?php echo $__env->make('admin.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="form-validation">
                            <form action="<?php echo e(URL::to('admin/banner/store')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="section" value="<?php echo e($section); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for=""><?php echo e(trans('labels.image')); ?>

                                                <?php echo e($img_size); ?> <span class="text-danger">*</span> </label>
                                            <input type="file" class="form-control" name="image" accept="image/*">
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
                                        <div class="form-group">
                                            <label class="col-form-label" for="type"><?php echo e(trans('labels.type')); ?></label>
                                            <select name="type" class="form-select type" data-live-search="true"
                                                id="type">
                                                <option value="" selected><?php echo e(trans('labels.select')); ?></option>
                                                <option value="1" <?php echo e(old('type') == 1 ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.category')); ?></option>
                                                <option value="2" <?php echo e(old('type') == 2 ? 'selected' : ''); ?>>
                                                    <?php echo e(trans('labels.item')); ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group 1 gravity <?php if(old('type') == 1): ?> <?php else: ?> dn <?php endif; ?>">
                                            <label class="col-form-label" for=""><?php echo e(trans('labels.category')); ?> <span class="text-danger">*</span> </label>
                                            <select name="cat_id" class="form-select selectpicker" data-live-search="true"
                                                id="cat_id">
                                                <option value="" selected><?php echo e(trans('labels.select')); ?></option>
                                                <?php $__currentLoopData = $getcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>"
                                                        <?php echo e(old('cat_id') == $category->id ? 'selected' : ''); ?>>
                                                        <?php echo e($category->category_name); ?>

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
                                        </div>
                                        <div class="form-group 2 gravity <?php if(old('type') == 2): ?> <?php else: ?> dn <?php endif; ?>">
                                            <label class="col-form-label" for=""><?php echo e(trans('labels.item')); ?> <span class="text-danger">*</span> </label>
                                            <select name="item_id" class="form-select selectpicker" data-live-search="true"
                                                id="item_id">
                                                <option value="" selected><?php echo e(trans('labels.select')); ?></option>
                                                <?php $__currentLoopData = $getitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->item_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['item_id'];
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
                                <div class="form-group text-end">
                                    <a class="btn btn-outline-danger"
                                        href="<?php echo e($table_url); ?>"><?php echo e(trans('labels.cancel')); ?></a>
                                    <button class="btn btn-primary"
                                        <?php if(env('Environment') == 'sendbox'): ?> type="button" onclick="myFunction()" <?php else: ?> type="submit" <?php endif; ?>><?php echo e(trans('labels.save')); ?></button>
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
    <script src="<?php echo e(url(env('ASSETSPATHURL').'admin-assets/assets/js/custom/banner.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.theme.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\single-restaurant\resources\views/admin/banner/add.blade.php ENDPATH**/ ?>