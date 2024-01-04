<!doctype html>
<html lang="en" dir="{{ session('direction') == 2 ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta property="og:title" content="{{@Helper::appdata()->og_title}}" />
	<meta property="og:description" content="{{@Helper::appdata()->og_description}}" />
	<meta property="og:image" content='{{ Helper::image_path(@Helper::appdata()->og_image)}}' />
    <title> {{ @Helper::appdata()->title }} @yield('page_title')</title>
    <link rel="icon" href="{{ Helper::image_path(@Helper::appdata()->favicon) }}"><!-- Favicon -->
    <link rel="stylesheet" href="{{url(env('ASSETSPATHURL').'web-assets/css/bootstrap.min.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url(env('ASSETSPATHURL').'web-assets/css/owl_carousel/owl.carousel.min.css') }}">
    <!-- owl-carousel css -->
    <link rel="stylesheet"
        href="{{url(env('ASSETSPATHURL').'web-assets/css/owl_carousel/owl.theme.default.min.css') }}">
    <!-- owl-carousel css -->
    <link rel="stylesheet" href="{{url(env('ASSETSPATHURL').'web-assets/css/font_awesome/all.css') }}">
    <!-- Font Awesome CSS -->
    <!-- COMMON-CSS -->
    <link rel="stylesheet" href="{{url(env('ASSETSPATHURL').'admin-assets/assets/css/toastr/toastr.min.css') }}"><!-- Toastr CSS -->
    <link rel="stylesheet" href="{{url(env('ASSETSPATHURL').'admin-assets/assets/css/sweetalert/sweetalert2.min.css') }}"><!-- Sweetalert CSS -->
    <link rel="stylesheet" href="{{url(env('ASSETSPATHURL').'web-assets/css/style.css') }}"><!-- Custom CSS -->
    <link rel="stylesheet" href="{{url(env('ASSETSPATHURL').'web-assets/css/responsive.css') }}"><!-- Media Query Resposive CSS -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .breadcrumb-sec{
            background: url('{{Helper::image_path(Helper::appdata()->breadcrumb_bg_image)}}') center center/cover no-repeat !important;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!--Preloader start here-->
    <div id="preload" class="bg-light">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class='loader-icon'><img src="{{ Helper::image_path(@Helper::appdata()->logo) }}" alt="Swipy">
                </div>
            </div>
        </div>
    </div>
    <!--Preloader area end here-->
    <main>
        <div class="wrapper">
            <input type="hidden" name="hdnsession" id="hdnsession" value="{{ session()->get('direction') }}">
            @include('web.layout.header')
            <div class="content-wrapper">
                @yield('content')
                @include('web.layout.footer')
            </div>
        </div>
    </main>
    <!-- Modal Item Details -->
    <div class="modal fade modalitemdetails" id="modalitemdetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content p-4">
                <div class="modal-header align-items-start p-0 py-3">
                    <div class="d-flex">
                        <span id="item_type_image"></span>
                        <div class="d-grid {{ session()->get('direction') == '2' ? 'me-2' : 'ms-2' }}">
                            <p class="modal-title fs-5 fw-bold item_name"></p>
                            <p class="text-muted item_price"></p>
                        </div>
                    </div>
                    <button type="button"
                        class="btn-close mt-1 {{ session()->get('direction') == 2 ? 'close m-0' : '' }}"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0 ">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="item-details">
                                <div class="item-varition-list mb-4" id="variation">
                                    <h6 class="attribute fw-bold"></h6>
                                    <div class="varition-listing"></div>
                                </div>
                                <div class="item-addons-list mb-4" id="addons">
                                    <h6 class="fw-bold">{{ trans('labels.addons') }}</h6>
                                    <div class="addons-listing"></div>
                                </div>
                                {{-- <br> slug --}}
                                <input type="hidden" name="slug" id="slug">
                                {{-- <br> item_name --}}
                                <input type="hidden" name="item_name" id="item_name">
                                {{-- <br> item_type --}}
                                <input type="hidden" name="item_type" id="item_type">
                                {{-- <br> image_name --}}
                                <input type="hidden" name="image_name" id="image_name">
                                {{-- <br> tax --}}
                                <input type="hidden" name="tax" id="item_tax">
                                {{-- <br> item_price --}}
                                <input type="hidden" name="item_price" id="item_price">
                                {{-- <br> addonstotal --}}
                                <input type="hidden" name="addonstotal" id="addonstotal" value="0">
                                {{-- <br> subtotal --}}
                                <input type="hidden" name="subtotal" id="subtotal" value="0">
                                <div class="modal-footer px-0">
                                
                                    <a class="btn btn-success w-100 m-0 my-2" onclick="addtocart('{{ URL::to('addtocart') }}')">{{ trans('labels.add_to_cart') }}</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('cookie-consent::index')
    <script src="{{url(env('ASSETSPATHURL').'web-assets/js/jquery/jquery-3.6.0.js') }}"></script><!-- jQuery JS -->
    <script src="{{url(env('ASSETSPATHURL').'web-assets/js/owl_carousel/owl.carousel.js') }}"></script><!-- owl carousel js -->
    <script src="{{url(env('ASSETSPATHURL').'web-assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script><!-- Bootstrap CSS -->
    <!-- COMMON-FOR-TOASTER-&-SWEETALERT -->
    <script src="{{url(env('ASSETSPATHURL').'admin-assets/assets/js/toastr/toastr.min.js') }}"></script><!-- Toastr JS -->
    <script src="{{url(env('ASSETSPATHURL').'admin-assets/assets/js/sweetalert/sweetalert2.min.js') }}"></script><!-- Sweetalert JS -->
    <script>
        // COMMON-SCRIPTS
        // to-display-success-error-message
        toastr.options = {
            "closeButton": true,
        }
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif
        // for-sweetalert
        let are_you_sure = "{{ trans('messages.are_you_sure') }}";
        let yes = "{{ trans('messages.yes') }}";
        let no = "{{ trans('messages.no') }}";
        let wrong = "{{ trans('messages.wrong') }}";
        let record_safe = "{{ trans('messages.record_safe') }}";
        let okay = "{{ trans('labels.okay') }}";
        let track_order = "{{ trans('labels.track_order') }}";
        let continue_shopping = "{{ trans('labels.continue_shopping') }}";
        let order_placed = "{{ trans('labels.order_placed') }}";
        let order_placed_note = "{{ trans('messages.order_placed_note') }}";
        let restaurant_closed = "{{ trans('messages.restaurant_closed') }}";
        // others
        function currency_format(price) {
            "use strict";
            if ("{{ @Helper::appdata()->currency_position }}" == 1) {
                return "{{ @Helper::appdata()->currency }}" + parseFloat(price).toFixed(2);
            } else {
                return parseFloat(price).toFixed(2) + "{{ @Helper::appdata()->currency }}";
            }
        }
    </script>
    <script src="{{url(env('ASSETSPATHURL').'web-assets/js/common.js') }}"></script><!-- web-common-js -->
    @yield('scripts')

    <script>
        
        </script>
</body>
</html>