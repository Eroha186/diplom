<!doctype html>
<html lang="ru">
<head>
    <title>Конкурсы</title>
    @include('styles')
</head>
<body>
@include('header_footer/header')

<section class="publications__main bg-arch">
    <div class="container">
        <h2 class="section-title">
            Текущие конкурсы
        </h2>
        <div class="row">
            <div class="col-xl-6 competitions__descr">
                В настоящем разделе представлены актуальные конкурсы, на которые осуществляется прием заявок на участие.
                Участвуйте вместе с детьми и в конкурсах для педагогов на участие. Участвуйте вмместе с детьми и в
                конкурсах для
                педагогов!
            </div>
            <div class="cake">
                <img src="{{asset('/images/cake.png')}}" alt="Пироженое">
            </div>
        </div>
    </div>
</section>

<section class="publications-filtres filtres">
    <div class="container">
        {!!Breadcrumbs::render('publications')!!}
        <div class="row">
            <div class="col-xl-3">
                <a href="{{route('form-publication')}}" class="publish-publication">Опубликовать работу</a>
            </div>
        </div>
        <h2 class="section-title">Творческие и учебные материалы</h2>
        <div class="row select-filter">
            <div class="col-xl-3">
                <select name="education" id="education">
                    <option value="0">Все уровни образования</option>
                    @foreach($educations as $education)
                        <option value="{{$education->id}}">{{$education->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xl-3">
                <select name="kind" id="kind">
                    <option value="0">Все виды</option>
                    @foreach($kinds as $kind)
                        <option value="{{$kind->id}}">{{$kind->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xl-3">
                <select name="theme" id="theme">
                    <option value="0">Все темы</option>
                    @foreach($themes as $theme)
                        <option value="{{$theme->id}}">{{$theme->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xl-2">
                <select name="type" id="type">
                    <option value="0">Все типы</option>
                    @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-11">
                <div class="search-wrap">
                    <input class="search-competitions" type="text" placeholder="Поиск по конкурсам">
                </div>
            </div>
        </div>
        <div class="filter">
            Сортировать по:
            <div class="placement-date">
                <span class="filter-name" data-condition="1">по дате размещения </span> <span
                        class="arrow-down">&darr;</span>
                <span class="arrow-up">&uarr;</span>
            </div>
            <div class="fiteres-name">
                <span class="filter-name" data-condition="1">имени </span> <span class="arrow-down">&darr;</span> <span
                        class="arrow-up">&uarr;</span>
            </div>
        </div>
    </div>
</section>

<section class="publications-list">
    <div class="container">
        @foreach($publications as $publication)
            <div class="row p15">
                <div class="col-xl-12 publication-card">
                    <div class="row">
                        <div class="col-xl-10">
                            <div class="publication-card__title">
                                <a href="/publication/{{$publication->id}}">{{$publication->title}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="publish-card__date">Опублековано {{$publication->date_add}}</div>
                    <div class="row">
                        <div class="col-xl-10">
                            <div class="publication-card__author">Автор
                                {{$publication->author->f}} {{$publication->author->i}}. {{$publication->author->i}}.,
                                {{$publication->author->stuff}},
                                {{$publication->author->town}},
                                {{$publication->author->job}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-10">
                            <div class="publication-card__descr">
                                {{$publication->annotation}}
                            </div>
                        </div>
                    </div>
                    <div class="publication-card__img">
                        @if(isset($publication['doc']))
                            <div class="img file">
                                <img src="{{asset("/images/doc.svg")}}" alt="">
                            </div>
                        @endif
                        @if(isset($publication['ppt']))
                            <div class="img file">
                                <img src="{{asset("/images/ppt.svg")}}" alt="">
                            </div>
                        @endif
                    </div>
                    <div class="publication-card__tags">
                        @foreach($publication->theme as $theme)
                            <div class="tag">{{$theme->name}}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

@include('script')

</body>
</html>


