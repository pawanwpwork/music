@extends('layouts.app')

@section('content')
<!-- site content -->
<div class="sitecontent__outer">
    <div class="container">
        <div class="sitecontent">
            <div class="box">
                @include('layouts.message')
                <div class="classfiedsell__form-wrap box-inner" id="classifiedSellForm">
                    <h1 class="heading">Classified Post</h1>
                    <form action="{{ route('classified.sell.post') }}" method="post" class="classifiedPostForm row" enctype="multipart/form-data">
                        @csrf
                        @include('frontend.classified._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('head-css')
<link rel="stylesheet" href="{{asset('assets/css/jquery-ui.min.css')}}">
<style>
#frmItemType {
    max-width: 25rem;
}
</style>
@endsection

@section('scripts')
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script>
    $(document).ready(function () {
    $("#frmDate").datepicker();

    $("#frmStartDate").datepicker({
        altField: "#alternate",
        altFormat: "DD, d MM, yy",
        minDate: new Date(),
        // maxDate: "+60D",
        onSelect: function (selected) {
            $("#frmEndDate").datepicker("option", "minDate", selected);
            calcDiff();
        }
    });

    $("#frmEndDate").datepicker({
        altField: "#alternate1",
        altFormat: "DD, d MM, yy",
        minDate: new Date((new Date()).getTime() + 86400000),
        // maxDate: "+60D",
        onSelect: function (selected) {
            $("#frmStartDate").datepicker("option", "maxDate", selected);
            calcDiff();
        }
    });

    function calcDiff() {
        var date1 = $('#frmStartDate').datepicker('getDate');
        var date2 = $('#frmEndDate').datepicker('getDate');
        var diff = 0;
        if (date1 && date2) {
            diff = Math.floor((date2.getTime() - date1.getTime()) / 86400000);
        }
        var rate = $('#frmEventRate').val();
        $('#frmTotalDays').val(diff + 1);
        $('#frmSubTotal').val(((diff + 1) * rate).toFixed(2));
    }
});


$('#frmTotalDays').keyup(function(){
    var totalDays = $('#frmTotalDays').val();
    var rate = $('#frmEventRate').val();
    $('#frmSubTotal').val((totalDays * rate).toFixed(2));
});

$(window).on('load',function(){
    var date1 = $('#frmStartDate').datepicker('getDate');
    var date2 = $('#frmEndDate').datepicker('getDate');
    var diff  = 0;
    if (date1 && date2) {
        diff = Math.floor((date2.getTime() - date1.getTime()) / 86400000);
    }
    var totalDays = diff + 1;
    var rate = '{{ isset($rate->classified_per_day_rate) ? $rate->classified_per_day_rate : 6 }}';
    $("#frmTotalDays").val(totalDays);
    $('#frmSubTotal').val((totalDays * rate).toFixed(2));
});
</script>
@endsection