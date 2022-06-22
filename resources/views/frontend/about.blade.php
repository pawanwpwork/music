@extends('layouts.app')

@section('content')
<div class="container">
<div class="box">
    <div class="aboutpage__wrap">
        <h1 class="heading-page">{{$page->title}}</h1>
        <div class="row">
            <div class="col-lg-7 col-12">
            	@if(isset($page->attachment))
                	<img src="{{asset('uploads/'.$page->attachment)}}" class="img-fluid" alt="">
                @endif
            </div>
            {!!$page->content!!}
        </div>
    </div>
</div>
</div>
@endsection