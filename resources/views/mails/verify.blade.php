<!doctype html>
<html lang="ru">
<head>
  <title>Потверждение email</title>
  @include('styles')
</head>
<body>
<h2>Добро пожаловать, {{ $user->i }}</h2>
<br/>
Вы зарегестрировали ваш e-mail {{ $user->email }} , перейдите по ссылки ниже чтоб активировать аккаунт.
<br/>
Ваш логин: {{ $user->email }}
<br/>
@if(!is_null($password))
  Ваш пароль: {{ $password }}
@endif
<a href="{{ url('/verify/' . $user->verifyUser->token) }}">Подтвердить Email</a>
</body>

</html>