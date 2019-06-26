@extends('account/account')

@section('nav')
	@include('account/nav')
@endsection

@section('account-content')

	<div class="my-publications">
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
					<th class="partcipation">Участие в конкурсах</th>
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

@endsection