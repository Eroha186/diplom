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

	<section class="main-page__contents">
		<div class="container">
			<div class="contents__wrapper">
				<h2 class="section-title ta-center">Участвуйте и вдохновляйтесь!</h2>
				<div class="row justify-content-center">
					<div class="col-md-6 contents__descr">
						<p class="ta-center margin-bottom-0">Мероприятия проводятся на конкурсной основе. Вы можете участвовать как с детьми, так и в конкурсах среди педагогов и воспитателей.</p>
						<p class="ta-center">Победители определяются в течение 48 часов</p>
					</div>
				</div>
			</div>
		</div>
		<div id="tabs">
			<ul class="tabs">
				<li class="tab tab_active" data-tab="1">Конкурсы</li>
				<li class="tab" data-tab="2">Публикации</li>
			</ul>
			<div class="tab-content tab-content_active" data-tab="1">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-6 contents__descr">
							<p class="ta-center margin-bottom-0">Мероприятия проводятся на конкурсной основе. Вы можете участвовать как с детьми, так и в конкурсах среди педагогов и воспитателей.</p>
							<p class="ta-center">Победители определяются в течение 48 часов</p>
						</div>
					</div>
					@section('competition')
						<div class="competition">
							<div class="competition__img">
								<img src="{{asset('images/skier.png')}}" alt="Обложка">
							</div>
							<div class="competition__descr ta-center">
								<div class="title">
									Новогодняя мастерская - 2019
								</div>
								<div class="name">
									Конкурс поделок
								</div>
								<div class="date-time">
									С 11.11.2011
									<span>по 12.11.2011</span>
								</div>
									<a href="#" class="button transparent-btn">подробнее</a>
							</div>
						</div>
					@endsection
					@for ( $i=0; $i < 4; $i++)
						<div class="row">
							@for ($j=0; $j<2; $j++)
								<div class="col-md-6">
									@yield('competition')
								</div>
							@endfor
						</div>
					@endfor
					<div class="more"><a href="#">Больше конкурсов > ></a></div>
				</div>
			</div>
			<div class="tab-content" data-tab="2">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-6 contents__descr">
							<p class="ta-center margin-bottom-0">Мероприятия проводятся на конкурсной основе. Вы можете участвовать как с детьми, так и в конкурсах среди педагогов и воспитателей.</p>
							<p class="ta-center">Победители определяются в течение 48 часов</p>
						</div>
					</div>
					@section ('publications')
						<div class="publications">
							<div class="publications__img">
								<img src="{{asset('images/text.svg')}}" alt="Иконка">
							</div>
							<div class="publications__descr">
								<a href="#" class="title">
									Конспект занатия в старшей группе по теме: "Воздух и его свойства"
								</a>
								<div class="date-time">
									23.05.2019
								</div>
								<div class="author">
									Иванова А.А., учитель младших классов
								</div>
							</div>
						</div>
					@endsection
					@for ($i=0; $i<6; $i++)
						<div class="row">
							@for ($j=0; $j<2; $j++)
								<div class="col-md-6">
									@yield('publications')
								</div>
							@endfor
						</div>
					@endfor
					<div class="more"><a href="#">Больше публикаций > ></a></div>
				</div>
			</div>
		</div>
	</section>
	<section class="main-page__banner">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<div class="banner__wrap">
						<h2 class="section-title banner__title">Зарегестрируйся на портале и получи 20 бонусов!</h2>
						<div class="banner__button_wrap">
							<a href="" class=" button banner__button transparent-btn">Подробнее</a>
							<a href="" class=" button banner__button filled-btn">Получить бонусы</a>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<img src="{{asset('images/main_page/children-1.png')}}" alt="Ребенок">
				</div>
			</div>
		</div>
	</section>

	<section class="main-page__winner">
		<div class="container">
			<h2 class="section-title ta-center">Поздравляем победителей!</h2>
			<div class="row justify-content-center">
				<div class="col-md-10">
					<div class="winner__desr ta-center">Более 1234 педагогов опубликовались на нашем сайте за последние 2 года. Спасибо вам за даверие! Мы, в свою очередь, гарантируем прозрачность
						проведенеия конкурсов и оперативное получение дипломов и сертификатов!
					</div>
				</div>
			</div>
			<div class="winner__result">
				@section ('winers')
					<div class="winer-block">
						<div class="col-winer-block__img">
							<div class="winer-block__img" style="background: url('{{asset('images/skier.png')}}') center no-repeat;">
								<div class="mask">
									<a href="">
										<div class="mask-btn">
											<i class="fa fa-eye"></i>
											<span>Подробнее</span>
										</div>
									</a>
								</div>
							</div>
						</div>
						<div class="winer-block__info">
							<img src="{{asset('images/main_page/services-icon-1.png')}}" alt="Иконка">
							<a href="" class="name">Зимние забавы</a>
							<div class="date-time">Сроки проведения: <span>01.01.2019-04.04.2019</span></div>
							<div class="descr">Международный конкурс детского рисунка на тему зимних видов спорта</div>
							<a href="#" class="button transparent-btn">Результаты</a>
						</div>
					</div>
				@endsection
				<div class="winners">
					@for ($i = 0; $i < 4; $i++)
						<div class="row">
							@for ($j = 0; $j < 2; $j++)
								<div class="col-md-6">
									@yield('winers')
								</div>
							@endfor
						</div>
					@endfor
				</div>
			</div>
			<div class="more"><a href="#">Перейти в архив конкурсов > ></a></div>
		</div>
	</section>

	<section class="main-page__questions">
		<div class="container">
			<h2 class="section__title ta-center">Часто задаваемые вопросы</h2>
			<div class="questions__acord-wrap">
				<div class="questions__acord">
					<div class="head">
						<div class="arrow"></div>
						<div class="title "><span>Сколько стоит участие в конкурсе?</span></div>
					</div>
					<div class="body">
						Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет
					</div>
				</div>
				<div class="questions__acord">
					<div class="head">
						<div class="arrow"></div>
						<div class="title "><span>Как я могу скачать свой сертификат?</span></div>
					</div>
					<div class="body">
						Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет
					</div>
				</div>
				<div class="questions__acord">
					<div class="head">
						<div class="arrow"></div>
						<div class="title "><span>Как разместить публикацию на сайте?</span></div>
					</div>
					<div class="body">
						Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет
					</div>
				</div>
				<div class="questions__acord">
					<div class="head">
						<div class="arrow"></div>
						<div class="title "><span>Сертификат будет один на ребенка и преподавателя?</span></div>
					</div>
					<div class="body">
						Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет
					</div>
				</div>
				<div class="questions__acord">
					<div class="head">
						<div class="arrow"></div>
						<div class="title "><span>Кто может участвовать в конкурсе?</span></div>
					</div>
					<div class="body">
						Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет
					</div>
				</div>
				<div class="questions__acord">
					<div class="head">
						<div class="arrow"></div>
						<div class="title "><span>Сколько конкурсов проводится ежемесячно?</span></div>
					</div>
					<div class="body">
						Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет
					</div>
				</div>
				<div class="questions__acord">
					<div class="head">
						<div class="arrow"></div>
						<div class="title "><span>Какие тематики статей принимаются к публикации?</span></div>
					</div>
					<div class="body">
						Ответ ОтветОтветОтвет Ответ ОтветОтветОтветОтветОтвет Ответ Ответ ОтветОтвет Ответ ОтветОтвет
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="main-page__surprise">
		<div class="container">
			<h2 class="section-title ta-center">Подарок для вас!</h2>
			<div class="sub-title ta-center">Получите 50 бонусных рублей для <span>оплаты публикации</span></div>
			<img src="{{asset('images/main_page/form-img.png')}}" alt="Дети">
		</div>
	</section>

	<div class="main-page__form">
		<div class="container">
			<h2 class="section-title ta-center">Подпишитесь на расслыку обновлений</h2>
			<p class="ta-center">Баллы будут зачислены на Ваш бонусный счет</p>
			<form action="" class="main-form">
				<div class="row">
					<div class="col-md-4">
						<span>Ваше имя</span>
						<input type="text" placeholder="Ваше имя">
					</div>
					<div class="col-md-4">
						<span>Ваш email</span>
						<input type="text" placeholder="Ваш email">
					</div>
					<div class="col-md-4">
						<span>Ваш телефон</span>
						<input type="text" placeholder="Ваш телефон">
					</div>
				</div>
				<div class="ta-center">
					<button class="button transparent-btn">Отправить</button>
				</div>
				<img src="{{asset('images/main_page/airplane.png')}}" alt="">
			</form>
		</div>
	</div>

	@include('script')
</body>
</html>

