<!doctype html>
<html lang="ru">
<head>
  <title>Регистрация</title>
  @include('styles')
</head>
<body>
@include('header_footer/header')
<div class="container">
  <div class="row justify-content-center">
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="POST" action="{{route('register')}}">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="exampleInputF">Фамилия</label>
        <input name="f" type="text" class="form-control" id="exampleInputF" aria-describedby="emailHelp"
               placeholder="Фамилия" value="{{old('f')}}" required>
        <label for="exampleInputI">Имя</label>
        <input name="i" type="text" class="form-control" id="exampleInputI" aria-describedby="emailHelp"
               placeholder="Имя" value="{{old('i')}}" required>
        <label for="exampleInputO">Отчество</label>
        <input name="o" type="text" class="form-control" id="exampleInputO" aria-describedby="emailHelp"
               placeholder="Отчество" value="{{old('o')}}" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">E-mail</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
               placeholder="E-mail" value="{{old('email')}}" required>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Пароль</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль"
               required>
      </div>
      <div class="form-group">
        <label for="confirm_password">Повторите пароль</label>
        <input name="password_confirmation" type="password" class="form-control" id="confirm_password"
               placeholder="Подтверждение пароля" required>
      </div>
      <div class="form-group">
        <label for="town">Город</label>
        <input name="town" type="text" class="form-control" id="town" placeholder="Город" value="{{old('town')}}"
               required>
      </div>
      <div class="form-group">
        <label for="stuff">Учебное заведени</label>
        <input name="stuff" type="text" class="form-control" id="stuff" placeholder="Учебное заведение"
               value="{{old('stuff')}}" required>
      </div>
      <div class="form-group">
        <label for="job">Должность</label>
        <input name="job" type="text" class="form-control" id="ощи" placeholder="Должность" value="{{old('job')}}"
               required>
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
