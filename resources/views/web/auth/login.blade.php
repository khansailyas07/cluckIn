<!doctype html>
<html lang="en" dir="{{ session('direction') == 2 ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> {{@Helper::appdata()->title}} | {{trans('labels.signin')}} </title>
    <link rel="icon" href="{{Helper::image_path(@Helper::appdata()->favicon)}}"><!-- Favicon -->
    <link rel="stylesheet" href="{{url(env('ASSETSPATHURL').'web-assets/css/bootstrap.min.css') }}"><!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url(env('ASSETSPATHURL').'web-assets/css/font_awesome/all.css') }}"><!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{url(env('ASSETSPATHURL').'web-assets/css/style.css') }}"><!-- Custom CSS -->
    <link rel="stylesheet" href="{{url(env('ASSETSPATHURL').'web-assets/css/responsive.css') }}"><!-- Media Query Resposive CSS -->
    <!-- COMMON-CSS -->
    <link rel="stylesheet" href="{{url(env('ASSETSPATHURL').'admin-assets/assets/css/toastr/toastr.min.css') }}"><!-- Toastr CSS -->
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
        <div class="img-fluid">
            <!-- Sticky Background Image -->
            <div class="auth_form_container container d-flex justify-content-center align-items-center">
                <div class="auth_form_inner box col-12">
                    <!-- Authentication Form Body -->
                    <div class="row">
                        <div class="col-lg-4 col-12 p-sm-5 p-4">
                            <form action="{{ URL::to('/checklogin') }}" method="POST">
                                @csrf
                                <div>
                                    <a href="{{route('home')}}"><img src="{{ Helper::image_path(@Helper::appdata()->logo) }}" alt="" class="login-form-logo"></a>
                                    <h5 class="bottom-line py-2 m-0 fw-bold">Login Your Account</h5>
                                    <h7 class="fs-7">Enter your registered email address and password below</h7>
                                </div>
                                <div class="form-body mt-4">
                                @if (\App\SystemAddons::where('unique_identifier', 'otp')->first() != null && \App\SystemAddons::where('unique_identifier', 'otp')->first()->activated == 1)
                                        <div class="col-md">
                                            <label class="text-black form-label" for="mobile">{{trans('labels.mobile')}}</label>
                                            <div class="input-group">
                                                <input type="hidden" name="country" id="country" value="91">
                                                <input type="tel" id="mobile" name="mobile" class="form-control custom-input rounded mb-3" placeholder="{{trans('labels.mobile')}}" value="{{old('mobile')}}">
                                            </div>
                                            @error('mobile')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    @else
                                        <div class="form-group mb-3">
                                            <label class="text-black form-label fs-7 mb-1">{{trans('labels.email')}}</label>
                                            <input type="email" name="email" class="form-control custom-input mb-1" placeholder="{{trans('labels.email')}}" @if (env('Environment') == 'sendbox') value="user@gmail.com" @endif>
                                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="text-black form-label fs-7 mb-1">{{trans('labels.password')}}</label>
                                            <input type="password" name="password" class="form-control custom-input mb-1" placeholder="{{trans('labels.password')}}" @if (env('Environment') == 'sendbox') value="123456" @endif>
                                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="form-group d-flex justify-content-end">
                                            <a href="{{ URL::to('forgot-password') }}" class="text-primary fw-medium fs-7 float-end">{{trans('labels.forgot_password_q')}}</a>
                                        </div>
                                    @endif
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary w-100">{{trans('labels.signin')}}</button>
                                    </div>
                                </div>
                                <div class="or_section">
                                    <div class="line ms-4"></div>
                                    <p class="mb-0 fw-light">{{ trans('labels.or') }}</p>
                                    <div class="line me-4"></div>
                                </div>
                                <div class="row social_icon">
                                    <div class="col d-sm-flex justify-content-center text-center d-sm-flex p-0">
                                        <div class="col-sm-5 col bg-white rounded-2 py-2 m-2">
                                            <a @if (env('Environment')=='sendbox' ) onclick="myFunction()" @else href="{{ URL::to('login/google') }}" @endif>
                                                <img src="{{Helper::web_image_path('google.svg')}}" alt="social-icon" class="brands-logo"><span class="text-dark px-1">Sign in</span>
                                            </a>
                                        </div>
                                        <div class="col-sm-5 col bg-white rounded-2 py-2 m-2">
                                            <a @if (env('Environment')=='sendbox' ) onclick="myFunction()" @else href="{{ URL::to('login/facebook') }}" @endif>
                                                <img src="{{Helper::web_image_path('facebook.svg')}}" alt="social-icon" class="brands-logo"><span class="text-dark px-1">Sign in</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-3 text-center">
                                    <p class="text-black mb-0 fs-7">
                                        {{trans('labels.dont_account')}}
                                        <a href="{{ 'register' }}" class="text-primary fw-medium ">{{trans('labels.signup')}}</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                        <div class="image col-8">
                            <img src="{{ url(env('ASSETSPATHURL').'web-assets/images/bg1.jpg')}}" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{url(env('ASSETSPATHURL').'web-assets/js/jquery/jquery-3.6.0.js') }}"></script><!-- jQuery JS -->
    <script src="{{url(env('ASSETSPATHURL').'web-assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script><!-- Bootstrap JS -->
    <!-- COMMON-JS -->
    <script src="{{url(env('ASSETSPATHURL').'admin-assets/assets/js/toastr/toastr.min.js') }}"></script><!-- Toastr JS -->
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif
        // for-page-loader
        $(window).on('load', function() {
            "use strict";
            $("#preload").delay(600).fadeOut(500);
            $(".pre-loader").delay(600).fadeOut(500);
        })
    </script>
    <script src="{{url(env('ASSETSPATHURL').'web-assets/js/intl-tel-input/17.0.8.intlTelInput.min.js') }}"></script>
    <link rel="stylesheet" href="{{url(env('ASSETSPATHURL').'web-assets/js/intl-tel-input/17.0.8.intlTelInput.min.css') }}">
    <script src="{{url(env('ASSETSPATHURL').'web-assets/js/intl-tel-input/17.0.8.utils.js') }}"></script>
    <script>
        function myFunction() {
            "use strict";
            toastr.error("This operation was not performed due to demo mode");
        }
        var input = $('#mobile');
        var checkval = $('#mobile').val();
        if(checkval == ""){
            var iti = intlTelInput(input.get(0))
            iti.setCountry("in");
            input.on('countrychange', function(e) {
                $('#country').val(iti.getSelectedCountryData().dialCode);
            });
            $('.iti--allow-dropdown').addClass('w-100');
        }
    </script>
</body>
</html>