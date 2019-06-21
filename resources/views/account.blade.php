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
								<li class="nav-item tab nav-item_active"><span>Личные данные</span></li>
								<li class="nav-item"><a href="#">Выход</a></li>
							</ul>
						</div>
						<div class="nav-block">
							<ul>
								<li class="nav-item tab"><span>Мои публикации</span></li>
								<li class="nav-item tab"><span>Экспресс конкурсы</span></li>
								<li class="nav-item tab"><span>Участие в конкурсах</span></li>
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
					<div class="account__content">
						<div class="personal-data">
							<h2 class="section-title">
								Личные данные
							</h2>
							<form action="" class="personal-data__form">
								<div class="fio">
									<div class="fio-block">
										<p>Фамилия</p>
										<input type="text">
									</div>
									<div class="fio-block">
										<p>Имя</p>
										<input type="text">
									</div>
									<div class="fio-block">
										<p>Отчество</p>
										<input type="text">
									</div>
								</div>
								<p>Должность</p>
								<input type="text">
								<p>E-mail</p>
								<input type="text">
								<p>Наименования образовательного учреждения</p>
								<input type="text">
								<p>Населенный пункт</p>
								<input type="text">
								<button class="button filled-btn">Сохранить</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	@include('script')
</body>
</html>