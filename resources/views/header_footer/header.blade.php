<header>
	<div class="header-top">
		<div class="container">
			<nav class="row header-top__nav justify-content-between" style="position: relative;">
				<img src="{{asset('images/logo1.png')}}" alt="Лого" style="position: absolute; top: 10%; height: 90%;">
				<ul class="{{\Illuminate\Support\Facades\Auth::check() ? (\Illuminate\Support\Facades\Auth::user()->admin == 1 ? 'col-xl-8' : 'col-xl-10') : 'col-xl-8'}} header-top__nav-items">
					<li style="margin-left: 210px;" class="header-top__nav-item {{request()->is('/') ? 'header-top__nav-item_active' : ''}}"><a href="/">Главная</a></li>
					<li class="header-top__nav-item {{request()->is('competitions') ? 'header-top__nav-item_active' : ''}}"><a href="/competitions">Конкурсы <i class="fa fa-caret-down"></i></a></li>
					<li class="header-top__nav-item {{request()->is('publications') ? 'header-top__nav-item_active' : ''}} "><a href="/publications">Публикации <i class="fa fa-caret-down"></i></a></li>
					<li class="header-top__nav-item {{request()->is('express-competitions') ? 'header-top__nav-item_active' : ''}} "><a href="/express-competitions">Экспресс конкурсы <i class="fa fa-caret-down"></i></a></li>
					<li class="header-top__nav-item {{request()->is('') ? 'header-top__nav-item_active' : ''}} "><a href="">Помощь</a></li>
				</ul>
				<a class="col-xl-2 ta-center" style="font-size: 15px; font-family: Roboto; font-weight: 100;" href="/login"><img src="{{asset('images/door2.png')}}" alt="Лого" style="position: absolute; top: 0; height: 90%; left: 0;"> Регистрация / Вход</a>
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