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
            <div class="work__img">
                @if($work->file->type == 'image')
                    <img src="{{Storage::url($work->file->url)}}" alt="картника">
                @endif
                @if($work->file->type == 'doc')
                    <img src="{{asset("/images/doc.svg")}}" alt="иконка документа">
                @endif
                @if($work->file->type == 'ppt')
                    <img src="{{asset("/images/ppt.svg")}}" alt="иконка презинтации">
                @endif
            </div>
        </div>
    </div>
    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->admin == 1 && $publication->moderation == 0)
        <div class="container">
            <div style="margin-top: 25px;" class="confirmation row">
                <div class="col-md-4">
                    <a href="{{route('a-confirmation', ['id' => $publication->id, 'result' => '1', 'publication'])}}"
                       class="btn green filled-btn">Подтвердить</a>
                </div>
                <div class="col-md-4">
                    <a href="{{route('a-confirmation', ['id' => $publication->id, 'result' => '0', 'publication'])}}"
                       class="btn orange filled-btn">Отклонить</a>
                </div>
            </div>
        </div>
    @endif
</div>
@include('script')
</body>
</html>
