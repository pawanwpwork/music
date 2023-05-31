@extends('layouts.app')

@section('content')

<div class="container">
    <div class="box">
        <div class="register__form-wrap box-inner" id="registerForm">
            <h2 class="heading">Signup for {{ucfirst($type)}}</h2>
            <form action="{{ route('signup.post') }}" method="post" class="register__form" enctype="multipart/form-data">
                @include('layouts.message')
                @csrf
                <div class="formfield">
                    <label for="first_name">First Name(*)</label>
                    <input type="text" name="first_name" id="first_name" value="{{old('first_name')}}" class="form-control">
                    @if($errors->has('first_name'))
                        <span class="error-message">
                            {{ $errors->first('first_name') }}
                        </span>
                    @endif
                </div>
                <div class="formfield">
                    <label for="last_name">Last Name(*)</label>
                    <input type="text" name="last_name" id="last_name" value="{{old('last_name')}}" class="form-control">
                      @if($errors->has('last_name'))
                        <span class="error-message">
                            {{ $errors->first('last_name') }}
                        </span>
                    @endif
                </div>

                 <div class="formfield">
                    <label for="frmEmail">Email(*)</label>
                    <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control">
                      @if($errors->has('email'))
                        <span class="error-message">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>

                <div class="formfield">
                    <label for="frmPassword">Password(*)</label>
                    <input type="password" name="password" id="frmPassword" value="" class="form-control">
                    @if($errors->has('password'))
                        <span class="error-message">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                     <span class="show-password" onClick="togglePasswordType();"><i class="fa fa-eye"></i></span>
                </div>

                <div class="formfield">
                    <label for="password_confirmation">Re-type Password(*)</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" value="" class="form-control">
                     <span  class="show-password1" onClick="togglePasswordType1();"><i class="fa fa-eye"></i></span>
                </div>

                <div class="formfield">
                    <label for="frmAddress">Address</label>
                    <input type="text" name="address" id="frmAddress" value="{{old('address')}}" class="form-control">
                </div>
                <div class="formfield">
                    <label for="frmCity">City</label>
                    <input type="text" name="city" id="frmCity" value="{{old('city')}}" class="form-control">
                </div>
                <div class="formfield">
                    <label for="frmState">State</label>
                    <input type="text" name="state" id="frmState" value="{{old('state')}}" class="form-control">
                </div>
                <div class="formfield">
                    <label for="frmCountry">Country</label>
                    <input type="text" name="country" id="frmCountry" value="{{old('country')}}" class="form-control">
                </div>
                <div class="formfield">
                    <label for="frmZipcode">Zipcode</label>
                    <input type="text" name="zipcode" id="frmZipcode" value="{{old('zipcode')}}" class="form-control">
                </div>
               
                <div class="formfield">
                    <label for="frmCell">Cell(*)</label>
                    <input type="phone" name="phone" id="phone" value="{{old('phone')}}" class="form-control">
                    @if($errors->has('phone'))
                        <span class="error-message">
                            {{ $errors->first('phone') }}
                        </span>
                    @endif
                </div>
                
                <div class="formfield">
                    <label for="frmDob">DOB</label>
                    <input type="text" name="dob" value="{{old('dob')}}" class="form-control datepicker" autocomplete="off">
                </div>
                <div class="formfield">
                    <label for="music_genre">Music Genre</label>
                    <select onchange="select_genre(this);" name="music_genre_id" id="frmMusicGenre" class="form-control">
                        @foreach($genres as $key => $genre)
                            <option value="{{ $key }}" {{old('music_genre_id') == $key ? 'selected' : ''}}>{{$genre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="formfield" id="music_genre_other1" style="display:none;">
                    <label for="frmOther">Other</label>
                    <input type="text" name="music_genre_other" id="music_genre_other" class="form-control" value="{{old('music_genre_other')}}">
                </div>
                <div class="formfield">
                    
                    <label>Membership Options</label>

                    @if($type == 'fan')
                    <div class="form-check customradio">
                        <input type="radio" name="membership_type_id" id="frmMember1" value="1" checked="checked" class="form-control">
                        <label for="frmMember1">Free Fan</label>
                    </div>
                    @endif

                    @if($type == 'musician')
                    <div class="form-check customradio">
                        <input type="radio" name="membership_type_id" id="frmMember2" value="2" class="form-control" checked="checked">
                        <label for="frmMember2">$25/year Musician</label>
                    </div>
                    @endif

                    @if($type == 'band-leader')
                    <div class="form-check customradio">
                        <input type="radio" name="membership_type_id" id="frmMember3" value="3" class="form-control" checked="checked">
                        <label for="frmMember3">$50/year Band</label>
                    </div>
                    @endif

                    @if($type == 'event-promoter')
                    <div class="form-check customradio">
                        <input type="radio" name="membership_type_id" id="frmMember4" value="4" class="form-control" checked="checked">
                        <label for="frmMember4">$75/Membership Promotor</label>
                    </div>
                    @endif

                </div>
                <div class="formfield" id="musicCategory" @if($type != 'musician') style="display:none" @endif>
                    <label>Music Category</label>
                    <div class="row">
                        @if(isset($categories))
                            @foreach($categories as $key=>$cat)
                            <div class="col-md-2">
                                <div class="form-check customcheckbox">
                                    <input type="checkbox" name="music_category_id[]" cat_name="{{$cat}}" id="frmMusic{{$key}}" value="{{$key}}" onclick="select_max_cat(this)" class="form-check-input">
                                    <label for="frmMusic{{$key}}">{{$cat}}</label>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="new_category_container"></div>
                </div>
                {{--   
                <div class="formfield formfield-addcat" id="addCategory" @if($type != 'musician') style="display:none" @endif>
                    <input name="name" type="text" id="new_category" placeholder="Category name" class="form-control">
                    <input type="button" id="add_music_cats" value="Add Category" onclick="add_music_cat('#new_category');" class="form-control">
                </div>
                --}}
                
                <div class="formfield formfield-upload" id="uploadImg">

                    <label style="margin-right:30px;">Profile Picture</label>

                    <input type="file" name="profile_image" id="profile_image">
                    			
                    <button type="button" id="button-profile" data-loading-text="Loading..." class="btn btn-default" style="margin-top:8px;"><i class="fa fa-upload" style="font-size:2em;"></i> </button>

                    <button type="button" id="button-clear" data-loading-text="Loading..." class="btn btn-danger btn-bock" style="margin-top:8px;"><i class="fa fa-eraser" style="font-size:2em;"></i> </button>

                    <input type="hidden" id="dpevent" name="profile_image" value="" class="form-control">
                    
                </div>

                <div class="formfield">
                    @php $term = App\Models\Page::find(2);@endphp
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

                <div class="formfield formfield-submit">
                    <input type="submit" value="Register" class="form-control">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('head-css')
<link rel="stylesheet" href="{{asset('assets/datepicker/datepicker.min.css')}}">
@endsection
@section('footer-js')
<script src="{{asset('assets/datepicker/datepicker.min.js')}}"></script>
<script>
    function togglePasswordType() {
        var x = document.getElementById("frmPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
     function togglePasswordType1() {
        var x = document.getElementById("password_confirmation");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<script type="text/javascript">

    $(".datepicker").datepicker({
        autoClose: true,
         format: "yyyy-mm-dd",
        viewStart: 2
    });

    function add_music_cat(element){
        var route = "{{route('create.music-category.from-register-form')}}";
        var new_category = $(element).val();
        $.ajax({
             type: 'get',
             url: route,
             data:{name:new_category},
             success: function(res){
                var htmlContainer = '<div class="form-check customcheckbox">'+
                    '<input type="checkbox" name="music_category_id[]" cat_name="{{$cat}}" id="frmMusic'+res.data.id+'" value="'+res.data.id+'" class="form-control"><label for="frmMusic'+res.data.id+'">'+res.data.name+'</label>'+
                    '</div>';

                $("#musicCategory .new_category_container").append(htmlContainer);

                $(element).val('');
             }
        });
    }


    
</script>

@endsection