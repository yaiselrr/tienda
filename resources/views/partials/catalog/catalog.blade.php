<div class="col-lg-3 col-md-6">
  <div class="left-area">
<div class="all-categories-area">
<div class="header-area">
  <h4 class="title">
    {{ __('All Categories') }}
  </h4>
</div>
<div class="body-area">
  <form id="catalogForm" action="{{ route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')]) }}" method="GET">
  @if (!empty(request()->input('search')))
      <input type="hidden" name="search" value="{{ request()->input('search') }}">
  @endif
  @if (!empty(request()->input('sort')))
      <input type="hidden" name="sort" value="{{ request()->input('sort') }}">
  @endif
  <ul class="filter-list">
      @foreach (App\Models\Category::where('language_id',$langg->id)->where('status',1)->get() as $element)
          <li>
              <div class="content">
                  <a href="{{route('front.category', $element->slug)}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="category-link {{ !empty($cat) && ($cat->id == $element->id) ? 'active' : '' }}">
                       <i class="fas fa-angle-double-right"></i> 
                       {{$element->name}}
                  </a>
                  @if(!empty($cat) && $cat->id == $element->id && !empty($cat->subs))
                      @foreach ($cat->subs as $key => $subelement)
                        <div class="sub-content">
                          <a href="{{route('front.category', [$cat->slug, $subelement->slug])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="category-link {{ isset($subcat) ? ($subcat->id == $subelement->id ? 'active' : '') : '' }}">
                              <i class="fas fa-angle-right"></i>
                              {{$subelement->name}}
                          </a>
                          @if(!empty($subcat) && $subcat->id == $subelement->id && !empty($subcat->childs))
                            @foreach ($subcat->childs as $key => $childelement)
                            <div class="child-content">
                              <a href="{{route('front.category', [$cat->slug, $subcat->slug, $childelement->slug])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="category-link {{ isset($childcat) ? ($childcat->id == $childelement->id ? 'active' : '') : '' }}">
                                  <i class="fas fa-caret-right"></i> 
                                  {{$childelement->name}}
                              </a>
                            </div>
                            @endforeach
                          @endif
                        </div>
                      @endforeach
                  @endif                  
              </div>
          </li>
         @endforeach
      </ul>
</div>
</div>
<div class="filter-result-area">
  <div class="header-area">
      <h4 class="title">
          {{ __('Filter Results By') }}
      </h4>
  </div>
  <div class="body-area">

      <div class="price-range-block">
          <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
          <div class="livecount">
              <input type="number" name="min"  oninput="" id="min_price" class="price-range-field" /> 
              <span>
                  {{ __('To') }}
              </span>
              <input type="number" name="max"  oninput="" id="max_price" class="price-range-field" />
          </div>
      </div>
              
      <button class="filter-btn" type="submit">{{ __('Search') }}</button>
      </form>
  </div>
</div>


@if ((!empty($cat) && !empty(json_decode($cat->attributes, true))) || (!empty($subcat) && !empty(json_decode($subcat->attributes, true))) || (!empty($childcat) && !empty(json_decode($childcat->attributes, true))))

  <div class="tags-area">
    <div class="header-area">
      <h4 class="title">
          {{ __('Filters') }}
      </h4>
    </div>
    <div class="body-area">
      <form id="attrForm" action="{{ route('front.category',[Request::route('category'),Request::route('subcategory'),Request::route('childcategory')]) }}" method="post">
        <ul class="filter">
            <div class="single-filter">
                @if (!empty($cat) && !empty(json_decode($cat->attributes, true)))
                  @foreach ($cat->attributes as $key => $attr)
                    <div class="my-2 sub-title">
                      <span><i class="fas fa-arrow-alt-circle-right"></i> {{$attr->name}}</span>
                    </div>
                    @if (!empty($attr->attribute_options))
                      @foreach ($attr->attribute_options as $key => $option)
                        <div class="form-check ml-0 pl-0">
                          <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                          <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                        </div>
                      @endforeach
                    @endif
                  @endforeach
                @endif

                @if (!empty($subcat) && !empty(json_decode($subcat->attributes, true)))
                  @foreach ($subcat->attributes as $key => $attr)
                  <div class="my-2 sub-title">
                    <span><i class="fas fa-arrow-alt-circle-right"></i> {{$attr->name}}</span>
                  </div>
                    @if (!empty($attr->attribute_options))
                      @foreach ($attr->attribute_options as $key => $option)
                        <div class="form-check  ml-0 pl-0">
                          <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                          <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                        </div>
                      @endforeach
                    @endif
                  @endforeach
                @endif

                @if (!empty($childcat) && !empty(json_decode($childcat->attributes, true)))
                  @foreach ($childcat->attributes as $key => $attr)
                  <div class="my-2 sub-title">
                    <span><i class="fas fa-arrow-alt-circle-right"></i> {{$attr->name}}</span>
                  </div>
                    @if (!empty($attr->attribute_options))
                      @foreach ($attr->attribute_options as $key => $option)
                        <div class="form-check  ml-0 pl-0">
                          <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                          <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{$option->name}}</label>
                        </div>
                      @endforeach
                    @endif
                  @endforeach
                @endif
              </div>
        </ul>
      </form>
    </div>
  </div>

@endif

  </div>
</div>