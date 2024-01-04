<div class="paymenterror alert alert-danger my-2 py-1 d-none"> <?php echo e(trans('messages.payment_selection_required')); ?></div>
<div class="row justify-content-between">
    <?php $__currentLoopData = $getpaymentmethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pmdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $transaction_type = $pmdata->id;
            $paymentname = $pmdata->payment_name;
        ?>
        <label class="form-check-label col-md-6" for="payment<?php echo e($transaction_type); ?>">
            <input class="form-check-input" type="radio" name="transaction_type"
                id="payment<?php echo e($transaction_type); ?>"
                data-payment-type="<?php echo e($transaction_type); ?>"
                value="<?php echo e($transaction_type); ?>" data-currency="<?php echo e($pmdata->currency); ?>" <?php echo e($key == 0 ? 'checked' : ''); ?>>
            <div class="payment-gateway mt-2 mb-0 justify-content-between">
                <span> <img src="<?php echo e(Helper::image_path($pmdata->image)); ?>" alt=""> <?php echo e(ucfirst($paymentname)); ?> </span>
               
                <?php if($transaction_type == 2): ?>  
                <span class="text-end text-muted"><?php echo e(Helper::currency_format(Auth::user()->wallet)); ?></span>
                <?php endif; ?>
                <?php if(in_array($transaction_type, [3, 4, 5, 6])): ?>
                    <?php if($transaction_type == 3): ?>
                        <input type="hidden" name="razorpaykey" id="razorpaykey" value="<?php echo e($pmdata->public_key); ?>">
                    <?php endif; ?>
                    <?php if($transaction_type == 4): ?>
                        <input type="hidden" name="stripekey" id="stripekey" value="<?php echo e($pmdata->public_key); ?>">
                    <?php endif; ?>
                    <?php if($transaction_type == 5): ?>
                        <input type="hidden" name="flutterwavekey" id="flutterwavekey" value="<?php echo e($pmdata->public_key); ?>">
                    <?php endif; ?>
                    <?php if($transaction_type == 6): ?>
                        <input type="hidden" name="paystackkey" id="paystackkey" value="<?php echo e($pmdata->public_key); ?>">
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php if($transaction_type == 2): ?>
                <small
                    class="walleterror text-danger d-none"><?php echo e(trans('messages.insufficient_wallet')); ?></small>
            <?php endif; ?>
          
        </label>
        <?php if($transaction_type == 4): ?>
            <form action="" method="" id="payment-form" class="d-none">
                <div class="my-3" id="card-element"></div>
            </form>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if(!in_array(4, array_column($getpaymentmethods->toArray(),'id'))): ?>
        <input type="hidden" name="stripekey" id="stripekey" value="">
    <?php endif; ?>
</div><?php /**PATH C:\wamp64\www\single-restaurant\resources\views/web/paymentmethodsview.blade.php ENDPATH**/ ?>