@extends('layouts.front')

@section('content')

    <!-- Main Content Area Start -->
    <section class="main-content">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-3 col-lg-4  mainCol1">
                    @if($ps->first_left_banner == 1)
                    <div class="row aside-banner first-aside">
                        <div class="col-lg-12">
                            <a target="_blank" href="{{ $ps->best_seller_banner_link }}">
                                <img class="lozad" data-src="{{ asset('assets/images/'.$ps->best_seller_banner) }}" alt="">
                            </a>
                        </div>
                    </div>
                     <!--Aside Banner Area End -->
                    @endif
                    @if($ps->our_services == 1)
                     <!--Service Area Start -->
                    <div class="row our-service">
                        <div class="col-lg-12">
                            <div class="service-box">
                                <div class="header">
                                    <h4 class="title">
                                        {{ __('Our Services') }}
                                    </h4>
                                </div>
                                <ul class="service-list">
                                    @foreach(DB::table('services')->where('language_id',$langg->id)->where('user_id',0)->get() as $service)
                                    <li>
                                        <div class="single-service">
                                            <div class="icon">
                                                <img class="lozad" data-src="{{ asset('assets/images/services/'.$service->photo) }}" alt="">
                                            </div>
                                            <div class="content">
                                                <h5 class="title">
                                                    {{ $service->title }}
                                                </h5>
                                                <p>
                                                    {{ $service->details }}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                     <!--Service Area End -->
                    @endif
                    @if($ps->second_left_banner == 1)
                    <!-- Aside Banner Area Start -->
                    <div class="row aside-banner">
                            <div class="col-lg-12">
                                <a target="_blank" href="{{ $ps->best_seller_banner_link1 }}">
                                    <img class="lozad" data-src="{{ asset('assets/images/'.$ps->best_seller_banner1) }}" alt="">
                                </a>
                            </div>
                    </div>
                    <!-- Aside Banner Area End -->
                    @endif
                    @if($ps->popular_products == 1)
                    <!-- Product Widget Start -->
                    <div class="row product-widget">
                        <div class="col-lg-12">
                            <div class="product-widget-box">
                                <div class="header">
                                    <h4 class="title">
                                        {{ __('Popular Products') }}
                                    </h4>
                                </div>
                                <div class="product-widget-content">
                                    @foreach($popular_products as $prod)
                                        @include('partials.product.list-product')
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Widget End -->
                    @endif
                    @if($ps->third_left_banner == 1)
                    <!-- Aside Banner Area Start -->
                    <div class="row aside-banner">
                        <div class="col-lg-12">
                            <a target="_blank" href="{{ $ps->big_save_banner_link }}">
                                <img class="lozad" data-src="{{ asset('assets/images/'.$ps->big_save_banner) }}" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- Aside Banner Area End -->
                    @endif
                </div>
                
                <div class="col-xl-9 col-lg-8 order-first order-lg-last mainCol2">
                    @if($ps->slider == 1)
                    <div class="row hero-area">
                            @if(count($sliders))
                                @include('partials.home.slider-style')
                            @endif
                            {{-- SLIDER SECTION --}}
                            @if(count($sliders))

                            <div class="col-lg-9 mycol1">
                                <div class="hero-slider-wrapper">
                                    <div class="slide-progress"></div>
                                    <div class="intro-carousel">
                                        @foreach($sliders as $data)
                                        <div class="intro-content {{ $data->position }}" 
                                            style="background-image: url({{asset('assets/images/sliders/'.$data->photo)}})">
                                            <div class="slider-content">
                                                <!-- layer 1 -->
                                                <div class="layer-1">
                                                    <h4 style="font-size: {{$data->subtitle_size}}px; color: {{$data->subtitle_color}}" class="subtitle subtitle{{$data->id}}" data-animation="animated {{$data->subtitle_anime}}">{{$data->subtitle_text}}</h4>
                                                    <h2 style="font-size: {{$data->title_size}}px; color: {{$data->title_color}}" class="title title{{$data->id}}" data-animation="animated {{$data->title_anime}}">{{$data->title_text}}</h2>
                                                </div>
                                                    <!-- layer 2 -->
                                                <div class="layer-2">
                                                    <p style="font-size: {{$data->details_size}}px; color: {{$data->details_color}}"  class="text text{{$data->id}}" data-animation="animated {{$data->details_anime}}">{{$data->details_text}}</p>
                                                </div>
                                                <!-- layer 3 -->
                                                <div class="layer-3">
                                                    <a href="{{ $data->link }}" target="_blank" class="mybtn1">
                                                        {{ __('Shop Now') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            @endif
                            {{-- SLIDER SECTION  ENDS--}}
                            <div class="col-lg-3 mycol2">
                                <div class="slider_right_banner">
                                    <a href="{{ $ps->rightbannerlink1 }}" target="_blank" class="single-banner banner-effect">
                                        <img class="lozad" data-src="{{ asset('assets/images/'.$ps->rightbanner1) }}" alt="">
                                    </a>
                                    <a href="{{ $ps->rightbannerlink2 }}" target="_blank" class="single-banner banner-effect">
                                        <img class="lozad" data-src="{{ asset('assets/images/'.$ps->rightbanner2) }}" alt="">
                                    </a>
                                </div>
                            </div>

                    </div>
                    @endif

                    @if($ps->flash_deal == 1)
                    <div class="row deal-of-the-day">
                        <div class="col-lg-12">
                            <div class="top-header-area">
                                <h4 class="title">
                                    {{ __('FLASH DEAL') }}
                                </h4>
                            </div>
                            <div class="flash-deals">
                                <div class="flas-deal-slider">
                                    @foreach($flash_products as $prod)
                                        <div class="slide-item">
                                            @include('partials.product.flash-product')
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($ps->deal_of_the_day == 1)
                    <div class="row product-tab">
                        <div class="col-lg-12">
                            <div class="top-header-area">
                                <h4 class="title">
                                    {{ __('DEAL OF THE DAY') }}
                                </h4>
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-tab1-tab" data-toggle="pill"
                                            href="#pills-tab1" role="tab" aria-controls="pills-tab1"
                                            aria-selected="true">{{ __('Hot') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-tab2-tab" data-toggle="pill" href="#pills-tab2"
                                            role="tab" aria-controls="pills-tab2" aria-selected="false">{{ ('New') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-tab3-tab" data-toggle="pill" href="#pills-tab3"
                                            role="tab" aria-controls="pills-tab3" aria-selected="false">{{ __('Sale') }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="pills-tab1" role="tabpanel"
                                    aria-labelledby="pills-tab1-tab">
                                    <div class="row">
                                        @foreach($hot_products as $prod)
                                            <div class="col-xl-3 col-md-4 col-6 mycol">
                                                @include('partials.product.home-product')
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-tab2" role="tabpanel"
                                    aria-labelledby="pills-tab2-tab">
                                    <div class="row">
                                        @foreach($latest_products as $prod)
                                            <div class="col-xl-3 col-md-4 col-6 mycol">
                                                @include('partials.product.home-product')
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-tab3" role="tabpanel"
                                    aria-labelledby="pills-tab3-tab">
                                    <div class="row">
                                        @foreach($sale_products as $prod)
                                            <div class="col-xl-3 col-md-4 col-6 mycol">
                                                @include('partials.product.home-product')
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Banner Area Start -->
                   @endif
                   @if($ps->best_sellers == 1)
                    <!-- Banner Area End -->
                    <div class="row product-row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="top-header-area">
                                        <h4 class="title">
                                            {{ __('Best Sellers') }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach($best_products as $prod)
                                <div class="col-xl-3 col-md-4 col-6 mycol">
                                    @include('partials.product.home-product')
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Banner Area Start -->
                    @endif
                    @if($ps->big_banner == 1)
                    <div class="row banner">
                        {{-- @foreach() --}}
                        @foreach($large_banners as $banner)
                        <div class="col-md-12">
                            <a target="_blank" href="{{ $banner->link }}">
                                <img class="lozad mb-2" data-src="{{ asset('assets/images/banners/'.$banner->photo) }}" alt="">
                            </a>
                        </div>
                        @endforeach

                    </div>
                    @endif
                    <!-- Banner Area End -->
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content Area End -->

    @if($ps->top_big_trending == 1)
    <div class="container">
        <!-- Product landscape Start -->
        <div class="row product-landscape">
            <div class="col-lg-4 mycol">
                <div class="top-header-area">
                    <h4 class="title">
                        {{ __('Top Rated') }}
                    </h4>
                </div>
                <ul class="product-landscape-list">
                    @foreach($top_products as $prod)
                        <li>
                            @include('partials.product.list-product-cart')
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-4 mycol">
                <div class="top-header-area">
                    <h4 class="title">
                        {{ __('Big Save') }}
                    </h4>
                </div>
                <ul class="product-landscape-list">
                    @foreach($big_products as $prod)
                        <li>
                            @include('partials.product.list-product-cart')
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-4 mycol">
                <div class="top-header-area">
                    <h4 class="title">
                        {{ __('Trending') }}
                    </h4>
                </div>
                <ul class="product-landscape-list">
                    @foreach($trending_products as $prod)
                        <li>
                            @include('partials.product.list-product-cart')
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Product landscape End-->
    </div>
    @endif
    @if($ps->top_brand == 1)
    <!-- Partners Area Start -->
    <section class="brand-section partners">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="top-header-area">
                        <h4 class="title">
                            {{ __('Top Brand') }}
                        </h4>
                    </div>
                </div>
            </div>
			<div class="row mt-3">
                <div class="col-lg-12 padding-decrease">
                    <div class="brand-slider">
                        @foreach(DB::table('partners')->get()->chunk(2) as $partner)
                            <div class="slide-item">
                                @foreach($partner as $data)
                                    <a href="{{ $data->link }}" target="_blank" class="brand">
                                        <img src="{{ asset('assets/images/partner/'.$data->photo) }}" alt="">
                                    </a>
                                @endforeach		
                            </div>						
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Partners Area End -->
    @endif

@endsection