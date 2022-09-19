<!DOCTYPE html>
<html>

<head>
    <title>Laravel 9 Send Email Example - XpertPhp</title>
</head>

<body>
    <div>
        Hello {{ $name }},<p></p>
        <p>Your default password is : {{ $password }}</p>
        Please click <a href="{{ url('/') }}">HERE</a> to login
        <p>&nbsp;</p>
        <p>Thank you</p>
    </div>
</body>

</html>