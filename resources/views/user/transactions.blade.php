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
				<a href="{{ route('user-transactions-index') }}">
				  {{ __('Transactions') }}
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
							<div class="header-area">
								<h4 class="title" >
									{{ __('Transactions') }}
								</h4>
							</div>
							<div class="mr-table allproduct mt-4">
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ __('Transaction ID') }}</th>
                                                        <th>{{ __('Amount') }}</th>
														<th>{{ __('Transaction Date') }}</th>
                                                        <th>{{ __('Details') }}</th>
														<th>{{ __('View') }}</th>
													</tr>
												</thead>
												<tbody>
                            @foreach(Auth::user()->transactions as $data)
                                <tr>
									<td>{{ $data->txn_number == null ? $data->txnid : $data->txn_number }}</td>
                                    <td>{{ $data->type == 'plus' ? '+' : '-' }} {{ \PriceHelper::showOrderCurrencyPrice(($data->amount * $data->currency_value),$data->currency_sign) }}</td>
                                    <td>{{date('d-M-Y',strtotime($data->created_at))}}</td>
									<td>{{$data->details}}</td>
									<td>
									<a href="javascript:;" data-href="{{ route('user-trans-show',$data->id)}}" data-toggle="modal" data-target="#trans-modal" class="txn-show mybtn2 sm">
										{{ __('View Details') }}
										</a>
									</td>
                                </tr>
                            @endforeach
												</tbody>
											</table>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


<!-- Order Tracking modal Start-->
<div class="modal fade" id="trans-modal" tabindex="-1" role="dialog" aria-labelledby="trans-modal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header p-3">

			<h4 class="modal-title"> 
				<b>
					{{ __('Transaction Details') }}
				</b> 
			</h4>


			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body" id="trans">

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

    $('.txn-show').on('click',function(e){
        var url = $(this).data('href');
        $('#trans').load(url);
        $('#trans-modal').modal('show');
    });

})(jQuery);

</script>

@endsection