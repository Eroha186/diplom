<!doctype html>
<html lang="ru">
<head>
  <title>Главная страница</title>
  @include('styles')
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
    <div class="col-md-7 notice">
      Внимательно проверяйте правильность заполнения полей формы! Внесенные Вами данные
      будут использованы для размещения в дипломах и сертификатах
    </div>
  </div>
  <div class="row">
    <div class="col-md-7">
      <form class="form-publication" enctype="multipart/form-data" action="{{route('form-publication')}}" method="POST">
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
            <div class="col-md-7" style="padding: 0;">
              <label for="title" class="red-star">Название работы</label>
              <input name="title" id="title" class="input-style" type="text" placeholder="С 8 марта!">
            </div>
            <div class="col-md-4" style="padding: 0;">
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
          <div style="font-weight: bold"><label for="themes" class="red-star">Тематика работы</label> (укажите не менее
            3-х тегов)
          </div>
          <select name="themes[]" id="themes" multiple class="input-style select2">
            @foreach($themes as $theme)
              <option value="{{$theme->id}}">{{$theme->name}}</option>
            @endforeach
          </select>
          <div style="font-weight: bold; margin-top: 30px;">
            <label for="annatation" class="red-star">Описание работы</label> (не более 100 символов)
          </div>
          <textarea name="annatation" id="annatation" cols="30" rows="5" class="input-style"
                    placeholder="Описание работы...."></textarea>
          <div style="font-weight: bold; margin-bottom: 30px;">
            <label class="red-star">Прекрепите файл работы</label> (допустимые типы файлов: .jpg, .png, .doc, .docx,
            .pdf, .ppt, .pptx)
          </div>
          <div>
            <input type="file" id="upload" multiple data-multiple-caption="Загружено {count} файлов " name="files[]"
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
            <label for="by-diplom" class="radio-button radio-button_active">
              <input type="radio" name="placement-method" id="by-diplom" class="hide" checked="checked">
              <div class="radio-button__title">
                <img src="{{asset('images/credit-card.svg')}}" alt="кредитная карта">
                <span>Разместить работу и заказатьдиплом сейчас</span>
              </div>
              <div class="radio-button__descr">
                Стоимость одного диплома 100 рублей.
                Оплатить можно онлайн любым удобным способом.
              </div>
            </label>
            <label for="without-diplom" class="radio-button">
              <input type="radio" name="placement-method" id="without-diplom" class="hide">
              <div class="radio-button__title">
                <img src="{{asset('images/list.svg')}}" alt="кредитная карта">
                <span>Разместить работу и заказать диплом позже</span>
              </div>
              <div class="radio-button__descr">
                Бесплатная публикация с возможностью заказать нужные дипломы позже в личном кабинете.
              </div>
            </label>
          </div>
          <strong>Итого:</strong>
          <ul class="payment">
            <li>Диплом за публикацию материала......100&#8381;</li>
            <li>Диплом за участие в конкурсе..............100&#8381;</li>
          </ul>

          <strong>На вашем счету 10 бонусов</strong>
          <div style="display: flex; align-items: center; margin-bottom: 15px;">
            <input type="checkbox">
            <span class="margin-right-7">Использовать бонусы</span>
            <input type="number" min="0" max="10" value="0">
          </div>
          <div class="result-payment">
            К оплате 190&#8381;
          </div>

          <ul class="agreements">
            <li class="agreements-item">
              <input type="checkbox" id="offer" name="offer">
              <label for="offer">Согласен с условием <a href="" class="standart-link">оферты</a></label>
            </li>

            <li class="agreements-item">
              <input type="checkbox" id="processing-pd" name="processing-pd">
              <label for="processing-pd">Я подтверждаю свое согласие на обработку персональных данных</label>
            </li>

            <li class="agreements-item">
              <input type="checkbox" id="distribution" name="distribution" checked="checked">
              <label for="distribution">Подписаться на рассылку новых обновлений</label>
            </li>
          </ul>

        </div>

        <div class="form-publication__button-wrap">
          <button class="form-publication__btn transparent-btn">отправить заявку</button>
          <a href="{{route('publications')}}" class="form-publication__btn filled-btn ">отменить</a>
        </div>
      </form>
    </div>
  </div>
</div>
@include('script')
</body>
</html>