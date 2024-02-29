@extends('layouts.front')

@section('content')

  <!-- Breadcrumb Area Start -->
  <div class="breadcrumb-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <ul class="pages">
  
            {{-- Category Breadcumbs --}}
  
            @if(isset($bcat))
                  
                <li>
                  <a href="{{ route('front.index') }}">
                      {{ __('Home') }}
                  </a>
                </li>
                <li>
                  <a href="{{ route('front.blog') }}">
                      {{ __('Blog') }}
                  </a>
                </li>
                <li>
                  <a href="{{ route('front.blogcategory',$bcat->slug) }}">
                    {{ $bcat->name }}
                  </a>
                </li>
  
            @elseif(isset($slug))
  
                <li>
                  <a href="{{ route('front.index') }}">
                      {{ __('Home') }}
                  </a>
                </li>
                <li>
                  <a href="{{ route('front.blog') }}">
                      {{ __('Blog') }}
                  </a>
                </li>
                <li>
                  <a href="{{ route('front.blogtags',$slug) }}">
                      {{ __('Tag') }}: {{ $slug }}
                  </a>
                </li>
  
            @elseif(isset($search))
                  
                <li>
                  <a href="{{ route('front.index') }}">
                      {{ __('Home') }}
                  </a>
                </li>
                <li>
                  <a href="{{ route('front.blog') }}">
                      {{ __('Blog') }}
                  </a>
                </li>
                <li>
                  <a href="Javascript:;">
                      {{ __('Search') }}
                  </a>
                </li>
                <li>
                  <a href="Javascript:;">
                    {{ $search }}
                  </a>
                </li>
  
            @else
                  
                <li>
                  <a href="{{ route('front.index') }}">
                      {{ __('Home') }}
                  </a>
                </li>
                <li>
                  <a href="{{ route('front.blog') }}">
                      {{ __('Blog') }}
                  </a>
                </li>
                
            @endif
  
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb Area End -->

  <!-- Blog Area Start -->
  <section class="blog">
		<div class="container">
			<div class="row">
					<div class="col-lg-8">
            <div id="ajaxContent">
            <div class="row">
              @forelse($blogs as $blogg)

                <div class="col-lg-6 col-md-6 mycol">
                  <div class="single-blog">
                    <div class="img">
                      <img src="{{  $blogg->photo ? asset('assets/images/blogs/'.$blogg->photo):asset('assets/images/noimage.png') }}" alt="">
                      <div class="date">
                      {{ date('d M, Y',strtotime($blogg->created_at)) }}
                      </div>
                    </div>
                    <div class="content">
                      <a href="{{ route('front.blogshow',$blogg->id) }}">
                        <h4 class="title">
                            {{ mb_strlen($blogg->title,'UTF-8') > 200 ? mb_substr($blogg->title,0,200,'UTF-8')."...":$blogg->title }}
                        </h4>
                      </a>
                      <ul class="top-meta">
                        <li>
                          <a href="javascript:;"><i class="far fa-comments"></i> {{ $blogg->source }} </a>
                        </li>
                        <li>
                          <a href="javascript:;">
                              <i class="far fa-eye"></i> {{ $blogg->views }} 
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

              @empty

                <div class="page-center">
                  <h3 class="ml-3"> {{ __('No Post Found') }}</h3>              
                </div>

              @endforelse

            </div>

            {{-- BLOG PAGINATION --}}

            <div class="page-center">
                @if(isset($_GET['search']))
                  {!! $blogs->appends(['search' => $_GET['search']])->links() !!}   
                @else
                  {!! $blogs->links() !!}   
                @endif            
            </div>

            {{-- BLOG PAGINATION ENDS --}}
           </div>

          </div>

          <div class="col-lg-4">
            <div class="blog-aside">
                <div class="aside serch-widget">
                    <h4 class="title">
                      {{ __('Search') }}
                    </h4>
                    <form action="{{ route('front.blogsearch') }}" method="GET">
                      <input type="text" name="search" placeholder="{{ __('Search Here') }}" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" required>
                      <button class="submit" type="submit">{{ __('Search') }}</button>
                    </form>
                  </div>
              <div class="aside categori">
                <h4 class="title">{{ __('Categories') }}</h4>
                <ul class="categori-list">
                  @foreach($bcats as $cat)
                  <li>
                      <a class="{{ isset($bcat) ? ($bcat->id == $cat->id ? 'active' : '') : '' }}" href="{{ route('front.blogcategory',$cat->slug) }}">
                        <span>{{ $cat->name }}</span>
                        <span>({{ $cat->blogs()->count() }})</span>
                      </a>
                    </li>
                  @endforeach
                </ul>
              </div>
              <div class="aside recent-post-widget">
                <h4 class="title">{{ __('Recent Post') }}</h4>
                <ul class="post-list">
                  @foreach (App\Models\Blog::latest()->where('language_id',$langg->id)->limit(4)->get() as $blog)
                    <li>
                      <div class="post">
                        <div class="post-img">
                          <img src="{{ asset('assets/images/blogs/'.$blog->photo) }}" alt="">
                        </div>
                        <div class="post-details">
                          <a href="{{ route('front.blogshow',$blog->id) }}">
                              <h4 class="post-title">
                                  {{ mb_strlen($blog->title,'UTF-8') > 45 ? mb_substr($blog->title,0,45,'UTF-8')."..":$blog->title }}
                              </h4>
                          </a>
                          <p class="date">
                              {{ date('M d - Y',(strtotime($blog->created_at))) }}
                          </p>
                        </div>
                      </div>
                    </li>
                  @endforeach
                </ul>
              </div>
              <div class="aside newsletter-widget">
                <h4 class="title">
                    {{ __('Newsletter') }}
                </h4>
                <form class="subscribeform" action="{{route('front.subscribe')}}" method="POST">
                    @csrf
                  <input type="text" name="email" placeholder="{{ __('Enter Your Email') }}" required>
                  <button class="submit" type="submit">{{ __('Subscribe') }}</button>
                </form>
              </div>
              <div class="aside tags">
                  <h4 class="title">{{ __('Tags') }}</h4>
                  <span class="separator"></span>
                  <ul class="tags-list">
                    @foreach($tags as $tag)
                      @if(!empty($tag))
                      <li>
                        <a class="{{ isset($slug) ? ($slug == $tag ? 'active' : '') : '' }}" href="{{ route('front.blogtags',$tag) }}">
                          {{ $tag }}
                        </a>
                      </li>
                      @endif
                    @endforeach
                  </ul>
              </div>
            </div>
          </div>
			</div>
		</div>
	</section>
  <!-- Blog Area End -->

@endsection