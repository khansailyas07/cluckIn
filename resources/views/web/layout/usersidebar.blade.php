<div class="user-sidebar">
    <div class="user-info col-12 d-flex pb-4 mb-3">
    <div class="user-info d-xl-flex pb-4 mb-3">
        <div class="col-xl-3 col-12 mb-xl-0 mb-3">
            <div class="avatar-upload mx-auto d-flex justify-content-center">
                <div class="avatar-preview-two ">
                    <div id="imagepreview-two">
                        <img src="{{ Helper::image_path(Auth::user()->profile_image) }}" alt="" id="imgupload">
                    </div>
                </div>
            </div>
        </div>
        <div class="px-xl-3 col-12 d-flex align-items-center">
            <div class="col-12">
                <p class="mb-0 text-xl-start text-center">{{Auth::user()->name}}</p>
                <p class="mb-0 text-xl-start text-center">{{Auth::user()->email}}</p>
            </div>
        </div>
    </div>

    </div>
    <li>
        <a class="{{ request()->is('profile') ? 'active' : '' }}" href="{{ route('user-profile') }}">
            <i class="mx-2 fa-regular fa-user"></i>{{ trans('labels.my_profile') }} </a>
    </li>
    <li>
        <a class="{{ request()->is('orders*') ? 'active' : '' }}" href="{{ route('order-history') }}">
            <i class="mx-2 fa fa-list-check"></i>{{ trans('labels.my_orders') }} </a>
    </li>
    <li>
        <a class="{{ request()->is('favouritelist') ? 'active' : '' }}" href="{{ route('user-favouritelist') }}">
            <i class="mx-2 fa-regular fa-heart"></i>{{ trans('labels.favourite_list') }} </a>
    </li>
    <li>
        <a class="{{ request()->is('changepassword') ? 'active' : '' }}"
            href="{{ route('user-changepassword') }}">
            <i class="mx-2 fa fa-key"></i>{{ trans('labels.change_password') }} </a>
    </li>

    @if(Helper::appdata()->pickup_delivery != 3)
        <li>
            <a class="{{ request()->is('address*') ? 'active' : '' }}" href="{{ route('address') }}">
                <i class="mx-2 fa-regular fa-map"></i>{{ trans('labels.my_addresses') }} </a>
        </li>
    @endif 


    <li>
        <a class="{{ request()->is('wallet*') ? 'active' : '' }}" href="{{ route('user-wallet') }}">
            <i class="mx-2 fa-solid fa-wallet"></i>{{ trans('labels.my_wallet') }} </a>
    </li>
    <li>
        <a class="{{ request()->is('refer-earn') ? 'active' : '' }}" href="{{ route('refer-earn') }}">
            <i class="mx-2 fa-solid fa-share-nodes"></i>{{ trans('labels.refer_earn') }} </a>
    </li>
    <li>
        <a href="javascript:void(0)" onclick="logout('{{ route('logout') }}','{{ trans('messages.are_you_sure_logout') }}','{{ trans('labels.logout') }}')">
            <i class="mx-2 fa fa-arrow-right-from-bracket"></i>{{ trans('labels.logout') }} </a>
    </li>
</div>
