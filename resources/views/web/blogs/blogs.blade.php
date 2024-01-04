@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.blogs') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.blogs') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}"><a class="text-muted"
                                href="{{ URL::to('/') }}">{{ trans('labels.home') }}</a></li>
                        <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}"><a class="text-muted"
                                href="javascript:void(0)">{{ trans('labels.blogs') }}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="blog-wrapper">
            <div class="container">
                <div class="row">
                @if(count($getblogs) > 0)
                    @foreach ($getblogs as $bloglist)
                        @include('web.blogs.blogview')
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