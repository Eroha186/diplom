<!doctype html>
<html lang="ru">
<head>
  <title>Потверждение email</title>
  @include('styles')
</head>
<body>
<h2>Добро пожаловать, {{$user['i']}}</h2>
<br/>
Your registered email-id is {{$user['email']}} , Please click on the below link to verify your email account
<br/>
<a href="{{url('/verify/'.$user['verifyUser']['token'])}}">Verify Email</a>
</body>

</html>