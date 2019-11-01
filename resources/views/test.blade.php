<!doctype html>
<html lang="ru">
<head>
    <title>Главная страница</title>
    @include('styles')
</head>
<body>
@include('header_footer.header')
<a href="https://oauth.vk.com/authorize?client_id=7191953&ridirect_uri=localhost" title="Зайти через ВКонтакте">Зайти через ВКонтакте</a>
@include('script')
</body>
</html>
