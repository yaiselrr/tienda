    <!-- Off Canvas Menu Area Start -->
    <div class="off-canvas-menu">
        <i class="far fa-times-circle remove-off-nav"></i>
    <div class="off-menu">
        <h5 class="title">
        {{ __('Menu :') }}
        </h5>
        <div class="off-menu">
            <ul class="navbar-nav">
                @if($ps->home == 1)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('front.index') }}">{{ __('Home') }}</a>
                </li>
                @endif
                @if($ps->blog == 1)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('front.blog') }}">{{ __('Blog') }}</a>
                </li>
                @endif
                @if($ps->faq == 1)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('front.faq') }}">{{ __('Faq') }}</a>
                </li>
                @endif
                @foreach(DB::table('pages')->where('language_id',$langg->id)->where('header','=',1)->get() as $data)
                    <li><a href="{{ route('front.page',$data->slug) }}">{{ $data->title }}</a></li>
                @endforeach
                @if($ps->contact == 1)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('front.contact') }}">{{ __('Contact Us') }}</a>
                </li>
                @endif
            </ul>
        </div>
    </div>

        <div class="book-a-table-area">
            <h5 class="title">
                {{ __('Contact Us:') }}
            </h5>
            <form class="contactform" action="{{route('front.contact.submit')}}" method="POST">
                @csrf
                <input name="name" type="text" class="input-field" placeholder="{{ __('Name *') }}" required>
                <input name="phone" type="text" class="input-field" placeholder="{{ __('Phone Number *') }}" required>
                <input name="email" type="email" class="input-field" placeholder="{{ __('Email Address *') }}" required>
                <textarea name="text" class="input-field textarea" placeholder="{{ __('Your Message *') }}" required></textarea>

                @if($gs->is_capcha == 1)

                <ul class="captcha-area">
                    <li>
                        <p><img class="codeimg1" src="{{ asset("assets/images/capcha_code.png") }}" alt="">	<i class="fas fa-sync-alt pointer refresh_code"></i></p>
                    </li>
                    <li>
                        <input name="codes" type="text" class="input-field" placeholder="{{ __('Enter Code') }}" required>  
                    </li>
                </ul>

                @endif

                <button type="submit" class="book-table-btn">{{ __('Submit') }}</button>
            </form>
        </div>

    <div class="off-nav-social">

        @foreach(DB::table('social_links')->where('user_id',0)->where('status',1)->get() as $link)

            <a href="{{ $link->link }}" target="_blank">
                <i class="{{ $link->icon }}"></i>
            </a>

        @endforeach

    </div>
    <ul class="off-nav-sub">
        @foreach(DB::table('pages')->where('language_id',$langg->id)->where('footer','=',1)->get() as $data)
           <li><a href="{{ route('front.page',$data->slug) }}">{{ $data->title }}</a></li>
        @endforeach
    </ul>
    </div>
    <div class="off-canvas-menu-overlay"></div>
    <!-- Off Canvas Menu Area End -->