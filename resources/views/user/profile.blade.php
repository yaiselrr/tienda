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
                    <a href="{{ route('user-profile') }}">
                      {{ __('Edit Profile') }}
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
                                    {{ __('Edit Profile') }}
                                </h4>
                            </div>
                            <div class="edit-info-area">

                                <div class="body">
                                    <div class="edit-info-area-form">
                                        <div class="gocover"
                                            style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                                        </div>
                                        <form id="userform" action="{{route('user-profile-update')}}" method="POST"
                                            enctype="multipart/form-data">
    
                                            @csrf
    
                                            <div class="upload-img">
                                                @if($user->is_provider == 1)
                                                <div class="img"><img
                                                        src="{{ $user->photo ? asset($user->photo):asset('assets/images/'.$gs->user_image) }}">
                                                </div>
                                                @else
                                                <div class="img"><img
                                                        src="{{ $user->photo ? asset('assets/images/users/'.$user->photo):asset('assets/images/'.$gs->user_image) }}">
                                                </div>
                                                @endif
                                                @if($user->is_provider != 1)
                                                <div class="file-upload-area">
                                                    <div class="upload-file">
                                                        <input type="file" name="photo" class="upload">
                                                        <span>{{ __('Upload') }}</span>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input name="name" type="text" class="input-field"
                                                        placeholder="{{ __('User Name') }}" required=""
                                                        value="{{ $user->name }}">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input name="email" type="email" class="input-field"
                                                        placeholder="{{ __('Email Address') }}" required=""
                                                        value="{{ $user->email }}" disabled>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input name="phone" type="text" class="input-field"
                                                        placeholder="{{ __('Phone Number') }}" required=""
                                                        value="{{ $user->phone }}">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input name="fax" type="text" class="input-field"
                                                        placeholder="{{ __('Fax') }}" value="{{ $user->fax }}">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input name="city" type="text" class="input-field"
                                                        placeholder="{{ __('City') }}" value="{{ $user->city }}">
                                                </div>
                                                <div class="col-lg-6">
                                                    <select class="input-field" name="country">
                                                        <option value="">{{ __('Select Country') }}</option>
                                                        @foreach (DB::table('countries')->get() as $data)
                                                            <option value="{{ $data->country_name }}" {{ $user->country == $data->country_name ? 'selected' : '' }}>
                                                                {{ $data->country_name }}
                                                            </option>		
                                                         @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                    <div class="col-lg-6">
                                                            <input name="zip" type="text" class="input-field"
                                                                placeholder="{{ __('Zip') }}" value="{{ $user->zip }}">
                                                        </div>
                                                <div class="col-lg-6">
                                                    <input name="state" type="text" class="input-field"
                                                                placeholder="{{ __('State') }}" value="{{ $user->state }}">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <textarea class="input-field" name="address" placeholder="{{ __('Address') }}" cols="30" rows="10" required>{{ $user->address }}</textarea>
                                                </div>
                                            </div>    

                                            <div class="form-links">
                                                <button class="submit-btn" type="submit">{{ __('Save') }}</button>
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