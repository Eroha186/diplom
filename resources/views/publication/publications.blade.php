<!doctype html>
<html lang="ru">
<head>
    <title>Публикации</title>
    @include('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

<section class="publications-filters filters">
    <div class="container">
        {!!Breadcrumbs::render('publications')!!}
        <div class="row">
            <div class="col-xl-3">
                <a href="{{route('form-publication')}}" class="publish-publication">Опубликовать работу</a>
            </div>
        </div>
        <h2 class="section-title">Творческие и учебные материалы</h2>
        <form action="{{route('search')}}" method="GET">
            <div class="row select-filters">
                <div class="col-xl-3">
                    <select name="education" id="education" class="select-filter">
                        <option value="all">Все уровни образования</option>
                        @foreach($educations as $education)
                            <option value="{{$education->id}}"
                                @if(isset($settingFilter['education']) && $education->id == $settingFilter['education'])
                                    selected="selected"
                                @endif
                            >{{$education->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-3">
                    <select name="kind" id="kind" class="select-filter">
                        @if(isset($settingFilter['kind']))
                                @foreach($kinds as $kind)
                                    <option value="{{$kind->id}}"
                                            @if($kind->id == $settingFilter['kind'])
                                            selected="selected"
                                            @endif
                                    >{{$kind->name}}</option>
                                @endforeach
                        @else
                            <option>Выберите уровень образования</option>
                        @endif
                    </select>
                </div>
                <div class="col-xl-3">
                    <select name="theme" id="theme" class="select-filter">
                        <option value="0">Все темы</option>
                        @foreach($themes as $theme)
                            <option value="{{$theme->id}}"
                                @if(isset($settingFilter['theme']) && $theme->id == $settingFilter['theme'])
                                    selected="selected"
                                @endif
                            >{{$theme->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-2">
                    <select name="type" id="type" class="select-filter">
                        <option value="0">Все типы</option>
                        @foreach($types as $type)
                            <option value="{{$type->id}}"
                                @if(isset($settingFilter['type']) && $type->id == $settingFilter['type'])
                                    selected="selected"
                                @endif
                            >{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-11">
                    <div class="search-wrap">
                        <button type="submit" id="search"><img src="{{asset('images/magnifier.svg')}}" alt="лупа">
                        </button>
                        <input name="searchQuery" class="search-competitions" type="text"
                               placeholder="Поиск по публикациям" value="{{session('searchQueryP')}}">
                    </div>
                </div>
            </div>
        </form>
        <div class="filter">
            Сортировать по:
            <div class="placement-date">
                <span class="filter-name filter-name-publications {{(isset($filtersInfo['column-p']) && $filtersInfo['column-p'] == 'date_add') ? "filter-name_active" : "" }}"
                      data-condition="{{(isset($filtersInfo['column-p']) && $filtersInfo['column-p'] == 'date_add') ? $filtersInfo['filter-p'] : '1'}}"
                      data-column="date_add">дате размещения </span>
                <span class="arrow-down">&darr;</span>
                <span class="arrow-up">&uarr;</span>
            </div>
            <div class="filters-name">
                <span class="filter-name filter-name-publications {{(isset($filtersInfo['column-p']) && $filtersInfo['column-p'] == 'title') ? "filter-name_active" : "" }}"
                      data-condition="{{(isset($filtersInfo['column-p']) && $filtersInfo['column-p'] == 'title') ? $filtersInfo['filter-p'] : '1'}}"
                      data-column="title">имени </span>
                <span class="arrow-down">&darr;</span>
                <span class="arrow-up">&uarr;</span>
            </div>
        </div>
    </div>
</section>

<section class="publications-list">
    <div class="container">
        @if(isset($publications->error))
            {{$publications->error}}
        @else
            @include('publication/publication-snippet')
        @endif
    </div>
</section>

@include('script')

</body>
</html>


