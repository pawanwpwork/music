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
                                <div class="profile-gallery">
                                    <h2 class="heading">Instruments</h2>
                                    <p>*You can upload only {{$memberSetting->instrument}} {{$memberSetting->instrument > 1 ? 'instruments' : 'instrument'}}.</p>
                                    @if(count($member->instrument) >= $memberSetting->instrument)
                                    <p>Maximum Number of allowed Photos are Uploaded. You can't Add More Photos</p>
                                    @endif
                                    <div class="row profile-img-edit--row">
                                        @if(count($member->instrument) > 0)
                                        
                                            @foreach($member->instrument as $instrument)
                                                <div class="col-md-3 col-sm-4">
                                                    <div class="profile-img-edit--item square">
                                                        
                                                        <img src="{{route('frontend.member.instrument',$instrument->id)}}"
                                                            alt="Video">
                                                    </div>
                                                </div>
                                            @endforeach
                                        
                                        @endif
                                        @if(count($member->instrument) < $memberSetting->instrument)
                                       
                                            <div class="col-md-3 col-sm-4">
                                                <form action="{{route('frontend.member.update.instrument')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf()
                                                    <div class="profile-img-edit--uploader formfield">
                                                        <label for="imgItemUpload"><i class="fa fa-camera"></i> Upload</label>
                                                        <input name="instrument" type="file" id="imgItemUpload">
                                                        <input name="description" type="text" id="imgItemDesc" placeholder="Instrument Description">
                                                        <button type="submit">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                
                                        @endif
                                    </div>
                                </div>
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
    <style type="text/css">
        #appendUploadImage img.active{
            border: 2px solid #d01212;
        }
    </style>
@endsection

@section('footer-js')
@include('frontend.dashboard.scripts.upload-profile-image-js')
@endsection