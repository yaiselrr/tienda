@extends('layouts.admin')

@section('content')

<div class="content-area">
  <div class="mr-breadcrumb">
    <div class="row">

      <div class="col-lg-12">
        <h4 class="heading">{{ __('Home Page Customization') }}</h4>
        <ul class="links">
          <li>
            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
          </li>
          <li>
            <a href="javascript:;">{{ __('Home Page Settings') }}</a>
          </li>
          <li>
            <a href="{{ route('admin-ps-customize') }}">{{ __('Home Page Customization') }}</a>
          </li>
        </ul>
      </div>

    </div>
  </div>

  <div class="add-product-content1">
    <div class="row">
      <div class="col-lg-12">
        <div class="product-description">
          <div class="social-links-area">
            <div class="gocover"
              style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
            </div>
            <form id="geniusform" action="{{ route('admin-ps-homeupdate') }}" method="POST"
              enctype="multipart/form-data">
              @csrf

              @include('alerts.admin.form-both')

              <div class="row justify-content-center">

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="category">{{ __('Category') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="category" value="1" {{ $data->category == 1 ? "checked" : "" }}>
                    <span class="slider round"></span>
                  </label>
                </div>

                <div class="col-lg-2"></div>

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="first_left_banner">{{ __('First Left Banner') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="first_left_banner" value="1" {{ $data->first_left_banner == 1 ? "checked" : "" }}>
                    <span class="slider round"></span>
                  </label>
                </div>

              </div>

              <div class="row justify-content-center">

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="our_services">{{ __('Our Services') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="our_services" value="1" {{ $data->our_services == 1 ? "checked" : "" }}>
                    <span class="slider round"></span>
                  </label>
                </div>

                <div class="col-lg-2"></div>

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="second_left_banner">{{ __('Second Left Banner') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="second_left_banner" value="1" {{ $data->second_left_banner == 1 ? "checked" : "" }}>
                    <span class="slider round"></span>
                  </label>
                </div>

              </div>

              <div class="row justify-content-center">

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="popular_products">{{ __('Popular Products') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="popular_products" value="1" {{ $data->popular_products == 1 ? "checked":"" }}>
                    <span class="slider round"></span>
                  </label>
                </div>

                <div class="col-lg-2"></div>

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="third_left_banner">{{ __('Third Left Banner') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="third_left_banner" value="1" {{ $data->third_left_banner == 1 ? "checked":"" }}>
                    <span class="slider round"></span>
                  </label>
                </div>

              </div>

              <div class="row justify-content-center">

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="slider">{{ __('Slider') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="slider" value="1" {{ $data->slider == 1 ? "checked" : ""}}>
                    <span class="slider round"></span>
                  </label>
                </div>

                <div class="col-lg-2"></div>

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="flash_deal">{{ __('Flash Deal') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="flash_deal" value="1" {{ $data->flash_deal == 1 ? "checked" : "" }}>
                    <span class="slider round"></span>
                  </label>
                </div>

              </div>

              <div class="row justify-content-center">

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="deal_of_the_day">{{ __('Deal Of The Day') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="deal_of_the_day" value="1" {{ $data->deal_of_the_day == 1 ? "checked" : "" }}>
                    <span class="slider round"></span>
                  </label>
                </div> 

                <div class="col-lg-2"></div>

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="best_sellers">{{ __('Best Sellers') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="best_sellers" value="1" {{ $data->best_sellers == 1 ? "checked" : "" }}>
                    <span class="slider round"></span>
                  </label>
                </div>

              </div>

              <div class="row justify-content-center">

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="big_banner">{{ __('Large Banner') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="big_banner" value="1" {{ $data->big_banner == 1 ? "checked" : "" }}>
                    <span class="slider round"></span>
                  </label>
                </div>

                <div class="col-lg-2"></div>

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="top_big_trending">{{ __('Top Rated, Big Save & Trending') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="top_big_trending" value="1" {{ $data->top_big_trending == 1 ? "checked" : ""}}>
                    <span class="slider round"></span>
                  </label>
                </div>

              </div>

              <div class="row justify-content-center">

                <div class="col-lg-4 d-flex justify-content-between">
                  <label class="control-label" for="top_brand">{{ __('Top Brand') }} *</label>
                  <label class="switch">
                    <input type="checkbox" name="top_brand" value="1" {{ $data->top_brand == 1 ? "checked" : ""}}>
                    <span class="slider round"></span>
                  </label>
                </div>

                <div class="col-lg-2"></div>

                <div class="col-lg-4 d-flex justify-content-between">

                </div>

              </div>

              <div class="row">
                <div class="col-12 text-center">
                  <button type="submit" class="submit-btn">{{ __('Submit') }}</button>
                </div>
              </div>

            </form>

              </div>

              <br>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection