@extends('layouts.front')

@section('content')

  <!-- Breadcrumb Area Start -->
  <div class="breadcrumb-area">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <ul class="pages">
                <li>
                  <a href="{{ route('front.index') }}">
                    {{ __("Home") }}
                  </a>
                </li>
                <li class="active">
                    <a href="{{ route('front.page',$page->slug) }}">
                        {{ $page->title }}
                    </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
  <!-- Breadcrumb Area End -->

   <!-- About Area Start -->
   <section class="about-page">
        <div class="container">
          <div class="row">
            <div class="col-lg-9">
              <div class="about-content">
                {!! clean($page->details , array('Attr.EnableID' => true)) !!}
              </div>
            </div>
            <div class="col-lg-3">
              <!-- Service Area Start -->
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
                                            <img src="{{ asset('assets/images/services/'.$service->photo) }}" alt="">
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
             <!-- Service Area End -->
             <!-- Aside Banner Area Start -->
             <div class="row aside-banner">
                 <div class="col-lg-12">
                 <a href="{{ $ps->big_save_banner_link1 }}">
                     <img src="{{ asset('assets/images/'.$ps->big_save_banner1) }}" alt="">
                    </a>
                 </div>
             </div>
             <!-- Aside Banner Area End -->
            </div>
          </div>
        </div>
      </section>
      <!-- About Area End -->

@endsection