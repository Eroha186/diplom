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
						<td class="name-work"><a href="{{ route("competition-work", ['id' => $work->competition->id, 'workId' => $work->id]) }}" class="standart-link">{{$work->title}}</a></td>
						<td class="name-contest"><a href="{{ route('competition', ['id' => $work->competition->id]) }}" class="standart-link">{{$work->competition->title}}</a></td>
						<td class="author ta-center">{{$work->fc}} {{$work->ic}}.{{$work->oc}}.</td>
						<td class="head ta-center">{{$work->user->f}} {{$work->user->i}}.{{$work->user->o}}.</td>
						<td class="status ta-center">
							@switch($work->moderation)
								@case(0)
									Проверяется
									@break
								@case(1)
									Отклонена
									@break
								@case(2)
									Приянта
									@break
							@endswitch
						</td>
						<td class="ta-center">
							@if(is_null($work->diplom) || $work->diplom->payment == 0)
								<a href="{{ route('payment-from-account', ['workId' => $work->id, 'type' => "work"]) }}" class="button participation-button">Заказать</a>
							@else
								<a href="{{ route('diplom-generate', ['typeWork' => $work->diplom->type, 'workId' => $work->diplom->work_id]) }}" class="button download-button">Скачать</a>
							@endif
						</td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>

@endsection