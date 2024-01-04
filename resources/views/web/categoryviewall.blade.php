@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.categories') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.categories') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ URL::to('/') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }} active">
                            {{ trans('labels.categories') }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mb-3 mt-5">
            @foreach (Helper::get_categories() as $categorydata)
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3 ">
                    <div class="category-wrapper mx-2">
                        <a href="{{ URL::to('/menu/?category=' . $categorydata->slug) }}">
                            <div class="cat rounded-circle mx-auto">
                                <img src="{{ Helper::image_path($categorydata->image) }}" class="rounded-circle"
                                    alt="category">
                            </div>
                        </a>
                        <p class="my-2 text-center">{{ $categorydata->category_name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('web.subscribeform')
@endsection
