<!DOCTYPE html>
<html>
<head>
	<title>Email Verify Links</title>
</head>
<body>
<p>
	Hi there,<br>
	Please click the button below to verify your email address.<br>
	<a href="{{route( 'frontend.member.email.verify.status',encrypt($member->email) )}}" class="btn btn-primary">Verify Email Address</a> <br>
	If you did not create an account, no further action is required. <br>
	Regards, <br>
	allmusicallartist
</p>
</body>
</html>