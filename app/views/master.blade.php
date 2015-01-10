<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>豆瓣图书排名工具</title>
    <link rel="stylesheet" href="{{asset('bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap-table.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap-editable.css')}}">
    {{ HTML::script('jquery.min.js') }}
    {{ HTML::script('bootstrap.min.js') }}
    {{ HTML::script('bootstrap-table.js') }}
    {{ HTML::script('bootstrap-editable.min.js') }}
</head>
<body>
<div class="container">
    <div class="page-header">
        @yield('header')
    </div>
    @yield('content')
</div>
</body>
</html>