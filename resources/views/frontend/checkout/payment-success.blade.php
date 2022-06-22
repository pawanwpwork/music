@extends('layouts.app')

@section('content')
  <div class="sitecontent__outer">
        <div class="container">
            <div class="sitecontent">
                <div class="box" style="text-align: center;">
                  
                    <i class="fa fa-check">✓</i>
				  
			        <h1>Success</h1> 
			        <p>Your Payment has been Success.</p>
                      <p><a href="{{route('frontend.member.dashboard')}}" class="btn btn-danger">Go to Dashboard</a></p>
			      </div>
                </div>
            </div>
        </div>
    </div>
@endsection