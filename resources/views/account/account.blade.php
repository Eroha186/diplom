<!doctype html>
<html lang="ru">
<head>
	<title>Личный кабинет</title>
	@include('styles')
</head>
<body>
	@include('header_footer.header')

	<section class="account__main">
		<div class="container">
			<div class="row justify-content-center">
				<div class="account col-md-12">
					@yield('nav')
					<div class="account__content">
						@yield('account-content')
					</div>
				</div>
			</div>
		</div>
	</section>

	@include('script')
</body>
</html>