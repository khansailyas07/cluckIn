@extends('web.layout.default')
@section('page_title')
| {{ trans('labels.help_contact_us') }}
@endsection
@section('content')
<div class="breadcrumb-sec">
    <div class="container">
        <div class="breadcrumb-sec-content">
            <h1>{{ trans('labels.help_contact_us') }}</h1>
            <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li
                        class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                        <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                    </li>
                    <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                        aria-current="page">{{ trans('labels.help_contact_us') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Contact us Section Start Here -->
<section>
    <div class="contact-us">
        <div class="container">
            <div class="contact-content">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-auto right-side">
                        <form method="POST" class="p-5" action="{{ route('createcontact') }}">
                            @csrf
                            <div class="row">
                                <p class="fs-2 fw-bold">{{ trans('labels.contactus_heading') }}</p>
                                <span class="text-muted">{{ trans('labels.contactus_description') }}</span>
                            </div>
                            <div class="mb-3 mt-5 form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="fname"
                                            placeholder="{{ trans('messages.first_name') }}">
                                        @error('fname') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="lname"
                                            placeholder="{{ trans('messages.last_name') }}">
                                        @error('lname') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 form-group">
                                <input type="email" class="form-control" name="email"
                                    placeholder="{{ trans('labels.email') }}">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="mb-3 form-group">
                                <textarea class="form-control" rows="2" name="message"
                                    placeholder="{{ trans('labels.message') }}"></textarea>
                                @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-12 d-inline-block">
                                <button type="submit" class="btn px-4 py-2 btn-primary float-end">{{
                                    trans('labels.save') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 col-sm-12 col-auto p-3 left-side">
                        <div class="col-12 my-1">
                            <div class="card border-0  rounded-3 p-3 h-100 ">
                                <h2 class="fw-bold">Get in Touch</h2>                                
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-6 col-sm-6 my-1">
                            <div class="card border-0  rounded-3 p-3 h-100">
                                <h5> <i class="fa-solid fa-location-dot pe-2"></i>{{ trans('labels.address') }}</h5>
                                <a href="javascript:void(0)">{{@Helper::appdata()->address }}</a>
                            </div>
                        </div>
                        <div class="row mb-4 ">
                            <div class="col-xl-6 col-lg-6 col-sm-6 my-1">
                                <div class="card border-0  rounded-3 p-3 h-100">
                                    <h5> <i class="fa-solid fa-envelope pe-2"></i>{{ trans('labels.email') }}</h5>
                                    <a href="mailto:{{@Helper::appdata()->email }}"
                                    class=" text-break">{{@Helper::appdata()->email }}</a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-sm-6 my-1">
                                <div class="card border-0  rounded-3 p-3 h-100 ">
                                    <h5> <i class="fa-solid fa-phone pe-2"></i>{{ trans('labels.mobile') }}</h5>
                                <a href="tel:{{@Helper::appdata()->mobile }}"
                                    class="text-break">{{@Helper::appdata()->mobile }}</a>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-6 col-sm-6 my-1">
                                <div class="card border-0  rounded-3 p-3 h-100">
                                    <h5> <i class="fa-solid fa-clock pe-2"></i>{{ trans('labels.working_hours') }}  </h5>
                                    <h5 class="text-muted">{{ ucfirst($timedata->day) }} <span
                                        class="cursor-pointer" data-bs-toggle="modal"
                                        data-bs-target="#modal_working_hours"><i
                                            class="fa-solid fa-circle-info fs-6 text-dark"></i></span></h5>
                                    <p>{{ $timedata->open_time }} <b>{{ trans('labels.to') }}</b> {{ $timedata->break_start
                                        }}</p>
                                    <p>{{ $timedata->break_end }} <b>{{ trans('labels.to') }}</b> {{ $timedata->close_time
                                        }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- MODAL_working_hours--START -->
<div class="modal fade" id="modal_working_hours" tabindex="-1" aria-labelledby="working_hours_Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="working_hours_Label">{{ trans('labels.working_hours') }}</h5>
                <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    @foreach ($gettimings as $time)
                    <li class="list-group-item d-flex justify-content-between"> {{ ucfirst($time->day) }}
                        <span>{{$time->open_time}} {{ trans('labels.to') }} {{$time->break_start}} <br>
                            {{$time->break_end}} {{ trans('labels.to') }} {{$time->close_time}}</span></li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger px-4 py-2" data-bs-dismiss="modal">{{ trans('labels.close')
                    }}</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL_working_hours--END -->
<!-- Contact us Section End Here -->

@include('web.subscribeform')

@endsection