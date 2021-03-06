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
    <div class="col-xl-8 col-xl-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
          <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} ">
              <label for="email" class="col-xl-4 control-label">E-Mail Address</label>
              <div class="col-xl-8">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <div class="col-xl-6">
                <button type="submit" class="btn btn-primary">
                  Отправить ссылку для сброса пароля
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>