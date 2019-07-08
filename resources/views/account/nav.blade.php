
	<div class="account__nav">
		<div class="nav-block">
			<div class="profile">
				<img src="{{asset('images/avatar.svg')}}" alt="Аватар">
				<div class="page-name">
					<span>Мария</span>
					<span>Ивановна</span>
				</div>
			</div>
			<ul>
				<li class="nav-item {{request()->is('account/personal-data') ? 'nav-item_active': ''}}"><a href="/account/personal-data">Личные данные</a></li>
				<li class="nav-item"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Выход</a>	</li>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
					{{ csrf_field()}}
				</form>
			</ul>
		</div>
		<div class="nav-block">
			<ul>
				<li class="nav-item {{request()->is('account/my-publication') ? 'nav-item_active': ''}}"><a href="/account/my-publication">Мои публикации</a></li>
				<li class="nav-item"><span>Экспресс конкурсы</span></li>
				<li class="nav-item {{request()->is('account/part-in-contests') ? 'nav-item_active': ''}}"><a href="/account/part-in-contests">Участие в конкурсах</a></li>
			</ul>
		</div>
		<div class="nav-block">
			<div class="title">Бонусныый счет</div>
			<div class="coin">
				<div class="more-coin">30</div>
				<img src="{{asset('images/coin.svg')}}" alt="монетка">
			</div>
			<a href="#" class="question-coin">Как использовать бонусы?</a>
		</div>
	</div>
