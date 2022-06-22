@extends('layouts.app')

@section('content')
<div class="container">
<div class="box">
    <div class="aboutpage__wrap">
        <h1 class="heading-page">{{$page->title}}</h1>
        <div class="row">
            <div class="col-lg-12 col-12">
                @if(isset($page->attachment))
                    <a href="{{asset('uploads/'.$page->attachment)}}" class="btn btn-danger">Consignment Agreement</a>
                @endif

                {!!$page->content!!}
            </div>
        </div>
    </div>
</div>
</div>
@endsection