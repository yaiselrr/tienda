<div class="col-lg-3 col-md-6">
        <div class="left-area">
          <div class="filter-result-area">
          <div class="header-area">
            <h4 class="title">
              {{ __('All Categories') }}
            </h4>
          </div>
          <div class="body-area">

              <ul class="filter-list">
                @foreach (App\Models\Category::where('language_id',$langg->id)->where('status',1)->get() as $element)
                <li>
                  <div class="content">
                      <a href="{{route('front.category', $element->slug)}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="category-link"> <i class="fas fa-angle-double-right"></i> {{$element->name}}</a>
                      @if(!empty($cat) && $cat->id == $element->id && !empty($cat->subs))
                          @foreach ($cat->subs as $key => $subelement)
                          <div class="sub-content open">
                            <a href="{{route('front.category', [$cat->slug, $subelement->slug])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="subcategory-link"><i class="fas fa-angle-right"></i>{{$subelement->name}}</a>
                            @if(!empty($subcat) && $subcat->id == $subelement->id && !empty($subcat->childs))
                              @foreach ($subcat->childs as $key => $childcat)
                              <div class="child-content open">
                                <a href="{{route('front.category', [$cat->slug, $subcat->slug, $childcat->slug])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="subcategory-link"><i class="fas fa-caret-right"></i>{{$childcat->name}}</a>
                              </div>
                              @endforeach
                            @endif
                          </div>
                          @endforeach
                        </div>
                      @endif
                </li>
                @endforeach
              </ul>


            <div class="price-range-block" >
                @if (!empty(request()->input('sort')))
                  <input type="hidden" name="sort" value="{{ request()->input('sort') }}" />
                @endif
                <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                <div class="livecount">
                  <input type="number" name="min"  id="min_price" class="price-range-field" />
                  <span>{{ __('To') }}</span>
                  <input type="number" name="max" id="max_price" class="price-range-field" />
                </div>
              </div>

              <button class="filter-btn" type="button">{{ __('Search') }}</button>
          </div>
          </div>



          <div class="service-center">
            <div class="header-area">
              <h4 class="title">
                {{ __('Service Center') }}
              </h4>
            </div>
            <div class="body-area">
              <ul class="list text-center">
                <li>
                    <a href="javascript:;" data-toggle="modal" data-target="{{ Auth::check() ? '#vendorform1' : '#user-login' }}">
                        <i class="icofont-email"></i> <span class="service-text">{{ __('Contact Now') }}</span>
                    </a>
                </li>
                <li>
                      <a href="tel:+{{$vendor->shop_number}}">
                        <i class="icofont-phone"></i> <span class="service-text">{{$vendor->shop_number}}</span>
                      </a>
                </li>
              </ul>
            <!-- Modal -->
            </div>

            <div class="footer-area">
              <p class="title">
                {{ __('Follow Us') }}
              </p>
              <ul class="list">
                @if(count($vendor->sociallinks) > 0)
                  @foreach($vendor->sociallinks()->where('status','=',1)->get() as $data)
                  <li>
                    <a href="{{ $data->link }}" target="_blank">
                      <i class="{{ $data->icon }}"></i>
                    </a>
                  </li>
                  @endforeach
                @endif
              </ul>
            </div>
          </div>

        </div>
      </div>
