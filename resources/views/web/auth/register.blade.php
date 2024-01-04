<!doctype html>
<html lang="en" dir="{{ session('direction') == 2 ? 'rtl' : 'ltr' }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> {{@Helper::appdata()->title}} | {{trans('labels.signup')}} </title>
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
                    <div class="row">
                        <div class="col-lg-4 col-12 px-sm-5 py-4 my-3 px-4">
                            <!-- Authentication Form Body -->
                            <form action="{{ route('adduser') }}" method="POST">
                                @csrf
                                <!-- Authentication Form Inner Content -->
                                <div>
                                    <a href="{{route('home')}}"><img src="{{ Helper::image_path(@Helper::appdata()->logo) }}" alt="" class="login-form-logo"></a>
                                    <h5 class="bottom-line py-2 mb-0 fw-bold w-auto">Signup</h5>
                                    <h7 class="fs-7">Fill up below details and create your Account.</h7>
                                </div>
                                <div class="form-body mt-4">
                                    <div class="form-group mb-md-3 mb-2">
                                        <label class="form-label fs-7 mb-1" for="name">{{trans('labels.full_name')}}</label>
                                        @if (session()->has('social_login'))
                                            <input type="text" class="form-control custom-input rounded mb-1" name="name" value="{{session()->get('social_login')['name']}}"  placeholder="{{trans('labels.full_name')}}">
                                        @else
                                            <input type="text" class="form-control custom-input rounded mb-1" name="name" value="{{ old('name') }}"  placeholder="{{trans('labels.full_name')}}">    
                                        @endif
                                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="form-group mb-md-3 mb-2">
                                        <label class="form-label fs-7 mb-1" for="email">{{trans('labels.email')}}</label>
                                        @if (session()->has('social_login'))
                                            <input type="email" class="form-control custom-input rounded mb-1" name="email" value="{{session()->get('social_login')['email']}}" id="email" placeholder="{{trans('labels.email')}}">
                                        @else
                                        <input type="email" class="form-control custom-input rounded mb-1" name="email" value="{{ old('email') }}" id="email" placeholder="{{trans('labels.email')}}">
                                        @endif
                                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md">
                                                <label class="form-label fs-7 mb-1" for="mobile">{{trans('labels.mobile')}}</label>
                                                <div class="input-group mb-md-3 mb-2">
                                                    <input type="hidden" name="country" id="country" value="91">
                                                    <input type="tel" id="mobile" name="mobile" class="form-control custom-input rounded mb-3" placeholder="{{trans('labels.mobile')}}" value="{{old('mobile')}}">
                                                    @error('mobile')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <label class="form-label fs-7 mb-1" for="referral_code">{{trans('labels.referral_code')}} </label>
                                                <input type="text" class="form-control custom-input rounded mb-md-3 mb-2" id="referral_code_o" name="referral_code" placeholder="{{trans('labels.referral_code_o')}}" @isset($_GET['referral']) value="{{$_GET['referral']}}" @endisset>
                                            </div>
                                        </div>
                                    </div>
                                    @if (!session()->has('social_login'))
                                    @if (\App\SystemAddons::where('unique_identifier', 'otp')->first() == null || \App\SystemAddons::where('unique_identifier', 'otp')->first()->activated != 1)
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md">
                                                    <label class="form-label fs-7 mb-1" for="password">{{trans('labels.password')}}</label>
                                                        <input type="password" class="form-control custom-input rounded mb-md-3 mb-2" id="password" name="password" placeholder="{{trans('labels.password')}}" value="{{old('password')}}">
                                                        @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                                                    </div>
                                                    <div class="col-md">
                                                        <label class="form-label fs-7 mb-1" for="confirm_password">{{trans('labels.confirm_password')}}</label>
                                                        <input type="password" class="form-control custom-input rounded mb-md-3 mb-2" id="confirm_password" name="password_confirmation" placeholder="{{trans('labels.confirm_password')}}" value="{{old('password_confirmation')}}">
                                                        @error('password_confirmation')<div class="text-danger">{{ $message }}</div>@enderror
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="form-group">
                                        <input type="checkbox" name="checkbox" id="checkbox" value="1" class="form-check-input me-1" {{old('checkbox') == 1 ? 'checked' : ''}}>
                                        <label for="checkbox" class="form-check-label m-auto fs-7">
                                        {{ trans('labels.i_accepts_the') }} <a href="{{URL::to('terms-conditions')}}" class="text-primary text-decoration-none fw-medium">{{ trans('labels.terms_conditions') }}</a></label>
                                        @error('checkbox') <br> <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-primary w-100">{{trans('labels.signup')}}</button>
                                    </div>
                                </div>
                                <div class="form-group text-center mt-3">
                                    <p class="mb-0 fs-7">
                                        {{trans('labels.already_account')}} 
                                        <a href="{{ 'login' }}" class="text-primary fw-medium text-decoration-none">{{trans('labels.signin')}}</a>
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
        var input = $('#mobile');
        var iti = intlTelInput(input.get(0))
        iti.setCountry("in");
        input.on('countrychange', function(e) {
            $('#country').val(iti.getSelectedCountryData().dialCode);
        });
        $('.iti--allow-dropdown').addClass('w-100');
    </script>
</body>
</html>