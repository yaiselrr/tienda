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
              <li>
                <a href="{{ route('user-dashboard') }}">
                  {{ __('Dashboard') }}
                </a>
              </li>
              <li class="active">
                <a href="{{ route('user-messages') }}">
                  {{ __('Messages') }}
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
<!-- Breadcrumb Area End -->

<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('partials.user.dashboard-sidebar')
        <div class="col-lg-8">
					<div class="user-profile-details">
						<div class="order-history">
							<div class="header-area d-flex align-items-center">
								<h4 class="title">{{ __('Messages')}}</h4>
                <a data-toggle="modal" data-target="#vendorform" class="mybtn1 ml-3" href="javascript:;"> <i class="fas fa-envelope"></i> 
                  {{ __('Compose Message') }}
                </a>                
							</div>
							<div class="mr-table allproduct message-area  mt-4">
								@include('alerts.form-success')
									<div class="table-responsiv">
											<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th>{{ __('Name') }}</th>
														<th>{{ __('Message') }}</th>
														<th>{{ __('Sent') }}</th>
														<th>{{ __('Actions') }}</th>
													</tr>
												</thead>
												<tbody>
                        @foreach($convs as $conv)

                          <tr class="conv">
                            
                            <input type="hidden" value="{{$conv->id}}">
                            @if($user->id == $conv->sent->id)
                            <td>{{$conv->recieved->name}}</td>    
                            @else
                            <td>{{$conv->sent->name}}</td>
                            @endif
                            <td>{{$conv->subject}}</td>
                            <td>{{$conv->created_at->diffForHumans()}}</td>
                            <td>
                              <a href="{{route('user-message',$conv->id)}}" class="link view"><i class="fa fa-eye"></i></a>
                              <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete" data-href="{{route('user-message-delete',$conv->id)}}" class="link remove"><i class="fa fa-trash"></i></a>
                            </td>

                          </tr>

                        @endforeach
												</tbody>
											</table>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

{{-- MESSAGE MODAL --}}
<div class="message-modal">
  <div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="vendorformLabel">{{ __('Send Message') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
      <div class="modal-body">
        <div class="container-fluid p-0">
          <div class="row">
            <div class="col-md-12">
              <div class="contact-form">
                <form id="emailreply">
                  {{csrf_field()}}
                  <ul>

                    <li>
                      <input type="email" class="input-field" id="eml" name="email" placeholder="{{ __('Email *') }}" required="">
                    </li>


                    <li>
                      <input type="text" class="input-field" id="subj" name="subject" placeholder="{{ __('Subject *') }}" required="">
                    </li>

                    <li>
                      <textarea class="input-field textarea" name="message" id="msg" placeholder="{{ __('Your Message *') }}" required=""></textarea>
                    </li>

                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                  </ul>
                  <button class="submit-btn" id="emlsub" type="submit">{{ __('Send Message') }}</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>

{{-- MESSAGE MODAL ENDS --}}



<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <div class="modal-header d-block text-center">
        <h4 class="modal-title d-inline-block">{{ __('Confirm Delete ?') }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
                <div class="modal-body">
            <p class="text-center">{{ __('You are about to delete this Conversation.') }}</p>
            <p class="text-center">{{ __('Do you want to proceed?') }}</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a class="btn btn-danger btn-ok">{{ __('Delete') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

<script type="text/javascript">
    
    (function($) {
		"use strict";

          $(document).on("submit", "#emailreply" , function(){
          var token = $(this).find('input[name=_token]').val();
          var subject = $(this).find('input[name=subject]').val();
          var message =  $(this).find('textarea[name=message]').val();
          var email = $(this).find('input[name=email]').val();
          var name = $(this).find('input[name=name]').val();
          var user_id = $(this).find('input[name=user_id]').val();
          $('#eml').prop('disabled', true);
          $('#subj').prop('disabled', true);
          $('#msg').prop('disabled', true);
          $('#emlsub').prop('disabled', true);
     $.ajax({
            type: 'post',
            url: "{{URL::to('/user/user/contact')}}",
            data: {
                '_token': token,
                'subject'   : subject,
                'message'  : message,
                'email'   : email,
                'name'  : name,
                'user_id'   : user_id
                  },
            success: function( data) {
          $('#eml').prop('disabled', false);
          $('#subj').prop('disabled', false);
          $('#msg').prop('disabled', false);
          $('#subj').val('');
          $('#msg').val('');
          $('#emlsub').prop('disabled', false);
        if(data == 0)
          toastr.error("Email Not Found");
        else
          toastr.success("Message Sent");
          $('#vendorform').modal('hide');
            }
        });          
          return false;
        });

})(jQuery);

</script>


<script type="text/javascript">

(function($) {
		"use strict";

      $('#confirm-delete').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });

})(jQuery);

</script>

@endsection