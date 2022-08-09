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
                            <div class="profile-desc">
                               {!!$member->short_description!!}
                            </div>
                            @if($memberSetting->photo == true)
                            <div class="profile-gallery">
                                <h2 class="heading">Images</h2>
                                <p>*You can upload only {{$memberSetting->photo}} photos.</p>
                                <div class="white-border">
                                    <a class="profile-edit-button profile-edit-button--img" href="{{route('frontend.member.edit.photo')}}"><i class="fa fa-edit"></i> Image</a>
                                    <div class="row profile-gallery-row">
                                        @if(isset($member->photo) && count($member->photo) > 0)
                                        @foreach($member->photo as $photo)
                                        <div class="profile-gallery-col col-md-4 col-sm-6">
                                            <div class="profile-gallery-img square">
                                                <a href="{{route('frontend.member.photo',$photo->id)}}" data-rel="lightcase:gallery" title="Art">
                                                    <img src="{{route('frontend.member.photo',$photo->id)}}" alt="{{$photo->description}}">
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <p>No Data here!</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($memberSetting->video == true)
                            <div class="profile-gallery profile-video">
                                <h2 class="heading">Videos</h2>
                                <div class="white-border">
                                    <a class="profile-edit-button profile-edit-button--img" href="{{route('frontend.member.edit.video')}}"><i class="fa fa-edit"></i> Video</a>
                                    <div class="profile-video-box">
                                        <div class="row">
                                            @if(isset($member->video) && count($member->video) > 0)
                                            @foreach($member->video as $video)
                                            <div class="col-md-6 col-12">
                                                <div class="profile-video-item">
                                                    <video controls>
                                                        <source src="{{route('frontend.member.video',$video->id)}}"
                                                            type="video/mp4">
                                                        Your browser does not support HTML5 video.
                                                    </video>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="col-md-6 col-12">
                                            <p>No Data here!</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($memberSetting->song == true)
                            <div class="profile-video">
                                <h2 class="heading">Songs</h2>
                                <div class="white-border">
                                   
                                    <div class="profile-video-box">
                                        <div class="row">
                                            @if(isset($member->song) && count($member->song) > 0)
                                            @foreach($member->song as $song)
                                            <div class="col-md-6 col-12">
                                                <div class="profile-video-item">
                                                    <audio controls>
                                                        <source src="{{route('frontend.member.song',$song->id)}}"
                                                            type="video/mp4">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="col-md-6 col-12">
                                            <p>No Data here!</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                             @if($memberSetting->instrument == true)
                            <div class="profile-gallery">
                                <h2 class="heading">Instruments</h2>
                                <p>*You can upload only {{$memberSetting->instrument}} instruments.</p>
                                <div class="white-border">
                                    <a class="profile-edit-button profile-edit-button--img" href="{{route('frontend.member.edit.instrument')}}"><i class="fa fa-edit"></i> Instruments</a>
                                    <div class="row profile-gallery-row">
                                        @if(isset($member->instrument) && count($member->instrument) > 0)
                                        @foreach($member->instrument as $instrument)
                                        <div class="profile-gallery-col col-md-4 col-sm-6">
                                            <div class="profile-gallery-img square">
                                                <a href="{{route('frontend.member.instrument',$instrument->id)}}" data-rel="lightcase:gallery" title="Art">
                                                    <img src="{{route('frontend.member.instrument',$instrument->id)}}" alt="{{$instrument->description}}">
                                                </a>
                                            </div>
                                            <p style="color:#FFF;font-size:20px;">{{ $instrument->description }}</p>
                                        </div>
                                        @endforeach
                                        @else
                                        <p>No Data here!</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            <!-- <div class="box">
                <div class="relatedproducts__wrap">
                    <h2 class="heading">Recommended Products</h2>
                   
                    <div class="relatedslider owl-carousel owl-theme">
                   
                        <div class="item">
                            <div class="product__box">
                                <div class="product__thumbnail square">
                                    <img class="product-img" src="images/albumcover/album6-1-300x300.jpg" alt="">
                                    <div class="product-overlay">
                                        <a href="#" class="product-link product-link--view"><i class="fa fa-folder-open"></i>
                                            View</a>
                                        <a href="#" class="product-link product-link--cart"><i class="fa fa-cart-plus"></i>
                                            Add to Cart</a>
                                    </div>
                                </div>
                                <div class="product__cont">
                                    <div class="product-title"><a href="#">The Air Tide</a></div>
                                    <div class="product-price">$15.00</div>
                                </div>
                            </div>
                        </div>
                   
                    </div>
                </div>
            </div> -->
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