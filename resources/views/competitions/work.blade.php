<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$work->title}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('styles')
</head>
<body>
@include('header_footer/header')
<section class="work-page">
    <div class="container">

 {!!Breadcrumbs::render('competition', $work)!!}
        <h1 class="section-title text-center">{{$work->title}}</h1>
    <div class="row">
        <div class="col-md-9 col-xl-9 col-lg-9 pr-0">
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
         <div class="col-md-3 col-xl-3 col-lg-3 pl-0">
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
    <div class="row">
        <div class="col-xl-12">
            <div class="share-work">
                <p>Понравилась работа? Поделитесь с друзьями!</p>
                <ul class="share-works">
                    <li class="social-item" id="social-vk" title="Вконтакте"><a href=""><i class="fab fa-vk"></i></a></li>
                    <li class="social-item" id="social-fb" title="Фейсбук"><a href=""><i class="fab fa-facebook-f"></i></a></li>
                    <li class="social-item" id="social-tw" title="Твиттер"><a href=""><i class="fab fa-twitter"></i></a></li>
                    <li class="social-item" id="social-ok" title="Одноклассники"><a href=""><i class="fab fa-odnoklassniki"></i></a></li>
                    <li class="social-item" id="social-tg" title="Телеграм"><a href=""><i class="fab fa-telegram-plane"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 prev-and-next">

            <div class="prev-work"><a href=""><img src="{{asset('images/prev.svg')}}" alt=""> <span>Предыдущая работа</span></a></div>
            <div class="next-work"><a href=""><span>Следующая работа</span><img src="{{asset('images/next.svg')}}" alt=""></a></div>
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
   @include('header_footer/newsletter')
                @include('header_footer/footer')
@include('script')
</body>
</html>
