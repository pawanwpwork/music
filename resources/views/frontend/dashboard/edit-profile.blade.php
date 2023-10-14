@extends('layouts.app')

@section('content')
 <!-- site content -->
<div class="sitecontent__outer">
    <div class="container">
        <div class="sitecontent">
            <div class="box">
                <div class="profile__wrap">
                    @include('frontend.dashboard.include.upgrade-member')
                    <div class="row">
                        <div class="profile__side col-lg-4">
                            @include('frontend.dashboard.include.profile-box')
                        </div>
                        <div class="profile__main col-lg-8">
                            @include('layouts.message')
                            
                            <form action="{{route('frontend.member.update.data')}}" method="POST">
                                @csrf()
                                <div class="row">
                                    <div class="formfield col-md-6">
                                        <label for="first_name">First Name:</label>
                                        <input type="text" name="first_name" id="first_name" value="{{$member->first_name}}">
                                    </div>
                                    <div class="formfield col-md-6">
                                        <label for="last_name">Last Name:</label>
                                        <input type="text" name="last_name" id="last_name" value="{{$member->last_name}}">
                                    </div>
                                    <div class="formfield col-12">
                                        <label for="email">Email Address</label>
                                        <input type="email" name="email" id="email" value="{{$member->email}}">
                                    </div>
                                    <div class="formfield col-12">
                                        <label for="phone">Phone</label>
                                        <input type="tel" name="phone" id="phone" value="{{$member->phone}}">
                                    </div>
                                    <div class="formfield col-12">
                                        <label for="dob">DOB</label>
                                        <input type="text" name="dob" id="dob" value="{{isset($member->dob) ? $member->dob : '' }}" autocomplete="off" readonly>
                                    </div>
                                    <div class="formfield col-12">
                                        <label for="country">Country</label>
                                        <input type="text" name="country" id="country" value="{{$member->country}}">
                                    </div>
                                    <div class="formfield col-12">
                                        <label for="city">City</label>
                                        <input type="text" name="city" id="city" value="{{$member->city}}">
                                    </div>
                                    <div class="formfield col-12">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" id="address" value="{{$member->address}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="heading-mini">Social Links</h3>
                                    </div>
                                    <div class="formfield col-md-3">
                                        <label for="facebook_url"><i class="fab fa-facebook"></i>
                                            Facebook</label>
                                        <input type="url" name="facebook_url" id="facebook_url" value="{{$member->facebook_url}}">
                                    </div>
                                    <div class="formfield col-md-3">
                                        <label for="instagram_url"><i class="fab fa-instagram"></i>
                                            instagram</label>
                                        <input type="url" name="instagram_url" id="instagram_url" value="{{$member->instagram_url}}">
                                    </div>
                                    <div class="formfield col-md-3">
                                        <label for="twitter_url"><i class="fab fa-twitter"></i>
                                            Twitter</label>
                                        <input type="url" name="twitter_url" id="twitter_url" value="{{$member->twitter_url}}">
                                    </div>
                                    <div class="formfield col-md-3">
                                        <label for="youtube_url"><i class="fab fa-youtube"></i>
                                            Youtube</label>
                                        <input type="url" name="youtube_url" id="youtube_url" value="{{$member->youtube_url}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="formfield formfield-submit col-12">
                                        <input type="submit" value="Save Changes">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
@include('frontend.dashboard.modal.upload-profile-image')

@endsection

@section('head-css')
<link rel="stylesheet" href="{{asset('assets/datepicker/datepicker.min.css')}}">
<style type="text/css">
    #appendUploadImage img.active{
        border: 2px solid #d01212;
    }
</style>
@endsection

@section('footer-js')
<script src="{{asset('assets/datepicker/datepicker.min.js')}}"></script>
@include('frontend.dashboard.scripts.upload-profile-image-js')
<script>
$("#dob").datepicker({
    autoClose: true,
    format: "yyyy-mm-dd",
    viewStart: 2
});
</script>
@endsection