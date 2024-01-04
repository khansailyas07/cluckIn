@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.my_addresses') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.my_addresses') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.my_addresses') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="container my-5">
            <div class="row">
                <div class="col-lg-3 d-flex">
                    @include('web.layout.usersidebar')
                </div>
                <div class="col-lg-9 d-flex">
                    <div class="user-content-wrapper">
                        <div class="row justify-content-between my-3">
                            <p class="col-auto mb-0 title">{{ trans('labels.my_addresses') }}</p>
                            <a href="{{route('add-address')}}" class="col-auto py-2 px-4 mx-3 mt-sm-0 mt-2 text-capitalize bg-primary text-white btn btn-sm d-flex align-items-center">{{ trans('labels.add_new_address') }} <i class="fa-solid fa-plus px-2"></i></a>
                        </div>
                        @if (count($getaddresses)>0)
                        <div class="row address-list">
                            @foreach ($getaddresses as $addressdata)
                                <div class="col-md-6 d-flex">
                                    <div class="address-card w-100">
                                        <div class="col-2 address-icon">
                                            @if ($addressdata->address_type == 1)
                                                <i class="fa-solid fa-house-chimney"></i>
                                                @php $address_type_text = trans('labels.home'); @endphp
                                            @elseif ($addressdata->address_type == 2)
                                                <i class="fa-solid fa-briefcase"></i>
                                                @php $address_type_text = trans('labels.office'); @endphp
                                            @else
                                                <i class="fa-solid fa-map-location-dot"></i>
                                                @php $address_type_text = trans('labels.other'); @endphp
                                            @endif
                                        </div>
                                        <div class="col-10 address">
                                            <h4 class="d-flex justify-content-between">{{ $address_type_text }}
                                                <div class="px-3">
                                                    <a class="text-danger mx-1" href="javascript:void(0)" onclick="deleteaddress('{{ $addressdata->id }}','{{ URL::to('/address/delete') }} ') "><i class="fa-solid fa-trash-can"></i></a>
                                                    <a class="text-info mx-1" href="{{URL::to('/address-'.$addressdata->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                                </div>
                                            </h4>
                                            <p class="mb-1">{{ $addressdata->address }} </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @else
                            @include('web.nodata')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('web.subscribeform')
@endsection
@section('scripts')
<script src="{{url(env('ASSETSPATHURL').'web-assets/js/custom/address.js')}}"></script>
@endsection
