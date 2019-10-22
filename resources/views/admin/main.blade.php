<!doctype html>
<html lang="ru">
<head>
    <title>Панель администратора</title>
    @include('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="wrap-admin">
    <nav class="admin-nav">
        <div class="admin-profile">
            <img src="{{asset('images/avatar.svg')}}" alt="Аватор">
            <div class="page-name">
                <span>{{$user->f}}</span>
                <span>{{$user->i}}</span>
            </div>
        </div>
        <a href="{{route('home')}}">Вернуться на сайт</a>
        <a class="{{request()->is('admin/publication') ? "active" : ""}}"
           href="{{route('a-publication')}}">Публикации</a>
        <a class="{{request()->is(route('a-competitions')) ? "active" : ""}}"
           href="{{route('a-competitions')}}">Конкурсы</a>
        <a class="{{request()->is('admin/express-competition') ? "active" : ""}}"
           href="{{route('a-express-competition')}}">Экспресс-конкурсы</a>
        <a class="{{request()->is(route('a-create-diplom'))}}" 
            href="{{route('a-create-diplom')}}">Создание дипломов</a>   
    </nav>

    <main style="width: 100%;">
        @yield('content')
    </main>
</div>

@include('script')
</body>
</html>