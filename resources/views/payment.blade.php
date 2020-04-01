<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Оплата</title>
</head>
<body>
<form id="payform" method="POST" name="intellectmoney" action="https://merchant.intellectmoney.ru/ru/">
    <input type="hidden" name="eshopId" value="458748">
    <input type="hidden" name="recipientCurrency" value="TST">
    <input type="hidden" name="backUrl" value="http://sovped.ru">
    @foreach($post_data as $key => $item)
        <input type="hidden" name="{{ $key }}" value="{{ $item }}">
    @endforeach
</form>
<script>
    document.getElementById('payform').submit();
</script>
</body>
</html>