<!doctype html>
<html lang="ru">
<head>
    <title>Главная страница</title>
    @include('styles')
</head>
<body>
@include('header_footer.header')
<section class="main-page__main">
    <div class="container">
        <div class="row">
            <div class="_diploms-img col-xl-4 col-lg-4 d-none d-lg-block">
                <img src="{{asset('images/main_page/diplom2.png')}}" alt="diplom" class="_diplom-1 img-fluid">
            </div>
            <div class="main-descr col-xl-8 col-lg-8">
                <ul class="main-descr__items">
                    <li class="main-descr__item">
                        <span class="main-descr__item-2"> Учебные материалы для детского сада и школы</span><br>
                        <p class="main-descr__item-1">Мастер-классы, конспекты занятий, сценарии, прогулки и т.д.</p>
                    </li>
                    <li class="main-descr__item">
                        <span class="main-descr__item-2">Конкурсы для педагогов и детей</span><br>
                        <p class="main-descr__item-1">Рисунки, поделки, стихи и многое другое. Более 120 номинаций на любую тему</p>
                    </li>
                    <li class="main-descr__item">
                        <span class="main-descr__item-2">Материалы для школы и детского сада</span><br>
                        <p class="main-descr__item-1">Подойдут для пополнения портфолио для аттестации</p>
                    </li>
                    <li class="main-descr__item">
                        <span class="main-descr__item-2">Дипломы и сертификаты от 2х дней</span><br>
                        <p class="main-descr__item-1">Свидетельство о регистрации СМИ ЭЛ № ФС 77 – 59675 от 11.11.2011</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="main-page__descr">
    <div class="container">
        <h2 class="head-text text-center" style="margin-top: 85px; margin-bottom: 85px;">"Современный <span>педагог"</span> - творческая лаборатория</h2>
        <div class="row" style="margin-bottom: 60px;">
            <div class="col-12 col-md-6 col-lg-3 col-xl-3 col-sm-6">
                <div class="main-page__items_item">
                    <img src="{{asset('images/main_page/item-icon1.png')}}" style="margin-left: auto; margin-right: auto; display: block;" alt="">
                    <h2>Техподдержка 24/7</h2>
                    <p>Мы стараемся давать быстрые <br>  ответы на любые <br> возникающие вопросы</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3">
                <div class="statbar">
                    <div class="statbar__symbol green">80+</div>
                    <div class="statbar__title">Педагогов</div>
                    <div class="statbar__descr">Сотрудничают с нами на постоянной основе</div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-xl-3 col-sm-6">
                <div class="main-page__items_item">
                    <img src="{{asset('images/main_page/item-icon6.png')}}" style="margin-left: auto; margin-right: auto; display: block;" alt="">
                    <h2>Международный уровень</h2>
                    <p>Международный <br> и всероссийский уровни конкурсов.</p>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="statbar">
                    <div class="statbar__symbol yellow">500+</div>
                    <div class="statbar__title">Конкурсов</div>
                    <div class="statbar__descr">Проводится ежегодно на нашем образовательном портале</div>
                </div>
            </div>
            <div class="d-none d-sm-flex col-md-6 col-lg-3 col-xl-3 col-sm-6 justify-content-center align-items-center">
                <img class="img-fluid" src="{{asset('images/main_page/items-1.png')}}" style="width: 100%;" alt="">
            </div>
            <div class="col-12 col-md-6 col-lg-3 col-xl-3 col-sm-6">
                <div class="main-page__items_item">
                    <img  src="{{asset('images/main_page/item-icon4.png')}}" style="margin-left: auto; margin-right: auto; display: block;" alt="">
                    <h2>Более 15 000 авторов</h2>
                    <p>Размести свои работы <br> или участвовали <br> в наших конкурсах.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="main-page__contents">
    <div class="container">
        <h2 class="head-text text-center" style="margin-bottom: 16px;">Новые <span>конкурсы</span></h2>
        <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br>
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown..</p>
        <div class="row">
            <div class="col-12 col-lg-6 col-xl-6 col-md-12 main-page__news_conc-item">
                <img src="{{asset('images/main_page/CAT.png')}}" alt="Cat">
                <div class="main-page__news_conc-item-desc">
                    <img src="{{asset('images/main_page/services-icon-1.png')}}" class="white-figure" alt="">
                    <p class="text-center"><a href="">Не думай о секундах с высока, наступит время Не думай о секундах с</a></p>
                    <p style="font-size: 14px;">конкурс рисунков</p>
                    <div class="news_conc-item-down">
                        <p class="date-publ">С 01.03.2020 - 01.04.2020</p>
                        <button>ПРИНЯТЬ УЧАСТИЕ</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-6 col-md-12 main-page__news_conc-item">
                <img src="{{asset('images/main_page/CAT.png')}}" alt="Cat">
                <div class="main-page__news_conc-item-desc">
                    <img src="{{asset('images/main_page/services-icon-1.png')}}" class="white-figure" alt="">
                    <p class="text-center"><a href="">Не думай о секундах с высока, наступит время Не думай о секундах с</a></p>
                    <p style="font-size: 14px;">конкурс рисунков</p>
                    <div class="news_conc-item-down">
                        <p class="date-publ">С 01.03.2020 - 01.04.2020</p>
                        <button>ПРИНЯТЬ УЧАСТИЕ</button>
                    </div>
                </div>
            </div> 
            <div class="col-12 col-lg-6 col-xl-6 col-md-12 main-page__news_conc-item">
                <img src="{{asset('images/main_page/CAT.png')}}" alt="Cat">
                <div class="main-page__news_conc-item-desc">
                    <img src="{{asset('images/main_page/services-icon-1.png')}}" class="white-figure" alt="">
                    <p class="text-center"><a href="">Не думай о секундах с высока, наступит время Не думай о секундах с</a></p>
                    <p style="font-size: 14px;">конкурс рисунков</p>
                    <div class="news_conc-item-down">
                        <p class="date-publ">С 01.03.2020 - 01.04.2020</p>
                        <button>ПРИНЯТЬ УЧАСТИЕ</button>
                    </div>
                </div>
            </div> 
            <div class="col-12 col-lg-6 col-xl-6 col-md-12 main-page__news_conc-item">
                <img src="{{asset('images/main_page/CAT.png')}}" alt="Cat">
                <div class="main-page__news_conc-item-desc">
                    <img src="{{asset('images/main_page/services-icon-1.png')}}" class="white-figure" alt="">
                    <p class="text-center"><a href="">Не думай о секундах с высока, наступит время Не думай о секундах с</a></p>
                    <p style="font-size: 14px;">конкурс рисунков</p>
                    <div class="news_conc-item-down">
                        <p class="date-publ">С 01.03.2020 - 01.04.2020</p>
                        <button>ПРИНЯТЬ УЧАСТИЕ</button>
                    </div>
                </div>
            </div> 
        </div>
        <button class="main-page__news_conc-button">ЕЩЕ 12 КОНКУРСОВ</button>
    </div>
