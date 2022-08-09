<!DOCTYPE html>
<html>
<head>
	<title>Band/Dj Booking Cancel</title>
</head>
<body>
<p>
	@php $member = \App\Models\Member::find( $bandDjBook->booked_by ); @endphp
	Hi {{$member->first_name}} {{$member->last_name}} ,<br>
	Your {{ $bandDjBook->type_of_music}} Band/Dj Booking has been cancelled.<br>
	
	Regards, <br>
	allmusicallartist
</p>
</body>
</html>