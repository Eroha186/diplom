@extends('account/account')

@section('nav')
	@include('account/nav')
@endsection

@section('account-content')

	<div class="part-in-contests">
		<h2 class="section-title">
			Участие в конкурсах
		</h2>
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
				@foreach ($works as $work)
					<tr>
						<td class="number ta-center">{{$loop->iteration}}</td>
						<td class="date-time ta-center">{{$work->date_add}}</td>
						<td class="name-work"><a href="#" class="standart-link">{{$work->title}}</a></td>
						<td class="name-contest"><a href="#" class="standart-link">{{$work->competition->title}}</a></td>
						<td class="author ta-center">{{$work->fc}} {{$work->ic}}.{{$work->oc}}.</td>
						<td class="head ta-center">{{$work->user->f}} {{$work->user->i}}.{{$work->user->o}}.</td>
						<td class="status ta-center">Модерация</td>
						<td class="ta-center"><a href="#" class="button download-button">Скачать</a></td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>

@endsection