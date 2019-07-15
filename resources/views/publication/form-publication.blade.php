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
  <div class="row">
    <div class="col-md-7 notice">
      Внимательно проверяйте правильность заполнения полей формы! Внесенные Вами данные
      будут использованы для размещения в дипломах и сертификатах
    </div>
  </div>
  <div class="row">
    <div class="col-md-7">
      <form class="form-publication" enctype="multipart/form-data" action="">
        {{ csrf_field() }}
        <div class="form-publication__personal-data border-form-publication">
          <h3 class="form-title" style="margin-bottom: 20px;">
            1) Личные данные
          </h3>
          <div class="fio">
            <div class="fio-block">
              <label for="f" class="red-star">Фамилия</label>
              <input name="f" id="f" class="input-style" type="text" placeholder="Иванов"
                     value="{{isset($data) ? $data->f : ''}}">
            </div>
            <div class="fio-block">
              <label for="i" class="red-star">Имя</label>
              <input name="i" id="i" class="input-style" type="text" placeholder="Иван"
                     value="{{isset($data) ? $data->i : ''}}">
            </div>
            <div class="fio-block">
              <label for="o" class="red-star">Отчество</label>
              <input name="o" id="o" class="input-style" type="text" placeholder="Иванович"
                     value="{{isset($data) ? $data->o : ''}}">
            </div>
          </div>
          <label for="stuff" class="red-star">Должность</label>
          <input name="job" id="job" class="input-style" type="text"
                 placeholder="Учитель начальных классов" value="{{isset($data) ? $data->job : ''}}">
          <label for="email" class="red-star">E-mail</label>
          <input name="email" id="email" class="input-style" type="text" placeholder="teacher@mail.ru"
                 value="{{isset($data) ? $data->email : ''}}">
          <label for="job" class="red-star">Наименования образовательного учреждения</label>
          <input name="stuff" id="stuff" class="input-style" type="text" placeholder="МБОУ СОШ №11"
                 value="{{isset($data) ? $data->stuff : ''}}">
          <label for="town" class="red-star">Населенный пункт</label>
          <input name="town" id="town" class="input-style" type="text" placeholder="г. Москва"
                 value="{{isset($data) ? $data->town : ''}}">

        </div>

        <div class="form-publication__personal-data border-form-publication">
          <h3 class="form-title" style="margin-bottom: 20px;">
            2) Работа
          </h3>
          <label for="kind" class="red-star">Вид публикации</label>
          <select name="stuff" id="kind" class="input-style">

          </select>
          <div style="display: flex; justify-content: space-between ">
            <div class="col-md-7" style="padding: 0;">
              <label for="name-work" class="red-star">Название работы</label>
              <input name="name-work" id="name-work" class="input-style" type="text" placeholder="С 8 марта!">
            </div>
            <div class="col-md-4" style="padding: 0;">
              <label for="type" class="red-star">Тип работы</label>
              <select name="type" id="type" class="input-style">

              </select>
            </div>
          </div>
          {{-- переделать --}}
          <div style="font-weight: bold"><label for="themes" class="red-star">Тематика работы</label> (укажите не менее
            3-х тегов)
          </div>
          <select name="themes" multiple id="themes" class="input-style">
          </select>
          <div style="font-weight: bold">
            <label for="descr" class="red-star">Описание работы</label> (не более 100 символов)
          </div>
          <textarea name="descr" id="descr" cols="30" rows="5" class="input-style"></textarea>
          <div style="font-weight: bold; margin-bottom: 30px;">
            <label class="red-star">Прекрепите файл работы</label> (допустимые типы файлов: .jpg, .png, .doc, .docx,
            .pdf,
            .ppt, .pptx)
          </div>
          <div>
            <input type="file" id="upload" multiple data-multiple-caption="Загружено {count} файлов " name="files"
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
              <input type="checkbox" id="offer">
              <label for="offer">Согласен с условием <a href="" class="standart-link">оферты</a></label>
            </li>

            <li class="agreements-item">
              <input type="checkbox" id="processing-pd">
              <label for="processing-pd">Я подтверждаю свое согласие на обработку персональных данных</label>
            </li>

            <li class="agreements-item">
              <input type="checkbox" id="distribution" checked="checked">
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