<header>
	<div class="header-top">
		<div class="container">
			<nav class="row header-top__nav justify-content-between align-items-center" style="position: relative;">
				<a href="/"><img src="{{asset('images/logo.svg')}}" alt="Лого"></a>
				<ul class="{{\Illuminate\Support\Facades\Auth::check() ? (\Illuminate\Support\Facades\Auth::user()->admin == 1 ? 'col-xl-8' : 'col-xl-10') : 'col-xl-8'}} header-top__nav-items">
					<li style="margin-left: 50px;" class="header-top__nav-item {{request()->is('/') ? 'header-top__nav-item_active' : ''}}"><a href="/">Главная</a></li>

				
   
					<li class="header-top__nav-item dropdown {{request()->is('competitions') ? 'header-top__nav-item_active' : ''}}"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Конкурсы
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/competitions">Список конкурсов</a>
          <a class="dropdown-item" href="#">Архив конкурсов</a>
          <a class="dropdown-item" href="#">Добавить работу</a>
        </div> </li>
						<li class="header-top__nav-item dropdown {{request()->is('competitions') ? 'header-top__nav-item_active' : ''}}"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Публикации
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/publications">Список публикаций</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div> </li>
						<li class="header-top__nav-item dropdown {{request()->is('competitions') ? 'header-top__nav-item_active' : ''}}"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Экспресс-конкурсы
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div> </li>
					<li class="header-top__nav-item {{request()->is('') ? 'header-top__nav-item_active' : ''}} "><a href="">Помощь</a></li>
				</ul>
				<a class="col-xl-2 ta-center login" style="font-size: 15px; font-family: Roboto; font-weight: 100;" href="/login"><img src="{{asset('images/logout.svg')}}" alt="" width="25" style="position: absolute; top: 0; height: 90%; left: 0;"> Регистрация / Вход</a>
{{--				@if(\Illuminate\Support\Facades\Auth::check())--}}
{{--					<a class="header-top__nav-button col-xl-2 transparent-btn" href="/account/personal-data">Личный кабинет</a>--}}
{{--				@else--}}
{{--					<a class="header-top__nav-button col-xl-2 transparent-btn ta-center" href="/login">Авторизация</a>--}}
{{--					<a class="header-top__nav-button col-xl-2 transparent-btn  ta-center" href="register">Регистрация</a>--}}
{{--				@endif--}}
{{--				@if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->admin == 1)--}}
{{--					<a class="header-top__nav-button col-xl-2 transparent-btn ta-center" href="{{route('a-publication')}}">Админка</a>--}}
{{--				@endif--}}
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