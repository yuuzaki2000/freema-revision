<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="{{asset('css/trade.css')}}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.10/dist/cdn.min.js"></script>
    @yield('css')
</head>
<body>
    <div>
        <div class="header">
            <div class="header-text">
                <img src="{{asset('img/logo.svg')}}" alt="ロゴ">
            </div>
        </div>
        <div class="main">
            @yield('total-container')
        </div>
    </div>
</body>
</html>