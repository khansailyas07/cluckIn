@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.my_wallet') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.my_wallet') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.my_wallet') }}</li>
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
                        <div class="row justify-content-between mb-2">
                            <div class="col-auto">
                                <p class="title">{{ trans('labels.my_wallet') }} :- <small
                                        class="green_color">{{ Helper::currency_format(Auth::user()->wallet) }}</small></p>
                            </div>
                            <div class="col-auto"><a href="{{ route('add-money') }}"
                                    class="btn btn-sm text-white bg-primary px-4 py-2"><i class="fa-solid fa-plus px-1"></i>{{ trans('labels.add_money') }}</a></div>
                        </div>
                        <div class="row">
                            <ul class="mb-3">
                                <li><i class="fa-regular fa-circle-check mx-2 text-success"></i>{{ trans('labels.fast_payment') }}</li>
                                <li><i class="fa-regular fa-circle-check mx-2 text-success"></i>{{ trans('labels.secure_payment') }}</li>
                                <li><i class="fa-regular fa-circle-check mx-2 text-success"></i>{{ trans('labels.no_document_required') }}</li>
                                <li><i class="fa-regular fa-circle-check mx-2 text-success"></i>{{ trans('labels.wallet_note') }}</li>
                            </ul>
                        </div>
                        @if (count($gettransactions) > 0)
                            <div class="row mb-3">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="rounded-top">
                                            <tr class="bg-light text-center align-middle">
                                                <th class="fs-7 fw-600">{{ trans('labels.date') }}</th>
                                                <th class="fs-7 fw-600">{{ trans('labels.description') }}</th>
                                                <th class="fs-7 fw-600">{{ trans('labels.amount') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="rounded-bottom">
                                            @foreach ($gettransactions as $tdata)
                                                <tr class="text-center align-middle">
                                                    <td class="fs-7">{{ Helper::date_format($tdata->created_at) }}</td>
                                                    <td class="fs-7 w-410">
                                                        @if (in_array($tdata->transaction_type, [3, 4, 5, 6, 7, 8, 9, 10, 12, 13]))
                                                            {{ trans('labels.wallet_recharge') }}
                                                            [
                                                            @if ($tdata->transaction_type == 12)
                                                                {{ trans('labels.added_by_admin') }}
                                                            @elseif ($tdata->transaction_type == 13)
                                                                {{ trans('labels.deducted_by_admin') }}
                                                            @endif
                                                            @if ($tdata->transaction_type == 3)
                                                                {{ trans('labels.razorpay') }} :
                                                            @elseif ($tdata->transaction_type == 4)
                                                                {{ trans('labels.stripe') }} :
                                                            @elseif ($tdata->transaction_type == 5)
                                                                {{ trans('labels.flutterwave') }} :
                                                            @elseif ($tdata->transaction_type == 6)
                                                                {{ trans('labels.paystack') }} :
                                                            @elseif ($tdata->transaction_type == 7)
                                                                {{ trans('labels.mercadopago') }} :
                                                            @elseif ($tdata->transaction_type == 8)
                                                                {{ trans('labels.myfatoorah') }} :
                                                            @elseif ($tdata->transaction_type == 9)
                                                                {{ trans('labels.paypal') }} :
                                                            @elseif ($tdata->transaction_type == 10)
                                                                {{ trans('labels.toyyibpay') }} :
                                                            @endif
                                                            @if(in_array($tdata->transaction_type, [3, 4, 5, 6 , 7, 8, 9, 10]))
                                                                {{ $tdata->transaction_id }}
                                                            @endif
                                                            ]
                                                        @elseif ($tdata->transaction_type == 2)
                                                            {{ trans('labels.order_cancelled') }}
                                                        @elseif ($tdata->transaction_type == 1)
                                                            {{ trans('labels.order_placed') }}
                                                        @elseif ($tdata->transaction_type == 11)
                                                            {{ trans('labels.referral_earning') }}
                                                            [{{ $tdata->username }}]
                                                        @else
                                                            -
                                                        @endif
                                                        @if (in_array($tdata->transaction_type, [1, 2]))
                                                            [{{ $tdata->order_number }}]
                                                        @endif
                                                    </td>
                                                    <td
                                                        class="fs-7 {{ in_array($tdata->transaction_type, [2, 3, 4, 5, 6, 7, 8 , 9, 10, 11, 12]) == true ? 'text-success' : 'text-danger' }}">
                                                        {{ Helper::currency_format($tdata->amount) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $gettransactions->links() }}
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
