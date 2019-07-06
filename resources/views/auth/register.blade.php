<!doctype html>
<html lang="ru">
<head>
  <title>Авторизация</title>
  @include('styles')
</head>
<body>
@include('header_footer/header')
<div class="container">
  <div class="row justify-content-center">
    <form  method="POST" action="">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="exampleInputF">Фамилия</label>
        <input name="f" type="text" class="form-control" id="exampleInputF" aria-describedby="emailHelp" placeholder="Фамилия">
        <label for="exampleInputI">Имя</label>
        <input name="i" type="text" class="form-control" id="exampleInputI" aria-describedby="emailHelp" placeholder="Имя">
        <label for="exampleInputO">Отчество</label>
        <input name="o" type="text" class="form-control" id="exampleInputO" aria-describedby="emailHelp" placeholder="Отчество">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">E-mail</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-mail">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Пароль</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword2">Повторите пароль</label>
        <input name="confirmPassword" type="password" class="form-control" id="exampleInputPassword2" placeholder="Подтверждение пароля">
      </div>
      <div class="form-group">
        <label for="town">Город</label>
        <input name="town" type="text" class="form-control" id="town" placeholder="Город">
      </div>
      <div class="form-group">
        <label for="stuff">Учебное заведени</label>
        <input name="stuff" type="text" class="form-control" id="stuff" placeholder="Учебное заведение">
      </div>
      <div class="form-group">
        <label for="job">Должность</label>
        <input name="job" type="text" class="form-control" id="ощи" placeholder="Должность">
      </div>
      <!--  <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> -->
      <button type="submit" class="btn btn-primary">Зарегестрироваться</button>
    </form>
  </div>
</div>
@
