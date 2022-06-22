<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
</head>
<body>
<p> Plesae click <a href="{{route( 'frontend.member.reset.password.form',encrypt($member->email) )}}" style="font-size: 15px;">here</a> to reset your password.
<!-- <p>This url is valid for 24 hours only</p> -->
</body>
</html>