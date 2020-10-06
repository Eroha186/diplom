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
            <div class="col-xl-12 competitions__descr">
                В настоящем разделе представлены актуальные конкурсы, на которые осуществляется прием заявок на участие.
                Участвуйте вместе с детьми и в конкурсах для педагогов на участие. Участвуйте вмместе с детьми и в
                конкурсах для педагогов!
            </div>
            <div class="cake">
                <img src="{{asset('/images/pallete.svg')}}" alt="Пироженое">
            </div>
        </div>
    </div>
</section>
<section class="filters">
    <div class="container">
        {!!Breadcrumbs::render('competitions')!!}
        <h2 class="section-title text-center">Творческие <span>конкурсы</span></h2>
        <form class="d-none" action="{{route('search-с')}}" method="GET">
            <div class="row">
                <div class="col-xl-11">
                    <div class="search-wrap">
                        <button type="submit" id="search"><img src="{{asset('images/magnifier.svg')}}" alt="лупа">
                        </button>
                        <input name="searchQuery" class="search-competitions" type="text"
                               placeholder="Поиск по конкурсам" value="{{session('searchQueryC')}}">
                    </div>
                </div>
            </div>
        </form>
        <div class="filter d-none">
            Сортировать по:
            <div class="placement-date">
               <span class="filter-name filter-name-competitions   {{(isset($filterInfo['column-c']) && $filterInfo['column-c'] == 'date_begin') ? "filter-name_active" : "" }} "
                     data-condition="{{(isset($filterInfo['column-c']) && $filterInfo['column-c'] == 'date_begin') ? $filterInfo['filter-c'] : '1'}}"
                     data-column="date_begin">дате размещения </span>
                <span class="arrow-down">&darr;</span>
                <span class="arrow-up">&uarr;</span>
            </div>
            <div class="duration-event">
                <span class="filter-name filter-name-competitions {{(isset($filterInfo['column-c']) && $filterInfo['column-c'] == 'difference-date') ? "filter-name_active" : "" }}"
                      data-condition="{{(isset($filterInfo['column-c']) && $filterInfo['column-c'] == 'difference-date') ? $filterInfo['filter-c'] : '1'}}"
                      data-column="difference-date">длительность проведения </span>
                <span class="arrow-down">&darr;</span>
                <span class="arrow-up">&uarr;</span>
            </div>
            <div class="date-end">
                <span class="filter-name filter-name-competitions {{(isset($filterInfo['column-c']) && $filterInfo['column-c'] == 'date_end') ? "filter-name_active" : "" }}"
                      data-condition="{{(isset($filterInfo['column-c']) && $filterInfo['column-c'] == 'date_end')  ? $filterInfo['filter-c'] : '1'}}"
                      data-column="date_end">дате завершения </span>
                <span class="arrow-down">&darr;</span>
                <span class="arrow-up">&uarr;</span>
            </div>
        </div>
    </div>
</section>
<section class="competitions-list">
    <div class="container">
        <div class="competition-wrap">
          <div class="row">
            <div class="col-6 main-page__news_conc-item">
                <img src="//localhost:3006/images/main_page/CAT.png" alt="Cat">
                <div class="main-page__news_conc-item-desc">
                    <img src="//localhost:3006/images/main_page/services-icon-1.png" class="white-figure" alt="">
                    <p class="text-center"><a href="">Не думай о секундах с высока, наступит время Не думай о секундах с</a></p>
                    <p style="font-size: 14px;">конкурс рисунков</p>
                    <div class="news_conc-item-down" style="width: 50%;">
                        <p class="date-publ">С 01.03.2020 - 01.04.2020</p>
                        <button>ПРИНЯТЬ УЧАСТИЕ</button>
                    </div>
                </div>
            </div>
            <div class="col-6 main-page__news_conc-item">
                <img src="//localhost:3006/images/main_page/CAT.png" alt="Cat">
                <div class="main-page__news_conc-item-desc">
                    <img src="//localhost:3006/images/main_page/services-icon-1.png" class="white-figure" alt="">
                    <p class="text-center"><a href="">Не думай о секундах с высока, наступит время Не думай о секундах с</a></p>
                    <p style="font-size: 14px;">конкурс рисунков</p>
                    <div class="news_conc-item-down" style="width: 50%;">
                        <p class="date-publ">С 01.03.2020 - 01.04.2020</p>
                        <button>ПРИНЯТЬ УЧАСТИЕ</button>
                    </div>
                </div>
            </div> 
            <div class="col-6 main-page__news_conc-item">
                <img src="//localhost:3006/images/main_page/CAT.png" alt="Cat">
                <div class="main-page__news_conc-item-desc">
                    <img src="//localhost:3006/images/main_page/services-icon-1.png" class="white-figure" alt="">
                    <p class="text-center"><a href="">Не думай о секундах с высока, наступит время Не думай о секундах с</a></p>
                    <p style="font-size: 14px;">конкурс рисунков</p>
                    <div class="news_conc-item-down" style="width: 50%;">
                        <p class="date-publ">С 01.03.2020 - 01.04.2020</p>
                        <button>ПРИНЯТЬ УЧАСТИЕ</button>
                    </div>
                </div>
            </div> 
            <div class="col-6 main-page__news_conc-item">
                <img src="//localhost:3006/images/main_page/CAT.png" alt="Cat">
                <div class="main-page__news_conc-item-desc">
                    <img src="//localhost:3006/images/main_page/services-icon-1.png" class="white-figure" alt="">
                    <p class="text-center"><a href="">Не думай о секундах с высока, наступит время Не думай о секундах с</a></p>
                    <p style="font-size: 14px;">конкурс рисунков</p>
                    <div class="news_conc-item-down" style="width: 50%;">
                        <p class="date-publ">С 01.03.2020 - 01.04.2020</p>
                        <button>ПРИНЯТЬ УЧАСТИЕ</button>
                    </div>
                </div>
            </div> 
        </div>
            <div class="pagination">
                {{$competitions->links('paginate')}}
            </div>
        </div>
    </div>
</section>
  @include('header_footer/newsletter')
  @include('header_footer/footer')
@include('script')
</body>
</html>

