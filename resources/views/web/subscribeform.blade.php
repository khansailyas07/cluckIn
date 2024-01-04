 <!-- newsletter section start Here -->
<section class="theme-2-newsletter my-5">
    <div class="container">
        <div class="">
            <form action="{{ route('subscribe')}}" method="POST">
                @csrf
                <div class="row align-items-center text-center justify-content-center p-md-5 p-0">
                    <div class="col-auto newsletter-heading">
                        <h1 class="text-uppercase my-3">{{ trans('labels.newsletter') }}</h1>
                        <p class="sub-lables text-capitalize my-3">{{ trans('labels.subscribe_title')}}</p>
                        <p>{{ trans('labels.subscribe_description')}}</p>
                        <div class="form-floating d-flex pb-4">
                            <input type="email" name="email" class="w-100 p-3 rounded-2  border-0" placeholder="{{ trans('labels.email') }}">
                            <!-- <label for="floatingInput">Enter your email</label> -->
                            <button type="submit" class="btn btn-primary px-md-5 px-2 mx-2 fs-md-6 fs-7 text-uppercase">{{ trans('labels.subscribe') }}</button>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- newsletter section end Here -->