<!doctype html>
<html lang="ru">
<head>
  <title>Авторизация</title>
  @include('styles')
</head>
<body>
@include('header_footer/header')
<div class="container">
  <form action="{{route('add-email')}}" method="POST" style="max-width: 350px; margin-left: 50%; transform: translateX(-50%)">
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
    {{ csrf_field() }}
    <div class="form-group">
      <label for="exampleInputEmail1">E-mail</label>
      <input name="email" type="email" class="form-control" id="exampleInputEmail1"
             aria-describedby="emailHelp"
             placeholder="Введите ваш e-mail">
    </div>
    <button type="submit" class="btn btn-primary">Потвердить e-mail</button>
  </form>
</div>
@include('script')
</body>
</html>
