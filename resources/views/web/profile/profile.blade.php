@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.my_profile') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.my_profile') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.my_profile') }}</li>
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
                <div class="col-lg-9">
                    <div class="user-content-wrapper h-100">
                        <p class="title text-center text-md-start">{{ trans('labels.my_profile') }}</p>
                        <form action="{{URL::to('/profile/update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-3 mb-3">
                                    <div class="avatar-upload mx-auto">
                                        <div class="avatar-edit {{ session()->get('direction') == '2' ? 'avatar-edit-rtl' : '' }}">
                                            <input type='file' name="profile_image" id="imageupload" accept=".png, .jpg, .jpeg" />
                                            <label for="imageupload"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagepreview">
                                                <img src="{{ Helper::image_path(Auth::user()->profile_image) }}" alt="" id="imgupload">
                                            </div>
                                        </div>
                                    </div>
                                    @error('profile_image') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label mb-2">{{ trans('labels.full_name') }}</label>
                                        <input type="text" class="form-control" name="name" placeholder="{{trans('labels.full_name')}}" value="{{Auth::user()->name}}">
                                        @error('name') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label mb-2">{{ trans('labels.email') }}</label>
                                                <input type="email" class="form-control" name="email" placeholder="{{trans('labels.email')}}" value="{{Auth::user()->email}}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="" class="form-label mb-2">{{ trans('labels.mobile') }}</label>
                                                <input type="text" class="form-control" name="mobile" placeholder="{{trans('labels.mobile')}}" value="{{Auth::user()->mobile}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 {{ session()->get('direction') == '2' ? 'text-start' : 'text-end' }}">
                                    <button class="btn btn-primary px-4 py-2" @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <p class="title">{{ trans('labels.alert_settings') }}</p>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 fw-bold">@if(\App\SystemAddons::where('unique_identifier', 'otp')->first() != null && \App\SystemAddons::where('unique_identifier', 'otp')->first()->activated = 1)
                                            {{ trans('labels.mobile') }}
                                            
                                        @else
                                        {{ trans('labels.email') }}
                                        @endif
                                       </h6>
                                        <span>
                                            <input type="checkbox" class="checkbox-switch" id="send_email-switch" data-url="{{ URL::to('/profile/send-email-status') }}" name="send_email" {{ Auth::user()->is_mail == 1 ? 'checked' : '' }} >
                                            <label for="send_email-switch" class="switch">
                                                <span class="{{ session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle' }}"><span class="switch__circle-inner"></span></span>
                                                <span class="{{ session()->get('direction') == '2' ? 'switch__right pe-2' : 'switch__left ps-2' }}">{{ trans('labels.off') }}</span>
                                                <span class="{{ session()->get('direction') == '2' ? 'switch__left ps-2' : 'switch__right pe-2' }}">{{ trans('labels.on') }}</span>
                                            </label>
                                        </span>
                                    </li>
                                    <li class="list-group-item px-0">
                                        <small>
                                        @if(\App\SystemAddons::where('unique_identifier', 'otp')->first() != null && \App\SystemAddons::where('unique_identifier', 'otp')->first()->activated = 1)
                                        
                                        {{ trans('labels.keep_on_recieve_mobile') }} 
                                        
                                        @else

                                        {{ trans('labels.keep_on_recieve_email') }} 

                                        @endif
                                    </small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('web.subscribeform')
@endsection
@section('scripts')
<script src="{{url(env('ASSETSPATHURL').'web-assets/js/custom/profile.js')}}"></script>
@endsection
