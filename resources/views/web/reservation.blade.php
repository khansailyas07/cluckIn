@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.book_table') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.book_table') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.book_table') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="book-table my-5">
        <div class="reservation-area">
            <div class="container">
                <form class="rounded-5" action="{{ URL::to('reservation/store') }}" method="POST">
                    @csrf
                    <div class="row mb-3 mt-4">
                        <div class="col-auto">
                            <p class="fs-2 fw-bold">{{ trans('labels.contact_details') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group mb-3">
                            <label for="reservation_name" class="form-label">{{ trans('labels.full_name') }}</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}"
                                id="reservation_name" placeholder="{{ trans('labels.full_name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="reservation_email" class="form-label">{{ trans('labels.email') }}</label>
                                <input class="form-control" type="email" name="email" value="{{ old('email') }}"
                                    id="reservation_email" placeholder="{{ trans('labels.email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="reservation_mobile" class="form-label">{{ trans('labels.mobile') }}</label>
                                <input class="form-control" type="tel" name="mobile" value="{{ old('mobile') }}"
                                    id="reservation_mobile" placeholder="{{ trans('labels.mobile') }}">
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="row mb-2 g-2">
                                <div class="col-md-3 mb-md-0 mb-3">
                                    <div class="form-group">
                                        <label for="reservation_date" class="form-label">{{ trans('labels.date') }}</label>
                                        <input class="form-control" type="date" name="date" min="<?php echo date('Y-m-d'); ?>"
                                            value="{{ old('date') }}" id="reservation_date">
                                        @error('date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-md-0 mb-3">
                                    <div class="form-group">
                                        <label for="reservation_time" class="form-label">{{ trans('labels.time') }}</label>
                                        <input class="form-control" type="time" name="time"
                                            value="{{ old('time') }}" id="reservation_time">
                                        @error('time')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-md-0 mb-3">
                                    <div class="form-group">
                                        <label for="reservation_guest"
                                            class="form-label">{{ trans('labels.number_guest') }}</label>
                                        <input class="form-control" type="text" name="guests"
                                            value="{{ old('guests') }}" id="reservation_guest"
                                            placeholder="{{ trans('labels.number_guest') }}">
                                        @error('guests')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mb-md-0 mb-3">
                                    <div class="form-group">
                                        <label for="reservation_type"
                                            class="form-label">{{ trans('labels.reservation_type') }}</label>
                                        <input class="form-control" type="text" name="reservation_type"
                                            value="{{ old('reservation_type') }}" id="reservation_type"
                                            placeholder="{{ trans('labels.reservation_type') }}">
                                        @error('reservation_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 my-3">
                            <div class="form-group">
                                <label for="special_request"
                                    class="form-label">{{ trans('labels.special_request') }}</label>
                                <textarea class="form-control" name="special_request" id="special_request"
                                    placeholder="{{ trans('labels.special_request_o') }}" rows="4">{{ old('special_request') }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center my-3">
                            <button type="submit" class="btn  px-md-5 py-md-3 btn-primary float-end">{{ trans('labels.submit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @include('web.subscribeform')
@endsection
