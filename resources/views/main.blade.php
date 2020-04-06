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
            <div class="_diploms-img col-xl-3">
                <img src="{{asset('images/main_page/diplom.png')}}" alt="diplom" class="_diplom-1">
            </div>
        </div>
        <div class="row">
            <div class="main-descr col-xl-7">
                <ul class="main-descr__items">
                    <li class="main-descr__item">Публикации во всероссийском СМИ</li>
                    <li class="main-descr__item">Конкурсы для педагогов и детей</li>
                    <li class="main-descr__item">Материалы для школы и детского сада</li>
                    <li class="main-descr__item">Дипломы и сертификаты от 2х дней</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="main-page__descr">
    <div class="container">
        <div class="row">
            <div class="col-xl-7">
                <h2 class="section-title">О портале</h2>
                <p>Образовательный портал им. С. Я. Маршака является Средством Массовой Информации(СМИ) ЭЛ № ФС
                    77-666666</p>
                <p>На нашем портале вы можете стать участником и призером Дистанционных конкурсов Всероссийского и
                    Международного уровня среди детей дошкольного и школьного возраста, педагогов и воспеталей</p>
                <p>Педагоги могут опубликовать учебно-методические разработки и получить Свидетельство о публикации для
                    аттестации</p>
                <p>За участие в конкурсах все участники получают Сертификаты, а победители и лауреанты &mdash; Диипломы
                    победителей</p>
                <p>Дипломы и сертификаты отправляются на элюпочту, а также размещаются в Личном кабинете</p>
            </div>
            <div class="col-xl-5">
                <div class="main-page__img">
                    <img src="{{asset('images/main_page/inn.png')}}" alt="inn">
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
            <div class="col-xl-3">
                <div class="statbar">
                    <div class="statbar__symbol orange">169</div>
                    <div class="statbar__title">Публикаций</div>
                    <div class="statbar__descr">Размещенно на нашем ресурсе за предыдущий месяц</div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="statbar">
                    <div class="statbar__symbol yellow">500+</div>
                    <div class="statbar__title">Конкурсов</div>
                    <div class="statbar__descr">Проводится ежегодно на нашем образовательном портале</div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="statbar">
                    <div class="statbar__symbol blue">48</div>
                    <div class="statbar__title">Часов</div>
                    <div class="statbar__descr">Победители определяются в течение 48 ч после завершения конкурса!</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="main-page__contents">
    <div class="container">
        <div class="contents__wrapper">
            <h2 class="section-title ta-center">Участвуйте и вдохновляйтесь!</h2>
            <div class="row justify-content-center">
                <div class="col-xl-6 contents__descr">
                    <p class="ta-center margin-bottom-0">Мероприятия проводятся на конкурсной основе. Вы можете
                        участвовать как с
                        детьми, так и в конкурсах среди педагогов и воспитателей.</p>
                    <p class="ta-center">Победители определяются в течение 48 часов</p>
                </div>
            </div>
        </div>
    </div>
    <div id="tabs">
        <ul class="tabs">
            <li class="mark tab mark_active" data-tab="1">Конкурсы</li>
            <li class="mark tab" data-tab="2">Публикации</li>
        </ul>
        <div class="tab-content content_active tab-section" data-tab="1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 contents__descr">
                        <p class="ta-center margin-bottom-0">Мероприятия проводятся на конкурсной основе. Вы можете
                            участвовать как
                            с детьми, так и в конкурсах среди педагогов и воспитателей.</p>
                        <p class="ta-center">Победители определяются в течение 48 часов</p>
                    </div>
                </div>
                <div class="competition-wrap">
                    @foreach($competitions as $competition)
                        <div class="competition">
                            <div class="competition__img">
                                <img src="{{asset($competition->cover)}}" alt="Обложка">
                            </div>
                            <div class="competition__descr ta-center">
                                <div class="title">
                                    {{$competition->title}}
                                </div>
                                <div class="name">
                                    {{$competition->type->name}}
                                </div>
                                <div class="date-time">
                                    С {{$competition->date_begin}}
                                    <span>по {{$competition->date_end}}</span>
                                </div>
                                <a href="/competition/{{$competition->id}}" class="button transparent-btn">подробнее</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="more"><a href="#">Больше конкурсов > ></a></div>
            </div>
        </div>
        <div class="tab-content tab-section" data-tab="2">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 contents__descr">
                        <p class="ta-center margin-bottom-0">Мероприятия проводятся на конкурсной основе. Вы можете
                            участвовать как
                            с детьми, так и в конкурсах среди педагогов и воспитателей.</p>
                        <p class="ta-center">Победители определяются в течение 48 часов</p>
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
            <div class="col-xl-7">
                <div class="banner__wrap">
                    <h2 class="section-title banner__title">Зарегестрируйся на портале и получи 20 бонусов!</h2>
                    <div class="banner__button_wrap">
                        <a href="" class=" button banner__button transparent-btn">Подробнее</a>
                        <a href="" class=" button banner__button filled-btn">Получить бонусы</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <img src="{{asset('images/main_page/children-1.png')}}" alt="Ребенок">
            </div>
        </div>
    </div>
