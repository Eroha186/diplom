<!doctype html>
<html lang="ru">
<head>
  <title>Потверждение email</title>
  @include('styles')
</head>
<body>
<h2>Добро пожаловать, {{$user->user->i}}</h2>
<br/>
Вы зарегестрировали ваш e-mail {{$user->user->email}} , перейдите по ссылки ниже чтоб активировать аккаунт.
<br/>
Ваш логин: {{$user->user->email}}
<br/>
{{isset($user->password) ? "Ваша пароль: " . $user->password . '<br/>' : ''}}
<a href="{{url('/verify/'.$user->user->verifyUser->token)}}">Verify Email</a>
</body>

</html>