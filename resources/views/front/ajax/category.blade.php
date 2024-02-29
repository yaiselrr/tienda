@if (count($prods) > 0)

    @foreach ($prods as $key => $prod)
    <div class="col-xl-3 col-md-4 col-6 mycol">
      @include('partials.product.product')
    </div>
    @endforeach

@else 

    <div class="col-lg-12">
        <div class="page-center">
             <h4 class="text-center">{{ __('No Product Found.') }}</h4>
        </div>
    </div>
    
@endif


<div class="col-lg-12">
  <div class="page-center mt-5">
    {!! $prods->appends(['search' => request()->input('search')])->links() !!}
  </div>
</div>

<script src="{{asset('assets/front/js/main.js')}}"></script>
<script>

  // Lozad Section Ends

  // Tooltip Section

  $('[data-toggle="tooltip"]').tooltip({});

  $('[rel-toggle="tooltip"]').tooltip();

  $('[data-toggle="tooltip"]').on('click', function () {
    $(this).tooltip('hide');
  })


  $('[rel-toggle="tooltip"]').on('click', function () {
    $(this).tooltip('hide');
  })

  // Tooltip Section Ends
</script>