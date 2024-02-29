<div class="row">
    @foreach($wishlists as $wishlist)

    <div class="col-xl-2 col-md-4 col-6 mycol">
        <a href="{{ route('front.product', $wishlist->slug) }}" class="single-product">
            <div class="remove wishlist-remove" data-href="{{ route('user-wishlist-remove', App\Models\Wishlist::where('user_id','=',$user->id)->where('product_id','=',$wishlist->id)->first()->id ) }}">
                <i class="fas fa-times"></i>
            </div>
            <div class="img">
                <img src="{{ $wishlist->photo ? asset('assets/images/products/'.$wishlist->photo):asset('assets/images/noimage.png') }}"
                    alt="">
            </div>
            <div class="content">
                <p class="price">
                    {{ $wishlist->showPrice() }}
                    <small>
                        <del>
                            {{ $wishlist->showPreviousPrice() }}
                        </del>
                    </small>
                </p>
                <ul class="stars">
                    <div class="ratings">
                        <div class="empty-stars"></div>
                        <div class="full-stars" style="width:{{App\Models\Rating::ratings($wishlist->id)}}%">
                        </div>
                    </div>
                    <li>
                        <span>({{ App\Models\Rating::ratingCount($wishlist->id) }})</span>
                    </li>
                </ul>
                <div class="box">
                    <h4 class="name">
                        {{  mb_strlen($wishlist->name,'UTF-8') > 35 ? mb_substr($wishlist->name,0,35,'UTF-8').'...' : $wishlist->name }}
                    </h4>
                    <ul class="action-meta">

                        {{-- ADD TO CART SECTION --}}

                        @if($wishlist->product_type == "affiliate")
                        <li>
                            <span class="cart-btn affilate-btn"
                                data-href="{{ route('affiliate.product', $wishlist->slug) }}">
                                <i class="icofont-cart"></i>
                            </span>
                        </li>
                        @else
                        @if($wishlist->emptyStock())
                        <li>
                            <span class="cart-btn cart-out-of-stock" data-toggle="tooltip" data-placement="top"
                                title="{{ __('Out Of Stock') }}">
                                <i class="icofont-close-circled"></i>
                            </span>
                        </li>
                        @else
                        <li>
                            <span class="cart-btn quick-view"
                                data-href="{{ route('product.quick',$wishlist->id) }}" rel-toggle="tooltip"
                                data-placement="top" title="{{ __('Add To Cart') }}" data-toggle="modal"
                                data-target="#quickview">
                                <i class="icofont-cart"></i>
                            </span>
                        </li>
                        @endif
                        @endif

                        {{-- ADD TO CART SECTION ENDS --}}

                        {{-- ADD TO COMPARE SECTION --}}

                        <li>
                            <span class="compear add-to-compare"
                                data-href="{{ route('product.compare.add',$wishlist->id) }}"
                                data-toggle="tooltip" data-placement="top" title="{{ __('Compare') }}">
                                <i class="fas fa-random"></i>
                            </span>
                        </li>

                        {{-- ADD TO COMPARE SECTION ENDS --}}

                    </ul>
                </div>
            </div>
        </a>
    </div>

    @endforeach
</div>

<div class="page-center category">
    {{ $wishlists->appends(['sort' => $sort,'pageby' => $pageby])->links() }}
</div>

<script>
(function($) {
		"use strict";
    // Tooltip Section
  
    $('[data-toggle="tooltip"]').tooltip({});
  
    $('[rel-toggle="tooltip"]').tooltip();
  
    $('[data-toggle="tooltip"]').on('click', function () {
      $(this).tooltip('hide');
    })
  
  
    $('[rel-toggle="tooltip"]').on('click', function () {
      $(this).tooltip('hide');
    })
})
  
    // Tooltip Section Ends
  </script>