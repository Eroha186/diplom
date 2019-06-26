@extends('account/account')

@section('account-content')
	<h2 class="section-title">
		Информация о заказе
	</h2>
	<form action="" class="personal-data__form">
		<p>Конкурс</p>
		<select class="input-style"  name="name-contest">

		</select>
		<p>Номинация</p>
		<select class="input-style"  name="name-nomination">

		</select>
		<div class="fio">
			<div  class="fio-block">
				<p>Фамилия участника</p>
				<input class="input-style"  name="sur-name" type="text" placeholder="Иванов">
			</div>
			<div class="fio-block">
				<p>Имя участника</p>
				<input class="input-style"  name="name" type="text" placeholder="Иван">
			</div>
			<div class="fio-block">
				<p>Отчество участника</p>
				<input class="input-style"  name="patronymic" type="text" placeholder="Иванович">
			</div>
		</div>
		<div class="fio">
			<div class="fio-block">
				<p>Фамилия руководителя</p>
				<input class="input-style"  name="sur-name-teacher" type="text" placeholder="Иванов">
			</div>
			<div class="fio-block">
				<p>Имя руководителя</p>
				<input class="input-style"  name="name-teacher" type="text" placeholder="Иван">
			</div>
			<div class="fio-block">
				<p>Отчество руководителя</p>
				<input class="input-style"  name="patronymic-teacher" type="text" placeholder="Иванович">
			</div>
		</div>
		<p>Должность</p>
		<input class="input-style"  name="position" type="text" placeholder="Учитель начальных классов">
		<p>E-mail</p>
		<input class="input-style"  name="email" type="text" placeholder="teacher@mail.ru">
		<p>Наименования образовательного учреждения</p>
		<input class="input-style"  name="education" type="text" placeholder="МБОУ СОШ №11">
		<p>Населенный пункт</p>
		<input class="input-style"  name="city" type="text" placeholder="г. Москва">
		<div class="work">
			<div class="work__name">
				<p>Название работы</p>
				<input class="input-style"  name="name-work" type="text" placeholder="Катись колобок">
			</div>
			<div class="work__type">
				<p>Тип работы</p>
				<select class="input-style"  name="type-work">

				</select>
			</div>
		</div>
		<p>Описание работы</p>
		<textarea class="input-style"  name="descr-work" rows="7"></textarea>
		<p>
			Прикрепленные файлы
		</p>
		<p>На вашем счету 10 бонусов</p>
		<div class="coins">
			<input type="checkbox" >
			Использовать бонусы
			<input class="number-coin input-style" name="number-coin" type="number">
		</div>
		<p class="price">К оплате 90 	&#8381;</p>
		<div>
			<input type="checkbox" >
			Соглашен с условием оферты
		</div>
		<div>
			<input type="checkbox" >
			Я подтверждаю свое согласие на обработку персональных данных
		</div>
		<div>
			<input type="checkbox" >
			Подписаться на расслыку
		</div>
		<div class="wrap-button">
			<button class="button">Перейти к оплате</button>
			<button class="button">Отменить</button>
		</div>
	</form>
@endsection