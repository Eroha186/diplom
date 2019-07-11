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
      <form class="form-publication" action="">
        <div class="form-publication__personal-data border-form-publication">
          {{ csrf_field() }}
          <h3 class="form-title" style="margin-bottom: 20px;">
            1) Личные данные
          </h3>
          <div class="fio">
            <div class="fio-block">
              <label for="f">Фамилия</label>
              <input name="f" id="f" class="input-style" type="text" placeholder="Иванов" value="{{isset($data) ? $data->f : ''}}">
            </div>
            <div class="fio-block">
              <label for="i">Имя</label>
              <input name="i" id="i" class="input-style" type="text" placeholder="Иван" value="{{isset($data) ? $data->i : ''}}">
            </div>
            <div class="fio-block">
              <label for="o">Отчество</label>
              <input name="o" id="o" class="input-style" type="text" placeholder="Иванович" value="{{isset($data) ? $data->o : ''}}">
            </div>
          </div>
          <label for="stuff">Должность</label>
          <input name="stuff" id="stuff" class="input-style" type="text" placeholder="Учитель начальных классов" value="{{isset($data) ? $data->stuff : ''}}">
          <label for="email">E-mail</label>
          <input name="email" id="email" class="input-style"  type="text" placeholder="teacher@mail.ru" value="{{isset($data) ? $data->email : ''}}">
          <label for="job">Наименования образовательного учреждения</label>
          <input name="job" id="job"  class="input-style" type="text" placeholder="МБОУ СОШ №11" value="{{isset($data) ? $data->job : ''}}">
          <label for="town">Населенный пункт</label>
          <input name="town" id="town" class="input-style"  type="text" placeholder="г. Москва" value="{{isset($data) ? $data->town : ''}}">

        </div>
      </form>
    </div>
  </div>
</div>
@include('script')
</body>
</html>