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
                @if (!empty($cat))
                <li>
                   <a href="{{route('front.category', $cat->slug)}}">{{ $cat->name }}</a>
                </li>
                @endif
                @if (!empty($subcat))
                <li>
                   <a href="{{route('front.category', [$cat->slug, $subcat->slug])}}">{{ $subcat->name }}</a>
                </li>
                @endif
                @if (!empty($childcat))
                <li>
                   <a href="{{route('front.category', [$cat->slug, $subcat->slug, $childcat->slug])}}">{{ $childcat->name }}</a>
                </li>
                @endif
              </ul>
            </div>
          </div>
        </div>
    </div>
      <!-- Breadcrumb Area End -->
    
       <!-- SubCategori Area Start -->
        <section class="sub-categori">
            <div class="container">
                <div class="row">

                    @include('partials.catalog.catalog')
                    
                    <div class="col-lg-9 order-first order-lg-last">
                        <div class="right-area">
                            @if (!empty($cat))
                            <div class="cat-banner">
                                <img class="lozad" data-src="{{ asset('assets/images/categories/'.$cat->image) }}" alt="">
                            </div>    
                            @endif
                            @if (count($prods) > 0)
                                <div class="item-filter">
                                    <ul class="filter-list">
                                        <li class="item-short-area">
                                            <p>{{ __('Sort By') }} :</p>
                                            <select id="sortby" name="sort" class="short-item">
                                              <option value="date_desc">{{ __('Latest Product') }}</option>
                                              <option value="date_asc">{{ __('Oldest Product') }}</option>
                                              <option value="price_asc">{{ __('Lowest Price') }}</option>
                                              <option value="price_desc">{{ __('Highest Price') }}</option>
                                            </select>
                                        </li>
                                        @if($gs->product_page != null)
                                        <li class="viewitem-no-area">
                                            <p>{{ __('View') }} :</p>
                                            <select id="pageby" name="pageby" class="short-itemby-no">
                                                @foreach (explode(',',$gs->product_page) as $element)
                                                  <option value="{{ $element }}">{{ $element }}</option>
                                                @endforeach
                                            </select>
                                        </li>
                                        @else 
                                      <input type="hidden" id="pageby" value="{{ $gs->page_count }}">
                                        @endif
                                    </ul>
                                </div>
                            @endif
                            <div class="categori-item-area">
                                <div class="ajax-loader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center rgba(0,0,0,.6);"></div>
                                <div class="row" id="ajaxContent">
                                    @if (count($prods) > 0)
                                        @foreach ($prods as $key => $prod)
                                        <div class="col-xl-3 col-md-4 col-6 mycol">
                                            @include('partials.product.product')
                                        </div>
                                        @endforeach

                                        <div class="col-lg-12">
                                          <div class="page-center mt-5">
                                            {!! $prods->appends(['search' => request()->input('search')])->links() !!}
                                          </div>
                                        </div>


                                    @else 
                                    <div class="col-lg-12">
                                            <div class="page-center">
                                                 <h4 class="text-center">{{ __('No Product Found.') }}</h4>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
     <!-- SubCategori Area End -->
@endsection


@section('scripts')

<script>


    // when dynamic attribute changes
    $(".attribute-input, #sortby, #pageby").on('change', function() {
      $(".ajax-loader").show();
      filter();
    });

    // when price changed & clicked in search button
    $(".filter-btn").on('click', function(e) {
      e.preventDefault();
      $(".ajax-loader").show();
      filter();
    });


  function filter() {
    let filterlink = '';

    if ($("#prod_name").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?search='+$("#prod_name").val();
      } else {
        filterlink += '&search='+$("#prod_name").val();
      }
    }

    $(".attribute-input").each(function() {
      if ($(this).is(':checked')) {
        if (filterlink == '') {
          filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$(this).attr('name')+'='+$(this).val();
        } else {
          filterlink += '&'+$(this).attr('name')+'='+$(this).val();
        }
      }
    });

    if ($("#sortby").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#sortby").attr('name')+'='+$("#sortby").val();
      } else {
        filterlink += '&'+$("#sortby").attr('name')+'='+$("#sortby").val();
      }
    }


    if ($("#min_price").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#min_price").attr('name')+'='+$("#min_price").val();
      } else {
        filterlink += '&'+$("#min_price").attr('name')+'='+$("#min_price").val();
      }
    }

    if ($("#max_price").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#max_price").attr('name')+'='+$("#max_price").val();
      } else {
        filterlink += '&'+$("#max_price").attr('name')+'='+$("#max_price").val();
      }
    }


    if ($("#pageby").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}' + '?'+$("#pageby").attr('name')+'='+$("#pageby").val();
      } else {
        filterlink += '&'+$("#pageby").attr('name')+'='+$("#pageby").val();
      }
    }


    $("#ajaxContent").load(encodeURI(filterlink), function(data) {
      // add query string to pagination
      addToPagination();
      $(".ajax-loader").fadeOut(1000);
    });
  }

  // append parameters to pagination links
  function addToPagination() {


    // add to attributes in pagination links
    $('ul.pagination li a').each(function() {
      let url = $(this).attr('href');
      let queryString = '?' + url.split('?')[1]; // "?page=1234...."

      let urlParams = new URLSearchParams(queryString);
      let page = urlParams.get('page'); // value of 'page' parameter

      let fullUrl = '{{route('front.category', [Request::route('category'),Request::route('subcategory'),Request::route('childcategory')])}}?page='+page+'&search='+'{{urlencode(request()->input('search'))}}';

      $(".attribute-input").each(function() {
        if ($(this).is(':checked')) {
          fullUrl += '&'+encodeURI($(this).attr('name'))+'='+encodeURI($(this).val());
        }
      });

      if ($("#sortby").val() != '') {
        fullUrl += '&sort='+encodeURI($("#sortby").val());
      }

      if ($("#min_price").val() != '') {
        fullUrl += '&min='+encodeURI($("#min_price").val());
      }

      if ($("#max_price").val() != '') {
        fullUrl += '&max='+encodeURI($("#max_price").val());
      }

      if ($("#pageby").val() != '') {
        fullUrl += '&pageby='+encodeURI($("#pageby").val());
      }


      $(this).attr('href', fullUrl);
    });
  }

</script>

<script type="text/javascript">

(function($) {
		"use strict";

  $(function () {
    $("#slider-range").slider({
    range: true,
    orientation: "horizontal",
    min: {{ $gs->min_price }},
    max: {{ $gs->max_price }},
    values: [{{ isset($_GET['min']) ? $_GET['min'] : $gs->min_price }}, {{ isset($_GET['max']) ? $_GET['max'] : $gs->max_price }}],
    step: 1,

    slide: function (event, ui) {
      if (ui.values[0] == ui.values[1]) {
        return false;
      }

      $("#min_price").val(ui.values[0]);
      $("#max_price").val(ui.values[1]);
    }
    });

    $("#min_price").val($("#slider-range").slider("values", 0));
    $("#max_price").val($("#slider-range").slider("values", 1));

  });

})(jQuery);

</script>

@endsection