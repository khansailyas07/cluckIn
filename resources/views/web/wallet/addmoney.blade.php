@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.add_money') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.add_money') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.add_money') }}</li>
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
                        <div class="row justify-content-between mb-3">
                            <div class="col-auto">
                                <p class="title">{{ trans('labels.add_money') }}</p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">{{ trans('labels.amount') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded">{{@Helper::appdata()->currency }}</span>
                                    <input type="text" class="form-control rounded" name="amount" id="amount"
                                        placeholder="{{ trans('messages.amount_required') }}">
                                </div>
                                <small
                                    class="amounterror text-danger d-none">{{ trans('messages.amount_required') }}</small>
                            </div>
                        </div>
                        <div class="payment-option mb-3">
                            {{-- payment-options --}}
                            @include('web.paymentmethodsview')
                        </div>
                        <div class="d-flex justify-content-center my-4">
                            <button class="btn btn-primary px-4 py-2"
                                onclick="addmoney()">{{ trans('labels.proceed_to_pay') }}</button>
                        </div>
                        <div class="mb-3">
                            <p class="mb-0">{{ trans('labels.notes') }} :</p>
                            <ul>
                                <li class="text-muted d-flex">
                                    <i class="fa-regular fa-circle-check text-success align-items-center d-flex"></i><p class="mb-0 mx-2">{{ trans('labels.wallet_add_note_1') }}</p>
                                </li>
                                <li class="text-muted d-flex">
                                    <i class="fa-regular fa-circle-check text-success align-items-center d-flex"></i> <p class="mb-0 mx-2">{{ trans('labels.wallet_add_note_2') }}</p>
                                </li>
                            </ul>
                        </div>
                        <input type="hidden" name="walleturl" id="walleturl" value="{{ URL::to('/wallet/recharge') }}">
                        <input type="hidden" name="successurl" id="successurl" value="{{ URL::to('/wallet') }}">
                        <input type="hidden" name="user_name" id="user_name" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="user_email" id="user_email" value="{{ Auth::user()->email }}">
                        <input type="hidden" name="user_mobile" id="user_mobile" value="{{ Auth::user()->mobile }}">

                        <input type="hidden" name="addsuccessurl" id="addsuccessurl" value="{{ URL::to('/addsuccess') }}">
                        <input type="hidden" name="addfailurl" id="addfailurl" value="{{ URL::to('/addfail') }}">

                        <input type="hidden" name="myfatoorahurl" id="myfatoorahurl" value="{{ URL::to('myfatoorah') }}">
                        <input type="hidden" name="mercadopagourl" id="mercadopagourl" value="{{ URL::to('mercadorequest') }}">
                        <input type="hidden" name="paypalurl" id="paypalurl" value="{{ URL::to('paypal') }}">
                        <input type="hidden" name="toyyibpayurl" id="toyyibpayurl" value="{{ URL::to('toyyibpay') }}">
                        

                        <form action="{{ URL::to('paypal') }}" method="post" class="d-none">
                            {{ csrf_field() }}
                            <input type="hidden" name="return" value="2">
                            <input type="submit" class="callpaypal" name="submit">
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('web.subscribeform')
@endsection
@section('scripts')
    <script src="https://checkout.stripe.com/v2/checkout.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="{{url(env('ASSETSPATHURL').'web-assets/js/custom/wallet.js')}}"></script>
@endsection
