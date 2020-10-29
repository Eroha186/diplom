<!doctype html>
<html lang="ru">
<head>
    <title>Авторизация</title>
    @include('styles')
</head>
<body>
@include('header_footer/header')
<section class="login-page">
    <div class="container">
    <h1 class="text-center">Авторизация</h1>
    <div class="row justify-content-center">

        <form method="POST"
              action="{{route('login')}}">
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
            @if(session('error'))
                <div class="alert alert-danger">
                   {{session('error')}}
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
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
                <a class="btn btn-link" id="forgot-password" href="{{ route('password.request') }}">
                    Забыли пароль?
                </a>
            </div>
            <p id="social-sign">Или войдите, используя соц.сети:</p>
            @include('auth.social')
        </form>
    </div>
</div>
</section>
@include('header_footer/footer')
@include('script')
</body>
</html>