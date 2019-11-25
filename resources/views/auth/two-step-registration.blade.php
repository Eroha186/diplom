<!doctype html>
<html lang="ru">
<head>
  <title>Авторизация</title>
  @include('styles')
</head>
<body>
@include('header_footer/header')
<form action="" style="max-width: 350px; margin: auto 0">
  <div class="form-group">
    <label for="exampleInputEmail1">E-mail</label>
    <input name="email" type="email" class="form-control" id="exampleInputEmail1"
           aria-describedby="emailHelp"
           placeholder="Введите ваш e-mail" value="{{old('email')}}">
  </div>
  <button type="submit" class="btn btn-primary">Потвердить e-mail</button>
</form>
@include('script')
</body>
</html>
