<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Панель администратора</title>
    @include('styles')
</head>
<body>
<nav class="admin-nav">
    <div class="admin-profile">
        <img src="{{asset('images/avatar.svg')}}" alt="Аватор">
        <div class="page-name">
            <span>{{$user->f}}</span>
            <span>{{$user->i}}</span>
        </div>
    </div>
    <a href="{{route('home')}}">Вернуться на сайт</a>
    <a class="{{request()->is('admin/publication') ? "active" : ""}}" href="{{route('a-publication')}}">Публикации</a>
    <a href="">Конкурсы</a>
    <a href="">Экспресс-конкурсы</a>
</nav>

@include('script')
</body>
</html>