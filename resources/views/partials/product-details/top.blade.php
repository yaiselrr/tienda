<div class="left-area-top-info">
        <div class="row">
          <div class="col-lg-6">
            <div class="xzoom-container">
              <img class="xzoom5" id="xzoom-magnific"
                src="{{ filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo) }}"
                xoriginal="{{ filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo) }}" />
              <div class="xzoom-thumbs">
                <div class="all-slider">

                  <a href="{{filter_var($productt->photo, FILTER_VALIDATE_URL) ?$productt->photo:asset('assets/images/products/'.$productt->photo)}}">
                    <img class="xzoom-gallery5" width="80" src="{{ filter_var($productt->photo, FILTER_VALIDATE_URL) ? $productt->photo:asset('assets/images/products/'.$productt->photo) }}">
                  </a>

                  @foreach($productt->galleries as $gal)

                  <a href="{{asset('assets/images/galleries/'.$gal->photo)}}">
                    <img class="xzoom-gallery5" width="80" src="{{asset('assets/images/galleries/'.$gal->photo)}}" >
                  </a>

                  @endforeach

                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 mycol2">
            <div class="product-info">
              <h4 class="item-name">
                {{ $productt->name }}
              </h4>

              <div class="top-meta">

                  {{-- STOCK SECTION  --}}

                  @if($productt->type == 'Physical')
                      @if($productt->emptyStock())
                      <li class="outStock">
                        <p>
                          <i class="icofont-close-circled"></i>
                          {{ __('Out Of Stock') }}
                        </p>
                      </li>
                      @else
                      <div class="isStock">
                          <span>
                            <i class="far fa-check-circle"></i> 
                            {{ $gs->show_stock == 0 ? '' : $productt->stock }} {{ __('In Stock') }}
                          </span>
                      </div>
                      @endif
                  @endif

                  {{-- STOCK SECTION ENDS  --}}


                  {{-- REVIEW SECTION  --}}

                    <div class="stars">
                        <div class="ratings">
                            <div class="empty-stars"></div>
                            <div class="full-stars" style="width:{{ App\Models\Rating::ratings($productt->id) }}%"></div>
                          </div>
                    </div>

                    <div class="review">
                      <i class="far fa-comments"></i> {{ App\Models\Rating::ratingCount($productt->id) }} {{ __('Review') }}
                    </div>

                  {{-- REVIEW SECTION ENDS  --}}


                  {{-- PRODUCT CONDITION SECTION  --}}

                  @if($productt->product_condition != 0)

                    <div class="{{ $productt->product_condition == 2 ? 'condition' : 'no-condition' }}">
                      <span>{{ $productt->product_condition == 2 ?  __('New')  :  __('Used') }}</span>
                    </div>

                  @endif

                  {{-- PRODUCT CONDITION SECTION ENDS --}}                   

                  {{-- PRODUCT WISHLIST SECTION  --}}

                    <div class="wish">

                      @if(Auth::check())

                      <a class="add-to-wish" href="javascript:;" data-href="{{ route('user-wishlist-add',$productt->id) }}" data-toggle="tooltip" data-placement="top" title="{{ __('Wish') }}">
                        <i class="far fa-heart"></i>
                      </a>

                      @else 

                      <a rel-toggle="tooltip" href="javascript:;" title="{{ __('Wish') }}" data-placement="top" class="add-to-wish" data-toggle="modal" data-target="#user-login">
                        <i class="far fa-heart"></i>
                      </a>

                      @endif

                    </div>

                  {{-- PRODUCT WISHLIST SECTION ENDS --}}

                  {{-- PRODUCT COMPARE SECTION  --}}

                    <div class="compear">

                      <a class="add-to-compare" href="javascript:;" data-href="{{ route('product.compare.add',$productt->id) }}" data-toggle="tooltip" data-placement="top" title="{{ __('Compare') }}">
                        <i class="fas fa-random"></i>
                      </a>

                    </div>

                  {{-- PRODUCT COMPARE SECTION  --}}




                  {{-- PRODUCT VIDEO DISPLAY SECTION  --}}
                    @if($productt->youtube != null)
                      <div class="play-video">
                        <a href="{{ $productt->youtube }}" class="video-play-btn mfp-iframe"
                          data-toggle="tooltip" data-placement="top" title="{{ __('Play Video') }}">
                          <i class="fas fa-play"></i>
                        </a>
                      </div>
                    @endif
                  {{-- PRODUCT VIDEO DISPLAY SECTION ENDS  --}}

              </div>

              {{-- PRODUCT PRICE SECTION  --}}                  

              <div class="price-and-discount">
                <div class="price">
                  <div class="current-price" id="sizeprice">
                    {{ $productt->showPrice() }}
                  </div> 
                  <small>
                    <del>
                      {{ $productt->showPreviousPrice() }}
                    </del>
                  </small>
                </div>
              </div>

              {{-- PRODUCT PRICE SECTION ENDS --}}     
              
              @if ($productt->stock_check == 1)
                  
              {{-- PRODUCT SIZE SECTION  --}}    

              @if(!empty($productt->size))
              <div class="product-size">
                <p class="title">{{ __('Size :') }}</p>
                <ul class="siz-list">
                  @foreach(array_unique($productt->size) as $key => $data1)
                <li class="{{ $loop->first ? 'active' : '' }}" data-key="{{ str_replace(' ','',$data1) }}">
                      <span class="box">
                        {{ $data1 }}     
                      </span>
                    </li>
                  @endforeach
                </ul>
              </div>

              @endif

              {{-- PRODUCT SIZE SECTION ENDS  --}}   

              {{-- PRODUCT COLOR SECTION  --}}     

              @if(!empty($productt->color))

              <div class="product-color">
                <div class="title">{{ __('Color :') }}</div>
                <ul class="color-list">

                  @foreach($productt->color as $key => $data1)

                    <li class="{{ $loop->first ? 'active' : '' }} {{ $productt->IsSizeColor($productt->size[$key]) ? str_replace(' ','',$productt->size[$key]) : ''  }} {{ $productt->size[$key] == $productt->size[0] ? 'show-colors' : '' }}">
                      <span class="box" data-color="{{ $productt->color[$key] }}" style="background-color: {{ $productt->color[$key] }}">

                        <input type="hidden" class="size" value="{{ $productt->size[$key] }}">
                        <input type="hidden" class="size_qty" value="{{ $productt->size_qty[$key] }}">
                        <input type="hidden" class="size_key" value="{{$key}}">
                        <input type="hidden" class="size_price" value="{{ round($productt->size_price[$key] * $curr->value,2) }}">                        
                      
                      </span>
                    </li>

                  @endforeach

                </ul>
              </div>

              @endif

              {{-- PRODUCT COLOR SECTION ENDS  --}} 
              
              @else
              @if(!empty($productt->size_all))
              <div class="product-size" data-key="false">
                <p class="title">{{ __('Size :') }}</p>
                <ul class="siz-list">
                  @foreach(array_unique(explode(',',$productt->size_all)) as $key => $data1)
                <li class="{{ $loop->first ? 'active' : '' }}" data-key="{{ str_replace(' ','',$data1) }}">
                      <span class="box">
                        {{ $data1 }}     
                        <input type="hidden" class="size" value="{{$data1}}">   
                        <input type="hidden" class="size_key" value="{{$key}}">   
                      </span>
                    </li>
                  @endforeach
                </ul>
              </div>
              @endif
              @if(!empty($productt->color_all))

              <div class="product-color" data-key="false">
                <div class="title">{{ __('Color :') }}</div>
                <ul class="color-list">

                  @foreach(explode(',',$productt->color_all) as $key => $color1)

                    <li class="{{ $loop->first ? 'active' : '' }} show-colors">
                      <span class="box" data-color="{{ $color1 }}" style="background-color: {{ $color1 }}">
                        <input type="hidden" class="size_price" value="0">
                      </span>
                    </li>

                  @endforeach

                </ul>
              </div>

              @endif
              @endif

              {{-- PRODUCT STOCK CONDITION SECTION  --}}    

              @if(!empty($productt->size))

                <input type="hidden" id="stock" value="{{ $productt->size_qty[0] }}">

                @else


                @if(!$productt->emptyStock())
                  <input type="hidden" id="stock" value="{{ $productt->stock }}">
                @elseif($productt->type != 'Physical')
                  <input type="hidden" id="stock" value="0">
                @else
                  <input type="hidden" id="stock" value="">

                @endif

              @endif

              {{-- PRODUCT STOCK CONDITION SECTION ENDS --}}   

              {{-- PRODUCT ATTRIBUTE SECTION  --}}    

              @if (!empty($productt->attributes))
                @php
                  $attrArr = json_decode($productt->attributes, true);
                @endphp
              @endif
              @if (!empty($attrArr))
                <div class="product-attributes">
                  <div class="row">
                  @foreach ($attrArr as $attrKey => $attrVal)
                    @if (array_key_exists("details_status",$attrVal) && $attrVal['details_status'] == 1)

                  <div class="col-lg-6">
                    <div class="form-group mb-2">
                      <strong for="" class="text-capitalize">{{ str_replace("_", " ", $attrKey) }} :</strong>
                        <div class="">
                        @foreach ($attrVal['values'] as $optionKey => $optionVal)
                          <div class="custom-control custom-radio">
                            <input type="hidden" class="keys" value="">
                            <input type="hidden" class="values" value="">
                            <input type="radio" id="{{$attrKey}}{{ $optionKey }}" name="{{ $attrKey }}" class="custom-control-input product-attr"  data-key="{{ $attrKey }}" data-price = "{{ $attrVal['prices'][$optionKey] * $curr->value }}" value="{{ $optionVal }}" {{ $loop->first ? 'checked' : '' }}>
                            <label class="custom-control-label" for="{{$attrKey}}{{ $optionKey }}">{{ $optionVal }}

                            @if (!empty($attrVal['prices'][$optionKey]))
                              +
                              {{$curr->sign}} {{$attrVal['prices'][$optionKey] * $curr->value}}
                            @endif
                            </label>
                          </div>
                        @endforeach
                        </div>
                    </div>
                  </div>
                    @endif
                  @endforeach
                  </div>
                </div>
              @endif

              {{-- PRODUCT ATTRIBUTE SECTION ENDS  --}}    

              {{-- PRODUCT ADD CART SECTION --}}   

              <input type="hidden" id="product_price" value="{{ round($productt->vendorPrice() * $curr->value,2) }}">
              <input type="hidden" id="product_id" value="{{ $productt->id }}">
              <input type="hidden" id="curr_pos" value="{{ $gs->currency_format }}">
              <input type="hidden" id="curr_sign" value="{{ $curr->sign }}">

              @if(!$productt->emptyStock())

                <div class="inner-box {{ $productt->product_type == 'affiliate' ? 'mt-4' : '' }}y">
                  <div class="cart-btn">
                    <ul class="btn-list">

                      {{-- PRODUCT QUANTITY SECTION --}}

                      @if($productt->product_type != "affiliate" && $productt->type == 'Physical')

                          <li>
                            <div class="multiple-item-price">
                              <div class="qty">
                                <span class="qtplus">
                                  <i class="fas fa-plus"></i>
                                </span>
                                {{-- <span class="qttotal">1</span> --}}
                                <input class="qttotal" type="text" id="order-qty" value="{{ $productt->minimum_qty == null ? '1' : (int)$productt->minimum_qty }}">
                                <input type="hidden" id="affilate_user" value="{{ $affilate_user }}">
                                <input type="hidden" id="product_minimum_qty" value="{{ $productt->minimum_qty == null ? '0' : $productt->minimum_qty }}">
                                <span class="qtminus">
                                  <i class="fas fa-minus"></i>
                                </span>
                              </div>
                            </div>
                          </li>

                      @endif

                      {{-- PRODUCT QUANTITY SECTION ENDS --}}

                      @if($productt->product_type == "affiliate")

                      <li>
                        <a href="{{ route('affiliate.product', $productt->slug) }}" target="_blank">
                          <i class="icofont-cart"></i>
                          {{ __('Purchase Now') }}
                        </a>
                      </li>

                      @else

                      <li>
                        <a href="javascript:;" id="addcrt">
                          <i class="icofont-cart"></i>
                          {{ __('Add To Cart') }}
                        </a>
                      </li>

                      <li>
                        <a id="qaddcrt" href="javascript:;">
                          <i class="icofont-cart"></i>
                          {{ __('Purchase Now') }}
                        </a>
                      </li>

                      @endif

                    </ul>
                  </div>
                </div>

              @endif

              {{-- PRODUCT ADD CART SECTION ENDS --}}    

              {{-- PRODUCT OTHER DETAILS SECTION --}} 

              @if($productt->ship != null)

              <div class="shipping-time">
                {{ __('Estimated Shipping Time:') }} 
                <span>{{ $productt->ship }}</span>
              </div>

              @endif

              @if( $productt->sku != null )

              <div class="product-id {{ $productt->product_type == 'affiliate' ? 'mt-4' : '' }}">
                {{ __('Product SKU:') }} 
                <span>{{ $productt->sku }}</span>
              </div>

              @endif

              {{-- PRODUCT OTHER DETAILS SECTION ENDS --}} 

              {{-- PRODUCT LICENSE SECTION --}} 

              @if($productt->type == 'License')

                @if($productt->platform != null)
                  <div class="license-id">
                      {{ __('Platform:') }} 
                      <span>{{ $productt->platform }}</span>
                  </div>
                @endif

                @if($productt->region != null)
                  <div class="license-id">
                      {{ __('Region:') }} 
                      <span>{{ $productt->region }}</span>
                  </div>
                @endif

                @if($productt->licence_type != null)
                <div class="license-id">
                    {{ __('License Type:') }} 
                    <span>{{ $productt->licence_type }}</span>
                </div>
                @endif

              @endif

              {{-- PRODUCT LICENSE SECTION ENDS--}} 

              {{-- PRODUCT SOCIAL SECTION --}} 

              <div class="social-links social-sharing a2a_kit a2a_kit_size_32">
                  <ul class="share-product social-links">

                  {{-- PRODUCT AFFILIATE SECTION  --}}

                  @if($gs->product_affilate == 1)
                    @if(Auth::check())
                    <li>
                      <a class="add-to-affilate" data-val="{{ \Request::url().'?ref='.Auth::user()->affilate_code }}"  href="javascript:;" data-toggle="tooltip" data-placement="top" title="{{ __('Copy Affiliate Link') }}">
                        <i class="fab fa-affiliatetheme"></i>
                      </a>
                    </li>
                    @endif
                  @endif
                  
                {{-- PRODUCT AFFILIATE SECTION  --}}


                    <li>
                      <a class="facebook a2a_button_facebook" href="">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                    </li>
                    <li>
                      <a class="twitter a2a_button_twitter" href="">
                        <i class="fab fa-twitter"></i>
                      </a>
                    </li>
                    <li>
                      <a class="linkedin a2a_button_linkedin" href="">
                        <i class="fab fa-linkedin-in"></i>
                      </a>
                    </li>
                    <li>
                      <a class="pinterest a2a_button_pinterest" href="">
                        <i class="fab fa-pinterest-p"></i>
                      </a>
                    </li>
                    <li>
                        <a class="instagram a2a_button_whatsapp" href="">
                          <i class="fab fa-whatsapp"></i>
                        </a>
                      </li>
                  </ul>
                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script>

              {{-- PRODUCT SOCIAL SECTION ENDS --}} 

            </div>
          </div>
        </div>
      </div>