</section>

<section class="main-page__last_pub">
    <div class="container">
        <h2 class="head-text text-center" style="margin-bottom: 16px;">Последние <span>публикации</span></h2>
        <p class="text-center main-page__last_pub-info">
            Более 1234 педагогов опубликовались на нашем сайте за последние 2 года. Спасибо вам за даверие! <br>
            Мы, в свою очередь, гарантируем прозрачность проведенеия конкурсов и оперативное получение <br> дипломов и сертификатов!
        </p>
        <div class="row">
            <div class="col-12 d-flex main-page__last_pub-item">
                <img src="{{asset('images/main_page/doc.png')}}" style="width: 32px; height: 40px; margin-right: 16px;" alt="">
                <div>
                    <a>Моя первая публикация на рандомную тему, но с очень длинным названием</a>
                    <p><span>Конспект занятия • 2 класс</span>            <span>Зима • Весна • Осень</span></p>
                    <p>Самые близкие люди после родителей это братья и сестры. Ценность настоящих братских.</p>
                    <div class="d-flex mb-2">
                        <a href="{{asset('images/main_page/cat1.png')}}" data-fancybox="gallery"><img src="{{asset('images/main_page/cat1.png')}}" alt=""></a>
                         <a href="{{asset('images/main_page/cat2.png')}}" data-fancybox="gallery"><img src="{{asset('images/main_page/cat2.png')}}" alt=""></a>
                         <a href="{{asset('images/main_page/cat3.png')}}" data-fancybox="gallery"><img src="{{asset('images/main_page/cat3.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex main-page__last_pub-item">
                <img src="{{asset('images/main_page/doc2.png')}}" style="width: 32px; height: 40px; margin-right: 16px;" alt="">
                <div>
                   <a>Моя первая публикация на рандомную тему, но с очень длинным названием</a>
                    <p><span>Конспект занятия • 2 класс</span>            <span>Зима • Весна • Осень</span></p>
                    <p>Самые близкие люди после родителей это братья и сестры. Ценность настоящих братских.</p>
                    <p class="main-page__last_pub-item-3 mb-0"><span>07.04.2020</span>    <span>Дутов К. К ., д. Малые Залупки</span></p>
                </div>
                <div class="more"><a href="#">Больше конкурсов > ></a></div>
            </div>
            <div class="col-12 d-flex main-page__last_pub-item">
                <img src="{{asset('images/main_page/doc2.png')}}" style="width: 32px; height: 40px; margin-right: 16px;" alt="">
                <div>
                  <a>Моя первая публикация на рандомную тему, но с очень длинным названием</a>
                    <p><span>Конспект занятия • 2 класс</span>            <span>Зима • Весна • Осень</span></p>
                    <p>Самые близкие люди после родителей это братья и сестры. Ценность настоящих братских.</p>
                    <p class="main-page__last_pub-item-3 mb-0"><span>07.04.2020</span>    <span>Дутов К. К ., д. Малые Залупки</span></p>
                </div>
            </div>
            <div class="col-12 d-flex main-page__last_pub-item">
                <img src="{{asset('images/main_page/doc.png')}}" style="width: 32px; height: 40px; margin-right: 16px;" alt="">
                <div>
                 <a>Моя первая публикация на рандомную тему, но с очень длинным названием</a>
                    <p><span>Конспект занятия • 2 класс</span>            <span>Зима • Весна • Осень</span></p>
                    <p>Самые близкие люди после родителей это братья и сестры. Ценность настоящих братских.</p>
                    <div class="d-flex mb-2">
                        <img src="{{asset('images/main_page/cat1.png')}}" alt="">
                        <img src="{{asset('images/main_page/cat2.png')}}" alt="">
                        <img src="{{asset('images/main_page/cat3.png')}}" alt="">
                    </div>
                </div>
                <div class="publication-snippet">
                    @foreach ($publications as $publication)
                        @if($publication->moderation == 0)
                            @continue
                        @endif
                            <div class="publication">
                                <div class="publication__img">
                                    <img src="
                                        @switch ($publication['file'])
                                            @case("doc")
                                                {{ asset('images/doc.svg') }}
                                                @break
                                            @case("pdf")
                                                {{ asset('images/pdf.svg') }}
                                                @break
                                            @case("ppt")
                                                {{ asset('images/ppt.svg') }}
                                                @break
                                        @endswitch
                                    " alt="Иконка">
                                </div>
                                <div class="publication__descr">
                                    <a href="/publication/{{$publication->id}}" class="title">
                                        {{$publication->title}}
                                    </a>
                                    <div class="date-time">
                                        {{$publication->date_add}}
                                    </div>
                                    <div class="author">
                                        {{$publication->user->f}} {{$publication->user->i}}. {{$publication->user->i}}
                                        .,
                                        {{$publication->user->stuff}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </div>
                <div class="more"><a href="{{route('publications')}}">Больше публикаций > ></a></div>
            </div>
        </div>
    </div>
</section>
<section class="main-page__banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-7 col-md-7">
                <div class="banner__wrap">
                    <h2 class="section-title banner__title">Зарегестрируйся на портале и получи 20 бонусов!</h2>
                    <div class="banner__button_wrap">
                        <a href="" class=" button banner__button transparent-btn">Подробнее</a>
                        <a href="" class=" button banner__button filled-btn">Получить бонусы</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-5 d-none d-md-block">
                <img src="{{asset('images/main_page/children-1.png')}}" alt="Ребенок">
            </div>
        </div>
    </div>
</section>

<section class="main-page__winner">
    <div class="container">
        <h2 class="head-text text-center">Часто задаваемые <span>вопросы</span></h2>
        <div class="row">
            <div class="col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex questions-item">
                <img src="{{asset('images/main_page/quest.png')}}"  width="68" height="68" alt="Ребенок">
                <a  data-toggle="modal" data-target="#exampleModal">Сколько стоит участие в конкурсе?</a>
            </div>
            <div class="col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex questions-item">
                <img src="{{asset('images/main_page/quest.png')}}" width="68" height="68"  alt="Ребенок">
                <a data-toggle="modal" data-target="#exampleModal">Кто может участвовать в конкурсе?</a>
            </div>
            <div class="col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex questions-item">
                <img src="{{asset('images/main_page/quest.png')}}" width="68" height="68"  alt="Ребенок">
                <a  data-toggle="modal" data-target="#exampleModal">Как я могу скачать свой сертификат?</a>
            </div>
            <div class="col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex questions-item">
                <img src="{{asset('images/main_page/quest.png')}}" width="68" height="68"  alt="Ребенок">
                <a data-toggle="modal" data-target="#exampleModal">Как разместить публикацию на сайте?</a>
            </div>
            <div class="col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex questions-item">
                <img src="{{asset('images/main_page/quest.png')}}" width="68" height="68"  alt="Ребенок">
                <a data-toggle="modal" data-target="#exampleModal">Работы каких тематик принимаются к публикации?</a>
            </div>
            <div class="col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex questions-item">
                <img src="{{asset('images/main_page/quest.png')}}" width="68" height="68"  alt="Ребенок">
                <a data-toggle="modal" data-target="#exampleModal">Как я могу использовать бонусные баллы?</a>
            </div>
        </div>
        <div class="winner__result">
            @section ('winers')
                <div class="winer-block">
                    <div class="col-winer-block__img">
                        <div class="winer-block__img"
                             style="background: url('{{asset('images/skier.png')}}') center no-repeat;">
                            <div class="mask">
                                <a href="">
                                    <div class="mask-btn">
                                        <i class="fa fa-eye"></i>
                                        <span>Подробнее</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="winer-block__info">
                        <img src="{{asset('images/main_page/services-icon-1.png')}}" alt="Иконка">
                        <a href="" class="name">Зимние забавы</a>
                        <div class="date-time">Сроки проведения: <span>01.01.2019-04.04.2019</span></div>
                        <div class="descr">Международный конкурс детского рисунка на тему зимних видов спорта</div>
                        <a href="#" class="button transparent-btn">Результаты</a>
                    </div>
                </div>
            @endsection
{{--            <div class="winners">--}}
{{--                @for ($i = 0; $i < 4; $i++)--}}
{{--                    <div class="row">--}}
{{--                        @for ($j = 0; $j < 2; $j++)--}}
{{--                            <div class="col-xl-6">--}}
{{--                                @yield('winers')--}}
{{--                            </div>--}}
{{--                        @endfor--}}
{{--                    </div>--}}
{{--                @endfor--}}
{{--            </div>--}}
        </div>
        <div class="more"><a href="#">Перейти в архив конкурсов > ></a></div>
    </div>
</section>

{{--<section class="main-page__questions">--}}
{{--    <div class="container">--}}
{{--        <h2 class="section__title ta-center">Часто задаваемые вопросы</h2>--}}
{{--        <div class="questions__acord-wrap">--}}
{{--            <div class="questions__acord">--}}
{{--                <div class="head">--}}
{{--                    <div class="arrow"></div>--}}
{{--                    <div class="title "><span>Сколько стоит участие в конкурсе?</span></div>--}}
{{--                </div>--}}
{{--                <div class="body">--}}
{{--                    Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="questions__acord">--}}
{{--                <div class="head">--}}
{{--                    <div class="arrow"></div>--}}
{{--                    <div class="title "><span>Как я могу скачать свой сертификат?</span></div>--}}
{{--                </div>--}}
{{--                <div class="body">--}}
{{--                    Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="questions__acord">--}}
{{--                <div class="head">--}}
{{--                    <div class="arrow"></div>--}}
{{--                    <div class="title "><span>Как разместить публикацию на сайте?</span></div>--}}
{{--                </div>--}}
{{--                <div class="body">--}}
{{--                    Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="questions__acord">--}}
{{--                <div class="head">--}}
{{--                    <div class="arrow"></div>--}}
{{--                    <div class="title "><span>Сертификат будет один на ребенка и преподавателя?</span></div>--}}
{{--                </div>--}}
{{--                <div class="body">--}}
{{--                    Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="questions__acord">--}}
{{--                <div class="head">--}}
{{--                    <div class="arrow"></div>--}}
{{--                    <div class="title "><span>Кто может участвовать в конкурсе?</span></div>--}}
{{--                </div>--}}
{{--                <div class="body">--}}
{{--                    Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="questions__acord">--}}
{{--                <div class="head">--}}
{{--                    <div class="arrow"></div>--}}
{{--                    <div class="title "><span>Сколько конкурсов проводится ежемесячно?</span></div>--}}
{{--                </div>--}}
{{--                <div class="body">--}}
{{--                    Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="questions__acord">--}}
{{--                <div class="head">--}}
{{--                    <div class="arrow"></div>--}}
{{--                    <div class="title "><span>Какие тематики статей принимаются к публикации?</span></div>--}}
{{--                </div>--}}
{{--                <div class="body">--}}
{{--                    Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<section class="main-page__surprise">
    <div class="container">
        <h2 class="head-text text-center head-text-white" style="">Подпишитесь на <span>новостную рассылку</span></h2>
        <p>Подборка только самого интересного не чаще 1 раза в неделю</p>
        <img src="{{asset('images/main_page/form-img.png')}}" alt="Дети">
    </div>
</section>
<div class="main-page__form">
    <div class="container">
        <p>Оформите подписку и получите <img src="{{asset('images/main_page/coin.png')}}" alt="Дети"> <span>50 баллов</span><br>на заказ дипломов или сертификатов</p>
        <form action="" class="main-form d-flex row justify-content-center">
            <input type="text" placeholder="Укажите ваш email">
            <button class="button transparent-btn">Подписаться</button>
            <img src="{{asset('images/main_page/airplane.png')}}" alt="">
        </form>
    </div>
</div>

@include('header_footer/footer')
@include('script')
</body>
</html>

