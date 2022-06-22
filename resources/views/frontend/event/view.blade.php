@extends('layouts.app')

@section('content')
    <!-- site content -->
    <div class="sitecontent__outer">
        <div class="container">
            <div class="sitecontent">
                <div class="eventview__wrap">
                    <div class="row eventview__row">
                        <div class="eventview__col col-lg-8">
                            <div class="box">
                                <h1 class="heading-page">Upcoming Event</h1>
                                <div class="eventlist">
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
                                </div>
                            </div>
                           
                            @if( $totalEvent > $perPage )
                            <nav aria-label="Page navigation" style="background: #000;padding: 30px;">
                              <ul class="pagination">
                                @if( $maxNumPage > 1 )
                                <li>
                                  <a href="{{\Request::url()}}?page={{isset($page) ? ( $page-1 ) : 1}}" aria-label="Previous">
                                    <span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                                  </a>
                                </li>
                                @endif
                                @for( $i=1;$i<=$maxNumPage;$i++ )
                                @if( $page == 0 )
                                @php 
                                    $page = 1;
                                @endphp
                                @else
                                    @php 
                                        $page = $page;
                                    @endphp
                                @endif
                                <li @if($page == $i) class="active" @endif><a href="{{\Request::url()}}?page={{$i}}">{{$i}}</a></li>
                                @endfor
                                @if($page != $maxNumPage)
                                <li>
                                  <a href="{{\Request::url()}}?page={{isset($page) ? ( $page+1 ) : 1}}" aria-label="Next">
                                    <span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                  </a>
                                </li>
                                @endif
                              </ul>
                            </nav>
                            @endif
                        </div>
                        <div class="eventview__col col-lg-4">
                            <div class="box">
                                <h2 class="heading">Calendar</h2>
                               
                                <div id="caleandar"></div>
                                <input type="hidden" name="ajax_filter_url" value="{{route('event.view.ajax')}}">
                                <form action="{{route('event.view')}}" method="get" id="eventDateFilter">
                                  <input type="hidden" name="calendartriggerdate">
                                  <div class="form-group"> <!-- Date input -->
                                    <label class="control-label" for="date">From</label>
                                    <input class="form-control" id="frmStartDate" name="from_date" placeholder="MM/DD/YYY" type="text" value="{{request('from_date')}}" required="" autocomplete="off">
                                  </div>
                                  <div class="form-group"> <!-- Date input -->
                                    <label class="control-label" for="date">To</label>
                                    <input class="form-control" id="frmEndDate" name="to_date" placeholder="MM/DD/YYY" type="text" value="{{request('to_date')}}" required="" autocomplete="off">
                                  </div>
                                  
                                  <div class="form-group"> <!-- Submit button -->
                                    <button class="btn btn-primary " name="submit" type="submit">Search Events</button>
                                  </div>
                                 </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('head-css')
<link rel="stylesheet" href="{{asset('assets/css/jquery-ui.min.css')}}">
<style type="text/css">
  /*  .cld-rwd.cld-nav{
        display: none;
    }*/
    .cld-day.prevMonth{
        pointer-events: none;
    }
</style>
@endsection

@section('scripts')
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript">

$(document).ready(function () {
    var events    = {};
    var settings  = {};
    var element   = document.getElementById('caleandar');
    caleandar(element, events, settings);

    var els = document.getElementsByClassName("cld-day");
    var ToDate = new Date();
    for(var i = 0; i < els.length; i++)
    {
        if(els[i].getAttribute('id') !== null)
        {
            if (new Date(els[i].getAttribute('id')).getTime() < ToDate.getTime()) {
                $("#"+els[i].getAttribute('id')).css('pointer-events','none');
                $("#"+els[i].getAttribute('id')).addClass('disableDay');
                
             }
        }
    }

    $("li.today").removeClass('disableDay');
    $("li.today").css('pointer-events','');
    $("li.cld-day").css('cursor','pointer');


    $('.cld-day').click(function(){
        
        $('.cld-day').removeClass('today');

        $(this).addClass('today');

        var clickDate        = $(this).attr('id');
        

         $.ajax({

            type: 'GET',

            url: "{{route('event.view.ajax')}}",

            data: {caleandar_data:clickDate},
           beforeSend: function(){
             // Handle the beforeSend event
             $('.eventlist').html('Processing....');
           },
           success: function(data) {
            console.log(data);
             $('.eventlist').html(data.html);
            },
         
         }); 
        
    });
});


$(document).ready(function () {
  
    $("#frmStartDate").datepicker({
     
        altFormat: "DD, d MM, yy",
        minDate: new Date(),
        // maxDate: "+60D",
        onSelect: function (selected) {
            $("#frmEndDate").datepicker("option", "minDate", selected);
        }
    });

    $("#frmEndDate").datepicker({
     
        altFormat: "DD, d MM, yy",
        minDate: new Date((new Date()).getTime() + 86400000),
        // maxDate: "+60D",
        onSelect: function (selected) {
            $("#frmStartDate").datepicker("option", "maxDate", selected);
        }
    });
});

</script>
@endsection