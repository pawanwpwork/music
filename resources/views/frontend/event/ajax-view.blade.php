@if(isset($upcomingEvents) && count($upcomingEvents) > 0)
    @foreach($upcomingEvents as $upcomingEvent)

        <div class="eventlist__box">
            <div class="row">
                <div class="eventlist__box-lt col-md-5">
                    <div class="eventlist__img">
                        <img src="{{ route('admin.event.storage',$upcomingEvent->id) }}" alt="">
                    </div>
                    @if( isset( $upcomingEvent->event_end_date ) )
                    <div class="eventlist__datetab">
                        <div class="eventlist__datetab-day">{{ date('d', strtotime($upcomingEvent->event_end_date)) }}</div>
                        <div class="eventlist__datetab-month">{{ date('M', strtotime($upcomingEvent->event_end_date)) }}</div>
                        <div class="eventlist__datetab-year">{{ date('Y', strtotime($upcomingEvent->event_end_date)) }}</div>
                    </div>
                    @endif
                </div>
                <div class="eventlist__box-rt col-md-7">
                    <div class="eventlist__details">
                        <h3 class="eventlist__title"><a href="{{ route('event.single', $upcomingEvent->alias) }}">{{ $upcomingEvent->name }}</a></h3>
                        <ul class="eventlist__cont">
                            <li>
                                <strong class="eventlist__cont-heading">Location: </strong>
                                <span class="eventlist__cont-info">{{ $upcomingEvent->location }}</span>
                            </li>
                            @if( isset( $upcomingEvent->event_start_date ) )
                            <li>
                                <strong class="eventlist__cont-heading">Start Date: </strong>
                                <span class="eventlist__cont-info">{{ $upcomingEvent->event_start_date }}</span>
                            </li>
                            @endif
                            @if( isset( $upcomingEvent->event_end_date ) )
                            <li>
                                <strong class="eventlist__cont-heading">End Date: </strong>
                                <span class="eventlist__cont-info">{{ $upcomingEvent->event_end_date }}</span>
                            </li>
                            @endif
                            <li>
                                <strong class="eventlist__cont-heading">Time: </strong>
                                <span class="eventlist__cont-info">{{ date("g:i A", strtotime($upcomingEvent->time)) }}</span>
                            </li>
                        </ul>
                        <div class="eventlist__description">
                            <strong>Description:</strong>
                            <p data-maxlength="500">
                            {!! $upcomingEvent->description ?? '' !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
@else

<div class="eventlist__box">
    <div class="row">
         <div class="eventlist__box-lt col-md-12">
             <p>No Data Available!</p>
         </div>
    </div>
</div>

@endif
