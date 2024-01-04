@extends('web.layout.default')
@section('page_title')
    | {{ @$getitemdata->item_name }}
@endsection
@section('content')
<div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('item details') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('item details') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
    <section class="mt-5">
        <div class="container">
            <div class="item-details">
                @if (!empty($getitemdata))
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="item-img-cover">
                                <div class="item-img show">
                                    @if(count(@$getitemdata['item_images']) > 0)
                                        @foreach ($getitemdata['item_images'] as $key => $firstimage)
                                            <img data-enlargable src="{{$firstimage->image_url}}" alt="item-image"
                                                id="show-img">
                                            @php
                                                $image_name = $firstimage->image_name != null ? $firstimage->image_name : 'item_default.png' ;
                                                if ($key == 0) {
                                                    break;
                                                }
                                            @endphp
                                        @endforeach
                                    @else
                                         <img data-enlargable src="{{ @Helper::image_path('item_default.png')}}" alt="item-image" id="show-img">
                                            @php
                                                $image_name = 'item_default.png';
                                            @endphp
                                    @endif
                                </div>
                            </div>
                            @if (count(@$getitemdata['item_images']) > 1)
                                <div class="row gx-0 justify-content-center" dir="ltr">
                                    <div class="small-img">
                                        <img src="{{ Helper::web_image_path('nexticon.png') }}" class="icon-left"
                                            alt="" id="prev-img">
                                        <div class="small-container">
                                            <div id="small-img-roll">
                                                @foreach (@$getitemdata['item_images'] as $key => $itemimage)
                                                    <img src="{{ $itemimage->image_url }}" class="show-small-img"
                                                        alt="">
                                                @endforeach
                                            </div>
                                        </div>
                                        <img src="{{ Helper::web_image_path('nexticon.png') }}" class="icon-right"
                                            alt="" id="next-img">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-12 my-2">
                            <div class="item-content">
                                <div class="row justify-content-between my-3">
                                    <div class="col-auto">
                                        <span
                                            class="py-1 px-2 mb-2 cat-name">{{ $getitemdata['category_info']->category_name }}</span>
                                    </div>
                                    <div class="col-auto">
                                        @if ($getitemdata->tax > 0)
                                            <span class="text-danger float-end">+ {{ $getitemdata->tax }}%
                                                {{ trans('labels.additional_taxes') }}</span>
                                        @else
                                            <span
                                                class="text-danger float-end">{{ trans('labels.inclusive_taxes') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="item-heading">
                                    <div class="d-flex align-items-center">
                                        <img class="col-1" @if ($getitemdata->item_type == 1) src="{{ Helper::image_path('veg.svg') }}" @else src="{{ Helper::image_path('nonveg.svg') }}" @endif
                                            alt="">
                                        <span class="item-title fs-5 fw-bold col-11 {{ session()->get('direction') == '2' ? 'me-2' : 'ms-2' }}">{{ $getitemdata->item_name }}</span>
                                    </div>
                                </div>
                                
                                <div class="row pb-2 mb-3 border-bottom align-items-center">
                                    @php
                                        if ($getitemdata->has_variation == 1) {
                                            foreach ($getitemdata['variation'] as $key => $value) {
                                                $price = $value->product_price;
                                                if ($key == 0) {
                                                    break;
                                                }
                                            }
                                        } else {
                                            $price = $getitemdata->price;
                                        }
                                    @endphp
                                    <p class="item-price item_price m-0 green_color my-2">{{ Helper::currency_format($price) }}</p>
                                </div>
                                @if (!empty($getitemdata->item_description))
                                    <div class="row mt-2 border-bottom">
                                        <div class="col-auto">
                                            <div class="item-description">
                                                <h5 class="fw-bold">{{ trans('labels.description') }}</h5>
                                                <p class="text-justify pb-2">{!! $getitemdata->item_description !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($getitemdata->has_variation == 1 || $getitemdata->addons_id != '')
                                    <div class="row pb-3 mb-3 mt-2 border-bottom">
                                        @if ($getitemdata->has_variation == 1)
                                            <div class="col-md-6 item-detail-wrapper pt-2" id="style-3">
                                                <div class="item-variation-list">
                                                    <h5 class="dark_color fw-bold">{{ $getitemdata->attribute }}</h5>
                                                    @foreach ($getitemdata['variation'] as $key => $value)
                                                        <div class="form-check {{ session()->get('direction') == '2' ? 'd-flex' : '' }}">
                                                            <input class="form-check-input cursor-pointer {{ session()->get('direction') == '2' ? 'ms-0' : '' }}" type="radio"
                                                                data-variation-id="{{ $value->id }}"
                                                                data-variation-name="{{ $value->variation }}"
                                                                data-variation-price="{{ $value->product_price }}"
                                                                name="variation"
                                                                id="variation-{{ $key }}-{{ $value->id }}"
                                                                value="{{ $value->variation }}"
                                                                onchange="getvaraitions(this)"
                                                                {{ $key == 0 ? 'checked' : '' }}>
                                                            <label class="form-check-label cursor-pointer me-3"
                                                                for="variation-{{ $key }}-{{ $value->id }}">{{ $value->variation }}
                                                                : <span
                                                                    class="text-muted">{{ Helper::currency_format($value->product_price) }}</span></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        @if (!empty($getitemdata->addons) && count($getitemdata->addons) > 0)
                                            <div class="col-md-6 item-detail-wrapper pt-2" id="style-3">
                                                <div class="item-variation-list">
                                                    <h5 class="dark_color fw-bold">{{ trans('labels.addons') }}</h5>
                                                    @foreach ($getitemdata->addons as $addonsdata)
                                                        <div class="form-check {{ session()->get('direction') == '2' ? 'd-flex' : '' }}">
                                                            <input class="form-check-input cursor-pointer addons-checkbox {{ session()->get('direction') == '2' ? 'ms-0' : '' }}"
                                                                type="checkbox" value="{{ $addonsdata->id }}'"
                                                                data-addons-id="{{ $addonsdata->id }}"
                                                                data-addons-price="{{ $addonsdata->price }}"
                                                                data-addons-name="{{ $addonsdata->name }}"
                                                                onclick="getaddons(this)"
                                                                id="addons{{ $addonsdata->id }}">
                                                            <label class="form-check-label cursor-pointer me-3"
                                                                for="addons{{ $addonsdata->id }}">{{ $addonsdata->name }}
                                                                : <span
                                                                    class="text-muted">{{ Helper::currency_format($addonsdata->price) }}</span></label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                <!-- <br> slug -->
                                <input type="hidden" name="slug" id="slug" value="{{ $getitemdata->slug }}">
                                <!-- <br> item_name -->
                                <input type="hidden" name="item_name" id="item_name"
                                    value="{{ $getitemdata->item_name }}">
                                <!-- <br> item_type -->
                                <input type="hidden" name="item_type" id="item_type"
                                    value="{{ $getitemdata->item_type }}">
                                <!-- <br> image_name -->
                                <input type="hidden" name="image_name" id="image_name" value="{{ $image_name }}">
                                <!-- <br> tax -->
                                <input type="hidden" name="tax" id="item_tax" value="{{ $getitemdata->tax }}">
                                <!-- <br> item_price -->
                                <input type="hidden" name="item_price" id="item_price" value="{{ $price }}">
                                <!-- <br> addonstotal -->
                                <input type="hidden" name="addonstotal" id="addonstotal" value="0">
                                <!-- <br> subtotal -->
                                <input type="hidden" name="subtotal" id="subtotal" value="{{ $price }}">
                                <div class="row justify-content-center mt-3">
                                    <div class="col-auto">
                                        <div class="wishlist">
                                            @if ($getitemdata->is_favorite == 1)
                                                <a class="btn py-2 px-4 wishlist-btn text-primary fs-7 border-primary"
                                                    @if (Auth::user() && Auth::user()->type == 2) href="javascript:void(0)" onclick="managefavorite('{{ $getitemdata->id }}',0,'{{ URL::to('/managefavorite') }}')" @else href="{{ URL::to('/login') }}" @endif>{{ trans('labels.remove_wishlist') }}
                                                </a>
                                            @else
                                                <a class="btn px-4 py-2 fs-7 wishlist-btn bg-white text-primary rounded-2 border-primary"
                                                    @if (Auth::user() && Auth::user()->type == 2) href="javascript:void(0)" onclick="managefavorite('{{ $getitemdata->id }}',1,'{{ URL::to('/managefavorite') }}')" @else href="{{ URL::to('/login') }}" @endif>{{ trans('labels.add_wishlist') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        
                                            <a class="btn text-white bg-primary px-4 py-2 m-0 fs-7"
                                                onclick="addtocart('{{ URL::to('addtocart') }}')">{{ trans('labels.add_to_cart') }}</a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    @include('web.nodata')
                @endif
            </div>
        </div>
    </section>
    <!-- RELATED PRODUCTS Section Start Here -->
    @if (count($getrelateditems) > 0)
        <section class="menu p-5 bg-section-gray m-0">
            <div class="container">
                <div class="row align-items-center justify-content-between my-2 px-2">
                    <div class="col-auto menu-heading p-1">
                        <h2 class="text-capitalize fs-2 fw-bold">{{ trans('labels.related_items') }}</h2>
                    </div>
                    <div class="col-auto px-1 pb-2"><a
                            href="{{ URL::to('menu?category=' . $getitemdata['category_info']->slug) }}"
                            class="btn btn-sm btn-outline-primary px-4 py-2">{{ trans('labels.view_all') }}</a></div>
                </div>
                <div class="row">
                    @foreach ($getrelateditems as $itemdata)
                        @include('web.home1.itemview')
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- RELATED PRODUCTS Section End Here -->
@endsection
@section('scripts')
    <script src="{{url(env('ASSETSPATHURL').'web-assets/js/item-image-carousel/main.js') }}"></script>
    <script src="{{url(env('ASSETSPATHURL').'web-assets/js/item-image-carousel/zoom-image.js') }}"></script>
@endsection
