 <!-- newsletter section start Here -->
<section class="theme-2-newsletter my-5">
    <div class="container">
        <div class="">
            <form action="<?php echo e(route('subscribe')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row align-items-center text-center justify-content-center p-md-5 p-0">
                    <div class="col-auto newsletter-heading">
                        <h1 class="text-uppercase my-3"><?php echo e(trans('labels.newsletter')); ?></h1>
                        <p class="sub-lables text-capitalize my-3"><?php echo e(trans('labels.subscribe_title')); ?></p>
                        <p><?php echo e(trans('labels.subscribe_description')); ?></p>
                        <div class="form-floating d-flex pb-4">
                            <input type="email" name="email" class="w-100 p-3 rounded-2  border-0" placeholder="<?php echo e(trans('labels.email')); ?>">
                            <!-- <label for="floatingInput">Enter your email</label> -->
                            <button type="submit" class="btn btn-primary px-md-5 px-2 mx-2 fs-md-6 fs-7 text-uppercase"><?php echo e(trans('labels.subscribe')); ?></button>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- newsletter section end Here --><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/single-restaurant/resources/views/web/subscribeform.blade.php ENDPATH**/ ?>