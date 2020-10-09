<header>
	<div class="header-top">
		<div class="container">
			<nav class="row header-top__nav  align-items-center" style="position: relative;">
				<div class="col-xl-2 col-lg-2 col-sm-2 col-md-2 col-2">
      <a href="/"><img src="{{asset('images/logo.svg')}}" alt="Лого"></a>    
        </div>
				<ul class="col-xl-7 col-lg-7 d-none d-lg-flex header-top__nav-items">
					<li  class="header-top__nav-item {{request()->is('/') ? 'header-top__nav-item_active' : ''}}"><a href="/">Главная</a></li>
					<li class="header-top__nav-item dropdown {{request()->is('competitions') ? 'header-top__nav-item_active' : ''}}"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Конкурсы
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/competitions">Список конкурсов</a>
          <a class="dropdown-item" href="/archive-competitions">Архив конкурсов</a>
          <a class="dropdown-item" href="/form-competition">Добавить работу</a>
        </div> </li>
						<li class="header-top__nav-item dropdown {{request()->is('') ? 'header-top__nav-item_active' : ''}}"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Публикации
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/publications">Список публикаций</a>
          <a class="dropdown-item" href="#">Архив публикаций</a>
          <a class="dropdown-item" href="/form-publication">Добавить работу</a>
        </div> </li>
						<li class="header-top__nav-item dropdown {{request()->is('') ? 'header-top__nav-item_active' : ''}}"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Экспресс-конкурсы
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/express-competitions">Список экспресс-конкурсов</a>
          <a class="dropdown-item" href="#">Архив экспресс-конкурсов</a>
          <a class="dropdown-item" href="">Добавить работу</a>
        </div> </li>
					<li class="header-top__nav-item {{request()->is('') ? 'header-top__nav-item_active' : ''}} "><a href="">Помощь</a></li>
				</ul>
				<div class="col-xl-3 col-lg-3 col-md-3 ta-center">
			@if(\Illuminate\Support\Facades\Auth::check())
					<div class="my-account">
       <a  href="/account/personal-data"> <img src="{{asset('images/login.svg')}}" alt="" width=""> Мой кабинет</a>     
      <img src="{{asset('images/logout.svg')}}" alt="" width="25">   <a href="{{ route('logout') }}" >Выход</a>
          </div>
				@else
	<div class="login-and-register"> <img src="{{asset('images/logout.svg')}}" alt="" width="25">  <a href="/register">Регистрация</a> / <a href="/login">Вход</a></div>
			@endif
				@if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->admin == 1)
					<a class="admin-button header-top__nav-button col-xl-2 transparent-btn ta-center" href="{{route('a-publication')}}">Админка</a>
				@endif
        
        </div>
        <button class="hamburger hamburger--elastic d-lg-none" type="button">
  <span class="hamburger-box">
    <span class="hamburger-inner"></span>
  </span>
</button>
<div class="mmenu">
  <ul class="header-top__nav-items">
          <li  class="header-top__nav-item {{request()->is('/') ? 'header-top__nav-item_active' : ''}}"><a href="/">Главная</a></li>
          <li class="header-top__nav-item dropdown {{request()->is('competitions') ? 'header-top__nav-item_active' : ''}}"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Конкурсы
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/competitions">Список конкурсов</a>
          <a class="dropdown-item" href="/archive-competitions">Архив конкурсов</a>
          <a class="dropdown-item" href="/form-competition">Добавить работу</a>
        </div> </li>
            <li class="header-top__nav-item dropdown {{request()->is('') ? 'header-top__nav-item_active' : ''}}"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Публикации
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/publications">Список публикаций</a>
          <a class="dropdown-item" href="#">Архив публикаций</a>
          <a class="dropdown-item" href="/form-publication">Добавить работу</a>
        </div> </li>
            <li class="header-top__nav-item dropdown {{request()->is('') ? 'header-top__nav-item_active' : ''}}"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Экспресс-конкурсы
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/express-competitions">Список экспресс-конкурсов</a>
          <a class="dropdown-item" href="#">Архив экспресс-конкурсов</a>
          <a class="dropdown-item" href="">Добавить работу</a>
        </div> </li>
          <li class="header-top__nav-item {{request()->is('') ? 'header-top__nav-item_active' : ''}} "><a href="">Помощь</a></li>
        </ul>
</div>
			</nav>
		</div>
	</div>
{{--	<div class="header-bottom">--}}
{{--		<div class="container">--}}
{{--			<div class="row justify-content-center">--}}
{{--				<img src="{{asset('images/logo.png')}}" alt="logo">--}}
{{--			</div>--}}
{{--		</div>--}}
{{--	</div>--}}
</header>