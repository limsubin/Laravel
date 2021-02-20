<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Big Store</title>
    <link href=" {{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-color:white">
    <!-- Vue 응용 프로그램의 시작점이며 구성 요소가 로드되는 위치 -->
    <div id="app">
        <app></app>
    </div>
    <script src="{{ mix('js/bootstrap.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
