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
        <li>
          <a href="{{ route('user-deposit-index') }}">
            {{ __('Deposits') }}
          </a>
        </li>
        <li class="active">
          <a href="{{ route('user-deposit-create') }}">
            {{ __('Add Deposit') }}
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
                    {{ __('Deposit') }} 
                    <a class="mybtn1" href="{{ url()->previous() }}"> 
                      <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>
                  </h4>
              </div>
              <div class="pack-details">
                  <div class="row">

                      <div class="col-lg-4">
                          <h5 class="title">
                            {{ __('Current Balance') }}
                          </h5>
                      </div>
                      <div class="col-lg-8">
                          <p class="value">
                            {{ App\Models\Product::vendorConvertPrice(Auth::user()->balance) }}
                          </p>
                      </div>
                  </div>

                  <form id="deposit-form" class="pay-form" action="" method="POST">

                      @include('alerts.form-success')
                      @include('alerts.form-error')

                      @csrf


                      <div class="row mb-3">
                          <div class="col-lg-4">
                              <h5 class="title pt-1">
                                {{ __('Deposit Amount') }} *
                              </h5>
                          </div>
                          <div class="col-lg-8">
                          <input type="number" class="option" min="1" id="amount"  name="amount" placeholder="{{ $curr->name }}" step="0.01" required="" value="{{ old('amount') }}">
                          </div>
                        </div>


                      <div class="row">
                          <div class="col-lg-4">
                              <h5 class="title pt-1">
                                  {{ __('Select Payment Method') }} *
                              </h5>
                          </div>
                          <div class="col-lg-8">

                              <select name="method" id="method" class="option" required="">

                                  <option value="" data-form="" data-show="no" data-val="" data-href="">
                                    {{ __('Select an option') }}
                                  </option>

                                  @foreach($gateway as $paydata)

                                    @if($paydata->type == 'manual')

                                    <option value="{{ $paydata->title }}" data-form="{{ $paydata->showDepositLink() }}" data-show="{{ $paydata->showForm() }}" data-href="{{ route('user.load.payment',['slug1' => $paydata->showKeyword(),'slug2' => $paydata->id]) }}" data-val="{{ $paydata->keyword }}">
                                      {{ $paydata->title }}
                                    </option>

                                    @else 

                                    <option value="{{ $paydata->name }}" data-form="{{ $paydata->showDepositLink() }}" data-show="{{ $paydata->showForm() }}" data-href="{{ route('user.load.payment',['slug1' => $paydata->showKeyword(),'slug2' => $paydata->id]) }}" data-val="{{ $paydata->keyword }}">
                                      {{ $paydata->name }}
                                    </option>

                                    @endif

                                  @endforeach
                              </select>

                          </div>
                      </div>

                      <div id="payments" class="d-none">

                      </div>

                      <input type="hidden" name="sub" id="sub" value="0">

                      <div class="row">
                          <div class="col-lg-4">
                          </div>
                          <div class="col-lg-8">
                              <button type="submit" id="final-btn" class="mybtn1">{{ __('Submit') }}</button>
                          </div>
                      </div>

                  </form>

              </div>
          </div>
      </div>



					</div>
		</div>
	  </div>

</section>

@endsection

@section('scripts')

<script type="text/javascript" src="{{ asset('assets/front/js/payvalid.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/front/js/paymin.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/front/js/payform.js') }}"></script>

<script src="https://js.paystack.co/v1/inline.js"></script>

<script src="//voguepay.com/js/voguepay.js"></script>

<script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>

<script type="text/javascript">

(function($) {
		"use strict";

$('#method').on('change',function(){
    var val  = $(this).find(':selected').attr('data-val');
    var form = $(this).find(':selected').attr('data-form');
    var show = $(this).find(':selected').attr('data-show');
    var href = $(this).find(':selected').attr('data-href');

    if(show == "yes"){
        $('#payments').removeClass('d-none');
    }else{
        $('#payments').addClass('d-none');
    }

    if(val == 'paystack'){
			$('.pay-form').prop('id','paystack');
      $('#amount').prop('name','amount');
		}
		else if(val == 'voguepay'){
			$('.pay-form').prop('id','voguepay');
      $('#amount').prop('name','amount');
		}
		else if(val == 'mercadopago'){
			$('.pay-form').prop('id','mercadopago');
      $('#amount').prop('name','deposit_amount');
		}
		else if(val == '2checkout'){
			$('.pay-form').prop('id','twocheckout');
      $('#amount').prop('name','amount');
		}
		else {
			$('.pay-form').prop('id','deposit-form');
      $('#amount').prop('name','amount');
		}


    $('#payments').load(href);
    $('.pay-form').attr('action',form);
});


    $(document).on('submit','#paystack',function(){
            var val = $('#sub').val();
            if(val == 0){
                var total = $('#amount').val();
                total = Math.round(total);
                var handler = PaystackPop.setup({
                key: '{{ $paystack["key"] }}',
                email: '{{ Auth::user()->email }}',
                amount: total * 100,
                currency: "{{ $curr->name }}",
                ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                    callback: function(response){
                        $('#ref_id').val(response.reference);
                        $('#sub').val('1');
                        $('#final-btn').click();
                    },
                    onClose: function(){
                        window.location.reload();
                    }
                });
                handler.openIframe();
                 return false;                    

            }
            else {
                return true;   
            }
		});
		
        $(document).on('submit','#voguepay',function(e){
            var val = $('#sub').val();
            if(val == 0)
            {
                var total = $('#amount').val();
                e.preventDefault();
                Voguepay.init({
                    v_merchant_id: '',
                    total: total,
                    cur: '{{ $curr->name }}',
                    merchant_ref: 'ref'+Math.floor((Math.random() * 1000000000) + 1),
                    memo:'{{ $gs->title }} Order',
                    developer_code: '',
                    store_id:'{{ Auth::user() ? Auth::user()->id : 0 }}',
                    closed:function(){
                        var newval = $('#sub').val();
                        if(newval == 0){
                            window.location.reload();
                        }
                        else {
                            $('#final-btn').click();
                        }
                    },
                    success:function(transaction_id){
                        $('#ref_id').val(transaction_id);
                        $('#sub').val('1');
                    },
                    failed:function(){
                        window.location.reload();
                    }
                });
                return false;  
            }
            else {
                return true;   
            }
		});

})(jQuery);

</script>

@endsection