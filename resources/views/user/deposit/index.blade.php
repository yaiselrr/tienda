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
				<a href="{{ route('user-deposit-index') }}">
				  {{ __('Deposits') }}
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
									{{ __('Deposits') }}
									<a class="mybtn1" href="{{ route('user-deposit-create') }}"> <i class="fas fa-plus"></i> {{ __('Add Deposit') }}</a>
								</h4>
							</div>
							<div class="mr-table allproduct mt-4">
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ __('Deposit Date') }}</th>
														<th>{{ __('Method') }}</th>
														<th>{{ __('Amount')}}</th>
														<th>{{ __('Status') }}</th>
													</tr>
												</thead>
												<tbody>
													@foreach(Auth::user()->deposits as $data)
														<tr>
															<td>{{date('d-M-Y',strtotime($data->created_at))}}</td>
															<td>{{$data->method}}</td>
															<td>{{ \PriceHelper::showOrderCurrencyPrice(($data->amount * $data->currency_value),$data->currency_code) }}</td>
															<td>{{ $data->status == 1 ? 'Completed' : 'Pending'}}</td>
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
@endsection