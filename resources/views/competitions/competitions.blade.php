<!doctype html>
<html lang="ru">
<head>
	<title>Конкурсы</title>
	@include('styles')
</head>
<body>
  @include('header_footer/header')
  <section class="competitions__main">
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
  <section class="competitions-list">
		<div class="container">
			{!!Breadcrumbs::render('competitions')!!}
			<h2 class="section-title">Перечь актуальных конкурсов</h2>
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
					<span class="filter-name"  data-condition="1">По дате размещения </span> <span class="arrow-down">&darr;</span> <span class="arrow-up">&uarr;</span>
				</div>
				<div class="duration-event">
					<span class="filter-name"  data-condition="1">Длительность проведения</span> <span class="arrow-down">&darr;</span> <span class="arrow-up">&uarr;</span>
				</div>
				<div class="completion_date"> <span class="filter-name" data-condition="1">Дата заверщения</span> <span class="arrow-down">&darr;</span> <span class="arrow-up">&uarr;</span></div>
			</div>
		</div>
  </section>
	@include('script')
</body>
</html>
