@extends('layouts.app')

@section('content')
   <!-- site content -->
   <div class="sitecontent__outer">
        <div class="container">
            <div class="sitecontent">
                <div class="box">
                    @include('layouts.message')
                    <div class="bookaband__wrap">
                        <h2 class="heading">Book A Band / DJ</h2>
                        <div class="box-inner">
                            <form action="{{ route('book-band.post') }}" class="bookaband-form" method="post" enctype="multipart/form-data">
                                @csrf
                                @include('frontend.book-band._form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('head-css')
<link rel="stylesheet" href="{{asset('assets/css/jquery-ui.min.css')}}">
@endsection

@section('scripts')
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script>
$(document).ready(function () {
    $("#frmDate").datepicker();
});
</script>
@endsection