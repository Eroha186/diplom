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
<a href="{{route('a-publication')}}">Публикации</a>
<a href="">Конкурсы</a>
<a href="">Экспресс-конкурсы</a>

@include('script')
</body>
</html>