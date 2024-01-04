<div class="col-lg-4 col-md-6  col-auto d-flex mt-4">
    <div class="card rounded">
        <a href="{{URL::to('/blogs-'.$bloglist->slug)}}"><img src="{{ Helper::image_path($bloglist->image) }}" class="card-img-top" alt="..."></a>
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-auto blog-date">
                    <span>{{ Helper::date_format($bloglist->created_at) }}</span>
                </div>
                <div class="col-auto blog-author">
                    <span>{{trans('labels.post_by')}} <a href="javascript:void(0)" class="dark_color">{{trans('labels.admin_title')}}</a></span>
                </div>
            </div>
            <h5 class="card-title fw-600 dark_color"><a href="{{URL::to('/blogs-'.$bloglist->slug)}}" class="dark_color">{{ $bloglist->title }}</a></h5>
            <p class="card-text pb-3 border-bottom">{{ Str::limit($bloglist->description, 140) }}</p>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <p class="d-flex align-items-center mb-0 mx-2">{{trans('labels.admin_title')}}</p>
                </div>
                <a href="{{URL::to('/blogs-'.$bloglist->slug)}}" class="btn d-flex text-uppercase align-items-center text-primary border-0 {{ session()->get('direction') == '2' ? 'float-start' : 'float-end' }}">{{trans('labels.read_more')}} <i class="fa-solid fa-arrow-right mx-1"></i></a>
            </div>
        </div>
    </div>
</div>