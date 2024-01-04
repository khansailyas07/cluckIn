@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.favourite_list') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.favourite_list') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.favourite_list') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="container my-5 favourite">
            <div class="row">
                <div class="col-lg-3">
                    @include('web.layout.usersidebar')
                </div>
                <div class="col-lg-9 d-flex">
                    <div class="user-content-wrapper">
                        <p class="title">{{ trans('labels.favourite_list') }}</p>
                        @if (count($getfavoritelist) > 0)
                            <div class="table-responsive border-1">
                                <table class="table table-striped table-hover favouritelist">
                                    @foreach ($getfavoritelist as $itemdata)
                                        <tr>
                                            <td class="item-image">
                                                <img src="{{ $itemdata['item_image']->image_url }}" class="hw-100">
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <span
                                                        class="fs-8 py-1 px-2 cat-name">{{ $itemdata['category_info']->category_name }}
                                                    </span>
                                                    @if ($itemdata->is_favorite == 1)
                                                        <a class="heart-icon heart-red {{ session()->get('direction') == '2' ? 'text-start' : 'text-end' }}"
                                                            @if (Auth::user() && Auth::user()->type == 2) href="javascript:void(0)" onclick="managefavorite('{{ $itemdata->id }}',0,'{{ URL::to('/managefavorite') }}')" title="{{ trans('labels.remove_wishlist') }}" @else href="{{ URL::to('/login') }}" @endif>
                                                            <i class="fa-solid fa-heart fs-5"></i> </a>
                                                    @else
                                                        <a class="heart-icon {{ session()->get('direction') == '2' ? 'text-start' : 'text-end' }}"
                                                            @if (Auth::user() && Auth::user()->type == 2) href="javascript:void(0)" onclick="managefavorite('{{ $itemdata->id }}',1,'{{ URL::to('/managefavorite') }}')" title="{{ trans('labels.add_wishlist') }}" @else href="{{ URL::to('/login') }}" @endif>
                                                            <i class="fa-regular fa-heart fs-5"></i> </a>
                                                    @endif
                                                </div>
                                                <div class="item-title mt-2">
                                                    <a href="{{ URL::to('item-' . $itemdata->slug) }}"
                                                        class="fw-500 dark_color text-break">
                                                        @if ($itemdata->item_type == 1)
                                                            <img src="{{ Helper::image_path('veg.svg') }}" class="me-1"
                                                                alt="">
                                                        @else
                                                            <img src="{{ Helper::image_path('nonveg.svg') }}"
                                                                class="me-1" alt="">
                                                        @endif
                                                        {{ $itemdata->item_name }}
                                                    </a>
                                                     
                                                </div>
                                                <div class="row align-items-center justify-content-between gx-0">
                                                    <div class="col-auto">
                                                        @php
                                                            if ($itemdata->has_variation == 1) {
                                                                foreach ($itemdata['variation'] as $key => $value) {
                                                                    $price = $value->product_price;
                                                                    if ($key == 0) {
                                                                        break;
                                                                    }
                                                                }
                                                            } else {
                                                                $price = $itemdata->price;
                                                            }
                                                        @endphp
                                                        <div class="fw-bold green_color">{{ Helper::currency_format($price) }}</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        
                                                            @if ($itemdata->is_cart == 1)
                                                                <div class="item-quantity px-5 py-1">
                                                                    <button class="btn btn-sm fw-500"
                                                                        onclick="removefromcart('{{ URL::to('/cart') }}','{{ trans('messages.remove_cartitem_note') }}','{{ trans('labels.goto_cart') }}')">-</button>
                                                                    <input
                                                                        class="fw-500 item-total-qty-{{ $itemdata->slug }}"
                                                                        type="text"
                                                                        value="{{ Helper::get_item_cart($itemdata->id) }}"
                                                                        disabled />
                                                                    @if ($itemdata->addons_id != '' || count($itemdata->variation) > 0)
                                                                        <a class="btn btn-sm fw-500"
                                                                            onclick="showitem('{{ $itemdata->slug }}','{{ URL::to('/show-item') }}')">+</a>
                                                                    @else
                                                                        <a class="btn btn-sm  fw-500"
                                                                            onclick="calladdtocart('{{ $itemdata->slug }}','{{ $itemdata->item_name }}','{{ $itemdata->item_type }}','{{ $itemdata['item_image']->image_name }}','{{ $itemdata->tax }}','{{ $itemdata->price }}','','','','','','{{ URL::to('addtocart') }}')">+</a>
                                                                    @endif
                                                                </div>
                                                            @else
                                                                @if ($itemdata->addons_id != '' || count($itemdata->variation) > 0)
                                                                    <a class="btn btn-sm border btn-dark py-2 px-4 fw-500 fs-7 text-end"
                                                                        onclick="showitem('{{ $itemdata->slug }}','{{ URL::to('/show-item') }}')">{{ trans('labels.add') }} <i class="fa-solid fa-plus"></i></a>
                                                                @else
                                                                    <a class="btn btn-sm border btn-dark py-2 px-4 fw-500 fs-7 text-end"
                                                                        onclick="calladdtocart('{{ $itemdata->slug }}','{{ $itemdata->item_name }}','{{ $itemdata->item_type }}','{{ $itemdata['item_image']->image_name }}','{{ $itemdata->tax }}','{{ $itemdata->price }}','','','','','','{{ URL::to('addtocart') }}')">{{ trans('labels.add') }} <i class="fa-solid fa-plus"></i></a>
                                                                @endif
                                                            @endif
                                                        
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="mt-2 d-flex justify-content-center">
                                {{ $getfavoritelist->links() }}
                            </div>
                        @else
                            <div class="my-5 py-5">
                             @include('web.nodata')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('web.subscribeform')
@endsection
