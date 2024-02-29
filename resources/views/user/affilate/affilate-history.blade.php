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
					<a href="{{ route('user-affilate-history') }}">
					  {{ __('Affiliate History') }}
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
									{{ __('Affiliate History') }}
									<a class="mybtn1" href="{{route('user-affilate-program')}}"> 
										<i class="fas fa-arrow-left"></i>
										{{ __('Back') }}
									</a>
								</h4>
							</div>
							<div class="mr-table allproduct mt-4">
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ __('Customer Name') }}</th>
														<th>{{ __('Product') }}</th>
														<th>{{ __('Affiliate Bonus') }}</th>
													</tr>
												</thead>
												<tbody>

													@foreach($final_affilate_users as $fuser)


													<tr>
														<td>
															{{ $fuser['customer_name'] }}
														</td>
														<td>
															@php 
															$product = \App\Models\Product::find($fuser['product_id']);
															@endphp
															<a href="{{ route('front.product', $product->slug) }}" target="_blank">{{ $product->name }}</a>
														</td>
														<td>
															{{ $fuser['charge'] }}
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