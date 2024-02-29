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
              {{ __("Home") }}
            </a>
          </li>
          <li class="active">
            <a href="{{ route('front.cart') }}">
              {{ __("Cart") }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Area End -->

<!-- Cart Area Start -->
<section class="cartpage">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="left-area">
          <div class="cart-table">
            <div class="gocover" style="position: absolute; background: url({{ asset('assets/images/xloading.gif') }}) center center no-repeat scroll rgba(255, 255, 255, 0.5); display: none;"></div>
            <table class="table">
              @include('alerts.form-success')
              <thead>
                <tr>
                  <th>{{ __('Product Name') }}</th>
                  <th width="30%">{{ __('Details') }}</th>
                  <th>{{ __('	Unit Price') }}</th>
                  <th>{{ __('Sub Total') }}</th>
                  <th><i class="icofont-close-squared-alt"></i></th>
                </tr>
              </thead>
              <tbody>
                @if(Session::has('cart'))

                @foreach($products as $product)
                <tr
                  class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}">
                  <td class="product-img">
                    <div class="item">
                      <img
                        src="{{ $product['item']['photo'] ? asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}"
                        alt="">
                      <p class="name"><a
                          href="{{ route('front.product', $product['item']['slug']) }}">{{ mb_strlen($product['item']['name'],'UTF-8') > 35 ? mb_substr($product['item']['name'],0,35,'UTF-8').'...' : $product['item']['name']}}</a>
                      </p>
                    </div>
                  </td>
                  <td>
                    @if(!empty($product['size']))
                    <b>{{ __('Size') }}</b>: {{ $product['item']['measure'] }}{{str_replace('-',' ',$product['size'])}} <br>
                    @endif
                    @if(!empty($product['color']))
                    <div class="d-flex mt-2">
                      <b>{{ __('Color') }}</b>: <span id="color-bar"
                        style="border: 10px solid #{{$product['color'] == "" ? "white" : $product['color']}};"></span>
                    </div>
                    @endif

                    @if(!empty($product['keys']))

                    @foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values'])) as $key =>
                    $value)

                    <b>{{ ucwords(str_replace('_', ' ', $key))  }} : </b> {{ $value }} <br>
                    @endforeach

                    @endif

                  </td>

                  <td class="unit-price quantity">
                    <p class="product-unit-price">
                      {{ App\Models\Product::convertPrice($product['item_price']) }} 
                    </p>
                    @if($product['item']['type'] == 'Physical')
                    <div class="multiple-item-price">
                      <div class="qty">
                        <ul>
                          <input type="hidden" class="prodid" value="{{$product['item']['id']}}">
                          <input type="hidden" class="itemid"
                            value="{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">
                          <input type="hidden" class="size_qty" value="{{$product['size_qty']}}">
                          <input type="hidden" class="size_price" value="{{$product['size_price']}}">  
                          <input type="hidden" class="minimum_qty" value="{{ $product['item']['minimum_qty'] == null ? '0' : $product['item']['minimum_qty'] }}">    
                          <li>
                            <span class="qtminus1 reducing">
                              <i class="icofont-minus"></i>
                            </span>
                          </li>
                          <li>
                            <span class="qttotal1"
                              id="qty{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{ $product['qty'] }}</span>
                          </li>
                          <li>
                            <span class="qtplus1 adding">
                              <i class="icofont-plus"></i>
                            </span>
                          </li>
                        </ul>
                      </div>
                    </div>

                    @endif

                  </td>

                  @if($product['size_qty'])
                  <input type="hidden"
                    id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}"
                    value="{{$product['size_qty']}}">
                  @elseif($product['item']['type'] != 'Physical')
                  <input type="hidden"
                    id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}"
                    value="1">
                  @else
                  <input type="hidden"
                    id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}"
                    value="{{$product['stock']}}">
                  @endif

                  <td class="total-price">
                    <p class="d-inline-block"
                      id="prc{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">
                      {{ App\Models\Product::convertPrice($product['price']) }}
                    </p>
                    <small id="discount{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}"
                    >{{ $product['discount'] == 0 ? '' : '('.$product['discount'].'% '.__('Off').')' }}</small>
                  </td>
                  <td>
                    <span class="removecart cart-remove"
                      data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}"
                      data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}"><i
                        class="icofont-ui-delete"></i> </span>
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
      @if(Session::has('cart'))
      <div class="col-lg-4">
        <div class="right-area">
          <div class="order-box">
            <h4 class="title">{{ __('PRICE DETAILS') }}</h4>
            <ul class="order-list">
              <li>
                <p>
                  {{ __('Total MRP') }}
                </p>
                <P>
                  <b
                    class="cart-total">{{ Session::has('cart') ? App\Models\Product::convertPrice($totalPrice) : '0.00' }}</b>
                </P>
              </li>
              <li>
                <p>
                  {{ __('Discount') }}
                </p>
                <P>
                  <b class="discount">{{ App\Models\Product::convertPrice(0)}}</b>
                  <input type="hidden" id="d-val" value="{{ App\Models\Product::convertPrice(0)}}">
                </P>
              </li>
            </ul>
            <div class="total-price">
              <p>
                {{ __('Total') }}
              </p>
              <p>
                <span
                  class="main-total">{{ Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00' }}</span>
              </p>
            </div>
            <div class="cupon-box">
              <div id="coupon-link">
                {{ __('HAVE A PROMOTION CODE?') }}
              </div>
              <form id="coupon-form" class="coupon">
                <input type="text" placeholder="{{ __('Coupon Code') }}" id="code" required="" autocomplete="off">
                <input type="hidden" class="coupon-total" id="grandtotal"
                  value="{{ Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00' }}">
                <button type="submit">{{ __('APPLY') }}</button>
              </form>
            </div>
            <a href="{{ route('front.checkout') }}" class="order-btn">
              {{ __('Place Order') }}
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</section>
<!-- Cart Area End -->
@endsection