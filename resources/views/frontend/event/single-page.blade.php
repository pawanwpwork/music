@extends('layouts.app')

@section('content')
<!-- site content -->
<div class="sitecontent__outer">
    <div class="container">
        <div class="sitecontent">
            <div class="box">
                <div class="eventdetail__wrap">
                    <div class="eventdetail__header">
                        <img src="{{ route('admin.event.storage',$event->id) }}" alt="">
                        <h2 class="heading">{{ $event->name ?? '' }}</h2>
                        <p>{!! $event->description ?? '' !!}</p>
                    </div>
                    <section class="section__eventsingle section__eventsingle-time">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="heading">Event Date</h2>
                                <div class="event-time">
                                    <div class="event-time--icon">
                                        <i class="fa fa-calendar-alt"></i>
                                    </div>
                                    @if( isset( $event->event_end_date ) )
                                    <div class="event-time--text">
                                        <span>{{ date('F j, Y', strtotime($event->event_start_date))}}</span> - <span>{{ date('F j, Y', strtotime($event->event_end_date))}}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h2 class="heading">Event Time</h2>
                                <div class="event-time">
                                    <div class="event-time--icon">
                                        <i class="fa fa-clock"></i>
                                    </div>
                                    <div class="event-time--text">
                                        <!-- <span>10:00</span> - <span>20:00</span> -->
                                        <span>{{ date("g:i A", strtotime($event->time))  }}</span> <span> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                 
                    <section class="section__eventsingle section__eventsingle-map">
                        <h2 class="heading">Event Location</h2>
                        <p>{{$event->location}}</p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

