@extends('account/account')

@section('nav')
	@include('account/nav')
@endsection

@section('account-content')

	<div class="personal-data">
		<h2 class="section-title">
			Личные данные
		</h2>
		<form action="" class="personal-data__form">
			<div class="fio">
				<div class="fio-block">
					<p>Фамилия</p>
					<input name="sur-name" class="input-style" type="text" placeholder="Иванов">
				</div>
				<div class="fio-block">
					<p>Имя</p>
					<input name="name" class="input-style" type="text" placeholder="Иван">
				</div>
				<div class="fio-block">
					<p>Отчество</p>
					<input name="patronymic" class="input-style" type="text" placeholder="Иванович">
				</div>
			</div>
			<p>Должность</p>
			<input name="position" class="input-style" type="text" placeholder="Учитель начальных классов">
			<p>E-mail</p>
			<input name="email" class="input-style"  type="text" placeholder="teacher@mail.ru">
			<p>Наименования образовательного учреждения</p>
			<input name="education"  class="input-style" type="text" placeholder="МБОУ СОШ №11">
			<p>Населенный пункт</p>
			<input name="city" class="input-style"  type="text" placeholder="г. Москва">
			<button class="button filled-btn">Сохранить</button>
		</form>
	</div>
@endsection