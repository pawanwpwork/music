@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Rate Settings</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{route('admin.site-setting.list')}}">list</a>
            </li>
            <li class="active">
                <strong>Rate Settings</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            @include('layouts.message')
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Rate Settings from the following form.</h5>
                </div>
                <div class="ibox-content">
                    <form method="POST" class="form-horizontal" action="{{route('admin.rate-setting.store')}}" enctype="multipart/form-data">
                        @csrf()
                        

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Event/ Day Rate($)</label>
                            <div class="col-sm-8">
                                <input name="event_per_day_rate" type="text" placeholder="Event/ Day Rate" class="form-control" value="{{old('event_per_day_rate', (isset($rate->event_per_day_rate)) ? $rate->event_per_day_rate : '')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Book Band/Dj Submission Rate($)</label>
                            <div class="col-sm-8">
                                <input name="book_band_dj_submission_rate" type="text" placeholder="Book Band/Dj Submission Rate" class="form-control" value="{{old('book_band_dj_submission_rate', (isset($rate->book_band_dj_submission_rate)) ? $rate->book_band_dj_submission_rate : '')}}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-4 control-label">Classified/ Day Rate ($)</label>
                            <div class="col-sm-8">
                                <input name="classified_per_day_rate" type="text" placeholder="Book Classified/ Day Rate" class="form-control" value="{{old('classified_per_day_rate', (isset($rate->classified_per_day_rate)) ? $rate->classified_per_day_rate : '')}}">
                            </div>
                        </div>




                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('header-style')
<link href="{{ asset('assets/backend/jasny-bootstrap/css/jasny-bootstrap.css')}}" rel="stylesheet" />
@stop
@section('footer-scripts')
<script type="text/javascript" src="{{ asset('assets/backend/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
@stop