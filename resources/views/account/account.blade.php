<!doctype html>
<html lang="ru">
<head>
	<title>Личный кабинет</title>
	@include('styles')
</head>
<body>
	@include('header_footer.header')

	<section class="account__main">
		<div class="container">
			<div class="row justify-content-center">
				<div class="account col-md-12">
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
								<li class="nav-item {{request()->is('account/personal-data')? 'nav-item_active': ''}}"><a href="/account/personal-data">Личные данные</a></li>
								<li class="nav-item"><a href="#">Выход</a></li>
							</ul>
						</div>
						<div class="nav-block">
							<ul>
								<li class="nav-item tab" data-tab="2"><span>Мои публикации</span></li>
								<li class="nav-item tab" data-tab="3"><span>Экспресс конкурсы</span></li>
								<li class="nav-item tab" data-tab="4"><span>Участие в конкурсах</span></li>
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
					@section('account__content')
						<div class="account__content">

						</div>
					@endsection
				</div>
			</div>
		</div>
	</section>
	<div class="my-publications tab-content" data-tab="2">
		<h2 class="section-title">
			Мои публикации
		</h2>
		<div class="table-publication">
			<table class="publication">
				<tr class="table-title">
					<th class="number">№</th>
					<th class="date-time">Дата добавления</th>
					<th class="name-publication">Название работы</th>
					<th class="author">Автор</th>
					<th class="status">Статус</th>
					<th class="certificate">Сертификат публикации СМИ</th>
					<th class="participation">Участие в конкурсах</th>
				</tr>
				@section('publication')
					<tr>
						<td class="number ta-center">1</td>
						<td class="date-time ta-center">21.02.2018</td>
						<td><a href="#" class="name-publication standart-link">Коспект занятия в старшей группе по теме: "Воздух  и его свойства"</a></td>
						<td class="author ta-center">Иванова М.А.</td>
						<td class="status ta-center">Модерация</td>
						<td class="certificate ta-center"><a href="#" class="button download-button">Скачать</a></td>
						<td class="participation ta-center"><a href="#" class="button participation-button">Участвовать</a></td>
					</tr>
				@endsection
				@for($i=0; $i<10; $i++)
					@yield('publication')
				@endfor
			</table>
		</div>
	</div>
	<div class="part-in-contests tab-content" data-tab="4">
		<h2 class="section-title">
			Участие в конкурсах
		</h2>
		@section('contests')
			<tr>
				<td class="number ta-center">1</td>
				<td class="date-time ta-center">21.02.2018</td>
				<td class="name-work"><a href="#" class="standart-link">Катись колобок!</a></td>
				<td class="name-contest"><a href="#" class="standart-link">Новогодняя мастерская - 2019</a></td>
				<td class="author ta-center">Иванова М.А.</td>
				<td class="head ta-center">Гусев М.А.</td>
				<td class="status ta-center">Модерация</td>
				<td class="ta-center"><a href="#" class="button download-button">Скачать</a></td>
			</tr>
		@endsection
		<div class="table-publication">
			<table class="publication">
				<tr class="table-title">
					<th class="number">№</th>
					<th class="date-time">Дата добавления</th>
					<th class="name-work">Название работы</th>
					<th class="name-pcontest">Конкурс</th>
					<th class="author">Автор</th>
					<th class="head">Руководитель</th>
					<th class="status">Статус</th>
					<th class="certificate-contest">Диплом</th>
				</tr>
				@for($i=0; $i<5; $i++)
					@yield('contests')
				@endfor
			</table>
		</div>
	</div>
	@include('script')
</body>
</html>