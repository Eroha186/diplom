@extends('account/account')

@section('nav')
	@include('account/nav')
@endsection

@section('account-content')

	<div class="part-in-contests">
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

@endsection