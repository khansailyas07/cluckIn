@extends('admin.theme.default')
@section('content')
@include('admin.breadcrumb')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
        <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="business-api-tab" data-bs-toggle="tab" data-bs-target="#business-api" type="button"
                        role="tab" aria-controls="message" aria-selected="true">{{ trans('labels.whatsapp_business_api') }}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order"
                        type="button" role="tab" aria-controls="labels" aria-selected="false">{{ trans('labels.whatsapp_order_message') }}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="status-message-tab" data-bs-toggle="tab" data-bs-target="#status-message" type="button"
                        role="tab" aria-controls="message" aria-selected="false">{{ trans('labels.order_status_update') }}</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="business-api" role="tabpanel" aria-labelledby="business-api-tab">
                    <div class="card border-0 box-shadow">
                        <div class="card-body">
                        <div class="form-validation">
                                <form action="{{ URL::to('admin/settings/business_api') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ trans('labels.whatsapp_number') }}<span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control" name="whatsapp_number" value="{{ whatsapp_helper::whatsapp_message_config()->whatsapp_number }}" placeholder="{{ trans('labels.whatsapp_number') }}" required>
                                                        @error('whatsapp_number')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ trans('labels.message_type') }}<span class="text-danger"> * </span></label>
                                                        <select class="form-control" name="message_type" required>
                                                            <option value="">{{ trans('labels.select') }}</option>
                                                            <option value="1" {{ whatsapp_helper::whatsapp_message_config()->message_type == "1" ? 'selected' : '' }}>{{ trans('labels.automatic_using_api') }}</option>
                                                            <option value="2" {{ whatsapp_helper::whatsapp_message_config()->message_type == "2" ? 'selected' : '' }}>{{ trans('labels.manually') }}</option>
                                                        </select>
                                                        @error('whatsapp_number')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ trans('labels.whatsapp_phone_number_id') }}<span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control" name="whatsapp_phone_number_id" value="{{ whatsapp_helper::whatsapp_message_config()->whatsapp_phone_number_id }}" placeholder="{{ trans('labels.whatsapp_phone_number_id') }}" required>
                                                        @error('whatsapp_phone_number_id')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">{{ trans('labels.whatsapp_access_token') }}<span class="text-danger"> * </span></label>
                                                        <input type="text" class="form-control" name="whatsapp_access_token" value="{{ whatsapp_helper::whatsapp_message_config()->whatsapp_access_token }}" placeholder="{{ trans('labels.whatsapp_access_token') }}" required>
                                                        @error('whatsapp_access_token')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>                                                
                                            </div>
                                            <div class="row">
                                                <div class="form-group text-end">
                                                    <a href="{{ url('/admin/home') }}" class="btn btn-outline-danger">{{ trans('labels.cancel') }}</a>
                                                    <button class="btn btn-primary" @if (env('Environment')=='sendbox' ) type="button" onclick="myFunction()" @else type="submit" name="about_update" value="1" @endif>{{ trans('labels.save') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
                    <div class="card border-0 box-shadow">
                        <div class="card-body">
                            <div class="form-validation">
                                <form action="{{ URL::to('admin/settings/order_message_update') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card border-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold">{{ trans('labels.order_variable') }}
                                                        </label>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <ul class="list-group list-group-flush">
                                                                    <li class="list-group-item px-0">Order No :
                                                                        <code>{order_no}</code>
                                                                    </li>
                                                                    <li class="list-group-item px-0">Payment type :
                                                                        <code>{payment_type}</code>
                                                                    </li>
                                                                    <li class="list-group-item px-0">Subtotal :
                                                                        <code>{sub_total}</code>
                                                                    </li>
                                                                    <li class="list-group-item px-0">Total Tax :
                                                                        <code>{total_tax}</code>
                                                                    </li>
                                                                    <li class="list-group-item px-0">Delivery
                                                                        charge : <code>{delivery_charge}</code></li>
                                                                    <li class="list-group-item px-0">Discount
                                                                        amount : <code>{discount_amount}</code></li>
                                                                    <li class="list-group-item px-0">Grand total :
                                                                        <code>{grand_total}</code>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <ul class="list-group list-group-flush">
                                                                    <li class="list-group-item px-0">Customer name
                                                                        : <code>{customer_name}</code></li>
                                                                    <li class="list-group-item px-0">Customer
                                                                        mobile : <code>{customer_mobile}</code></li>
                                                                    <li class="list-group-item px-0">Address :
                                                                        <code>{address}</code>
                                                                    </li>
                                                                    <li class="list-group-item px-0">house_no :
                                                                        <code>{house_no}</code>
                                                                    </li>
                                                                    <li class="list-group-item px-0">area :
                                                                        <code>{area}</code>
                                                                    </li>
                                                                    <li class="list-group-item px-0">Delivery type
                                                                        : <code>{delivery_type}</code></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <ul class="list-group list-group-flush">
                                                                    <li class="list-group-item px-0">Notes :
                                                                        <code>{notes}</code>
                                                                    </li>
                                                                    <li class="list-group-item px-0">Item Variable
                                                                        : <code>{item_variable}</code>
                                                                    </li>
                                                                    <li class="list-group-item px-0">Store URL :
                                                                        <code>{store_url}</code>
                                                                    </li>
                                                                    <li class="list-group-item px-0">Track order
                                                                        URL : <code>{track_order_url}</code></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold">{{ trans('labels.item_variable') }}
                                                        </label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul class="list-group list-group-flush">
                                                                    <li class="list-group-item px-0">Item name :
                                                                        <code>{item_name}</code>
                                                                    </li>
                                                                    <li class="list-group-item px-0">QTY :
                                                                        <code>{qty}</code>
                                                                    </li>
                                                                    <li class="list-group-item px-0">Variants :
                                                                        <code>{variantsdata}</code>
                                                                    </li>
                                                                    <li class="list-group-item px-0">Item price :
                                                                        <code>{item_price}</code>
                                                                    </li>
                                                                    <li class="list-group-item px-0">
                                                                        <input type="text" name="item_message" class="form-control" placeholder="{{ trans('labels.item_message') }}" value="{{ whatsapp_helper::whatsapp_message_config()->item_message }}" required="required">
                                                                        @error('item_message')
                                                                        <span class="text-danger" id="item_message">{{ $message }}</span>
                                                                        @enderror
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold">{{ trans('labels.whatsapp_message') }}
                                                            <span class="text-danger"> * </span> </label>
                                                        <textarea class="form-control" required="required" name="whatsapp_message" cols="50" rows="10">{{ whatsapp_helper::whatsapp_message_config()->whatsapp_message }}</textarea>
                                                        @error('whatsapp_message')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="">{{ trans('labels.order_created') }} </label>
                                                        <input id="order_created-switch" type="checkbox" class="checkbox-switch" name="order_created" value="1" {{ whatsapp_helper::whatsapp_message_config()->order_created == 1 ? 'checked' : '' }}>
                                                        <label for="order_created-switch" class="switch">
                                                            <span class="{{ session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle' }}"><span class="switch__circle-inner"></span></span>
                                                            <span class="switch__left {{ session()->get('direction') == 2 ? 'pe-2' : 'ps-2' }}">{{ trans('labels.off') }}</span>
                                                            <span class="switch__right {{ session()->get('direction') == 2 ? 'ps-2' : 'pe-2' }}">{{ trans('labels.on') }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group text-end">
                                                    <a href="{{ url('/admin/home') }}" class="btn btn-outline-danger">{{ trans('labels.cancel') }}</a>
                                                    <button class="btn btn-primary" @if (env('Environment')=='sendbox' ) type="button" onclick="myFunction()" @else type="submit" name="about_update" value="1" @endif>{{ trans('labels.save') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="status-message" role="tabpanel" aria-labelledby="status-message-tab">
                    <div class="card border-0 box-shadow">
                        <div class="card-body">
                        <div class="form-validation">
                                <form action="{{ URL::to('admin/settings/status_message') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card border-0">
                                        <div class="card-body">
                                            <div class="alert alert-warning">
                                                <i class="fa-regular fa-circle-exclamation"></i> Order status message will only work if your message type settings are automatic using whatsapp business API
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold">{{ trans('labels.order_variable') }}
                                                        </label>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <ul class="list-group list-group-flush">
                                                                    <li class="list-group-item px-0">Order No :
                                                                        <code>{order_no}</code>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <ul class="list-group list-group-flush">
                                                                    <li class="list-group-item px-0">Customer name
                                                                        : <code>{customer_name}</code></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <ul class="list-group list-group-flush">
                                                                    <li class="list-group-item px-0">Track order
                                                                        URL : <code>{track_order_url}</code></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <ul class="list-group list-group-flush">
                                                                    <li class="list-group-item px-0">Status 
                                                                        : <code>{status}</code></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold">{{ trans('labels.status_message') }}
                                                            <span class="text-danger"> * </span> </label>
                                                        <textarea class="form-control" required="required" name="status_message" cols="50" rows="10">{{ whatsapp_helper::whatsapp_message_config()->status_message }}</textarea>
                                                        @error('status_message')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="">{{ trans('labels.status_change') }} </label>
                                                        <input id="status_change-switch" type="checkbox" class="checkbox-switch" name="status_change" value="1" {{ whatsapp_helper::whatsapp_message_config()->status_change == 1 ? 'checked' : '' }}>
                                                        <label for="status_change-switch" class="switch">
                                                            <span class="{{ session()->get('direction') == 2 ? 'switch__circle-rtl' : 'switch__circle' }}"><span class="switch__circle-inner"></span></span>
                                                            <span class="switch__left {{ session()->get('direction') == 2 ? 'pe-2' : 'ps-2' }}">{{ trans('labels.off') }}</span>
                                                            <span class="switch__right {{ session()->get('direction') == 2 ? 'ps-2' : 'pe-2' }}">{{ trans('labels.on') }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group text-end">
                                                    <a href="{{ url('/admin/home') }}" class="btn btn-outline-danger">{{ trans('labels.cancel') }}</a>
                                                    <button class="btn btn-primary" @if (env('Environment')=='sendbox' ) type="button" onclick="myFunction()" @else type="submit" name="about_update" value="1" @endif>{{ trans('labels.save') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key={{ @Helper::appdata()->map }}&libraries=places&callback=initMap" async defer></script>
<script src="{{url(env('ASSETSPATHURL').'admin-assets/assets/js/custom/settings.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('ckeditor');
</script>
@endsection