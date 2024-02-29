<!-- Product Quick View Modal -->

{{-- REMOVE TAB INDEX FROM IN !!!!!!!! --}}

<div class="modal fade" id="quickview" role="dialog"  aria-hidden="true">
		<div class="modal-dialog quickview-modal modal-dialog-centered modal-xl" role="document">
		  <div class="modal-content">
			<div class="submit-loader">
				<img src="{{asset('assets/images/'.$gs->loader)}}" alt="">
			</div>
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
				<div class="quick-view-modal">

				</div>
			</div>
		  </div>
		</div>
	  </div>
<!-- Product Quick View Modal Ends -->


<!-- User Login Modal -->

    <div class="modal fade" id="user-login" tabindex="-1" role="dialog" aria-labelledby="user-login-Title"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" style="transition: .5s;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <nav class="comment-log-reg-tabmenu">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link login active" id="nav-log-tab" data-toggle="tab" href="#nav-log"
                                role="tab" aria-controls="nav-log" aria-selected="true">
                                {{ __('Login') }}
                            </a>
                            <a class="nav-item nav-link" id="nav-reg-tab" data-toggle="tab" href="#nav-reg" role="tab"
                                aria-controls="nav-reg" aria-selected="false">
                                {{ __('Register') }}
                            </a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-log" role="tabpanel"
                            aria-labelledby="nav-log-tab">
                            <div class="login-area">
                                <div class="header-area">
                                    <h4 class="title">{{ __('LOGIN NOW') }}</h4>
                                </div>
                                <div class="login-form signin-form">

                                    @include('alerts.admin.form-login')

                                    @if(Session::has('auth-modal'))
                                    <div class="alert alert-danger alert-dismissible">

                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                  {{ Session::get('auth-modal') }}
                                    </div>
                                    @endif

                                    @if(Session::has('forgot-modal'))
                                    <div class="alert alert-success alert-dismissible">

                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                  {{ Session::get('forgot-modal') }}
                                    </div>
                                    @endif


                                    <form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
                                        @csrf
                                        <div class="form-input">
                                            <input type="email" name="email" value="" placeholder="{{ __('Type Email Address') }}" required="">
                                            <i class="icofont-user-alt-5"></i>
                                        </div>
                                        <div class="form-input">
                                            <input type="password" class="Password" value="" name="password" placeholder="{{ __('Type Password') }}" required="">
                                            <i class="icofont-ui-password"></i>
                                        </div>
                                        <div class="form-forgot-pass">
                                            <div class="left">
                                                <input type="checkbox" name="remember" id="mrp">
                                                <label for="mrp">{{ __('Remember Password') }}</label>
                                            </div>
                                            <div class="right">
                                                <a href="javascript:;" id="show-forgot">
                                                    {{ __('Forgot Password?') }}
                                                </a>
                                            </div>
                                        </div>
                                        <input type="hidden" name="modal" value="1">
                                        @if(Session::has('auth-modal'))
                                            <input type="hidden" name="auth_modal" value="1">
                                        @endif
                                        <input class="mauthdata" type="hidden" value="{{ __('Authenticating...') }}">
                                        <button type="submit" class="submit-btn">{{ __('Login') }}</button>
                                        <div class="social-area">
                                            <h3 class="title">{{ __('Or') }}</h3>
                                            <p class="text">{{ __('Sign In with social media') }}</p>
                                            @if(DB::table('socialsettings')->find(1)->f_check == 1 || DB::table('socialsettings')->find(1)->g_check == 1)
                                            <ul class="social-links">
                                                @if(DB::table('socialsettings')->find(1)->f_check == 1)
                                                <li>
                                                    <a href="{{ route('social-provider','facebook') }}">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                                @endif
                                                @if(DB::table('socialsettings')->find(1)->f_check == 1)
                                                <li>
                                                    <a href="{{ route('social-provider','google') }}">
                                                        <i class="fab fa-google-plus-g"></i>
                                                    </a>
                                                </li>
                                                @endif
                                            </ul>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-reg" role="tabpanel" aria-labelledby="nav-reg-tab">
                            <div class="login-area signup-area">
                                <div class="header-area">
                                    <h4 class="title">{{ __('Signup Now') }}</h4>
                                </div>
                                <div class="login-form signup-form">
                                    @include('alerts.admin.form-login')
                                    <form class="mregisterform" action="{{route('user-register-submit')}}" method="POST">
                                        @csrf
                                        <div class="form-input">
                                            <input type="text" class="User Name" name="name" placeholder="{{ __('Full Name') }}"
                                                required="">
                                            <i class="icofont-user-alt-5"></i>
                                        </div>

                                        <div class="form-input">
                                            <input type="email" class="User Name" name="email" placeholder="{{ __('Email Address') }}" required="">
                                            <i class="icofont-email"></i>
                                        </div>

                                        <div class="form-input">
                                            <input type="text" class="User Name" name="phone" placeholder="{{ __('Phone Number') }}"
                                                required="">
                                            <i class="icofont-phone"></i>
                                        </div>

                                        <div class="form-input">
                                            <input type="text" class="User Name" name="address" placeholder="{{ __('Address') }}"
                                                required="">
                                            <i class="icofont-location-pin"></i>
                                        </div>

                                        <div class="form-input">
                                            <input type="password" class="Password" name="password" placeholder="{{ __('Password') }}" required="">
                                            <i class="icofont-ui-password"></i>
                                        </div>

                                        <div class="form-input">
                                            <input type="password" class="Password" name="password_confirmation"
                                                placeholder="{{ __('Confirm Password') }}" required="">
                                            <i class="icofont-ui-password"></i>
                                        </div>

										<ul class="captcha-area">
                                            <li>
                                                <p>
                                                    <img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> 
                                                    <i class="fas fa-sync-alt pointer refresh_code"></i>
                                                </p>
                                            </li>
                                        </ul>

                                        <div class="form-input">
                                            <input type="text" class="Password" name="codes" placeholder="{{ __('Enter Code') }}"
                                                required="">
                                            <i class="icofont-refresh"></i>
                                        </div>

                                        <input class="mprocessdata" type="hidden" value="{{ __('Processing...') }}">
                                        <button type="submit" class="submit-btn">{{ __('Register') }}</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Login Modal Ends -->


    <!-- Vendor Login Modal -->

    <div class="modal fade" id="vendor-login" tabindex="-1" role="dialog" aria-labelledby="vendor-login-Title"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" style="transition: .5s;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <nav class="comment-log-reg-tabmenu">
                        <div class="nav nav-tabs" id="nav-tab1" role="tablist">
                            <a class="nav-item nav-link login active" id="nav-log-tab11" data-toggle="tab"
                                href="#nav-log11" role="tab" aria-controls="nav-log" aria-selected="true">
                                {{ __('Vendor Login') }}
                            </a>
                            <a class="nav-item nav-link" id="nav-reg-tab11" data-toggle="tab" href="#nav-reg11"
                                role="tab" aria-controls="nav-reg" aria-selected="false">
                                {{ __('Vendor Registration') }}
                            </a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-log11" role="tabpanel"
                            aria-labelledby="nav-log-tab">
                            <div class="login-area">
                                <div class="login-form signin-form">
                                    @include('alerts.admin.form-login')
                                    <form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
                                        @csrf
                                        <div class="form-input">
                                            <input type="email" name="email" value=""
                                                placeholder="{{ __('Type Email Address') }}" required="">
                                            <i class="icofont-user-alt-5"></i>
                                        </div>
                                        <div class="form-input">
                                            <input type="password" class="Password" name="password"
                                                placeholder="{{ __('TypePassword') }}" value="" required="">
                                            <i class="icofont-ui-password"></i>
                                        </div>
                                        <div class="form-forgot-pass">
                                            <div class="left">
                                                <input type="checkbox" name="remember" id="mrp1">
                                                <label for="mrp1">{{ __('Remember Password') }}</label>
                                            </div>
                                            <div class="right">
                                                <a href="javascript:;" id="show-forgot1">
                                                    {{ __('Forgot Password?') }}
                                                </a>
                                            </div>
                                        </div>
                                        <input type="hidden" name="modal" value="1">
                                        <input type="hidden" name="vendor" value="1">
                                        <input class="mauthdata" type="hidden" value="{{ __('Authenticating...') }}">
                                        <button type="submit" class="submit-btn">{{ __('Login') }}</button>
                                        <div class="social-area">
                                                <h3 class="title">{{ __('Or') }}</h3>
                                                <p class="text">{{ __('Sign In with social media') }}</p>
                                                @if(DB::table('socialsettings')->find(1)->f_check == 1 || DB::table('socialsettings')->find(1)->g_check == 1)
                                                <ul class="social-links">
                                                    @if(DB::table('socialsettings')->find(1)->f_check == 1)
                                                    <li>
                                                        <a href="{{ route('social-provider','facebook') }}">
                                                            <i class="fab fa-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    @if(DB::table('socialsettings')->find(1)->f_check == 1)
                                                    <li>
                                                        <a href="{{ route('social-provider','google') }}">
                                                            <i class="fab fa-google-plus-g"></i>
                                                        </a>
                                                    </li>
                                                    @endif
                                                </ul>
                                                @endif
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-reg11" role="tabpanel" aria-labelledby="nav-reg-tab">
                            <div class="login-area signup-area">
                                <div class="login-form signup-form">
                                    @include('alerts.admin.form-login')
                                    <form class="mregisterform" action="{{ route('user-register-submit') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <input type="text" class="User Name" name="name"
                                                        placeholder="{{ __('Full Name') }}" required="">
                                                    <i class="icofont-user-alt-5"></i>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <input type="email" class="User Name" name="email"
                                                        placeholder="{{ __('Email Address') }}" required="">
                                                    <i class="icofont-email"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <input type="text" class="User Name" name="phone"
                                                        placeholder="{{ __('Phone Number') }}" required="">
                                                    <i class="icofont-phone"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <input type="text" class="User Name" name="address"
                                                        placeholder="{{ __('Address') }}" required="">
                                                    <i class="icofont-location-pin"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <input type="text" class="User Name" name="shop_name"
                                                        placeholder="{{ __('Shop Name') }}" required="">
                                                    <i class="icofont-cart-alt"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <input type="text" class="User Name" name="owner_name"
                                                        placeholder="{{ __('Owner Name') }}" required="">
                                                    <i class="icofont-cart"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <input type="text" class="User Name" name="shop_number"
                                                        placeholder="{{ __('Shop Number') }}" required="">
                                                    <i class="icofont-shopping-cart"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <input type="text" class="User Name" name="shop_address"
                                                        placeholder="{{ __('Shop Address') }}" required="">
                                                    <i class="icofont-opencart"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <input type="text" class="User Name" name="reg_number"
                                                        placeholder="{{ __('Registration Number') }}" required="">
                                                    <i class="icofont-ui-cart"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <input type="text" class="User Name" name="shop_message"
                                                        placeholder="{{ __('Message') }}" required="">
                                                    <i class="icofont-envelope"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <input type="password" class="Password" name="password"
                                                        placeholder="{{ __('Password') }}" required="">
                                                    <i class="icofont-ui-password"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <input type="password" class="Password" name="password_confirmation"
                                                        placeholder="{{ __('ConfirmPassword') }}" required="">
                                                    <i class="icofont-ui-password"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <ul class="captcha-area">
                                                    <li>
                                                        <p>
                                                            <img class="codeimg1" src="{{asset("assets/images/capcha_code.png")}}" alt=""> 
                                                            <i class="fas fa-sync-alt pointer refresh_code"></i>
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <input type="text" class="Password" name="codes"
                                                        placeholder="{{ __('Enter Code') }}" required="">
                                                    <i class="icofont-refresh"></i>

                                                </div>
                                            </div>
                                            <input type="hidden" name="vendor" value="1">
                                            <input class="mprocessdata" type="hidden" value="{{ __('Processing...') }}">
                                            <button type="submit" class="submit-btn">{{ __('Register') }}</button>
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

    <!-- Vendor Login Modal Ends -->

    <!-- Forgot Modal -->
    
	<div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title"
		aria-hidden="true">
		<div class="modal-dialog  modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="login-area">
						<div class="header-area forgot-passwor-area">
							<h4 class="title">{{ __('FORGOT PASSWORD') }} </h4>
							<p class="text">{{ __('Please Write your Email') }}</p>
						</div>
						<div class="login-form">
							@include('alerts.admin.form-login')
							<form id="mforgotform" action="{{route('user.forgot.submit')}}" method="POST">
								@csrf
								<div class="form-input">
									<input type="email" name="email" class="User Name" placeholder="{{ __('Email Address') }}" required="">
									<i class="icofont-user-alt-5"></i>
                                </div>
                                <div class="form-forgot-pass justify-content-center">
                                    <div class="right">
                                        <a class="show-login" href="javascript:;" id="">
                                            {{ __('Login Now?') }}
                                        </a>
                                    </div>
                                </div>                                

								<input class="fauthdata" type="hidden" value="{{ __('Checking...') }}">
								<button type="submit" class="submit-btn">{{ __('SUBMIT') }}</button>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
    </div>
    
    <!-- Forgot Modal Ends -->

    <!-- Order Tracking modal Start-->

    <div class="modal fade" id="track-order-modal" tabindex="-1" role="dialog" aria-labelledby="order-tracking-modal" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header p-3">
                    <h4 class="modal-title"> 
                        <b>
                            {{ __('OrderTracking :') }}
                        </b> 
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="order-tracking-content">
                        <form id="track-form" class="track-form">
                            @csrf
                            <input type="text" id="track-code" placeholder="{{ __('Get Tracking Code') }}" required="">
                            <button type="submit" class="mybtn1">{{ __('View Tracking') }}</button>
                        </form>
                    </div>
                    <div>
				        <div class="submit-loader d-none">
                            <img src="{{asset('assets/images/'.$gs->loader)}}" alt="">
                        </div>
                        <div id="track-order"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Tracking modal End -->