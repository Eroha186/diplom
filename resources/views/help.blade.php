<!doctype html>
<html lang="ru">
<head>
    <title>Конкурсы</title>
    @include('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    @include('header_footer/header')


    @include('header_footer/newsletter')
@include('header_footer/footer')
@include('script')
</body>
</html>