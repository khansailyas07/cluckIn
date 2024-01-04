@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.view_all') }}
@endsection
@section('content')
    @if (isset($_GET['type']) && $_GET['type'] != '')
        <div class="breadcrumb-sec">
            <div class="container">
                <div class="breadcrumb-sec-content">
                    @php
                        $type = $_GET['type'];
                        if ($_GET['type'] == 'topitems') {
                            $title = trans('labels.trending');
                        } elseif ($_GET['type'] == 'todayspecial') {
                            $title = trans('labels.todays_special');
                        } elseif ($_GET['type'] == 'recommended') {
                            $title = trans('labels.recommended');
                        } else {
                            $title = '';
                        }
                    @endphp
                    <h1>{{ $title }}</h1>
                    <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ URL::to('/') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page"> {{ $title }}</li>
                    </ol>
                </nav>
                </div>
            </div>
        </div>
        <div class="container my-5">
            <div class="menu-section menu-section-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="sub-cat-tab food-type w-100  d-flex justify-content-end">
                        <nav class="nav nav-pills justify-content-center veg align-items-baseline">
                            <a class="nav-link px-3 mx-2 @if (isset($_GET['filter']) && $_GET['filter'] == 'veg') active-cat @else border @endif"
                                @if (isset($_GET['filter']) && $_GET['filter'] == 'veg') href="{{ URL::to('/view-all?type=' . @$type) }}"
                                @else
                                    href="{{ URL::to('/view-all?type=' . @$type . '&filter=veg') }}" @endif>
                                <img src="{{ Helper::image_path('veg.svg') }}" class="pe-1"
                                    alt="">{{ trans('labels.veg') }}
                            </a>
                            <a class="nav-link px-3 mx-2 @if (isset($_GET['filter']) && $_GET['filter'] == 'nonveg') active-cat @else border @endif"
                                @if (isset($_GET['filter']) && $_GET['filter'] == 'nonveg') href="{{ URL::to('/view-all?type=' . @$type) }}"
                                @else
                                    href="{{ URL::to('/view-all?type=' . @$type . '&filter=nonveg') }}" @endif>
                                <img src="{{ Helper::image_path('nonveg.svg') }}" class="pe-1"
                                    alt="">{{ trans('labels.nonveg') }}
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="container my-5">
        <div class="row mb-5">
            <div class="menu my-0">
                @if (count($getsearchitems) > 0)
                    <div class="row">
                        @foreach ($getsearchitems as $itemdata)
                            @include('web.home1.itemview')
                        @endforeach
                    </div>
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $getsearchitems->appends(request()->query())->links() }}
                    </div>
                @else
                    @include('web.nodata')
                @endif
            </div>
        </div>
    </div>

    @include('web.subscribeform')
    
@endsection
