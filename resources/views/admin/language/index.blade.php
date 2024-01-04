@extends('admin.theme.default')
@section('content')
    <div class="alert alert-warning">
        <i class="fa-regular fa-circle-exclamation"></i> This section is available only for website & admin panel. 
    </div>
    
    <div class="alert alert-warning" role="alert">
        <p>Dont Use Double Qoute (")</p>
    </div>
    
    <div class="row settings">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="text-uppercase">{{ trans('labels.language') }}</h5>
            @if (\App\SystemAddons::where('unique_identifier', 'language')->first() != null && \App\SystemAddons::where('unique_identifier', 'language')->first()->activated == 1)
            <div class="d-flex justify-content-end">
                <a href="{{ URL::to('/admin/language-settings/language/add') }}" class="btn btn-primary mb-2">{{ trans('labels.add') }} @if(env('Environment') == 'sendbox') <small class="badge bg-danger">Addon</small> @endif</a>
            </div>
            @endif
        </div>
        <div class="col-xl-3 mb-3">
            <div class="card card-sticky-top border-0">
                <ul class="list-group list-options">
                    @foreach ($getlanguages as $data)
                        <a href="{{ URL::to('admin/language-settings/' . $data->code) }}"
                            class="list-group-item basicinfo p-3 list-item-primary @if ($currantLang->code == $data->code) active @endif"
                            aria-current="true">
                            <div class="d-flex justify-content-between align-item-center">
                                {{ $data->name }}
                                <div class="d-flex align-item-center">
                                    @if ($data->is_default == '1')
                                        <span>{{ trans('labels.default') }}</span>
                                    @endif
                                    <i class="fa-regular fa-angle-right ps-2"></i>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="dropdown">
                @php
                    $title = $currantLang->layout == 1 ? trans('labels.ltr') : trans('labels.rtl');
                @endphp
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $title }}
                </button>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @if ($currantLang->layout == 1)
                        <a class="dropdown-item w-auto"
                            @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/language-settings/layout/update-' . $currantLang->id . '/2') }}')" @endif>
                            {{ trans('labels.rtl') }} </a>
                    @else
                        <a class="dropdown-item w-auto"
                            @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/language-settings/layout/update-' . $currantLang->id . '/1') }}')" @endif>
                            {{ trans('labels.ltr') }} </a>
                    @endif
                </ul>

                <a class="btn btn-info text-white"
                    href="{{ URL::to('/admin/language-settings/language/edit-' . $currantLang->id) }}">
                    {{ trans('labels.edit') }} </a>
                @if (Strtolower($currantLang->name) != 'english')
                    <a class="btn btn-danger text-white"
                        @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/language-settings/language/delete-' . $currantLang->id . '/2') }}')" @endif>
                        {{ trans('labels.delete') }} </a>
                @endif
            </div>
            <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="labels-tab" data-bs-toggle="tab" data-bs-target="#labels"
                        type="button" role="tab" aria-controls="labels" aria-selected="true">Labels</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="message-tab" data-bs-toggle="tab" data-bs-target="#message" type="button"
                        role="tab" aria-controls="message" aria-selected="false">Messages</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="labels" role="tabpanel" aria-labelledby="labels-tab">
                    <div class="card border-0 box-shadow">
                        <div class="card-body">
                            <form method="post" action="{{ URL::to('admin/language-settings/update') }}">
                                @csrf
                                <input type="hidden" class="form-control" name="currantLang"
                                    value="{{ $currantLang->code }}">
                                <input type="hidden" class="form-control" name="file" value="label">
                                <div class="row">
                                    @foreach ($arrLabel as $label => $value)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="example3cols1Input">{{ $label }}
                                                </label>
                                                <input type="text" class="form-control"
                                                    name="label[{{ $label }}]" id="label{{ $label }}"
                                                    onkeyup="validation($(this).val(),this.getAttribute('id'))"
                                                    value="{{ $value }}">
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <div class="d-flex justify-content-end">
                                                @if (env('Environment') == 'sendbox')
                                                    <button type="button" class="btn btn-raised btn-secondary"
                                                        onclick="myFunction()"><i class="fa fa-check-square-o"></i>
                                                        {{ trans('labels.save') }} </button>
                                                @else
                                                    <button type="submit" class="btn btn-raised btn-secondary"><i
                                                            class="fa fa-check-square-o"></i> {{ trans('labels.save') }}
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="message" role="tabpanel" aria-labelledby="message-tab">
                    <div class="card border-0 box-shadow">
                        <div class="card-body">
                            <form method="post" action="{{ URL::to('admin/language-settings/update') }}">
                                @csrf
                                <input type="hidden" class="form-control" name="currantLang"
                                    value="{{ $currantLang->code }}">
                                <input type="hidden" class="form-control" name="file" value="message">
                                <div class="row">
                                    @foreach ($arrMessage as $label => $value)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="example3cols1Input">{{ $label }}
                                                </label>
                                                <input type="text" class="form-control"
                                                    name="message[{{ $label }}]" id="message{{ $label }}"
                                                    onkeyup="validation($(this).val(),this.getAttribute('id'))"
                                                    value="{{ $value }}">
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <div class="d-flex justify-content-end">
                                                @if (env('Environment') == 'sendbox')
                                                    <button type="button" class="btn btn-raised btn-secondary"
                                                        onclick="myFunction()"><i class="fa fa-check-square-o"></i>
                                                        {{ trans('labels.save') }} </button>
                                                @else
                                                    <button type="submit" class="btn btn-raised btn-secondary"><i
                                                            class="fa fa-check-square-o"></i> {{ trans('labels.save') }}
                                                    </button>
                                                @endif
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
@endsection

@section('script')
    <script>
        function validation(value, id) {
            if (value.includes('"')) {
                newval = value.replaceAll('"', '');
                $('#' + id).val(newval);
            }
        }
    </script>
    <script src="{{ url(env('ASSETSPATHURL') . 'admin-assets/assets/js/custom/settings.js') }}"></script>
@endsection
