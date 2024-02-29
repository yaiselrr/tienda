
<!DOCTYPE html>
<html lang="en">

    @include('partials.global.styles')
    @yield('styles')

<body>

    @include('partials.global.subscription-popup')

    @if($gs->is_loader == 1)
	<div class="preloader" id="preloader" style="background: url({{asset('assets/images/'.$gs->loader)}})"></div>
    @endif

    @include('partials.global.header')

    @yield('content')

    @include('partials.global.footer')

    @include('partials.global.modal')

    @include('partials.global.side-menu')

    @include('partials.global.scripts')

    @yield('scripts')

</body>

</html>