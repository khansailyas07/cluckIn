@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.change_password') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.change_password') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.change_password') }}</li>
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
                    <div class="user-content-wrapper">
                        <p class="title">{{ trans('labels.change_password') }}</p>
                        <form action="{{ URL::to('/changepassword') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label ">{{ trans('labels.old_password') }}</label>
                                        <input type="password" class="form-control" name="old_password" placeholder="{{ trans('labels.old_password') }}" value="{{ old('old_password') }}">
                                        @error('old_password') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label ">{{ trans('labels.new_password') }}</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="{{ trans('labels.new_password') }}" value="{{ old('new_password') }}">
                                        @error('new_password') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="" class="form-label ">{{ trans('labels.confirm_password') }}</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="{{ trans('labels.confirm_password') }}" value="{{ old('confirm_password') }}">
                                        @error('confirm_password') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="col-12 {{ session()->get('direction') == '2' ? 'text-start' : 'text-end' }}">
                                    <button @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif class="btn btn-primary px-4 py-2">{{ trans('labels.reset') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('web.subscribeform')
@endsection
@section('scripts')
    <script>
        function myFunction() {
            "use strict";
            toastr.error("This operation was not performed due to demo mode");
        }
    </script>
@endsection