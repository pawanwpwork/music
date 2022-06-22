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
                           @include('frontend.dashboard.include.profile-box-guest')
                        </div>
                        <div class="profile__main col-lg-8">
                           
                            <div class="profile-desc">
                               {!!$member->short_description!!}
                            </div>
                           
                            <div class="profile-gallery">
                                <h2 class="heading">Images</h2>
                            
                                <div class="white-border">
                                   
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
                          
                            <div class="profile-gallery profile-video">
                                <h2 class="heading">Videos</h2>
                                <div class="white-border">
                                   
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
                          

                         
                            <div class="profile-gallery">
                                <h2 class="heading">Instruments</h2>
                              
                                <div class="white-border">
                                  
                                    <div class="row profile-gallery-row">
                                        @if(isset($member->instrument) && count($member->instrument) > 0)
                                        @foreach($member->instrument as $instrument)
                                        <div class="profile-gallery-col col-md-4 col-sm-6">
                                            <div class="profile-gallery-img square">
                                                <a href="{{route('frontend.member.instrument',$instrument->id)}}" data-rel="lightcase:gallery" title="Art">
                                                    <img src="{{route('frontend.member.instrument',$instrument->id)}}" alt="{{$instrument->description}}">
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
                           
                        </div>

                    </div>
                </div>
            </div>
       
        </div>
    </div>
</div>

<!-- Modal -->

@endsection