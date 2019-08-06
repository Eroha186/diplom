@extends('account/account')

@section('nav')
	@include('account/nav')
@endsection

@section('account-content')
		<div class="personal-data">
			<h2 class="section-title">
				Личные данные
			</h2>
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<form action="{{route('personal-data')}}" method="POST" class="personal-data__form">
        {{ csrf_field() }}
				<div class="fio">
					<div class="fio-block">
						<p>Фамилия</p>
						<input name="f" class="input-style" type="text" placeholder="Иванов" value="{{$data->f}}">
					</div>
					<div class="fio-block">
						<p>Имя</p>
						<input name="i" class="input-style" type="text" placeholder="Иван" value="{{$data->i}}">
					</div>
					<div class="fio-block">
						<p>Отчество</p>
						<input name="o" class="input-style" type="text" placeholder="Иванович" value="{{$data->o}}">
					</div>
				</div>
				<p>Должность</p>
				<input name="stuff" class="input-style" type="text" placeholder="Учитель начальных классов" value="{{$data->stuff}}">
				<p>E-mail</p>
				<input name="email" class="input-style"  type="text" placeholder="teacher@mail.ru" value="{{$data->email}}">
				<p>Наименования образовательного учреждения</p>
				<input name="job"  class="input-style" type="text" placeholder="МБОУ СОШ №11" value="{{$data->job}}">
				<p>Населенный пункт</p>
				<input name="town" class="input-style"  type="text" placeholder="г. Москва" value="{{$data->town}}">
				<button class="button filled-btn">Сохранить</button>
			</form>
		</div>
@endsection