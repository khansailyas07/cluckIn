<?php $__env->startSection('page_title'); ?>
    | <?php echo e(trans('labels.add_address')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1><?php echo e(trans('labels.add_address')); ?></h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item <?php echo e(session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : ''); ?>">
                            <a class="text-muted" href="<?php echo e(route('home')); ?>"><?php echo e(trans('labels.home')); ?></a>
                        </li>
                        <li class="breadcrumb-item <?php echo e(session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : ''); ?> active"
                            aria-current="page"><?php echo e(trans('labels.my_addresses')); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="container my-5">
            <div class="row">
                
                <?php if(!Auth::user()): ?>
                <div class="col-lg-12">
                <?php else: ?>
                <div class="col-lg-3 d-flex">
                    <?php echo $__env->make('web.layout.usersidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-lg-9">
                    
                <?php endif; ?> 
                    <div class="user-content-wrapper">
                        <div class="mb-3">
                            <p class="title mb-0"><?php echo e(trans('labels.add_address')); ?></p>
                            <button onclick="getLocation()" class="btn btn-sm btn-primary" style="display: none;" id="permissions">Please allow to access the location to get better experience</button>
                            <p id="demo"></p>
                            <p class="text-danger err"></p>
                        </div>
                        <input type="textbox" class="form-control" id="address"
                            <?php if(env('Environment') == 'sendbox'): ?> value="510 Bartoletti Land , Norwoodport , West Virginia" readonly <?php else: ?> value="" <?php endif; ?>>
                        <div class="address-map mb-3" id="mymap"></div>
                        <form action="<?php echo e(URL::to('/address/store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" placeholder="<?php echo e(trans('labels.latitude')); ?>" class="form-control"
                                name="lat"
                                <?php if(env('Environment') == 'sendbox'): ?> value="-39.845680" <?php else: ?> value="<?php echo e(old('lat')); ?>" <?php endif; ?>
                                id="lat" readonly>
                            <input type="hidden" placeholder="<?php echo e(trans('labels.longitude')); ?>" class="form-control"
                                name="lang"
                                <?php if(env('Environment') == 'sendbox'): ?> value="-73.228240" <?php else: ?> value="<?php echo e(old('lang')); ?>" <?php endif; ?>
                                id="lang" readonly>
                            <?php $__errorArgs = ['lat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small> <br>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <?php $__errorArgs = ['lang'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <small class="text-danger"><?php echo e($message); ?></small> <br>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="row">

                                <?php if(!Auth::user()): ?>
                                <div class="col-12 row">
                                    <div class="col-lg-4 col-sm-12 form-group mb-3">
                                        <label class="form-label mb-0"><?php echo e(trans('labels.full_name')); ?></label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="<?php echo e(trans('labels.full_name')); ?>"
                                            <?php if(env('Environment') == 'sendbox'): ?> value="510" readonly <?php else: ?> value="<?php echo e(old('name')); ?>" <?php endif; ?>>
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
                                    <div class="col-lg-4 col-sm-12 form-group mb-3">
                                        <label class="form-label mb-0"><?php echo e(trans('labels.email')); ?></label>
                                        
                                        <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        <input type="text" class="form-control" name="email"
                                            placeholder="<?php echo e(trans('labels.email')); ?>"
                                            <?php if(env('Environment') == 'sendbox'): ?> value="510" readonly <?php else: ?> value="<?php echo e(old('email')); ?>" <?php endif; ?>>
                                        </div>
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
                                    <div class="col-lg-4 col-sm-12 form-group mb-3">
                                        <label class="form-label mb-0"><?php echo e(trans('labels.mobile')); ?></label>
                                        <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                        <input type="text" class="form-control" name="mobile"
                                            placeholder="<?php echo e(trans('labels.mobile')); ?>"
                                            <?php if(env('Environment') == 'sendbox'): ?> value="510" readonly <?php else: ?> value="<?php echo e(old('mobile')); ?>" <?php endif; ?>>
                                        </div>
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
                                <?php endif; ?>

                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><?php echo e(trans('labels.house_no')); ?></label>
                                        <input type="text" class="form-control" name="house_no"
                                            placeholder="<?php echo e(trans('messages.enter_house_no')); ?>"
                                            <?php if(env('Environment') == 'sendbox'): ?> value="510" readonly <?php else: ?> value="<?php echo e(old('house_no')); ?>" <?php endif; ?>>
                                        <?php $__errorArgs = ['house_no'];
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
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><?php echo e(trans('labels.area')); ?></label>
                                        <input type="text" class="form-control" name="area"
                                            placeholder="<?php echo e(trans('messages.enter_area')); ?>"
                                            <?php if(env('Environment') == 'sendbox'): ?> value="Bartoletti Land" readonly <?php else: ?> value="<?php echo e(old('area')); ?>" <?php endif; ?>>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label"><?php echo e(trans('labels.complete_address')); ?></label>
                                        <?php if(env('Environment') == 'sendbox'): ?>
                                            <textarea rows="3" class="form-control" name="address" placeholder="<?php echo e(trans('labels.complete_address')); ?>"
                                                readonly>Norwoodport , West Virginia - 86490-8323</textarea>
                                        <?php else: ?>
                                            <textarea rows="3" class="form-control" name="address" placeholder="<?php echo e(trans('labels.complete_address')); ?>"><?php echo e(old('address')); ?> </textarea>
                                        <?php endif; ?>
                                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <small class="text-danger"><?php echo e($message); ?></small> <br>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <span class="text-muted">*<?php echo e(trans('labels.address_note')); ?>*</span>
                                    </div>
                                </div>

                                <?php if(Auth::user()): ?>
                                <div class="col-12">
                                    <div class="form-group mb-4">
                                        <label class="form-label"><?php echo e(trans('labels.save_as')); ?></label>
                                        <div class="row pt-2">
                                            <div class="col-auto new-address">
                                                <label class="form-check-label" for="home">
                                                    <input class="form-check-input d-none" type="radio"
                                                        name="address_type" value="1"
                                                        <?php echo e(old('address_type') == 1 ? 'checked' : 'checked'); ?>

                                                        id="home">
                                                    <div class="save-as"><span><?php echo e(trans('labels.home')); ?></span></div>
                                                </label>
                                            </div>
                                            <div class="col-auto new-address">
                                                <label class="form-check-label" for="office">
                                                    <input class="form-check-input d-none" type="radio"
                                                        name="address_type" value="2"
                                                        <?php echo e(old('address_type') == 2 ? 'checked' : ''); ?> id="office">
                                                    <div class="save-as"><span><?php echo e(trans('labels.office')); ?></span></div>
                                                </label>
                                            </div>
                                            <div class="col-auto new-address">
                                                <label class="form-check-label" for="other">
                                                    <input class="form-check-input d-none" type="radio"
                                                        name="address_type" value="3"
                                                        <?php echo e(old('address_type') == 3 ? 'checked' : ''); ?> id="other">
                                                    <div class="save-as"><span><?php echo e(trans('labels.other')); ?></span></div>
                                                </label>
                                            </div>
                                        </div>
                                        <?php $__errorArgs = ['address_type'];
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
                                <?php endif; ?>
                                <div class="col-12 text-end">
                                    <button type="submit"
                                        class="btn bg-primary text-white px-4 py-2"><?php echo e(trans('labels.save_address_details')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php echo $__env->make('web.subscribeform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
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
                }, 
                (showError) => {
                    $('#permissions').show();
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

        const x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            location.reload();
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                x.innerHTML = "User denied the request for Geolocation."
                break;
                case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Location information is unavailable."
                break;
                case error.TIMEOUT:
                x.innerHTML = "The request to get user location timed out."
                break;
                case error.UNKNOWN_ERROR:
                x.innerHTML = "An unknown error occurred."
                break;
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\single-restaurant\resources\views/web/address/add.blade.php ENDPATH**/ ?>