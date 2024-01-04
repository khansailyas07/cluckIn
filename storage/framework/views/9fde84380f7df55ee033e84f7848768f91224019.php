<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.book_table')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.book_table')); ?></h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <li class="breadcrumb-item <?php echo e(session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active"
                            aria-current="page"><?php echo e(trans('labels.book_table')); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="book-table my-5">
        <div class="reservation-area">
            <div class="container">
                <form class="rounded-5" action="<?php echo e(URL::to('reservation/store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row mb-3 mt-4">
                        <div class="col-auto">
                            <p class="fs-2 fw-bold"><?php echo e(trans('labels.contact_details')); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group mb-3">
                            <label for="reservation_name" class="form-label"><?php echo e(trans('labels.full_name')); ?></label>
                            <input class="form-control" type="text" name="name" value="<?php echo e(old('name')); ?>"
                                id="reservation_name" placeholder="<?php echo e(trans('labels.full_name')); ?>">
                            <?php $__errorArgs = ['name'];
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
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="reservation_email" class="form-label"><?php echo e(trans('labels.email')); ?></label>
                                <input class="form-control" type="email" name="email" value="<?php echo e(old('email')); ?>"
                                    id="reservation_email" placeholder="<?php echo e(trans('labels.email')); ?>">
                                <?php $__errorArgs = ['email'];
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
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="reservation_mobile" class="form-label"><?php echo e(trans('labels.mobile')); ?></label>
                                <input class="form-control" type="tel" name="mobile" value="<?php echo e(old('mobile')); ?>"
                                    id="reservation_mobile" placeholder="<?php echo e(trans('labels.mobile')); ?>">
                                <?php $__errorArgs = ['mobile'];
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

                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="row mb-2 g-2">
                                <div class="col-md-3 mb-md-0 mb-3">
                                    <div class="form-group">
                                        <label for="reservation_date" class="form-label"><?php echo e(trans('labels.date')); ?></label>
                                        <input class="form-control" type="date" name="date" min="<?php echo date('Y-m-d'); ?>"
                                            value="<?php echo e(old('date')); ?>" id="reservation_date">
                                        <?php $__errorArgs = ['date'];
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
                                <div class="col-md-3 mb-md-0 mb-3">
                                    <div class="form-group">
                                        <label for="reservation_time" class="form-label"><?php echo e(trans('labels.time')); ?></label>
                                        <input class="form-control" type="time" name="time"
                                            value="<?php echo e(old('time')); ?>" id="reservation_time">
                                        <?php $__errorArgs = ['time'];
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
                                <div class="col-md-3 mb-md-0 mb-3">
                                    <div class="form-group">
                                        <label for="reservation_guest"
                                            class="form-label"><?php echo e(trans('labels.number_guest')); ?></label>
                                        <input class="form-control" type="text" name="guests"
                                            value="<?php echo e(old('guests')); ?>" id="reservation_guest"
                                            placeholder="<?php echo e(trans('labels.number_guest')); ?>">
                                        <?php $__errorArgs = ['guests'];
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
                                <div class="col-md-3 mb-md-0 mb-3">
                                    <div class="form-group">
                                        <label for="reservation_type"
                                            class="form-label"><?php echo e(trans('labels.reservation_type')); ?></label>
                                        <input class="form-control" type="text" name="reservation_type"
                                            value="<?php echo e(old('reservation_type')); ?>" id="reservation_type"
                                            placeholder="<?php echo e(trans('labels.reservation_type')); ?>">
                                        <?php $__errorArgs = ['reservation_type'];
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
                        <div class="col-md-12 my-3">
                            <div class="form-group">
                                <label for="special_request"
                                    class="form-label"><?php echo e(trans('labels.special_request')); ?></label>
                                <textarea class="form-control" name="special_request" id="special_request"
                                    placeholder="<?php echo e(trans('labels.special_request_o')); ?>" rows="4"><?php echo e(old('special_request')); ?></textarea>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center my-3">
                            <button type="submit" class="btn  px-md-5 py-md-3 btn-primary float-end"><?php echo e(trans('labels.submit')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php echo $__env->make('web.subscribeform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\single-restaurant\resources\views/web/reservation.blade.php ENDPATH**/ ?>