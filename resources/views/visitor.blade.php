<!DOCTYPE html>
<html class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div id="app">
        <app-component/>
    </div>
    <script src="{{ mix('js/visitor.js') }}"></script>
</body>
</html>
