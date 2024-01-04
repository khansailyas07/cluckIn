<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.checkout')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.checkout')); ?></h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="<?php echo e(URL::to('/')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <li class="breadcrumb-item <?php echo e(session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active"
                            aria-current="page"><?php echo e(trans('labels.checkout')); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <?php if(count($getcartlist) > 0): ?>
        <?php
            $totaltax = 0;
            $totaltaxamount = 0;
            $order_total = 0;
            $total_item_qty = 0;
        ?>
        <?php $__currentLoopData = $getcartlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $tax = ($item['item_price'] * $item['qty'] * $item['tax']) / 100;
                $total_price = ($item['item_price'] + $item['addons_total_price']) * $item['qty'];
                $totaltaxamount += (float) $tax;
                $order_total += (float) $total_price;
                $total_item_qty += $item['qty'];
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <section>
            <div class="container">
                
                <div class="cart-view my-5">
                    <div class="row">
                        
                        <div class="col-lg-8 order-md2">
                            <?php if(session()->get('order_type') == 1): ?>
                                    <?php if(Auth::user() && Auth::user()->type == 2): ?>
                                    <input type="hidden" id="authcheck" name="authcheck" value="1"/>

                                        <div class="checkout-view p-4 mb-3">
                                            <div class="heading mb-2">
                                                <h2><?php echo e(trans('labels.select_address')); ?></h2>
                                            </div>
                                            <div class="addresserror alert alert-danger my-2 py-1 d-none">
                                                <?php echo e(trans('messages.select_address')); ?></div>
                                            <div class="row address-list">
                                                <?php $__currentLoopData = $getaddresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $addressdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="col-md-6 d-flex">
                                                        <input type="radio" name="myaddress" class="d-none"
                                                            value="<?php echo e($addressdata->id); ?>" id="rad<?php echo e($addressdata->id); ?>"
                                                            data-address-type="<?php echo e($addressdata->address_type); ?>"
                                                            address="<?php echo e($addressdata->address); ?>"
                                                            house_no="<?php echo e($addressdata->house_no); ?>"
                                                            area="<?php echo e($addressdata->area); ?>" lat="<?php echo e($addressdata->lat); ?>"
                                                            lang="<?php echo e($addressdata->lang); ?>" data-url="<?php echo e(URL::to('/checkdeliveryzone')); ?>" <?php echo e($key == 0 ? 'checked' : ''); ?>>
                                                        <div class="address-card w-100">
                                                            <div class="col-2 address-icon">
                                                                <?php if($addressdata->address_type == 1): ?>
                                                                    <i class="fa-solid fa-house-chimney"></i>
                                                                    <?php $address_type_text = trans('labels.home'); ?>
                                                                <?php elseif($addressdata->address_type == 2): ?>
                                                                    <i class="fa-solid fa-briefcase"></i>
                                                                    <?php $address_type_text = trans('labels.office'); ?>
                                                                <?php else: ?>
                                                                    <i class="fa-solid fa-map-location-dot"></i>
                                                                    <?php $address_type_text = trans('labels.other'); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-10 address pe-3">
                                                                <h4><?php echo e($address_type_text); ?></h4>
                                                                <p><?php echo e($addressdata->address); ?>, <?php echo e($addressdata->area); ?>, <?php echo e($addressdata->house_no); ?></p>
                                                                <label class="btn fs-8 btn-sm btn-success border-0 text-uppercase" for="rad<?php echo e($addressdata->id); ?>"><?php echo e(trans('labels.deliver_here')); ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-md-6">
                                                    <div
                                                        class="address-card border-dashed d-flex justify-content-center align-items-center text-center w-100">
                                                        <div class="address">
                                                            <h4><?php echo e(trans('labels.add_new_address')); ?></h4>
                                                            <a class="btn btn-outline-success text-uppercase btn-sm"
                                                                href="<?php echo e(URL::to('/address/add')); ?>"><?php echo e(trans('labels.add_new')); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                            <?php endif; ?>

                            <?php if(!Auth::user()): ?>
                            <input type="hidden" name="authcheck" id="authcheck" value="0"/>
                                    
                                        
                                    <div class="checkout-view p-4 mb-3">
                                    <?php if(session()->get('order_type') == 2): ?>
                                    
                                    
                                    <form id="address_form" method="POST">
                                        <div class="form-group mb-3">
                                            <label class="form-label mb-0"><?php echo e(trans('labels.full_name')); ?></label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="<?php echo e(trans('labels.full_name')); ?>" >
                                             <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger"><?php echo e($message); ?></small>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="col-12 row">
                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label mb-0"><?php echo e(trans('labels.email')); ?></label>
                                            <input type="text" class="form-control" name="email" id="email"
                                                placeholder="<?php echo e(trans('labels.email')); ?>">
                                             <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger"><?php echo e($message); ?></small>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label mb-0"><?php echo e(trans('labels.mobile')); ?></label>
                                            <input type="text" class="form-control" name="mobile" id="mobile"
                                                placeholder="<?php echo e(trans('labels.mobile')); ?>" >
                                               
                                             <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small class="text-danger"><?php echo e($message); ?></small>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    </form>

                                    </div>
                     
                                <?php else: ?>

                                    <div class="heading mb-2"> 
                                        <h2>
                                            <?php echo e(trans('labels.select_address')); ?>

                                        </h2> 
                                    </div>
                                    <div class="row address-list">
                                    <?php if(session()->has('addressdata')): ?>
                                      <?php $addressdata = session()->get('addressdata');
                                    ?>
                                        <div class="col-md-6 d-flex">
                                            <div class="address-card w-100">
                                                <div class="col-2 address-icon">
                                                        <i class="fa-solid fa-house-chimney"></i>      
                                                </div>
                                                <div class="col-10 address pe-3">
                                                    <input type="hidden" name="address" id="address" value="<?php echo e($addressdata['address']); ?>">
                                                    <input type="hidden" name="area" id="area" value="<?php echo e($addressdata['area']); ?>">
                                                    <input type="hidden" name="lat" id="lat" value="<?php echo e($addressdata['lat']); ?>">
                                                    <input type="hidden" name="lang" id="lang" value="<?php echo e($addressdata['lang']); ?>">
                                                    <input type="hidden" name="house_no" id="house_no" value="<?php echo e($addressdata['house_no']); ?>">
                                                    <h4><?php echo e($addressdata['name']); ?></h4>
                                                    <p><?php echo e($addressdata['house_no']); ?> , <?php echo e($addressdata['address']); ?> </p>
                                                    <a class="btn btn-sm btn-success border-0 text-uppercase" href="<?php echo e(URL::to('/address-1')); ?>"><?php echo e(trans('labels.change')); ?></a>
                                                    <a class="btn btn-sm btn-danger border-0 text-uppercase" href="javascript:void(0)" onclick="deleteaddress('1','<?php echo e(URL::to('/address/delete')); ?> ') "><?php echo e(trans('labels.remove')); ?></a>
                                                </div>
                                            </div> 
                                        </div> 
                                    <?php else: ?>
                                    <div class="col-md-6">
                                        <div class="address-card border-dashed d-flex justify-content-center align-items-center text-center w-100">
                                            <div class="address">
                                                <h4><?php echo e(trans('labels.add_new_address')); ?></h4>
                                                <input type="hidden" name="addressdata" id="addressdata" value="0"/>
                                                <a class="btn btn-outline-success text-uppercase btn-sm" href="<?php echo e(URL::to('/address/add')); ?>"><?php echo e(trans('labels.add_new')); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                   
                                    </div>
                                    
                                </div>
                                <?php endif; ?>
                             <?php endif; ?>
                          
                            <div class="payment-option mb-3">
                                <div class="heading mb-2">
                                    <h2><?php echo e(trans('labels.choose_payment')); ?></h2>
                                </div>
                                
                                <?php echo $__env->make('web.paymentmethodsview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <div class="d-flex justify-content-center my-4">
                                    <button class="btn btn-primary text-uppercase px-4 py-2"
                                        onclick="isopenclose('<?php echo e(URL::to('/isopenclose')); ?>','<?php echo e($total_item_qty); ?>','<?php echo e($order_total); ?>')"><?php echo e(trans('labels.proceed_pay')); ?></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 order-md1">
                            
                            <div class="summary py-3 mb-4">
                                <h2 class="border-bottom"><?php echo e(trans('labels.payment_summary')); ?></h2>
                                <div class="bill-details border-bottom">
                                    <?php
                                        if (session()->has('discount_data')) {
                                            $discount_amount = session()->get('discount_data')['offer_amount'];
                                        } else {
                                            $discount_amount = 0;
                                        }
                                        if (session()->has('addressdata'))
                                        {
                                            $grand_total = $order_total - $discount_amount + $totaltaxamount + $addressdata['delivery_charge'];
                                        }
                                        else
                                        {
                                            $grand_total = $order_total - $discount_amount + $totaltaxamount;
                                        }
                                       
                                    ?>
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span><?php echo e(trans('labels.subtotal')); ?></span></div>
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
                                    <?php if(session()->get('order_type') == 1): ?>
                                        <?php $delivery_charge = 0; ?>
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto"><span><?php echo e(trans('labels.delivery_charge')); ?></span>
                                            </div>
                                            <div class="col-auto">
                                                <p class="delivery_charge">
                                                    <?php if(session()->has('addressdata')): ?>
                                                     <?php echo e(Helper::currency_format($addressdata['delivery_charge'])); ?>

                                                    <?php else: ?>
                                                    <?php echo e(Helper::currency_format($delivery_charge)); ?>

                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php $delivery_charge = 0; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="bill-total mt-2">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span><?php echo e(trans('labels.grand_total')); ?></span></div>
                                        <div class="col-auto"><span class="grand_total"><?php echo e(Helper::currency_format($grand_total)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="special-instruction py-3 mb-3">
                                <label class="form-label mb-2"
                                    for="order_notes"><?php echo e(trans('labels.special_instruction')); ?></label>
                                <textarea class="form-control" name="order_notes" id="order_notes" rows="3"
                                    placeholder="<?php echo e(trans('labels.special_instruction')); ?>"></textarea>
                            </div>
                            <a href="<?php echo e(URL::to('/')); ?>" class="continue-shopping mb-3 text-primary text-uppercase"><i class="fa-solid fa-circle-arrow-left me-2"></i><?php echo e(trans('labels.continue_shopping')); ?></a>
                        </div>
                    </div>
                    
                    <input type="hidden" name="order_type" id="order_type" value="<?php echo e(session()->get('order_type')); ?>">
                    
                    <input type="hidden" name="grand_total" id="grand_total" value="<?php echo e($grand_total); ?>">
                    
                    <input type="hidden" name="sub_total" id="sub_total" value="<?php echo e($order_total); ?>">
                    
                    <input type="hidden" name="totaltaxamount" id="totaltaxamount" value="<?php echo e($totaltaxamount); ?>">
                    
                    
                    
                    <input type="hidden" name="delivery_charge" id="delivery_charge" value="<?php if(session()->has('addressdata')): ?> <?php echo e($addressdata['delivery_charge']); ?><?php else: ?><?php echo e($delivery_charge); ?><?php endif; ?>">
                    <input type="hidden" name="user_name" id="user_name" value="<?php if(session()->has('addressdata')): ?><?php echo e($addressdata['name']); ?> <?php else: ?> <?php echo e(@Auth::user()->name); ?> <?php endif; ?>">
                    <input type="hidden" name="user_email" id="user_email" value="<?php if(session()->has('addressdata')): ?><?php echo e($addressdata['email']); ?> <?php else: ?>  <?php echo e(@Auth::user()->email); ?>  <?php endif; ?>">
                    <input type="hidden" name="user_mobile" id="user_mobile" value="<?php if(session()->has('addressdata')): ?><?php echo e($addressdata['mobile']); ?><?php else: ?> <?php echo e(@Auth::user()->mobile); ?> <?php endif; ?>">

                    
                    <input type="hidden" name="rest_lat" id="rest_lat" value="<?php echo e(@Helper::appdata()->lat); ?>">
                    <input type="hidden" name="rest_lang" id="rest_lang" value="<?php echo e(@Helper::appdata()->lang); ?>">
                    <input type="hidden" name="delivery_charge_per_km" id="delivery_charge_per_km" value="<?php echo e(@Helper::appdata()->delivery_charge); ?>">
                    <input type="hidden" name="orderurl" id="orderurl" value="<?php echo e(URL::to('placeorder')); ?>">
        
                    <input type="hidden" name="successurl" id="successurl" value="<?php echo e(URL::to('/orders')); ?>">
                    <input type="hidden" name="continueurl" id="continueurl" value="<?php echo e(URL::to('/')); ?>">
                    <input type="hidden" name="environment" id="environment" value="<?php echo e(env('Environment')); ?>">

                    <input type="hidden" name="paymentsuccess" id="paymentsuccess" value="<?php echo e(URL::to('paymentsuccess')); ?>">
                    <input type="hidden" name="paymentfail" id="paymentfail" value="<?php echo e(URL::to('paymentfail')); ?>">

                    <input type="hidden" name="myfatoorahurl" id="myfatoorahurl" value="<?php echo e(URL::to('myfatoorah')); ?>">
                    <input type="hidden" name="mercadopagourl" id="mercadopagourl" value="<?php echo e(URL::to('mercadorequest')); ?>">
                    <input type="hidden" name="paypalurl" id="paypalurl" value="<?php echo e(URL::to('paypal')); ?>">
                    <input type="hidden" name="toyyibpayurl" id="toyyibpayurl" value="<?php echo e(URL::to('toyyibpay')); ?>">


                    <form action="<?php echo e(URL::to('paypal')); ?>" method="post" class="d-none">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="return" value="2">
                        <input type="submit" class="callpaypal" name="submit">
                    </form>
                    

                </div>
              
            </div>
        </section>
        <?php echo $__env->make('web.subscribeform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('web.nodata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://checkout.stripe.com/v2/checkout.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="<?php echo e(url(env('ASSETSPATHURL').'web-assets/js/custom/checkout.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<script type="text/javascript">

toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        <?php if(Session::has('success')): ?>
            toastr.success("<?php echo e(session('success')); ?>");
        <?php endif; ?>
        <?php if(Session::has('error')): ?>
            toastr.error("<?php echo e(session('error')); ?>");
        <?php endif; ?>


        function deleteaddress(id,deleteurl) {
    "use strict";
    swalWithBootstrapButtons.fire({
        icon: 'warning',
        title: are_you_sure,
        showCancelButton: true,
        confirmButtonText: yes,
        cancelButtonText: no,
        reverseButtons: true,
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: deleteurl,
                    data: { id: id },
                    method: 'POST',
                    success: function (response) {
                        if (response == 1) {
                            location.reload();
                        } else {
                            swal_cancelled()
                        }
                    },
                    error: function (e) {
                        swal_cancelled()
                    }
                });
            });
        },
    }).then((result) => {
        if (!result.isConfirmed) {
            result.dismiss === Swal.DismissReason.cancel
        }
    })
}

   

