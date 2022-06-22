@extends('layouts.app')

@section('content')
<div class="container">
    <div class="box">             
        <div class="register__options-wrap" id="registerOptions">
            <h1 class="heading-page">Register Here</h1>
            <div class="row register__row">
                <!-- register col -->
                <div class="col-lg-3 col-md-6 register__col">
                    <div class="register__box">
                        <h3 class="register__title">Fan</h3>
                        @if($fanMember->sign_up_fee == 0)
                        <span class="register__price">Free</span>
                        @else
                        <span class="register__price">${{$fanMember->sign_up_fee}}/{{$fanMember->sign_up_fee_duration}}</span>
                        @endif
                        <div class="register__details">
                            <h5>MEMBERSHIP INCLUDES</h5>
                            <ul>
                                @if($fanMember->photo > 0)
                                <li>{{$fanMember->photo}} {{$fanMember->photo > 1 ? 'photos' : 'photo'}}</li>
                                @endif

                                @if($fanMember->video > 0 )
                                <li>{{$fanMember->video}} {{$fanMember->video > 1 ? 'videos' : 'video'}}</li>
                                @endif

                                @if($fanMember->song > 0)
                                <li>{{$fanMember->song}} {{$fanMember->song > 1 ? 'songs' : 'song'}}</li>
                                @endif

                                @if($fanMember->instrument > 0)
                                <li>{{$fanMember->instrument}} {{$fanMember->instrument > 1 ? 'instruments' : 'instrument'}}</li>
                                @endif

                                @if($fanMember->full_access == true)
                                <li>YOU HAVE ACCESS TO THE FULL SITE</li>
                                @endif

                                @if($fanMember->home_access == true)
                                <li>HOME</li>
                                @endif

                                @if($fanMember->about_us == true)
                                <li>ABOUT US</li>
                                @endif

                                @if($fanMember->view_event == true && $fanMember->post_event == true)
                                    <li>VIEW /POST EVENT</li>
                                @else
                                    @if($fanMember->view_event == true )
                                    <li>VIEW EVENT</li>
                                    @endif

                                    @if($fanMember->post_event == true)
                                    <li>POST EVENT</li>
                                    @endif
                                @endif
                                @if($fanMember->request_to_book_band == true)
                                <li>REQUEST TO BOOK A BAND</li>
                                @endif

                                @if($fanMember->view_classified == true && $fanMember->post_classified == true)
                                    <li>POST/VIEW CLASSIFIEDS</li>
                                @else                                

                                    @if($fanMember->post_classified == true)
                                    <li>POST CLASSIFIEDS</li>
                                    @endif

                                    @if($fanMember->view_classified == true)
                                    <li>VIEW CLASSIFIEDS</li>
                                    @endif

                                @endif

                                @if($fanMember->cd_store == true)
                                <li>CD STORE</li>
                                @endif

                                @if($fanMember->musian_search == true)
                                <li>MUSICAN SEARCH THROUGH OUR DATA BASE</li>
                                @endif

                                @if($fanMember->radio_listen == true && $fanMember->radio_submit == true)
                                    
                                    <li>LISTEN TO THE RADIO AND SUBMITT YOUR FAVORITE SONGS TO OUR RADIO STATION</li>
                                
                                @else
                                    @if($fanMember->radio_listen == true)
                                    <li>LISTEN TO LIVE BROADAST FROM OUR RADIO STATION</li>
                                    @endif


                                    @if($fanMember->radio_submit == true)
                                    <li>SUBMITT YOUR FAVORITE SONGS TO OUR RADIO STATION</li>
                                    @endif

                                @endif
                                @if($fanMember->contact_us == true)
                                <li>CONTACT US</li>
                                @endif

                                @if($fanMember->cd_sell == true)
                                <li><strong>SUBMIT YOUR CDS TO US FOR CD ONLINE SALES</strong></li>
                                @endif

                            </ul>
                        </div>
                        <div class="register__action">
                            <a id="registerSignUpFan" href="{{route('signup.type',['type'=>'fan'])}}"></a>
                        </div>
                    </div>
                </div>
                <!-- register col -->
                <div class="col-lg-3 col-md-6 register__col">
                    <div class="register__box">
                        <h3 class="register__title">Musician</h3>
                        
                        @if($musicianMember->sign_up_fee == 0)
                        <span class="register__price">Free</span>
                        @else
                        <span class="register__price">${{$musicianMember->sign_up_fee}}/{{$musicianMember->sign_up_fee_duration}}</span>
                        @endif

                        <div class="register__details">
                            <h5>MEMBERSHIP INCLUDES</h5>
                            <ul>
                            @if($musicianMember->photo > 0)
                            <li>{{$musicianMember->photo}} {{$musicianMember->photo > 1 ? 'photos' : 'photo'}}</li>
                            @endif

                            @if($musicianMember->video > 0 )
                            <li>{{$musicianMember->video}} {{$musicianMember->video > 1 ? 'videos' : 'video'}}</li>
                            @endif

                            @if($musicianMember->song > 0)
                            <li>{{$musicianMember->song}} {{$musicianMember->song > 1 ? 'songs' : 'song'}}</li>
                            @endif

                            @if($musicianMember->instrument > 0)
                            <li>{{$musicianMember->instrument}} {{$musicianMember->instrument > 1 ? 'instruments' : 'instrument'}}</li>
                            @endif

                            @if($musicianMember->full_access == true)
                            <li>YOU HAVE ACCESS TO THE FULL SITE</li>
                            @endif

                            @if($musicianMember->home_access == true)
                            <li>HOME</li>
                            @endif

                            @if($musicianMember->about_us == true)
                            <li>ABOUT US</li>
                            @endif

                            @if($musicianMember->view_event == true && $musicianMember->post_event == true)
                                <li>VIEW /POST EVENT</li>
                            @else
                                @if($musicianMember->view_event == true )
                                <li>VIEW EVENT</li>
                                @endif

                                @if($musicianMember->post_event == true)
                                <li>POST EVENT</li>
                                @endif
                            @endif
                            @if($musicianMember->request_to_book_band == true)
                            <li>REQUEST TO BOOK A BAND</li>
                            @endif

                            @if($musicianMember->view_classified == true && $musicianMember->post_classified == true)
                                <li>POST/VIEW CLASSIFIEDS</li>
                            @else                                

                                @if($musicianMember->post_classified == true)
                                <li>POST CLASSIFIEDS</li>
                                @endif

                                @if($musicianMember->view_classified == true)
                                <li>VIEW CLASSIFIEDS</li>
                                @endif

                            @endif

                            @if($musicianMember->cd_store == true)
                            <li>CD STORE</li>
                            @endif

                            @if($musicianMember->musian_search == true)
                            <li>MUSICAN SEARCH THROUGH OUR DATA BASE</li>
                            @endif

                            @if($musicianMember->radio_listen == true && $musicianMember->radio_submit == true)
                                
                                <li>LISTEN TO THE RADIO AND SUBMITT YOUR FAVORITE SONGS TO OUR RADIO STATION</li>

                            @else
                                @if($musicianMember->radio_listen == true)
                                <li>LISTEN TO LIVE BROADAST FROM OUR RADIO STATION</li>
                                @endif


                                @if($musicianMember->radio_submit == true)
                                <li>SUBMITT YOUR FAVORITE SONGS TO OUR RADIO STATION</li>
                                @endif

                            @endif
                            @if($musicianMember->contact_us == true)
                            <li>CONTACT US</li>
                            @endif

                            @if($musicianMember->cd_sell == true)
                            <li><strong>SUBMIT YOUR CDS TO US FOR CD ONLINE SALES</strong></li>
                            @endif
                            </ul>
                        </div>
                        <div class="register__action">
                            <a id="registerSignUpMusician" href="{{route('signup.type',['type'=>'musician'])}}"></a>
                        </div>
                    </div>
                </div>
                <!-- register col -->
                <div class="col-lg-3 col-md-6 register__col">
                    <div class="register__box">
                        <h3 class="register__title">Band leader</h3>
                        @if($bandLeaderMember->sign_up_fee == 0)
                        <span class="register__price">Free</span>
                        @else
                        <span class="register__price">${{$bandLeaderMember->sign_up_fee}}/{{$bandLeaderMember->sign_up_fee_duration}}</span>
                        @endif
                        <div class="register__details">
                            <h5>MEMBERSHIP INCLUDES</h5>
                            <ul>
                                @if($bandLeaderMember->photo > 0)
                                <li>{{$bandLeaderMember->photo}} {{$bandLeaderMember->photo > 1 ? 'photos' : 'photo'}}</li>
                                @endif

                                @if($bandLeaderMember->video > 0 )
                                <li>{{$bandLeaderMember->video}} {{$bandLeaderMember->video > 1 ? 'videos' : 'video'}}</li>
                                @endif

                                @if($bandLeaderMember->song > 0)
                                <li>{{$bandLeaderMember->song}} {{$bandLeaderMember->song > 1 ? 'songs' : 'song'}}</li>
                                @endif

                                @if($bandLeaderMember->instrument > 0)
                                <li>{{$bandLeaderMember->instrument}} {{$bandLeaderMember->instrument > 1 ? 'instruments' : 'instrument'}}</li>
                                @endif

                                @if($bandLeaderMember->full_access == true)
                                <li>YOU HAVE ACCESS TO THE FULL SITE</li>
                                @endif

                                @if($bandLeaderMember->home_access == true)
                                <li>HOME</li>
                                @endif

                                @if($bandLeaderMember->about_us == true)
                                <li>ABOUT US</li>
                                @endif

                                @if($bandLeaderMember->view_event == true && $bandLeaderMember->post_event == true)
                                    <li>VIEW /POST EVENT</li>
                                @else
                                    @if($bandLeaderMember->view_event == true )
                                    <li>VIEW EVENT</li>
                                    @endif

                                    @if($bandLeaderMember->post_event == true)
                                    <li>POST EVENT</li>
                                    @endif
                                @endif
                                @if($bandLeaderMember->request_to_book_band == true)
                                <li>REQUEST TO BOOK A BAND</li>
                                @endif

                                @if($bandLeaderMember->view_classified == true && $bandLeaderMember->post_classified == true)
                                    <li>POST/VIEW CLASSIFIEDS</li>
                                @else                                

                                    @if($bandLeaderMember->post_classified == true)
                                    <li>POST CLASSIFIEDS</li>
                                    @endif

                                    @if($bandLeaderMember->view_classified == true)
                                    <li>VIEW CLASSIFIEDS</li>
                                    @endif

                                @endif

                                @if($bandLeaderMember->cd_store == true)
                                <li>CD STORE</li>
                                @endif

                                @if($bandLeaderMember->musian_search == true)
                                <li>MUSICAN SEARCH THROUGH OUR DATA BASE</li>
                                @endif

                                @if($bandLeaderMember->radio_listen == true && $bandLeaderMember->radio_submit == true)
                                    
                                    <li>LISTEN TO THE RADIO AND SUBMITT YOUR FAVORITE SONGS TO OUR RADIO STATION</li>

                                @else
                                    @if($bandLeaderMember->radio_listen == true)
                                    <li>LISTEN TO LIVE BROADAST FROM OUR RADIO STATION</li>
                                    @endif


                                    @if($bandLeaderMember->radio_submit == true)
                                    <li>SUBMITT YOUR FAVORITE SONGS TO OUR RADIO STATION</li>
                                    @endif

                                @endif
                                @if($bandLeaderMember->contact_us == true)
                                <li>CONTACT US</li>
                                @endif

                                @if($bandLeaderMember->cd_sell == true)
                                <li><strong>SUBMIT YOUR CDS TO US FOR CD ONLINE SALES</strong></li>
                                @endif
                            </ul>
                        </div>
                        <div class="register__action">
                            <a id="registerSignUpBand" href="{{route('signup.type',['type'=>'band-leader'])}}"></a>
                        </div>
                    </div>
                </div>
                <!-- register col -->
                <div class="col-lg-3 col-md-6 register__col">
                    <div class="register__box">
                        <h3 class="register__title">Event Promoter</h3>
                         @if($eventPromoterMember->sign_up_fee == 0)
                        <span class="register__price">Free</span>
                        @else
                        <span class="register__price">${{$eventPromoterMember->sign_up_fee}}/{{$eventPromoterMember->sign_up_fee_duration}}</span>
                        @endif
                        <div class="register__details">
                            <h5>MEMBERSHIP INCLUDES</h5>
                            <ul>
                               @if($eventPromoterMember->photo > 0)
                                <li>{{$eventPromoterMember->photo}} {{$eventPromoterMember->photo > 1 ? 'photos' : 'photo'}}</li>
                                @endif

                                @if($eventPromoterMember->video > 0 )
                                <li>{{$eventPromoterMember->video}} {{$eventPromoterMember->video > 1 ? 'videos' : 'video'}}</li>
                                @endif

                                @if($eventPromoterMember->song > 0)
                                <li>{{$eventPromoterMember->song}} {{$eventPromoterMember->song > 1 ? 'songs' : 'song'}}</li>
                                @endif

                                @if($eventPromoterMember->instrument > 0)
                                <li>{{$eventPromoterMember->instrument}} {{$eventPromoterMember->instrument > 1 ? 'instruments' : 'instrument'}}</li>
                                @endif

                                @if($eventPromoterMember->full_access == true)
                                <li>YOU HAVE ACCESS TO THE FULL SITE</li>
                                @endif

                                @if($eventPromoterMember->home_access == true)
                                <li>HOME</li>
                                @endif

                                @if($eventPromoterMember->about_us == true)
                                <li>ABOUT US</li>
                                @endif

                                @if($eventPromoterMember->view_event == true && $eventPromoterMember->post_event == true)
                                    <li>VIEW /POST EVENT</li>
                                @else
                                    @if($eventPromoterMember->view_event == true )
                                    <li>VIEW EVENT</li>
                                    @endif

                                    @if($eventPromoterMember->post_event == true)
                                    <li>POST EVENT</li>
                                    @endif
                                @endif
                                @if($eventPromoterMember->request_to_book_band == true)
                                <li>REQUEST TO BOOK A BAND</li>
                                @endif

                                @if($eventPromoterMember->view_classified == true && $eventPromoterMember->post_classified == true)
                                    <li>POST/VIEW CLASSIFIEDS</li>
                                @else                                

                                    @if($eventPromoterMember->post_classified == true)
                                    <li>POST CLASSIFIEDS</li>
                                    @endif

                                    @if($eventPromoterMember->view_classified == true)
                                    <li>VIEW CLASSIFIEDS</li>
                                    @endif

                                @endif

                                @if($eventPromoterMember->cd_store == true)
                                <li>CD STORE</li>
                                @endif

                                @if($eventPromoterMember->musian_search == true)
                                <li>MUSICAN SEARCH THROUGH OUR DATA BASE</li>
                                @endif

                                @if($eventPromoterMember->radio_listen == true && $eventPromoterMember->radio_submit == true)
                                    
                                    <li>LISTEN TO THE RADIO AND SUBMITT YOUR FAVORITE SONGS TO OUR RADIO STATION</li>

                                @else
                                    @if($eventPromoterMember->radio_listen == true)
                                    <li>LISTEN TO LIVE BROADAST FROM OUR RADIO STATION</li>
                                    @endif


                                    @if($eventPromoterMember->radio_submit == true)
                                    <li>SUBMITT YOUR FAVORITE SONGS TO OUR RADIO STATION</li>
                                    @endif

                                @endif
                                @if($eventPromoterMember->contact_us == true)
                                <li>CONTACT US</li>
                                @endif

                                @if($eventPromoterMember->cd_sell == true)
                                <li><strong>SUBMIT YOUR CDS TO US FOR CD ONLINE SALES</strong></li>
                                @endif
                            </ul>
                        </div>
                        <div class="register__action">
                            <a id="registerSignUpPromotor" href="{{route('signup.type',['type'=>'event-promoter'])}}"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection