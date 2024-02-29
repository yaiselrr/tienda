    <!-- Footer Area Start -->
    <footer class="footer" id="footer">

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget about-widget">
                        <div class="footer-logo">
                            <a href="{{ route('front.index') }}">
                                <img class="lozad" data-src="{{ asset('assets/images/'.$gs->footer_logo) }}" alt="">
                            </a>
                        </div>
                        <div class="text">
                            <p>
                                {{ __(' Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium') }}
                            </p>
                        </div>
                        <ul class="about-info">
                            @if($ps->street != null) 
                            <li>
                                <p>
                                    <i class="icofont-google-map"></i>
                                    {{ $ps->street }}
                                </p>
                            </li>
                            @endif
                            @if($ps->phone != null) 
                            <li>
                                <p>
                                    <i class="icofont-ui-call"></i>
                                    {{ $ps->phone }}
                                </p>
                            </li>
                            @endif
                            @if($ps->email != null) 
                            <li>
                                <p>
                                    <i class="icofont-envelope"></i>
                                    <a href="mailto:{{ $ps->email }}">
                                    {{ $ps->email }}
                                    </a>
                                </p>
                            </li>
                            @endif
                        </ul>
                    </div>

                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget info-link-widget ilw1">
                        <h4 class="title">
                            {{ __('Footer Links') }}
                        </h4>
                        <ul class="link-list">

                            @if($ps->home == 1)
                            <li>
                                <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                            </li>
                            @endif
                            @if($ps->blog == 1)
                            <li>
                                <a href="{{ route('front.blog') }}">{{ __('Blog') }}</a>
                            </li>
                            @endif
                            @if($ps->faq == 1)
                            <li>
                                <a href="{{ route('front.faq') }}">{{ __('Faq') }}</a>
                            </li>
                            @endif
       
                            @foreach(DB::table('pages')->where('language_id',$langg->id)->where('footer','=',1)->get() as $data)
                                <li><a href="{{ route('front.page',$data->slug) }}">{{ $data->title }}</a></li>
                            @endforeach

                            @if($ps->contact == 1)
                            <li>
                                <a href="{{ route('front.contact') }}">{{ __('Contact Us') }}</a>
                            </li>
                            @endif

                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget recent-post-widget">
                        <h4 class="title">
                            {{ __('Recent Post') }}
                        </h4>
                        <ul class="post-list">
                            @foreach (DB::table('blogs')->where('language_id',$langg->id)->latest()->limit(3)->get() as $footer_blog)
							<li>
                                <div class="post">
                                    <div class="post-img">
                                        <img class="lozad" data-src="{{ asset('assets/images/blogs/'.$footer_blog->photo) }}" alt="">
                                      </div>
                                      <div class="post-details">
                                        <a href="{{ route('front.blogshow',$footer_blog->id) }}">
                                            <h4 class="post-title">
                                                {{mb_strlen($footer_blog->title,'UTF-8') > 45 ? mb_substr($footer_blog->title,0,45,'UTF-8')." .." : $footer_blog->title}}
                                            </h4>
                                        </a>
                                        <p class="date">
                                            {{ date('M d - Y',(strtotime($footer_blog->created_at))) }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget newsletter-widget">
                        <h4 class="title">
                            {{ __('Newsletter') }}
                        </h4>

                        <div class="newsletter-form-area">
                            <i class="far fa-paper-plane bgicon"></i>
                            <form class="subscribeform" action="{{route('front.subscribe')}}" method="POST">
                                @csrf
                                <input type="email" name="email" placeholder="{{ __('Your email address...') }}" required>
                                <button type="submit">{{ __('Subscribe') }}</button>
                            </form>
                        </div>
                        <div class="fotter-social-links">
                            <ul>
                                @foreach(DB::table('social_links')->where('user_id',0)->where('status',1)->get() as $link)
                                    <li>
                                        <a href="{{ $link->link }}" target="_blank">
                                            <i class="{{ $link->icon }}"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content">
                            <div class="content">
                            <p>{{ __('COPYRIGHT © 2020. All Rights Reserved By GeniusOcean') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->

@if(isset($visited))

@if($gs->is_cookie == 1)

    <!-- Cookie Section -->

    <div class="cookie-bar-wrap show">
        <div class="container d-flex justify-content-center">
            <div class="col-xl-10 col-lg-12">
                <div class="row justify-content-center">
                    <div class="cookie-bar">
                        <div class="cookie-bar-text">
                            {{ __('The website uses cookies to ensure you get the best experience on our website.') }}
                        </div> 
                        <div class="cookie-bar-action">
                            <button class="btn btn-primary btn-accept">
                             {{ __('GOT IT!') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Cookie Section Ends -->

@endif


@endif

    <!-- Back to Top Start -->
    <div class="bottomtotop">
        <i class="fas fa-chevron-right"></i>
    </div>
    <!-- Back to Top End -->