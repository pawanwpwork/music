@extends('layouts.app')

@section('content')
<div class="container">
<div class="box">
    <div class="aboutpage__wrap">
        @if(isset($page->attachment))
           <h3> <a href="{{asset('uploads/'.$page->attachment)}}" style="color:blue;">CONSIGNMENT AGREEMENT</a></h3>
        @endif
        <h1 class="heading-page">{{$page->title}}</h1>
        <div class="row">
            <div class="col-lg-12 col-12">
                {!!$page->content!!}
            </div>
        </div>
    </div>
</div>
</div>
@endsection