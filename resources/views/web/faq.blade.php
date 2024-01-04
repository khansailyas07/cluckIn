@extends('web.layout.default')
@section('page_title')
    | {{ trans('labels.faq') }}
@endsection
@section('content')
    <div class="breadcrumb-sec">
        <div class="container">
            <div class="breadcrumb-sec-content">
                <h1>{{ trans('labels.faq') }}</h1>
                <nav class="text-dark d-flex justify-content-center breadcrumb-divider" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li
                            class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }}">
                            <a class="text-muted" href="{{ route('home') }}">{{ trans('labels.home') }}</a>
                        </li>
                        <li class="breadcrumb-item {{ session()->get('direction') == '2' ? 'breadcrumb-item-rtl ps-0' : '' }} active"
                            aria-current="page">{{ trans('labels.faq') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section>
        <div class="container my-5">
            @if(count($getfaqs) > 0)
                <div class="d-flex justify-content-center">
                    @php
                        $i = 1;
                    @endphp
                    <div class="col-10">
                        <div class="accordion faq" id="faqleft">
                            @foreach ($getfaqs as $key => $faqdata)
                            <div class="accordion-item border rounded mb-3">
                                <h2 class="accordion-header" id="faq{{$key}}">
                                    <button class="accordion-button {{$key==0 ? '' : 'collapsed'}} " type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faqs{{$key}}" aria-expanded="{{$key==0 ? 'true' : 'false'}}" aria-controls="collapseOne">
                                        {{$faqdata->title}}
                                    </button>
                                </h2>
                                <div id="faqs{{$key}}" class="accordion-collapse collapse {{$key==0 ? 'show' : ''}}" aria-labelledby="faq{{$key}}"
                                    data-bs-parent="#faqleft">
                                    <div class="accordion-body">{{$faqdata->description}}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                @include('web.nodata')
            @endif
        </div>
    </section>
    @include('web.subscribeform')    
@endsection
@section('scripts')
@endsection