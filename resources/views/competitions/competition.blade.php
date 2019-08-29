<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Конкурс</title>
    @include('styles')
</head>
<body>
@include('header_footer/header')
<section class="competitions__main bg-arch">
    <div class="container">
        <h2 class="section-title">
            Новогодний конкрус
        </h2>
        <div class="row">
            <div class="col-xl-6 competitions__descr">
                В настоящем разделе представлены актуальные конкурсы, на которые осуществляется прием заявок на участие.
                Участвуйте вместе с детьми и в конкурсах для педагогов на участие. Участвуйте вмместе с детьми и в
                конкурсах для педагогов!
            </div>
            <div class="cake">
                <img src="{{asset('/images/cake.png')}}" alt="Пироженое">
            </div>
        </div>
    </div>
</section>
<section class="filters">
    <div class="container">
        {!!Breadcrumbs::render('competitions')!!}
        <h4 style="margin-bottom: 35px;">Всего подано заявок: 534</h4>
        <div class="row">
            <div class="col-xl-4">
                <a href="{{route('form-competition').'?id='.$id}}" class="participate-competition">Участвовать в
                    конкурсе</a>
            </div>
        </div>
        <div class="filter-nominations">
            <div class="all-nоminations nomination">
                <span class="filter-nomination">Все номинации</span>
            </div>
            <div class="teacher-nomination nomination">
                <span class="filter-nomination">Педагоги</span>
            </div>
            <div class="preschoole-nomination nomination">
                <span class="filter-nomination">Дошкольное образование</span>
            </div>
            <div class="1-4-class-nomination nomination">
                <span class="filter-nomination">1-4 класс</span>
            </div>
            <div class="5-8-class-nomination nomination">
                <span class="filter-nomination">5-8 класс</span>
            </div>
            <div class="9-11-class-nomination nomination">
                <span class="filter-nomination">9-11 класс</span>
            </div>
        </div>
        <form action="{{route('search')}}" method="GET" class="search-competition">
            <div class="row">
                <div class="col-xl-11">
                    <div class="search-wrap">
                        <button type="submit" id="search"><img src="{{asset('images/magnifier.svg')}}" alt="лупа">
                        </button>
                        <input name="searchQuery" class="search-competitions" type="text"
                               placeholder="Поиск по участникам" value="{{session('searchQuery')}}">
                    </div>
                </div>
            </div>
        </form>
        <h4 style="margin-bottom: 15px;">Работы участников</h4>
        <div class="filter">
            Сортировать по:
            <div class="placement-date">
                <span class="filter-name" data-condition="1">дате размещения </span>
                <span class="arrow-down">&darr;</span>
                <span class="arrow-up">&uarr;</span>
            </div>
            <div class="filters-name">
                <span class="filter-name" data-condition="1">имени </span>
                <span class="arrow-down">&darr;</span>
                <span class="arrow-up">&uarr;</span>
            </div>
        </div>
    </div>
</section>
<section class="works-list">
    <div class="container">
        <div class="works-wrap">
            @foreach($works as $work)
                <div class="work">
                    <div class="work__img">
                        @if($work->file->type == 'img')
                            <img src="{{$work->file->url}}" alt="картника">
                        @endif
                        @if($work->file->type == 'doc')
                            <img src="{{asset("/images/doc.svg")}}" alt="иконка документа">
                        @endif
                        @if($work->file->type == 'ppt')
                            <img src="{{asset("/images/ppt.svg")}}" alt="иконка презинтации">
                        @endif
                    </div>
                    <div class="work__title">
                        {{$work->title}}
                    </div>
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
            @endforeach
        </div>
    </div>
</section>
@include('script')
</body>
</html>
