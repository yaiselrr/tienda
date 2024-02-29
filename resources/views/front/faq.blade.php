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
            <li class="active">
              <a href="{{ route('front.faq') }}">
                {{ __("Faq") }}
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb Area End -->

  <!-- Faq Area Start -->
  <section class="faq-area">
    <div class="container">
      <div class="row">
        @foreach($faqs->chunk($chunk) as $faq)
        <div class="col-lg-6">
            <div class="accordion" id="tour-faq-{{ $loop->first ? $faq[0]->id : $faq[$chunk]->id }}">
                @foreach($faq as $fq)
                <div class="single-accordion">
                    <div class="accordion-header">
                        <h4 class="title" data-toggle="collapse" data-target="#collapse{{ $fq->id }}" aria-expanded="true" aria-controls="collapse{{ $fq->id }}">
                            {{ $fq->title }}
                        </h4>
                    </div>
                    
                    <div id="collapse{{ $fq->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" data-parent="#tour-faq-{{ $loop->parent->first ? $faq[0]->id : $faq[$chunk]->id }}">
                      <div class="accordion-body">
                          {!! clean($fq->details , array('Attr.EnableID' => true)) !!}
                      </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

      </div>
    </div>
  </section>
  <!-- Faq Area End -->

@endsection