@extends('layouts.app')

@section('content')
<!-- site content -->
 <div class="sitecontent__outer">
        <div class="container">
            <div class="sitecontent">
                <div class="box">
                    <div class="profile__wrap">
                        @if(isset($results) && !empty($results) && count($results) > 0) 
                            @foreach($results as $result)
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="profile__side2">
                                            <div class="profile-box2">

                                                <div class="profile-img square">
                                                    @if( isset( $result->profile_image ) )
                                                    <img src="{{route('frontend.member.profile',$result->id)}}" alt="{{$result->first_name}} {{$result->last_name}}">
                                                    @else
                                                    <img src="https://via.placeholder.com/330x330" alt="{{$result->first_name}} {{$result->last_name}}">
                                                    @endif
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="profile-cont">
                                            <div class="profile-details">
                                                <ul>
                                                    <li class="profile-details--email">
                                                        <strong><i class="fa fa-users"></i> Full Name:</strong>
                                                        <span>{{$result->first_name}} {{$result->last_name}}</span></li>
                                                    <li>
                                                    <li class="profile-details--email">
                                                        <strong><i class="fa fa-envelope"></i> Email:</strong>
                                                        <span>{{$result->email}}</span></li>
                                                    <li>
                                                        <strong><i class="fa fa-phone"></i> Phone:</strong>
                                                        <span>{{$result->phone}}</span>
                                                    </li>
                                                    <li>
                                                        <strong><i class="fa fa-calendar-alt"></i> DOB:</strong>
                                                        <span>{{date('d/m/Y',strtotime($result->dob))}}</span>
                                                    </li>
                                                    <li>
                                                        <strong><i class="fa fa-map-marker-alt"></i> Address:</strong>
                                                        <span>{{$result->address}}</span></li>
                                                    <li>
                                                        <strong><i class="fa fa-map-marker-alt"></i> City:</strong>
                                                        <span>{{$result->city}}</span>
                                                    </li>
                                                    <li>
                                                        <strong><i class="fa fa-map-marker-alt"></i> Country:</strong>
                                                        <span>{{$result->country}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            
                                            <a class="profile-edit-button profile-edit-button--cont"
                                                href="{{route('frontend.member.profile.details',$result->alias)}}"><i class="fa fa-eye"></i> Profile</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        <div class="row">
                            <div class="col-lg-12">
                                <p>No Data found!</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
           
            </div>
        </div>
    </div>
@endsection