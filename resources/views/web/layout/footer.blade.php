<!-- Back to Top Button Start Here -->
<div id="back-to-top">
    <a class="btn text-primary">
        <i class="fa-solid fa-angle-up"></i>
    </a>
</div>
<!-- Back to Top Button End Here -->
<!-- Footer Start Here -->
<footer>


@if(request()->is('/') || request()->is('home'))

    @if(Helper::get_theme() == 1)

    <div class="theme-2-product-service">
        <div class="container">
            <div class="row justify-content-center my-4">
                @foreach (Helper::footer_features() as $feature)
                <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
                    <div class="card border-0 bg-transparent">
                        <div class="card-body d-flex">
                            <div class="quality-icon col-3 mb-3">
                                {!! $feature->icon !!}
                            </div>
                            <div class="quality-content px-3">
                                <h3>{{ $feature->title }}</h3>
                                <p class="m-0 text-muted fs-7">{{ $feature->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>                                      
    </div>

    @elseif(Helper::get_theme() == 2)


    <!------------------- theme-2 ------------------->
    <div class="theme-2-product-service">
        <div class="container">
            <div class="row justify-content-center my-4">
                @foreach (Helper::footer_features() as $feature)
                <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
                    <div class="card border-0 bg-transparent">
                        <div class="card-body d-flex">
                            <div class="quality-icon col-3 mb-3">
                                {!! $feature->icon !!}
                            </div>
                            <div class="quality-content px-3">
                                <h3>{{ $feature->title }}</h3>
                                <p class="m-0 text-muted fs-7">{{ $feature->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>                                      
    </div>

    @else

    <div class="theme-2-product-service">
        <div class="container">
            <div class="row justify-content-center my-4">
                @foreach (Helper::footer_features() as $feature)
                <div class="col-lg-3 col-md-6 col-sm-6 mb-2">
                    <div class="card border-0 bg-transparent">
                        <div class="card-body d-flex">
                            <div class="quality-icon col-3 mb-3">
                                {!! $feature->icon !!}
                            </div>
                            <div class="quality-content px-3">
                                <h3>{{ $feature->title }}</h3>
                                <p class="m-0 text-muted fs-7">{{ $feature->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>                                      
    </div>

    @endif

@endif
    <!------------------- theme-2 ------------------->


    <div class="footer" style="background : url('{{Helper::image_path(@Helper::appdata()->footer_bg_image)}}') center center/cover no-repeat rgba(0, 0, 0, .6) !important;">
        <div class="container">
            <div class="row footer-area border-bottom-primary">
                <div class="col-lg-4 col-md-4 col-sm-4 col-12 left-side mt-3">
                    <a href="{{ route('home') }}">
                        <img src="{{ Helper::image_path(@Helper::appdata()->logo) }}" width="75" class="my-3" alt="footer_logo">
                    </a>
                    <h1>{{ @Helper::appdata()->footer_title }}</h1>
                    <p>{{ @Helper::appdata()->footer_description }}</p>
                    <div class="col-lg-5 col-md-5 col-auto my-2">
                        <a class="fs-4 text-white " href="{{ @Helper::appdata()->fb }}" target="_blank"> <i class="fab fa-facebook-square"></i> </a>
                        <a class="fs-4 text-white {{session()->get('direction') == '2' ? 'me-3' : 'ms-3'}} " href="{{ @Helper::appdata()->insta }}" target="_blank"> <i class="fab fa-instagram"></i> </a>
                        <a class="fs-4 text-white {{session()->get('direction') == '2' ? 'me-3' : 'ms-3'}} " href="{{ @Helper::appdata()->youtube }}" target="_blank"> <i class="fab fa-youtube"></i> </a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-12 right-side">
                    <div class="row justify-content-between">
                        <div class="col-md-4 col-sm-4 col-auto mb-2">
                            <h4>{{ trans('labels.about_us') }}</h4>
                            <ul>
                                <li><a href="{{ route('about-us') }}" class="text-white">{{ trans('labels.about') }}</a></li>
                                <li><a href="{{ route('ourteam') }}" class="text-white">{{ trans('labels.our_team') }}</a></li>
                                <li><a href="{{ route('testimonials') }}" class="text-white">{{ trans('labels.testimonials') }}</a></li>
                                <li><a href="{{ URL::to('/view-all?type=todayspecial') }}" class="text-white">{{ trans('labels.todays_special') }}</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-4 col-auto mb-2">
                            <h4>{{ trans('labels.legal') }}</h4>
                            <ul>
                                <li><a href="{{route('privacy-policy')}}" class="text-white">{{ trans('labels.privacy_policy') }}</a></li>
                                <li><a href="{{route('refund-policy')}}" class="text-white">{{ trans('labels.refund_policy') }}</a></li>
                                <li><a href="{{route('terms-conditions')}}" class="text-white">{{ trans('labels.terms_condition') }}</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-4 col-auto mb-2">
                            <h4>{{ trans('labels.other_pages') }}</h4>
                            <ul>
                                <li><a href="{{ route('faq') }}" class="text-white">{{ trans('labels.faq') }}</a></li>
                                <li><a href="{{ route('gallery') }}" class="text-white">{{ trans('labels.gallery') }}</a></li>
                                <li><a href="{{ route('contact-us') }}" class="text-white">{{ trans('labels.help_contact_us') }}</a></li>
                                <li><a href="{{ route('blogs') }}" class="text-white">{{ trans('labels.blogs') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <p class="text-white my-3 fs-7">{{Helper::appdata()->copyright }}</p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End here -->
