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
        <form style="transform: translateY(50%);">
            <div class="form-group">
                <label for="exampleInputEmail1">E-mail</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите ваш e-mail">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Пароль</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Введите пароль">
            </div>
          <!--  <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
</div>
    @include('script')
</body>
</html>