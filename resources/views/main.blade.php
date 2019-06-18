<!doctype html>
<html lang="ru">
<head>
	<title>Главная страница</title>
	@include('styles')
</head>
<body>
	@include('header_footer.header')
	<section class="main-page__main">
		<div class="container">
			<div class="row">
				<div class="_diploms-img col-md-3">
					<img src="{{asset('images/main_page/diplom.png')}}" alt="diplom" class="_diplom-1">
				</div>
			</div>
			<div class="row">
				<div class="main-descr col-md-7">
					<ul class="main-descr__items">
						<li class="main-descr__item">Публикации во всероссийском СМИ</li>
						<li class="main-descr__item">Конкурсы для педагогов и детей</li>
						<li class="main-descr__item">Материалы для школы и детского сада</li>
						<li class="main-descr__item">Дипломы и сертификаты от 2х дней</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<section class="main-page__descr">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<h2 class="section-title">О портале</h2>
					<p>Образовательный портал им. С. Я. Маршака является Средством Массовой Информации(СМИ) ЭЛ № ФС 77-666666</p>
					<p>На нашем портале вы можете стать участником и призером Дистанционных конкурсов Всероссийского и Международного уровня среди детей дошкольного и школьного возраста, педагогов и воспеталей</p>
					<p>Педагоги могут опубликовать учебно-методические разработки и получить Свидетельство о публикации для аттестации</p>
					<p>За участие в конкурсах все участники получают Сертификаты, а победители и лауреанты &mdash; Диипломы победителей</p>
					<p>Дипломы и сертификаты отправляются на элюпочту, а также размещаются в Личном кабинете</p>
				</div>
				<div class="col-md-5">
					<div class="main-page__img">
						<img src="{{asset('images/main_page/inn.png')}}" alt="inn">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="statbar">
						<div class="statbar__symbol green">80+</div>
						<div class="statbar__title">Педагогов</div>
						<div class="statbar__descr">Сотрудничают с нами на постоянной основе</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="statbar">
						<div class="statbar__symbol orange">169</div>
						<div class="statbar__title">Публикаций</div>
						<div class="statbar__descr">Размещенно на нашем ресурсе за предыдущий месяц</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="statbar">
						<div class="statbar__symbol yellow">500+</div>
						<div class="statbar__title">Конкурсов</div>
						<div class="statbar__descr">Проводится ежегодно на нашем образовательном портале</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="statbar">
						<div class="statbar__symbol blue">48</div>
						<div class="statbar__title">Часов</div>
						<div class="statbar__descr">Победители определяются в течение 48 ч после завершения конкурса!</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="contents">
		<div class="container">

		</div>
	</section>

	@include('script')
</body>
</html>