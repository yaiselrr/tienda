<a href="{{ route('front.product',$prod->slug) }}" class="single-product-landscape">
    <div class="img">
        <img class="lozad" data-src="{{ $prod->thumbnail ? asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" alt="">
    </div>
    <div class="content">
        <p class="price">{{ $prod->showPrice() }} <small><del>{{ $prod->showPreviousPrice() }}</del></small></p>
        <ul class="stars">
            <div class="ratings">
                <div class="empty-stars"></div>
                <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
            </div>
            <li>
                <span>({{ App\Models\Rating::ratingCount($prod->id) }})</span>
            </li>
        </ul>
        <div class="box">
            <h4 class="name">
                {{ mb_strlen($prod->name,'UTF-8') > 35 ? mb_substr($prod->name,0,35,'UTF-8').'...' : $prod->name }}
            </h4>
            
            <ul class="action-meta">

                    {{-- WISHLIST SECTION --}}

                    @if(Auth::check())
                    <li>
                        <span class="wish add-to-wish" data-href="{{ route('user-wishlist-add',$prod->id) }}" data-toggle="tooltip" data-placement="top" title="{{ __('Wish') }}">
                            <i class="far fa-heart"></i>
                        </span>
                    </li>
                    @else 
                    <li>
                        <span class="cart-btn add-to-cart add-to-cart-btn" data-href="{{ route('product.cart.add',$prod->id) }}"  title="{{ __('Add To Cart') }}">
                            <i class="icofont-cart"></i> 
                        </span>
                    </li>
                    <li>
                        <span class="cart-btn quick-view" data-href="{{ route('product.quick',$prod->id) }}" rel-toggle="tooltip" data-placement="top" title="{{ __('Quick View') }}" data-toggle="modal" data-target="#quickview">
                            <i class="fas fa-eye"></i> 
                        </span>
                    </li>
                    @endif

                    {{-- WISHLIST SECTION ENDS --}}

                    {{-- ADD TO CART SECTION --}}

                    @if($prod->product_type == "affiliate")
                    <li>
                        <span class="cart-btn affilate-btn" data-href="{{ $prod->affiliate_link }}" data-toggle="tooltip" data-placement="top" title="{{ __('Buy Now') }}">
                            <i class="icofont-cart"></i>
                        </span>
                    </li>
                    @else
                        @if($prod->emptyStock())
                        <li>
                            <span class="cart-btn cart-out-of-stock" data-toggle="tooltip" data-placement="top" title="{{ __('Out Of Stock') }}">
                                <i class="icofont-close-circled"></i> 
                            </span>
                        </li>
                        @else
                        <li>
							<span class="cart-btn add-to-cart add-to-cart-btn" data-href="{{ route('product.cart.add',$prod->id) }}"  title="{{ __('Add To Cart') }}">
								<i class="icofont-cart"></i> 
							</span>
						</li>
						<li>
							<span class="cart-btn quick-view" data-href="{{ route('product.quick',$prod->id) }}" rel-toggle="tooltip" data-placement="top" title="{{ __('Quick View') }}" data-toggle="modal" data-target="#quickview">
								<i class="fas fa-eye"></i> 
							</span>
						</li>
                        @endif
                    @endif

                    {{-- ADD TO CART SECTION ENDS --}}

                    {{-- ADD TO COMPARE SECTION --}}

                    <li>
                        <span class="compear add-to-compare" data-href="{{ route('product.compare.add',$prod->id) }}" data-toggle="tooltip" data-placement="top" title="{{ __('Compare') }}">
                            <i class="fas fa-random"></i>
                        </span>
                    </li>

                    {{-- ADD TO COMPARE SECTION ENDS --}}

                </ul>


        </div>
    </div>
</a>