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
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Авторизация</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST"
                          action="{{route('loginFormCompetition')}}" id="login-form-publication">
                        {{ csrf_field() }}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp"
                                   placeholder="Введите ваш e-mail" value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Пароль</label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                                   placeholder="Введите пароль">
                        </div>
                        <div class="form-check" style="margin-bottom: 10px;">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Запомнить меня</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Войти</button>
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Забыл пароль
                            </a>
                        </div>
                    </form>
                </div>
                {{--                <div class="modal-footer">--}}
                {{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                {{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
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
            <form class="form-publication" enctype="multipart/form-data" action="{{route('form-competition')}}"
                  method="POST">
                {{ csrf_field() }}
                <div class="form-competition__competition border-form-competition">
                    <h3 class="form-title" style="margin-bottom: 20px;">
                        1) Конкурс
                    </h3>
                    <label for="competition" class="red-star">Конкурс</label>
                    <select name="competition" id="competition" class="input-style">
                        <option value="0">Конкурс</option>
                        @foreach($competitions as $competition)
                            <option value="{{$competition->id}}"
                                @if($competition->id == old('competition'))
                                    selected
                                @endif
                                @if($competition->id == $competitionSelected->id)
                                    selected
                                @endif
                            >{{$competition->title}}</option>
                        @endforeach
                    </select>

                    <label for="nomination" class="red-star">Номинация</label>
                    <select name="nomination" id="nomination" class="input-style">
                        <option value="0">Номинация</option>
                        @foreach($competitionSelected->nominations as $nomination)
                            <option value="{{$nomination->id}}"
                                @if($nomination->id == old($nomination))
                                    selected
                                @endif
                            >{{$nomination->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-competition__work border-form-competition">
                    <h3 class="form-title" style="margin-bottom: 20px;">
                        2) Работа
                    </h3>
                    {{--                    <div class="past-work">--}}
                    {{--                        <input type="checkbox" id="past-work" name="past-work">--}}
                    {{--                        <label for="past-work"> Выбрать работу из ранее опубликованных</label>--}}
                    {{--                    </div>--}}
                    <div style="display: flex; justify-content: space-between ">
                        <div class="col-xl-7" style="padding: 0;">
                            <label for="title" class="red-star">Название работы</label>
                            <input name="title" id="title" class="input-style" type="text" placeholder="С 8 марта!" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div style="font-weight: bold;">
                        <label for="annotation" class="red-star">Описание работы</label> (не более 200 символов)
                    </div>
                    <textarea name="annotation" id="annotation" cols="30" rows="5" class="input-style"
                              placeholder="Описание работы....">{{ old('annotation') }}</textarea>

                    <div style="font-weight: bold; margin-bottom: 30px;">
                        <label class="red-star">Прекрепите файл работы</label> (допустимые типы файлов: .jpg, .png,
                        .doc, .docx,
                        .pdf, .ppt, .pptx)
                    </div>
                    <div>
                        <input type="file" id="upload" name="file"
                               class="hide">
                        <label for="upload" class="upload filled-btn">Загрузить файл</label> <span class="file-display">Файл не выбран</span>
                    </div>
                </div>

                <div class="form-competition__personal-data border-form-competition">
                    <h3 class="form-title" style="margin-bottom: 20px;">
                        3) Личные данные
                    </h3>
                    <div class="fio-children">
                        <div class="fio-children-block">
                            <label for="fc" class="red-star">Фамилия ребенка</label>
                            <input name="fc" id="fc" class="input-style" type="text" placeholder="Иванов" value="{{ old('fc') }}">
                        </div>
                        <div class="fio-children-block">
                            <label for="ic" class="red-star">Имя ребенка</label>
                            <input name="ic" id="ic" class="input-style" type="text" placeholder="Иван" value="{{ old('ic') }}">
                        </div>
                        <div class="fio-children-block">
                            <label for="oc" class="red-star">Отчество ребенка</label>
                            <input name="oc" id="oc" class="input-style" type="text" placeholder="Иванович" value="{{ old('oc') }}">
                        </div>
                        <div class="fio-children-block">
                            <label for="age" class="red-star">Возраст ребенка</label>
                            <input name="age" id="age" class="input-style" type="text" placeholder="14" value="{{ old('age') }}">
                        </div>
                    </div>
                    <div class="fio">
                        <div class="fio-block">
                            <label for="f" class="red-star">Фамилия педагога</label>
                            <input name="f" id="f" class="input-style" type="text" placeholder="Иванов"
                                   value="{{ isset($user) ? $user['f'] : '' }}" {{ isset($user) ? 'readonly' : '' }}>
                        </div>
                        <div class="fio-block">
                            <label for="i" class="red-star">Имя педагога</label>
                            <input name="i" id="i" class="input-style" type="text" placeholder="Иван"
                                   value="{{ isset($user) ? $user['i'] : '' }}" {{ isset($user) ? 'readonly' : '' }}>
                        </div>
                        <div class="fio-block">
                            <label for="o" class="red-star">Отчество педагога</label>
                            <input name="o" id="o" class="input-style" type="text" placeholder="Иванович"
                                   value="{{ isset($user) ? $user['o'] : '' }}" {{ isset($user) ? 'readonly' : '' }}>
                        </div>
                    </div>
                    <label for="stuff" class="red-star">Должность</label>
                    <input name="job" id="job" class="input-style" type="text"
                           placeholder="Учитель начальных классов"
                           value="{{ isset($user) ? $user['job'] : ''}}" {{ isset($user) ? 'readonly' : '' }}>
                    <label for="email" class="red-star">E-mail</label>
                    <input name="email" id="email" class="input-style" type="text" placeholder="teacher@mail.ru"
                           value="{{ isset($user) ? $user['email'] : ''}}" {{ isset($user) ? 'readonly' : '' }}>
                    <label for="job" class="red-star">Наименования образовательного учреждения</label>
                    <input name="stuff" id="stuff" class="input-style" type="text" placeholder="МБОУ СОШ №11"
                           value="{{ isset($user) ? $user['stuff'] : ''}}" {{ isset($user) ? 'readonly' : '' }}>
                    <label for="town" class="red-star">Населенный пункт</label>
                    <input name="town" id="town" class="input-style" type="text" placeholder="г. Москва"
                           value="{{ isset($user) ? $user['town'] : ''}}" {{ isset($user) ? 'readonly' : '' }}>
                </div>

                <div class="form-competition__placement-method border-form-competition">
                    <h3 class="form-title" style="margin-bottom: 20px;">
                        4) Способ размещения
                    </h3>
                    <div style="font-weight: bold; margin-bottom: 20px;">
                        <label for="" class="red-star">Выберите способ размещения</label>
                    </div>
                    <div class="placement-method">
                        <label for="by-diplom" class="by-diplom radio-button {{ is_null(old('placement-method')) ? 'radio-button_active' : (old('placement-method') == 1 ? 'radio-button_active' : '') }}">
                            <input type="radio" name="placement-method" id="by-diplom" class="hide"
                                   {{is_null(old('placement-method')) ? 'data-check=true' : (old('placement-method') == 1 ? 'data-check=true' : '')}}
                                   value="1"
                                    {{is_null(old('placement-method')) ? 'checked=checked' : (old('placement-method') == 1 ? 'checked=checked' : '')}}>
                            <div class="radio-button__title">
                                <img src="{{asset('images/credit-card.svg')}}" alt="кредитная карта">
                                <span>Разместить работу и заказать диплом сейчас</span>
                            </div>
                            <div class="radio-button__descr">
                                Стоимость одного диплома 100 рублей.
                                Оплатить можно онлайн любым удобным способом.
                            </div>
                        </label>
                        <label for="without-diplom" class="without-diplom radio-button {{ is_null(old('placement-method')) ? : (old('placement-method') == 0 ? "radio-button_active" : '') }}">
                            <input type="radio" name="placement-method" id="without-diplom" class="hide" value="0"
                                    {{is_null(old('placement-method')) ? '' : (old('placement-method') == 0 ? 'data-check=true' : '')}}
                                    {{is_null(old('placement-method')) ? '' : (old('placement-method') == 0 ? 'checked=checked' : '')}}>
                            <div class="radio-button__title">
                                <img src="{{asset('images/list.svg')}}" alt="кредитная карта">
                                <span>Разместить работу и заказать диплом позже</span>
                            </div>
                            <div class="radio-button__descr">
                                Бесплатная публикация с возможностью заказать нужные дипломы позже в личном кабинете.
                            </div>
                        </label>
                    </div>
                    <div class="payment-block {{ is_null(old('placement-method')) ? 'payment-block_active' : (old('placement-method')  ? 'payment-block_active' : '')}}">
                        <strong>Итого:</strong>
                        <ul class="payment">
                            <li>Диплом за публикацию материала......<span class="payment-cash">{{ $cash }}</span>&#8381;
                            </li>
                        </ul>

                        <strong>На вашем счету {{isset($user->coins) ? $user->coins : '0'}} бонусов</strong>
                        <div style="display: flex; align-items: center; margin-bottom: 15px;">
                            <input id="uses-coins" type="checkbox" style="margin-right: 3px;"
                                   name="uses-coins" {{old('uses-coins') ?  'checked="checked"' : '' }}>
                            <span class="margin-right-7">Использовать бонусы</span>
                            <input type="number" min="0" max="{{isset($user->coins) ? $user->coins : '0'}}"
                                   value="{{!is_null(old('coins')) ?  old('coins') : '0' }}"
                                   id="coins-number" name="coins" readonly="readonly">
                        </div>
                        <div class="result-payment">
                            К оплате <span id="cash"></span>&#8381;
                        </div>
                    </div>


                    <ul class="agreements">
                        <li class="agreements-item">
                            <input type="checkbox" id="offer"
                                   name="offer" {{old('offer') ?  'checked="checked"' : '' }}>
                            <label for="offer">Согласен с условием <a href="" class="standart-link">оферты</a></label>
                        </li>

                        <li class="agreements-item">
                            <input type="checkbox" id="processing-pd"
                                   name="processing-pd" {{old('processing-pd') ?  'checked="checked"' : '' }}>
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
                    <button class="form-publication__btn transparent-btn" id="submit-form-publication">отправить
                        заявку
                    </button>
                    <a href="{{route('competitions')}}" class="form-publication__btn filled-btn ">отменить</a>
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