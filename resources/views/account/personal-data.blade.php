@extends('account/account')
@section('account__content')
@
<div class="personal-data">
	<h2 class="section-title">
		Личные данные
	</h2>
	<form action="" class="personal-data__form">
		<div class="fio">
			<div class="fio-block">
				<p>Фамилия</p>
				<input type="text" placeholder="Иванов">
			</div>
			<div class="fio-block">
				<p>Имя</p>
				<input type="text" placeholder="Иван">
			</div>
			<div class="fio-block">
				<p>Отчество</p>
				<input type="text" placeholder="Иванович">
			</div>
		</div>
		<p>Должность</p>
		<input type="text" placeholder="Учитель начальных классов">
		<p>E-mail</p>
		<input type="text" placeholder="teacher@mail.ru">
		<p>Наименования образовательного учреждения</p>
		<input type="text" placeholder="МБОУ СОШ №11">
		<p>Населенный пункт</p>
		<input type="text" placeholder="г. Москва">
		<button class="button filled-btn">Сохранить</button>
	</form>
</div>
@endsection