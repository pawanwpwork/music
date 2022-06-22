<div class="profile-box">
    <div class="profile-img square">
        <div class="profile-img-upload">
            <button class="profile-img-upload--btn" data-toggle="modal" data-target="#modalUploadImage"><i class="fa fa-camera"></i><span>Profile Image</span></button>
        </div>
         @if(isset($member->profile_image))
       <img src="{{route('frontend.member.profile',$memeberId)}}" alt="{{$member->first_name}} {{$member->last_name}}">
        @else
        <img src="https://via.placeholder.com/330x330" alt="{{$member->first_name}} {{$member->last_name}}">
        @endif
        
    </div>
    <div class="profile-cont">
        <div class="profile-details">
            <ul>
                @if(isset($member->email))
                <li class="profile-details--email">
                    <strong><i class="fa fa-envelope"></i> Email:</strong>
                    <span>{{$member->email}}</span>
                </li>
                @endif

                @if(isset($member->phone))
                <li>
                    <strong><i class="fa fa-phone"></i> Phone:</strong>
                    <span>{{$member->phone}}</span>
                </li>
                @endif

                @if(isset($member->dob))
                <li>
                    <strong><i class="fa fa-calendar-alt"></i> DOB:</strong>
                    <span>{{$member->dob}}</span>
                </li>
                @endif

                @if(isset($member->address))
                <li>
                    <strong><i class="fa fa-map-marker-alt"></i> Address:</strong>
                    <span>{{$member->address}}</span>
                </li>
                @endif

                @if(isset($member->city))
                <li>
                    <strong><i class="fa fa-map-marker-alt"></i> City:</strong>
                    <span>{{$member->city}}</span>
                </li>
                @endif

                @if(isset($member->country))
                <li>
                    <strong><i class="fa fa-map-marker-alt"></i> Country:</strong>
                    <span>{{$member->country}}</span>
                </li>
                @endif

            </ul>
        </div>

        @if(isset($member->getMembershipType))
            <h4><strong>Status : {{$member->getMembershipType->name}}</strong></h4>
        @endif

        @if(isset($member->memberGenere))
            <h4><strong>Music Genere : {{$member->memberGenere->name}}</strong></h4>
        @endif

        @if(isset($member->musicCategory) && count($member->musicCategory) > 0)
            <h4><strong>Music Categories : @foreach($member->musicCategory as $memCat) {{$memCat->name}}, @endforeach</strong></h4>
        @endif

        <div class="profile-social">

            @if(isset($member->facebook_url))
            <span><a href="{{$member->facebook_url}}"><i class="fab fa-facebook"></i></a></span>
            @endif
            @if(isset($member->instagram_url))
            <span><a href="{{$member->instagram_url}}"><i class="fab fa-instagram"></i></a></span>
            @endif
            @if(isset($member->twitter_url))
            <span><a href="{{$member->twitter_url}}"><i class="fab fa-twitter"></i></a></span>
            @endif
            @if(isset($member->youtube_url))
            <span><a href="{{$member->youtube_url}}"><i class="fab fa-youtube"></i></a></span>
            @endif

        </div>
        @if(request()->route()->getName() == 'frontend.member.dashboard')
        <a class="profile-edit-button profile-edit-button--cont"
            href="{{route('frontend.member.edit',$member->alias)}}"><i class="fa fa-edit"></i> Edit</a>
        
        @else
        <a class="profile-edit-button profile-edit-button--cont"
            href="{{route('frontend.member.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
        @endif    
    </div>
</div>