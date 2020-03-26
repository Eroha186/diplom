<!doctype html>
<html lang="ru">
<head>
    <title>Главная страница</title>
    @include('styles')
</head>
<body>
@include('header_footer.header')
<a href="{{route('auth.social', 'vkontakte')}}" title="Зайти через ВКонтакте">Зайти через ВКонтакте</a>
@include('script')
</body>
<script async type="text/javascript">
    document.write('<script type="text/javascript" src="https://intellectmoney.ru/payform.js?bankcard=on&user_email=on&open_in_new_window=on&can_change_default_sum=on&writer=now&default_sum=100.00&comment_tip=&successUrl=http%3A%2F%2Fsovped.ru%2Ftest&inn=190902940274&btn_name=pay&eshopId=458748"><\/script>');
</script>
</html>
