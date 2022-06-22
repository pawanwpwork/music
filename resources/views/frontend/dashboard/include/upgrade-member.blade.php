@php 
    $upgradeOptions   = upgradeMemberOptions(); 
    $currentRouteName = \Request::route()->getName();
@endphp
@if( isset( $upgradeOptions ) && $currentRouteName !== 'frontend.member.profile.details')
<div class="profile-upgrade">
    <button id="profileUpgradeButton"><i class="fa fa-edit"></i> Upgrade <i class="fa fa-caret-down"></i></button>
    <ul class="profile-upgrade-list">
		@foreach( $upgradeOptions as $uoption )
    		<li>
    			<a href="{{route('member.upgrade',$uoption->alias)}}">
    				Upgrade to 
    				@if( $uoption->id == 2 ) Musician @endif
    				@if( $uoption->id == 3 ) Bandleader @endif
    				@if( $uoption->id == 4 ) Promoter @endif
    			</a>
    		</li>
    	@endforeach
    </ul>
</div>
@endif
