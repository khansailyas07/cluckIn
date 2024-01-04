@extends('web.layout.default')
@section('content')
<section class="success">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-xxl-6 col-xl-7 col-lg-8">
                <div class="success-image">
                    <img src="{{ url(env('ASSETSPATHURL').'web-assets/images/success.gif')}}" alt="">
                </div>
                <div class="">
                    <h4 class="fw-600 mb-3">{{ trans('labels.order_placed') }}</h4>
                    <p>{{ trans('labels.order_success_desc') }}</p>
                </div>
                <div class="row gap-2 justify-content-center mt-3">
                    <div class="col-sm-auto col-12"><a href="{{ URL::to('/') }}" class="btn w-100 btn-dark px-4 py-2 text-capitalize">{{ trans('labels.continue_shopping') }}</a></div>
                    @if(\App\SystemAddons::where('unique_identifier', 'whatsapp_message')->first() != null && \App\SystemAddons::where('unique_identifier', 'whatsapp_message')->first()->activated == 1)
                        @if (whatsapp_helper::whatsapp_message_config()->order_created == 1)
                            @if (whatsapp_helper::whatsapp_message_config()->message_type == 2)
                                <div class="col-sm-auto col-12"><a href="https://api.whatsapp.com/send?phone={{ whatsapp_helper::whatsapp_message_config()->whatsapp_number }}&text={{ @$whmessage }}" target="_blank" class="btn w-100 btn-outline-primary px-4 py-2 text-capitalize">{{ trans('labels.send_order_on_whatsapp') }}</a></div>
                            @endif
                        @endif
                    @endif
                    <div class="col-sm-auto col-12"><a href="{{ URL::to('/orders-' . $orderdata->order_number) }}" class="btn w-100 btn-primary px-4 py-2 text-capitalize">{{ trans('labels.track_order') }}</a></div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection