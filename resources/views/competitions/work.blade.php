<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Работа</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('styles')
</head>
<body>
@include('header_footer/header')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="work__name">
                {{$work->ic}} {{$work->fc}}
            </div>
            <div class="work__teacher">
                Куратор: {{$work->user->f}} {{$work->user->i}} {{$work->user->o}}
            </div>
            <div class="work__location">
                {{$work->user->stuff}}, г.{{$work->user->town}}
            </div>
        </div>
        <div class="col-md-7">

        </div>
    </div>
</div>
@include('script')
</body>
</html>
