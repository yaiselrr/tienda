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
					<a href="{{ route('user-orders') }}">
					  {{ __('Purchased Items') }}
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
								<h4 class="title">
									{{ __('Purchased Items') }}
								</h4>
							</div>
							<div class="mr-table allproduct mt-4">
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ __('#Order') }}</th>
														<th>{{ __('Date') }}</th>
														<th>{{ __('Order Total') }}</th>
														<th>{{ __('Order Status') }}</th>
														<th>{{ __('View') }}</th>
													</tr>
												</thead>
												<tbody>
													 @foreach($orders as $order)
													<tr>
														<td>
																{{$order->order_number}}
														</td>
														<td>
																{{date('d M Y',strtotime($order->created_at))}}
														</td>
														<td>
															{{ \PriceHelper::showOrderCurrencyPrice(($order->pay_amount  * $order->currency_value),$order->currency_sign) }}
														</td>
														<td>
															<div class="order-status {{ $order->status }}">
																	{{ucwords($order->status)}}
															</div>
														</td>
														<td>
															<a class="theme-bg btn-rounded btn-rounded-padding" href="{{route('user-order',$order->id)}}">
																	{{ __('VIEW ORDER') }}
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
@endsection