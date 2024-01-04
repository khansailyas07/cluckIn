@extends('web.layout.default')
<link rel="stylesheet" href="{{url(env('ASSETSPATHURL').'web-assets/css/fancybox/fancybox-v4-0-27.css') }}"><!-- Fancybox 4.0 CSS -->
@section('page_title')
    | {{ trans('labels.gallery') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.gallery') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ URL::to('/') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.gallery') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="container my-5">
            @if (count($getgalleries)>0)    
            <div id="galleryimg">
                @foreach ($getgalleries as $image)
                    <div data-src="{{ $image->image_url }}" data-fancybox="gallery" data-thumb="{{ $image->image_url }}">
                        <img src="{{ $image->image_url }}" width="200" height="150" />
                      </div>
                @endforeach
            </div>
            @else
                @include('web.nodata')
            @endif
        </div>
    </section>

   @include('web.subscribeform')

@endsection
@section('scripts')
    <script src="{{url(env('ASSETSPATHURL').'web-assets/js/fancybox/fancybox-v4-0-27.js') }}"></script><!-- Fancybox 4.0 JS -->
@endsection
