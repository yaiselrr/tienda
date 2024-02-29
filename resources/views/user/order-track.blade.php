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
                    <a href="{{ route('user-order-track') }}">
                      {{ __('Order Tracking') }}
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
                <div class="order-history">
                    <div class="header-area d-flex align-items-center">
                        <h4 class="title">{{ __('Get Tracking Code') }}</h4>          
                    </div>
                        <div class="order-tracking-content">
                            @include('alerts.form-success')
                            <form id="t-form" class="tracking-form">
                                @csrf
                                <input type="text" id="code" placeholder="{{ __('Get Tracking Code') }}" required="">
                                <button type="submit" class="mybtn1">{{ __('View Tracking') }}</button>
                                <a href="#"  data-toggle="modal" data-target="#order-tracking-modal"></a>
                            </form>
                        </div>
                      
                    </div>
                </div>
		    </div>
	    </div>
	</div>
</section>


<!-- Order Tracking modal Start-->
    <div class="modal fade" id="order-tracking-modal" tabindex="-1" role="dialog" aria-labelledby="order-tracking-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pt-3 pl-3"> <b>{{ __('Order Tracking') }}</b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="order-track">

            </div>
            </div>
        </div>
    </div>
<!-- Order Tracking modal End -->


@endsection

@section('scripts')

<script type="text/javascript">

(function($) {
		"use strict";

    $('#t-form').on('submit',function(e){
        e.preventDefault();
        var code = $('#code').val();
        $('#order-track').load('{{ url("user/order/trackings/") }}/'+code);
        $('#order-tracking-modal').modal('show');
    });

})(jQuery);

</script>

@endsection

