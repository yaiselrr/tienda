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
                <li class="active">
                  <a href="{{ route('front.categories') }}">
                    {{ __('All Categories') }}
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- Breadcrumb Area End -->
    
      <!-- All Category Area Start -->
      <div class="category-page">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="bg-white">
                    @foreach(App\Models\Category::where('language_id',$langg->id)->where('status',1)->get() as $category)
                        <div class="sub-category-menu">
                            <h3 class="category-name"><a href="{{ route('front.category',$category->slug) }}">{{ $category->name }}</a></h3>
                            @if(count($category->subs) > 0)
                                <ul class="parent-category">
                                @foreach($category->subs as $subcat)
                                    <li>
                                        <a class="p-c-title" href="{{ route('front.category',[$category->slug, $subcat->slug]) }}">{{$subcat->name}}</a>

                                    @if(count($subcat->childs) > 0)
                                        <ul>
                                        @foreach($subcat->childs as $childcat)
                                            <li>
                                                <a href="{{ route('front.category',[$category->slug, $subcat->slug, $childcat->slug]) }}"><i class="fas fa-angle-double-right"></i>{{$childcat->name}}</a>
                                            </li>
                                        @endforeach
                                        </ul>
                                    @endif

                                    </li>
                                @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- All Category Area Start -->

@endsection