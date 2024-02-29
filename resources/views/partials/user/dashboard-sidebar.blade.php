        <div class="col-lg-4 mycol">
          <div class="user-profile-info-area">
            <ul class="links">
                
              <li class="{{ Request::url() == route('user-dashboard') ? 'active':'' }}">
                <a href="{{ route('user-dashboard') }}">
                  {{ __('Dashboard') }}
                </a>
              </li>
              
              <li class="{{ Request::url() == route('user-orders') ? 'active':'' }}">
                <a href="{{ route('user-orders') }}">
                  {{ __('Purchased Items') }}
                </a>
              </li>


              <li class="{{ Request::url() == route('user-deposit-index') ? 'active':'' }}">
                <a href="{{route('user-deposit-index')}}">{{ __('Deposit') }}</a>
              </li>
  
              <li class="{{ Request::url() == route('user-transactions-index') ? 'active':'' }}">
                <a href="{{route('user-transactions-index')}}">{{ __('Transactions') }}</a>
              </li>

              <li class="{{ Request::url() == route('user-reward-index') ? 'active':'' }}">
                <a href="{{route('user-reward-index')}}">{{ __('Rewards') }}</a>
              </li>


              @if($gs->is_affilate == 1)

                <li class="{{ Request::url() == route('user-affilate-program') ? 'active':'' }}">
                    <a href="{{ route('user-affilate-program') }}">{{ __('Affiliate Program') }}</a>
                </li>

                <li class="{{ Request::url() == route('user-wwt-index') ? 'active':'' }}">
                    <a href="{{route('user-wwt-index')}}">{{ __('Withdraw') }}</a>
                </li>

              @endif


              <li class="{{ Request::url() == route('user-order-track') ? 'active':'' }}">
                  <a href="{{route('user-order-track')}}">{{ __('Order Tracking') }}</a>
              </li>

              <li class="{{ Request::url() == route('user-messages') ? 'active':'' }}">
                  <a href="{{route('user-messages')}}">{{ __('Messages') }}</a>
              </li>

              <li class="{{ Request::url() == route('user-message-index') ? 'active':'' }}">
                  <a href="{{route('user-message-index')}}">{{ __('Tickets') }}</a>
              </li>

              <li class="{{ Request::url() == route('user-dmessage-index') ? 'active':'' }}">
                  <a href="{{ route('user-dmessage-index') }}">{{ __('Disputes') }}</a>
              </li>

              <li class="{{ Request::url() == route('user-profile') ? 'active':'' }}">
                <a href="{{ route('user-profile') }}">
                  {{ __('Edit Profile') }}
                </a>
              </li>

              <li class="{{ Request::url() == route('user-reset') ? 'active':'' }}">
                <a href="{{ route('user-reset') }}">
                  {{ __('Reset Password') }}
                </a>
              </li>

              <li>
                <a href="{{ route('user-logout') }}">
                  {{ __('Logout') }}
                </a>
              </li>

            </ul>
          </div>
        </div>