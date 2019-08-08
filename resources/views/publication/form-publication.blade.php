<!doctype html>
<html lang="ru">
<head>
    <title>Добавить публикацию</title>
    @include('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@include('header_footer.header')
<div class="container">
    {!!Breadcrumbs::render('form-publication')!!}
    <h2 class="section-title" style="margin-bottom: 20px;">
        Заполните все поля формы
    </h2>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-xl-7 notice">
            Внимательно проверяйте правильность заполнения полей формы! Внесенные Вами данные
            будут использованы для размещения в дипломах и сертификатах
        </div>
    </div>
    <div class="row">
        <div class="col-xl-7">
            <form class="form-publication" enctype="multipart/form-data" action="{{route('form-publication')}}"
                  method="POST">
                {{ csrf_field() }}
                <div class="form-publication__personal-data border-form-publication">
                    <h3 class="form-title" style="margin-bottom: 20px;">
                        1) Личные данные
                    </h3>
                    <div class="fio">
                        <div class="fio-block">
                            <label for="f" class="red-star">Фамилия</label>
                            <input name="f" id="f" class="input-style" type="text" placeholder="Иванов"
                                   value="{{isset($user) ? $user->f : ''}}" {{isset($user) ? 'readonly' : ''}}>
                        </div>
                        <div class="fio-block">
                            <label for="i" class="red-star">Имя</label>
                            <input name="i" id="i" class="input-style" type="text" placeholder="Иван"
                                   value="{{isset($user) ? $user->i : ''}}" {{isset($user) ? 'readonly' : ''}}>
                        </div>
                        <div class="fio-block">
                            <label for="o" class="red-star">Отчество</label>
                            <input name="o" id="o" class="input-style" type="text" placeholder="Иванович"
                                   value="{{isset($user) ? $user->o : ''}}" {{isset($user) ? 'readonly' : ''}}>
                        </div>
                    </div>
                    <label for="stuff" class="red-star">Должность</label>
                    <input name="job" id="job" class="input-style" type="text"
                           placeholder="Учитель начальных классов"
                           value="{{isset($user) ? $user->job : ''}}" {{isset($user) ? 'readonly' : ''}}>
                    <label for="email" class="red-star">E-mail</label>
                    <input name="email" id="email" class="input-style" type="text" placeholder="teacher@mail.ru"
                           value="{{isset($user) ? $user->email : ''}}" {{isset($user) ? 'readonly' : ''}}>
                    <label for="job" class="red-star">Наименования образовательного учреждения</label>
                    <input name="stuff" id="stuff" class="input-style" type="text" placeholder="МБОУ СОШ №11"
                           value="{{isset($user) ? $user->stuff : ''}}" {{isset($user) ? 'readonly' : ''}}>
                    <label for="town" class="red-star">Населенный пункт</label>
                    <input name="town" id="town" class="input-style" type="text" placeholder="г. Москва"
                           value="{{isset($user) ? $user->town : ''}}" {{isset($user) ? 'readonly' : ''}}>
                    <label for="education" class="red-star">Уровень образования</label>
                    <select name="education" id="education" class="input-style">
                        <option value="0">Выбирите уровень образования</option>
                        @foreach($educations as $education)
                            <option value="{{$education->id}}">{{$education->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-publication__work border-form-publication">
                    <h3 class="form-title" style="margin-bottom: 20px;">
                        2) Работа
                    </h3>
                    <label for="kind" class="red-star">Вид публикации</label>
                    <select name="kind" id="kind" class="input-style">
                        <option value="0" disabled selected style="color: #757575">Выберите вид публикации</option>
                        @foreach($kinds as $kind)
                            <option value="{{$kind->id}}">{{$kind->name}}</option>
                        @endforeach
                    </select>
                    <div style="display: flex; justify-content: space-between ">
                        <div class="col-xl-7" style="padding: 0;">
                            <label for="title" class="red-star">Название работы</label>
                            <input name="title" id="title" class="input-style" type="text" placeholder="С 8 марта!">
                        </div>
                        <div class="col-xl-4" style="padding: 0;">
                            <label for="type" class="red-star">Тип работы</label>
                            <select name="type" id="type" class="input-style">
                                <option value="0" disabled selected>Выберите тип работы</option>
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- переделать --}}
                    <div style="font-weight: bold"><label for="themes" class="red-star">Тематика работы</label> (укажите
                        не менее
                        3-х тегов)
                    </div>
                    <select name="themes[]" id="themes" multiple class="input-style select2">
                        @foreach($themes as $theme)
                            <option value="{{$theme->id}}">{{$theme->name}}</option>
                        @endforeach
                    </select>
                    <div style="font-weight: bold; margin-top: 30px;">
                        <label for="annotation" class="red-star">Описание работы</label> (не более 200 символов)
                    </div>
                    <textarea name="annotation" id="annotation" cols="30" rows="5" class="input-style"
                              placeholder="Описание работы...."></textarea>
                    <div style="font-weight: bold; margin-top: 30px;">
                        <label for="text" class="red-star">Полный текст работы</label> (не менее 200 символов)
                    </div>
                    <div id="standalone-container">
                        <div id="toolBar">
                            <span class="ql-formats">
{{--                              <select class="ql-font"></select>--}}
                              <select class="ql-size"></select>
                            </span>
                            <span class="ql-formats">
                              <button class="ql-bold"></button>
                              <button class="ql-italic"></button>
                              <button class="ql-underline"></button>
                              <button class="ql-strike"></button>
                            </span>
                            {{--                            <span class="ql-formats">--}}
                            {{--                              <select class="ql-color"></select>--}}
                            {{--                              <select class="ql-background"></select>--}}
                            {{--                            </span>--}}
                            {{--                            <span class="ql-formats">--}}
                            {{--                              <button class="ql-script" value="sub"></button>--}}
                            {{--                              <button class="ql-script" value="super"></button>--}}
                            {{--                            </span>--}}
                            {{--                            <span class="ql-formats">--}}
                            {{--                              <button class="ql-header" value="1"></button>--}}
                            {{--                              <button class="ql-header" value="2"></button>--}}
                            {{--                              <button class="ql-blockquote"></button>--}}
                            {{--                              <button class="ql-code-block"></button>--}}
                            {{--                            </span>--}}
                            <span class="ql-formats">
                              <button class="ql-list" value="ordered"></button>
                              <button class="ql-list" value="bullet"></button>
                              <button class="ql-indent" value="-1"></button>
                              <button class="ql-indent" value="+1"></button>
                            </span>
                            <span class="ql-formats">
{{--                              <button class="ql-direction" value="rtl"></button>--}}
                              <select class="ql-align"></select>
                            </span>
                            <span class="ql-formats">
{{--                              <button class="ql-link"></button>--}}
                              <button class="ql-image"></button>
{{--                              <button class="ql-video"></button>--}}
                                {{--                              <button class="ql-formula"></button>--}}
                            </span>
                            <span class="ql-formats">
                              <button class="ql-clean"></button>
                            </span>
                        </div>
                        <input type="text" class="hide" name="text">
                        <div id="editor"></div>
                    </div>

                    <div style="font-weight: bold; margin-bottom: 30px; margin-top: 30px;">
                        <label class="red-star">Прекрепите файл работы</label> (допустимые типы файлов: .jpg, .png,
                        .doc, .docx,
                        .pdf, .ppt, .pptx)
                    </div>
                    <div>
                        <input type="file" id="upload" multiple data-multiple-caption="Загружено {count} файлов "
                               name="files[]"
                               class="hide">
                        <label for="upload" class="upload filled-btn">Загрузить файл</label> <span class="file-display">Файл не выбран</span>
                    </div>
                </div>
                <div class="form-publication__placement-method border-form-publication">
                    <h3 class="form-title" style="margin-bottom: 20px;">
                        3) Способ размещения
                    </h3>
                    <div style="font-weight: bold; margin-bottom: 20px;">
                        <label for="" class="red-star">Выберите способ размещения</label>
                    </div>
                    <div class="placement-method">
                        <label for="by-diplom" class="by-diplom radio-button radio-button_active">
                            <input type="radio" name="placement-method" id="by-diplom" class="hide" checked="checked" value="1">
                            <div class="radio-button__title">
                                <img src="{{asset('images/credit-card.svg')}}" alt="кредитная карта">
                                <span>Разместить работу и заказатьдиплом сейчас</span>
                            </div>
                            <div class="radio-button__descr">
                                Стоимость одного диплома 100 рублей.
                                Оплатить можно онлайн любым удобным способом.
                            </div>
                        </label>
                        <label for="without-diplom" class="without-diplom radio-button">
                            <input type="radio" name="placement-method" id="without-diplom" class="hide" value="0">
                            <div class="radio-button__title">
                                <img src="{{asset('images/list.svg')}}" alt="кредитная карта">
                                <span>Разместить работу и заказать диплом позже</span>
                            </div>
                            <div class="radio-button__descr">
                                Бесплатная публикация с возможностью заказать нужные дипломы позже в личном кабинете.
                            </div>
                        </label>
                    </div>
                    <div class="payment-block payment-block_active">
                        <strong>Итого:</strong>
                        <ul class="payment">
                            <li>Диплом за публикацию материала......<span class="payment-cash">100</span>&#8381;</li>
                            <li>Диплом за участие в конкурсе..............<span class="payment-cash">100</span>&#8381;
                            </li>
                        </ul>

                        <strong>На вашем счету {{isset($user->coins) ? $user->coins : '0'}} бонусов</strong>
                        <div style="display: flex; align-items: center; margin-bottom: 15px;">
                            <input id="uses-coins" type="checkbox" style="margin-right: 3px;" name="uses-coins">
                            <span class="margin-right-7">Использовать бонусы</span>
                            <input type="number" min="0" max="{{isset($user->coins) ? $user->coins : '0'}}" value="0"
                                   id="coins-number" name="coins" readonly="readonly">
                        </div>
                        <div class="result-payment">
                            К оплате <span id="cash"></span>&#8381;
                        </div>
                    </div>

                    <ul class="agreements">
                        <li class="agreements-item">
                            <input type="checkbox" id="offer" name="offer">
                            <label for="offer">Согласен с условием <a href="" class="standart-link">оферты</a></label>
                        </li>

                        <li class="agreements-item">
                            <input type="checkbox" id="processing-pd" name="processing-pd">
                            <label for="processing-pd">Я подтверждаю свое согласие на обработку персональных
                                данных</label>
                        </li>

                        <li class="agreements-item">
                            <input type="checkbox" id="distribution" name="distribution" checked="checked">
                            <label for="distribution">Подписаться на рассылку новых обновлений</label>
                        </li>
                    </ul>

                </div>

                <div class="form-publication__button-wrap">
                    <button class="form-publication__btn transparent-btn" id="submit-form-publication">отправить заявку</button>
                    <a href="{{route('publications')}}" class="form-publication__btn filled-btn ">отменить</a>
                </div>
            </form>
        </div>
    </div>
</div>
@include('script')
<script>

</script>
</body>
</html>