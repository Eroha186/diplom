<!doctype html>
<html lang="ru">
	<head>
		<title>Конкурсы</title>
		@include('styles')
	</head>
	<body>
	@include('header_footer/header')

	<section class="publications__main bg-arch">
		<div class="container">
			<h2 class="section-title">
				Текущие конкурсы
			</h2>
			<div class="row">
				<div class="col-md-6 competitions__descr">
					В настоящем разделе представлены актуальные конкурсы, на которые осуществляется прием заявок на участие. Участвуйте вместе с детьми и в конкурсах для педагогов на участие. Участвуйте вмместе с детьми и в конкурсах для педагогов!
				</div>
				<div class="cake">
					<img src="{{asset('/images/cake.png')}}" alt="Пироженое">
				</div>
			</div>
		</div>
	</section>

	<section class="publications-filtres filtres">
		<div class="container">
			{!!Breadcrumbs::render('competitions')!!}
			<div class="row">
				<div class="col-md-3">
					<a href="" class="publish-publication">Опубликовать работу</a>
				</div>
			</div>
			<h2 class="section-title">Творческие и учебные материалы</h2>
			<div class="row select-filter">
				<div class="col-md-3"><select name="" id=""></select></div>
				<div class="col-md-3"><select name="" id=""></select></div>
				<div class="col-md-3"><select name="" id=""></select></div>
				<div class="col-md-2"><select name="" id=""></select></div>
			</div>
			<div class="row">
				<div class="col-md-11">
					<div class="search-wrap">
						<input class="search-competitions" type="text" placeholder="Поиск по конкурсам">
					</div>
				</div>
			</div>
			<div class="filter">
				Сортировать по:
				<div class="placement-date">
					<span class="filter-name"  data-condition="1">по дате размещения </span> <span class="arrow-down">&darr;</span> <span class="arrow-up">&uarr;</span>
				</div>
				<div class="fiteres-name">
					<span class="filter-name"  data-condition="1">имени </span> <span class="arrow-down">&darr;</span> <span class="arrow-up">&uarr;</span>
				</div>
			</div>
		</div>
	</section>

	<section class="publications-list">
		<div class="container">
			<div class="row p15">
				<div class="col-md-12 publication-card">
					<div class="row">
						<div class="col-md-10">
							<div class="publication-card__title"><a href="#">	Конспект занатия в старшей группе по теме: "Воздух и его свойства"</a></div>
						</div>
					</div>
					<div class="publish-card__date">Опублековано 24.05.2019</div>
					<div class="row">
						<div class="col-md-10">
							<div class="publication-card__author">Автор Иванова А.И., учитель младших классов, г.Растов на Дону, Детский сад №24</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-10">
							<div class="publication-card__descr">Данное занятие развивает у детей позновательный интерес, через знакомоство с техникой проведения опытов с воздухом</div>
						</div>
					</div>
					<div class="publication-card__img">
						<div class="img">
						</div>
					</div>
					<div class="publication-card__teg">
						тут тег
					</div>
				</div>
			</div>
		</div>
	</section>

	@include('script')
	</body>
</html>


