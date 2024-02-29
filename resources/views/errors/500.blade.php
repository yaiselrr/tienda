@php
 $actual_path = str_replace('project','',base_path());
 if (is_dir($actual_path . '/install')) {
    echo '<meta http-equiv="refresh" content="0; url='.url('/install').'" />';
 }
@endphp

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
          <li>
            <a href="javascript:;">
              {{ __('Error') }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Area End -->

<section class="fourzerofour">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="content">
            <img src="{{ $gs->error_banner_500 ? asset('assets/images/'.$gs->error_banner_500):asset('assets/images/noimage.png') }}" alt="">
            <h4 class="heading">
              {{ __('500 Internal server error!') }}
            </h4>
            <p class="text">
              {{ __('The server encountered an internal error or misconfiguration and was unable to complete your request.') }}
            </p>
            <a class="mybtn1" href="{{ route('front.index') }}">{{ __('Back Home') }}</a>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection