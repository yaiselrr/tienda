    <!-- Top Header Area Start -->
    <section class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                        <div class="left-content">
                            <div class="list">
                                <ul>
                                    <li>
                                        <div class="language-selector">
                                            <i class="fas fa-globe-americas"></i>
                                            <select name="language" class="language selectors nice">
                                                @foreach(DB::table('languages')->get() as $language)
                                                <option value="{{route('front.language',$language->id)}}" {{ Session::has('language') ? ( Session::get('language') == $language->id ? 'selected' : '' ) : (DB::table('languages')->where('is_default','=',1)->first()->id == $language->id ? 'selected' : '') }} >
                                                    <!-- {{$language->language}} -->prueba
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="currency-selector">
                                            <span>{{ Session::has('currency') ? DB::table('currencies')->where('id','=',Session::get('currency'))->first()->sign   : DB::table('currencies')->where('is_default','=',1)->first()->sign }}</span>
                                            <select name="currency" class="currency selectors nice">
                                                @foreach(DB::table('currencies')->get() as $currency)
                                                <option value="{{route('front.currency',$currency->id)}}" {{ Session::has('currency') ? ( Session::get('currency') == $currency->id ? 'selected' : '' ) : (DB::table('currencies')->where('is_default','=',1)->first()->id == $currency->id ? 'selected' : '') }}>
                                                    {{$currency->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="right-content">
                            <div class="list">
                                <ul>
                                    @if(Auth::check())

                                    <li class="profilearea my-dropdown">
                                        <a href="javascript: ;" id="profile-icon" class="profile carticon">
                                            <span class="text">
                                                <i class="far fa-user"></i> {{ __('My Account') }} <i
                                                    class="fas fa-chevron-down"></i>
                                            </span>
                                        </a>
                                        <div class="my-dropdown-menu profile-dropdown">
                                            <ul class="profile-links">
                                                <li>
                                                    <a href="{{ route('user-dashboard') }}"><i
                                                            class="fas fa-angle-double-right"></i>
                                                            {{ __('User Panel') }}</a>
                                                </li>
                                                

                                                <li>
                                                    <a href="{{ route('user-profile') }}"><i
                                                            class="fas fa-angle-double-right"></i>
                                                            {{ __('Edit Profile') }}</a>
                                                </li>

                                                <li>
                                                    <a href="{{ route('user-logout') }}"><i
                                                            class="fas fa-angle-double-right"></i>
                                                            {{ __('Logout') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                    @else
                                    <li class="login">
                                        <a href="javascript:;" class="sign-log">
                                            <div class="links">
                                                <span class="sign-in" data-toggle="modal" data-target="#user-login"><i
                                                        class="fas fa-user"></i>{{ __('Sign in') }}</span>
                                                <span>|</span>
                                                <span class="join" data-toggle="modal"
                                                    data-target="#user-login">{{ __('Join') }}</span>
                                            </div>
                                        </a>
                                    </li>
                                    @endif

                        			

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Top Header Area End -->

    <!-- Logo Header Area Start -->
    <section class="logo-header">
        <div class="container">
            <div class="row ">
                <div class="col-lg-2 col-md-4  col-5">
                    <div class="logo">
                        <a href="{{ route('front.index') }}">
                            <img class="lozad" data-src="{{ asset('assets/images/'.$gs->logo) }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-4 col-2 d-none d-lg-block">
                </div>
                <div class="col-lg-3 col-md-8 col-7">
                    <div class="helpful-links">
                        <ul>
                            <li class="my-dropdown">
                                <a href="javascript:;" class="cart carticon">
                                    <div id="total-cost" class="balence">
                                        {{ Session::has('cart') ? App\Models\Product::convertPrice(Session::get('cart')->totalPrice) : App\Models\Product::convertPrice('0.00') }}
                                    </div>
                                    <div class="icon" data-toggle="tooltip" data-placement="right" title="{{ __('Cart') }}">
                                        <i class="icofont-cart"></i>
                                        <span class="cart-quantity" id="cart-count">{{ Session::has('cart') ? count(Session::get('cart')->items) : '0' }}</span>
                                    </div>
                                </a>
                                <div class="my-dropdown-menu" id="cart-items">
                                    @include('load.cart')
                                </div>
                            </li>

							<li class="wishlist"  data-toggle="tooltip" data-placement="right" title="{{ __('Wish') }}">
								@if(Auth::check())
                                    <a href="{{ route('user-wishlists') }}" class="wish">
                                        <div class="icon">
                                            <i class="far fa-heart"></i>
                                            <span id="wishlist-count">
                                                {{ Auth::user()->wishlistCount() }}
                                            </span>
                                        </div>
									</a>
								@else
									<a href="javascript:;" data-toggle="modal" id="wish-btn" data-target="#user-login" class="wish">
                                        <div class="icon">
                                            <i class="far fa-heart"></i>
                                            <span id="wishlist-count">0</span>
                                        </div>
									</a>
								@endif
							</li>

                            <li>
                                <a href="{{ route('product.compare') }}" class="wish" data-toggle="tooltip"
                                    data-placement="right" title="{{ __('Compare') }}">
                                    <div class="icon">
                                        <i class="icofont-random"></i>
                                        <span id="compare-count">
                                            {{ Session::has('compare') ? count(Session::get('compare')->items) : '0' }}
                                        </span>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <div class="off-canvas-menu-toggle">
                                    <i class="fas fa-bars"></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Logo Header Area End -->
    
    <!--Main-Menu Area Start-->
    <div class="mainmenu-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="mycol1">
                    <!--categorie menu start-->
                    <div class="categories_menu">
                        <div class="categories_title">
                            <h2 class="categori_toggle"><i class="fa fa-bars"></i> <span>{{ __('Categories') }}</span>
                                <i class="fa fa-angle-down arrow-down"></i></h2>
                        </div>
                        <div class="categories_menu_inner">
                            <ul>
                                @foreach(App\Models\Category::where('language_id',$langg->id)->whereStatus(1)->get() as $category)
                                <li class="{{ count($category->subs) > 0 ? 'dropdown_list':'' }}">
                                    <div class="link-area">
                                        <span>
                                            <a href="{{ route('front.category',$category->slug) }}">
                                                <img class="lozad"
                                                    data-src="{{ asset('assets/images/categories/'.$category->photo) }}">
                                                {{ mb_strlen($category->name,'UTF-8') > 24 ? mb_substr($category->name,0,24,'UTF-8') : $category->name }}
                                            </a>
                                        </span>
                                        {{-- If there is subcategories --}}
                                        @if(count($category->subs) > 0)
                                        <a href="javascript:;">
                                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                        @endif
                                    </div>
                                    {{-- If there is subcategories --}}
                                    @if(count($category->subs) > 0)
                                    
                                    <ul
                                        class="categories_mega_menu {{ $category->subs()->withCount('childs')->get()->sum('childs_count') > 0 ? '' : 'column_1' }}">
                                        @foreach($category->subs()->where('language_id',$langg->id)->where('status',1)->get() as $subcat)
                                        <li>
                                            <a
                                                href="{{ route('front.category',[$category->slug,$subcat->slug]) }}">
                                                {{ $subcat->name }}
                                            </a>
                                            {{-- If there is childcategories --}}
                                            @if(count($subcat->childs) > 0)
                                            <div class="categorie_sub_menu">
                                                <ul>
                                                    @foreach($subcat->childs()->where('language_id',$langg->id)->where('status',1)->get() as $childcat)
                                                    <li>
                                                        <a
                                                            href="{{ route('front.category',[$category->slug,$subcat->slug,$childcat->slug]) }}">
                                                            {{ $childcat->name }}
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @if($loop->index == 12)
                                <li>
                                    <a href="{{ route('front.categories') }}"><img class="lozad"
                                            data-src="{{ asset('assets/front/img/icon.jpg') }}">
                                        {{ __('See All Categories') }}
                                    </a>
                                </li>
                                @break
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!--categorie menu end-->
                </div>
                <div class="mycol2">
                    <div class="search-box">
                        <div class="categori-container" id="catSelectForm">
                            <select name="category" class="categoris" id="category_select">
                                <option value="">{{ __('All Categories') }}</option>
                                @foreach(DB::table('categories')->where('language_id',$langg->id)->where('status',1)->get() as $data)
                                    <option value="{{ $data->slug }}" {{ Request::route('category') == $data->slug ? 'selected' : '' }}>
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <form id="searchForm" class="search-form" action="{{ route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')]) }}" method="GET">
                            @if (!empty(request()->input('sort')))
                                <input type="hidden" name="sort" value="{{ request()->input('sort') }}">
                            @endif
                            @if (!empty(request()->input('minprice')))
                                <input type="hidden" name="minprice" value="{{ request()->input('minprice') }}">
                            @endif
                            @if (!empty(request()->input('maxprice')))
                                <input type="hidden" name="maxprice" value="{{ request()->input('maxprice') }}">
                            @endif
                            <input type="text" id="prod_name" value="{{ request()->input('search') }}" name="search" placeholder="{{ __('Search Our Catalog') }}" autocomplete="off">
                            <button type="submit"><i class="icofont-search-1"></i></button>
                            <div class="autocomplete">
                                <div id="myInputautocomplete-list" class="autocomplete-items"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mycol3">
                    <div class="track-order-area">
                        <a href="javascript:;" data-toggle="modal" data-target="#track-order-modal">{{ __('Tracking Order') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Main-Menu Area End-->