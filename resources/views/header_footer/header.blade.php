<header>
	<div class="header-top">
		<div class="container">
			<nav class="row header-top__nav justify-content-between align-items-center" style="position: relative;">
				<a href="/"><img src="{{asset('images/logo.svg')}}" alt="Лого"></a>
				<ul class="{{\Illuminate\Support\Facades\Auth::check() ? (\Illuminate\Support\Facades\Auth::user()->admin == 1 ? 'col-xl-7' : 'col-xl-10') : 'col-xl-8'}} header-top__nav-items">
					<li style="margin-left: 50px;" class="header-top__nav-item {{request()->is('/') ? 'header-top__nav-item_active' : ''}}"><a href="/">Главная</a></li>

				
   
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
				<div class="col-xl-3 ta-center">
			@if(\Illuminate\Support\Facades\Auth::check())
					<div class="my-account">
       <a  href="/account/personal-data"> <img src="{{asset('images/login.svg')}}" alt="" width=""> Мой кабинет</a>     
      <img src="{{asset('images/logout.svg')}}" alt="" width="25">   <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Выход</a>
          </div>
				@else
	<div class="login-and-register"> <img src="{{asset('images/logout.svg')}}" alt="" width="25">  <a href="/register">Регистрация</a> / <a href="/login">Вход</a></div>
			@endif
				@if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->admin == 1)
					<a class="header-top__nav-button col-xl-2 transparent-btn ta-center" href="{{route('a-publication')}}">Админка</a>
				@endif
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