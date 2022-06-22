@extends('layouts.app-backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add Member</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{route('admin.member.list')}}">list</a>
            </li>
            <li class="active">
                <strong>Add Member</strong>
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
                    <h5>Add Member from the following form.</h5>
                </div>
                <div class="ibox-content">
                <form method="POST" class="form-horizontal" action="{{route('admin.member.store')}}" enctype="multipart/form-data">
                    @csrf()
                    @include('backend.components.member._form')
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
<link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@stop
@section('footer-scripts')
<script type="text/javascript" src="{{ asset('assets/backend/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
<script src="{{asset('assets/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@stop