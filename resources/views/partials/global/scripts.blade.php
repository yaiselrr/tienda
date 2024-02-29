    <!-- DATA FROM SERVER -->
    <script type="text/javascript">
      var mainurl = "{{ url('/') }}";
      var gs      = {!! json_encode(DB::table('generalsettings')->where('id','=',1)->first(['is_loader','decimal_separator','thousand_separator','is_cookie','is_talkto','talkto'])) !!};
      var ps_category = {{ $ps->category }};
  
  
      var lang = {
          'days': '{{ __('Days') }}',
          'hrs': '{{ __('Hrs') }}',  
          'min': '{{ __('Min') }}',  
          'sec': '{{ __('Sec') }}',     
          'cart_already': '{{ __('Already Added To Card.') }}', 
          'cart_out': '{{ __('Out Of Stock') }}', 
          'cart_success': '{{ __('Successfully Added To Cart.') }}', 
          'cart_empty': '{{ __('Cart is empty.') }}',
          'coupon_found': '{{ __('Coupon Found.') }}', 
          'no_coupon': '{{ __('No Coupon Found.') }}', 
          'already_coupon': '{{ __('Coupon Already Applied.') }}', 
          'minimum_qty_error': '{{ __('Minimum Quantity is:') }}',
          'affiliate_link_copy': '{{ __('Affiliate Link Copied Successfully') }}'
      };
    </script>
    <!-- jquery -->
  
    <script src="{{asset('assets/front/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/front/js/jquery-migrate-3.3.2.js')}}"></script>
     <!-- jquery Ui -->
    <script src="{{ asset('assets/front/js/jquery-ui.min.js') }}"></script>
    <!-- popper -->
    <script src="{{ asset('assets/front/js/popper.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
    <!-- plugin js-->
    <script src="{{ asset('assets/front/js/plugin.js') }}"></script>
    <script src="{{ asset('assets/front/js/xzoom.js') }}"></script>
    <script src="{{ asset('assets/front/js/hammer.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/setup.js') }}"></script>
    <script src="{{ asset('assets/front/js/toastr.js') }}"></script>
    <!-- main -->
    <script src="{{ asset('assets/front/js/main.js') }}"></script>
  
    @if(Session::has('auth-modal') || Session::has('forgot-modal'))
    <script>
      $('#user-login').modal('show');
    </script>
    @endif