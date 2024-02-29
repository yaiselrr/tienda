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
                    <a href="{{route('front.category',$productt->category->slug)}}">
                        {{$productt->category->name}}
                    </a>
                </li>
                @if($productt->subcategory_id != null)
                <li>
                    <a href="{{ route('front.category',[$productt->category->slug, $productt->subcategory->slug]) }}">
                    {{$productt->subcategory->name}}
                    </a>
                </li>
                @endif
                @if($productt->childcategory_id != null)
                <li>
                    <a href="{{ route('front.category',[ $productt->category->slug,$productt->subcategory->slug,$productt->childcategory->slug]) }}">
                    {{$productt->childcategory->name}}
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ route('front.product', $productt->slug) }}">
                        {{ $productt->name }}
                    </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- Breadcrumb Area End -->
    
      <!-- Product Details Area start-->
      <section class="product-details-area">
        <div class="container">
          <div class="row">

            <div class="col-lg-9">

{{-- ****************************  PRODUCT DETAILS TOP SECTION ***************************** --}}

  @include('partials.product-details.top')

{{-- ****************************  PRODUCT DETAILS TOP SECTION ENDS ***************************** --}}

{{-- ****************************  PRODUCT DETAILS BOTTOM SECTION ***************************** --}}

              <div class="row">
                <div class="col-lg-12">
                  <div class="product-details-tab">
                    <div class="pdt-menu">
                      <ul class="nav" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="pills-t1-tab" data-toggle="pill" href="#pills-t1" role="tab" aria-controls="pills-t1" aria-selected="true">{{ __('Description') }}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="pills-t2-tab" data-toggle="pill" href="#pills-t2" role="tab" aria-controls="pills-t2" aria-selected="false">{{ __('Buy / Return Policy') }}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="pills-t3-tab" data-toggle="pill" href="#pills-t3" role="tab" aria-controls="pills-t3" aria-selected="false">{{ __('Reviews') }}</a>
                        </li>
                        @if($gs->is_comment == 1)
                        <li class="nav-item">
                            <a class="nav-link" id="pills-t3-tab" data-toggle="pill" href="#pills-t4" role="tab" aria-controls="pills-t4" aria-selected="false">{{ __('Comments') }}</a>
                        </li>
                        @endif
                      </ul>
                    </div>
                    <div class="pdt-content">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-t1" role="tabpanel" aria-labelledby="pills-t1-tab">
                              {!! clean($productt->details , array('Attr.EnableID' => true)) !!}
                            </div>
                            <div class="tab-pane fade" id="pills-t2" role="tabpanel" aria-labelledby="pills-t2-tab">
                              {!! clean($productt->policy , array('Attr.EnableID' => true)) !!}
                            </div>
                            <div class="tab-pane fade" id="pills-t3" role="tabpanel" aria-labelledby="pills-t3-tab">
                                <div id="coment-area">

                                  @include('partials.product-details.reviews')
                          
                                </div>
                            </div>
                            @if($gs->is_comment == 1)
                            <div class="tab-pane fade" id="pills-t4" role="tabpanel" aria-labelledby="pills-t4-tab">

                                <div id="comment-area">

                                    @include('partials.product-details.comment-replies')
          
                                </div>

                            </div>
                            @endif
                         </div>
                    </div>
                  </div>
                </div>
              </div>

{{-- ****************************  PRODUCT DETAILS BOTTOM SECTION ENDS ***************************** --}}
              
            </div>

{{-- ****************************  PRODUCT DETAILS RIGHT SECTION  ***************************** --}}

          @include('partials.product-details.sidebar')

{{-- ****************************  PRODUCT DETAILS RIGHT SECTION ENDS  ***************************** --}}

          </div>

          <div class="row product-row mt-3">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-header-area">
                            <h4 class="title">
                                {{ __('Related Products') }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="row ">
                   @foreach($productt->category->products()->where('status','=',1)->where('id','!=',$productt->id)->take(6)->get()  as $prod)
                    <div class="col-xl-3 col-md-4 col-6 mycol">
                        @include('partials.product.home-product')
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
        
        
        
        <!-- Banner Area End -->
            
        
    
                                     
                                    
      </section>
      <!-- Product Details Area End -->

@if(Auth::guard('web')->check())

@if($productt->user_id != 0)

{{-- MESSAGE VENDOR MODAL --}}

  <!-- Message modal Start-->
  <div class="message-modal">
      <div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="vendorformLabel">{{ __('Send Message') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
          <div class="modal-body">
            <div class="container-fluid p-0">
              <div class="row">
                <div class="col-md-12">
                  <div class="contact-form">
                  <form action="{{ route('front.vendor.contact') }}" class="emailreply">
                      @csrf
                      <ul>
                        <li>
                          <input type="text" class="input-field" readonly="" placeholder="{{ __('Send To').' '.$productt->user->shop_name }}" readonly="">
                        </li>
                        <li>
                          <input type="text" class="input-field" name="subject" placeholder="{{ __('Subject *') }}" required="">
                        </li>
                        <li>
                          <textarea class="input-field textarea" name="message" placeholder="{{ __('Your Message') }}" required=""></textarea>
                        </li>
                        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                        <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="vendor_id" value="{{ $productt->user->id }}">
                      </ul>
                      <button class="submit-btn" type="submit">{{ __('Send Message') }}</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  <!-- Message modal End-->

{{-- MESSAGE VENDOR MODAL ENDS --}}

@endif

@endif

<div class="message-modal">
  <div class="modal show" id="sendMessage" tabindex="-1" role="dialog" aria-labelledby="sendMessageLabel" aria-modal="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="sendMessageLabel">{{ __('Send Message') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid p-0">
            <div class="row">
              <div class="col-md-12">
                <div class="contact-form">
                <form action="{{ route('user-send-message') }}" class="emailreply">
                    @csrf
                    <ul>
                      <li>
                        <input type="text" class="input-field" name="subject" placeholder="{{ __('Subject *') }}" required="">
                      </li>
                      <li>
                        <textarea class="input-field textarea" name="message" placeholder="{{ __('Your Message') }}" required=""></textarea>
                      </li>
                      <input type="hidden" name="type" value="Ticket">
                    </ul>
                    <button class="submit-btn" type="submit">{{ __('Send Message') }}</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection