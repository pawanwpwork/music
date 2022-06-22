@extends('layouts.app')

@section('content')
<!-- site content -->
<div class="sitecontent__outer">
    <div class="container">
        <div class="sitecontent">
            <div class="box">
                @include('layouts.message')
                <div class="classfiedsell__form-wrap box-inner" id="classifiedSellForm">
                    <h1 class="heading">Classified Services ({{$service->name}}) @if(isset($order)) <span>enquiry has been in pending status. </span>@endif</h1>
                    <form action="{{ route('classified.service.buy',$service->alias) }}" method="post" class="classifiedPostForm row" enctype="multipart/form-data">
                        @csrf 
                      
                        <div class="formfield col-md-6 col-12">
                            <label for="frmItemName">Name of the owner</label>
                            <input type="text" name="name_of_owner" value="{{ old('name_of_owner',isset($order) ? $order->name_of_owner : '') }}">
                        </div>

                        <div class="formfield col-md-6 col-12">
                            <label for="frmItemName">DBA</label>
                            <input type="text" name="dba" value="{{ old('dba',isset($order) ? $order->dba : '') }}">
                        </div>

                        <div class="formfield col-md-6 col-12">
                            <label for="frmItemName">Address</label>
                            <input type="text" name="address" value="{{ old('address',isset($order) ? $order->address : '') }}">
                        </div>

                        <div class="formfield col-md-6 col-12">
                            <label for="frmItemName">City</label>
                            <input type="text" name="city" value="{{ old('city',isset($order) ? $order->city : '') }}">
                        </div>

                        <div class="formfield col-md-6 col-12">
                            <label for="frmItemName">State</label>
                            <input type="text" name="state" value="{{ old('state',isset($order) ? $order->state : '') }}">
                        </div>
    
                        <div class="formfield col-md-6 col-12">
                            <label for="frmItemName">Zip</label>
                            <input type="text" name="zip" value="{{ old('zip',isset($order) ? $order->zip : '') }}">
                        </div>

                        <div class="formfield col-md-6 col-12">
                            <label for="frmItemName">Phone no.</label>
                            <input type="text" name="phone_no" value="{{ old('phone_no',isset($order) ? $order->phone_no : '') }}">
                        </div>

                        <div class="formfield col-md-6 col-12">
                            <label for="frmItemName">Cell Phone</label>
                            <input type="text" name="cell_phone" value="{{ old('cell_phone',isset($order) ? $order->cell_phone : '') }}">
                        </div>

                        <div class="formfield col-md-6 col-12">
                            <label for="frmItemName">Fax</label>
                            <input type="text" name="fax" value="{{ old('fax',isset($order) ? $order->fax : '') }}">
                        </div>

                        <div class="formfield col-md-6 col-12">
                            <label for="frmItemName">Website</label>
                            <input type="text" name="website" value="{{ old('website',isset($order) ? $order->website : '') }}">
                        </div>

                        <div class="formfield col-md-6 col-12">
                            <label for="frmItemName">Email</label>
                            <input type="text" name="email" value="{{ old('email',isset($order) ? $order->email : '') }}">
                        </div>

                        <div class="formfield col-md-6 col-12">
                            <label for="frmItemName">Comments</label>
                            <textarea name="comments">{{old('comments',isset($order) ? $order->comments : '')}}</textarea>
                        </div>

                          <div class="formfield">
                            @php 
                                $term = App\Models\Page::find(2);
                            @endphp
                            <div class="music-terms-and-conditions" style="max-height: 200px; overflow: auto;">
                                {!!$term->content ?? ''!!}
                            </div>

                            <label class="terms-checkbox">
                                <input type="checkbox" class="input-checkbox" name="terms" id="terms" required>
                                <span class="music-terms-and-conditions-checkbox-text">
                                    I have read and agree to the website 
                                    <a href="javascript:void(0)" class="music-terms-and-conditions-link" data-toggle="music-terms-and-conditions">terms and conditions</a></span>&nbsp;<span class="required">*</span>
                            </label>

                        </div>
                        
                        @if(!isset($order))
                        <div class="formfield formfield-submit col-6" style="margin-top:20px;">
                            <input type="submit" value="Enquiry Now">
                        </div>
                        @endif
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

 <div class="modal" tabindex="-1" role="dialog" id="cancelServiceOrder">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Cancel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{route('classified.service.cancel')}}" method="POST">
              @csrf()
              <div class="modal-body">
               Are you sure to cancel this service?
              </div>
              <div class="modal-footer">
                <button type="submit" class="cart-button-remove">Yes</button>
              </div>
          </form>
        </div>
      </div>
    </div>
@endsection

@section('head-css')

@endsection

@section('scripts')

<script>
    $("#cancel-order").click(function(){
        $("#cancelServiceOrder").modal('show');
    });
</script>

@endsection