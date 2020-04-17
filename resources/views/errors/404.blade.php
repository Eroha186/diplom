<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
@include('header_footer.header')

<style>
    @import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900);
    body{font-family:Rubik,sans-serif;margin:0;overflow-x:hidden;font-weight:300}
    #wrapper{width:100%}error-box{height:100%;position:fixed;top:20%;width:100%}.error-box .footer{width:100%;left:0;right:0}.error-body{padding-top:5%}.error-body h1{font-size:210px;font-weight:900;line-height:210px}.text-danger{color:#f33155}.text-muted{color:#8d9ea7}.m-b-40{margin-bottom:40px!important}.m-t-30{margin-top:30px!important}.m-b-30{margin-bottom:30px!important}@media only screen and (max-width: 520px){.error-body h1{font-size:110px;font-weight:700;line-height:110px}}
</style>

<section id="wrapper" class="container-fluid">
    <div class="error-box">
        <div class="error-body text-center">
            <h1 class="text-danger">404</h1>
            <h3>Страница не найдена</h3>
            <a href="/" class="btn btn-danger btn-rounded m-b-40">Вернуться на главную</a> </div>
    </div>
</section>

{{--@include('header_footer.footer')--}}
</body>
</html>