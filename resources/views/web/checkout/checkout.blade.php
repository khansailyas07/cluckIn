@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.checkout') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.checkout') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ URL::to('/') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.checkout') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    @if (count($getcartlist) > 0)
        @php
            $totaltax = 0;
            $totaltaxamount = 0;
            $order_total = 0;
            $total_item_qty = 0;
        @endphp
        @foreach ($getcartlist as $item)
            @php
                $tax = ($item['item_price'] * $item['qty'] * $item['tax']) / 100;
                $total_price = ($item['item_price'] + $item['addons_total_price']) * $item['qty'];
                $totaltaxamount += (float) $tax;
                $order_total += (float) $total_price;
                $total_item_qty += $item['qty'];
            @endphp
        @endforeach
        <section>
            <div class="container">
                
                <div class="cart-view my-5">
                    <div class="row">
                        {{-- address-view --}}
                        <div class="col-lg-8 order-md2">
                            @if (session()->get('order_type') == 1)
                                    @if (Auth::user() && Auth::user()->type == 2)
                                    <input type="hidden" id="authcheck" name="authcheck" value="1"/>

                                        <div class="checkout-view p-4 mb-3">
                                            <div class="heading mb-2">
                                                <h2>{{ trans('labels.select_address') }}</h2>
                                            </div>
                                            <div class="addresserror alert alert-danger my-2 py-1 d-none">
                                                {{ trans('messages.select_address') }}</div>
                                            <div class="row address-list">
                                                @foreach ($getaddresses as $key => $addressdata)
                                                    <div class="col-md-6 d-flex">
                                                        <input type="radio" name="myaddress" class="d-none"
                                                            value="{{ $addressdata->id }}" id="rad{{ $addressdata->id }}"
                                                            data-address-type="{{ $addressdata->address_type }}"
                                                            address="{{ $addressdata->address }}"
                                                            house_no="{{ $addressdata->house_no }}"
                                                            area="{{ $addressdata->area }}" lat="{{ $addressdata->lat }}"
                                                            lang="{{ $addressdata->lang }}" data-url="{{URL::to('/checkdeliveryzone')}}" {{$key == 0 ? 'checked' : ''}}>
                                                        <div class="address-card w-100">
                                                            <div class="col-2 address-icon">
                                                                @if ($addressdata->address_type == 1)
                                                                    <i class="fa-solid fa-house-chimney"></i>
                                                                    @php $address_type_text = trans('labels.home'); @endphp
                                                                @elseif ($addressdata->address_type == 2)
                                                                    <i class="fa-solid fa-briefcase"></i>
                                                                    @php $address_type_text = trans('labels.office'); @endphp
                                                                @else
                                                                    <i class="fa-solid fa-map-location-dot"></i>
                                                                    @php $address_type_text = trans('labels.other'); @endphp
                                                                @endif
                                                            </div>
                                                            <div class="col-10 address pe-3">
                                                                <h4>{{ $address_type_text }}</h4>
                                                                <p>{{ $addressdata->address }}, {{ $addressdata->area }}, {{ $addressdata->house_no }}</p>
                                                                <label class="btn fs-8 btn-sm btn-success border-0 text-uppercase" for="rad{{ $addressdata->id }}">{{ trans('labels.deliver_here') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-md-6">
                                                    <div
                                                        class="address-card border-dashed d-flex justify-content-center align-items-center text-center w-100">
                                                        <div class="address">
                                                            <h4>{{ trans('labels.add_new_address') }}</h4>
                                                            <a class="btn btn-outline-success text-uppercase btn-sm"
                                                                href="{{ URL::to('/address/add') }}">{{ trans('labels.add_new') }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                            @endif

                            @if(!Auth::user())
                            <input type="hidden" name="authcheck" id="authcheck" value="0"/>
                                    
                                        
                                    <div class="checkout-view p-4 mb-3">
                                    @if(session()->get('order_type') == 2)
                                    
                                    
                                    <form id="address_form" method="POST">
                                        <div class="form-group mb-3">
                                            <label class="form-label mb-0">{{ trans('labels.full_name') }}</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="{{ trans('labels.full_name') }}" >
                                             @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-12 row">
                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label mb-0">{{ trans('labels.email') }}</label>
                                            <input type="text" class="form-control" name="email" id="email"
                                                placeholder="{{ trans('labels.email') }}">
                                             @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label mb-0">{{ trans('labels.mobile') }}</label>
                                            <input type="text" class="form-control" name="mobile" id="mobile"
                                                placeholder="{{ trans('labels.mobile') }}" >
                                               
                                             @error('mobile')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    </form>

                                    </div>
                     
                                @else

                                    <div class="heading mb-2"> 
                                        <h2>
                                            {{ trans('labels.select_address') }}
                                        </h2> 
                                    </div>
                                    <div class="row address-list">
                                    @if(session()->has('addressdata'))
                                      @php $addressdata = session()->get('addressdata');
                                    @endphp
                                        <div class="col-md-6 d-flex">
                                            <div class="address-card w-100">
                                                <div class="col-2 address-icon">
                                                        <i class="fa-solid fa-house-chimney"></i>      
                                                </div>
                                                <div class="col-10 address pe-3">
                                                    <input type="hidden" name="address" id="address" value="{{ $addressdata['address'] }}">
                                                    <input type="hidden" name="area" id="area" value="{{ $addressdata['area'] }}">
                                                    <input type="hidden" name="lat" id="lat" value="{{ $addressdata['lat'] }}">
                                                    <input type="hidden" name="lang" id="lang" value="{{ $addressdata['lang'] }}">
                                                    <input type="hidden" name="house_no" id="house_no" value="{{ $addressdata['house_no'] }}">
                                                    <h4>{{ $addressdata['name'] }}</h4>
                                                    <p>{{ $addressdata['house_no'] }} , {{ $addressdata['address'] }} </p>
                                                    <a class="btn btn-sm btn-success border-0 text-uppercase" href="{{ URL::to('/address-1') }}">{{ trans('labels.change') }}</a>
                                                    <a class="btn btn-sm btn-danger border-0 text-uppercase" href="javascript:void(0)" onclick="deleteaddress('1','{{ URL::to('/address/delete') }} ') ">{{ trans('labels.remove') }}</a>
                                                </div>
                                            </div> 
                                        </div> 
                                    @else
                                    <div class="col-md-6">
                                        <div class="address-card border-dashed d-flex justify-content-center align-items-center text-center w-100">
                                            <div class="address">
                                                <h4>{{ trans('labels.add_new_address') }}</h4>
                                                <input type="hidden" name="addressdata" id="addressdata" value="0"/>
                                                <a class="btn btn-outline-success text-uppercase btn-sm" href="{{ URL::to('/address/add') }}">{{ trans('labels.add_new') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                   
                                    </div>
                                    
                                </div>
                                @endif
                             @endif
                          
                            <div class="payment-option mb-3">
                                <div class="heading mb-2">
                                    <h2>{{ trans('labels.choose_payment') }}</h2>
                                </div>
                                {{-- payment-options --}}
                                @include('web.paymentmethodsview')
                                <div class="d-flex justify-content-center my-4">
                                    <button class="btn btn-primary text-uppercase px-4 py-2"
                                        onclick="isopenclose('{{ URL::to('/isopenclose') }}','{{$total_item_qty}}','{{$order_total}}')">{{ trans('labels.proceed_pay') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 order-md1">
                            {{-- payment-summary --}}
                            <div class="summary py-3 mb-4">
                                <h2 class="border-bottom">{{ trans('labels.payment_summary') }}</h2>
                                <div class="bill-details border-bottom">
                                    @php
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
                                       
                                    @endphp
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span>{{ trans('labels.subtotal') }}</span></div>
                                        <div class="col-auto">
                                            <p>{{ Helper::currency_format($order_total) }}</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span>{{ trans('labels.tax') }}</span></div>
                                        <div class="col-auto">
                                            <p>{{ Helper::currency_format($totaltaxamount) }}</p>
                                        </div>
                                    </div>
                                    @if (session()->has('discount_data'))
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto"><span>{{ trans('labels.discount') }}
                                                {{ session()->has('discount_data') == true ? '(' . session()->get('discount_data')['offer_code'] . ')' : '' }}
                                            </span></div>
                                            <div class="col-auto">
                                                <p>- {{ Helper::currency_format($discount_amount) }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    @if (session()->get('order_type') == 1)
                                        @php $delivery_charge = 0; @endphp
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto"><span>{{ trans('labels.delivery_charge') }}</span>
                                            </div>
                                            <div class="col-auto">
                                                <p class="delivery_charge">
                                                    @if(session()->has('addressdata'))
                                                     {{ Helper::currency_format($addressdata['delivery_charge'])  }}
                                                    @else
                                                    {{ Helper::currency_format($delivery_charge) }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        @php $delivery_charge = 0; @endphp
                                    @endif
                                </div>
                                <div class="bill-total mt-2">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto"><span>{{ trans('labels.grand_total') }}</span></div>
                                        <div class="col-auto"><span class="grand_total">{{ Helper::currency_format($grand_total) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- special-instruction --}}
                            <div class="special-instruction py-3 mb-3">
                                <label class="form-label mb-2"
                                    for="order_notes">{{ trans('labels.special_instruction') }}</label>
                                <textarea class="form-control" name="order_notes" id="order_notes" rows="3"
                                    placeholder="{{ trans('labels.special_instruction') }}"></textarea>
                            </div>
                            <a href="{{ URL::to('/') }}" class="continue-shopping mb-3 text-primary text-uppercase"><i class="fa-solid fa-circle-arrow-left me-2"></i>{{ trans('labels.continue_shopping') }}</a>
                        </div>
                    </div>
                    {{-- <br> order_type --}}
                    <input type="hidden" name="order_type" id="order_type" value="{{ session()->get('order_type') }}">
                    {{-- <br> grand_total --}}
                    <input type="hidden" name="grand_total" id="grand_total" value="{{ $grand_total }}">
                    {{-- <br> sub_total --}}
                    <input type="hidden" name="sub_total" id="sub_total" value="{{ $order_total }}">
                    {{-- <br> totaltaxamount --}}
                    <input type="hidden" name="totaltaxamount" id="totaltaxamount" value="{{ $totaltaxamount }}">
                    {{-- <br> delivery_charge --}}
                    
                    
                    <input type="hidden" name="delivery_charge" id="delivery_charge" value="@if(session()->has('addressdata')) {{ $addressdata['delivery_charge'] }}@else{{ $delivery_charge }}@endif">
                    <input type="hidden" name="user_name" id="user_name" value="@if(session()->has('addressdata')){{ $addressdata['name']}} @else {{ @Auth::user()->name }} @endif">
                    <input type="hidden" name="user_email" id="user_email" value="@if(session()->has('addressdata')){{ $addressdata['email']}} @else  {{ @Auth::user()->email }}  @endif">
                    <input type="hidden" name="user_mobile" id="user_mobile" value="@if(session()->has('addressdata')){{ $addressdata['mobile']}}@else {{ @Auth::user()->mobile }} @endif">

                    
                    <input type="hidden" name="rest_lat" id="rest_lat" value="{{@Helper::appdata()->lat }}">
                    <input type="hidden" name="rest_lang" id="rest_lang" value="{{@Helper::appdata()->lang }}">
                    <input type="hidden" name="delivery_charge_per_km" id="delivery_charge_per_km" value="{{@Helper::appdata()->delivery_charge }}">
                    <input type="hidden" name="orderurl" id="orderurl" value="{{ URL::to('placeorder') }}">
        
                    <input type="hidden" name="successurl" id="successurl" value="{{ URL::to('/orders') }}">
                    <input type="hidden" name="continueurl" id="continueurl" value="{{ URL::to('/') }}">
                    <input type="hidden" name="environment" id="environment" value="{{ env('Environment') }}">

                    <input type="hidden" name="paymentsuccess" id="paymentsuccess" value="{{ URL::to('paymentsuccess') }}">
                    <input type="hidden" name="paymentfail" id="paymentfail" value="{{ URL::to('paymentfail') }}">

                    <input type="hidden" name="myfatoorahurl" id="myfatoorahurl" value="{{ URL::to('myfatoorah') }}">
                    <input type="hidden" name="mercadopagourl" id="mercadopagourl" value="{{ URL::to('mercadorequest') }}">
                    <input type="hidden" name="paypalurl" id="paypalurl" value="{{ URL::to('paypal') }}">
                    <input type="hidden" name="toyyibpayurl" id="toyyibpayurl" value="{{ URL::to('toyyibpay') }}">


                    <form action="{{ URL::to('paypal') }}" method="post" class="d-none">
                        {{ csrf_field() }}
                        <input type="hidden" name="return" value="2">
                        <input type="submit" class="callpaypal" name="submit">
                    </form>
                    

                </div>
              
            </div>
        </section>
        @include('web.subscribeform')
    @else
        @include('web.nodata')
    @endif
@endsection
@section('scripts')
    <script src="https://checkout.stripe.com/v2/checkout.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="{{url(env('ASSETSPATHURL').'web-assets/js/custom/checkout.js')}}"></script>
@endsection
<script type="text/javascript">

toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif


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
        src="https://maps.googleapis.com/maps/api/js?libraries=places&{{ @Helper::appdata()->map != 'map_key' ? 'key=' . @Helper::appdata()->map : '' }}">
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
            if ("{{ env('Environment') }}" != "sendbox") {
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
