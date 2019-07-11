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
      <form action="">
        
      </form>
    </div>
  </div>
</div>
@include('script')
</body>
</html>