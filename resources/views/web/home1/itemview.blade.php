<div class="col-xl-3 col-lg-4 col-sm-6 col-xs-auto mb-3">
    <div class="card rounded">
        <a href="{{ URL::to('item-' . $itemdata->slug) }}">
            <div class="card-image">
                <img src="@if(@$itemdata['item_image']->image_url != null) {{ @$itemdata['item_image']->image_url }} @else {{ @Helper::image_path('item_default.png')}} @endif"
                    class="card-img-top border-0 rounded-0 rounded-top position-relative" alt="dishes">
            </div>
            <div class="card-body pb-0">
                <div class="cat-name py-1 mb-2 col-lg-3 col-sm-4 col-3 text-center"><span>{{ $itemdata['category_info']->category_name }}</span></div>
                <h5 class="item-card-title pb-3 fs-6 border-bottom">
                    @if ($itemdata->item_type == 1)
                        <img src="{{ Helper::image_path('veg.svg') }}" alt="" class=" {{session()->get('direction') == "rtl" ? 'ms-1' : 'me-1'}}">
                    @else
                        <img src="{{ Helper::image_path('nonveg.svg') }}" alt="" class="{{session()->get('direction') == "rtl" ? 'ms-1' : 'me-1'}}">
                    @endif
                    {{ $itemdata->item_name }}
                </h5>
            </div>
        </a>
        <div class="img-overlay set-fav-{{ $itemdata->id }}">
            @if(Auth::user() && Auth::user()->type == 2)

                @if ($itemdata->is_favorite == 1)
                    <a class="heart-icon p-2 btn btn-wishlist"
                         href="javascript:void(0)" onclick="managefavorite('{{ $itemdata->id }}',0,'{{ URL::to('/managefavorite') }}','{{request()->url()}}')" title="{{ trans('labels.remove_wishlist') }}">
                        <i class="fa-solid fa-heart fs-5"></i> </a>
                @else
                    <a class="heart-icon p-2 btn btn-wishlist"
                        href="javascript:void(0)" onclick="managefavorite('{{ $itemdata->id }}',1,'{{ URL::to('/managefavorite') }}','{{request()->url()}}')" title="{{ trans('labels.add_wishlist') }}">
                        <i class="fa-regular fa-heart fs-5"></i> </a>
                @endif
            @endif    
        </div>
        <div class="item-card-footer">
            <div class="d-flex justify-content-between align-items-center">
                @php
             
                    if ($itemdata->has_variation == 1) {
                        
                        foreach ($itemdata['variation'] as $key => $value) {
                         
                            $price = $value->product_price;
                            if ($key == 0) {
                                break;
                            }
                        }
                    } else {
                        $price = $itemdata->item_price;
                    }

                    $image = (@$itemdata['item_image']->image_name != null) ? @$itemdata['item_image']->image_name : 'item_default.png';

                

                @endphp
                <span class="green_color">{{ Helper::currency_format($price) }}</span>
                @if ($itemdata->is_cart == 1)
                        <div class="item-quantity py-1 px-5">
                            <button type="button" class="btn btn-sm  fw-500" onclick="removefromcart('{{ URL::to('/cart') }}','{{ trans('messages.remove_cartitem_note') }}','{{ trans('labels.goto_cart') }}')">-</button>
                            <input class="fw-500 item-total-qty-{{$itemdata->slug}}" type="text" value="{{ Helper::get_item_cart($itemdata->id) }}" disabled/>
                            @if ($itemdata->addons_id != '' || count($itemdata->variation) > 0)
                                <a class="btn btn-sm fw-500" onclick="showitem('{{ $itemdata->slug }}','{{ URL::to('/show-item') }}')">+</a>
                            @else
                                <a class="btn btn-sm fw-500" onclick="calladdtocart('{{ $itemdata->slug }}','{{ $itemdata->item_name }}','{{ $itemdata->item_type }}','{{ $image }}','{{ $itemdata->tax }}','{{ $itemdata->price }}','','','','','','{{ URL::to('addtocart') }}')">+</a>
                            @endif
                        </div>
                    @else
                        @if ($itemdata->addons_id != '' || count($itemdata->variation) > 0)
                        <a class="btn btn-sm btn-dark fw-500 py-2 px-4 float-end"
                            onclick="showitem('{{ $itemdata->slug }}','{{ URL::to('/show-item') }}')">{{ trans('labels.add') }} <i class="fa-solid fa-plus"></i></a>
                        @else
                            <a class="btn btn-sm btn-dark fw-500 py-2 px-4 float-end"
                                onclick="calladdtocart('{{ $itemdata->slug }}','{{ $itemdata->item_name }}','{{ $itemdata->item_type }}','{{ $image }}','{{ $itemdata->tax }}','{{ $itemdata->price }}','','','','','','{{ URL::to('addtocart') }}')">{{ trans('labels.add') }} <i class="fa-solid fa-plus"></i> </a>
                        @endif
                    @endif
            </div>
        </div>
    </div>
</div>
