<!doctype html>
<html lang="ru">
<head>
    <title>Конкурсы</title>
    @include('styles')
     <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@include('header_footer/header')
<section class="competitions__main bg-arch">
    <div class="container">
        <h2 class="section-title">
            Текущие конкурсы
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
        <h2 class="section-title text-center">Перечень актуальных <span>конкурсов</span></h2>
        <form action="{{route('express-competitions-search')}}" method="GET">
            <div class="row">
                <div class="col-xl-11">
                    <div class="search-wrap">
                        <button type="submit" id="search"><img src="{{asset('images/magnifier.svg')}}" alt="лупа">
                        </button>
                        <input name="searchQuery" class="search-competitions" type="text"
                               placeholder="Поиск по конкурсам" value="{{session('searchQuery')}}">
                    </div>
                </div>
            </div>
        </form>
        <div class="filter">
            Сортировать по:
            <div class="duration-event">
                <span class="filter-name filter-name-express {{(isset($filterInfo['column-express']) && $filterInfo['column-express'] == 'title') ? "filter-name_active" : "" }}"
                      data-condition="{{(isset($filterInfo['column-express']) && $filterInfo['column-express'] == 'title') ? $filterInfo['filter-express'] : '1'}}"
                      data-column="title">имени</span>
                <span class="arrow-down">&darr;</span>
                <span class="arrow-up">&uarr;</span>
            </div>
        </div>
    </div>
</section>
<section class="competitions-list">
    <div class="container">
        <div class="competition-wrap">
           @if(count($competitions))
                @foreach ($competitions as $competition)
                    <div class="competition">
                        <div class="competition__img">
                            <img src="{{asset('images/skier.png')}}" alt="">
                        </div>
                        <div class="competition__descr ta-center">
                            <div class="title">
                                {{$competition->title}}
                            </div>
                            <div class="name">
                                {{$competition->type->name}}
                            </div>
                            <a href="/express-competition-form?id={{$competition->id}}" class="button transparent-btn">участвовать</a>
                        </div>
                    </div>
                @endforeach
           @endif
        </div>
    </div>
</section>
 @include('header_footer/newsletter')
  @include('header_footer/footer')
@include('script')
</body>
</html>