</script>
<script
        src="https://maps.googleapis.com/maps/api/js?libraries=places&<?php echo e(@Helper::appdata()->map != 'map_key' ? 'key=' . @Helper::appdata()->map : ''); ?>">
    </script>
    <script>
        var geocoder;
        var map;
        var marker;
        var infowindow = new google.maps.InfoWindow({
            size: new google.maps.Size(150, 50)
        });
        function initialize() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((showPosition) => {
                    geocoder = new google.maps.Geocoder();
                    create_map(showPosition.coords.latitude, showPosition.coords.longitude)
                    // to-change-marker-on-typing-address --> START
                    var input = document.getElementById('address');
                    var autocomplete = new google.maps.places.Autocomplete(input);
                    google.maps.event.addListener(autocomplete, 'place_changed', function() {
                        var place = autocomplete.getPlace();
                        $('#lat').val(place.geometry.location.lat());
                        $('#lang').val(place.geometry.location.lng());
                        create_map(place.geometry.location.lat(), place.geometry.location.lng());
                    });
                    // to-change-marker-on-typing-address --> END
                }, (showError) => {
                    $('#mymap').hide();
                    $('#address').hide();
                });
            } else {
                $('.err').html("Geolocation is not supported by this browser.");
            }
        }
        function create_map(lat, lang) {
            var latlng = new google.maps.LatLng(lat, lang);
            var default_address = $('#address').val();
            var mapOptions = {
                zoom: 15,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById('mymap'), mapOptions);
            google.maps.event.addListener(map, 'click', function() {
                infowindow.close();
            });
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: latlng
            });
            if ("<?php echo e(env('Environment')); ?>" != "sendbox") {
                google.maps.event.addListener(marker, 'dragend', function() {
                    $('#lat').val(this.getPosition().lat());
                    $('#lang').val(this.getPosition().lng());
                    geocodePosition(marker.getPosition());
                });
                google.maps.event.addListener(map, 'dragend', function() {
                    $('#lat').val(this.getCenter().lat());
                    $('#lang').val(this.getCenter().lng());
                    marker.setPosition(this.getCenter());
                    geocodePosition(this.getCenter());
                });
                google.maps.event.addListener(marker, 'click', function() {
                    marker.setPosition(this.getPosition());
                    geocodePosition(this.getPosition());
                    $('#lat').val(this.getPosition().lat());
                    $('#lang').val(this.getPosition().lng());
                });
                google.maps.event.trigger(marker, 'click');
            }
        }
        function geocodePosition(pos) {
            geocoder.geocode({
                latLng: pos
            }, function(responses) {
                if (responses && responses.length > 0) {
                    marker.formatted_address = responses[0].formatted_address;
                    $('#address').val(marker.formatted_address);
                } else {
                    marker.formatted_address = 'Cannot determine address at this location.';
                }
                default_address = marker.formatted_address
                infowindow.setContent(marker.formatted_address + "<br>coordinates: " + marker.getPosition()
                    .toUrlValue(6));
                infowindow.open(map, marker);
            });
        }
        google.maps.event.addDomListener(window, "load", initialize);
    </script>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\single-restaurant\resources\views/web/checkout/checkout.blade.php ENDPATH**/ ?>