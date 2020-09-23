<!doctype html>
<html lang="ru">
<head>
    <title>Отписка</title>
    @include('styles')
</head>
<body>

@include('header_footer.header')

<div class="container">
    <div class="row justify-content-center">
        {{ $name }}, Вы действительно хотите отписаться от рассылки?
    </div>
    <div style="margin-top: 25px;" class="confirmation row justify-content-center">

        <div class="col-md-4">
            <a href="{{ route("no-mailing-approved") }}?hash={{ $hash }}"
               class="btn green filled-btn">Отписаться</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('home') }}"
               class="btn orange filled-btn">Отклонить</a>
        </div>
    </div>
</div>


@include('header_footer.footer')

</body>
</html>
