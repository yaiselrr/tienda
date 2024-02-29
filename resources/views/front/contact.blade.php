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
                    {{ __('Home') }}
                  </a>
                </li>
                <li class="active">
                  <a href="{{ route('front.contact') }}">
                    {{ __('Contact Us') }}
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- Breadcrumb Area End -->
    
       <!-- Contact Area Start -->
      <section class="contact-us">
            <div class="container">
                <div class="row justify-content-between">
                        <div class="col-xl-5 col-lg-5">
                                <div class="left-area">
                                    @if($ps->email != null)
                                    <div class="contact-info">
                                        <div class="left ">
                                                <div class="icon">
                                                <i class="fas fa-envelope"></i>
                                                        <p class="lable">
                                                            {{ __('Email') }}
                                                        </p>
                                                </div>
                                        </div>
                                        <div class="content d-flex align-self-center">
                                            <div class="content">
                                                    <a href="mailto:{{$ps->email}}">
                                                        {{ $ps->email }}
                                                    </a>

                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($ps->site != null)
                                    <div class="contact-info">
                                        <div class="left ">
                                                <div class="icon">
                                                <i class="fas fa-globe"></i>
                                                        <p class="lable">
                                                            {{ __('Website') }}
                                                        </p>
                                                </div>
                                        </div>
                                        <div class="content d-flex align-self-center">
                                            <div class="content">
                                                    <a href="{{$ps->site}}" target="_blank">
                                                        {{ $ps->site }}
                                                    </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($ps->street != null) 
                                    <div class="contact-info">
                                            <div class="left">
                                                    <div class="icon">
                                                            <i class="fas fa-map-marked-alt"></i>
                                                            <p class="lable">
                                                                {{ __('Address') }}
                                                            </p>
                                                    </div>
                                            </div>
                                            <div class="content d-flex align-self-center">
                                                <div class="content">
                                                        <p>
                                                            {{ $ps->street }}
                                                        </p>
                                                </div>
                                            </div>
                                    </div>
                                    @endif
                                    @if($ps->phone != null || $ps->fax != null ) 
                                        <div class="contact-info">
                                                <div class="left">
                                                        <div class="icon">
                                                              <i class="fas fa-mobile-alt"></i>
                                                                <p class="lable">
                                                                    {{ __('Phone') }}
                                                                </p>
                                                        </div>
                                                </div>
                                                <div class="content d-flex align-self-center">
                                                        <div class="content">
                                                            @if($ps->phone != null && $ps->fax != null)
                                                              <a href="tel:{{$ps->phone}}">{{$ps->phone}}</a>
                                                              <a href="tel:{{$ps->fax}}">{{$ps->fax}}</a>
                                                            @elseif($ps->phone != null)
                                                              <a href="tel:{{$ps->phone}}">{{$ps->phone}}</a>
                                                            @else
                                                              <a href="tel:{{$ps->fax}}">{{$ps->fax}}</a>
                                                            @endif
                                                        </div>
                                                </div>
                                            </div>
                                    @endif
                                            <div class="social-links">
                                                <h4 class="title">{{ __('Find us here') }} :</h4>
                                                <ul>
                                                    @foreach(DB::table('social_links')->where('user_id',0)->where('status',1)->get() as $link)
                                                        <li>
                                                            <a href="{{ $link->link }}" target="_blank">
                                                                <i class="{{ $link->icon }}"></i>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                </div>
                            </div>
                    <div class="col-xl-7 col-lg-7">
                        <div class="right-area">
                            <div class="contact-form">
                                <form class="contactform" action="{{route('front.contact.submit')}}" method="POST">
                                    <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }});"></div>
                                        @csrf
                                        <ul>
                                            <li>
                                                <input name="name" type="text" class="input-field" placeholder="{{ __('Name *') }}" required>
                                            </li>
                                            <li>
                                                <input name="phone" type="text" class="input-field" placeholder="{{ __('Phone Number *') }}" required>
                                            </li>
                                            <li>
                                                <input name="email" type="email" class="input-field" placeholder="{{ __('Email Address *') }}" required>
                                            </li>
                                            <li>
                                                <textarea name="text" class="input-field textarea" placeholder="{{ __('Your Message *') }}" required></textarea>
                                            </li>
                                        </ul>

                                        @if($gs->is_capcha == 1)

                                        <ul class="captcha-area">
                                            <li>
                                                <p><img class="codeimg1" src="{{ asset("assets/images/capcha_code.png") }}" alt="">	<i class="fas fa-sync-alt pointer refresh_code"></i></p>
                                            
                                            </li>
                                            <li>
                                                <input name="codes" type="text" class="input-field" placeholder="{{ __('Enter Code') }}" required>  
                                            </li>
                                        </ul>

                                        @endif

                                        <input type="hidden" name="to" value="{{ $ps->contact_email }}">
                                        <button class="submit-btn mybtn1" type="submit">{{ __('Send Message') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
        </section>
      <!-- Contact Area End -->

@endsection