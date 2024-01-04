@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.menu') }} | {{ @$categorydata->category_name }}
@endsection
@section('content')
    @if (!empty($categorydata))
        <div class="breadcrumb-sec mb-3">
            <div class="container">
                <div class="breadcrumb-sec-content">
                    <h1>{{ @$categorydata->category_name }}</h1>
                    <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li
                                class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                                <a class="text-muted" href="{{ URL::to('/') }}">{{ trans('labels.home') }}</a>
                            </li>
                            <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                                aria-current="page">{{ @$categorydata->category_name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="menu-section">
            <div class="container">
                <div class="row">
                    <div class="filter-sidebar mb-3">
                        <div class="sidebar-wrap" id="style-3">
                            @if (count($subcategories) > 0 || count($getitemlist) > 0 )
                            <a href="{{ URL::to('/menu?category='.$categorydata->slug) }}"
                                class="@if(!isset($_GET['subcategory'])) active @endif">{{ trans('labels.all') }}</a>
                            @endif
                            @foreach ($subcategories as $key => $subcatdata)
                                <a href="{{ URL::to('/menu?category=' . $categorydata->slug . '&subcategory=' . $subcatdata->slug) }}"
                                    class="@if(isset($_GET['subcategory']) && $_GET['subcategory'] == $subcatdata->slug) active @endif">{{ ucfirst($subcatdata->subcategory_name) }}</a>
                            @endforeach
                        </div>
                    </div>
                    @if (count($getitemlist) > 0)
                        <div class="menu my-0">
                            <div class="row boxes">
                                @foreach ($getitemlist as $itemdata)
                                    @include('web.home1.itemview')
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-5 d-flex justify-content-center">
                            {{ $getitemlist->appends(request()->query())->links() }}
                        </div>
                    @else
                        @include('web.nodata')
                    @endif
                </div>
            </div>
        </section>
        @include('web.subscribeform')
    @else  
        @include('web.nodata')
    @endif
@endsection