</section>

<section class="main-page__winner">
    <div class="container">
        <h2 class="section-title ta-center">Поздравляем победителей!</h2>
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="winner__desr ta-center">Более 1234 педагогов опубликовались на нашем сайте за последние 2
                    года.
                    Спасибо вам за даверие! Мы, в свою очередь, гарантируем прозрачность
                    проведенеия конкурсов и оперативное получение дипломов и сертификатов!
                </div>
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

<section class="main-page__questions">
    <div class="container">
        <h2 class="section__title ta-center">Часто задаваемые вопросы</h2>
        <div class="questions__acord-wrap">
            <div class="questions__acord">
                <div class="head">
                    <div class="arrow"></div>
                    <div class="title "><span>Сколько стоит участие в конкурсе?</span></div>
                </div>
                <div class="body">
                    Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет
                </div>
            </div>
            <div class="questions__acord">
                <div class="head">
                    <div class="arrow"></div>
                    <div class="title "><span>Как я могу скачать свой сертификат?</span></div>
                </div>
                <div class="body">
                    Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет
                </div>
            </div>
            <div class="questions__acord">
                <div class="head">
                    <div class="arrow"></div>
                    <div class="title "><span>Как разместить публикацию на сайте?</span></div>
                </div>
                <div class="body">
                    Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет
                </div>
            </div>
            <div class="questions__acord">
                <div class="head">
                    <div class="arrow"></div>
                    <div class="title "><span>Сертификат будет один на ребенка и преподавателя?</span></div>
                </div>
                <div class="body">
                    Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет
                </div>
            </div>
            <div class="questions__acord">
                <div class="head">
                    <div class="arrow"></div>
                    <div class="title "><span>Кто может участвовать в конкурсе?</span></div>
                </div>
                <div class="body">
                    Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет
                </div>
            </div>
            <div class="questions__acord">
                <div class="head">
                    <div class="arrow"></div>
                    <div class="title "><span>Сколько конкурсов проводится ежемесячно?</span></div>
                </div>
                <div class="body">
                    Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет
                </div>
            </div>
            <div class="questions__acord">
                <div class="head">
                    <div class="arrow"></div>
                    <div class="title "><span>Какие тематики статей принимаются к публикации?</span></div>
                </div>
                <div class="body">
                    Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет
                </div>
            </div>
        </div>
    </div>
</section>

<section class="main-page__surprise">
    <div class="container">
        <h2 class="section-title ta-center">Подарок для вас!</h2>
        <div class="sub-title ta-center">Получите 50 бонусных рублей для <span>оплаты публикации</span></div>
        <img src="{{asset('images/main_page/form-img.png')}}" alt="Дети">
    </div>
</section>

<div class="main-page__form">
    <div class="container">
        <h2 class="section-title ta-center">Подпишитесь на расслыку обновлений</h2>
        <p class="ta-center">Баллы будут зачислены на Ваш бонусный счет</p>
        <form action="" class="main-form">
            <div class="row">
                <div class="col-xl-4">
                    <span>Ваше имя</span>
                    <input type="text" placeholder="Ваше имя">
                </div>
                <div class="col-xl-4">
                    <span>Ваш email</span>
                    <input type="text" placeholder="Ваш email">
                </div>
                <div class="col-xl-4">
                    <span>Ваш телефон</span>
                    <input type="text" placeholder="Ваш телефон">
                </div>
            </div>
            <div class="ta-center">
                <button class="button transparent-btn">Отправить</button>
            </div>
            <img src="{{asset('images/main_page/airplane.png')}}" alt="">
        </form>
    </div>
</div>
@include('header_footer/footer')
@include('script')
</body>
</html>

