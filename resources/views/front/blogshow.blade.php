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
                    {{ __("Home") }}
                  </a>
                </li>
                <li>
                  <a href="{{ route('front.blog') }}">
                    {{ __("Blog") }}
                  </a>
                </li>
                <li class="active">
                  <a href="{{ route('front.blogshow',$blog->id) }}">
                      {{ __("Blog Details") }}
                  </a>
                </li>
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
                    <div class="blog-box blog-details-box">
                      <div class="blog-images">
                          <div class="img">
                            <img src="{{ asset('assets/images/blogs/'.$blog->photo) }}" class="img-fluid" alt="">
                          </div>
                          <div class="date d-flex justify-content-center">
                            <div class="box align-self-center">
                                <p>{{date('d', strtotime($blog->created_at))}}</p>
                                <p>{{date('M', strtotime($blog->created_at))}}</p>
                            </div>
                          </div>
                      </div>
                      <div class="details">
                            <h4 class="blog-title">
                                {{ $blog->title }}
                            </h4>
                          <ul class="post-meta">
                            <li>
                              <a href="javascript:;">
                              <i class="fas fa-calendar"></i>
                              {{ date('d M, Y',strtotime($blog->created_at)) }}
                              </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                <i class="fas fa-eye"></i>
                                {{ $blog->views }} {{ __('View(s)') }}
                              </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                <i class="fas fa-comments"></i>
                                {{ __('Source') }} : {{ $blog->source }}
                              </a>
                            </li>
                          </ul>
                        <div class="content">
                            <p class="blog-text">
                                {!! clean($blog->details , array('Attr.EnableID' => true)) !!}
                            </p>
                        </div>
                      </div>
                      <div class="social-link a2a_kit a2a_kit_size_32">
                          <ul class="social-links">
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
                                    <i class="fab fa-pinterest"></i>
                                  </a>
      
                              </li>
      
                              <li>
                                
                              <a class="a2a_dd plus" href="https://www.addtoany.com/share">
                                  <i class="fas fa-plus"></i>
                                </a>
                              </li>
                            
                          </ul>
                          </div>
                          <script async src="https://static.addtoany.com/menu/page.js"></script>
                    </div>

                {{-- DISQUS START --}}   
                @if($gs->is_disqus == 1)
                <div class="comments">
          
                  <div id="disqus_thread">         
                      <script>
                   
                      (function() {
                      var d = document, s = d.createElement('script');
                      s.src = 'https://{{ $gs->disqus }}.disqus.com/embed.js';
                      s.setAttribute('data-timestamp', +new Date());
                      (d.head || d.body).appendChild(s);
                      })();
                      </script>
                      <noscript>{{__('Please enable JavaScript to view the')}} <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                  </div>
          
                </div>
                @endif
                {{-- DISQUS ENDS --}}

              </div>
              <div class="col-lg-4">
                  <div class="blog-aside">
                    <div class="aside serch-widget">
                      <h4 class="title">
                        {{ __('Search') }}
                      </h4>
                      <form action="{{ route('front.blogsearch') }}" method="GET">
                        <input type="text" name="search" placeholder="{{ __('Search Here') }}" required>
                        <button class="submit" type="submit">{{ __('Search') }}</button>
                      </form>
                    </div>
                    <div class="aside categori">
                      <h4 class="title">{{ __('Categories') }}</h4>
                      <ul class="categori-list">
                        @foreach($bcats as $cat)
                        <li>
                            <a href="{{ route('front.blogcategory',$cat->slug) }}">
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
                        @foreach (App\Models\Blog::where('id','!=',$blog->id)->where('language_id',$langg->id)->latest()->limit(4)->get() as $blog)
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
                              <a class="{{ isset($slug) ? ($slug == $tag ? 'active' : '') : '' }}" href="{{ route('front.blogtags',$tag) }}">{{ $tag }}</a>
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