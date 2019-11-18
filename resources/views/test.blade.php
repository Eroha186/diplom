<!doctype html>
<html lang="ru">
<head>
    <title>Главная страница</title>
    @include('styles')
</head>
<body>
@include('header_footer.header')
<a href="{{route('auth.social', 'vkontakte')}}" title="Зайти через ВКонтакте">Зайти через ВКонтакте</a>
@include('script')
</body>
</html>
