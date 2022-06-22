<!DOCTYPE html>
<html>
<head>
<title>Member Ads Publised Notification</title>
</head>
<body>
<p>Hello {{$product->member->first_name ?? ''}} {{$product->member->last_name ?? ''}}, <br> {{$product->name}} is published in your website.<br> Thank you.</p>

</body>
</html>