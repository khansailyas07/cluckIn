@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.our_team') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.our_team') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}"><a class="text-muted"
                                href="{{ URL::to('/') }}">{{ trans('labels.home') }}</a></li>
                        <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}"><a class="text-muted"
                                href="javascript:void(0)">{{ trans('labels.our_team') }}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="testimonials-wrapper">
            <div class="container">
                @if (count($getteams)>0)
                <div class="row my-5">
                    @foreach ($getteams as $teamdata)
                        <div class="col-lg-3 col-md-6 col-sm-12 d-flex mb-3">
                            <div class="review">
                                <img src="{{ $teamdata->image_url }}"
                                    class="img-circle img-responsive" />
                                <h4>{{ $teamdata->title }}</h4>
                                <h6>{{$teamdata->subtitle}}</h6>
                                <p><span class="text-primary">"</span>{{ Str::limit($teamdata->description, 58) }}<span
                                        class="text-primary">"</span></p>
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                @include('web.nodata')                    
                @endif
            </div>
        </div>
    </section>

    @include('web.subscribeform')
@endsection