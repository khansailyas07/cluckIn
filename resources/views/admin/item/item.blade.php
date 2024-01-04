@extends('admin.theme.default')
@section('content')
@include('admin.breadcrumb')

<div class="container-fluid">
    @if (\App\SystemAddons::where('unique_identifier', 'product_import')->first() != null && \App\SystemAddons::where('unique_identifier', 'product_import')->first()->activated == 1)
    <div class="d-flex justify-content-end">
        <a href="{{ route('import')}}" class="btn btn-primary mb-2">{{ trans('labels.import') }} @if(env('Environment') == 'sendbox') <small class="badge bg-danger">Addon</small> @endif</a>
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="table-responsive" id="table-display">
                        @include('admin.item.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script src="{{url(env('ASSETSPATHURL').'admin-assets/assets/js/custom/additem.js') }}"></script>
@endsection