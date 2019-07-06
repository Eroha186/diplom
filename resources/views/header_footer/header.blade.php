<header>
	<div class="header-top">
		<div class="container">
			<nav class="row header-top__nav">
				<ul class="col-md-10 header-top__nav-items">
					<li class="header-top__nav-item {{request()->is('/') ? 'header-top__nav-item_active' : ''}}"><a href="/">Главная</a></li>
					<li class="header-top__nav-item {{request()->is('competitions') ? 'header-top__nav-item_active' : ''}}"><a href="/competitions">Конкурсы</a></li>
					<li class="header-top__nav-item  {{request()->is('archive-competitions') ? 'header-top__nav-item_active' : ''}} "><a href="/archive-competitions">Архив конкурсов</a></li>
					<li class="header-top__nav-item {{request()->is('publications') ? 'header-top__nav-item_active' : ''}} "><a href="/publications">Публикации</a></li>
				</ul>
				@if(!(request()->is('login') || request()->is('register')))
					<a class="header-top__nav-button col-md-2 transparent-btn" href="/account/personal-data">Личный кабинет</a>
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