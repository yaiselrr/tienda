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
                  <a href="{{ route('user-dashboard') }}">
                    {{ __('Dashboard') }}
                  </a>
                </li>
                <li class="active">
                  <a href="{{ route('user-reset') }}">
                    {{ __('Reset Password') }}
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
  <!-- Breadcrumb Area End -->


<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('partials.user.dashboard-sidebar')
                <div class="col-lg-8">
                    <div class="user-profile-details">
                        <div class="account-info">
                            <div class="header-area">
                                <h4 class="title">
                                    {{ __('Reset Password') }}
                                </h4>
                            </div>
                            <div class="edit-info-area">
                                
                                <div class="body">
                                        <div class="edit-info-area-form">
                                                <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                                                <form id="userform" action="{{route('user-reset-submit')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @include('alerts.admin.form-both') 
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                               <input type="password" name="cpass"  class="input-field" placeholder="{{ __('Current Password') }}" value="" required="">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                              <input type="password" name="newpass"  class="input-field" placeholder="{{ __('New Password') }}" value="" required="">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                              <input type="password" name="renewpass"  class="input-field" placeholder="{{ __('Re-Type New Password') }}" value="" required="">
                                                        </div>
                                                    </div>

                                                        <div class="form-links">
                                                            <button class="submit-btn" type="submit">{{ __('Submit') }}</button>
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
  </section>

@endsection