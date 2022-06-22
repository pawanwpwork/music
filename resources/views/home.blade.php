@extends('layouts.app')

@section('content')

<div class="upcomingevent__wrap">
    <div class="container">
        <div class="upcomingevent">
          
            @php $siteSetting = siteSetting(); @endphp
            <h2 class="upcomingevent__title">{{ (isset($siteSetting->home_slider_title) ? ($siteSetting->home_slider_title) : 'WELCOME TO ALL MUSIC ARTIST WEB SITE') }}</h2>
            <h5 class="upcomingevent__subttitle">{{ (isset($siteSetting->home_slider_subtitle) ? ($siteSetting->home_slider_subtitle) : 'Look out for our special offers.') }}</h5>
            <!-- <a class="upcomingevent__link" href="#">Buy Ticket</a> -->
        </div>
    </div>
</div>

<!-- site content -->
<div class="sitecontent__outer">
    <div class="container">
        <div class="sitecontent">
            <div class="box">
                <div class="homepageslider__wrap">
                    <section class="homepageslider__section">
                        <div class="homepageslider__title">
                            <h2 class="heading">Upcoming Events</h2>
                        </div>
                        <div class="homepageslider__body">
                            <!-- homepage owl slider -->
                            <div class="albumslider owl-carousel owl-theme">
                                @forelse($upcomingEvents as $upcomingEvent)
                                <div class="item">
                                    <div class="overlay__outer square">
                                        <img src="{{route('admin.event.storage',$upcomingEvent->id)}}" class="img-responsive" alt="">
                                        <div class="overlay__info">
                                            <div class="overlay__cont">
                                                <div class="overlay__cont-inner">
                                                    <h3><a href="{{route('event.single',$upcomingEvent->alias)}}">{{ $upcomingEvent->name ?? '' }}</a></h3>
                                                    <p><a href="{{route('event.single',$upcomingEvent->alias)}}">{{ $upcomingEvent->location ?? '' }}</a></p>
                                                    <p><a href="{{route('event.single',$upcomingEvent->alias)}}">@if( isset( $upcomingEvent->event_end_date ) ) {{ date('Y-m-d', strtotime($upcomingEvent->event_end_date)) }} @endif {{ date('h:i A', strtotime($upcomingEvent->time)) }}</a></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="overlay">
                                            <div class="overlay__cont">
                                                <div class="overlay__cont-inner">
                                                    <h3><a href="{{route('event.single',$upcomingEvent->alias)}}">{{ $upcomingEvent->name ?? '' }}</a></h3>
                                                    <p><a href="{{route('event.single',$upcomingEvent->alias)}}">{{ $upcomingEvent->location ?? '' }}</a></p>
                                                    <p><a href="{{route('event.single',$upcomingEvent->alias)}}">@if( isset( $upcomingEvent->event_end_date ) ) {{ date('Y-m-d', strtotime($upcomingEvent->event_end_date)) }} @endif {{ date('h:i A', strtotime($upcomingEvent->time)) }}</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <p>No Upcoming Events here!</p>
                                @endforelse
                            </div>
                        </div>
                    </section>
                    <section class="homepageslider__section">
                        <div class="homepageslider__title">
                            <h2 class="heading">Featured CD</h2>
                        </div>
                        <div class="homepageslider__body">
                            <!-- homepage owl slider -->
                            @if(isset($cdProducts) && count($cdProducts))
                                <div class="albumslider owl-carousel owl-theme">
                                    @foreach($cdProducts as $cdProduct)
                                    <div class="item">
                                        <div class="overlay__outer square">
                                            <img src="{{route('admin.product.storage',$cdProduct->id)}}" class="img-responsive" alt="">
                                            <div class="overlay__info">
                                                <div class="overlay__cont">
                                                    <div class="overlay__cont-inner">
                                                        <h3><a href="{{ route('cd.single-page',$cdProduct->alias) }}">{{ $cdProduct->name}}</a></h3>
                                                        @if($cdProduct->price != 0)
                                                            <p><a href="{{ route('cd.single-page',$cdProduct->alias) }}">${{ number_format( $cdProduct->price , 2 ) ?? '' }}</a></p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="overlay">
                                                <div class="overlay__cont">
                                                    <div class="overlay__cont-inner">
                                                        <h3><a href="{{ route('cd.single-page',$cdProduct->alias) }}">{{ $cdProduct->name}}</a></h3>
                                                        @if($cdProduct->price != 0)
                                                            <p><a href="{{ route('cd.single-page',$cdProduct->alias) }}">${{ number_format( $cdProduct->price , 2 ) ?? '' }}</a></p>
                                                        @endif
                                                       <p><a href="{{ route('cd.single-page',$cdProduct->alias) }}">{{ $cdProduct->date_available }}</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No Featured CD Here</p>
                            @endif
                        </div>
                    </section>

                    <section class="homepageslider__section">
                        <div class="homepageslider__title">
                            <h2 class="heading">CLASSIFIEDS</h2>
                        </div>
                        <div class="homepageslider__body">
                            <!-- homepage owl slider -->
                             @if(isset($classifiedProducts) && count($classifiedProducts))
                                <div class="albumslider owl-carousel owl-theme">
                                    @foreach($classifiedProducts as $classfiedProduct)
                                    <div class="item">
                                        <div class="overlay__outer square">
                                            <img src="{{route('admin.product.storage',$classfiedProduct->id)}}" class="img-responsive" alt="">
                                            <div class="overlay__info">
                                                <div class="overlay__cont">
                                                    <div class="overlay__cont-inner">
                                                        <h3><a href="{{ route('classified.single-page',$classfiedProduct->alias) }}">{{ $classfiedProduct->name}}</a></h3>
                                                        @if($classfiedProduct->price != 0)
                                                        <p><a href="{{ route('classified.single-page',$classfiedProduct->alias) }}">${!! $classfiedProduct->price !!}</a></p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="overlay">
                                                <div class="overlay__cont">
                                                    <div class="overlay__cont-inner">
                                                        <h3><a href="{{ route('classified.single-page',$classfiedProduct->alias) }}">{{ $classfiedProduct->name}}</a></h3>
                                                        @if($classfiedProduct->price != 0)
                                                            <p><a href="{{ route('classified.single-page',$classfiedProduct->alias) }}">${{ number_format( $classfiedProduct->price , 2 ) ?? '' }}</a></p>
                                                        @endif
                                                       <p><a href="{{ route('classified.single-page',$classfiedProduct->alias) }}">{{ $classfiedProduct->date_available }}</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No Classfied Here!</p>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection