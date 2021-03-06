
	<div class="account__nav">
		<div class="nav-block">
			<div class="profile">
				<img src="{{asset('images/avatar.svg')}}" alt="Аватор">
				<div class="page-name">
					<span>{{$data['i']}}</span>
					<span>{{$data['o']}}</span>
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
				<li class="nav-item {{request()->is('account/my-express-competition') ? 'nav-item_active': ''}}"><a href="/account/my-express-competition">Экспресс конкурсы</a></li>
				<li class="nav-item {{request()->is('account/part-in-contests') ? 'nav-item_active': ''}}"><a href="/account/part-in-contests">Участие в конкурсах</a></li>
			</ul>
		</div>
		<div class="nav-block">
			<div class="title">Бонусный счет</div>
			<div class="coin">
				<div class="more-coin">{{$data['coins']}}</div>
				<img src="{{asset('images/coin.svg')}}" alt="монетка">
			</div>
			<a href="#" class="question-coin">Как использовать бонусы?</a>
		</div>
		<a href="{{route('no-mailing', ['hash' => Auth::user()->hash])}}" class="no-mailing">Отписаться от рассылки</a>
	</div>
