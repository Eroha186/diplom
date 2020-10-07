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
<section class="work-page">
    <div class="container">

 {!!Breadcrumbs::render('competitions', $work)!!}
        <h1 class="section-title text-center">{{$work->title}}</h1>
    <div class="row">
        <div class="col-md-9 pr-0">
            <div class="work__img">
                @if($work->file->type == 'image')
                    <img src="{{Storage::url($work->file->url)}}" alt="картника">
                @endif
                @if($work->file->type == 'doc')
                    <img src="{{asset('/images/doc.svg')}}" alt="иконка документа">
                @endif
                @if($work->file->type == 'ppt')
                    <img src="{{asset('/images/ppt.svg')}}" alt="иконка презинтации">
                @endif
            </div>
        </div>
         <div class="col-md-3 pl-0">
            <div class="work-content__info">
                <div class="work__name">
                    <span>Участник:</span><br>
                {{$work->ic}} {{$work->fc}}
            </div>
            <div class="work__teacher">
                <span>Куратор:</span><br>
               {{$work->user->f}} {{$work->user->i}} {{$work->user->o}}
               {{$work->user->stuff}}, г.{{$work->user->town}}
            </div>
           
            <div class="work__anotation">
                <span>Описание:</span><br>
                 {{$work->annotation}}
            </div>
             <div class="caral">
                    <img src="{{asset('images/caral.svg')}}" alt="">
                </div>
                <div class="competition-title">
                    {{$work->competition->title}}
                </div>
                <div class="date">
                    Прием работ до  {{$work->competition->date_end}}
                </div>
                <div class="add-work">
                    <span>Хотите тоже участвовать?</span>
                    <a href="/form-competition?id={{$work->competition->id}}" class="add-work-btn"><img src="{{asset('images/upload.svg')}}" alt="">Добавить работу</a>
                </div>
            </div>
        </div>
    </div>
    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->admin == 1 && $work->moderation == 0)
        <div class="container">
            <div style="margin-top: 25px;" class="confirmation row">
                <div class="col-md-4">
                    <a href="{{route('a-confirmation-comp', ['id' => $work->id, 'competitionId' => $competitionId])}}"
                       class="btn green filled-btn">Подтвердить</a>
                </div>
                <div class="col-md-4">
                    <a href="{{route('a-reject-comp', ['id' => $work->id, 'competitionId' => $competitionId])}}"
                       class="btn orange filled-btn">Отклонить</a>
                </div>
            </div>
        </div>
    @endif
</div>
</section>
@include('script')
</body>
</html>
