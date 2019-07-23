<!doctype html>
<html lang="ru">
<head>
	<title>Конкурсы</title>
	@include('styles')
</head>
<body>
  @include('header_footer/header')
  <section class="competitions__main bg-arch">
	  <div class="container">
			<h2 class="section-title">
				Текущие конкурсы
			</h2>
		  <div class="row">
			  <div class="col-xl-6 competitions__descr">
				  В настоящем разделе представлены актуальные конкурсы, на которые осуществляется прием заявок на участие. Участвуйте вместе с детьми и в конкурсах для педагогов на участие. Участвуйте вмместе с детьми и в конкурсах для педагогов!
			  </div>
			  <div class="cake">
				  <img src="{{asset('/images/cake.png')}}" alt="Пироженое">
			  </div>
		  </div>
	  </div>
  </section>
  <section class="filtres">
	  <div class="container">
		  {!!Breadcrumbs::render('competitions')!!}
		  <h2 class="section-title">Перечь актуальных конкурсов</h2>
		  <div class="row">
			  <div class="col-xl-11">
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
			  <div class="duration-event">
				  <span class="filter-name"  data-condition="1">длительность проведения</span> <span class="arrow-down">&darr;</span> <span class="arrow-up">&uarr;</span>
			  </div>
			  <div class="completion_date"> <span class="filter-name" data-condition="1">дата завершения</span> <span class="arrow-down">&darr;</span> <span class="arrow-up">&uarr;</span></div>
		  </div>
	  </div>
  </section>
  <section class="competitions-list">
		<div class="container">
			@for ( $i=0; $i < 4; $i++)
				<div class="row">
					@for ($j=0; $j<2; $j++)
						<div class="col-xl-6">
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
									<a href="/competitions/{{$j + $i}}" class="button transparent-btn">подробнее</a>
								</div>
							</div>
						</div>
					@endfor
				</div>
			@endfor
		</div>
  </section>
	@include('script')
</body>
</html>
