<header>
	<div class="header-top">
		<div class="container">
			<nav class="row header-top__nav">
				<ul class="{{\Illuminate\Support\Facades\Auth::check() ? 'col-xl-10'  : 'col-xl-8'}} header-top__nav-items">
					<li class="header-top__nav-item {{request()->is('/') ? 'header-top__nav-item_active' : ''}}"><a href="/">Главная</a></li>
					<li class="header-top__nav-item {{request()->is('competitions') ? 'header-top__nav-item_active' : ''}}"><a href="/competitions">Конкурсы</a></li>
					<li class="header-top__nav-item  {{request()->is('archive-competitions') ? 'header-top__nav-item_active' : ''}} "><a href="/archive-competitions">Архив конкурсов</a></li>
					<li class="header-top__nav-item {{request()->is('publications') ? 'header-top__nav-item_active' : ''}} "><a href="/publications">Публикации</a></li>
				</ul>
				@if(\Illuminate\Support\Facades\Auth::check())
					<a class="header-top__nav-button col-xl-2 transparent-btn" href="/account/personal-data">Личный кабинет</a>
				@else
					<a class="header-top__nav-button col-xl-2 transparent-btn ta-center" href="/login">Авторизация</a>
					<a class="header-top__nav-button col-xl-2 transparent-btn  ta-center" href="register">Регистрация</a>
				@endif
			</nav>
		</div>
	</div>
	<div class="header-bottom">
		<div class="container">
			<div class="row justify-content-center">
				<img src="{{asset('images/logo.png')}}" alt="logo">
			</div>
		</div>
	</div>
</header>